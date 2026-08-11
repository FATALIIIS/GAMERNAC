<?php require_once 'menu.php'; ?>
<form action="recuperarsenhafunc.php" method="POST" id="form">
<h1>Recuperar Senha</h1>
	<p>Digite o login:</p>
	<p><input type="text" name="login" size="20" maxlength="20" title="letras e números,@,_,- de 5 a 20 caracteres" pattern="[0-9a-zA-Z@_-]{5,20}" required></p>

	<p>Digite o email cadastrado:</p>
	<p><input type="email" name="email" size="50" maxlength="320" required></p>

	<p>Nova senha:</p>
	<p><input type="password" name="senha" size="10" maxlength="10" pattern="[0-9a-zA-Z@_-]{5,20}" required></p>

	<p>Redigite a nova senha:</p>
	<p><input type="password" name="validar" size="10" maxlength="10" pattern="[0-9a-zA-Z@_-]{5,20}" required></p>

	<p><input type="submit" name="botao" value="Redefinir senha"></p>
	<li><a href="logarcadastrar.php">Voltar para login</a></li>
</form>
<?php
if (isset($_POST['botao'])) {
	require_once 'model/Funcionario.php';
	require_once 'persistence/FuncionarioPA.php';
	$funcionariopa=new FuncionarioPA();

	if ($_POST['senha'] != $_POST['validar']) {
		echo "<h2>A senha e a senha redigitada não condizem!</h2>";
	} else {
		$cod_func=$funcionariopa->logar2($_POST['login'],$_POST['email']);
		if (!$cod_func) {
			echo "<h2>Login e email não conferem com nenhum funcionário cadastrado!</h2>";
		} else {
			$funcionario=new Funcionario();
			$funcionario->setSenha($_POST['senha']);
			$funcionario->criptografar();
			if ($funcionariopa->alterarSenha($cod_func,$funcionario->getSenha())) {
				echo "<h2>Senha redefinida com sucesso!</h2>";
				echo "<meta http-equiv='refresh' content='2;url=funcionarios.php'>";
			} else {
				echo "<h2>Erro ao redefinir a senha! Tente novamente</h2>";
			}
		}
	}
}
?>
<?php include 'rodape.php'; ?>
</body>
</html>
