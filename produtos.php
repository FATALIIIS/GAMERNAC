<?php 
require_once 'menu.php'; 
require_once 'persistence/ProdutoPA.php'; 

$produtopa = new ProdutoPA(); 
$total = $produtopa->contar();

if ($total <= 0) { 

    echo "<section class='busca-resultados'>";
    echo "<h2 class='busca-titulo'>Não há produtos cadastrados.</h2>";
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
    $consulta = $produtopa->listar($limite,$offset);

    if(!$consulta){

        echo "<section class='busca-resultados'>";
        echo "<h2 class='busca-titulo'>Não há produtos cadastrados para esse filtro.</h2>";
        echo "<a href='listarproduto.php' class='hero-btn2'>Ver todos os produtos</a>";
        echo "</section>";

    } else {

        $total_res=$consulta->num_rows;  
        require_once 'model/Produto.php'; 
        $produto = new Produto(); 

        echo "<section class='busca-resultados'>";
        echo "<h1 class='busca-titulo'>Produtos</h1>";
        echo "<div class='cartaz-grid'>";

        while ($linha = $consulta->fetch_assoc()) {
            $produto->setCodProd($linha['cod_prod']); 
            $produto->setNome($linha['nome']); 
            $produto->setValor($linha['valor']); 
            $produto->setDescricao($linha['descricao']); 
            $produto->setImagem($linha['imagem']); 
            $produto->setQuantidade($linha['quantidade']); 
            $produto->setTipo($linha['tipo']);

            $imagemProduto = '';
            $classeCartaz = 'jogo-banner sem-capa';
            $estiloBg = '';
            if (!empty($produto->getImagem())) {
                $imagemProduto = 'data:image/jpg;base64,' . base64_encode(stripslashes($produto->getImagem()));
                $estiloBg = " style=\"background-image:url('" . $imagemProduto . "')\"";
                $classeCartaz = 'jogo-banner';
            }

            echo "<div class='" . $classeCartaz . "'" . $estiloBg . ">";
            echo "<div class='jogo-banner-overlay'></div>";
            echo "<div class='jogo-banner-conteudo'>";
            echo "<span class='tag'>" . htmlspecialchars($produto->getTipo()) . "</span>";
            echo "<h2 class='jogo-banner-titulo'>" . htmlspecialchars($produto->getNome()) . "</h2>";
            echo "<p class='jogo-banner-descricao'>" . htmlspecialchars($produto->getDescricao()) . "</p>";
            echo "<div class='jogo-banner-info'>";
            echo "<div class='jogo-banner-precos'>";
            echo "<span class='preco-novo'>R$ " . number_format($produto->getValor(), 2, ',', '.') . "</span>";
            echo "</div>";
            echo "</div>";
            echo "<div class='jogo-banner-acoes'>";
            echo "<button type='button' class='busca-card-carrinho' onclick=\"adicionarCarrinho('" . htmlspecialchars($produto->getNome(), ENT_QUOTES) . "', " . $produto->getValor() . ", this, '" . htmlspecialchars($imagemProduto, ENT_QUOTES) . "', '" . htmlspecialchars($produto->getDescricao(), ENT_QUOTES) . "')\">🛒 Adicionar ao carrinho</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } 
        echo "</div>";

        echo "<section class='paginacao'>"; 

        if ($pagina > 1) { 
            $anterior = $pagina - 1; 
            echo "<a href='listarproduto.php?pagina=$anterior&tipo=$tipo&termo=$termo&valor=$valor'> &lt;&lt;</a>"; 
        } 

        echo " página $pagina "; 
        $num_pag = ceil($total_res / $limite); 

        if ($pagina < $num_pag) { 
            $proximo = $pagina + 1; 
            echo "<a href='listarproduto.php?pagina=$proximo&tipo=$tipo&termo=$termo&valor=$valor'> &gt;&gt;</a>"; 
        } 

        echo "</section>"; 
        echo "</section>";
    }
}
?>

<?php include 'rodape.php'; ?>
</body> 
</html>
