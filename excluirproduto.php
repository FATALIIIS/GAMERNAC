<?php require_once 'paineladm.php';
	if(isset($_GET['cod_prod'])){
	require_once 'persistence/ProdutoPA.php';
	require_once 'model/Produto.php';
	$produto=new Produto();
	$produtopa=new ProdutoPA();
	$consulta=$produtopa->buscarPorCod($_GET['cod_prod']);
	$linha=$consulta->fetch_assoc();
	$produto->setCodProd($linha['cod_prod']);
	$produto->setNome($linha['nome']);
?>
<form action="excluirproduto.php" method="POST" id="form">
<h1>Excluir Produto ?</h1>
	<p>Tem certeza que deseja excluir o:</p>
	<h1>Código: <?= $produto->getCodProd() ?></h1>
	<p>Nome: <?= $produto->getNome() ?></p>
	<input type="hidden" value="<?= $funcionario->getCodProd() ?>" name="cod_prod">
	<p><input type="submit" name="botao" value="Sim"><button><a href="excluirproduto.php">Não</a></button></p>
</form>
<?php
}
	if (isset($_POST['botao'])){
		require_once 'persistence/ProdutoPA.php';
		$produtopa=new ProdutoPA();
		if ($produtopa->excluir($_POST['cod_prod'])){
			echo "<h2>Excluído com sucesso!</h2>";
			header('Refresh:2;url=paineladm.php');
		}else{
			echo "<h2>Erro na tentativa de excluir, tente novamente.</h2>";
		}
	}
?>
<?php include 'rodape.php'; ?>
