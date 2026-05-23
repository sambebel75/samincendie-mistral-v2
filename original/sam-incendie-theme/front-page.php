<?php get_header(); ?>

<main>

  <!-- HERO -->
  <section class="hero" id="accueil" aria-label="Présentation">
    <div class="hero__bg" aria-hidden="true"></div>
    <div class="container hero__inner">
      <div class="hero__badge">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="8" fill="#C0392B"/><path d="M5 8l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Expert certifié en sécurité incendie
      </div>
      <h1 class="hero__title">
        Votre expert en sécurité incendie<br />
        <span class="hero__title--accent">pour les ERP</span>
      </h1>
      <p class="hero__subtitle">
        Information · Conseil · Audit · Formation<br />
        Protégez vos occupants et garantissez votre conformité réglementaire.
      </p>
      <div class="hero__actions">
        <a href="#contact" class="btn btn--primary btn--lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
          Demander un audit gratuit
        </a>
        <a href="#services" class="btn btn--outline btn--lg">Découvrir nos services</a>
      </div>
      <div class="hero__trust">
        <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg> Réponse sous 24h</span>
        <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg> Devis gratuit et sans engagement</span>
        <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E67E22" stroke-width="2" aria-hidden="true"><polyline points="20,6 9,17 4,12"/></svg> Expert indépendant certifié</span>
      </div>
    </div>
    <div class="hero__wave" aria-hidden="true">
      <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#F4F6F8"/>
      </svg>
    </div>
  </section>

  <!-- CHIFFRES CLÉS -->
  <section class="stats" id="chiffres" aria-label="Chiffres clés">
    <div class="container stats__grid">
      <div class="stat-card">
        <span class="stat-card__number" data-target="1">1</span>
        <span class="stat-card__unit">toutes les 2 min</span>
        <span class="stat-card__label">incendie déclaré en France</span>
      </div>
      <div class="stat-card">
        <span class="stat-card__number" data-target="40">40</span>
        <span class="stat-card__unit">%</span>
        <span class="stat-card__label">des ERP non conformes à la réglementation</span>
      </div>
      <div class="stat-card">
        <span class="stat-card__number" data-target="70">70</span>
        <span class="stat-card__unit">%</span>
        <span class="stat-card__label">des incendies sont évitables avec la prévention</span>
      </div>
      <div class="stat-card">
        <span class="stat-card__number" data-target="100">100</span>
        <span class="stat-card__unit">%</span>
        <span class="stat-card__label">responsabilité pénale de l'exploitant ERP</span>
      </div>
    </div>
  </section>

  <!-- ALERTE RÉGLEMENTAIRE -->
  <div class="alert-band" role="alert">
    <div class="container">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <strong>Rappel réglementaire :</strong> L'article R.4227-28 du Code du travail impose à tout employeur de former ses salariés à la prévention et à la lutte contre l'incendie.
      <a href="<?php echo si_url('formations/'); ?>">En savoir plus →</a>
    </div>
  </div>

  <!-- SERVICES -->
  <section class="section services" id="services" aria-labelledby="services-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Ce que nous faisons</span>
        <h2 class="section__title" id="services-title">Nos services en sécurité incendie</h2>
        <p class="section__lead">Une offre complète pour accompagner les exploitants d'ERP et les entreprises de la prévention à la mise en conformité.</p>
      </div>
      <div class="services__grid">

        <article class="service-card" aria-label="Service Information">
          <div class="service-card__icon service-card__icon--info" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </div>
          <h3 class="service-card__title">Information &amp; Veille réglementaire</h3>
          <p class="service-card__text">Accédez à une information claire et actualisée sur les textes réglementaires applicables à votre type d'établissement.</p>
          <ul class="service-card__list">
            <li>Analyse du cadre légal applicable</li>
            <li>Veille réglementaire personnalisée</li>
            <li>Guides pratiques sectoriels</li>
            <li>Réponses aux questions réglementaires</li>
          </ul>
          <a href="<?php echo si_url('services/#information'); ?>" class="service-card__link">En savoir plus →</a>
        </article>

        <article class="service-card" aria-label="Service Conseil">
          <div class="service-card__icon service-card__icon--conseil" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <h3 class="service-card__title">Conseil en sécurité incendie</h3>
          <p class="service-card__text">Un accompagnement sur-mesure pour définir votre politique de sécurité incendie et mettre en place les mesures préventives adaptées.</p>
          <ul class="service-card__list">
            <li>Analyse de risques incendie</li>
            <li>Plan de prévention personnalisé</li>
            <li>Aide à la rédaction du registre de sécurité</li>
            <li>Accompagnement commission de sécurité</li>
          </ul>
          <a href="<?php echo si_url('services/#conseil'); ?>" class="service-card__link">En savoir plus →</a>
        </article>

        <article class="service-card service-card--featured" aria-label="Service Audit">
          <div class="service-card__badge">Populaire</div>
          <div class="service-card__icon service-card__icon--audit" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10,9 9,9 8,9"/></svg>
          </div>
          <h3 class="service-card__title">Audit &amp; Diagnostic incendie</h3>
          <p class="service-card__text">Un audit terrain complet de votre établissement pour identifier tous les manquements réglementaires et vous fournir un plan d'action hiérarchisé.</p>
          <ul class="service-card__list">
            <li>Inspection complète des installations</li>
            <li>Vérification des équipements (extincteurs, SSI, désenfumage)</li>
            <li>Contrôle documentaire (registre, consignes)</li>
            <li>Rapport détaillé avec plan d'action priorisé</li>
          </ul>
          <a href="<?php echo si_url('audit/'); ?>" class="service-card__link">En savoir plus →</a>
        </article>

        <article class="service-card" aria-label="Service Formation">
          <div class="service-card__icon service-card__icon--formation" aria-hidden="true">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <h3 class="service-card__title">Formation sécurité incendie</h3>
          <p class="service-card__text">Des formations pratiques et réglementaires adaptées à votre secteur pour sensibiliser vos équipes et former vos équipiers de première intervention.</p>
          <ul class="service-card__list">
            <li>Sensibilisation incendie tous publics</li>
            <li>Formation EPI (Équipier de Première Intervention)</li>
            <li>Exercices d'évacuation encadrés</li>
            <li>Formation aux équipements (extincteurs, RIA)</li>
          </ul>
          <a href="<?php echo si_url('formations/'); ?>" class="service-card__link">En savoir plus →</a>
        </article>

      </div>
      <div class="services__cta">
        <a href="#contact" class="btn btn--primary">Demander un devis gratuit pour votre établissement</a>
      </div>
    </div>
  </section>

  <!-- PROCESSUS -->
  <section class="section process" id="processus" aria-labelledby="process-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Notre méthode</span>
        <h2 class="section__title" id="process-title">Comment nous intervenons</h2>
      </div>
      <div class="process__steps">
        <div class="process__step">
          <div class="process__step-num" aria-hidden="true">01</div>
          <h3 class="process__step-title">Prise de contact</h3>
          <p>Vous nous décrivez votre établissement et vos besoins. Nous répondons sous 24h avec une proposition adaptée.</p>
        </div>
        <div class="process__arrow" aria-hidden="true">→</div>
        <div class="process__step">
          <div class="process__step-num" aria-hidden="true">02</div>
          <h3 class="process__step-title">Diagnostic initial</h3>
          <p>Analyse documentaire et visite terrain pour évaluer votre niveau de conformité réglementaire.</p>
        </div>
        <div class="process__arrow" aria-hidden="true">→</div>
        <div class="process__step">
          <div class="process__step-num" aria-hidden="true">03</div>
          <h3 class="process__step-title">Rapport &amp; Plan d'action</h3>
          <p>Remise d'un rapport complet avec les non-conformités identifiées et un plan d'action priorisé.</p>
        </div>
        <div class="process__arrow" aria-hidden="true">→</div>
        <div class="process__step">
          <div class="process__step-num" aria-hidden="true">04</div>
          <h3 class="process__step-title">Suivi &amp; Accompagnement</h3>
          <p>Accompagnement dans la mise en œuvre des actions correctives et suivi de la conformité dans le temps.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTEURS -->
  <section class="section secteurs" id="secteurs" aria-labelledby="secteurs-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Domaines d'expertise</span>
        <h2 class="section__title" id="secteurs-title">Nous intervenons dans tous les secteurs</h2>
        <p class="section__lead">Chaque type d'établissement a ses propres obligations. Notre expertise couvre l'ensemble des catégories réglementaires.</p>
      </div>
      <div class="secteurs__grid">

        <a href="<?php echo si_url('secteurs/#erp'); ?>" class="secteur-card">
          <div class="secteur-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9,22 9,12 15,12 15,22"/></svg></div>
          <h3 class="secteur-card__title">ERP</h3>
          <p class="secteur-card__subtitle">Hôtels · Restaurants · Écoles · Commerces · Salles de spectacle</p>
          <span class="secteur-card__link">Voir les obligations →</span>
        </a>

        <a href="<?php echo si_url('secteurs/#industrie'); ?>" class="secteur-card">
          <div class="secteur-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg></div>
          <h3 class="secteur-card__title">Industrie &amp; ICPE</h3>
          <p class="secteur-card__subtitle">Usines · Entrepôts · Sites classés · Zones industrielles</p>
          <span class="secteur-card__link">Voir les obligations →</span>
        </a>

        <a href="<?php echo si_url('secteurs/#tertiaire'); ?>" class="secteur-card">
          <div class="secteur-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M12 6h.01M16 6h.01M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01"/></svg></div>
          <h3 class="secteur-card__title">Bureaux &amp; Tertiaire</h3>
          <p class="secteur-card__subtitle">Immeubles de bureaux · Open spaces · Cabinets · Cliniques</p>
          <span class="secteur-card__link">Voir les obligations →</span>
        </a>

        <a href="<?php echo si_url('secteurs/#collectivites'); ?>" class="secteur-card">
          <div class="secteur-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3"/><path d="M20.39 19a8 8 0 10-16.78 0"/><path d="M12 11v8"/><path d="M8 17h8"/></svg></div>
          <h3 class="secteur-card__title">Collectivités</h3>
          <p class="secteur-card__subtitle">Mairies · Gymnases · Médiathèques · Équipements publics</p>
          <span class="secteur-card__link">Voir les obligations →</span>
        </a>

        <a href="<?php echo si_url('secteurs/#sante'); ?>" class="secteur-card">
          <div class="secteur-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
          <h3 class="secteur-card__title">Santé &amp; Social</h3>
          <p class="secteur-card__subtitle">EHPAD · Hôpitaux · Cliniques · Établissements de soins (type J &amp; U)</p>
          <span class="secteur-card__link">Voir les obligations →</span>
        </a>

        <a href="<?php echo si_url('secteurs/#enseignement'); ?>" class="secteur-card">
          <div class="secteur-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg></div>
          <h3 class="secteur-card__title">Enseignement</h3>
          <p class="secteur-card__subtitle">Écoles maternelles · Collèges · Lycées · Universités (type R)</p>
          <span class="secteur-card__link">Voir les obligations →</span>
        </a>

      </div>
    </div>
  </section>

  <!-- RÉGLEMENTATION -->
  <section class="section reglementation" id="reglementation" aria-labelledby="reglem-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Cadre légal</span>
        <h2 class="section__title" id="reglem-title">Vos obligations réglementaires</h2>
        <p class="section__lead">La réglementation incendie est complexe et évolue régulièrement. Voici les textes fondamentaux qui s'appliquent aux ERP et aux entreprises.</p>
      </div>
      <div class="reglem__grid">
        <div class="reglem__card">
          <div class="reglem__card-header"><span class="reglem__card-icon" aria-hidden="true">📋</span><h3>Code du travail</h3></div>
          <p>Les articles <strong>R.4227-28 à R.4227-40</strong> imposent à l'employeur de prendre toutes mesures pour que tout commencement d'incendie puisse être rapidement et efficacement combattu.</p>
          <ul>
            <li>Formation des salariés à la prévention</li>
            <li>Désignation d'équipiers de première intervention</li>
            <li>Exercices d'évacuation obligatoires</li>
          </ul>
        </div>
        <div class="reglem__card">
          <div class="reglem__card-header"><span class="reglem__card-icon" aria-hidden="true">🏛️</span><h3>Règlement ERP (CCH)</h3></div>
          <p>Le <strong>Code de la Construction et de l'Habitation</strong> et son règlement de sécurité ERP (arrêté du 25 juin 1980) définissent les obligations selon le type et la catégorie de l'établissement.</p>
          <ul>
            <li>Classement par type (J, L, M, N, O, P, R, S, T, U, V, W, X, Y)</li>
            <li>Classement par catégorie (1 à 5 selon capacité d'accueil)</li>
            <li>Passage en commission de sécurité</li>
          </ul>
        </div>
        <div class="reglem__card">
          <div class="reglem__card-header"><span class="reglem__card-icon" aria-hidden="true">🔥</span><h3>Registre de sécurité</h3></div>
          <p>Le <strong>registre de sécurité incendie</strong> est obligatoire pour tout ERP. Il consigne toutes les vérifications, formations, exercices et interventions réalisés dans l'établissement.</p>
          <ul>
            <li>Vérifications périodiques des équipements</li>
            <li>Comptes-rendus des exercices d'évacuation</li>
            <li>Formations du personnel</li>
          </ul>
        </div>
        <div class="reglem__card">
          <div class="reglem__card-header"><span class="reglem__card-icon" aria-hidden="true">✅</span><h3>À retenir</h3></div>
          <div class="reglem__table">
            <div class="reglem__row reglem__row--header"><span>Obligation</span><span>Statut</span></div>
            <div class="reglem__row"><span>Formation incendie</span><span class="badge badge--required">Obligatoire</span></div>
            <div class="reglem__row"><span>Exercice d'évacuation</span><span class="badge badge--required">Obligatoire</span></div>
            <div class="reglem__row"><span>Audit sécurité incendie</span><span class="badge badge--recommended">Recommandé</span></div>
            <div class="reglem__row"><span>Plan de prévention incendie</span><span class="badge badge--required">Obligatoire ERP</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG -->
  <section class="section blog" id="blog" aria-labelledby="blog-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Ressources</span>
        <h2 class="section__title" id="blog-title">Guides &amp; Articles pratiques</h2>
        <p class="section__lead">Des ressources gratuites pour comprendre vos obligations et améliorer votre niveau de sécurité incendie.</p>
      </div>
      <div class="blog__grid">
        <?php
        $recent_posts = new WP_Query( [ 'posts_per_page' => 3, 'post_status' => 'publish' ] );
        if ( $recent_posts->have_posts() ) :
          while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
            <article class="blog-card">
              <div class="blog-card__img" aria-hidden="true">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
              </div>
              <div class="blog-card__content">
                <span class="blog-card__tag"><?php the_category( ', ' ); ?></span>
                <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="blog-card__link">Lire l'article →</a>
              </div>
            </article>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <article class="blog-card">
            <div class="blog-card__img" aria-hidden="true"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
            <div class="blog-card__content">
              <span class="blog-card__tag">Réglementation</span>
              <h3 class="blog-card__title"><a href="#">Quelles sont les obligations de l'employeur en sécurité incendie ?</a></h3>
              <p class="blog-card__excerpt">L'article R.4227-28 du Code du travail impose des obligations précises. Découvrez ce que la loi exige et les sanctions encourues en cas de manquement.</p>
              <a href="#" class="blog-card__link">Lire l'article →</a>
            </div>
          </article>
          <article class="blog-card">
            <div class="blog-card__img" aria-hidden="true"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="1.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
            <div class="blog-card__content">
              <span class="blog-card__tag">Formation</span>
              <h3 class="blog-card__title"><a href="#">Formation EPI : qui est concerné et comment l'organiser ?</a></h3>
              <p class="blog-card__excerpt">Les Équipiers de Première Intervention sont le premier maillon de la chaîne de sécurité incendie. Ce guide vous explique comment organiser leur formation.</p>
              <a href="#" class="blog-card__link">Lire l'article →</a>
            </div>
          </article>
          <article class="blog-card">
            <div class="blog-card__img" aria-hidden="true"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
            <div class="blog-card__content">
              <span class="blog-card__tag">Audit</span>
              <h3 class="blog-card__title"><a href="#">Comment se préparer à la commission de sécurité ERP ?</a></h3>
              <p class="blog-card__excerpt">La commission de sécurité peut conditionner l'ouverture de votre établissement. Voici la checklist complète pour passer cette visite sans stress.</p>
              <a href="#" class="blog-card__link">Lire l'article →</a>
            </div>
          </article>
        <?php endif; ?>
      </div>
      <div class="blog__cta">
        <a href="<?php echo si_url('blog/'); ?>" class="btn btn--outline">Voir toutes les ressources</a>
      </div>
    </div>
  </section>

  <!-- À PROPOS -->
  <section class="section about" id="about" aria-labelledby="about-title">
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
            Indépendant &amp; impartial
          </div>
        </div>
      </div>
      <div class="about__content">
        <span class="section__tag">À propos</span>
        <h2 class="section__title" id="about-title">Un expert à votre service</h2>
        <p>Sam Incendie est un cabinet de conseil indépendant spécialisé en sécurité incendie pour les Établissements Recevant du Public (ERP) et les entreprises. Notre mission est simple : <strong>vous aider à protéger vos occupants et à garantir votre conformité réglementaire</strong>, sans jargon inutile.</p>
        <p>Fort d'une expertise reconnue dans le domaine réglementaire (Code de la Construction, Code du travail, arrêtés sectoriels), nous intervenons avec un regard objectif et indépendant de tout fabricant ou installateur d'équipements.</p>
        <div class="about__values">
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Indépendance</strong> — Aucun conflit d'intérêt avec les fournisseurs d'équipements</span></div>
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Expertise</strong> — Maîtrise complète du cadre réglementaire français</span></div>
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Pédagogie</strong> — Des recommandations claires et directement actionnables</span></div>
          <div class="about__value"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#C0392B" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg><span><strong>Réactivité</strong> — Réponse sous 24h, intervention rapide sur site</span></div>
        </div>
        <a href="#contact" class="btn btn--primary">Prendre rendez-vous</a>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="section faq" id="faq" aria-labelledby="faq-title">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">FAQ</span>
        <h2 class="section__title" id="faq-title">Questions fréquentes</h2>
      </div>
      <div class="faq__list" role="list">
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Quels établissements sont soumis à la réglementation ERP ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Tout établissement qui reçoit des personnes extérieures (clients, usagers, visiteurs) est soumis à la réglementation ERP. Cela inclut les hôtels, restaurants, écoles, commerces, salles de spectacle, cliniques, gymnases, etc.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">À quelle fréquence dois-je organiser un exercice d'évacuation ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>La réglementation prévoit au minimum <strong>deux exercices d'évacuation par an</strong> pour les établissements soumis à consigne de sécurité incendie. Ces exercices doivent être consignés dans le registre de sécurité.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Que contient un registre de sécurité incendie ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Le registre de sécurité incendie doit comporter : la liste des contrôles et vérifications techniques, les dates des formations du personnel, les comptes-rendus des exercices d'évacuation, les travaux réalisés et les visites de la commission de sécurité.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Quelles sanctions en cas de non-conformité incendie ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Les sanctions peuvent être graves : <strong>fermeture administrative</strong> de l'établissement, <strong>sanctions pénales</strong> pour l'exploitant (jusqu'à 1 an d'emprisonnement et 15 000€ d'amende) et responsabilité civile engagée en cas d'accident.</p></div>
        </div>
        <div class="faq__item" role="listitem">
          <button class="faq__question" aria-expanded="false">Combien coûte un audit de sécurité incendie ?<span class="faq__icon" aria-hidden="true">+</span></button>
          <div class="faq__answer" hidden><p>Le coût dépend de la superficie et de la complexité de votre établissement. Nous proposons un <strong>premier échange téléphonique gratuit</strong> pour évaluer vos besoins et vous fournir une proposition tarifaire transparente sous 24h.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="section contact" id="contact" aria-labelledby="contact-title">
    <div class="container contact__inner">
      <div class="contact__info">
        <span class="section__tag">Contactez-nous</span>
        <h2 class="section__title" id="contact-title">Parlons de votre établissement</h2>
        <p>Vous souhaitez un audit, une formation, un conseil réglementaire ou simplement une information ? Contactez-nous, nous répondons sous 24h.</p>
        <div class="contact__details">
          <div class="contact__detail">
            <div class="contact__detail-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92v2z"/></svg></div>
            <div><strong>Téléphone</strong><span><a href="tel:+33781596364">+33 (0)7 81 59 63 64</a></span></div>
          </div>
          <div class="contact__detail">
            <div class="contact__detail-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div><strong>Email</strong><span><a href="mailto:contact@sam-securite-erp.fr">contact@sam-securite-erp.fr</a></span></div>
          </div>
          <div class="contact__detail">
            <div class="contact__detail-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 00-8 8c0 5.25 8 14 8 14s8-8.75 8-14a8 8 0 00-8-8z"/></svg></div>
            <div><strong>Zone d'intervention</strong><span>Île-de-France (Paris) et déplacements nationaux</span></div>
          </div>
          <div class="contact__detail">
            <div class="contact__detail-icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg></div>
            <div><strong>Délai de réponse</strong><span>Sous 24h ouvrées</span></div>
          </div>
        </div>
      </div>

      <div class="contact__form-wrapper">
        <form class="contact__form" id="contactForm" novalidate aria-label="Formulaire de contact">
          <?php wp_nonce_field( 'si_contact_form', 'si_nonce' ); ?>
          <h3 class="contact__form-title">Demande de devis gratuit</h3>
          <div class="form__row">
            <div class="form__group">
              <label for="nom" class="form__label">Nom <span aria-hidden="true">*</span></label>
              <input type="text" id="nom" name="nom" class="form__input" placeholder="Votre nom" required autocomplete="name" />
              <span class="form__error" id="nom-error" role="alert"></span>
            </div>
            <div class="form__group">
              <label for="prenom" class="form__label">Prénom <span aria-hidden="true">*</span></label>
              <input type="text" id="prenom" name="prenom" class="form__input" placeholder="Votre prénom" required autocomplete="given-name" />
              <span class="form__error" id="prenom-error" role="alert"></span>
            </div>
          </div>
          <div class="form__row">
            <div class="form__group">
              <label for="email" class="form__label">Email <span aria-hidden="true">*</span></label>
              <input type="email" id="email" name="email" class="form__input" placeholder="votre@email.fr" required autocomplete="email" />
              <span class="form__error" id="email-error" role="alert"></span>
            </div>
            <div class="form__group">
              <label for="telephone" class="form__label">Téléphone</label>
              <input type="tel" id="telephone" name="telephone" class="form__input" placeholder="06 XX XX XX XX" autocomplete="tel" />
            </div>
          </div>
          <div class="form__group">
            <label for="etablissement" class="form__label">Type d'établissement <span aria-hidden="true">*</span></label>
            <select id="etablissement" name="etablissement" class="form__input form__select" required>
              <option value="">Sélectionnez votre type d'établissement</option>
              <option value="hotel">Hôtel / Hébergement (Type O)</option>
              <option value="restaurant">Restaurant / Débits de boissons (Type N)</option>
              <option value="commerce">Commerce / Grande surface (Type M)</option>
              <option value="ecole">École / Établissement d'enseignement (Type R)</option>
              <option value="sante">Établissement de santé (Type J / U)</option>
              <option value="bureau">Bureaux / Tertiaire (Type W)</option>
              <option value="industrie">Industrie / Entrepôt (ICPE)</option>
              <option value="collectivite">Collectivité / Équipement public</option>
              <option value="autre">Autre</option>
            </select>
            <span class="form__error" id="etablissement-error" role="alert"></span>
          </div>
          <div class="form__group">
            <label for="service" class="form__label">Service souhaité</label>
            <select id="service" name="service" class="form__input form__select">
              <option value="">Sélectionnez un service</option>
              <option value="audit">Audit &amp; Diagnostic incendie</option>
              <option value="conseil">Conseil réglementaire</option>
              <option value="formation">Formation sécurité incendie</option>
              <option value="information">Information réglementaire</option>
              <option value="autre">Je ne sais pas encore</option>
            </select>
          </div>
          <div class="form__group">
            <label for="message" class="form__label">Message <span aria-hidden="true">*</span></label>
            <textarea id="message" name="message" class="form__input form__textarea" rows="4" placeholder="Décrivez votre établissement et vos besoins..." required></textarea>
            <span class="form__error" id="message-error" role="alert"></span>
          </div>
          <div class="form__group form__group--checkbox">
            <input type="checkbox" id="rgpd" name="rgpd" class="form__checkbox" required />
            <label for="rgpd" class="form__label-check">
              J'accepte que mes données soient utilisées pour traiter ma demande conformément à la <a href="<?php echo si_url('mentions-legales/#confidentialite'); ?>">politique de confidentialité</a>. <span aria-hidden="true">*</span>
            </label>
            <span class="form__error" id="rgpd-error" role="alert"></span>
          </div>
          <button type="submit" class="btn btn--primary btn--full">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22,2 15,22 11,13 2,9"/></svg>
            Envoyer ma demande
          </button>
          <div class="form__success" id="formSuccess" hidden role="status">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#27AE60" stroke-width="2" aria-hidden="true"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
            Merci ! Votre demande a bien été envoyée. Nous vous répondrons sous 24h.
          </div>
        </form>
      </div>
    </div>
  </section>

</main>

<?php get_footer();
