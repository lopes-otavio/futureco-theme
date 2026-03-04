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

    // Load translations
    load_theme_textdomain('futureco', get_template_directory() . '/languages');
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
        'futureco-header'          => '/assets/js/modules/header.js',
        'futureco-animations'      => '/assets/js/modules/animations.js',
        'futureco-carousel'        => '/assets/js/modules/carousel.js',
        'futureco-slider'          => '/assets/js/modules/slider.js',
        'futureco-forms'           => '/assets/js/modules/forms.js',
        'futureco-faq'             => '/assets/js/modules/faq.js',
        'futureco-general'         => '/assets/js/modules/general.js',
        'futureco-theme-switcher'  => '/assets/js/modules/theme-switcher.js',
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

    // Localize theme switcher script
    wp_localize_script('futureco-theme-switcher', 'futurecoThemeData', array(
        'modoEscuro' => pll__('Modo Escuro'),
        'modoClaro'  => pll__('Modo Claro'),
    ));

    // reCAPTCHA Form Script
    wp_enqueue_script(
        'google-recaptcha',
        'https://www.google.com/recaptcha/api.js',
        array(),
        null,
        true
    );

    // Localize script with theme data (attached to forms module)
    wp_localize_script('futureco-forms', 'futurecoData', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('futureco_nonce'),
        'themeUri' => FUTURECO_URI,
        'recaptchaSiteKey' => defined('FUTURECO_RECAPTCHA_SITE_KEY') ? FUTURECO_RECAPTCHA_SITE_KEY : '',
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

    // Verify reCAPTCHA
    $recaptcha_response = sanitize_text_field($_POST['g-recaptcha-response'] ?? '');
    if (empty($recaptcha_response)) {
        wp_send_json_error('Por favor, confirme que você não é um robô.');
    }

    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    $verify_data = array(
        'secret'   => defined('FUTURECO_RECAPTCHA_SECRET_KEY') ? FUTURECO_RECAPTCHA_SECRET_KEY : '',
        'response' => $recaptcha_response
    );

    $verify_response = wp_remote_post($verify_url, array('body' => $verify_data));
    $verify_body = wp_remote_retrieve_body($verify_response);
    $verify_result = json_decode($verify_body);

    if (empty($verify_result->success) || !$verify_result->success) {
        wp_send_json_error('Falha na verificação de segurança (reCAPTCHA). Tente novamente.');
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

/**
 * Helper: Get dynamic menu name based on language
 */
function futureco_get_menu_name($base_name) {
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language();
        if ($lang && $lang !== 'pt') {
            return $base_name . '-' . $lang;
        }
    }
    return $base_name;
}

/**
 * Register strings for Polylang translation
 */
function futureco_register_strings() {
    if (function_exists('pll_register_string')) {
        // Header
        pll_register_string('Modo Escuro', 'Modo Escuro', 'Future CO Header');
        pll_register_string('Modo Claro', 'Modo Claro', 'Future CO Header');
        pll_register_string('Fale Conosco', 'Fale Conosco', 'Future CO Header');
        pll_register_string('SIGA FUTURE CO NAS REDES SOCIAIS', 'SIGA FUTURE CO NAS REDES SOCIAIS', 'Future CO Header');
        pll_register_string('CNPJ: 00.000.000/0001-00', 'CNPJ: 00.000.000/0001-00', 'Future CO Header');
        pll_register_string('Fechar menu', 'Fechar menu', 'Future CO Header');
        pll_register_string('Alternar modo escuro', 'Alternar modo escuro', 'Future CO Header');
        pll_register_string('Menu mobile', 'Menu mobile', 'Future CO Header');
        pll_register_string('Menu main', 'Menu', 'Future CO Header');
        pll_register_string('Menu principal', 'Menu principal', 'Future CO Header');

        // Hero
        pll_register_string('Comece Agora', 'Comece Agora', 'Future CO Hero');
        pll_register_string('Nossos Serviços', 'Nossos Serviços', 'Future CO Hero');
        pll_register_string('Transforme sua presença digital em resultados reais', 'Transforme sua presença digital em resultados reais', 'Future CO Hero');
        pll_register_string('Transformando ideias ousadas em realidades', 'Transformando ideias ousadas em realidades', 'Future CO Hero');
        pll_register_string('Somos uma agência de marketing digital 360° especializada em criar estratégias que conectam marcas ao seu público e geram crescimento sustentável.', 'Somos uma agência de marketing digital 360° especializada em criar estratégias que conectam marcas ao seu público e geram crescimento sustentável.', 'Future CO Hero');

        // Contact
        pll_register_string('Siga-nos nas redes sociais', 'Siga-nos nas redes sociais', 'Future CO Contact');
        pll_register_string('ENTRE EM CONTATO', 'ENTRE EM CONTATO', 'Future CO Contact');
        pll_register_string('Vamos conversar sobre seu projeto title', 'Vamos conversar sobre seu <span style="color:#9AA7B8;">projeto?</span>', 'Future CO Contact');
        pll_register_string('Nome *', 'Nome *', 'Future CO Contact');
        pll_register_string('Seu nome completo', 'Seu nome completo', 'Future CO Contact');
        pll_register_string('Email *', 'Email *', 'Future CO Contact');
        pll_register_string('Telefone', 'Telefone', 'Future CO Contact');
        pll_register_string('(00) 00000-0000', '(00) 00000-0000', 'Future CO Contact');
        pll_register_string('Empresa', 'Empresa', 'Future CO Contact');
        pll_register_string('Nome da empresa', 'Nome da empresa', 'Future CO Contact');
        pll_register_string('Mensagem *', 'Mensagem *', 'Future CO Contact');
        pll_register_string('Conte-nos sobre seu projeto...', 'Conte-nos sobre seu projeto...', 'Future CO Contact');
        pll_register_string('Enviar Mensagem', 'Enviar Mensagem', 'Future CO Contact');

        // Footer
        pll_register_string('ESTRATÉGIA', 'ESTRATÉGIA', 'Future CO Footer');
        pll_register_string('QUE CONSTRÓI', 'QUE CONSTRÓI', 'Future CO Footer');
        pll_register_string('O FUTURO', 'O FUTURO', 'Future CO Footer');
        pll_register_string('Transformando negócios através de estratégias de marketing digital que geram resultados reais.', 'Transformando negócios através de estratégias de marketing digital que geram resultados reais.', 'Future CO Footer');
        pll_register_string('Serviços', 'Serviços', 'Future CO Footer');
        pll_register_string('Empresa', 'Empresa', 'Future CO Footer');
        pll_register_string('Suporte', 'Suporte', 'Future CO Footer');
        pll_register_string('Newsletter', 'Newsletter', 'Future CO Footer');
        pll_register_string('Receba dicas e novidades sobre marketing digital.', 'Receba dicas e novidades sobre marketing digital.', 'Future CO Footer');
        pll_register_string('Seu email', 'Seu email', 'Future CO Footer');
        pll_register_string('Enviar', 'Enviar', 'Future CO Footer');
        pll_register_string('Future CO. Todos os direitos reservados.', 'Future CO. Todos os direitos reservados.', 'Future CO Footer');
        pll_register_string('Política de Privacidade', 'Política de Privacidade', 'Future CO Footer');
        pll_register_string('Termos de Uso', 'Termos de Uso', 'Future CO Footer');
        pll_register_string('Total Links', 'Total Links', 'Future CO Footer');
        pll_register_string('&copy; %s Future CO - Todos os direitos reservados', '&copy; %s Future CO - Todos os direitos reservados', 'Future CO Footer');

        // FAQ
        pll_register_string('Faca uma pergunta', 'Faca uma pergunta', 'Future CO FAQ');

        // Blog & Cases
        pll_register_string('Ver Mais', 'Ver Mais', 'Future CO Sections');

        // Culture
        pll_register_string('Junte-se a nós', 'Junte-se a nós', 'Future CO Culture');

        // Services
        pll_register_string('Saiba mais', 'Saiba mais', 'Future CO Services');
    }
}
add_action('after_setup_theme', 'futureco_register_strings');