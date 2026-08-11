<?php 
require_once 'paineladm.php'; 
require_once 'persistence/JogoPA.php'; 

$jogopa = new JogoPA(); 
$total = $jogopa->contar(); 

if ($total <= 0) { 
    echo "<h2>Não há jogos cadastrados.</h2>";
    echo "<li><a href='paineladm.php'>Voltar</a></li>"; 
} else { 
    if (isset($_GET['pagina'])) { 
        $pagina = $_GET['pagina']; 
    } else { 
        $pagina = 1; 
    } 
    
    $limite = 2; 
    $offset = ($pagina - 1) * $limite; 
    $consulta = $jogopa->listar($limite, $offset); 
    
    require_once 'model/Jogo.php'; 
    $jogo = new Jogo(); 
    
    echo "<table>"; 
    echo "<thead>"; 
    echo "<tr>"; 
    echo "<th>Código do Jogo</th>"; 
    echo "<th>Nome</th>";
    echo "<th>Excluir Jogo</th>";  
    echo "</tr>"; 
    echo "</thead>"; 
    echo "<tbody>"; 
    
    while ($linha = $consulta->fetch_assoc()) { 
        $jogo->setCodJogo($linha['cod_jogo']); 
        $jogo->setNome($linha['nome']);  
        
        echo "<tr>"; 
        echo "<td>" . $jogo->getCodJogo() . "</td>"; 
        echo "<td>" . $jogo->getNome() . "</td>";
        echo "<td><a id=excluir href='excluirjogo.php?cod_jogo=".$jogo->getCodJogo()."'>Excluir</a></td>";
        echo "</tr>"; 
    } 
    
    echo "</tbody>"; 
    echo "</table>"; 
    echo "<section class='paginacao'>"; 
    
    if ($pagina > 1) { 
        $anterior = $pagina - 1; 
        echo "<a href='excluijogo.php?pagina=$anterior'> &lt;&lt;</a>"; 
    } 
    
    echo " página $pagina "; 
    $num_pag = ceil($total / $limite); 
    
    if ($pagina < $num_pag) { 
        $proximo = $pagina + 1; 
        echo "<a href='excluijogo.php?pagina=$proximo'> &gt;&gt;</a>"; 
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
