<?php require_once 'menu.php'; ?>

<section class="busca-resultados">
    <h1 class="busca-titulo">Meu Carrinho</h1>

    <div id="carrinho-vazio" class="busca-vazio" style="display:none;">
        <p>Seu carrinho está vazio.</p>
        <a href="listarjogo.php" class="hero-btn2 carrinho-vazio-btn">Ver jogos</a>
    </div>

    <div id="carrinho-lista" class="carrinho-lista"></div>

    <div id="carrinho-resumo" class="carrinho-resumo" style="display:none;">
        <span>Total</span>
        <strong id="carrinho-total">R$ 0,00</strong>
        <a href="#" class="hero-btn" id="carrinho-finalizar">Finalizar compra</a>
    </div>
</section>

<?php include 'rodape.php'; ?>

<script>
var clienteLogado = <?php echo isset($_COOKIE['cliente']) ? 'true' : 'false'; ?>;

function formatarPreco(valor) {
    return 'R$ ' + valor.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function obterCarrinho() {
    return JSON.parse(localStorage.getItem('carrinho') || '[]');
}

function salvarCarrinho(carrinho) {
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
}

function removerItem(indice) {
    var carrinho = obterCarrinho();
    carrinho.splice(indice, 1);
    salvarCarrinho(carrinho);
    renderizarCarrinho();
}

function renderizarCarrinho() {
    var carrinho = obterCarrinho();
    var lista = document.getElementById('carrinho-lista');
    var vazio = document.getElementById('carrinho-vazio');
    var resumo = document.getElementById('carrinho-resumo');
    var totalEl = document.getElementById('carrinho-total');
    var contadorTopo = document.getElementById('carrinho-contador');

    lista.innerHTML = '';

    if (carrinho.length === 0) {
        vazio.style.display = 'block';
        resumo.style.display = 'none';
        if (contadorTopo) contadorTopo.style.display = 'none';
        return;
    }

    vazio.style.display = 'none';
    resumo.style.display = 'flex';

    var total = 0;
    carrinho.forEach(function (item, indice) {
        total += Number(item.preco);

        var linha = document.createElement('div');
        linha.className = 'carrinho-item';

        var fotoHtml = item.imagem
            ? '<img src="' + item.imagem + '" alt="' + item.nome + '">'
            : '<span class="carrinho-item-sem-foto">🎮</span>';

        var tooltipHtml = item.descricao
            ? '<span class="carrinho-item-tooltip">' + item.descricao + '</span>'
            : '';

        linha.innerHTML =
            '<div class="carrinho-item-foto">' + fotoHtml + tooltipHtml + '</div>' +
            '<span class="carrinho-item-nome">' + item.nome + '</span>' +
            '<span class="carrinho-item-preco">' + formatarPreco(item.preco) + '</span>' +
            '<button type="button" class="carrinho-item-remover" title="Remover">✕</button>';

        linha.querySelector('.carrinho-item-remover').addEventListener('click', function () {
            removerItem(indice);
        });

        lista.appendChild(linha);
    });

    totalEl.textContent = formatarPreco(total);

    if (contadorTopo) {
        contadorTopo.textContent = carrinho.length;
        contadorTopo.style.display = 'flex';
    }
}

document.getElementById('carrinho-finalizar').addEventListener('click', function (e) {
    e.preventDefault();
    if (clienteLogado) {
        window.location.href = 'checkout.php';
    } else {
        window.location.href = 'logarcadastrar.php';
    }
});

renderizarCarrinho();
</script>
</body>
</html>
