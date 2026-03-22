<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta name="description"
    content="Future CO - Agência de Marketing Digital 360. Transformamos sua presença digital com estratégias que geram resultados reais.">
  <?php wp_head(); ?>
  <!-- Google Tag Manager -->
  <script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-N7FKT3L9');
  </script>
  <!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?> data-theme="dark">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N7FKT3L9" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <?php wp_body_open(); ?>


  <!-- HEADER PRIMÁRIO (base) -->
  <header class="site-header site-header--primary" data-header="primary">
    <div class="container">
      <div class="header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo icon-white">
          <img src="<?php echo futureco_icon('logo_future_colorido.png'); ?>" alt="<?php bloginfo('name'); ?>">
          <!-- <span class="logo-text">Future co</span> -->
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="<?= pll__('Menu principal') ?>">
          <?php
            wp_nav_menu(array(
              'menu'           => futureco_get_menu_name('Header'),
              'container'      => false,
              'items_wrap'     => '%3$s',
              'fallback_cb'    => false,
              'depth'          => 1,
            ));
            ?>
        </nav>

        <!-- Language Switcher Desktop -->
        <?php if (function_exists('pll_the_languages')) : ?>
        <div class="language-switcher desktop-only">
          <?php
            $languages = pll_the_languages(array('raw' => 1));
            foreach ($languages as $lang) :
              $flag = '';
              $slug = $lang['slug'];
              if ($slug === 'pt' || $slug === 'pt-br' || $slug === 'br') $flag = 'br.svg';
              elseif ($slug === 'en' || $slug === 'us') $flag = 'us.svg';
              elseif ($slug === 'es') $flag = 'es.svg';

              if ($flag) :
            ?>
          <a href="<?php echo esc_url($lang['url']); ?>"
            class="lang-item <?php echo $lang['current_lang'] ? 'is-active' : ''; ?>">
            <img src="<?php echo futureco_asset('svg/bandeiras/' . $flag); ?>"
              alt="<?php echo esc_attr($lang['name']); ?>">
          </a>
          <?php
              endif;
            endforeach;
            ?>
        </div>
        <?php endif; ?>



        <!-- CTA Button -->
        <div class="header-cta">
          <a href="#contato" class="btn-primary"
            style="font-size:.875rem;text-transform:uppercase;letter-spacing:.05em;">
            <?= pll__('Fale Conosco') ?>
          </a>
        </div>

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" type="button" aria-label="<?= pll__('Menu') ?>" aria-expanded="false">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="menu-icon">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="close-icon" style="display:none;">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" data-menu>
      <div class="mobile-menu__header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo icon-white">
          <img src="<?php echo futureco_icon('logo_future_colorido.png'); ?>" alt="<?php bloginfo('name'); ?>">
          <!-- <span class="logo-text">Future co</span> -->
        </a>
        <button class="mobile-menu-close" type="button" aria-label="<?= pll__('Fechar menu') ?>">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>

      <div class="mobile-menu__utils">


        <!-- Language Switcher Mobile -->
        <?php if (function_exists('pll_the_languages')) : ?>
        <div class="language-switcher">
          <?php
            $languages = pll_the_languages(array('raw' => 1));
            foreach ($languages as $lang) :
              $flag = '';
              $slug = $lang['slug'];
              if ($slug === 'pt' || $slug === 'pt-br' || $slug === 'br') $flag = 'br.svg';
              elseif ($slug === 'en' || $slug === 'us') $flag = 'us.svg';
              elseif ($slug === 'es') $flag = 'es.svg';

              if ($flag) :
            ?>
          <a href="<?php echo esc_url($lang['url']); ?>"
            class="lang-item <?php echo $lang['current_lang'] ? 'is-active' : ''; ?>">
            <img src="<?php echo futureco_asset('svg/bandeiras/' . $flag); ?>"
              alt="<?php echo esc_attr($lang['name']); ?>">
          </a>
          <?php
              endif;
            endforeach;
            ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="mobile-menu__content">
        <nav aria-label="<?= pll__('Menu mobile') ?>">
          <?php
            wp_nav_menu(array(
              'menu'           => futureco_get_menu_name('Header'),
              'container'      => false,
              'items_wrap'     => '%3$s',
              'fallback_cb'    => false,
              'depth'          => 1,
            ));
            ?>
          <a href="#contato" class="btn-primary mobile-nav-link" style="text-align:center;margin-top:1.5rem;">
            <?= pll__('Fale Conosco') ?>
          </a>
        </nav>
      </div>

      <div class="mobile-menu__footer">
        <p class="social-label">
          <?= pll__('SIGA FUTURE CO NAS REDES SOCIAIS') ?>
        </p>
        <div class="footer-social">
          <?php futureco_display_social_links('mobile-social-link'); ?>
        </div>
        <div class="copyright">
          <p>&copy; <?php echo date('Y'); ?>
            <?= pll__('Future CO. Todos os direitos reservados.') ?>
          </p>
          <p>
            <?= pll__('CNPJ: 00.000.000/0001-00') ?>
          </p>
        </div>
      </div>
    </div>
  </header>

  <!-- HEADER SECUNDÁRIO -->
  <?php get_template_part('header-secondary'); ?>