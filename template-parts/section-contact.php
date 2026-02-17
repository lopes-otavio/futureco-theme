<?php
/**
 * Contact Section
 * @package FutureCO
 */


$contacts = new WP_Query(array(
            'post_type'      => 'contact',
            'posts_per_page' => -1,
            'status'         => 'publish',
            'order'          => 'ASC'
        ));
?>
<?php
$contato_group = get_field('contato_section');
$label_sessao = $contato_group['label_sessao'] ?? 'ENTRE EM CONTATO';
$titulo = $contato_group['titulo'] ?? 'Vamos conversar sobre seu <span style="color:#9AA7B8;">projeto?</span>';
?>
<section class="contact-section section-padding" id="contato">
  <div class="container">
    <!-- Section Header -->
    <div class="section-header">
      <p class="section-label" style="color:rgba(57,73,106,0.5);"><?php echo esc_html($label_sessao); ?></p>
      <h2 class="section-title" style="color:#39496A;">
        <?php echo $titulo; ?>
      </h2>
    </div>

    <div class="contact-grid">
      <!-- Contact Info -->
      <div class="scroll-animate">
        <?php
          if ($contacts->have_posts()) :
            while ($contacts->have_posts()) : 
                $contacts->the_post();
                $label = get_field('label', get_the_ID());
                $valor = get_field('valor', get_the_ID());
                $link  = get_field('link', get_the_ID());
                $valor2 = get_field('valor2', get_the_ID());
                $link2  = get_field('link2', get_the_ID());
                $icon  = get_field('icon', get_the_ID());
        ?>
        <div class="contact-info-item">
          <div class="contact-info-icon">
            <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($label); ?>" style="max-width:20px;">
          </div>
          <div>
            <p class="label"><?php echo esc_html($label); ?></p>
            <div class="contact-values">
              <?php if ($link) : ?>
              <a href="<?php echo esc_url($link); ?>" class="value"><?php echo esc_html($valor); ?></a>
              <?php else : ?>
              <p class="value"><?php echo esc_html($valor); ?></p>
              <?php endif; ?>

              <?php if ($valor2) : ?>
                <?php if ($link2) : ?>
                <a href="<?php echo esc_url($link2); ?>" class="value" style="display:block; margin-top:4px;"><?php echo esc_html($valor2); ?></a>
                <?php else : ?>
                <p class="value" style="display:block; margin-top:4px;"><?php echo esc_html($valor2); ?></p>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif; 
        ?>

        <!-- Social Links -->
        <div class="social-links">
          <p class="label">Siga-nos nas redes sociais</p>
          <div class="links">
            <?php futureco_display_social_links('social-link'); ?>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="scroll-animate delay-200">
        <form class="contact-form" id="contact-form">
          <div class="form-row">
            <div class="form-group">
              <label for="contact-name">Nome *</label>
              <input type="text" id="contact-name" name="name" placeholder="Seu nome completo" required>
              <span class="error-message"></span>
            </div>
            <div class="form-group">
              <label for="contact-email">Email *</label>
              <input type="email" id="contact-email" name="email" placeholder="seu@email.com" required>
              <span class="error-message"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="contact-phone">Telefone</label>
              <input type="tel" id="contact-phone" name="phone" placeholder="(00) 00000-0000">
              <span class="error-message"></span>
            </div>
            <div class="form-group">
              <label for="contact-company">Empresa</label>
              <input type="text" id="contact-company" name="company" placeholder="Nome da empresa">
            </div>
          </div>
          <div class="form-group">
            <label for="contact-message">Mensagem *</label>
            <textarea id="contact-message" name="message" rows="5" placeholder="Conte-nos sobre seu projeto..."
              required></textarea>
            <span class="error-message"></span>
          </div>
          <div class="form-submit">
            <button type="submit" class="btn-primary">
              <span>Enviar Mensagem</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13" />
                <polygon points="22 2 15 22 11 13 2 9 22 2" />
              </svg>
            </button>
            <div id="contact-form-feedback" class="form-feedback"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>