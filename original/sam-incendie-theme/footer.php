  <footer class="footer" role="contentinfo">
    <div class="container footer__inner">
      <div class="footer__brand">
        <a href="<?php echo si_url(); ?>" class="logo logo--light" aria-label="Sam Incendie - Accueil">
          <span class="logo__name">Sam Incendie</span>
          <span class="logo__tagline">Consultant &amp; Expert en Sécurité Incendie</span>
        </a>
        <p class="footer__desc">Cabinet de conseil indépendant en sécurité incendie pour les ERP et les entreprises.</p>
      </div>
      <nav class="footer__nav" aria-label="Navigation footer">
        <div class="footer__col">
          <h4>Services</h4>
          <ul>
            <li><a href="<?php echo si_url('services/#information'); ?>">Information réglementaire</a></li>
            <li><a href="<?php echo si_url('services/#conseil'); ?>">Conseil incendie</a></li>
            <li><a href="<?php echo si_url('audit/'); ?>">Audit &amp; Diagnostic</a></li>
            <li><a href="<?php echo si_url('formations/'); ?>">Formations</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Secteurs</h4>
          <ul>
            <li><a href="<?php echo si_url('secteurs/#erp'); ?>">ERP</a></li>
            <li><a href="<?php echo si_url('secteurs/#industrie'); ?>">Industrie &amp; ICPE</a></li>
            <li><a href="<?php echo si_url('secteurs/#tertiaire'); ?>">Bureaux &amp; Tertiaire</a></li>
            <li><a href="<?php echo si_url('secteurs/#collectivites'); ?>">Collectivités</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Ressources</h4>
          <ul>
            <li><a href="<?php echo si_url('blog/'); ?>">Blog &amp; Guides</a></li>
            <li><a href="<?php echo si_url(); ?>#reglementation">Réglementation</a></li>
            <li><a href="<?php echo si_url(); ?>#faq">FAQ</a></li>
            <li><a href="<?php echo si_url(); ?>#about">À propos</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Contact</h4>
          <ul>
            <li><a href="mailto:contact@sam-securite-erp.fr">contact@sam-securite-erp.fr</a></li>
            <li><a href="tel:+33781596364">+33 (0)7 81 59 63 64</a></li>
            <li><a href="<?php echo si_url(); ?>#contact">Devis gratuit</a></li>
            <li><a href="<?php echo si_url('mentions-legales/'); ?>">Mentions légales</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="footer__bottom">
      <div class="container">
        <span>© <?php echo date('Y'); ?> Sam Incendie — Tous droits réservés</span>
        <span>
          <a href="<?php echo si_url('mentions-legales/'); ?>">Mentions légales</a> ·
          <a href="<?php echo si_url('mentions-legales/#confidentialite'); ?>">Politique de confidentialité</a> ·
          <a href="<?php echo si_url('mentions-legales/#cookies'); ?>">Cookies</a>
        </span>
      </div>
    </div>
  </footer>

  <button class="back-to-top" id="backToTop" aria-label="Retour en haut de page" hidden>
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="18,15 12,9 6,15"/></svg>
  </button>

<?php wp_footer(); ?>
</body>
</html>
