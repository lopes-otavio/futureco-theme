<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta name="description"
    content="Future CO - Agência de Marketing Digital 360. Transformamos sua presença digital com estratégias que geram resultados reais.">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>


  <!-- HEADER PRIMÁRIO (base) -->
  <header class="site-header site-header--primary" data-header="primary">
    <div class="container">
      <div class="header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
          <img src="<?php echo futureco_icon('logo-triangulo.png'); ?>" alt="<?php bloginfo('name'); ?>">
          <span class="logo-text">Future co</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Menu principal">
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
                <a href="<?php echo esc_url($lang['url']); ?>" class="lang-item <?php echo $lang['current_lang'] ? 'is-active' : ''; ?>">
                  <img src="<?php echo futureco_asset('svg/bandeiras/' . $flag); ?>" alt="<?php echo esc_attr($lang['name']); ?>">
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
            Fale Conosco
          </a>
        </div>

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" type="button" aria-label="Menu" aria-expanded="false">
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
      <nav class="container" aria-label="Menu mobile">
        <?php
          wp_nav_menu(array(
            'menu'           => futureco_get_menu_name('Header'),
            'container'      => false,
            'items_wrap'     => '%3$s',
            'fallback_cb'    => false,
            'depth'          => 1,
          ));
          ?>
        <a href="#contato" class="btn-primary mobile-nav-link" style="text-align:center;margin-top:1rem;">
          Fale Conosco
        </a>

        <!-- Language Switcher Mobile -->
        <?php if (function_exists('pll_the_languages')) : ?>
          <div class="language-switcher mobile-only">
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
                <a href="<?php echo esc_url($lang['url']); ?>" class="lang-item <?php echo $lang['current_lang'] ? 'is-active' : ''; ?>">
                  <img src="<?php echo futureco_asset('svg/bandeiras/' . $flag); ?>" alt="<?php echo esc_attr($lang['name']); ?>">
                </a>
            <?php
              endif;
            endforeach;
            ?>
          </div>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <!-- HEADER SECUNDÁRIO -->
  <?php get_template_part('header-secondary'); ?>