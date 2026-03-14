<!-- FOOTER -->
<footer class="site-footer">
  <!-- Main Footer -->
  <div class="container" style="padding-top:4rem;padding-bottom:4rem;">
    <?php if (is_front_page() || is_page_template('page-home.php')): ?>
    <!-- Big Tagline -->
    <div class="footer-tagline">
      <h2>
        <?= pll__('ESTRATÉGIA'); ?>
        <br>
        <span class="text-gradient"><?= pll__('QUE CONSTRÓI') ?></span><br>
        <?= pll__('O FUTURO'); ?>
      </h2>
    </div>
    <?php endif; ?>

    <!-- Footer Grid -->
    <div class="footer-grid">
      <!-- Brand -->
      <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo icon-white">
          <img src="<?php echo futureco_icon('logo_future_colorido.png'); ?>" alt="Future CO">
          <!-- <span>Future CO</span> -->
        </a>
        <p class="description">
          <?= pll__('Transformando negócios através de estratégias de marketing digital que geram resultados reais.'); ?>
        </p>
        <div class="footer-social">
          <?php futureco_display_social_links(); ?>
        </div>
      </div>

      <!-- Services Links -->
      <div class="footer-links">
        <h3><?= pll__('Serviços'); ?></h3>
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
        <h3><?= pll__('Empresa'); ?></h3>
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
        <h3><?= pll__('Suporte'); ?></h3>
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
        <h3><?= pll__('Newsletter'); ?></h3>
        <p>
          <?= pll__('Receba dicas e novidades sobre marketing digital.'); ?>
        </p>
        <form class="newsletter-form" id="newsletter-form">
          <input type="email" name="email" placeholder="<?= pll__('Seu email'); ?>" required>
          <button type="submit"><?= pll__('Enviar'); ?></button>
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
      <p>
        <?= sprintf(pll__('&copy; %s Future CO - Todos os direitos reservados'), date('Y')); ?>
      </p>
      <a href="https://lynksistemas.com.br" target="_blank" rel="noopener noreferrer" class="footer-made-by">
        Made with 💙 by <img src="<?php echo futureco_asset('svg/logo-lynk-branca.svg'); ?>" alt="Lynk">
      </a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>