 	<?php require_once 'menu.php'; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
</style>

<section class="hero">

    <div class="hero-text">

        <span class="tag">🎮 Bem-vindo ao GamerNac</span>

        <h1>O universo gamer começa aqui.</h1>

        <p>
            Encontre jogos, consoles, acessórios e tudo o que você precisa
            para elevar sua experiência no mundo dos games.
        </p>

        <div class="hero-buttons">

            <a href="produtos.php" class="hero-btn">
                Ver Produtos
            </a>
            <a href="jogos.php" class="hero-btn">
                Ver Jogos
            </a>


            <?php
            if(isset($_COOKIE['cliente'])){
            ?>

                <a href="perfil.php" class="hero-btn2">
                    Meu Perfil
                </a>

            <?php
            }else{
            ?>

                <a href="login.php" class="hero-btn2">
                    Entrar
                </a>

            <?php
            }
            ?>

        </div>

    </div>

    <div class="hero-image">

        <img src="img/icon.png" alt="Logo">

    </div>

</section>
<div class="carrossel-wrap">

  <div class="carrossel-header">
    <div>
      <span class="tag">Catálogo em destaque</span>
      <h2>Jogos mais procurados</h2>
    </div>
    <div class="carrossel-nav">
      <button type="button" onclick="deslizarCarrossel(-1)" aria-label="Anterior">‹</button>
      <button type="button" onclick="deslizarCarrossel(1)" aria-label="Próximo">›</button>
    </div>
  </div>

  <div class="carrossel-track-wrap">
  <div class="carrossel-zona carrossel-zona-voltar" onmouseenter="iniciarAutoScroll(-1)" onmouseleave="pararAutoScroll()" aria-hidden="true"></div>
  <div class="carrossel-zona carrossel-zona-avancar" onmouseenter="iniciarAutoScroll(1)" onmouseleave="pararAutoScroll()" aria-hidden="true"></div>

  <div class="carrossel-track" id="carrosselJogos">

    <div class="jogo-card">
      <div class="jogo-capa" style="background:linear-gradient(135deg,#5A1414,#2B0808);">
        <img src="img/bg-guerreiroo.png" alt="Resident Evil 4 Remake">
        <span class="jogo-desconto">-30% OFF</span>
      </div>
      <div class="jogo-corpo">
        <span class="jogo-plataforma">PlayStation 5</span>
        <h3 class="jogo-titulo">Resident Evil 4 Remake</h3>
        <p class="jogo-descricao">Jogo de horror de tiro em terceira pessoa, uma reimaginação completa do clássico da Capcom.</p>
        <span class="jogo-pontuacao">⭐ 9.2 <span>/ 10</span></span>
        <div class="jogo-precos">
          <span class="preco-antigo">R$ 250,00</span>
          <span class="preco-novo">R$ 175,00</span>
        </div>
        <div class="jogo-acoes">
          <button type="button" class="jogo-btn"
            onclick="comprarAgora('Resident Evil 4 Remake', 175.00, 'img/bg-guerreiro.png', 'Resident Evil 4 Remake é um jogo de horror de tiro em terceira pessoa disponível para PlayStation 5.')"><a href="checkout.php" class="jogo-btn" id="carrinho-finalizar">Comprar Agora</a></button>
          <button type="button" class="jogo-carrinho" title="Adicionar ao carrinho"
            onclick="adicionarCarrinho('Resident Evil 4 Remake', 175.00, this, 'img/bg-guerreiroo.png', 'Resident Evil 4 Remake é um jogo de horror de tiro em terceira pessoa disponível para PlayStation 5.')">🛒</button>
        </div>
      </div>
    </div>

    <div class="jogo-card">
      <div class="jogo-capa" style="background:linear-gradient(135deg,#1B2B4A,#0A1220);">
        <img src="img/godofwar.png" alt="God of War Ragnarök">
        <span class="jogo-desconto">-20% OFF</span>
      </div>
      <div class="jogo-corpo">
        <span class="jogo-plataforma">PlayStation 5</span>
        <h3 class="jogo-titulo">God of War Ragnarök</h3>
        <p class="jogo-descricao">Kratos e Atreus enfrentam os nove reinos em uma épica jornada de ação e aventura.</p>
        <span class="jogo-pontuacao">⭐ 9.6 <span>/ 10</span></span>
        <div class="jogo-precos">
          <span class="preco-antigo">R$ 300,00</span>
          <span class="preco-novo">R$ 240,00</span>
        </div>
        <div class="jogo-acoes">
          <button type="button" class="jogo-btn"
            onclick="comprarAgora('God of War Ragnarök', 240.00, 'img/godofwar.png', 'Kratos e Atreus enfrentam os nove reinos em uma épica jornada de ação e aventura disponível para PlayStation 5.')"><a href="checkout.php" class="jogo-btn" id="carrinho-finalizar">Comprar Agora</a></button>
          <button type="button" class="jogo-carrinho" title="Adicionar ao carrinho"
            onclick="adicionarCarrinho('God of War Ragnarök', 240.00, this, 'img/godofwar.png', 'Kratos e Atreus enfrentam os nove reinos em uma épica jornada de ação e aventura disponível para PlayStation 5.')">🛒</button>
        </div>
      </div>
    </div>

    <div class="jogo-card">
      <div class="jogo-capa" style="background:linear-gradient(135deg,#2B1B4A,#0F0A20);">
        <img src="img/eldenring.png" alt="Elden Ring">
        <span class="jogo-desconto">-15% OFF</span>
      </div>
      <div class="jogo-corpo">
        <span class="jogo-plataforma">PS5 · Xbox · PC</span>
        <h3 class="jogo-titulo">Elden Ring</h3>
        <p class="jogo-descricao">RPG de ação em mundo aberto criado pela FromSoftware em parceria com George R. R. Martin.</p>
        <span class="jogo-pontuacao">⭐ 9.5 <span>/ 10</span></span>
        <div class="jogo-precos">
          <span class="preco-antigo">R$ 280,00</span>
          <span class="preco-novo">R$ 238,00</span>
        </div>
        <div class="jogo-acoes">
          <button type="button" class="jogo-btn"
            onclick="comprarAgora('Elden Ring', 238.00, 'img/eldenring.png', 'RPG de ação em mundo aberto criado pela FromSoftware, disponível para PS5, Xbox e PC.')"><a href="checkout.php" class="jogo-btn" id="carrinho-finalizar">Comprar Agora</a></button>
          <button type="button" class="jogo-carrinho" title="Adicionar ao carrinho"
            onclick="adicionarCarrinho('Elden Ring', 238.00, this, 'img/eldenring.png', 'RPG de ação em mundo aberto criado pela FromSoftware, disponível para PS5, Xbox e PC.')">🛒</button>
        </div>
      </div>
    </div>

    <div class="jogo-card">
      <div class="jogo-capa" style="background:linear-gradient(135deg,#1A2E22,#081209);">
        <img src="img/lastofus.png" alt="The Last of Us Part I">
        <span class="jogo-desconto">-25% OFF</span>
      </div>
      <div class="jogo-corpo">
        <span class="jogo-plataforma">PlayStation 5</span>
        <h3 class="jogo-titulo">The Last of Us Part I</h3>
        <p class="jogo-descricao">Joel e Ellie atravessam os EUA pós-apocalíptico nesta refeitura visual do clássico da Naughty Dog.</p>
        <span class="jogo-pontuacao">⭐ 9.3 <span>/ 10</span></span>
        <div class="jogo-precos">
          <span class="preco-antigo">R$ 260,00</span>
          <span class="preco-novo">R$ 195,00</span>
        </div>
        <div class="jogo-acoes">
          <button type="button" class="jogo-btn"
            onclick="comprarAgora('The Last of Us Part I', 195.00, 'img/lastofus.png', 'Joel e Ellie atravessam os EUA pós-apocalíptico nesta refeitura visual do clássico da Naughty Dog, disponível para PlayStation 5.')"><a href="checkout.php" class="jogo-btn" id="carrinho-finalizar">Comprar Agora</a></button>
          <button type="button" class="jogo-carrinho" title="Adicionar ao carrinho"
            onclick="adicionarCarrinho('The Last of Us Part I', 195.00, this, 'img/lastofus.png', 'Joel e Ellie atravessam os EUA pós-apocalíptico nesta refeitura visual do clássico da Naughty Dog, disponível para PlayStation 5.')">🛒</button>
        </div>
      </div>
    </div>

    <div class="jogo-card">
      <div class="jogo-capa" style="background:linear-gradient(135deg,#4A1B3A,#200A18);">
        <img src="img/spiderman2.png" alt="Marvel's Spider-Man 2">
        <span class="jogo-desconto">-10% OFF</span>
      </div>
      <div class="jogo-corpo">
        <span class="jogo-plataforma">PlayStation 5</span>
        <h3 class="jogo-titulo">Marvel's Spider-Man 2</h3>
        <p class="jogo-descricao">Peter Parker e Miles Morales dividem Nova York contra vilões clássicos do universo Marvel.</p>
        <span class="jogo-pontuacao">⭐ 9.1 <span>/ 10</span></span>
        <div class="jogo-precos">
          <span class="preco-antigo">R$ 320,00</span>
          <span class="preco-novo">R$ 288,00</span>
        </div>
        <div class="jogo-acoes">
          <button type="button" class="jogo-btn"
            onclick="comprarAgora('Marvel´s Spider-Man 2', 288.00, 'img/spiderman2.png', 'Peter Parker e Miles Morales dividem Nova York contra vilões clássicos do universo Marvel, disponível para PlayStation 5.')"><a href="checkout.php" class="jogo-btn" id="carrinho-finalizar">Comprar Agora</a></button>
          <button type="button" class="jogo-carrinho" title="Adicionar ao carrinho"
            onclick="adicionarCarrinho('Marvel´s Spider-Man 2', 288.00, this, 'img/spiderman2.png', 'Peter Parker e Miles Morales dividem Nova York contra vilões clássicos do universo Marvel, disponível para PlayStation 5.')">🛒</button>
        </div>
      </div>
    </div>

    <div class="jogo-card">
      <div class="jogo-capa" style="background:linear-gradient(135deg,#1A3A3A,#081818);">
        <img src="img/horizon.png" alt="Horizon Forbidden West">
        <span class="jogo-desconto">-20% OFF</span>
      </div>
      <div class="jogo-corpo">
        <span class="jogo-plataforma">PlayStation 5</span>
        <h3 class="jogo-titulo">Horizon Forbidden West</h3>
        <p class="jogo-descricao">Aloy explora terras selvagens dominadas por máquinas em um mundo aberto pós-apocalíptico.</p>
        <span class="jogo-pontuacao">⭐ 9.0 <span>/ 10</span></span>
        <div class="jogo-precos">
          <span class="preco-antigo">R$ 270,00</span>
          <span class="preco-novo">R$ 216,00</span>
        </div>
        <div class="jogo-acoes">
          <button type="button" class="jogo-btn"
            onclick="comprarAgora('Horizon Forbidden West', 216.00, 'img/horizon.png', 'Aloy explora terras selvagens dominadas por máquinas em um mundo aberto pós-apocalíptico, disponível para PlayStation 5.')"><a href="checkout.php" class="jogo-btn" id="carrinho-finalizar">Comprar Agora</a></button>
          <button type="button" class="jogo-carrinho" title="Adicionar ao carrinho"
            onclick="adicionarCarrinho('Horizon Forbidden West', 216.00, this, 'img/horizon.png', 'Aloy explora terras selvagens dominadas por máquinas em um mundo aberto pós-apocalíptico, disponível para PlayStation 5.')">🛒</button>
        </div>
      </div>
    </div>

  </div>
  </div>

</div>

<script>
var clienteLogado = <?php echo isset($_COOKIE['cliente']) ? 'true' : 'false'; ?>;

function comprarAgora(nome, preco, imagem, descricao){
  adicionarCarrinho(nome, preco, null, imagem, descricao);
  window.location.href = clienteLogado ? 'checkout.php' : 'logarcadastrar.php';
}

function deslizarCarrossel(direcao){
  var trilha = document.getElementById('carrosselJogos');
  var card = trilha.querySelector('.jogo-card');
  var passo = card.getBoundingClientRect().width + 20;
  trilha.scrollBy({ left: passo * direcao, behavior: 'smooth' });
}

var autoScrollId = null;

function iniciarAutoScroll(direcao){
  var trilha = document.getElementById('carrosselJogos');
  pararAutoScroll();
  autoScrollId = setInterval(function(){
    trilha.scrollLeft += direcao * 6;
  }, 16);
}

function pararAutoScroll(){
  if(autoScrollId){
    clearInterval(autoScrollId);
    autoScrollId = null;
  }
}
</script>

<section class="cards-home">

    <a href="listarjogo.php" class="home-card">

        <div class="icone"><img src="img/jogo.png" class="iconeshome"></div>

        <h2>Jogos</h2>

        <p>
            Catálogo completo com os melhores títulos.
        </p>

    </a>

    <a href="listarproduto.php?tipo=tipo&termo=Consoles" class="home-card">

        <div class="icone"><img src="img/console.png" class="iconeshome"></div>

        <h2>Consoles</h2>

        <p>
            Playstation, Xbox, Nintendo e muito mais.
        </p>

    </a>

    <a href="listarproduto.php?tipo=tipo&termo=Acessórios" class="home-card">

        <div class="icone"><img src="img/controle.png" class="iconeshome"></div>

        <h2>Acessórios</h2>

        <p>
            Monte o setup gamer perfeito.
        </p>

    </a>

</section>
<?php include 'rodape.php'; ?>
</body>
</html>