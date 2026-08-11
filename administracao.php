<?php ob_start(); ?>
<?php require_once 'menu.php'; ?>
<?php include 'loader.php'; ?>
<form action="administracao.php" method="POST" id="form">
<h1>Administração</h1>
	<p>Digite o login:</p>
	<p><input type="text" name="login" size="20" maxlength="20" pattern="[a-zA-Z0-9@-_]{5,20}" title="5 a 20 caracteres, letras e números, @,_,-."></p>
	<p>Senha:</p>
	<p><input type="password" name="senha" size="10" maxlength="10" pattern="[a-zA-Z0-9@-_]{5,20}" title="8 a 20 caracteres, letras e números, @,_,-."></p>
	<p><input type="submit" name="botao" value="Logar"></p>
	<li><a href="index.php">Voltar</a></li>
</form>
<?php
	if (isset($_POST['botao'])){
		require_once 'model/Administrador.php';
		require_once 'persistence/AdministradorPA.php';
		$administrador=new Administrador();
		$administradorpa=new AdministradorPA();
		$administrador->setLogin($_POST['login']);
		$administrador->setSenha($_POST['senha']);
		$vetor=$administradorpa->logar($administrador->getLogin(),$administrador->getSenha());
		if (!$vetor) {
			echo "<h2>Login ou senha incorretos!</h2>";
		}else{
			$administrador->logar($vetor[0]);
			echo "<h2>Login com sucesso!</h2>";
			echo "<meta http-equiv='refresh' content='2; url=inicioadm.php'>";
		}
	}
?>
<?php include 'rodape.php'; ?>
</body>
</html>