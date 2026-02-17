<?php
/**
 * FAQ Section
 * @package FutureCO
 */
?>
<?php
$faq_group = get_field('faq_section');
$titulo = $faq_group['titulo'] ?? 'Perguntas <span class="text-gradient">Frequentes</span>';
$descricao = $faq_group['descricao'] ?? 'Tire suas dúvidas sobre nossos serviços e metodologia de trabalho.';
$faqs = $faq_group['perguntas'] ?? array();

// New fields
$imagem = $faq_group['imagem'] ?? '';
$texto_funcionario = $faq_group['texto_funcionario'] ?? '';
$link_botao = $faq_group['link_botao'] ?? '#contato';
?>

<section class="faq-section section-padding" id="faq">
  <div class="container">
    <!-- Header moved to Top -->
    <div class="section-header scroll-animate">
      <p class="section-label" style="color:rgba(255,255,255,0.5);">FAQ</p>
      <h2 class="section-title" style="color:#fff;">
        <?php echo $titulo; ?>
      </h2>
      <p class="section-description" style="color:rgba(255,255,255,0.6); margin: 0 auto;">
        <?php echo esc_html($descricao); ?>
      </p>
    </div>

    <div class="faq-grid">
      <!-- Left Side - Employee/Contact Card -->
      <div class="faq-employee scroll-animate">
        <div class="employee-card">
          <?php if ($imagem) : ?>
          <div class="employee-image">
            <img src="<?php echo esc_url($imagem); ?>" alt="Veronica">
          </div>
          <?php endif; ?>

          <div class="employee-info text-center">
            <p class="employee-text">
              <?php echo nl2br($texto_funcionario); ?>
            </p>

            <a href="<?php echo esc_url($link_botao); ?>" class="btn-faq-ask" target="_blank">
              <span>Faça uma pergunta</span>
              <div class="btn-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M20 2H4C2.9 2 2 2.9 2 4V22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H5.17L4 17.17V4H20V16ZM7 9H17V11H7V9ZM7 12H14V14H7V12ZM7 6H17V8H7V6Z" />
                </svg>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Right Side - FAQ Items -->
      <div class="faq-list scroll-animate delay-200">
        <?php if ($faqs) : foreach ($faqs as $index => $faq): ?>
        <div class="faq-item" data-faq="<?php echo $index; ?>">
          <button class="faq-question" onclick="toggleFaq(this)">
            <?php echo esc_html($faq['pergunta']); ?>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>
          <div class="faq-answer">
            <p><?php echo esc_html($faq['resposta']); ?></p>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
</section>