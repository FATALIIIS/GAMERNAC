<?php 
require_once 'menu.php'; 
require_once 'persistence/JogoPA.php'; 

$jogopa = new JogoPA(); 
$total = $jogopa->contar();

if ($total <= 0) { 

    echo "<section class='busca-resultados'>";
    echo "<h2 class='busca-titulo'>Não há jogos cadastrados.</h2>";
    echo "<a href='index.php' class='hero-btn2'>Voltar ao início</a>";
    echo "</section>";

} else { 

    if (isset($_GET['pagina'])) { 
        $pagina = $_GET['pagina']; 
    } else { 
        $pagina = 1; 
    }
    
    $limite = 2; 
    $offset = ($pagina - 1) * $limite; 
    $consulta = $jogopa->listar($limite,$offset);

    if(!$consulta){

        echo "<section class='busca-resultados'>";
        echo "<h2 class='busca-titulo'>Não há jogos cadastrados para esse filtro.</h2>";
        echo "<a href='listarjogo.php' class='hero-btn2'>Ver todos os jogos</a>";
        echo "</section>";

    } else {

        $total_res=$consulta->num_rows;  
        require_once 'model/Jogo.php'; 
        $jogo = new Jogo(); 

        echo "<section class='busca-resultados'>";
        echo "<h1 class='busca-titulo'>Jogos</h1>";
        echo "<div class='cartaz-grid'>";

        while ($linha = $consulta->fetch_assoc()) {
            $jogo->setCodJogo($linha['cod_jogo']); 
            $jogo->setNome($linha['nome']); 
            $jogo->setGenero($linha['genero']); 
            $jogo->setDataLanc($linha['data_lanc']); 
            $jogo->setValor($linha['valor']); 
            $jogo->setClassificacao($linha['classificacao']); 
            $jogo->setCapa($linha['capa']);
            $jogo->setDescricao($linha['descricao']);
            $jogo->setQuantidade($linha['quantidade']);
            $jogo->setPlataforma($linha['plataforma']);

            $imagemJogo = '';
            $classeCartaz = 'jogo-banner sem-capa';
            $estiloBg = '';
            if (!empty($jogo->getCapa())) {
                $imagemJogo = 'data:image/jpg;base64,' . base64_encode(stripslashes($jogo->getCapa()));
                $estiloBg = " style=\"background-image:url('" . $imagemJogo . "')\"";
                $classeCartaz = 'jogo-banner';
            }

            echo "<div class='" . $classeCartaz . "'" . $estiloBg . ">";
            echo "<div class='jogo-banner-overlay'></div>";
            echo "<div class='jogo-banner-conteudo'>";
            echo "<span class='tag'>" . htmlspecialchars($jogo->getGenero()) . "</span>";
            echo "<h2 class='jogo-banner-titulo'>" . htmlspecialchars($jogo->getNome()) . "</h2>";
            echo "<p class='jogo-banner-descricao'>" . htmlspecialchars($jogo->getDescricao()) . "</p>";
            echo "<div class='jogo-banner-info'>";
            echo "<div class='jogo-banner-precos'>";
            echo "<span class='preco-novo'>R$ " . number_format($jogo->getValor(), 2, ',', '.') . "</span>";
            echo "</div>";
            echo "</div>";
            echo "<div class='jogo-banner-acoes'>";
            echo "<button type='button' class='busca-card-carrinho' onclick=\"adicionarCarrinho('" . htmlspecialchars($jogo->getNome(), ENT_QUOTES) . "', " . $jogo->getValor() . ", this, '" . htmlspecialchars($imagemJogo, ENT_QUOTES) . "', '" . htmlspecialchars($jogo->getDescricao(), ENT_QUOTES) . "')\">🛒 Adicionar ao carrinho</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } 
        echo "</div>";

        echo "<section class='paginacao'>"; 

        if ($pagina > 1) { 
            $anterior = $pagina - 1; 
            echo "<a href='listarjogo.php?pagina=$anterior&tipo=$tipo&termo=$termo&valor=$valor'> &lt;&lt;</a>"; 
        } 

        echo " página $pagina "; 
        $num_pag = ceil($total_res / $limite); 

        if ($pagina < $num_pag) { 
            $proximo = $pagina + 1; 
            echo "<a href='listarjogo.php?pagina=$proximo&tipo=$tipo&termo=$termo&valor=$valor'> &gt;&gt;</a>"; 
        } 

        echo "</section>"; 
        echo "</section>";
    }
}
?>

<?php include 'rodape.php'; ?>
</body> 
</html>
