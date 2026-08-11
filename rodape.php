<footer class="rodape">
    <div class="rodape-topo">

        <div class="rodape-coluna rodape-marca-col">
            <div class="rodape-marca">
                <img src="img/icon.png" alt="Gamernac">
                <span>Gamernac</span>
            </div>
            <p class="rodape-descricao">
                Jogos, consoles e acessórios para elevar sua experiência
                no mundo gamer. Tradição e paixão por games em Ponta Grossa - PR.
            </p>
        </div>

        <div class="rodape-coluna">
            <h3>Navegação</h3>
            <a href="index.php">Início</a>
            <a href="sobre.php">Sobre</a>
            <a href="listarproduto.php">Produtos</a>
            <a href="listarjogo.php">Jogos</a>
        </div>

        <div class="rodape-coluna">
            <h3>Plataformas</h3>
            <a href="listarjogo.php?tipo=plataforma&termo=Playstation">PlayStation</a>
            <a href="listarjogo.php?tipo=plataforma&termo=Xbox">Xbox</a>
            <a href="listarproduto.php?tipo=tipo&termo=GiftCard">Gift Cards</a>
        </div>

        <div class="rodape-coluna">
            <h3>Minha Conta</h3>
            <a href="logarcadastrar.php">Entrar</a>
            <a href="cadastrar.php">Criar Conta</a>
        </div>

    </div>

    <div class="rodape-linha"></div>

    <div class="rodape-base">
        <p>&copy; <?= date('Y') ?> Gamernac. Todos os direitos reservados.</p>

        <div class="rodape-botoes">
            <a href="funcionarios.php" target="janela" class="botao-adm" title="Login do funcionário">
                FCN
            </a>
            <a href="administracao.php" target="janela" class="botao-adm" title="Login do administrador">
                ADM
            </a>
        </div>
    </div>
</footer>
