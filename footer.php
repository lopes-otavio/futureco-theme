<!-- FOOTER -->
<footer class="site-footer">
  <!-- Main Footer -->
  <div class="container" style="padding-top:4rem;padding-bottom:4rem;">
    <?php if (is_front_page() || is_page_template('page-home.php')): ?>
    <!-- Big Tagline -->
    <div class="footer-tagline">
      <h2>
        ESTRATÉGIA<br>
        <span class="text-gradient">QUE CONSTRÓI</span><br>
        O FUTURO
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
          Transformando negócios através de estratégias de marketing digital que geram resultados reais.
        </p>
        <div class="footer-social">
          <?php futureco_display_social_links(); ?>
        </div>
      </div>

      <!-- Services Links -->
      <div class="footer-links">
        <h3>Serviços</h3>
        <?php
        wp_nav_menu(array(
            'menu'           => 'Serviços',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ));
        ?>
      </div>

      <!-- Company Links -->
      <div class="footer-links">
        <h3>Empresa</h3>
        <?php
        wp_nav_menu(array(
            'menu'           => 'Empresa',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ));
        ?>
      </div>

      <!-- Support Links -->
      <div class="footer-links">
        <h3>Suporte</h3>
        <?php
        wp_nav_menu(array(
            'menu'           => 'Suporte',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ));
        ?>
      </div>

      <!-- Newsletter -->
      <div class="footer-newsletter">
        <h3>Newsletter</h3>
        <p>Receba dicas e novidades sobre marketing digital.</p>
        <form class="newsletter-form" id="newsletter-form">
          <input type="email" name="email" placeholder="Seu email" required>
          <button type="submit">Enviar</button>
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
      <p>&copy; <?php echo date('Y'); ?> Future CO. Todos os direitos reservados.</p>
      <div class="footer-bottom-links">
        <a href="#">Política de Privacidade</a>
        <a href="#">Termos de Uso</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>