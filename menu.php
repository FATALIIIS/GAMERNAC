<?php require_once 'cabecalho.php'; 
ob_start();
?>
<body class="background">
<div id="bg-reveal"></div>
<div id="bg-mask"></div>
<section class="topo">
	<div id="logo">
		<a href="index.php">
			<img src="img/icon.png">
		</a>
	</div>
	<form class="busca-form" action="buscar.php" method="GET" id="busca-form" autocomplete="off">
		<input type="text" name="termo" id="busca-input" placeholder="Buscar jogos ou produtos..." value="<?= isset($_GET['termo']) ? htmlspecialchars($_GET['termo']) : '' ?>" required>
		<button type="submit" aria-label="Buscar">🔍</button>
	</form>
	<div class="topo-direita">
		<a href="carrinho.php" id="link-carrinho" aria-label="Carrinho">
			🛒
			<span id="carrinho-contador">0</span>
		</a>
		<?php if (isset($_COOKIE['cliente'])) { ?>
			<a href="logoffcliente.php" id="link-sair" aria-label="Sair da conta" title="Sair da conta">🚪</a>
		<?php } ?>
		<button id="menu-hamb" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu-lateral">
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>
</section>

<div id="busca-overlay">
	<div class="busca-overlay-caixa">
		<div class="busca-overlay-topo">
			<span class="busca-overlay-icone">🔍</span>
			<input type="text" id="busca-overlay-input" placeholder="Buscar jogos ou produtos..." autocomplete="off">
			<button type="button" id="busca-overlay-fechar" aria-label="Fechar busca">✕</button>
		</div>

		<div class="busca-overlay-categorias" id="busca-overlay-categorias">
			<span class="busca-overlay-label">Categorias</span>
			<div class="busca-overlay-chips">
				<a href="listarjogo.php?tipo=tipo&termo=Plataforma&valor=Playstation" target="janela" class="busca-chip">🎮 PlayStation</a>
				<a href="listarjogo.php?tipo=tipo&termo=Plataforma&valor=Xbox" target="janela" class="busca-chip">🎮 Xbox</a>
				<a href="listarproduto.php?tipo=tipo&termo=Consoles" target="janela" class="busca-chip">🕹️ Consoles</a>
				<a href="listarproduto.php?tipo=tipo&termo=Periféricos" target="janela" class="busca-chip">🎧 Periféricos</a>
				<a href="listarproduto.php?tipo=tipo&termo=Acessórios" target="janela" class="busca-chip">🔌 Acessórios</a>
				<a href="listarproduto.php?tipo=tipo&termo=GiftCard" target="janela" class="busca-chip">💳 GiftCards</a>
			</div>
		</div>

		<div class="busca-overlay-resultados" id="busca-overlay-resultados"></div>
	</div>
</div>

<div id="menu-overlay"></div>

<nav id="menu-lateral" aria-hidden="true">
	<?php if (isset($_COOKIE['cliente'])) {
		require_once 'persistence/ClientePA.php';
		$clientepa_menu=new ClientePA();
		$linha_menu=$clientepa_menu->buscarporcod($_COOKIE['cliente'])->fetch_assoc();
		$avatar_menu=!empty($linha_menu['avatar']) ? $linha_menu['avatar'] : 'avatar1.svg';
		$nome_menu=$linha_menu['nome'];
	?>
		<div class="menu-boasvindas">
			<img src="img/avatares/<?= $avatar_menu ?>" alt="Avatar" class="menu-boasvindas-avatar">
			<div class="menu-boasvindas-texto">
				<span class="menu-boasvindas-saudacao">Seja Bem-Vindo!</span>
				<span class="menu-boasvindas-nome"><?= htmlspecialchars($nome_menu) ?></span>
			</div>
		</div>
	<?php } ?>
	<ul class="nav-lateral">
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">Todos os Produtos</span>
			<ol>
				<li><a href="listarproduto.php?tipo=tipo&termo=GiftCard" target="janela">PC - GiftCards</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Consoles&valor=Playstation" target="janela">PlayStation</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Consoles&valor=Xbox" target="janela">Xbox</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">PlayStation</span>
			<ol>
				<li><a href="listarjogo.php?tipo=plataforma&termo=Playstation" target="janela">Jogos</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Consoles&valor=Playstation" target="janela">Consoles</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Periféricos&valor=Playstation" target="janela">Perífericos</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Acessórios&valor=Playstation" target="janela">Acessórios</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">Xbox</span>
			<ol>
				<li><a href="listarjogo.php?tipo=plataforma&termo=Xbox" target="janela">Jogos</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Consoles&valor=Xbox" target="janela">Consoles</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Periféricos&valor=Xbox" target="janela">Perífericos</a></li>
				<li><a href="listarproduto.php?tipo=tipo&termo=Acessórios&valor=Xbox" target="janela">Acessórios</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item nav-lateral-simples">
			<a href="sobre.php" target="janela">Sobre</a>
		</li>
		<?php if (!isset($_COOKIE['cliente'])) { ?>
			<li class="nav-lateral-item nav-lateral-simples">
				<a href="logarcadastrar.php" target="janela" id="logar-menu">Logar</a>
			</li>
		<?php } else { ?>
			<li class="nav-lateral-item">
				<span class="nav-lateral-titulo nav-lateral-titulo-cliente">
					<img src="img/avatares/<?= $avatar_menu ?>" alt="Avatar" class="nav-avatar">
					Cliente
				</span>
				<ol>
					<li><a href="alterarcliente.php">Alterar</a></li>
					<li><a href="logoffcliente.php">Sair</a></li>
				</ol>
			</li>
		<?php } ?>
	</ul>
</nav>

<script>
(function () {
	var botao = document.getElementById('menu-hamb');
	var menu = document.getElementById('menu-lateral');
	var overlay = document.getElementById('menu-overlay');

	function abrirMenu() {
		menu.classList.add('aberto');
		overlay.classList.add('ativo');
		botao.classList.add('ativo');
		botao.setAttribute('aria-expanded', 'true');
		menu.setAttribute('aria-hidden', 'false');
	}

	function fecharMenu() {
		menu.classList.remove('aberto');
		overlay.classList.remove('ativo');
		botao.classList.remove('ativo');
		botao.setAttribute('aria-expanded', 'false');
		menu.setAttribute('aria-hidden', 'true');
	}

	botao.addEventListener('click', function () {
		if (menu.classList.contains('aberto')) {
			fecharMenu();
		} else {
			abrirMenu();
		}
	});

	overlay.addEventListener('click', fecharMenu);

	document.querySelectorAll('.nav-lateral-titulo').forEach(function (titulo) {
		titulo.addEventListener('click', function () {
			titulo.parentElement.classList.toggle('aberto');
		});
	});
})();

(function () {
	var mask = document.getElementById('bg-mask');
	if (!mask) return;
	var raio = 220;

	function mover(x, y) {
		mask.style.setProperty('--mx', x + 'px');
		mask.style.setProperty('--my', y + 'px');
	}

	window.addEventListener('mousemove', function (e) {
		mover(e.clientX, e.clientY);
	});

	window.addEventListener('touchmove', function (e) {
		if (e.touches && e.touches[0]) {
			mover(e.touches[0].clientX, e.touches[0].clientY);
		}
	}, { passive: true });
})();

(function () {
	var inputTopo = document.getElementById('busca-input');
	var overlay = document.getElementById('busca-overlay');
	var inputOverlay = document.getElementById('busca-overlay-input');
	var botaoFechar = document.getElementById('busca-overlay-fechar');
	var categorias = document.getElementById('busca-overlay-categorias');
	var resultados = document.getElementById('busca-overlay-resultados');
	if (!inputTopo || !overlay) return;

	var temporizador = null;

	function abrirBusca() {
		overlay.classList.add('ativo');
		document.body.classList.add('busca-travada');
		inputOverlay.value = inputTopo.value;
		setTimeout(function () { inputOverlay.focus(); }, 50);
		if (inputOverlay.value.trim() !== '') {
			buscar(inputOverlay.value.trim());
		}
	}

	function fecharBusca() {
		overlay.classList.remove('ativo');
		document.body.classList.remove('busca-travada');
	}

	function escaparHtml(texto) {
		var div = document.createElement('div');
		div.textContent = texto || '';
		return div.innerHTML;
	}

	function montarLinhaJogo(jogo) {
		var icone = jogo.capa
			? '<img src="' + jogo.capa + '" alt="' + escaparHtml(jogo.nome) + '">'
			: '<span class="busca-overlay-sem-icone">🎮</span>';
		return '<a class="busca-overlay-item" href="buscar.php?termo=' + encodeURIComponent(jogo.nome) + '&filtro=jogos">' +
			'<span class="busca-overlay-item-icone">' + icone + '</span>' +
			'<span class="busca-overlay-item-info">' +
			'<span class="busca-overlay-item-nome">' + escaparHtml(jogo.nome) + '</span>' +
			'<span class="busca-overlay-item-detalhe">' + escaparHtml(jogo.plataforma) + '</span>' +
			'</span>' +
			'<span class="busca-overlay-item-preco">R$ ' + jogo.valor + '</span>' +
			'</a>';
	}

	function montarLinhaProduto(produto) {
		var icone = produto.imagem
			? '<img src="' + produto.imagem + '" alt="' + escaparHtml(produto.nome) + '">'
			: '<span class="busca-overlay-sem-icone">🕹️</span>';
		return '<a class="busca-overlay-item" href="buscar.php?termo=' + encodeURIComponent(produto.nome) + '&filtro=produtos">' +
			'<span class="busca-overlay-item-icone">' + icone + '</span>' +
			'<span class="busca-overlay-item-info">' +
			'<span class="busca-overlay-item-nome">' + escaparHtml(produto.nome) + '</span>' +
			'<span class="busca-overlay-item-detalhe">' + escaparHtml(produto.tipo) + '</span>' +
			'</span>' +
			'<span class="busca-overlay-item-preco">R$ ' + produto.valor + '</span>' +
			'</a>';
	}

	function buscar(termo) {
		fetch('buscarapi.php?termo=' + encodeURIComponent(termo))
			.then(function (r) { return r.json(); })
			.then(function (dados) {
				var jogos = dados.jogos || [];
				var produtos = dados.produtos || [];

				if (jogos.length === 0 && produtos.length === 0) {
					resultados.innerHTML = '<p class="busca-overlay-vazio">Nenhum resultado para "' + escaparHtml(termo) + '"</p>';
					resultados.classList.add('ativo');
					return;
				}

				var html = '';
				if (jogos.length > 0) {
					html += '<span class="busca-overlay-label">Jogos</span>';
					jogos.forEach(function (jogo) { html += montarLinhaJogo(jogo); });
				}
				if (produtos.length > 0) {
					html += '<span class="busca-overlay-label">Produtos</span>';
					produtos.forEach(function (produto) { html += montarLinhaProduto(produto); });
				}
				resultados.innerHTML = html;
				resultados.classList.add('ativo');
			})
			.catch(function () {});
	}

	inputTopo.setAttribute('readonly', 'readonly');

	inputTopo.addEventListener('click', function (e) {
		e.preventDefault();
		abrirBusca();
	});

	botaoFechar.addEventListener('click', fecharBusca);

	overlay.addEventListener('click', function (e) {
		if (e.target === overlay) fecharBusca();
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && overlay.classList.contains('ativo')) fecharBusca();
	});

	inputOverlay.addEventListener('input', function () {
		var termo = inputOverlay.value.trim();
		inputTopo.value = inputOverlay.value;
		clearTimeout(temporizador);

		if (termo === '') {
			resultados.classList.remove('ativo');
			resultados.innerHTML = '';
			categorias.classList.remove('escondido');
			return;
		}

		categorias.classList.add('escondido');
		temporizador = setTimeout(function () { buscar(termo); }, 300);
	});

	inputOverlay.addEventListener('keydown', function (e) {
		if (e.key === 'Enter') {
			e.preventDefault();
			if (inputOverlay.value.trim() !== '') {
				window.location.href = 'buscar.php?termo=' + encodeURIComponent(inputOverlay.value.trim());
			}
		}
	});
})();

(function () {
	var contador = document.getElementById('carrinho-contador');
	if (!contador) return;
	var carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
	contador.textContent = carrinho.length;
	contador.style.display = carrinho.length > 0 ? 'flex' : 'none';
})();

function adicionarCarrinho(nome, preco, botao, imagem, descricao) {
	var carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
	carrinho.push({
		nome: nome,
		preco: preco,
		imagem: imagem || '',
		descricao: descricao || ''
	});
	localStorage.setItem('carrinho', JSON.stringify(carrinho));

	var contador = document.getElementById('carrinho-contador');
	if (contador) {
		contador.textContent = carrinho.length;
		contador.style.display = 'flex';
	}

	var textoOriginal = botao.textContent;
	var somenteIcone = botao.classList.contains('jogo-banner-carrinho');
	botao.textContent = somenteIcone ? '✔' : '✔ Adicionado';
	botao.classList.add('adicionado');
	setTimeout(function () {
		botao.textContent = textoOriginal;
		botao.classList.remove('adicionado');
	}, 1200);
}
</script>
</body>
</html>