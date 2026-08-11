<?php ob_start(); ?>
<?php require_once 'menu.php'; ?>
<?php include 'loader.php'; ?>
<form action="login.php" method="POST" id="form">
<h1>Login</h1>
	<p>Digite o login:</p>
	<p><input type="text" name="login" size="20" maxlength="20" pattern="[a-zA-Z0-9@-_]{5,20}" title="5 a 20 caracteres, letras e números, @,_,-." required></p>
	<p>Senha:</p>
	<p><input type="password" name="senha" size="10" maxlength="10" pattern="[a-zA-Z0-9@-_]{5,20}" title="5 a 20 caracteres, letras e números, @,_,-." required></p>
	<p><input type="submit" name="botao" value="Logar"></p>
	<li><a href="recuperarsenha.php">Esqueceu sua senha?</a></li>
	<h1>Não possui conta ?</h1>
	<li><a href="cadastrar.php">Cadastre-se</a></li>
	<li><a href="index.php">Voltar</a></li> 
</form>
<?php
	if (isset($_POST['botao'])) {
		require_once 'model/Cliente.php';
		require_once 'persistence/ClientePA.php';
		$cliente=new Cliente();
		$clientepa=new ClientePA();
		$cliente->setLogin($_POST['login']);
		$cliente->setSenha($_POST['senha']);
		$codigo=$clientepa->logar($cliente->getLogin(),$cliente->getSenha());
	if (!$codigo) {
		echo "<h2>Login ou senha incorretos!</h2>";
	}else{
		$cliente->logar($codigo);
		echo "<meta http-equiv='refresh' content='2;url=index.php'>";
		echo "<h2>Login com sucesso!</h2>";
	}
}
?>
<?php include 'rodape.php'; ?>
</body>
</html>