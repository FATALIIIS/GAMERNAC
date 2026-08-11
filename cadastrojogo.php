<?php require_once 'paineladm.php'; ?>
<form action="cadastrojogo.php" method="POST" id="form" enctype="multipart/form-data">
<h1>Cadastro de Jogos</h1>
  <p>Digite o nome do jogo:</p>
  <p><input type="text" name="nome" size="40" maxlength="40" placeholder="Ex: Grand Theft Auto V" pattern="[a-zA-Z-Z\sçÇÃáÁéÉíÍóÓúÚ]{2,40}"
    title="Somente letras, sem caracteres especiais" required></p>
  <p>Digite a plataforma:</p>
  <p><input type="text" name="plataforma" size="40" maxlength="40" placeholder="Ex: PlayStation 5" pattern="[a-zA-Z-Z\sçÇÃáÁéÉíÍóÓúÚ]{2,40}"
    title="Somente letras, sem caracteres especiais" required></p>
  <p>Digite o gênero:</p>
  <p><input type="text" name="genero" size="40" maxlength="40" placeholder="Ex: Aventura" pattern="[a-zA-Z-Z\,sçÇÃáÁéÉíÍóÓúÚ]{2,40}" required></p>
  <p>Data de Lançamento:</p>
  <?php
  $data_atual=new DateTime(date('Y-m-d'));
  $data_antiga=date_modify($data_atual,"-68 years")->format('Y-m-d');
  ?>
  <p><input type="date" name="data_lanc" min="<?= $data_antiga ?>" max="<?= date('Y-m-d') ?>" required></p>
    <p>Digite o valor:</p>
    <p><input type="number" name="valor" min="1" max="999" placeholder="Ex: R$:100,00" step="0.01" title="Somente números" required></p>
    <p>Classificação:</p>
    <p><input type="radio" name="classificacao" value="Livre" required>Livre
    <p><input type="radio" name="classificacao" value="10 Anos+" required>10 Anos+
    <p><input type="radio" name="classificacao" value="12 Anos+" required>12 Anos+
    <p><input type="radio" name="classificacao" value="14 Anos+" required>14 Anos+
    <p><input type="radio" name="classificacao" value="16 Anos+" required>16 Anos+
    <p><input type="radio" name="classificacao" value="18 Anos+" required>18 Anos+
    <p>Capa:</p>
    <i>Máximo 65Kb</i>
    <p><input type="file" name="capa" accept="jpg,png,gif,bmp,webp" required></p>
    <p>Descrição:</p>
    <p><input type="text" name="descricao" size="50" maxlength="500" placeholder="Ex: Grand Theft Auto V se passa em Los Santos..." required></p>
    <p>Quantidade:</p>
    <p><input type="text" name="quantidade" id="quantidade" size="1" maxlength="9999" placeholder="Ex: 10" pattern="[0-9]{1,4}" 
    required></p>
    <p><input type="submit" name="botao" value="Cadastrar"></p>
   <li><a href="inicioadm.php">Voltar</a></li>  
</form>
<?php if (isset($_POST['botao'])) {
  require_once 'model/Jogo.php';
  require_once 'persistence/JogoPA.php';
      $jogo=new Jogo();
      $jogopa=new JogoPA();
      $jogo->setNome($_POST['nome']); 
      $jogo->setPlataforma($_POST['plataforma']);
      if(!$jogopa->verificar('nome',$jogo->getNome())&&!$jogopa->verificar("plataforma",$jogo->getPlataforma())){
        echo "<h2>Este jogo já está cadastrado!</h2>";
      }else{
          $jogo->setNome($_POST['nome']);
          $jogo->setGenero($_POST['genero']);
          $jogo->setDataLanc($_POST['data_lanc']);
          $jogo->setValor($_POST['valor']);
          $jogo->setClassificacao($_POST['classificacao']);
          $jogo->setCapa($_FILES['capa']['tmp_name']);
            if(!$jogo->verificarTamanho($jogo->getCapa())){
            echo "<h2>Imagem de capa muito grande! Limite 65Kb!</h2>";
            }else{
          $jogo->criarImagem();
          $jogo->setDescricao($_POST['descricao']);
          $jogo->setQuantidade($_POST['quantidade']);       
          $jogo->setCodAdm($_COOKIE['administrador']);
          if($jogopa->cadastrar($jogo)){
            echo "<h2>Jogo cadastrado com sucesso</h2>";
          }else{
            echo "<h2>Erro na tentativa de cadastrar o jogo! Tente novamente.</h2>";
          }
        }
      }
    }
?>
<?php include 'rodape.php'; ?>
