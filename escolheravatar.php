<?php require_once 'menu.php'; ?>
<?php
if (!isset($_COOKIE['cliente'])) {
	echo "<h2>Você não está logado! <a href='login.php'>Logar</a></h2>";
} else {
	require_once 'persistence/ClientePA.php';
	require_once 'model/Cliente.php';
	$clientepa=new ClientePA();

	$avataresDisponiveis=['avatar1.svg','avatar2.svg','avatar3.svg','avatar4.svg','avatar5.svg','avatar6.svg'];

	if (isset($_POST['botao'])) {
		$avatarEscolhido=$_POST['avatar'];
		if (in_array($avatarEscolhido,$avataresDisponiveis)) {
			$clientepa->atualizarAvatar($_COOKIE['cliente'],$avatarEscolhido);
		}
		echo "<meta http-equiv='refresh' content='1;url=index.php'>";
		echo "<h2>Avatar salvo com sucesso!</h2>";
	} else {
?>
<section class="avatar-secao">
	<h1 class="busca-titulo">Escolha seu avatar</h1>
	<p class="avatar-subtitulo">Selecione um avatar para o seu perfil. Você pode trocar depois em "Alterar dados".</p>
	<form action="escolheravatar.php" method="POST" id="form-avatar" class="avatar-form">
		<div class="avatar-grade">
			<?php foreach ($avataresDisponiveis as $indice => $avatar) { ?>
				<label class="avatar-opcao">
					<input type="radio" name="avatar" value="<?= $avatar ?>" <?= $indice===0 ? 'checked' : '' ?>>
					<img src="img/avatares/<?= $avatar ?>" alt="Avatar <?= $indice+1 ?>">
				</label>
			<?php } ?>
		</div>
		<p>
			<input type="submit" name="botao" class="hero-btn" value="Salvar avatar">
			<a href="index.php" class="avatar-pular">Pular por enquanto</a>
		</p>
	</form>
</section>
<?php
	}
}
?>
<?php include 'rodape.php'; ?>
</body>
</html>
