# GEO Analysis — samincendie.fr

**Analyzed:** 2026-07-01
**Method:** Local static-HTML repo audit + live fetch verification (site == repo, llms.txt deployed).
**Site type:** French fire-safety consulting (ERP), single expert, commercial + content.

---

## 1. GEO Readiness Score: **84 / 100**

| Criterion | Weight | Score | Notes |
|-----------|--------|-------|-------|
| Citability | 25% | 21/25 | Strong data points, FAQ answer blocks, quotable stats |
| Structural readability | 20% | 18/20 | Clean H1 per page, FAQ, breadcrumbs, headings |
| Multi-modal | 15% | 13/15 | 3 YouTube videos + VideoObject schema, images |
| Authority & brand | 20% | 13/20 | sameAs + credentials good; **no reviews, no real-name/Wikipedia entity** |
| Technical accessibility | 20% | 19/20 | Static SSR HTML, AI crawlers allowed, llms.txt live |

---

## 2. Platform Breakdown

| Platform | Score | Why |
|----------|-------|-----|
| **Google AI Overviews** | 85/100 | Full schema, SSR, FAQPage, HowTo, Speakable — best-optimized channel |
| **ChatGPT** | 72/100 | Weak entity: no Wikipedia/Wikidata, founder is only "Sam" (no full name) |
| **Perplexity** | 68/100 | No Reddit/community footprint live — Perplexity cites Reddit 46.7% |
| **Bing Copilot** | 78/100 | Clean index-ready; add IndexNow to lift |

---

## 3. AI Crawler Access Status ✅

robots.txt correctly configured:

| Crawler | Status |
|---------|--------|
| GPTBot, OAI-SearchBot, ChatGPT-User | ✅ Allow |
| ClaudeBot | ✅ Allow |
| PerplexityBot | ✅ Allow |
| CCBot, anthropic-ai, Bytespider | 🚫 Disallow (training — intentional) |
| `*` default | ✅ Allow |

Sitemap declared. Crawl-delay 2. **No action needed.**

---

## 4. llms.txt Status ✅ Excellent

Present at root, live, and well-structured: description, services, expertise, resources, videos, social presence, FAQ, **key data points with numbers**, contact. This is a model llms.txt. One tweak: line 5 blank between `>` blockquotes and `##` is fine; keep the hard stats block (lines 70–77) — that is prime citable material.

---

## 5. Brand Mention Analysis

| Platform | Presence | AI-citation weight |
|----------|----------|-------------------|
| YouTube | ✅ Channel + 3 videos, VideoObject schema | **Strongest signal (~0.737)** — good |
| LinkedIn | ✅ Personal + company | Moderate — good |
| Instagram / TikTok | ✅ linked (sameAs) | Low direct GEO weight |
| **Reddit** | ❌ none live (only strategy .md files) | **High for Perplexity — biggest gap** |
| **Wikipedia / Wikidata** | ❌ none | **High for ChatGPT — biggest gap** |

Brand mentions correlate **3× stronger than backlinks** with AI visibility. YouTube covered; Reddit + entity presence are the missing pillars.

---

## 6. Passage-Level Citability

llms.txt "Données clés" already hits the 134–167-word self-contained ideal in spirit. On-page, ensure each blog opens with a **40–60 word direct answer**. Highly citable existing facts:

- "40% des ERP en France ne sont pas conformes"
- "Amende jusqu'à 75 000 € + responsabilité pénale"
- "1 incendie toutes les 2 minutes (SDIS)"
- Case studies with exact euro savings (3 000–8 350 €)

These are unique, numeric, attributable → exactly what AI extracts. **Attribute sources inline** (e.g. "(données SDIS 2024)") to raise trust.

---

## 7. Server-Side Rendering ✅

Pure static HTML — all content in source, **zero JS dependency for content**. AI crawlers (which don't run JS) get everything. Best-case setup.

---

## 8. Top 5 Highest-Impact Changes

1. **Add Review/aggregateRating schema** — currently ZERO across site. Add real client reviews to LocalBusiness/Service schema. Biggest trust gap for Google AIO + ChatGPT commercial answers.
2. **Build Wikidata entity** for "Sam Incendie" (org) — feeds ChatGPT's #1 source. Use real founder full name in Person schema (currently just "Sam" — weak entity resolution).
3. **Establish Reddit footprint** — answer ERP/sécurité-incendie questions on r/france, r/juridiquefrance, pro subs. Unlocks Perplexity (46.7% Reddit citations).
4. **Add IndexNow** ping for Bing Copilot indexing speed.
5. **Front-load answers** — first 40–60 words of each blog = direct answer to the title question.

---

## 9. Schema Recommendations

- ✅ Have: Organization/LocalBusiness/ProfessionalService, Person (credentials, knowsAbout, sameAs), WebSite+SearchAction, Service, VideoObject×3, FAQPage, HowTo, Course, Breadcrumb, Speakable, Article.
- ❌ **Add `aggregateRating` + `Review`** on LocalBusiness and product/service pages.
- ❌ **Add `Offer` with `price`/`priceCurrency`/`priceValidUntil`** on produits.html kits (19 €, 47 €) → Product schema for AI shopping answers.
- ⚠️ Person `name: "Sam"` → use full legal name; add `alumniOf`/`hasCredential` (SSIAP 3) as structured `EducationalOccupationalCredential`.

---

## 10. Content Reformatting Suggestions

- Each blog H1 → immediately followed by **"En bref :"** 2-3 sentence extractable summary.
- Convert dense reglementation.html sections into **comparison tables** (category × obligation) — tables get 156%+ multimodal lift and are AI-preferred.
- Add **"Qu'est-ce que [X] ?"** definition in first 60 words of reglementation.html and each blog (matches AI query pattern).
- Cite primary sources inline: arrêté references, Code de la Construction articles, SDIS data year.

---

## Quick Wins (do this week)
1. aggregateRating + 3-5 real reviews in schema.
2. Product/Offer schema on kit prices.
3. Full founder name in Person schema.
4. "En bref" answer block atop each blog.

## Bottom line
Technically **top-tier** for GEO — SSR, crawlers, llms.txt, schema depth are all excellent (rare). Ceiling now set by **off-site entity signals**: reviews, Wikidata, Reddit. Fix those three and this clears 90/100.
