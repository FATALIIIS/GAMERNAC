<?php require_once 'cabecalho.php';?>
<!DOCTYPE html>
<html lang="PT-BR">
<meta charset="UTF-8">
<title>GAMERNAC</title>
<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<section class="home">
	<div id="logo">
		<a href="index.php">
			<img src="img/logo.png">
		</a>
	</div>
	<div id="menu">
		<ul class="class-nav">
		<li><a href="index.php">HOME</a></li>
<li>
<a href="#">PRODUTOS</a>
<ul class="submenu">
<li><a href="produtos.php">TODOS OS PRODUTOS</a></li>
<li><a href="produtos.php?cat=playstation">PLAYSTATION</a></li>
<li><a href="produtos.php?cat=xbox">XBOX</a></li>
<li><a href="produtos.php?cat=pc">PC</a></li>
</ul>
</li>
<?php
session_start();
if (!isset($_SESSION['cliente'])):
		?>	
			<li><a href="cadastrarcliente.php">Cadastrar</a></li>
<li><a href="login.php">Login</a></li>
<li><a href="sobre.php">Sobre</a></li>
<li><a href="administracao.php"><img src="img/chave.png" id="ico">Administração</a></li>
<?php elseif (isset($_SESSION['cliente']) && $_SESSION['nivel'] == 'cliente'):
?>
<li>Loja de Jogos
<ul>
<li><a href="cadastrarcliente.php">Cadastrar</a></li>
<li><a href="listarcliente.php">Listar</a></li>
</ul>
</li>
<li><a href="alterarcliente.php">Meus Dados</a></li>
<li><a href="carrinho.php">Carrinho</a></li>
<li><a href="adicionar.php">Adicionar ao Carrinho</a></li>
<li><a href="logoffcliente.php">Sair</a></li>

<?php elseif (isset($_SESSION['cliente']) && $_SESSION['nivel'] == 'admin'):?>
<li>Clientes
<ul>
<li><a href="listarcliente.php">Listar</a></li>
<li><a href="buscarcliente.php">Buscar</a></li>
</ul>
</li>
<li><a href="painel.php">PAINEL ADM</a></li>
<li><a href="logoffcliente.php">Sair</a></li>
<?php endif; ?>
</ul>
</div>
</section>

