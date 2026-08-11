<?php require_once 'menu.php';
if (!isset($_COOKIE['cliente'])) {
	echo "<h2>Você não está logado!
	<a href='login.php'>Logar</a></h2>";
}else{
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
	$cliente->setAvatar($linha['avatar']);

	$avataresDisponiveis=['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg'];
?>
<form action="alterarcliente.php" method="POST" id="form">
<h1>Alterar dados</h1>
	<p>Avatar:</p>
	<div class="avatar-grade avatar-grade-alterar">
		<?php foreach ($avataresDisponiveis as $avatar) { ?>
			<label class="avatar-opcao">
				<input type="radio" name="avatar" value="<?= $avatar ?>" <?= $cliente->getAvatar()===$avatar ? 'checked' : '' ?>>
				<img src="img/avatares/<?= $avatar ?>" alt="<?= $avatar ?>">
			</label>
		<?php } ?>
	</div>
	<p>Digite o nome:</p>
	<p><input type="text" name="nome"
		size="40" maxlength="40"
		pattern="[a-zA-Z\sçÇãÃáÁéÉíÍóÓúÚ]{2,40}"
		title="Somente letras, sem caracteres especiais"
		value="<?= $cliente->getNome() ?>"
		required></p>
	<p>CPF:</p>
	<input type="hidden" name="velho_cpf"
	value="<?= $cliente->getCpf() ?>">
	<p><input type="number" name="cpf"
		min="00000000000" max="99999999999"
		pattern="[0-9]{11}" title="Somente números"
		value="<?= $cliente->getCpf()?>" 
		required></p>
	<p>Data de Nascimento:</p>
	<?php
	$data_atual=new DateTime(date('Y-m-d'));
	$data_antiga=date_modify($data_atual,"-120 years")->format('Y-m-d');
	?>
	<p><input type="date" name="data_nasci"
		min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>"
		value="<?= $cliente->getDataNasci() ?>"
		required></p>
	<p>Endereço:</p>
	<p><input type="text" name="endereco"
		size="50" maxlength="50"
		pattern="[0-9a-zA-Z\s,.çÇãÃáÁéÉíÍóÓúÚ]{6,50}"
		value="<?= $cliente->getEndereco() ?>"
		required></p>
	<p>Telefone:</p>
	<p><input type="text" name="telefone" id="telefone" 
		size="14" maxlength="14" 
		placeholder="(42)99988-7777"
		title="Formato (XX)XXXXX-XXXX"
		pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}"
		value="<?= $cliente->getTelefone() ?>"
		required></p>
		<p>Email:</p>
		<p><input type="email" name="email" id="email" 
		size="50" maxlength="320" 
		value="<?= $cliente->getEmail() ?>"
		required></p>
	<p>Login</p>
	<p><input type="text" name="login"
		size="20" maxlength="20" 
		value="<?= $cliente->getLogin()?>" 
		readonly></p>
	<p>Senha Atual:</p>
	<p><i>*letras e números,@,_,- de 5 a 
	10 caracteres</i></p>
	<p><input type="password" name="senha"
		size="10" maxlength="10"
		pattern="[0-9a-zA-Z@_-]{5,10}"
		required></p>
	<p>Nova senha:</p>
	<p><input type="password" name="nova_senha"
		size="10" maxlength="10"
		pattern="[0-9a-zA-Z@_-]{5,10}"></p>
	<p>
		<input type="submit" name="botao"
		value="Alterar">
		<button><a href="excluircliente.php">
		Excluir</a></button>
	</p>
</form>
<?php
	if (isset($_POST['botao'])) {
		require_once 'persistence/ClientePA.php';
		require_once 'model/Cliente.php';
		$clientepa=new ClientePA();
		$cliente=new Cliente();
		$cliente->setLogin($_POST['login']);
		$cliente->setEndereco($_POST['endereco']);
		$cliente->setTelefone($_POST['telefone']);
		$cliente->setNome($_POST['nome']);
		$cliente->setEmail($_POST['email']);
		$cliente->setDataNasci($_POST['data_nasci']);
		$cliente->setSenha($_POST['senha']);
		$cliente->setCodCli($_COOKIE['cliente']);
		$codigo=$clientepa->logar($cliente->getLogin(),
			$cliente->getSenha());
		if (!$codigo) {
			echo "<h2>Senha atual incorreta! Redigite</h2>";
		}else{
			$cliente->setCpf($_POST['cpf']);
			if ($cliente->getCpf()!=$_POST['velho_cpf']) {
				if(!$clientepa->verificar('cpf',$cliente->getCpf())){
					echo "<h2>Cpf já cadastrado!</h2>";
					exit;
				}
			}
			if (isset($_POST['nova_senha'])&&$_POST['nova_senha']!='') {
				$cliente->setSenha($_POST['nova_senha']);
				$cliente->criptografar();
			}else{
				$cliente->criptografar();
			}
			$cliente->setEndereco($_POST['endereco']);
			$cliente->setTelefone($_POST['telefone']); 
			$cliente->setDataNasci($_POST['data_nasci']);
			$cliente->setNome($_POST['nome']);
			$cliente->setLogin($_POST['login']); 
			$cliente->setEmail($_POST['email']);
			$cliente->setCodCli($_COOKIE['cliente']);
			$cliente->setAvatar(isset($_POST['avatar']) ? $_POST['avatar'] : null);
			if ($clientepa->alterar($cliente)) {
				echo "<h2>Alterado com sucesso!</h2>";
			}else{
				echo "<h2>Erro na tentativa de alterar!</h2>";
			}
			

		}
	}
}
?>
<?php include 'rodape.php'; ?>
</body>
</html>