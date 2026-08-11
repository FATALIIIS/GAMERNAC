<?php require_once 'paineladm.php';
	if(isset($_GET['cod_func'])){
	require_once 'persistence/FuncionarioPA.php';
	require_once 'model/Funcionario.php';
	$funcionario=new Funcionario();
	$funcionariopa=new FuncionarioPA();
	$consulta=$funcionariopa->buscarPorCod($_GET['cod_func']);
	$linha=$consulta->fetch_assoc();
	$funcionario->setNome($linha['nome']);
	$funcionario->setCpf($linha['cpf']);
	$funcionario->setCodFunc($linha['cod_func']);
?>
<form action="excluirfuncionario.php" method="POST" id="form">
<h1>Excluir Funcionário ?</h1>
	<p>Tem certeza que deseja excluir o:</p>
	<h1><?= $funcionario->getNome() ?></h1>
	<p>CPF: <?= $funcionario->getCpf() ?></p>
	<input type="hidden" value="<?= $funcionario->getCodFunc() ?>" name="cod_func">
	<p><input type="submit" name="botao" value="Sim"><button><a href="excluirfuncionario.php">Não</a></button></p>
</form>
<?php
}
	if (isset($_POST['botao'])){
		require_once 'persistence/FuncionarioPA.php';
		$funcionariopa=new FuncionarioPA();
		if ($funcionariopa->excluir($_POST['cod_func'])){
			echo "<h2>Excluído com sucesso!</h2>";
			header('Refresh:2;url=paineladm.php');
		}else{
			echo "<h2>Erro na tentativa de excluir, tente novamente.</h2>";
		}
	}
?>
<?php include 'rodape.php'; ?>
