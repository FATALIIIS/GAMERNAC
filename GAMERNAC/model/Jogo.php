<?php

class Jogo{

  private $capa;
  private $nome; 
  private $classificacao;
  private $quantidade;
  private $genero;
  private $descricao;
  private $valor;
  private $cod_adm;
  private $cod_jogo;
  private $cod_lanc;

  public function setCapa($capa)
  {
    $this->capa=$capa;
  }

  public function getCapa()
  {
    return $this->capa;
  }
  public function setNome($nome)
  {
    $this->nome=$nome;
  }

  public function getNome()
  {
    return $this->nome;
  }
  public function setClassificacao($classificacao)
  {
    $this->classificacao=$classificacao;
  }

  public function getClassificacao()
  {
    return $this->clasificacao;
  }
  public function setQuantidade($quantidade)
  {
    $this->quantidade=$quantidade;
  }

  public function getQuantidade()
  {
    return $this->quantidade;
  }
  public function setGenero($genero)
  {
    $this->genero=$genero;
  }

  public function getGenero()
  {
    return $this->genero;
  }
  public function setDescricao($descricao)
  {
    $this->descricao=$Descricao;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }
  public function setValor($valor)
  {
    $this->valor=$valor;
  }

  public function getValor()
  {
    return $this->valor;
  }
  public function setCod_adm($cod_adm)
  {
    $this->cod_adm=$cod_adm;
  }

  public function getCod_adm()
  {
    return $this->Cod_adm;
  }
  public function setCod_jogo($Cod_jogo)
  {
    $this->Cod_jogo=$Cod_jogo;
  }

  public function getCod_jogo()
  {
    return $this->cod_jogo;
  }
  public function setCod_lanc($Cod_lanc)
  {
    $this->Cod_lanc=$Cod_lanc;
  }

  public function getCod_lanc()
  {
    return $this->Cod_lanc;
  }
}
?>



