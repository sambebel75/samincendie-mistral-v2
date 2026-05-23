<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <header class="header" id="header">
    <div class="container header__inner">
      <a href="<?php echo si_url(); ?>" class="logo" aria-label="Sam Incendie - Accueil">
        <span class="logo__text">
          <span class="logo__name">Sam Incendie</span>
          <span class="logo__tagline">Consultant &amp; Expert en Sécurité Incendie</span>
        </span>
      </a>
      <nav class="nav" id="nav" aria-label="Navigation principale">
        <ul class="nav__list">
          <li><a href="<?php echo si_url(); ?>#services"      class="nav__link">Services</a></li>
          <li><a href="<?php echo si_url(); ?>#secteurs"      class="nav__link">Secteurs</a></li>
          <li><a href="<?php echo si_url(); ?>#reglementation" class="nav__link">Réglementation</a></li>
          <li><a href="<?php echo si_url(); ?>#blog"          class="nav__link">Ressources</a></li>
          <li><a href="<?php echo si_url(); ?>#about"         class="nav__link">À propos</a></li>
          <li><a href="<?php echo si_url(); ?>#contact"       class="nav__link nav__link--cta">Devis gratuit</a></li>
        </ul>
      </nav>
      <button class="nav__burger" id="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="nav">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>
