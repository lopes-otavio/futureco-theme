  <!-- HEADER SECUNDÁRIO (overlay que desce) -->
  <header class="site-header site-header--secondary" data-header="secondary" aria-hidden="true">
    <div class="container">
      <div class="header-inner">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
          <img src="<?php echo futureco_icon('logo-triangulo.png'); ?>" alt="<?php bloginfo('name'); ?>">
          <span class="logo-text">Future CO</span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Menu principal">
          <?php
            wp_nav_menu(array(
              'menu'           => 'Header',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'fallback_cb'    => false,
              'depth'          => 1,
            ));
            ?>
        </nav>

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
            'menu'           => 'Header',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'fallback_cb'    => false,
            'depth'          => 1,
          ));
          ?>
        <a href="#contato" class="btn-primary mobile-nav-link" style="text-align:center;margin-top:1rem;">
          Fale Conosco
        </a>
      </nav>
    </div>
  </header>