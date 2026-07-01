# Reddit Workflow — Sam Incendie (GEO Phase 2)

Outil **ToS-safe** pour renforcer la présence marque sur Reddit → signal de citation pour ChatGPT / Perplexity / Claude.

> ⚠️ **Reddit interdit le posting automatisé promotionnel.** Aucun script ici ne poste à ta place. Le posting reste **manuel** : ces outils préparent, rappellent et mesurent.

## Contenu

| Fichier | Rôle |
|---------|------|
| `calendrier.json` | Plan 12 semaines anti-ban (subs, cadence, règle de lien) |
| `templates.json` | 5 templates FR corrigés (link-safe, ratio 80/20) |
| `generate-drafts.ps1` | Génère les brouillons de la semaine (Markdown à copier-coller) |
| `monitor-mentions.ps1` | Cherche les mentions marque/métier sur Reddit (read-only, mesure GEO) |
| `setup-reminders.ps1` | Crée des rappels Windows Lun/Mer/Ven |
| `monitor-config.example.json` | Modèle de config API (à copier en `monitor-config.json`) |

## Règle d'or anti-ban
- **Semaines 1-3 : 0 lien.** Que des réponses utiles (200+ mots) + flair SSIAP 3.
- Ensuite : **1 lien max / semaine**, ratio **80% aide / 20% promo**.
- Mention textuelle « Sam Incendie » > lien cliquable (le signal GEO marche sans URL).
- Réponse aux commentaires **< 4h** (boost algo).
- Sub francophone = poster **en français** (les templates EN sont pour r/SafetyProfessionals uniquement).

## 1. Générer les brouillons de la semaine
```powershell
powershell -ExecutionPolicy Bypass -File generate-drafts.ps1 -Semaine 1
```
→ produit `reddit-brouillons-S01.md`. Ouvre, adapte au thread réel, colle sur Reddit.

## 2. Suivre les mentions (mesure GEO)
Sans config : recherche publique (peut être limitée) —
```powershell
powershell -ExecutionPolicy Bypass -File monitor-mentions.ps1 -Jours 7
```
Avec API (recommandé, évite le blocage) :
1. Crée une app **type "script"** sur https://www.reddit.com/prefs/apps
2. `copy monitor-config.example.json monitor-config.json` puis remplis `client_id` / `client_secret` / `username` / `password`.
3. Relance le script. → produit `reddit-mentions-AAAAMMJJ.md` trié par engagement.

`monitor-config.json` est **gitignoré** (jamais commité).

## 3. Rappels Windows
```powershell
powershell -ExecutionPolicy Bypass -File setup-reminders.ps1 -Hour 9
```
Crée 3 tâches hebdo (Lun/Mer/Ven 9h) : popup + régénération auto des brouillons.
Retirer : `... setup-reminders.ps1 -Unregister` (PowerShell admin si besoin).

## Objectifs à 4 semaines
- 200+ followers profil · 3-4 posts à 50+ upvotes · 10+ mentions samincendie.fr issues de tes posts.
- Suivre la progression via `monitor-mentions.ps1` chaque lundi.
