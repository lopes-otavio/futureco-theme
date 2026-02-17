<?php
/**
 * Hero Section
 * @package FutureCO
 */
?>
<?php
$hero = get_field('hero_section');
$titulo = $hero['titulo'] ?? 'Transforme sua presença digital em resultados reais';
$descricao = $hero['descricao'] ?? 'Somos uma agência de marketing digital 360° especializada em criar estratégias que conectam marcas ao seu público e geram crescimento sustentável.';
$background = $hero['background'] ?? futureco_image('futureco-hero-bg.png');
?>
<section class="hero-section" id="hero">
  <!-- Background -->
  <div class="hero-bg" style="background-image:url('<?php echo esc_url($background); ?>');">
  </div>
  <div class="hero-overlay"></div>

  <!-- Decorative Elements -->
  <div class="hero-decorative-1"></div>
  <div class="hero-decorative-2"></div>

  <!-- Content -->
  <div class="container">
    <div class="hero-content">
      <!-- Badge -->
      <div class="hero-badge scroll-animate">
        <span class="dot"></span>
        <span>Transformando ideias ousadas em realidades</span>
      </div>

      <!-- Title -->
      <h1 class="hero-title scroll-animate delay-100">
        <?php echo $titulo; ?>
      </h1>

      <!-- Subtitle -->
      <p class="hero-subtitle scroll-animate delay-200">
        <?php echo esc_html($descricao); ?>
      </p>

      <!-- Buttons -->
      <div class="hero-buttons scroll-animate delay-300">
        <a href="#contato" class="btn-primary">
          Comece Agora
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12" />
            <polyline points="12 5 19 12 12 19" />
          </svg>
        </a>
        <a href="#servicos" class="btn-outline">
          Nossos Serviços
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9" />
          </svg>
        </a>
      </div>

      <!-- Trust Badges -->
      <!-- <div class="trust-badges scroll-animate delay-400">
        <div class="trust-badge">
          <img src="<?php echo futureco_image('logo-google-ads.png'); ?>" alt="Google Partner">
          <div class="badge-text">
            <p>Google Partner</p>
            <p>Certificado</p>
          </div>
        </div>
        <div class="trust-badge">
          <img src="<?php echo futureco_image('logo-reviewed.png'); ?>" alt="Top Rated">
          <div class="badge-text">
            <p>Top Rated</p>
            <p>5 estrelas</p>
          </div>
        </div>
      </div> -->
    </div>
  </div>

  <!-- Scroll Indicator -->
  <div class="scroll-indicator">
    <div class="mouse">
      <div class="mouse-dot"></div>
    </div>
  </div>
</section>