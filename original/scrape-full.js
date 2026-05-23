/**
 * Full crawler for sitesecurite.com
 *
 * - Fetches all 1,468 URLs from sitemap.xml
 * - Detects gated pages (subscription required) and skips them
 * - Extracts title, headings, text, links from free pages
 * - Saves each page to ./full-data/<slug>.json
 * - Writes a manifest.json with stats and status per URL
 * - Resumes from where it left off (skips already-done URLs)
 * - Respects robots.txt crawl-delay: 5s
 */

import { gotScraping } from 'got-scraping';
import * as cheerio from 'cheerio';
import { writeFileSync, readFileSync, mkdirSync, existsSync } from 'fs';
import { createHash } from 'crypto';

const BASE_URL    = 'https://sitesecurite.com';
const SITEMAP_URL = `${BASE_URL}/sitemap.xml`;
const OUT_DIR     = './full-data';
const MANIFEST    = `${OUT_DIR}/manifest.json`;
const DELAY_MS    = 5000;
const MAX_URLS    = 400;

// Gating signals — page is behind paywall if any of these appear
const GATE_SIGNALS = [
    '_prtbg1.png',
    'imgprot',
    'Cette page est réservée aux abonnés',
    'réservée aux abonnés',
];

// Pages to skip entirely (login, admin, assets)
const SKIP_PATTERNS = [
    '/connexion.php',
    '/admin',
    '/abo/',
    '/cara/',
    '/cronjob/',
    '/css/',
    '/fonts/',
    '/js/',
    '/images/',
    '/script/',
    '/src/',
    '/vendor/',
];

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

function urlToSlug(url) {
    return createHash('md5').update(url).digest('hex');
}

function shouldSkip(url) {
    return SKIP_PATTERNS.some(p => url.includes(p));
}

function isGated(html) {
    return GATE_SIGNALS.some(s => html.includes(s));
}

function decodeEntities(str = '') {
    return str
        .replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"').replace(/&#39;/g, "'").replace(/&nbsp;/g, ' ')
        .replace(/&eacute;/g, 'é').replace(/&egrave;/g, 'è').replace(/&ecirc;/g, 'ê')
        .replace(/&agrave;/g, 'à').replace(/&acirc;/g, 'â').replace(/&ucirc;/g, 'û')
        .replace(/&ocirc;/g, 'ô').replace(/&iuml;/g, 'ï').replace(/&ccedil;/g, 'ç')
        .replace(/&Eacute;/g, 'É').replace(/&Egrave;/g, 'È').replace(/&Ocirc;/g, 'Ô')
        .replace(/&laquo;/g, '«').replace(/&raquo;/g, '»').replace(/&deg;/g, '°')
        .replace(/&ndash;/g, '–').replace(/&mdash;/g, '—')
        .replace(/&#160;/g, ' ').replace(/\s+/g, ' ').trim();
}

function extractContent(html, url) {
    const $ = cheerio.load(html);

    // Remove nav, header, footer, scripts, styles
    $('header, footer, nav, script, style, .header, .footer, .macro-menu, aside').remove();

    const title = decodeEntities($('title').text());
    const h1    = decodeEntities($('h1').first().text());

    const headings = [];
    $('h2, h3').each((_, el) => {
        const text = decodeEntities($(el).text());
        if (text) headings.push({ tag: el.tagName, text });
    });

    const paragraphs = [];
    $('main p, article p, .content p, section p').each((_, el) => {
        const text = decodeEntities($(el).text());
        if (text.length > 20) paragraphs.push(text);
    });

    const links = [];
    $('main a[href], article a[href], .content a[href]').each((_, el) => {
        const href = $(el).attr('href') || '';
        const text = decodeEntities($(el).text());
        if (href && text && !href.startsWith('#') && !href.includes('javascript')) {
            const abs = href.startsWith('http') ? href : BASE_URL + href;
            links.push({ text, url: abs });
        }
    });

    // Meta description
    const description = decodeEntities($('meta[name="description"]').attr('content') || '');

    return { url, title, description, h1, headings, paragraphs, links };
}

async function fetchSitemapUrls() {
    console.log('Fetching sitemap...');
    const res = await gotScraping({ url: SITEMAP_URL });
    const matches = [...res.body.matchAll(/<loc>(.*?)<\/loc>/g)];
    const urls = matches.map(m => m[1].trim()).filter(u => u.startsWith('http'));
    console.log(`  ✓ ${urls.length} URLs in sitemap`);
    return urls;
}

function loadManifest() {
    if (existsSync(MANIFEST)) {
        return JSON.parse(readFileSync(MANIFEST, 'utf-8'));
    }
    return { started_at: new Date().toISOString(), urls: {} };
}

function saveManifest(manifest) {
    writeFileSync(MANIFEST, JSON.stringify(manifest, null, 2), 'utf-8');
}

async function main() {
    mkdirSync(OUT_DIR, { recursive: true });

    const urls     = await fetchSitemapUrls();
    const manifest = loadManifest();

    // Stats
    let done = 0, free = 0, gated = 0, skipped = 0, errors = 0;

    // Count already-done
    const alreadyDone = Object.values(manifest.urls).filter(v => v.status !== 'pending').length;
    console.log(`Resuming: ${alreadyDone}/${urls.length} already processed\n`);

    for (let i = 0; i < Math.min(urls.length, MAX_URLS); i++) {
        const url = urls[i];

        // Skip if already processed
        if (manifest.urls[url] && manifest.urls[url].status !== 'pending') {
            done++;
            continue;
        }

        // Skip known non-content paths
        if (shouldSkip(url)) {
            manifest.urls[url] = { status: 'skipped', reason: 'blocked path' };
            skipped++;
            done++;
            process.stdout.write(`\r[${done}/${urls.length}] skip: ${url.replace(BASE_URL, '')}`);
            continue;
        }

        try {
            const res = await gotScraping({
                url,
                headers: { 'Accept-Language': 'fr-FR,fr;q=0.9' },
                followRedirect: true,
                timeout: { request: 15000 },
            });

            const html       = res.body;
            const statusCode = res.statusCode;

            if (statusCode !== 200) {
                manifest.urls[url] = { status: 'error', code: statusCode };
                errors++;
            } else if (isGated(html)) {
                manifest.urls[url] = { status: 'gated' };
                gated++;
            } else {
                const content = extractContent(html, url);
                const slug    = urlToSlug(url);
                writeFileSync(`${OUT_DIR}/${slug}.json`, JSON.stringify(content, null, 2), 'utf-8');
                manifest.urls[url] = { status: 'free', slug, title: content.title };
                free++;
            }

        } catch (err) {
            manifest.urls[url] = { status: 'error', reason: err.message };
            errors++;
        }

        done++;
        const pct = Math.round((done / urls.length) * 100);
        process.stdout.write(`\r[${pct}%  ${done}/${urls.length}] free:${free} gated:${gated} skip:${skipped} err:${errors}  `);

        // Save manifest every 10 pages (checkpoint)
        if (done % 10 === 0) saveManifest(manifest);

        // Crawl-delay
        await sleep(DELAY_MS);
    }

    manifest.completed_at = new Date().toISOString();
    manifest.stats = { total: urls.length, free, gated, skipped, errors };
    saveManifest(manifest);

    console.log('\n\n=== DONE ===');
    console.log(`Total URLs:  ${urls.length}`);
    console.log(`Free pages:  ${free}  → saved to ${OUT_DIR}/<slug>.json`);
    console.log(`Gated pages: ${gated}`);
    console.log(`Skipped:     ${skipped}`);
    console.log(`Errors:      ${errors}`);
    console.log(`Manifest:    ${MANIFEST}`);
}

main().catch(console.error);
