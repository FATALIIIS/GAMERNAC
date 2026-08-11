<?php 
if (isset($_COOKIE['administrador'])){
require_once 'paineladm.php';
}else{
require_once 'painelfunc.php';
} 
require_once 'persistence/ProdutoPA.php'; 

$produtopa = new ProdutoPA(); 
$total = $produtopa->contar(); 

if ($total <= 0) { 
    echo "<h2>Não há produtos cadastrados!</h2>"; 
} else { 
    if (isset($_GET['pagina'])) { 
        $pagina = $_GET['pagina']; 
    } else { 
        $pagina = 1; 
    } 
    
    $limite = 2; 
    $offset = ($pagina - 1) * $limite; 
    $consulta = $produtopa->listar($limite, $offset); 
    
    require_once 'model/Produto.php'; 
    $produto = new Produto(); 
    
    echo "<table>"; 
    echo "<thead>"; 
    echo "<tr>"; 
    echo "<th>Código</th>"; 
    echo "<th>Nome</th>"; 
    echo "<th>Valor</th>"; 
    echo "<th>Descrição</th>"; 
    echo "<th>Imagem</th>"; 
    echo "<th>Quantidade</th>"; 
    echo "<th>Tipo</th>";
    echo "</tr>"; 
    echo "</thead>"; 
    echo "<tbody>"; 
    
    while ($linha = $consulta->fetch_assoc()) { 
        $produto->setCodProd($linha['cod_prod']); 
        $produto->setNome($linha['nome']); 
        $produto->setValor($linha['valor']); 
        $produto->setDescricao($linha['descricao']); 
        $produto->setImagem($linha['imagem']); 
        $produto->setQuantidade($linha['quantidade']); 
        $produto->setTipo($linha['tipo']);  
        
        echo "<tr>"; 
        echo "<td>" . $produto->getCodProd() . "</td>"; 
        echo "<td>" . $produto->getNome() . "</td>"; 
        echo "<td>" . $produto->getValor() . "</td>"; 
        echo "<td>" . $produto->getDescricao() . "</td>"; 
        echo "<td>";
        if (!empty($produto->getImagem())) {
            echo "<img src='data:image/jpg;base64," . base64_encode(stripslashes($produto->getImagem())) . "' width='50' height='50'>";
        } else {
            echo "Sem foto";
        }
        echo "</td>"; 
        echo "<td>" . $produto->getQuantidade() . "</td>";
        echo "<td>" . $produto->getTipo() . "</td>";
        echo "</tr>"; 
    } 
    
    echo "</tbody>"; 
    echo "</table>"; 
    echo "<section class='paginacao'>"; 
    
    if ($pagina > 1) { 
        $anterior = $pagina - 1; 
        echo "<a href='alteraproduto.php?pagina=$anterior'> &lt;&lt;</a>"; 
    } 
    
    echo " página $pagina "; 
    $num_pag = ceil($total / $limite); 
    
    if ($pagina < $num_pag) { 
        $proximo = $pagina + 1; 
        echo "<a href='alteraproduto.php?pagina=$proximo'> &gt;&gt;</a>"; 
    } 
    
    echo "</section>"; 
} 
?>
<section>
<li><a id="voltar" href="inicioadm.php">Voltar</a></li>
</section>
<?php include 'rodape.php'; ?>
</body> 
</html>
