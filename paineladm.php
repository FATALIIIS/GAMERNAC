<?php
if (!isset($_COOKIE['administrador'])) {
	header('Location:administracao.php');
	exit();
}
require_once 'cabecalho.php';
?>
<body class="background">
<div id="bg-reveal"></div>
<div id="bg-mask"></div>
<section class="topo">
	<div id="logo">
		<a href="inicioadm.php">
			<img src="img/icon.png">
		</a>
	</div>
	<div class="topo-direita">
		<button id="menu-hamb" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu-lateral">
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>
</section>

<div id="menu-overlay"></div>

<nav id="menu-lateral" aria-hidden="true">
	<ul class="nav-lateral">
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">Funcionários</span>
			<ol>
				<li><a href="cadastrofuncionario.php">Cadastrar</a></li>
				<li><a href="alterafuncionario.php">Alterar</a></li>
				<li><a href="excluifuncionario.php">Excluir</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">Produtos</span>
			<ol>
				<li><a href="cadastrarproduto.php">Cadastrar</a></li>
				<li><a href="alteraproduto.php">Alterar</a></li>
				<li><a href="excluiproduto.php">Excluir</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">Jogos</span>
			<ol>
				<li><a href="cadastrojogo.php">Cadastrar</a></li>
				<li><a href="alterajogo.php">Alterar</a></li>
				<li><a href="excluijogo.php">Excluir</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item">
			<span class="nav-lateral-titulo">Estoque</span>
			<ol>
				<li><a href="estoqueprodutos.php">Produtos</a></li>
				<li><a href="estoquejogos.php">Jogos</a></li>
			</ol>
		</li>
		<li class="nav-lateral-item nav-lateral-simples">
			<a href="logoffadm.php">Sair</a>
		</li>
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

	document.querySelectorAll('#menu-lateral .nav-lateral-titulo').forEach(function (titulo) {
		titulo.addEventListener('click', function () {
			titulo.parentElement.classList.toggle('aberto');
		});
	});
})();

(function () {
	var mask = document.getElementById('bg-mask');
	if (!mask) return;

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
</script>
