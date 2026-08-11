<?php require_once 'cabecalho.php'; require_once 'perfil.php';
	if(isset($_COOKIE['cliente'])){
	require_once 'persistence/ClientePA.php';
	require_once 'model/Cliente.php';
	$cliente=new Cliente();
	$clientepa=new ClientePA();

	$consulta=$clientepa->buscarPorCod($_COOKIE['cliente']);
	$linha=$consulta->fetch_assoc();
	$cliente->setCodCli($linha['cod_cli']);
	$cliente->setNome($linha['nome']);
	$cliente->setCpf($linha['cpf']);
	$cliente->setEndereco($linha['endereco']);
	$cliente->setTelefone($linha['telefone']);
	$cliente->setEmail($linha['email']);
	$cliente->setLogin($linha['login']);
	$cliente->setDataNasci($linha['data_nasci']);
	$cliente->setSexo($linha['sexo']);
	$cliente->setAvatar($linha['avatar']);
?>
<form action="index.php" method="POST" id="form">
<h1>Meu Perfil</h1>
	<input type="hidden" value="<?= $cliente->getCodCli() ?>" name="cod_cli">
	<p>Digite o nome:</p>
	<p><input type="text" name="nome" size="40" maxlength="40" pattern="[a-zA-Z\sçÇãÃáÁéÉíÍóÓúÚ]{2,40}" title="Somente letras, sem caracteres especiais" 
	value="<?= $cliente->getNome() ?>" readonly required></p>
	<p>CPF:</p>
	<input type="hidden" name="velho_cpf" value="<?= $cliente->getCpf() ?>">
	<p><input type="number" name="cpf" min="00000000000" max="99999999999" pattern="[0-9]{11}" title="Somente números"
	value="<?= $cliente->getCpf() ?>" readonly required></p>
	<p>Telefone:</p>
	<p><input type="text" name="telefone" id="telefone" size="14" maxlength="14" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}" value="<?= $cliente->getTelefone() ?>" readonly required></p>
	<p>Digite o email:</p>
 	<p><i>pode ser @gmail, @yahoo, @instituição_de_domínio</i></p>
 	<p><input type="email" name="email" size="50" maxlength="320" value="<?= $cliente->getEmail() ?>" readonly required>
	<p>Data de Nascimento:</p>
	<?php
	$data_atual=new DateTime(date('Y-m-d'));
	$data_antiga=date_modify($data_atual,"-120 years")->format('Y-m-d');
	?>
	<p><input type="date" name="data_nasci" min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>"
	value="<?= $cliente->getDataNasci() ?>" readonly required></p>
 	<p>Sexo:</p>
 	<p><input type="radio" name="sexo" value="M" readonly required <?php if($cliente->getSexo()=="M"){echo'checked';}?>> M 
 	<p><input type="radio" name="sexo" value="F" readonly required <?php if($cliente->getSexo()=="F"){echo'checked';}?>> F 
	<p>Endereço:</p>
	<p><input type="text" name="endereco" size="50" maxlength="50" pattern="[0-9a-zA-Z\s,.çÇãÃáÁéÉíÍóÓúÚ]{6,50}" value="<?= $cliente->getEndereco() ?>" readonly required></p>
	<p><button><a href="index.php">Voltar</a></button>
</form>
<?php 
} 
include 'rodape.php'; 
?>
</body>
</html>