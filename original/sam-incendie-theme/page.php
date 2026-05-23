<?php
/**
 * Template de page générique — affiche le contenu de l'éditeur WordPress.
 */
get_header(); ?>

<main>
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?php echo si_url(); ?>">Accueil</a>
        <span aria-hidden="true">›</span>
        <span><?php the_title(); ?></span>
      </nav>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section">
    <div class="container" style="max-width:860px">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </section>
</main>

<?php get_footer();
