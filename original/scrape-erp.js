/**
 * Scraper for sitesecurite.com/portail-erp.php
 *
 * Extracts:
 *   1. Regulation sections (static HTML - all categories)
 *   2. Latest news (JSON API: /news/api/index.php)
 *
 * No browser needed - all data available via HTTP + JSON API.
 * Respects robots.txt crawl-delay: 5s between requests.
 */

import { gotScraping } from 'got-scraping';
import * as cheerio from 'cheerio';
import { writeFileSync } from 'fs';

const BASE_URL = 'https://sitesecurite.com';
const CRAWL_DELAY_MS = 5000;

async function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function fetchPage(url) {
    const response = await gotScraping({ url, headers: { 'Accept-Language': 'fr-FR,fr;q=0.9' } });
    return response.body;
}

async function fetchNewsApi(category, number = 20) {
    const url = `${BASE_URL}/news/api/index.php?category=${category}&number=${number}`;
    const response = await gotScraping({ url, responseType: 'json' });
    return response.body;
}

function decodeHtmlEntities(str) {
    return str
        .replace(/&amp;/g, '&')
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"')
        .replace(/&#39;/g, "'")
        .replace(/&nbsp;/g, ' ')
        .replace(/&eacute;/g, 'é')
        .replace(/&egrave;/g, 'è')
        .replace(/&ecirc;/g, 'ê')
        .replace(/&agrave;/g, 'à')
        .replace(/&acirc;/g, 'â')
        .replace(/&ucirc;/g, 'û')
        .replace(/&ocirc;/g, 'ô')
        .replace(/&iuml;/g, 'ï')
        .replace(/&ccedil;/g, 'ç')
        .replace(/&Eacute;/g, 'É')
        .replace(/&Egrave;/g, 'È')
        .replace(/&laquo;/g, '«')
        .replace(/&raquo;/g, '»')
        .replace(/&deg;/g, '°')
        .replace(/&ndash;/g, '–')
        .replace(/&mdash;/g, '—')
        .replace(/&#160;/g, ' ')
        .replace(/&#8209;/g, '‑')
        .trim();
}

function extractSections($) {
    const sections = [];
    const seen = new Set();

    $('a.btn-link[title][href]').each((_, el) => {
        const $el = $(el);
        const href = $el.attr('href');
        const title = decodeHtmlEntities($el.attr('title') || '');
        const code = decodeHtmlEntities($el.find('.link-item').text()).trim();

        if (!href || !code || seen.has(href)) return;
        seen.add(href);

        // Determine category from href pattern
        let category = 'other';
        if (href.includes('dispositions-communes') || href.includes('erpgn')) category = 'dispositions-communes';
        else if (href.includes('dispositions-generales')) category = 'dispositions-generales';
        else if (href.includes('dispositions-particulieres')) category = 'dispositions-particulieres';
        else if (href.includes('dispositions-5e-categorie')) category = 'dispositions-5e-categorie';
        else if (href.includes('dispositions-speciales')) category = 'dispositions-speciales';

        sections.push({
            code,
            title,
            category,
            url: BASE_URL + href,
        });
    });

    return sections;
}

function extractPinnedNews($) {
    const pinned = [];
    $('.news-content-fixe').each((_, el) => {
        const $el = $(el);
        const dateText = decodeHtmlEntities($el.find('.news-date-fixe').text()).trim();
        const bodyText = decodeHtmlEntities($el.find('p:not(.news-date-fixe)').text()).trim();
        const link = $el.find('a[href]').attr('href') || null;
        if (dateText) pinned.push({ date: dateText, summary: bodyText, link });
    });
    return pinned;
}

function cleanNewsItem(item) {
    return {
        id: item.ID,
        title: decodeHtmlEntities(item.title || '').replace(/<[^>]+>/g, '').trim(),
        date: decodeHtmlEntities(item.date || '').trim(),
        categories: (item.categories || '').split(',').map(s => s.trim()),
        image: item.image || null,
        text: item.text || '',  // keep raw HTML for richness
    };
}

async function main() {
    console.log('Phase 1: Fetching portail-erp.php...');
    const html = await fetchPage(`${BASE_URL}/portail-erp.php`);
    const $ = cheerio.load(html);

    // Extract static data
    const sections = extractSections($);
    const pinnedNews = extractPinnedNews($);
    console.log(`  ✓ ${sections.length} regulation sections extracted`);
    console.log(`  ✓ ${pinnedNews.length} pinned news items`);

    await sleep(CRAWL_DELAY_MS);

    // Fetch news via API
    console.log('Phase 2: Fetching news via API...');
    const newsItems = await fetchNewsApi('erp', 50);
    const news = Array.isArray(newsItems) ? newsItems.map(cleanNewsItem) : [];
    console.log(`  ✓ ${news.length} news items from API`);

    // Group sections by category
    const sectionsByCategory = {};
    for (const s of sections) {
        if (!sectionsByCategory[s.category]) sectionsByCategory[s.category] = [];
        sectionsByCategory[s.category].push(s);
    }

    const result = {
        source: `${BASE_URL}/portail-erp.php`,
        scraped_at: new Date().toISOString(),
        portal: 'ERP — Établissements recevant du public',
        regulation_sections: {
            total: sections.length,
            by_category: sectionsByCategory,
        },
        pinned_news: pinnedNews,
        latest_news: {
            total: news.length,
            items: news,
        },
    };

    const outPath = 'erp-data.json';
    writeFileSync(outPath, JSON.stringify(result, null, 2), 'utf-8');
    console.log(`\n✓ Saved to ${outPath}`);
    console.log(`  Sections: ${sections.length}`);
    console.log(`  News: ${news.length}`);
    console.log('\nSection categories:');
    for (const [cat, items] of Object.entries(sectionsByCategory)) {
        console.log(`  ${cat}: ${items.map(s => s.code).join(', ')}`);
    }
}

main().catch(console.error);
