<?php
/**
 * Template Name: Services
 * Template Post Type: page
 */
get_header(); ?>

<main>
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?php echo si_url(); ?>">Accueil</a> <span aria-hidden="true">›</span> <span>Services</span>
      </nav>
      <h1>Nos services en sécurité incendie</h1>
      <p>Une offre complète pour accompagner les exploitants d'ERP et les entreprises de la prévention à la mise en conformité réglementaire.</p>
    </div>
  </section>

  <!-- INFORMATION -->
  <section class="section" id="information">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Service 1</span>
        <h2 class="section__title">Information &amp; Veille réglementaire</h2>
        <p class="section__lead">Comprendre vos obligations pour mieux agir — sans jargon, avec des réponses claires et directement applicables à votre situation.</p>
      </div>
      <div class="services__grid">
        <article class="service-card service-card--featured">
          <div class="service-card__icon service-card__icon--info">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </div>
          <h3 class="service-card__title">Analyse du cadre légal applicable</h3>
          <p class="service-card__text">Identification des textes réglementaires applicables à votre type d'établissement : Code de la Construction, Code du travail, arrêtés sectoriels, circulaires.</p>
          <ul class="service-card__list">
            <li>Classement ERP : type et catégorie</li>
            <li>Obligations selon l'activité et l'effectif</li>
            <li>Textes applicables aux ICPE et IGH</li>
            <li>Synthèse réglementaire personnalisée</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
        <article class="service-card">
          <div class="service-card__icon service-card__icon--info">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </div>
          <h3 class="service-card__title">Veille réglementaire personnalisée</h3>
          <p class="service-card__text">Suivi continu des évolutions législatives et réglementaires qui impactent directement votre établissement, avec analyse des changements à intégrer.</p>
          <ul class="service-card__list">
            <li>Alertes sur les nouvelles obligations</li>
            <li>Analyse d'impact sur votre établissement</li>
            <li>Suivi des décisions de la commission de sécurité</li>
            <li>Mise à jour des procédures internes</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
        <article class="service-card">
          <div class="service-card__icon service-card__icon--info">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
          </div>
          <h3 class="service-card__title">Rédaction de guides sectoriels</h3>
          <p class="service-card__text">Production de guides pratiques sur mesure adaptés à votre secteur d'activité, rédigés dans un langage accessible pour vos équipes opérationnelles.</p>
          <ul class="service-card__list">
            <li>Guide d'obligations par type d'ERP</li>
            <li>Fiches pratiques par thématique</li>
            <li>Supports de sensibilisation du personnel</li>
            <li>Aide-mémoire réglementaires</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
        <article class="service-card">
          <div class="service-card__icon service-card__icon--info">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
          </div>
          <h3 class="service-card__title">Réponses aux questions réglementaires</h3>
          <p class="service-card__text">Interlocuteur expert pour répondre à vos questions ponctuelles sur la réglementation incendie, avant une commission de sécurité ou un projet de travaux.</p>
          <ul class="service-card__list">
            <li>Consultation téléphonique ou écrite</li>
            <li>Avis sur la conformité d'un projet</li>
            <li>Préparation aux visites de contrôle</li>
            <li>Réponse sous 24h garantie</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Poser une question →</a>
        </article>
      </div>
    </div>
  </section>

  <!-- CONSEIL -->
  <section class="section" id="conseil" style="background:var(--grey-bg)">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Service 2</span>
        <h2 class="section__title">Conseil en sécurité incendie</h2>
        <p class="section__lead">Un accompagnement sur-mesure pour définir votre politique de sécurité incendie, identifier les risques et mettre en place les mesures préventives adaptées.</p>
      </div>
      <div class="services__grid">
        <article class="service-card service-card--featured">
          <div class="service-card__icon service-card__icon--conseil">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
          </div>
          <h3 class="service-card__title">Analyse de risques incendie</h3>
          <p class="service-card__text">Évaluation globale des risques d'incendie spécifiques à votre activité, vos locaux et votre organisation pour prioriser les actions de prévention.</p>
          <ul class="service-card__list">
            <li>Identification des sources d'inflammation</li>
            <li>Analyse des charges combustibles</li>
            <li>Évaluation des voies de propagation</li>
            <li>Cartographie des risques par zone</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
        <article class="service-card">
          <div class="service-card__icon service-card__icon--conseil">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
          </div>
          <h3 class="service-card__title">Plan de prévention personnalisé</h3>
          <p class="service-card__text">Élaboration d'un plan de prévention incendie structuré, hiérarchisant les actions à mettre en œuvre selon leur priorité et les ressources disponibles.</p>
          <ul class="service-card__list">
            <li>Actions correctives priorisées</li>
            <li>Calendrier de mise en conformité</li>
            <li>Estimations budgétaires indicatives</li>
            <li>Suivi de la mise en œuvre</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
        <article class="service-card">
          <div class="service-card__icon service-card__icon--conseil">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
          </div>
          <h3 class="service-card__title">Registre &amp; documentation de sécurité</h3>
          <p class="service-card__text">Aide à la création et à la mise à jour du registre de sécurité incendie, des consignes d'évacuation et de l'ensemble de la documentation réglementaire obligatoire.</p>
          <ul class="service-card__list">
            <li>Création ou remise à jour du registre de sécurité</li>
            <li>Rédaction des consignes incendie</li>
            <li>Vérification des plans d'évacuation affichés</li>
            <li>Constitution du dossier technique</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
        <article class="service-card">
          <div class="service-card__icon service-card__icon--conseil">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h3 class="service-card__title">Préparation commission de sécurité</h3>
          <p class="service-card__text">Accompagnement complet pour préparer la visite de la commission de sécurité et maximiser vos chances d'obtenir un avis favorable à l'ouverture.</p>
          <ul class="service-card__list">
            <li>Pré-visite terrain de vérification</li>
            <li>Checklist de conformité complète</li>
            <li>Aide à la rédaction du procès-verbal</li>
            <li>Assistance le jour de la commission</li>
          </ul>
          <a href="<?php echo si_url(); ?>#contact" class="service-card__link">Demander un devis →</a>
        </article>
      </div>
    </div>
  </section>

  <!-- AUDIT & FORMATION -->
  <section class="section">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Services complémentaires</span>
        <h2 class="section__title">Audit &amp; Formation</h2>
      </div>
      <div class="services__grid">
        <article class="service-card service-card--featured" id="audit">
          <div class="service-card__badge">Populaire</div>
          <div class="service-card__icon service-card__icon--audit">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </div>
          <h3 class="service-card__title">Audit &amp; Diagnostic incendie</h3>
          <p class="service-card__text">Un audit terrain complet de votre établissement pour identifier tous les manquements réglementaires et vous fournir un plan d'action hiérarchisé.</p>
          <ul class="service-card__list">
            <li>Inspection complète des installations</li>
            <li>Vérification des équipements (extincteurs, SSI, désenfumage)</li>
            <li>Contrôle documentaire (registre, consignes)</li>
            <li>Rapport détaillé avec plan d'action priorisé</li>
          </ul>
          <a href="<?php echo si_url('audit/'); ?>" class="service-card__link">Découvrir l'audit →</a>
        </article>
        <article class="service-card" id="formation">
          <div class="service-card__icon service-card__icon--formation">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <h3 class="service-card__title">Formation sécurité incendie</h3>
          <p class="service-card__text">Des formations pratiques et réglementaires adaptées à votre secteur pour sensibiliser vos équipes et former vos équipiers de première intervention.</p>
          <ul class="service-card__list">
            <li>Sensibilisation incendie tous publics</li>
            <li>Formation EPI (Équipier de Première Intervention)</li>
            <li>Exercices d'évacuation encadrés</li>
            <li>Formation référent sécurité incendie</li>
          </ul>
          <a href="<?php echo si_url('formations/'); ?>" class="service-card__link">Découvrir les formations →</a>
        </article>
      </div>
    </div>
  </section>

  <section class="section" style="background:var(--grey-bg)">
    <div class="container" style="text-align:center; max-width:640px">
      <span class="section__tag">Passez à l'action</span>
      <h2 class="section__title">Un devis personnalisé sous 24h</h2>
      <p class="section__lead">Décrivez-nous votre établissement et vos besoins. Nous vous recontactons rapidement avec une proposition adaptée et sans engagement.</p>
      <a href="<?php echo si_url(); ?>#contact" class="btn btn--primary btn--lg">Demander un devis gratuit</a>
    </div>
  </section>
</main>

<?php get_footer();
