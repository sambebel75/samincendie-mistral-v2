<?php
/**
 * Fallback template — affiche les articles du blog si pas de page d'accueil statique.
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <?php if ( have_posts() ) : ?>
        <div class="blog__grid">
          <?php while ( have_posts() ) : the_post(); ?>
            <article class="blog-card">
              <div class="blog-card__content">
                <span class="blog-card__tag"><?php the_date(); ?></span>
                <h2 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="blog-card__excerpt"><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="blog-card__link">Lire →</a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(); ?>
      <?php else : ?>
        <p><?php esc_html_e( 'Aucun contenu trouvé.', 'sam-incendie' ); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer();
