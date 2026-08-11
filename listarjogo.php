<?php 
require_once 'paineladm.php'; 
require_once 'persistence/jogoPA.php'; 

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
    echo "<th>Capa</th>"; 
    echo "<th>Nome</th>"; 
    echo "<th>Classificação</th>"; 
    echo "<th>Quantidade</th>"; 
    echo "<th>Genero</th>"; 
    echo "<th>Descrição</th>"; 
    echo "<th>Valor</th>";
    echo "<th>Adm";
    echo "<th>Jogo";
    echo "<th>Lanc";
    echo "<th>Plataforma"; 
    echo "</tr>"; 
    echo "</thead>"; 
    echo "<tbody>"; 
    
    while ($linha = $consulta->fetch_assoc()) { 
        $jogo->setCapa($linha['capa']); 
        $jogo->setNome($linha['nome']); 
        $jogo->setClassificacao($linha['classificacao']); 
        $jogo->setQuantidade($linha['quantidade']); 
        $jogo->setGenero($linha['genero']); 
        $jogo->setDescricao($linha['descricao']); 
        $jogo->setValor($linha['valor']);  
        $jogo->setCodAdm($linha['cod_adm']);  
        $jogo->setCodJogo($linha['cod_jogo']);  
        $jogo->setDataLanc($linha['data_lanc']);
        $jogo->setPlataforma($linha['plataforma']);

        echo "<tr>";
        echo "<td>"; 
        if (!empty($jogo->getCapa())) {
            echo "<img src='data:image/jpg;base64," . base64_encode(stripslashes($jogo->getCapa())) . "' width='50' height='50'>";
        } else {
            echo "Sem foto";
        }
        echo "</td>";
        echo "<td>" . $jogo->getNome() . "</td>"; 
        echo "<td>" . $jogo->getClassificacao() . "</td>"; 
        echo "<td>" . $jogo->getQuantidade() . "</td>";
        echo "<td>" . $jogo->getGenero() . "</td>";
         echo "<td>" . $jogo->getDescricao() . "</td>";
          echo "<td>" . $jogo->getValor() . "</td>";
          echo "<td>" . $jogo->getCodAdm() . "</td>"; echo "<td>" . $jogo->getCodJogo() . "</td>";echo "<td>" . $jogo->getDataLanc() . "</td>";
          echo "<td>" . $jogo->getPlataforma() . "</td>";echo "</tr>";
    } 
    
    echo "</tbody>"; 
    echo "</table>"; 
    echo "<section class='paginacao'>"; 
    
    if ($pagina > 1) { 
        $anterior = $pagina - 1; 
        echo "<a href='listarjogo.php?pagina=$anterior'> &lt;&lt;</a>"; 
    } 
    
    echo " página $pagina "; 
    $num_pag = ceil($total / $limite); 
    
    if ($pagina < $num_pag) { 
        $proximo = $pagina + 1; 
        echo "<a href='listarjogo.php?pagina=$proximo'> &gt;&gt;</a>"; 
    } 
    
    echo "</section>"; 
} 
?> 
</body> 
</html>
 