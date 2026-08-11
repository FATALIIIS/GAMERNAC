<?php require_once 'menu.php'; ?>
<form action="cadastrar.php" method="POST" id="form">
<h1>Cadastro de Cliente</h1>
	<p>Digite o nome:</p>
	<p><input type="text" name="nome" size="40" maxlength="40" pattern="[a-zA-Z\sçÇÃáÁéÉíÍóÓúÚ]{2,40}" title="Somente letras, sem caracteres especiais" required></p>
	
	<p>CPF:</p>
	<p><input type="text" name="cpf" maxlength="11" pattern="[0-9]{11}" title="Somente os 11 números do CPF" required></p>
	
	<p>Data de Nascimento:</p>
	<?php
	$data_atual = new DateTime(date('Y-m-d'));
	$data_antiga = date_modify($data_atual, "-120 years")->format('Y-m-d');
	?>
	<p><input type="date" name="data_nasci" min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>" required></p>
    
	<p>Endereco:</p>
	<p><input type="text" name="endereco" size="50" maxlength="50" pattern="[0-9a-zA-Z\s,.çÇÃáÁéÉíÍóÓúÚ]{5,50}" required></p>
	
	<p>Telefone:</p>
	<p><input type="text" name="telefone" id="telefone" size="14" maxlength="15" placeholder="(99)99999-9999" title="Formato (XX)XXXXX-XXXX" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}" required></p>
	
	<p>Login:</p>
	<p><input type="text" name="login" size="20" maxlength="20" title="letras e números,@,_,- de 5 a 20 caracteres" pattern="[0-9a-zA-Z@_,-]{5,20}" required></p>
	
	<p>Senha:</p>
	<p><input type="password" name="senha" size="10" maxlength="10" pattern="[0-9a-zA-Z@_,-]{5,20}" required></p>
	
	<p>Redigite a senha:</p>
	<p><input type="password" name="validar" size="10" maxlength="10" pattern="[0-9a-zA-Z@_,-]{5,20}" required></p>
	
	<p>Digite o email:</p>
	<p><input type="email" name="email" size="50" maxlength="320" required></p>
	
	<p>Digite o sexo:</p>
	<p style="text-align: center;">
		<input type="radio" name="sexo" value="M" required> Masculino
		<input type="radio" name="sexo" value="F" required> Feminino
	</p>
	
	<p><input type="submit" name="botao" value="Cadastrar"></p>
	<li><a href="index.php">Voltar</a></li> 	
</form>

<?php if (isset($_POST['botao'])) {
	require_once 'model/Cliente.php';
	$cliente=new CLiente();
	$cliente->setSenha($_POST['senha']);
		if($cliente->getSenha($_POST['senha'])!=$_POST['validar']){
			echo "<h2>A Senha e a senha redigitada não condizem!</h2>";
		}else{
			require_once 'persistence/ClientePA.php';
			$clientepa=new ClientePA();
			$cliente->setCpf($_POST['cpf']);
			$cliente->setLogin($_POST['login']);
			if(!$clientepa->verificar('cpf',$cliente->getCpf())){
				echo "<h2>Este cpf já está está cadastrado!</h2>";
			}else{
				if(!$clientepa->verificar('login',$cliente->getLogin())){
					echo "<h2>Este login já está em uso! Escolha outro</h2>";
				}else{
					$cliente->criptografar();
					$cliente->setNome($_POST['nome']);
					$cliente->setTelefone($_POST['telefone']);
					$cliente->setEndereco($_POST['endereco']);
					$cliente->setDataNasci($_POST['data_nasci']);
					$cliente->setEmail($_POST['email']);
					$cliente->setSexo($_POST['sexo']);
					if($clientepa->cadastrar($cliente)){
						echo "<h2>Cliente cadastrado com sucesso</h2>";
						echo "<meta http-equiv='refresh' content='2;url=logarcadastrar.php'>";
					}else{
						echo "<h2>Erro na tentativa de cadastrar!Tente outra vez</h2>";
					}
				}
			}
		}
	}
?>
<?php include 'rodape.php'; ?>
