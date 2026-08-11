<?php require_once 'paineladm.php'; ?>
<form action="cadastrofuncionario.php" method="POST" id="form">
<h1>Cadastro de Funcionário</h1>
	<p>Digite o nome:</p>
	<p><input type="text" name="nome" size="40" maxlength="40" pattern="[a-zA-Z-Z\sçÇÃáÁéÉíÍóÓúÚ]{2,40}" title="Somente letras, sem caracteres especiais" placeholder="Ex: Mariana"required></p>
		<p>CPF:</p>
		<p><input type="text" name="cpf" inputmode="numeric" maxlength="11" pattern="[0-9]{11}"
		title="Somente números, 11 dígitos" placeholder="Ex: 00000000000"required></p>
		<p>Data de Nascimento:</p>
		<?php
		$data_atual=new DateTime(date('Y-m-d'));
		$data_antiga=date_modify($data_atual,"-120 years")->format('Y-m-d');
		?>
		<p><input type="date" name="data_nasci" min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>" required></p>
        <p>Endereco:</p>
			<p><input type="text" name="endereco" size="50" maxlength="50" pattern="[0-9a-zA-Z\s,.çÇÃáÁéÉíÍóÓúÚ]{5,50}" placeholder="Ex: Rua Alameda, 500"required></p>
			<p>Telefone:</p>
			<p><input type="text" name="telefone" id="telefone" size="14" maxlength="14" placeholder="(42)99988-7777" title="Formato (XX)XXXXX-XXXX" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}" 
			required></p>
			<p>Login</p>
			<p><i>*letras e números,@,_,- de 5 a 20 caracteres</i></p>
			<p><input type="text" name="login" size="20" maxlength="20" title="letras e números,@,_,- de 5 a 20 caracteres" pattern="[0-9a-zA-Z@_-]{5,20}" placeholder="Ex: Username"required></p>
			<p>Senha:</p>
			<p><i>*letras e númros,@,_,- de 5 a 10 caracteres</i></p>
			<p><input type="password" name="senha" size="10" maxlength="10" pattern="[0-9a-zA-Z@_-]{5,20}" placeholder="Ex: Senha" required></p>
 			<p>Redigite a senha:</p>
 			<p><i>*letras e númros,@,_,- de 5 a 10 caracteres</i></p>
 			<p><input type="password" name="validar" size="10" maxlength="10" pattern="[0-9a-zA-Z@_-]{5,20}" placeholder="Ex: Redigite a Senha"required></p>
 			<p>Digite o email:</p>
 			<p><i>pode ser @gmail, @yahoo, @instituição_de_domínio</i></p>
 			<p><input type="email" name="email" size="50" maxlength="320" placeholder="Ex: mariana500@hotmail.com" required>
 			<p>Sexo:</p>
 			<p><input type="radio" name="sexo" value="M" required> M 
 			<p><input type="radio" name="sexo" value="F" required> F 
			<p><input type="submit" name="botao" value="Cadastrar"></p>
			<p><button><a href="inicioadm.php">Voltar</a></button>
</form>
<?php if (isset($_POST['botao'])) {
	require_once 'model/Funcionario.php';
	$funcionario=new Funcionario();
	$funcionario->setSenha($_POST['senha']);
		if($_POST['senha']!=$_POST['validar']){
			echo "<h2>A Senha e a senha redigitada não condizem!</h2>";
		}else{
			require_once 'persistence/FuncionarioPA.php';
			$funcionariopa=new FuncionarioPA();
			$funcionario->setCpf($_POST['cpf']);
			$funcionario->setLogin($_POST['login']);
			if(!$funcionariopa->verificar('cpf',$funcionario->getCpf())){
				echo "<h2>Este cpf já está está cadastrado!</h2>";
			}else{
				if(!$funcionariopa->verificar('login',$funcionario->getLogin())){
					echo "<h2>Este login já está em uso! Escolha outro</h2>";
				}else{
					$funcionario->criptografar();
					$funcionario->setNome($_POST['nome']);
					$funcionario->setCpf($_POST['cpf']);
					$funcionario->setTelefone($_POST['telefone']);
					$funcionario->setEndereco($_POST['endereco']);
					$funcionario->setDataNasci($_POST['data_nasci']);
					$funcionario->setEmail($_POST['email']);
					$funcionario->setSexo($_POST['sexo']);
					if($funcionariopa->cadastrar($funcionario)){
						echo "<h2>Funcionario cadastrado com sucesso</h2>";
					}else{
						echo "<h2>Erro na tentativa de cadastrar!Tente outra vez</h2>";
					}
				}
			}
		}
	}
?>
<?php include 'rodape.php'; ?>