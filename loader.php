<?php
/**
 * Loader / Preloader do site
 * -----------------------------------------------
 * Como usar:
 *   1) Salve este arquivo como loader.php
 *   2) No topo de cada página, logo após <body>, faça:
 *        <?php include 'loader.php'; ?>
 *   3) Quando a página terminar de carregar, o próprio script
 *      abaixo esconde o loader automaticamente (evento "load").
 *      O loader fica visível por no mínimo 2 segundos, mesmo que
 *      a página carregue mais rápido que isso (ajuste no JS abaixo,
 *      constante MIN_DISPLAY_MS).
 *      Se preferir esconder manualmente via JS em outro ponto,
 *      use: document.getElementById('site-loader').classList.add('loader-hidden');
 *
 * A imagem do logo fica no arquivo /assets/icon.png (ajuste o
 * caminho na constante LOADER_LOGO_PATH abaixo). Ela é lida do
 * disco e embutida em base64 automaticamente.
 */

// Caminho para a imagem do logo (ajuste conforme a estrutura do seu site)
define('LOADER_LOGO_PATH', __DIR__ . '/img/loader-icon.png');

function loader_get_logo_base64($path)
{
    if (!is_file($path)) {
        return '';
    }
    $data = file_get_contents($path);
    return $data !== false ? base64_encode($data) : '';
}

$loaderLogoBase64 = loader_get_logo_base64(LOADER_LOGO_PATH);
?>
<style>
  :root{
    --loader-cyan:#0EC1F0;
    --loader-blue:#5B7CF0;
    --loader-purple:#9B4FE0;
    --loader-magenta:#D93BC9;
    --loader-pink:#F72FA0;
    --loader-bg:#0A0A12;
  }

  #site-loader{
    position:fixed;
    inset:0;
    z-index:99999;
    display:flex;
    align-items:center;
    justify-content:center;
    background:var(--loader-bg);
    transition:opacity 0.5s ease, visibility 0.5s ease;
    opacity:1;
    visibility:visible;
  }

  #site-loader.loader-hidden{
    opacity:0;
    visibility:hidden;
    pointer-events:none;
  }

  .loader-wrap{
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:28px;
  }

  .loader-halo{
    position:absolute;
    top:50%;
    left:50%;
    width:260px;
    height:260px;
    transform:translate(-50%,-70%);
    background:radial-gradient(circle, rgba(155,79,224,0.35) 0%, rgba(14,193,240,0.12) 45%, transparent 70%);
    filter:blur(10px);
    animation:loaderPulse 2.4s ease-in-out infinite;
    pointer-events:none;
  }

  @keyframes loaderPulse{
    0%,100%{ opacity:0.55; transform:translate(-50%,-70%) scale(0.92); }
    50%{ opacity:1; transform:translate(-50%,-70%) scale(1.08); }
  }

  .loader-badge{
    position:relative;
    width:150px;
    height:150px;
    border-radius:32px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(255,255,255,0.02);
  }

  .loader-ring{
    position:absolute;
    inset:0;
    border-radius:50%;
  }

  .loader-ring::before{
    content:"";
    position:absolute;
    inset:0;
    border-radius:50%;
    padding:3px;
    background:conic-gradient(from 0deg,
      var(--loader-cyan) 0deg,
      var(--loader-blue) 90deg,
      var(--loader-purple) 150deg,
      var(--loader-magenta) 220deg,
      var(--loader-pink) 280deg,
      transparent 330deg,
      transparent 360deg
    );
    -webkit-mask:
      linear-gradient(#000 0 0) content-box,
      linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
            mask-composite: exclude;
    animation:loaderSpin 1.4s linear infinite !important;
  }

  @keyframes loaderSpin{
    to{ transform:rotate(360deg); }
  }

  .loader-logo{
    width:78px;
    height:78px;
    object-fit:contain;
    filter:drop-shadow(0 0 14px rgba(155,79,224,0.55));
    animation:loaderBreathe 1s ease-in-out infinite !important;
  }

  @keyframes loaderBreathe{
    0%,100%{ transform:scale(1) rotate(0deg); }
    50%{ transform:scale(1.18) rotate(-4deg); }
  }

  .loader-label{
    display:flex;
    align-items:center;
    gap:10px;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
    font-size:13px;
    letter-spacing:0.28em;
    text-transform:uppercase;
    font-weight:600;
    background:linear-gradient(90deg,var(--loader-cyan),var(--loader-purple) 50%,var(--loader-pink));
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
  }

  .loader-dots span{
    display:inline-block;
    width:5px;
    height:5px;
    margin-left:3px;
    border-radius:50%;
    animation:loaderBlink 1.2s infinite ease-in-out !important;
  }
  .loader-dots span:nth-child(1){ background:var(--loader-cyan); animation-delay:0s; }
  .loader-dots span:nth-child(2){ background:var(--loader-purple); animation-delay:0.2s; }
  .loader-dots span:nth-child(3){ background:var(--loader-pink); animation-delay:0.4s; }

  @keyframes loaderBlink{
    0%,80%,100%{ opacity:0.25; transform:translateY(0) scale(1); }
    40%{ opacity:1; transform:translateY(-6px) scale(1.3); }
  }

  @media (prefers-reduced-motion: reduce){
    .loader-halo{ animation:none; }
  }
</style>

<div id="site-loader">
  <div class="loader-wrap">
    <div class="loader-halo"></div>
    <div class="loader-badge">
      <div class="loader-ring"></div>
      <?php if ($loaderLogoBase64 !== ''): ?>
        <img class="loader-logo" src="data:image/png;base64,<?php echo $loaderLogoBase64; ?>" alt="Logo">
      <?php else: ?>
        <!-- Imagem não encontrada em LOADER_LOGO_PATH; ajuste o caminho no topo do arquivo -->
      <?php endif; ?>
    </div>
    <div class="loader-label">Carregando<span class="loader-dots"><span></span><span></span><span></span></span></div>
  </div>
</div>

<script>
  // Duração mínima do loader na tela (em milissegundos)
  var MIN_DISPLAY_MS = 2000;
  var loaderStartTime = Date.now();

  function hideLoader() {
    var loader = document.getElementById('site-loader');
    if (loader) {
      loader.classList.add('loader-hidden');
      // remove do DOM depois da transição, para não atrapalhar cliques
      setTimeout(function () {
        loader.remove();
      }, 600);
    }
  }

  // Esconde o loader quando a página terminar de carregar,
  // respeitando a duração mínima definida acima
  window.addEventListener('load', function () {
    var elapsed = Date.now() - loaderStartTime;
    var remaining = Math.max(0, MIN_DISPLAY_MS - elapsed);
    setTimeout(hideLoader, remaining);
  });
</script>
