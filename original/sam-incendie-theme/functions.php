<?php
/**
 * Sam Incendie — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ---- Theme setup ---- */
function si_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    load_theme_textdomain( 'sam-incendie', get_template_directory() . '/languages' );

    register_nav_menus( [
        'primary' => __( 'Menu principal', 'sam-incendie' ),
        'footer'  => __( 'Menu footer', 'sam-incendie' ),
    ] );
}
add_action( 'after_setup_theme', 'si_setup' );

/* ---- Enqueue assets ---- */
function si_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'si-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:ital,wght@0,400;0,600;1,400&display=swap',
        [],
        null
    );

    // Main stylesheet (style.css = theme CSS)
    wp_enqueue_style(
        'si-style',
        get_stylesheet_uri(),
        [ 'si-google-fonts' ],
        '1.0.0'
    );

    // Main JS
    wp_enqueue_script(
        'si-main',
        get_template_directory_uri() . '/js/main.js',
        [],
        '1.0.0',
        true  // load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'si_enqueue_assets' );

/* ---- Helper : URL raccourcie ---- */
function si_url( $path = '' ) {
    return esc_url( home_url( '/' . ltrim( $path, '/' ) ) );
}

/* ---- Désactiver la barre d'admin en front-end (optionnel) ---- */
// add_filter( 'show_admin_bar', '__return_false' );

/* ================================================================
   B2C — Checklist gratuite (lead magnet)
   POST /wp-admin/admin-ajax.php action=si_checklist
================================================================ */
add_action( 'wp_ajax_si_checklist',        'si_handle_checklist' );
add_action( 'wp_ajax_nopriv_si_checklist', 'si_handle_checklist' );

function si_handle_checklist() {
    // Verify nonce
    if ( ! check_ajax_referer( 'si_checklist', 'si_nonce', false ) ) {
        wp_send_json_error( [ 'message' => 'Erreur de sécurité. Rechargez la page.' ], 403 );
    }

    $prenom = sanitize_text_field( wp_unslash( $_POST['prenom'] ?? '' ) );
    $email  = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

    if ( empty( $prenom ) || ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Prénom et email valide requis.' ] );
    }

    // Email to admin
    $admin_email = get_option( 'admin_email' );
    $subject     = 'Nouvelle inscription checklist — ' . $prenom;
    $body        = "Nouveau lead checklist B2C :\n\nPrénom : {$prenom}\nEmail : {$email}\n\nÀ ajouter à votre liste email et envoyer la checklist.";
    wp_mail( $admin_email, $subject, $body );

    // Email to subscriber — envoyer la checklist
    $checklist_url = get_option( 'si_checklist_url', '' );
    $subject_sub   = '🔥 Votre checklist sécurité incendie — ' . $prenom;
    $body_sub      = "Bonjour {$prenom},\n\nMerci pour votre inscription !\n\nVoici votre checklist gratuite \"Votre maison est-elle vraiment protégée ?\" :\n\n";

    if ( $checklist_url ) {
        $body_sub .= "Téléchargement : {$checklist_url}\n\n";
    } else {
        $body_sub .= "Je vous l'envoie manuellement d'ici quelques minutes.\n\n";
    }

    $body_sub .= "À bientôt,\nSam — Consultant & Expert en sécurité incendie\nsamincendie.fr\ncontact@sam-securite-erp.fr";
    wp_mail( $email, $subject_sub, $body_sub );

    wp_send_json_success( [ 'message' => 'Checklist envoyée ! Vérifiez votre boîte mail.' ] );
}

/* ---- Option : URL ebook + URL checklist ---- */
add_action( 'admin_init', function() {
    register_setting( 'general', 'si_ebook_link',    [ 'sanitize_callback' => 'esc_url_raw' ] );
    register_setting( 'general', 'si_checklist_url', [ 'sanitize_callback' => 'esc_url_raw' ] );
} );

/* ---- JS inline pour formulaire checklist ---- */
add_action( 'wp_footer', function() { ?>
<script>
(function(){
  var form = document.getElementById('checklistForm');
  if (!form) return;
  form.addEventListener('submit', function(e){
    e.preventDefault();
    var btn = form.querySelector('button[type=submit]');
    btn.disabled = true;
    btn.textContent = 'Envoi en cours...';
    var data = new FormData(form);
    data.append('action', 'si_checklist');
    fetch('<?php echo esc_url( admin_url("admin-ajax.php") ); ?>', {
      method: 'POST',
      body: data
    })
    .then(function(r){ return r.json(); })
    .then(function(res){
      if (res.success) {
        form.style.display = 'none';
        document.getElementById('checklistSuccess').hidden = false;
      } else {
        btn.disabled = false;
        btn.textContent = 'Envoyer ma checklist gratuite';
        alert(res.data.message || 'Une erreur est survenue.');
      }
    })
    .catch(function(){
      btn.disabled = false;
      btn.textContent = 'Envoyer ma checklist gratuite';
      alert('Erreur réseau. Réessayez.');
    });
  });
})();
</script>
<?php } );
