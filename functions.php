<?php
/**
 * Future CO Theme Functions
 * 
 * @package FutureCO
 * @version 1.0.0
 */

if (!defined('ABSPATH')) exit;

define('FUTURECO_VERSION', '1.0.0');
define('FUTURECO_DIR', get_template_directory());
define('FUTURECO_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function futureco_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    register_nav_menus(array(
        'primary' => __('Menu Principal', 'futureco'),
        'footer'  => __('Menu Footer', 'futureco'),
    ));
}
add_action('after_setup_theme', 'futureco_setup');

/**
 * Enqueue Scripts and Styles
 */
function futureco_scripts() {
    // Google Fonts - Inter
    wp_enqueue_style(
        'google-fonts-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
        array(),
        null
    );

    // Main Stylesheet
    wp_enqueue_style(
        'futureco-main',
        FUTURECO_URI . '/assets/css/main.css',
        array('google-fonts-inter'),
        FUTURECO_VERSION
    );

    // Theme stylesheet (required by WP)
    wp_enqueue_style(
        'futureco-style',
        get_stylesheet_uri(),
        array('futureco-main'),
        FUTURECO_VERSION
    );

    // Modulos JavaScript
    $modules = array(
        'futureco-header'     => '/assets/js/modules/header.js',
        'futureco-animations' => '/assets/js/modules/animations.js',
        'futureco-carousel'   => '/assets/js/modules/carousel.js',
        'futureco-slider'     => '/assets/js/modules/slider.js',
        'futureco-forms'      => '/assets/js/modules/forms.js',
        'futureco-faq'        => '/assets/js/modules/faq.js',
        'futureco-general'    => '/assets/js/modules/general.js',
    );

    foreach ($modules as $handle => $path) {
        wp_enqueue_script(
            $handle,
            FUTURECO_URI . $path,
            array(),
            FUTURECO_VERSION,
            true
        );
    }

    // Localize script with theme data (attached to forms module)
    wp_localize_script('futureco-forms', 'futurecoData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('futureco_nonce'),
        'themeUri' => FUTURECO_URI,
    ));
}
add_action('wp_enqueue_scripts', 'futureco_scripts');

/**
 * Contact Form AJAX Handler
 */
function futureco_contact_form_handler() {
    check_ajax_referer('futureco_nonce', 'nonce');

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Campos obrigatórios não preenchidos.');
    }

    // Send email
    $to = get_option('admin_email');
    $subject = sprintf('[Future CO] Nova mensagem de %s', $name);
    $body = sprintf(
        "Nome: %s\nEmail: %s\nTelefone: %s\nEmpresa: %s\n\nMensagem:\n%s",
        $name, $email, $phone, $company, $message
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf('Reply-To: %s <%s>', $name, $email),
    );

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success('Mensagem enviada com sucesso!');
    } else {
        wp_send_json_error('Erro ao enviar mensagem. Tente novamente.');
    }
}
add_action('wp_ajax_futureco_contact', 'futureco_contact_form_handler');
add_action('wp_ajax_nopriv_futureco_contact', 'futureco_contact_form_handler');

/**
 * Newsletter AJAX Handler
 */
function futureco_newsletter_handler() {
    check_ajax_referer('futureco_nonce', 'nonce');

    $email = sanitize_email($_POST['email'] ?? '');

    if (empty($email) || !is_email($email)) {
        wp_send_json_error('Email inválido.');
    }

    // Store subscriber (you can integrate with Mailchimp, etc.)
    $subscribers = get_option('futureco_subscribers', array());
    if (!in_array($email, $subscribers)) {
        $subscribers[] = $email;
        update_option('futureco_subscribers', $subscribers);
    }

    wp_send_json_success('Inscrito com sucesso!');
}
add_action('wp_ajax_futureco_newsletter', 'futureco_newsletter_handler');
add_action('wp_ajax_nopriv_futureco_newsletter', 'futureco_newsletter_handler');

/**
 * Helper: Get theme asset URL
 */
function futureco_asset($path) {
    return FUTURECO_URI . '/assets/' . ltrim($path, '/');
}

/**
 * Helper: Get icon URL
 */
function futureco_icon($name) {
    return FUTURECO_URI . '/assets/icons/' . $name;
}

/**
 * Helper: Get image URL
 */
function futureco_image($name) {
    return FUTURECO_URI . '/assets/images/' . $name;
}

/**
 * Disable admin bar on frontend for non-admins
 */
if (!current_user_can('administrator')) {
    add_filter('show_admin_bar', '__return_false');
}

/**
 * Helper: Display Social Links from CPT
 */
function futureco_display_social_links($link_class = '') {
    $socials = new WP_Query(array(
        'post_type'      => 'socials',
        'posts_per_page' => -1,
        'status'         => 'publish',
        'order'          => 'ASC'
    ));

    if ($socials->have_posts()) {
        while ($socials->have_posts()) {
            $socials->the_post();
            $link = get_field('link', get_the_ID());
            $icon = get_field('icone', get_the_ID()); // Assumes SVG code or URL
            $title = get_the_title();

            // Layout common for both footer and contact
            printf(
                '<a href="%s" class="%s" aria-label="%s" target="_blank" rel="noopener noreferrer"><img src="%s" alt="%s"></a>',
                esc_url($link),
                esc_attr($link_class),
                esc_attr($title),
                esc_url($icon),
                $icon, // Removed esc_url() to allow for direct SVG or URL
                esc_attr($title)
            );
        }
        wp_reset_postdata();
       }
    }