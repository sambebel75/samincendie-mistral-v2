<?php
/**
 * Template Name: Audit & Diagnostic
 * Template Post Type: page
 */
get_header(); ?>

<main>
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?php echo si_url(); ?>">Accueil</a> <span aria-hidden="true">›</span> <span>Audit &amp; Diagnostic</span>
      </nav>
      <h1>Audit &amp; Diagnostic Sécurité Incendie</h1>
      <p>Un audit terrain complet pour identifier tous les manquements réglementaires et obtenir un plan d'action clair, hiérarchisé et directement actionnable.</p>
      <a href="<?php echo si_url(); ?>#contact" class="btn btn--primary btn--lg" style="margin-top:16px;">Demander un audit gratuit</a>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Méthodologie</span>
        <h2 class="section__title">Notre approche en 3 phases</h2>
      </div>
      <div class="process__steps" style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
        <div class="process__step">
          <div class="process__step-num">01</div>
          <h3 class="process__step-title">Analyse documentaire</h3>
          <p>Examen du registre de sécurité, des rapports de vérification périodique, des plans d'évacuation, des consignes incendie et des comptes-rendus de la commission de sécurité.</p>
        </div>
        <div class="process__step">
          <div class="process__step-num">02</div>
          <h3 class="process__step-title">Inspection terrain</h3>
          <p>Visite complète de votre établissement : vérification des équipements (extincteurs, SSI, désenfumage, éclairage de sécurité), des dégagements, de la signalétique et des installations électriques.</p>
        </div>
        <div class="process__step">
          <div class="process__step-num">03</div>
          <h3 class="process__step-title">Rapport &amp; Plan d'action</h3>
          <p>Remise d'un rapport détaillé avec cotation des risques (critique / majeur / mineur), plan d'action priorisé et estimations budgétaires pour chaque mesure corrective.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section" style="background:var(--grey-bg);">
    <div class="container">
      <div class="section__header">
        <span class="section__tag">Ce que nous vérifions</span>
        <h2 class="section__title">Les 10 points clés de notre audit</h2>
      </div>
      <div class="reglem__grid">
        <div class="reglem__card">
          <h3>Équipements de lutte contre l'incendie</h3>
          <ul>
            <li>Extincteurs portatifs (conformité, signalétique, maintenance)</li>
            <li>Robinets d'incendie armés (RIA)</li>
            <li>Colonnes sèches et humides</li>
            <li>Systèmes d'extinction automatique (sprinklers)</li>
          </ul>
        </div>
        <div class="reglem__card">
          <h3>Système de Sécurité Incendie (SSI)</h3>
          <ul>
            <li>Détecteurs automatiques d'incendie</li>
            <li>Déclencheurs manuels (bris de glace)</li>
            <li>Centrale de mise en sécurité (CMSI)</li>
            <li>Système d'alarme (type 1 à 4)</li>
          </ul>
        </div>
        <div class="reglem__card">
          <h3>Désenfumage &amp; Évacuation</h3>
          <ul>
            <li>Volets et trappes de désenfumage</li>
            <li>Dégagements et sorties de secours</li>
            <li>Éclairage de sécurité (BAES/BAEH)</li>
            <li>Signalétique d'évacuation</li>
          </ul>
        </div>
        <div class="reglem__card">
          <h3>Documentation &amp; Organisation</h3>
          <ul>
            <li>Registre de sécurité incendie</li>
            <li>Plans d'évacuation affichés</li>
            <li>Consignes incendie rédigées</li>
            <li>Formation du personnel à jour</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container" style="text-align:center; max-width:640px">
      <span class="section__tag">Passez à l'action</span>
      <h2 class="section__title">Connaître votre niveau de conformité</h2>
      <p class="section__lead">Un audit préventif vous protège, protège vos occupants et vous évite une fermeture administrative ou des sanctions pénales.</p>
      <a href="<?php echo si_url(); ?>#contact" class="btn btn--primary btn--lg">Demander mon audit gratuit</a>
    </div>
  </section>
</main>

<?php get_footer();
