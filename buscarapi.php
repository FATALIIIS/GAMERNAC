<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'persistence/JogoPA.php';
require_once 'persistence/ProdutoPA.php';

$termo = isset($_GET['termo']) ? trim($_GET['termo']) : '';
$resposta = ['jogos' => [], 'produtos' => []];

if ($termo !== '') {

	$jogopa = new JogoPA();
	$consultaJogos = $jogopa->buscar($termo, 'nome');
	if ($consultaJogos) {
		$i = 0;
		while ($linha = $consultaJogos->fetch_assoc()) {
			if ($i >= 6) break;
			$resposta['jogos'][] = [
				'nome'       => $linha['nome'],
				'plataforma' => $linha['plataforma'],
				'valor'      => number_format($linha['valor'], 2, ',', '.'),
				'capa'       => !empty($linha['capa']) ? 'data:image/jpg;base64,' . base64_encode(stripslashes($linha['capa'])) : null
			];
			$i++;
		}
	}

	$produtopa = new ProdutoPA();
	$consultaProdutos = $produtopa->buscar($termo, 'nome');
	if ($consultaProdutos) {
		$i = 0;
		while ($linha = $consultaProdutos->fetch_assoc()) {
			if ($i >= 4) break;
			$resposta['produtos'][] = [
				'nome'   => $linha['nome'],
				'tipo'   => $linha['tipo'],
				'valor'  => number_format($linha['valor'], 2, ',', '.'),
				'imagem' => !empty($linha['imagem']) ? 'data:image/jpg;base64,' . base64_encode(stripslashes($linha['imagem'])) : null
			];
			$i++;
		}
	}
}

echo json_encode($resposta);
