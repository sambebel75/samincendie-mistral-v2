<?php
/**
 * Template Name: Mentions Légales
 * Template Post Type: page
 */
get_header(); ?>

<main>
  <section class="page-hero page-hero--light">
    <div class="container">
      <nav class="breadcrumb breadcrumb--light" aria-label="Fil d'Ariane">
        <a href="<?php echo si_url(); ?>">Accueil</a> <span>›</span> <span>Mentions légales</span>
      </nav>
      <h1>Mentions légales</h1>
    </div>
  </section>

  <section class="section">
    <div class="container legal-content">

      <h2 id="editeur">1. Éditeur du site</h2>
      <p>Le site <strong>sam-securite-erp.fr</strong> est édité par :</p>
      <p>
        <strong>Sam Incendie</strong><br />
        Auto-entrepreneur<br />
        Adresse : Paris (75), Île-de-France<br />
        SIRET : 819 209 461 00022<br />
        Email : <a href="mailto:contact@sam-securite-erp.fr">contact@sam-securite-erp.fr</a><br />
        Téléphone : <a href="tel:+33781596364">+33 (0)7 81 59 63 64</a>
      </p>

      <h2 id="hebergement">2. Hébergement</h2>
      <p>Ce site est hébergé par :<br />
      <?php bloginfo('name'); ?> — <a href="<?php echo si_url(); ?>"><?php echo home_url(); ?></a></p>

      <h2 id="propriete">3. Propriété intellectuelle</h2>
      <p>L'ensemble des contenus de ce site (textes, images, graphiques, logo, icônes) sont la propriété exclusive de Sam Incendie, sauf mention contraire. Toute reproduction, distribution, modification ou utilisation est interdite sans autorisation écrite préalable.</p>

      <h2 id="confidentialite">4. Politique de confidentialité (RGPD)</h2>
      <p>Sam Incendie s'engage à protéger vos données personnelles conformément au Règlement Général sur la Protection des Données (RGPD) — Règlement UE 2016/679.</p>

      <h3>Données collectées</h3>
      <p>Lors de l'utilisation du formulaire de contact, nous collectons : nom, prénom, adresse email, numéro de téléphone (facultatif), type d'établissement et message. Ces données sont utilisées <strong>uniquement</strong> pour traiter votre demande de contact ou de devis.</p>

      <h3>Base légale du traitement</h3>
      <p>Le traitement repose sur votre consentement explicite (case à cocher) et sur l'intérêt légitime de répondre à vos demandes commerciales.</p>

      <h3>Durée de conservation</h3>
      <p>Vos données sont conservées pendant <strong>3 ans</strong> à compter de votre dernier contact, puis supprimées ou anonymisées.</p>

      <h3>Vos droits</h3>
      <p>Conformément au RGPD, vous disposez des droits suivants : accès, rectification, effacement, opposition, limitation du traitement et portabilité. Pour exercer vos droits, contactez-nous à : <a href="mailto:contact@sam-securite-erp.fr">contact@sam-securite-erp.fr</a>.</p>
      <p>En cas de réclamation, vous pouvez saisir la CNIL : <a href="https://www.cnil.fr" rel="noopener noreferrer" target="_blank">www.cnil.fr</a>.</p>

      <h2 id="cookies">5. Cookies</h2>
      <p>Ce site peut utiliser des cookies techniques nécessaires à son fonctionnement et, avec votre consentement, des cookies analytiques (Google Analytics ou équivalent). Vous pouvez configurer votre navigateur pour refuser les cookies à tout moment.</p>

      <h2 id="responsabilite">6. Limitation de responsabilité</h2>
      <p>Les informations publiées sur ce site sont données à titre indicatif. Sam Incendie s'efforce de maintenir l'exactitude des informations mais ne peut garantir leur exhaustivité. Pour toute décision engageant la conformité réglementaire de votre établissement, consultez un expert qualifié.</p>

      <p style="margin-top:32px; color:var(--grey-mid); font-size:.85rem;">Dernière mise à jour : <?php echo date('F Y'); ?></p>
    </div>
  </section>
</main>

<?php get_footer();
