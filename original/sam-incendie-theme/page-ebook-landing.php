<?php
/**
 * Template Name: Landing Ebook B2C
 * Description: Page lead magnet — particuliers
 */
get_header(); ?>

<main>

  <!-- HERO B2C -->
  <section class="hero hero--b2c" id="accueil" aria-label="Votre maison est-elle protégée ?">
    <div class="hero__bg" aria-hidden="true"></div>
    <div class="container hero__inner">
      <div class="hero__badge">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#C0392B"/><path d="M5 8l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Consultant & Expert en sécurité incendie — 12 ans de terrain
      </div>
      <h1 class="hero__title">
        Votre maison est-elle<br />
        <span class="hero__title--accent">vraiment protégée ?</span>
      </h1>
      <p class="hero__subtitle">
        90% des familles font au moins une erreur grave.<br />
        Téléchargez la checklist complète sécurité incendie — <strong style="color:#fff;">gratuite</strong>.
      </p>
      <div class="hero__actions">
        <a href="#telechargement" class="btn btn--primary btn--lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Je veux ma checklist gratuite
        </a>
        <a href="#ebook" class="btn btn--outline btn--lg">Voir l'ebook complet</a>
      </div>
      <div class="hero__trust">
        <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg> Consultant & Expert en sécurité incendie</span>
        <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg> 12 ans sur le terrain</span>
        <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg> +500 logements inspectés</span>
      </div>
    </div>
    <div class="hero__wave" aria-hidden="true">
      <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#F4F6F8"/>
      </svg>
    </div>
  </section>

  <!-- CHIFFRES CHOC -->
  <section class="stats" aria-label="Chiffres alarmants">
    <div class="container stats__grid">
      <div class="stat-card">
        <span class="stat-card__number">1</span>
        <span class="stat-card__unit">toutes les 2 min</span>
        <span class="stat-card__label">incendie déclaré en France</span>
      </div>
      <div class="stat-card">
        <span class="stat-card__number">80</span>
        <span class="stat-card__unit">%</span>
        <span class="stat-card__label">des incendies domestiques arrivent la nuit, quand tout le monde dort</span>
      </div>
      <div class="stat-card">
        <span class="stat-card__number">3</span>
        <span class="stat-card__unit">minutes</span>
        <span class="stat-card__label">seulement pour évacuer avant que les fumées deviennent létales</span>
      </div>
      <div class="stat-card">
        <span class="stat-card__number">90</span>
        <span class="stat-card__unit">%</span>
        <span class="stat-card__label">des familles font au moins une erreur grave selon mon expérience terrain</span>
      </div>
    </div>
  </section>

  <!-- ALERTE -->
  <div class="alert-band" role="alert">
    <div class="container">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <strong>Obligation légale :</strong> Tout logement en France doit être équipé d'au moins un détecteur de fumée (loi du 9 mars 2010). Êtes-vous en conformité ?
    </div>
  </div>

  <!-- PROBLEMES -->
  <section class="section services" aria-labelledby="problemes-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Ce que je vois chaque jour</span>
        <h2 class="section__title" id="problemes-title">Les erreurs que font presque toutes les familles</h2>
        <p class="section__lead">Après 12 ans à inspecter des centaines de logements, je vois toujours les mêmes erreurs. Des erreurs qui peuvent coûter des vies.</p>
      </div>
      <div class="services__grid">

        <article class="service-card service-card--featured">
          <div class="service-card__icon service-card__icon--audit" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          </div>
          <h3 class="service-card__title">Détecteur de fumée désactivé</h3>
          <p class="service-card__text">Il sonnait pendant la cuisson, alors vous avez retiré la pile. Et vous avez oublié de la remettre. C'est l'erreur n°1.</p>
          <ul class="service-card__list">
            <li>Pile à changer tous les ans minimum</li>
            <li>Ne jamais installer en cuisine ou salle de bain</li>
            <li>Position idéale : couloir, palier, chambre</li>
          </ul>
        </article>

        <article class="service-card">
          <div class="service-card__icon service-card__icon--conseil" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </div>
          <h3 class="service-card__title">Extincteur inexistant ou périmé</h3>
          <p class="service-card__text">Un extincteur périmé depuis 3 ans ne servira à rien. La pression interne tombe, l'agent extincteur se dégrade. Zéro efficacité.</p>
          <ul class="service-card__list">
            <li>Vérification annuelle obligatoire</li>
            <li>Remplacement tous les 5-10 ans selon type</li>
            <li>Minimum 1 par niveau du logement</li>
          </ul>
        </article>

        <article class="service-card">
          <div class="service-card__icon service-card__icon--info" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          </div>
          <h3 class="service-card__title">Aucun plan d'évacuation</h3>
          <p class="service-card__text">En cas d'incendie nocturne, vous avez 3 minutes. Sans plan clair, la panique prend le dessus. Vos enfants ne savent pas quoi faire.</p>
          <ul class="service-card__list">
            <li>Définir 2 itinéraires d'évacuation</li>
            <li>Point de rassemblement obligatoire</li>
            <li>Exercice en famille au moins 1x/an</li>
          </ul>
        </article>

        <article class="service-card">
          <div class="service-card__icon service-card__icon--formation" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          </div>
          <h3 class="service-card__title">Mauvais réflexes en cas de feu</h3>
          <p class="service-card__text">Ouvrir une fenêtre, chercher ses affaires, utiliser l'ascenseur... Ces réflexes naturels peuvent être fatals.</p>
          <ul class="service-card__list">
            <li>Ne jamais ouvrir fenêtres (alimente le feu)</li>
            <li>Fermer toutes les portes en évacuant</li>
            <li>Se baisser sous les fumées (air frais au sol)</li>
          </ul>
        </article>

      </div>
    </div>
  </section>

  <!-- LEAD MAGNET — CHECKLIST GRATUITE -->
  <section class="section" id="telechargement" style="background: var(--grey-bg);" aria-labelledby="checklist-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Gratuit</span>
        <h2 class="section__title" id="checklist-title">Téléchargez votre checklist gratuite</h2>
        <p class="section__lead">En 2 minutes, sachez exactement où en est votre maison. 20 points de contrôle essentiels selon les normes en vigueur.</p>
      </div>
      <div style="max-width:560px;margin:0 auto;">
        <div class="contact__form-wrapper">
          <h3 class="contact__form-title">🔥 Ma checklist sécurité incendie — Gratuite</h3>
          <form id="checklistForm" novalidate aria-label="Télécharger la checklist">
            <?php wp_nonce_field( 'si_checklist', 'si_nonce' ); ?>
            <div class="form__group">
              <label for="prenom_cl" class="form__label">Prénom <span aria-hidden="true">*</span></label>
              <input type="text" id="prenom_cl" name="prenom" class="form__input" placeholder="Votre prénom" required autocomplete="given-name" />
            </div>
            <div class="form__group">
              <label for="email_cl" class="form__label">Email <span aria-hidden="true">*</span></label>
              <input type="email" id="email_cl" name="email" class="form__input" placeholder="votre@email.fr" required autocomplete="email" />
            </div>
            <div class="form__group form__group--checkbox">
              <input type="checkbox" id="rgpd_cl" name="rgpd" class="form__checkbox" required />
              <label for="rgpd_cl" class="form__label-check">J'accepte de recevoir la checklist et des conseils sécurité incendie par email. Désinscription en 1 clic.</label>
            </div>
            <button type="submit" class="btn btn--primary btn--full btn--lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              Envoyer ma checklist gratuite
            </button>
            <p style="text-align:center;font-size:.78rem;color:var(--grey-mid);margin-top:12px;">🔒 Données protégées — Zéro spam</p>
            <div class="form__success" id="checklistSuccess" hidden role="status">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#27AE60" stroke-width="2" aria-hidden="true"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
              Checklist envoyée ! Vérifiez votre boîte mail (et vos spams).
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- EBOOK PAYANT -->
  <section class="section" id="ebook" style="background:var(--white);" aria-labelledby="ebook-title">
    <div class="container">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;">
        <div>
          <span class="section__tag">Le guide complet</span>
          <h2 class="section__title" id="ebook-title">Votre maison est-elle vraiment protégée ?</h2>
          <p style="color:var(--grey-mid);margin-bottom:24px;">Le guide complet en 15 pages par Sam, consultant et expert en sécurité incendie, 12 ans d'expérience. Tout ce que vous devez savoir — expliqué simplement.</p>
          <ul class="service-card__list" style="margin-bottom:28px;">
            <li>Matériel obligatoire + liens pour acheter au meilleur prix</li>
            <li>Les 7 erreurs les plus dangereuses (avec solutions)</li>
            <li>Plan d'évacuation prêt à remplir avec votre famille</li>
            <li>Bons réflexes selon chaque type d'incendie</li>
            <li>Checklist annuelle de vérification</li>
            <li>Bonus : guide spécial enfants (leur expliquer simplement)</li>
          </ul>
          <div style="display:flex;align-items:center;gap:16px;margin-bottom:28px;">
            <div style="font-family:var(--font-head);font-size:2.5rem;font-weight:800;color:var(--red);">12€</div>
            <div style="font-size:.9rem;color:var(--grey-mid);">Accès immédiat<br/>PDF téléchargeable</div>
          </div>
          <a href="<?php echo esc_url( get_option('si_ebook_link', '#') ); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Obtenir le guide — 12€
          </a>
          <p style="font-size:.8rem;color:var(--grey-mid);margin-top:10px;">Paiement sécurisé · Accès immédiat · Satisfait ou remboursé 30j</p>
        </div>
        <div style="background:var(--grey-bg);border-radius:var(--radius-lg);padding:40px;border:2px solid var(--grey-light);text-align:center;">
          <div style="width:100%;aspect-ratio:3/4;background:linear-gradient(135deg,var(--navy) 0%,#0f1e30 60%,#1e0a08 100%);border-radius:var(--radius);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px;color:white;margin-bottom:20px;">
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="1.5" style="margin-bottom:16px;"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <div style="font-family:var(--font-head);font-size:1.1rem;font-weight:800;margin-bottom:8px;">Votre maison est-elle<br/>vraiment protégée ?</div>
            <div style="font-size:.82rem;color:rgba(255,255,255,.7);margin-bottom:16px;">La checklist complète<br/>sécurité incendie</div>
            <div style="font-size:.75rem;color:rgba(255,255,255,.5);">Sam — samincendie.fr</div>
          </div>
          <div style="display:flex;justify-content:center;gap:24px;font-size:.82rem;color:var(--grey-mid);">
            <span>📄 15 pages</span>
            <span>✅ PDF</span>
            <span>🔒 Sécurisé</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- AUTEUR -->
  <section class="section about" aria-labelledby="auteur-title">
    <div class="container about__inner">
      <div class="about__visual" aria-hidden="true">
        <div class="about__avatar">
          <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <div class="about__badge-group">
          <div class="about__cert">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Expert certifié
          </div>
          <div class="about__cert">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            12 ans terrain
          </div>
        </div>
      </div>
      <div class="about__content">
        <span class="section__tag">Qui suis-je ?</span>
        <h2 class="section__title" id="auteur-title">Sam — Consultant & Expert en sécurité incendie</h2>
        <p>Je suis Sam, consultant et expert en sécurité incendie. En 12 ans, j'ai inspecté des centaines de logements, formé des équipes au Palais Galliera, à l'AP-HP, dans des résidences seniors. Retrouvez tous mes conseils sur <a href="https://samincendie.fr" target="_blank" rel="noopener">samincendie.fr</a>.</p>
        <p>Et j'ai créé ce guide parce que <strong>ce que je vois dans les maisons des gens me fait peur.</strong> Pas pour faire peur. Pour que vous puissiez agir maintenant, simplement, avec les bons outils.</p>
        <div class="about__values">
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Terrain</strong> — pas un blogueur, un technicien certifié</span></div>
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Simple</strong> — zéro jargon, 100% actionnable</span></div>
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Honnête</strong> — je recommande uniquement ce que j'utilise moi-même</span></div>
        </div>
        <a href="#telechargement" class="btn btn--primary">Je veux ma checklist gratuite</a>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="section faq" aria-labelledby="faq-b2c-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Vos questions</span>
        <h2 class="section__title" id="faq-b2c-title">Questions fréquentes</h2>
      </div>
      <div class="faq__list" role="list">
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Le détecteur de fumée est-il vraiment obligatoire chez moi ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Oui. La loi du 9 mars 2010 rend le DAAF (Détecteur Avertisseur Autonome de Fumée) obligatoire dans <strong>tous les logements en France</strong>, qu'ils soient en location ou en propriété. L'absence de détecteur peut engager votre responsabilité en cas d'incendie.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Où dois-je installer mon détecteur de fumée ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Installez-le dans le <strong>couloir ou sur le palier</strong> entre les chambres — jamais en cuisine (trop de fausses alarmes) ni en salle de bain (vapeur). En étage : un par niveau. La fumée monte : installez-le au plafond ou en haut d'un mur, à 30cm du plafond minimum.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">J'ai un extincteur chez moi. Il est encore valide ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Regardez la date de la dernière vérification sur l'étiquette. Un extincteur non entretenu perd de sa pression et peut ne pas fonctionner au moment critique. Révision recommandée <strong>tous les ans</strong>, remplacement tous les 5 à 10 ans selon le type.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Que faire si le feu se déclare la nuit pendant que je dors ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>1. Ne pas ouvrir les portes sans vérifier leur température (main contre la porte). 2. Restez au sol si la fumée est présente (l'air frais est en bas). 3. Évacuez en fermant les portes derrière vous (ça ralentit la propagation). 4. Appelez le 18 depuis l'extérieur. <strong>Ne revenez jamais dans le bâtiment en feu.</strong></p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">La checklist est vraiment gratuite ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Oui, totalement gratuite. Je l'envoie par email immédiatement après inscription. Pas de carte bancaire, pas d'engagement. Vous recevrez aussi mes conseils hebdomadaires — désinscription en 1 clic.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section style="background:linear-gradient(135deg,var(--navy) 0%,#0f1e30 60%,#1e0a08 100%);padding:80px 0;text-align:center;color:white;" aria-labelledby="cta-final-title">
    <div class="container" style="max-width:640px;">
      <h2 style="color:white;margin-bottom:16px;" id="cta-final-title">Agissez maintenant. Pas après l'incident.</h2>
      <p style="color:rgba(255,255,255,.78);margin-bottom:32px;font-size:1.05rem;">Téléchargez la checklist gratuite. En 10 minutes, vous saurez exactement quoi corriger chez vous.</p>
      <a href="#telechargement" class="btn btn--primary btn--lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Je télécharge ma checklist — Gratuit
      </a>
    </div>
  </section>

</main>

<?php get_footer(); ?>
