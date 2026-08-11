<?php require_once 'menu.php'; ?>
<form action="funcionarios.php" method="POST" id="form">
<h1>Funcionários</h1>
	<p>Digite o login:</p>
	<p><input type="text" name="login" size="20" maxlength="20" pattern="[a-zA-Z0-9@-_]{5,20}" title="5 a 20 caracteres, letras e números, @,_,-."></p>
	<p>Senha:</p>
	<p><input type="password" name="senha" size="10" maxlength="10" pattern="[a-zA-Z0-9@-_]{5,20}" title="8 a 20 caracteres, letras e números, @,_,-."></p>
	<p><input type="submit" name="botao" value="Logar"></p>
	<li><a href="index.php">Voltar</a></li>
	<li><a href="recuperarsenhafunc.php">Esqueceu sua senha?</a></li>
	<h1>Não possui conta ?</h1>
	<li><a href="cadastrofuncionario.php">Cadastre-se</a></li>
</form>
<?php
	if (isset($_POST['botao'])){
		require_once 'model/Funcionario.php';
		require_once 'persistence/FuncionarioPA.php';
		$funcionario=new Funcionario();
		$funcionariopa=new FuncionarioPA();
		$funcionario->setLogin($_POST['login']);
		$funcionario->setSenha($_POST['senha']);
		$vetor=$funcionariopa->logar($funcionario->getLogin(),$funcionario->getSenha());
		if (!$vetor) {
			echo "<h2>Login ou senha incorretos!</h2>";
		}else{
			$funcionario->logar($vetor[0]);
			echo "<h2>Login com sucesso!</h2>";
			echo "<meta http-equiv='refresh' content='2; url=iniciofunc.php'>";
		}
	}
?>
<?php include 'rodape.php'; ?>
</body>
</html>