<!-- FOOTER -->
<footer class="site-footer">
  <!-- Main Footer -->
  <div class="container" style="padding-top:4rem;padding-bottom:4rem;">
    <?php if (is_front_page() || is_page_template('page-home.php')): ?>
    <!-- Big Tagline -->
    <div class="footer-tagline">
      <h2>
        <?php echo function_exists('pll__') ? pll__('ESTRATÉGIA QUE CONSTRÓI O FUTURO') : __('ESTRATÉGIA QUE CONSTRÓI O FUTURO', 'futureco'); ?>
      </h2>
    </div>
    <?php endif; ?>

    <!-- Footer Grid -->
    <div class="footer-grid">
      <!-- Brand -->
      <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
          <img src="<?php echo futureco_icon('logo-triangulo.png'); ?>" alt="Future CO">
          <span>Future CO</span>
        </a>
        <p class="description">
          <?php echo function_exists('pll__') ? pll__('Transformando negócios através de estratégias de marketing digital que geram resultados reais.') : __('Transformando negócios através de estratégias de marketing digital que geram resultados reais.', 'futureco'); ?>
        </p>
        <div class="footer-social">
          <?php futureco_display_social_links(); ?>
        </div>
      </div>

      <!-- Services Links -->
      <div class="footer-links">
        <h3><?php echo function_exists('pll__') ? pll__('Serviços') : __('Serviços', 'futureco'); ?></h3>
        <?php
        wp_nav_menu(array(
            'menu'           => futureco_get_menu_name('Serviços'),
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ));
        ?>
      </div>

      <!-- Company Links -->
      <div class="footer-links">
        <h3><?php echo function_exists('pll__') ? pll__('Empresa') : __('Empresa', 'futureco'); ?></h3>
        <?php
        wp_nav_menu(array(
            'menu'           => futureco_get_menu_name('Empresa'),
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ));
        ?>
      </div>

      <!-- Support Links -->
      <div class="footer-links">
        <h3><?php echo function_exists('pll__') ? pll__('Suporte') : __('Suporte', 'futureco'); ?></h3>
        <?php
        wp_nav_menu(array(
            'menu'           => futureco_get_menu_name('Suporte'),
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ));
        ?>
      </div>

      <!-- Newsletter -->
      <div class="footer-newsletter">
        <h3><?php echo function_exists('pll__') ? pll__('Newsletter') : __('Newsletter', 'futureco'); ?></h3>
        <p><?php echo function_exists('pll__') ? pll__('Receba dicas e novidades sobre marketing digital.') : __('Receba dicas e novidades sobre marketing digital.', 'futureco'); ?></p>
        <form class="newsletter-form" id="newsletter-form">
          <input type="email" name="email" placeholder="<?php echo function_exists('pll_esc_attr') ? pll_esc_attr('Seu email') : esc_attr__('Seu email', 'futureco'); ?>" required>
          <button type="submit"><?php echo function_exists('pll__') ? pll__('Enviar') : __('Enviar', 'futureco'); ?></button>
        </form>
        <div class="footer-badges">
          <img src="<?php echo futureco_image('selo-google.png'); ?>" alt="Google Badge" class="badge-google">
          <img src="<?php echo futureco_image('selossl.png'); ?>" alt="SSL Badge" class="badge-ssl">
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="container">
    <div class="footer-bottom">
      <p><?php printf(function_exists('pll__') ? pll__('&copy; %s Future CO - Todos os direitos reservados') : __('&copy; %s Future CO - Todos os direitos reservados', 'futureco'), date('Y')); ?></p>
      <div class="footer-bottom-links">
        <a href="#"><?php echo function_exists('pll__') ? pll__('Política de Privacidade') : __('Política de Privacidade', 'futureco'); ?></a>
        <a href="#"><?php echo function_exists('pll__') ? pll__('Termos de Uso') : __('Termos de Uso', 'futureco'); ?></a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>