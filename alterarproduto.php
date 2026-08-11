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
	$produto->setValor($linha['valor']);
	$produto->setDescricao($linha['descricao']);
	$produto->setImagem($linha['imagem']);
	$produto->setQuantidade($linha['quantidade']);
	$produto->setTipo($linha['tipo']);
?>
<form action="alterarproduto.php" method="POST" id="form" enctype="multipart/form-data">
<h1>Alterar Dados do Produto</h1>
	<input type="hidden" value="<?= $produto->getCodProd() ?>" name="cod_prod">
	<p>Digite o nome:</p>
	<input type="hidden" value="<?= $produto->getNome() ?>" name="velho_nome">
	<p><input type="text" name="nome" size="40" maxlength="40" pattern="[a-zA-Z\s.çÇãÃáÁéÉíÍóÓúÚ09]{2,40}" title="Somente letras, sem caracteres especiais" 
	value="<?= $produto->getNome() ?>" required></p>
	<p>Digite o valor:</p>
	<p><input type="number" name="valor" min="1" max="9999" step="0.01" title="Somente números"
	value="<?= $produto->getValor() ?>" required></p>
	<p>Digite a nova descrição:</p>
	<p><input type="text" name="descricao" id="descricao" size="1000" maxlength="1000" value="<?= $produto->getDescricao() ?>" required></p>
	<p>Foto do Produto:</p>
    <i>Máximo 65Kb</i>
    <img src='data:image/jpg;base64,<?= base64_encode(stripslashes($produto->getImagem())) ?>' width='50' height='50'>
    <p>Escolher outra?</p>
	<p><input type="file" name="foto" accept=".jpg,.jpeg,.gif,.png,.bmp"></p>
 	<p>Digite a quantidade:</p>
 	<p><input type="number" name="quantidade" min="0" max="9999" title="Somente números" 
	value="<?= $produto->getQuantidade() ?>" required></p>
	<p>Escolha o tipo do produto:</p>
	<p><input type="radio" name="tipo" value="Consoles" required <?php if($produto->getTipo()=="Consoles"){echo'checked';}?>>Consoles
    <p><input type="radio" name="tipo" value="Periféricos" required <?php if($produto->getTipo()=="Periféricos"){echo'checked';}?>>Periféricos
    <p><input type="radio" name="tipo" value="Acessórios" required <?php if($produto->getTipo()=="Acessórios"){echo'checked';}?>>Acessórios
    <p><input type="radio" name="tipo" value="GiftCard" required <?php if($produto->getTipo()=="GiftCard"){echo'checked';}?>>Gift Cards
	<p><input type="submit" name="botao" value="Alterar"></p>
	<p><button><a href="paineladm.php">Voltar</a></button>
</form>
<?php
}
	if (isset($_POST['botao'])) {
		require_once 'persistence/ProdutoPA.php';
		require_once 'model/Produto.php';
		$produtopa=new ProdutoPA();
		$produto=new Produto();
		
			$produto->setNome($_POST['nome']);
			if ($produto->getNome()!=$_POST['velho_nome']) {
				if (!$produtopa->verificar('nome',$produto->getNome())) {
					echo "<h2>Esse produto já está cadastrado.</h2>";
					exit;
				}
			}
			if (isset($_FILES['foto'])&&$_FILES['foto']['tmp_name']!="") {
				$produto->setImagem($_FILES['foto']['tmp_name']);
			if ($produto->verificarTamanho($produto->getImagem())) {
				$produto->criarImagem();
				$flag=true;
			}else{
				echo "<h2>Imagem muito grande! Máx. 65Kb!</h2>";
				$flag=false;
			}
			}else{
				$consulta=$produtopa->buscarPorCod($_POST['cod_prod']);
				$linha=$consulta->fetch_assoc();
				$produto->setImagem($linha['imagem']);
				$flag=true;
			}
			if($flag){
			$produto->setCodProd($_POST['cod_prod']);
			$produto->setNome($_POST['nome']);
			$produto->setValor($_POST['valor']);
			$produto->setDescricao($_POST['descricao']);
			$produto->setQuantidade($_POST['quantidade']);
			$produto->setTipo($_POST['tipo']);
			if ($produtopa->alterar($produto)) {
				echo "<h2>Produto alterado com sucesso!</h2>";
			}else{
				echo "<h2>Erro na tentiva de alterar! <a href='alterarproduto.php?cod_prod=".$produto->getCodProd()."'>Tentar novamente</a></h2>";
			}
		}
	}
?>
<?php include 'rodape.php'; ?>
</body>
</html>