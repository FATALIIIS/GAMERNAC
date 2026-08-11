<?php
/**
 * loader2.php - SEGUNDO loader do site (independente do loader.php original)
 * -----------------------------------------------
 * Este arquivo NÃO substitui o loader.php existente. Todos os IDs, classes
 * e nomes de função foram prefixados com "loader2" para não haver conflito
 * de CSS/JS com o loader original (#loader, .loader-content, etc).
 *
 * Como usar:
 *   <?php include 'loader2.php'; ?>
 *
 * A logo usada é /img/icon2.png (lida do disco e embutida em base64).
 */

define('LOADER2_LOGO_PATH', __DIR__ . '/img/icon2.png');

function loader2_get_logo_base64(string $path): string
{
    if (!is_file($path)) {
        return '';
    }
    $data = file_get_contents($path);
    return $data !== false ? base64_encode($data) : '';
}

$loader2LogoBase64 = loader2_get_logo_base64(LOADER2_LOGO_PATH);
?>
<style>
  :root{
    --loader2-cyan:#0EC1F0;
    --loader2-blue:#5B7CF0;
    --loader2-purple:#9B4FE0;
    --loader2-magenta:#D93BC9;
    --loader2-pink:#F72FA0;
    --loader2-bg:#0A0A12;
  }

  #site-loader2{
    position:fixed;
    inset:0;
    z-index:99999;
    display:flex;
    align-items:center;
    justify-content:center;
    background:var(--loader2-bg);
    transition:opacity 0.5s ease, visibility 0.5s ease;
    opacity:1;
    visibility:visible;
  }

  #site-loader2.loader2-hidden{
    opacity:0;
    visibility:hidden;
    pointer-events:none;
  }

  .loader2-wrap{
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:28px;
  }

  .loader2-halo{
    position:absolute;
    top:50%;
    left:50%;
    width:260px;
    height:260px;
    transform:translate(-50%,-70%);
    background:radial-gradient(circle, rgba(155,79,224,0.35) 0%, rgba(14,193,240,0.12) 45%, transparent 70%);
    filter:blur(10px);
    animation:loader2Pulse 2.4s ease-in-out infinite;
    pointer-events:none;
  }

  @keyframes loader2Pulse{
    0%,100%{ opacity:0.55; transform:translate(-50%,-70%) scale(0.92); }
    50%{ opacity:1; transform:translate(-50%,-70%) scale(1.08); }
  }

  .loader2-badge{
    position:relative;
    width:150px;
    height:150px;
    border-radius:32px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(255,255,255,0.02);
  }

  .loader2-ring{
    position:absolute;
    inset:0;
    border-radius:50%;
  }

  .loader2-ring::before{
    content:"";
    position:absolute;
    inset:0;
    border-radius:50%;
    padding:3px;
    background:conic-gradient(from 0deg,
      var(--loader2-cyan) 0deg,
      var(--loader2-blue) 90deg,
      var(--loader2-purple) 150deg,
      var(--loader2-magenta) 220deg,
      var(--loader2-pink) 280deg,
      transparent 330deg,
      transparent 360deg
    );
    -webkit-mask:
      linear-gradient(#000 0 0) content-box,
      linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
            mask-composite: exclude;
    animation:loader2Spin 1.4s linear infinite;
  }

  @keyframes loader2Spin{
    to{ transform:rotate(360deg); }
  }

  .loader2-logo{
    width:78px;
    height:78px;
    object-fit:contain;
    filter:drop-shadow(0 0 14px rgba(155,79,224,0.55));
    animation:loader2Breathe 2.4s ease-in-out infinite;
  }

  @keyframes loader2Breathe{
    0%,100%{ transform:scale(1); }
    50%{ transform:scale(1.06); }
  }

  .loader2-label{
    display:flex;
    align-items:center;
    gap:10px;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
    font-size:13px;
    letter-spacing:0.28em;
    text-transform:uppercase;
    font-weight:600;
    background:linear-gradient(90deg,var(--loader2-cyan),var(--loader2-purple) 50%,var(--loader2-pink));
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
  }

  .loader2-dots span{
    display:inline-block;
    width:5px;
    height:5px;
    margin-left:3px;
    border-radius:50%;
    animation:loader2Blink 1.2s infinite ease-in-out;
  }
  .loader2-dots span:nth-child(1){ background:var(--loader2-cyan); animation-delay:0s; }
  .loader2-dots span:nth-child(2){ background:var(--loader2-purple); animation-delay:0.2s; }
  .loader2-dots span:nth-child(3){ background:var(--loader2-pink); animation-delay:0.4s; }

  @keyframes loader2Blink{
    0%,80%,100%{ opacity:0.25; transform:translateY(0); }
    40%{ opacity:1; transform:translateY(-3px); }
  }

  @media (prefers-reduced-motion: reduce){
    .loader2-ring::before, .loader2-logo, .loader2-halo, .loader2-dots span{ animation:none; }
  }
</style>

<div id="site-loader2">
  <div class="loader2-wrap">
    <div class="loader2-halo"></div>
    <div class="loader2-badge">
      <div class="loader2-ring"></div>
      <?php if ($loader2LogoBase64 !== ''): ?>
        <img class="loader2-logo" src="data:image/png;base64,<?php echo $loader2LogoBase64; ?>" alt="Logo">
      <?php else: ?>
        <!-- Imagem não encontrada em LOADER2_LOGO_PATH; ajuste o caminho no topo do arquivo -->
      <?php endif; ?>
    </div>
    <div class="loader2-label">Carregando<span class="loader2-dots"><span></span><span></span><span></span></span></div>
  </div>
</div>

<script>
  window.addEventListener('load', function () {
    var loader2 = document.getElementById('site-loader2');
    if (loader2) {
      loader2.classList.add('loader2-hidden');
      setTimeout(function () {
        loader2.remove();
      }, 600);
    }
  });
</script>
