<?php ob_start(); ?>
<?php require_once 'menu.php'; ?>
<?php include 'loader.php'; ?>
<form action="login.php" method="POST" id="form">
<h1>Login</h1>
	<p>Digite o login:</p>
	<p><input type="text" name="login" size="20" maxlength="20" title="letras e números,@,_,- de 5 a 20 caracteres" pattern="[0-9a-zA-Z@_-]{5,20}" required></p>
	<p>Senha:</p>
	<p><input type="password" name="senha" size="10" maxlength="10" pattern="[0-9a-zA-Z@_-]{5,20}"required></p>
	<p><input type="submit" name="botao" value="Logar"></p>
	<li><a href="recuperarsenha.php">Esqueceu sua senha?</a></li>
	<h1>Não possui conta ?</h1>
	<li><a href="cadastrar.php">Cadastre-se</a></li>
</form>
<?php
if(isset($_POST['botao'])){
	require_once 'model/Cliente.php';
	require_once 'persistence/ClientePA.php';
	$cliente=new Cliente();
	$clientepa=new ClientePA();
	$cliente->setSenha($_POST['senha']);
	$cliente->setLogin($_POST['login']);
	$codigo=$clientepa->logar($cliente->getLogin(),
		$cliente->getSenha());
		if(!$codigo) {
			echo "<h2>Login ou senha incorretos!</h2>";
		}else{
			$cliente->logar($codigo);
			echo "<h2>Login com sucesso</h2>";
			echo "<meta http-equiv='refresh' content='2;url=index.php'>";
		}
}
?>
<?php include 'rodape.php'; ?>
</body>
</html>