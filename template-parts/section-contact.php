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
$label_sessao = $contato_group['label_sessao'] ?? (function_exists('pll__') ? pll__('ENTRE EM CONTATO') : __('ENTRE EM CONTATO', 'futureco'));
$titulo = $contato_group['titulo'] ?? (function_exists('pll__') ? pll__('Vamos conversar sobre seu <span style="color:#9AA7B8;">projeto?</span>') : __('Vamos conversar sobre seu <span style="color:#9AA7B8;">projeto?</span>', 'futureco'));

if (get_field('ativar') !== false) :
?>
<section class="contact-section section-padding" id="contato">
  <!-- <div class="decorative-bg"></div> -->
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
              <a href="<?php echo esc_url($link2); ?>" class="value"
                style="display:block; margin-top:4px;"><?php echo esc_html($valor2); ?></a>
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
          <p class="label">
            <?php echo function_exists('pll__') ? pll__('Siga-nos nas redes sociais') : __('Siga-nos nas redes sociais', 'futureco'); ?>
          </p>
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
              <label
                for="contact-name"><?php echo function_exists('pll__') ? pll__('Nome *') : __('Nome *', 'futureco'); ?></label>
              <input type="text" id="contact-name" name="name"
                placeholder="<?php echo function_exists('pll__') ? pll__('Seu nome completo') : __('Seu nome completo', 'futureco'); ?>"
                required>
              <span class="error-message"></span>
            </div>
            <div class="form-group">
              <label
                for="contact-email"><?php echo function_exists('pll__') ? pll__('Email *') : __('Email *', 'futureco'); ?></label>
              <input type="email" id="contact-email" name="email" placeholder="seu@email.com" required>
              <span class="error-message"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label
                for="contact-phone"><?php echo function_exists('pll__') ? pll__('Telefone') : __('Telefone', 'futureco'); ?></label>
              <input type="tel" id="contact-phone" name="phone"
                placeholder="<?php echo function_exists('pll__') ? pll__('(00) 00000-0000') : __('(00) 00000-0000', 'futureco'); ?>">
              <span class="error-message"></span>
            </div>
            <div class="form-group">
              <label
                for="contact-company"><?php echo function_exists('pll__') ? pll__('Empresa') : __('Empresa', 'futureco'); ?></label>
              <input type="text" id="contact-company" name="company"
                placeholder="<?php echo function_exists('pll_esc_attr') ? pll_esc_attr('Nome da empresa') : esc_attr__('Nome da empresa', 'futureco'); ?>">
            </div>
          </div>
          <div class="form-group">
            <label
              for="contact-message"><?php echo function_exists('pll__') ? pll__('Mensagem *') : __('Mensagem *', 'futureco'); ?></label>
            <textarea id="contact-message" name="message" rows="5"
              placeholder="<?php echo function_exists('pll_esc_attr') ? pll_esc_attr('Conte-nos sobre seu projeto...') : esc_attr__('Conte-nos sobre seu projeto...', 'futureco'); ?>"
              required></textarea>
            <span class="error-message"></span>
          </div>
          <div class="form-submit">
            <button type="submit" class="btn-primary">
              <span><?php echo function_exists('pll__') ? pll__('Enviar Mensagem') : __('Enviar Mensagem', 'futureco'); ?></span>
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
<?php endif; ?>