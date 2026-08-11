<?php require_once 'paineladm.php';
	if(isset($_GET['cod_jogo'])){
	require_once 'persistence/JogoPA.php';
	require_once 'model/Jogo.php';
	$jogo=new Jogo();
	$jogopa=new JogoPA();
	$consulta=$jogopa->buscarPorCod($_GET['cod_jogo']);
	$linha=$consulta->fetch_assoc();
	$jogo->setCodJogo($linha['cod_jogo']);
	$jogo->setNome($linha['nome']);
?>
<form action="excluirjogo.php" method="POST" id="form">
<h1>Excluir Jogo ?</h1>
	<p>Tem certeza que deseja excluir o:</p>
	<h1>Código: <?= $jogo->getCodJogo() ?></h1>
	<p>Nome: <?= $jogo->getNome() ?></p>
	<input type="hidden" value="<?= $jogo->getCodJogo() ?>" name="cod_jogo">
	<p><input type="submit" name="botao" value="Sim"><button><a href="excluirjogo.php">Não</a></button></p>
</form>
<?php
}
	if (isset($_POST['botao'])){
		require_once 'persistence/JogoPA.php';
		$jogopa=new JogoPA();
		if ($jogopa->excluir($_POST['cod_jogo'])){
			echo "<h2>Excluído com sucesso!</h2>";
			header('Refresh:2;url=paineladm.php');
		}else{
			echo "<h2>Erro na tentativa de excluir, tente novamente.</h2>";
		}
	}
?>
<?php include 'rodape.php'; ?>
