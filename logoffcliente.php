<?php
if (isset($_COOKIE['cliente'])) {
	require_once 'model/Cliente.php';
	$cliente=new Cliente();
	$cliente->deslogar();
	header('Location:index.php');
	exit();
}
?>