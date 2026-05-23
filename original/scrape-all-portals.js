/**
 * Scraper for all 6 portals on sitesecurite.com
 *
 * Portals scraped:
 *   ERP   - Établissements recevant du public
 *   IGH   - Immeubles de grande et moyenne hauteur
 *   HAB   - Bâtiments d'habitation
 *   BUP   - Bâtiments à usage professionnel (ERT)
 *   ICPE  - Installations classées pour la protection de l'environnement
 *   DIVERS - Autres réglementations
 *
 * Data sources:
 *   - Static HTML: regulation section links + titles (Cheerio)
 *   - JSON API:    /news/api/index.php?category=X&number=N
 *
 * Respects robots.txt crawl-delay: 5s between requests.
 */

import { gotScraping } from 'got-scraping';
import * as cheerio from 'cheerio';
import { writeFileSync, mkdirSync } from 'fs';

const BASE_URL = 'https://sitesecurite.com';
const CRAWL_DELAY_MS = 5000;
const NEWS_COUNT = 50;
const OUT_DIR = './portal-data';

const PORTALS = [
    { slug: 'erp',   path: '/portail-erp.php',   label: 'ERP — Établissements recevant du public',                   newsCategory: 'erp'    },
    { slug: 'igh',   path: '/portail-igh.php',   label: 'IGH/IMH — Immeubles de grande et moyenne hauteur',          newsCategory: 'igh'    },
    { slug: 'hab',   path: '/portail-hab.php',   label: 'HAB — Bâtiments d\'habitation',                             newsCategory: 'hab'    },
    { slug: 'bup',   path: '/portail-bup.php',   label: 'BUP/ERT — Bâtiments à usage professionnel',                 newsCategory: 'ert'    },
    { slug: 'icpe',  path: '/portail-icpe.php',  label: 'ICPE — Installations classées pour l\'environnement',       newsCategory: 'icpe'   },
    { slug: 'divers',path: '/portail-divers.php',label: 'Divers — Autres réglementations',                           newsCategory: 'others' },
];

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function fetchPage(url) {
    const response = await gotScraping({ url, headers: { 'Accept-Language': 'fr-FR,fr;q=0.9' } });
    return response.body;
}

async function fetchNewsApi(category) {
    const url = `${BASE_URL}/news/api/index.php?category=${category}&number=${NEWS_COUNT}`;
    const response = await gotScraping({ url, responseType: 'json' });
    return Array.isArray(response.body) ? response.body : [];
}

function decodeHtmlEntities(str = '') {
    return str
        .replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"').replace(/&#39;/g, "'").replace(/&nbsp;/g, ' ')
        .replace(/&eacute;/g, 'é').replace(/&egrave;/g, 'è').replace(/&ecirc;/g, 'ê')
        .replace(/&agrave;/g, 'à').replace(/&acirc;/g, 'â').replace(/&ucirc;/g, 'û')
        .replace(/&ocirc;/g, 'ô').replace(/&iuml;/g, 'ï').replace(/&ccedil;/g, 'ç')
        .replace(/&Eacute;/g, 'É').replace(/&Egrave;/g, 'È').replace(/&Ocirc;/g, 'Ô')
        .replace(/&laquo;/g, '«').replace(/&raquo;/g, '»').replace(/&deg;/g, '°')
        .replace(/&ndash;/g, '–').replace(/&mdash;/g, '—')
        .replace(/&#160;/g, ' ').replace(/&#8209;/g, '‑')
        .replace(/<br\s*\/?>/gi, ' ')
        .trim();
}

function classifyErpSection(href) {
    if (href.includes('dispositions-communes') || href.includes('erpgn')) return 'dispositions-communes';
    if (href.includes('dispositions-generales'))    return 'dispositions-generales';
    if (href.includes('dispositions-particulieres'))return 'dispositions-particulieres';
    if (href.includes('dispositions-5e-categorie')) return 'dispositions-5e-categorie';
    if (href.includes('dispositions-speciales'))    return 'dispositions-speciales';
    return 'other';
}

/**
 * ERP portal: <a class="btn-link" title="Full title"><span class="link-item">CODE</span></a>
 */
function extractErpSections($) {
    const sections = [];
    const seen = new Set();
    $('a.btn-link[title][href]').each((_, el) => {
        const $el  = $(el);
        const href = $el.attr('href') || '';
        const title = decodeHtmlEntities($el.attr('title'));
        const code  = decodeHtmlEntities($el.find('.link-item').text());
        if (!href || !code || seen.has(href)) return;
        seen.add(href);
        sections.push({ code, title, category: classifyErpSection(href), url: BASE_URL + href });
    });
    return sections;
}

/**
 * IGH/HAB/BUP/ICPE portals: <a class="btn-link btn-link--100"><li><span>Title</span><span class="X-item">Code</span></li></a>
 * DIVERS portal:             <a class="btn-link btn-link--100"><li>Full title text (no code span)</li></a>
 *
 * Section headings come from preceding <p class="nav-section-head"> / <p class="nav-section-subhead"> siblings.
 */
function extractGenericSections($) {
    const sections = [];
    const seen = new Set();
    let currentGroup = 'general';

    // Walk all relevant nodes in document order to track section headings
    $('p.nav-section-head, p.nav-section-subhead, a.btn-link').each((_, el) => {
        const $el = $(el);
        const tag = el.tagName.toLowerCase();

        if (tag === 'p') {
            currentGroup = decodeHtmlEntities($el.text());
            return;
        }

        // It's an anchor
        const href = $el.attr('href') || '';
        if (!href || seen.has(href)) return;
        seen.add(href);

        const $li = $el.find('li');
        const spans = $li.find('span');

        let title, code;
        if (spans.length >= 2) {
            // IGH/HAB/BUP/ICPE: first span = title, last span = code
            title = decodeHtmlEntities($(spans[0]).text());
            code  = decodeHtmlEntities($(spans[spans.length - 1]).text());
        } else {
            // DIVERS: single text node in <li>, no code
            title = decodeHtmlEntities($li.text() || $el.text());
            code  = '';
        }

        if (!title) return;
        sections.push({
            code,
            title,
            category: currentGroup,
            url: href.startsWith('http') ? href : BASE_URL + href,
        });
    });

    return sections;
}

function extractSections($, slug) {
    return slug === 'erp' ? extractErpSections($) : extractGenericSections($);
}

function extractPinnedNews($) {
    const pinned = [];
    $('.news-content-fixe').each((_, el) => {
        const $el = $(el);
        const date    = decodeHtmlEntities($el.find('.news-date-fixe').text());
        const summary = decodeHtmlEntities($el.find('p:not(.news-date-fixe)').text());
        const link    = $el.find('a[href]').attr('href') || null;
        if (date) pinned.push({ date, summary, link });
    });
    return pinned;
}

function cleanNewsItem(item) {
    return {
        id:         item.ID,
        title:      decodeHtmlEntities(item.title || '').replace(/<[^>]+>/g, '').trim(),
        date:       decodeHtmlEntities(item.date || ''),
        categories: (item.categories || '').split(',').map(s => s.trim()).filter(Boolean),
        image:      item.image || null,
        text:       item.text || '',
    };
}

function groupByCategory(sections) {
    return sections.reduce((acc, s) => {
        (acc[s.category] ??= []).push(s);
        return acc;
    }, {});
}

async function scrapePortal(portal, index, total) {
    console.log(`\n[${index + 1}/${total}] ${portal.label}`);

    console.log(`  Fetching ${portal.path}...`);
    const html = await fetchPage(BASE_URL + portal.path);
    const $ = cheerio.load(html);

    const sections   = extractSections($, portal.slug);
    const pinnedNews = extractPinnedNews($);
    console.log(`  ✓ ${sections.length} sections, ${pinnedNews.length} pinned news`);

    await sleep(CRAWL_DELAY_MS);

    console.log(`  Fetching news (category=${portal.newsCategory})...`);
    const rawNews = await fetchNewsApi(portal.newsCategory);
    const news    = rawNews.map(cleanNewsItem);
    console.log(`  ✓ ${news.length} news items`);

    return {
        portal:   portal.slug,
        label:    portal.label,
        source:   BASE_URL + portal.path,
        scraped_at: new Date().toISOString(),
        regulation_sections: {
            total: sections.length,
            by_category: groupByCategory(sections),
        },
        pinned_news:  pinnedNews,
        latest_news:  { total: news.length, items: news },
    };
}

async function main() {
    mkdirSync(OUT_DIR, { recursive: true });
    console.log(`Scraping ${PORTALS.length} portals → ${OUT_DIR}/`);

    const summary = [];

    for (let i = 0; i < PORTALS.length; i++) {
        const portal = PORTALS[i];
        const data = await scrapePortal(portal, i, PORTALS.length);

        const outPath = `${OUT_DIR}/${portal.slug}.json`;
        writeFileSync(outPath, JSON.stringify(data, null, 2), 'utf-8');
        console.log(`  ✓ Saved ${outPath}`);

        summary.push({
            portal:   portal.slug,
            label:    portal.label,
            sections: data.regulation_sections.total,
            news:     data.latest_news.total,
            file:     outPath,
        });

        // Crawl-delay between portals (except last)
        if (i < PORTALS.length - 1) {
            console.log(`  Waiting ${CRAWL_DELAY_MS / 1000}s (crawl-delay)...`);
            await sleep(CRAWL_DELAY_MS);
        }
    }

    // Write combined summary
    const summaryPath = `${OUT_DIR}/summary.json`;
    writeFileSync(summaryPath, JSON.stringify({ scraped_at: new Date().toISOString(), portals: summary }, null, 2), 'utf-8');

    console.log('\n=== DONE ===');
    console.log(`Portal        Sections  News`);
    console.log(`─────────────────────────────`);
    for (const s of summary) {
        console.log(`${s.portal.padEnd(12)}  ${String(s.sections).padEnd(8)}  ${s.news}`);
    }
    console.log(`\nSummary → ${summaryPath}`);
}

main().catch(console.error);
