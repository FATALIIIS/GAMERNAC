<?php 
if (isset($_COOKIE['administrador'])){
require_once 'paineladm.php';
}else{
require_once 'painelfunc.php';
}
?>

<form action="cadastrarproduto.php" method="POST" id="form" enctype="multipart/form-data">
<h1>Cadastro de Produtos</h1>
  <p>Digite o nome do produto:</p>
  <p><input type="text" name="nome" size="40" maxlength="40" placeholder="Ex: Controle DualSense - PlayStation 5" pattern="[a-zA-Z-Z\s.çÇÃáÁéÉíÍóÓúÚ]{2,40}"
    title="Somente letras, sem caracteres especiais" required></p>
    <p>Digite o valor:</p>
    <p><input type="number" name="valor" min="00000000000" max="99999999999" placeholder="Ex: R$:100,00" pattern="[0-9]{11}" title="Somente números" required></p>
    <p>Descrição:</p>
    <p><input type="text" name="descricao" size="50" maxlength="1000" placeholder="Ex: O controle DualSense do PlayStation 5 é um controle..." required></p>
    <p>Foto do Produto:</p>
    <i>Máximo 65Kb</i>
    <p><input type="file" name="imagem" accept="jpg,png,gif,bmp" required></p>
    <p>Quantidade:</p>
    <p><input type="text" name="quantidade" id="quantidade" size="14" maxlength="14" placeholder="Ex: 10" title="Ex: 5" pattern="{1,5}" required></p>
    <p>Escolha o tipo do produto:</p>
    <p><input type="radio" name="tipo" value="Consoles" required>Consoles
    <p><input type="radio" name="tipo" value="Periféricos" required>Periféricos
    <p><input type="radio" name="tipo" value="Acessórios" required>Acessórios
    <p><input type="radio" name="tipo" value="GiftCard" required>Gift Cards
    <p><input type="submit" name="botao" value="Cadastrar"></p>
    <p><button><a href="inicioadm.php">Voltar</a></button>  
</form>
<?php if (isset($_POST['botao'])) {
  require_once 'model/Produto.php';
  require_once 'persistence/ProdutoPA.php';
      $produto=new Produto();
      $produtopa=new ProdutoPA();
      $produto->setNome($_POST['nome']);
      if(!$produtopa->verificar('nome',$produto->getNome())){
        echo "<h2>Este produto já está está cadastrado!</h2>";
      }else{
          $produto->setNome($_POST['nome']);
          $produto->setValor($_POST['valor']);
          $produto->setDescricao($_POST['descricao']);
          $produto->setImagem($_FILES['imagem']['tmp_name']);
          if(!$produto->verificarTamanho($produto->getImagem())){
          echo "<h2>Imagem muito grande! Limite 65Kb!</h2>";
          }else{
          $produto->criarImagem();
          $produto->setQuantidade($_POST['quantidade']);
          $produto->setTipo($_POST['tipo']);
          if($produtopa->cadastrar($produto)){
            echo "<h2>Produto cadastrado com sucesso</h2>";
          }else{
            echo "<h2>Erro na tentativa de cadastrar o produto! Tente novamente.</h2>";
          }
        }
      }
    }
?>
<?php include 'rodape.php'; ?>
