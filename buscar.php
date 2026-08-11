<?php
require_once 'menu.php';
require_once 'persistence/ProdutoPA.php';
require_once 'persistence/JogoPA.php';
require_once 'model/Produto.php';
require_once 'model/Jogo.php';

$termo = isset($_GET['termo']) ? trim($_GET['termo']) : '';
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'todos';

$jogos = [];
$produtos = [];

if ($termo !== '') {
	$curinga = '%' . $termo . '%';

	if ($filtro === 'todos' || $filtro === 'jogos') {
		$jogopa = new JogoPA();
		$consultaJogos = $jogopa->buscar($curinga, 'nome');
		if ($consultaJogos) {
			while ($linha = $consultaJogos->fetch_assoc()) {
				$jogos[] = $linha;
			}
		}
	}

	if ($filtro === 'todos' || $filtro === 'produtos') {
		$produtopa = new ProdutoPA();
		$consultaProdutos = $produtopa->buscar($curinga, 'nome');
		if ($consultaProdutos) {
			while ($linha = $consultaProdutos->fetch_assoc()) {
				$produtos[] = $linha;
			}
		}
	}
}

$totalResultados = count($jogos) + count($produtos);
?>

<section class="busca-resultados">

	<h1 class="busca-titulo">
		<?php if ($termo !== ''): ?>
			Resultados para "<?= htmlspecialchars($termo) ?>"
		<?php else: ?>
			Digite algo na barra de pesquisa
		<?php endif; ?>
	</h1>

	<?php if ($termo !== ''): ?>
	<div class="busca-filtros">
		<a href="buscar.php?termo=<?= urlencode($termo) ?>&filtro=todos" class="filtro-btn <?= $filtro === 'todos' ? 'ativo' : '' ?>">Todos</a>
		<a href="buscar.php?termo=<?= urlencode($termo) ?>&filtro=jogos" class="filtro-btn <?= $filtro === 'jogos' ? 'ativo' : '' ?>">Jogos</a>
		<a href="buscar.php?termo=<?= urlencode($termo) ?>&filtro=produtos" class="filtro-btn <?= $filtro === 'produtos' ? 'ativo' : '' ?>">Produtos</a>
	</div>

	<?php if ($totalResultados === 0): ?>
		<p class="busca-vazio">Nenhum resultado encontrado.</p>
	<?php else: ?>

		<div class="busca-grid">

			<?php foreach ($jogos as $linha): ?>
				<div class="busca-card">
					<span class="busca-card-tag">Jogo</span>
					<div class="busca-card-imagem">
						<?php if (!empty($linha['capa'])): ?>
							<img src="data:image/jpg;base64,<?= base64_encode(stripslashes($linha['capa'])) ?>" alt="<?= htmlspecialchars($linha['nome']) ?>">
						<?php else: ?>
							<span class="busca-card-sem-foto">🎮</span>
						<?php endif; ?>
					</div>
					<h3><?= htmlspecialchars($linha['nome']) ?></h3>
					<p class="busca-card-plataforma"><?= htmlspecialchars($linha['plataforma']) ?></p>
					<p class="busca-card-preco">R$ <?= number_format($linha['valor'], 2, ',', '.') ?></p>
				</div>
			<?php endforeach; ?>

			<?php foreach ($produtos as $linha): ?>
				<div class="busca-card">
					<span class="busca-card-tag">Produto</span>
					<div class="busca-card-imagem">
						<?php if (!empty($linha['imagem'])): ?>
							<img src="data:image/jpg;base64,<?= base64_encode(stripslashes($linha['imagem'])) ?>" alt="<?= htmlspecialchars($linha['nome']) ?>">
						<?php else: ?>
							<span class="busca-card-sem-foto">🕹️</span>
						<?php endif; ?>
					</div>
					<h3><?= htmlspecialchars($linha['nome']) ?></h3>
					<p class="busca-card-plataforma"><?= htmlspecialchars($linha['tipo']) ?></p>
					<p class="busca-card-preco">R$ <?= number_format($linha['valor'], 2, ',', '.') ?></p>
				</div>
			<?php endforeach; ?>

		</div>

	<?php endif; ?>
	<?php endif; ?>

</section>

<?php include 'rodape.php'; ?>
</body>
</html>
