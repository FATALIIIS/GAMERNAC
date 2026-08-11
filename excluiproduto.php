<?php 
require_once 'paineladm.php'; 
require_once 'persistence/ProdutoPA.php'; 

$produtopa = new ProdutoPA(); 
$total = $produtopa->contar(); 

if ($total <= 0) { 
    echo "<h2>Não há produtos cadastrados.</h2>";
    echo "<li><a href='paineladm.php'>Voltar</a></li>"; 
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
    echo "<th>Código do Produto</th>"; 
    echo "<th>Nome</th>";
    echo "<th>Excluir Produto</th>";  
    echo "</tr>"; 
    echo "</thead>"; 
    echo "<tbody>"; 
    
    while ($linha = $consulta->fetch_assoc()) { 
        $produto->setCodProd($linha['cod_prod']); 
        $produto->setNome($linha['nome']);  
        
        echo "<tr>"; 
        echo "<td>" . $produto->getCodProd() . "</td>"; 
        echo "<td>" . $produto->getNome() . "</td>";
        echo "<td><a id=excluir href='excluirproduto.php?cod_func=".$produto->getCodProd()."'>Excluir</a></td>";
        echo "</tr>"; 
    } 
    
    echo "</tbody>"; 
    echo "</table>"; 
    echo "<section class='paginacao'>"; 
    
    if ($pagina > 1) { 
        $anterior = $pagina - 1; 
        echo "<a href='excluiproduto.php?pagina=$anterior'> &lt;&lt;</a>"; 
    } 
    
    echo " página $pagina "; 
    $num_pag = ceil($total / $limite); 
    
    if ($pagina < $num_pag) { 
        $proximo = $pagina + 1; 
        echo "<a href='excluiproduto.php?pagina=$proximo'> &gt;&gt;</a>"; 
    } 
    
    echo "</section>"; 
} 
?>
<section>
<li><a id="voltar" href="paineladm.php">Voltar</a></li>
</section>
<?php include 'rodape.php'; ?>
</body> 
</html>
