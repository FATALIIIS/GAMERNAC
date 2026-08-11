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
	$jogo->setGenero($linha['genero']);
	$jogo->setDataLanc($linha['data_lanc']);
	$jogo->setValor($linha['valor']);
	$jogo->setClassificacao($linha['classificacao']);
	$jogo->setCapa($linha['capa']);
	$jogo->setDescricao($linha['descricao']);
	$jogo->setQuantidade($linha['quantidade']);
	$jogo->setPlataforma($linha['plataforma']);
?>
<form action="alterarjogo.php" method="POST" id="form" enctype="multipart/form-data">
<h1>Alterar Dados do Jogo</h1>
	 <input type="hidden" value="<?= $jogo->getCodJogo() ?>" name="cod_jogo">
  <p>Digite o nome do jogo:</p>
  <input type="hidden" value="<?= $jogo->getNome() ?>" name="velho_nome">
  <p><input type="text" name="nome" size="40" maxlength="40" placeholder="Ex: Grand Theft Auto V" pattern="[a-zA-Z-Z\sçÇÃáÁéÉíÍóÓúÚ]{2,40}"
    title="Somente letras, sem caracteres especiais" value="<?= $jogo->getNome() ?>"required></p>
  <p>Digite a plataforma:</p>
  <p><input type="text" name="plataforma" size="40" maxlength="40" placeholder="Ex: PlayStation 5" pattern="[a-zA-Z-Z\sçÇÃáÁéÉíÍóÓúÚ]{2,40}"
    title="Somente letras, sem caracteres especiais" value="<?= $jogo->getPlataforma() ?>"required></p>
  <p>Digite o gênero:</p>
  <p><input type="text" name="genero" size="40" maxlength="40" placeholder="Ex: Aventura" pattern="[a-zA-Z-Z\,sçÇÃáÁéÉíÍóÓúÚ]{2,40}" 
  value="<?= $jogo->getGenero() ?>"required></p>
  <p>Data de Lançamento:</p>
  <?php
  $data_atual=new DateTime(date('Y-m-d'));
  $data_antiga=date_modify($data_atual,"-68 years")->format('Y-m-d');
  ?>
  <p><input type="date" name="data_lanc" min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>" value="<?= $jogo->getDataLanc() ?>"required></p>
    <p>Digite o valor:</p>
    <p><input type="number" name="valor" min="1" max="999" step="0.01" placeholder="Ex: R$:100,00" title="Somente números" 
    value="<?= $jogo->getValor() ?>"required></p>
    <p>Classificação:</p>
    <p><input type="radio" name="classificacao" value="Livre" required <?php if($jogo->getClassificacao()=="Livre"){echo'checked';}?>>Livre
    <p><input type="radio" name="classificacao" value="10 Anos+" required <?php if($jogo->getClassificacao()=="10 Anos+"){echo'checked';}?>>10 Anos+
    <p><input type="radio" name="classificacao" value="12 Anos+" required <?php if($jogo->getClassificacao()=="12 Anos+"){echo'checked';}?>>12 Anos+
    <p><input type="radio" name="classificacao" value="14 Anos+" required <?php if($jogo->getClassificacao()=="14 Anos+"){echo'checked';}?>>14 Anos+
    <p><input type="radio" name="classificacao" value="16 Anos+" required <?php if($jogo->getClassificacao()=="16 Anos+"){echo'checked';}?>>16 Anos+
    <p><input type="radio" name="classificacao" value="18 Anos+" required <?php if($jogo->getClassificacao()=="18 Anos+"){echo'checked';}?>>18 Anos+
    <p>Capa:</p>
    <img src='data:image/jpg;base64,<?= base64_encode(stripslashes($jogo->getCapa())) ?>' width='50' height='50'>
    <p>Escolher outra?</p>
		<p><input type="file" name="capa" accept=".jpg,.jpeg,.gif,.png,.bmp"></p>
    <p>Descrição:</p>
    <p><input type="text" name="descricao" size="50" maxlength="50" pattern="[0-9a-zA-Z\s,.çÇÃáÁéÉíÍóÓúÚ]{5,1000}" placeholder="Ex: Grand Theft Auto V se passa em Los Santos..." value="<?= $jogo->getDescricao() ?>" required></p>
    <p>Quantidade:</p>
    <p><input type="text" name="quantidade" id="quantidade" size="1" maxlength="9999" placeholder="Ex: 10" pattern="[0-9]{1,4}" 
    value="<?= $jogo->getQuantidade() ?>"required></p>
    <p><input type="submit" name="botao" value="Alterar"></p>
    <p><button><a href="paineladm.php">Voltar</a></button>   
</form>
<?php
}
	if (isset($_POST['botao'])) {
		require_once 'persistence/JogoPA.php';
		require_once 'model/Jogo.php';
		$jogopa=new JogoPA();
		$jogo=new Jogo();
		
			$jogo->setNome($_POST['nome']);
			if ($jogo->getNome()!=$_POST['velho_nome']) {
				if (!$jogopa->verificar('nome',$jogo->getNome())) {
					echo "<h2>Esse jogo já está cadastrado.</h2>";
					exit;
				}
			}
			if (isset($_FILES['capa'])&&$_FILES['capa']['tmp_name']!="") {
				$jogo->setCapa($_FILES['capa']['tmp_name']);
			if ($jogo->verificarTamanho($jogo->getCapa())) {
				$jogo->criarImagem();
				$flag=true;
			}else{
				echo "<h2>Imagem muito grande! Máx. 65Kb!</h2>";
				$flag=false;
			}
			}else{
				$consulta=$jogopa->buscarPorCod($_POST['cod_jogo']);
				$linha=$consulta->fetch_assoc();
				$jogo->setCapa($linha['capa']);
				$flag=true;
			}
			if($flag){
			$jogo->setCodJogo($_POST['cod_jogo']);
			$jogo->setNome($_POST['nome']);
			$jogo->setGenero($_POST['genero']);
			$jogo->setPlataforma($_POST['plataforma']);
			$jogo->setDataLanc($_POST['data_lanc']);
			$jogo->setValor($_POST['valor']);
			$jogo->setClassificacao($_POST['classificacao']);
			$jogo->setDescricao($_POST['descricao']);
			$jogo->setQuantidade($_POST['quantidade']);
			$jogopa=new JogoPA();
			if ($jogopa->alterar($jogo)) {
				echo "<h2>Jogo alterado com sucesso!</h2>";
			}else{
				echo "<h2>Erro na tentiva de alterar! <a href='alterarjogo.php?cod_jogo=".$jogo->getCodJogo()."'>Alterar</a></h2>";
			}
		}
	}
?>
<?php include 'rodape.php'; ?>
</body>
</html>