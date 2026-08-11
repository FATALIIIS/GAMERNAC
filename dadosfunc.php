<?php require_once 'painelfunc.php';
	if(isset($_COOKIE['funcionario'])){
	require_once 'persistence/FuncionarioPA.php';
	require_once 'model/Funcionario.php';
	$funcionario=new Funcionario();
	$funcionariopa=new FuncionarioPA();

	$consulta=$funcionariopa->buscarPorCod($_COOKIE['funcionario']);
	$linha=$consulta->fetch_assoc();
	$funcionario->setCodFunc($linha['cod_func']);
	$funcionario->setNome($linha['nome']);
	$funcionario->setCpf($linha['cpf']);
	$funcionario->setTelefone($linha['telefone']);
	$funcionario->setEmail($linha['email']);
	$funcionario->setDataNasci($linha['data_nasci']);
	$funcionario->setSexo($linha['sexo']);
	$funcionario->setEndereco($linha['endereco']);
?>
<form action="dadosfunc.php" method="POST" id="form">
<h1>Alterar Dados do Funcionário</h1>
	<input type="hidden" value="<?= $funcionario->getCodFunc() ?>" name="cod_func">
	<p>Digite o nome:</p>
	<p><input type="text" name="nome" size="40" maxlength="40" pattern="[a-zA-Z\sçÇãÃáÁéÉíÍóÓúÚ]{2,40}" title="Somente letras, sem caracteres especiais" 
	value="<?= $funcionario->getNome() ?>" required></p>
	<p>CPF:</p>
	<input type="hidden" name="velho_cpf" value="<?= $funcionario->getCpf() ?>">
	<p><input type="number" name="cpf" min="00000000000" max="99999999999" pattern="[0-9]{11}" title="Somente números"
	value="<?= $funcionario->getCpf() ?>" required></p>
	<p>Telefone:</p>
	<p><input type="text" name="telefone" id="telefone" size="14" maxlength="14" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}" value="<?= $funcionario->getTelefone() ?>"required></p>
	<p>Digite o email:</p>
 	<p><i>pode ser @gmail, @yahoo, @instituição_de_domínio</i></p>
 	<p><input type="email" name="email" size="50" maxlength="320" value="<?= $funcionario->getEmail() ?>" required>
	<p>Data de Nascimento:</p>
	<?php
	$data_atual=new DateTime(date('Y-m-d'));
	$data_antiga=date_modify($data_atual,"-120 years")->format('Y-m-d');
	?>
	<p><input type="date" name="data_nasci" min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>"
	value="<?= $funcionario->getDataNasci() ?>"required></p>
 	<p>Sexo:</p>
 	<p><input type="radio" name="sexo" value="M" required <?php if($funcionario->getSexo()=="M"){echo'checked';}?>> M 
 	<p><input type="radio" name="sexo" value="F" required <?php if($funcionario->getSexo()=="F"){echo'checked';}?>> F 
	<p>Endereço:</p>
	<p><input type="text" name="endereco" size="50" maxlength="50" pattern="[0-9a-zA-Z\s,.çÇãÃáÁéÉíÍóÓúÚ]{6,50}" value="<?= $funcionario->getEndereco() ?>" required></p>
	<p><input type="submit" name="botao" value="Alterar"></p>
	<p><button><a href="paineladm.php">Voltar</a></button>
</form>
<?php
}
	if (isset($_POST['botao'])) {
		require_once 'persistence/FuncionarioPA.php';
		require_once 'model/Funcionario.php';
		$funcionariopa=new FuncionarioPA();
		$funcionario=new Funcionario();
		
			$funcionario->setCpf($_POST['cpf']);
			if ($funcionario->getCpf()!=$_POST['velho_cpf']) {
				if (!$funcionariopa->verificar('cpf',$funcionario->getCpf())) {
					echo "<h2>CPF já está cadastrado!</h2>";
					exit;
				}
			}
			$funcionario->setCodFunc($_POST['cod_func']);
			$funcionario->setNome($_POST['nome']);
			$funcionario->setTelefone($_POST['telefone']);
			$funcionario->setEmail($_POST['email']);
			$funcionario->setDataNasci($_POST['data_nasci']);
			$funcionario->setSexo($_POST['sexo']);
			$funcionario->setEndereco($_POST['endereco']);
			if ($funcionariopa->alterar($funcionario)) {
				echo "<h2>Alterado com sucesso!</h2>";
			}else{
				echo "<h2>Erro na tentiva de alterar! <a href='alterarfuncionario.php?cod_func=".$funcionario->getCodFunc()."'>Alterar</a></h2>";
			}
		}
?>
<?php include 'rodape.php'; ?>
</body>
</html>