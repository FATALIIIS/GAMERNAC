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
  private $data_lanc;
  private $plataforma;

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
    return $this->classificacao;
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
    $this->descricao=$descricao;
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
  public function setCodAdm($cod_adm)
  {
    $this->cod_adm=$cod_adm;
  }

  public function getCodAdm()
  {
    return $this->cod_adm;
  }
  public function setCodJogo($cod_jogo)
  {
    $this->cod_jogo=$cod_jogo;
  }

  public function getCodJogo()
  {
    return $this->cod_jogo;
  }
  public function setDataLanc($data_lanc)
  {
    $this->data_lanc=$data_lanc;
  }

  public function getDataLanc()
  {
    return $this->data_lanc;
  }
  public function setPlataforma($plataforma)
  {
    $this->plataforma=$plataforma;
  }

  public function getPlataforma()
  {
    return $this->plataforma;
  }
  public function verificarTamanho($imagem)
    {
        if (filesize($imagem)>65530) { //65Kb
            return false;
        }else{
            return true;
        }
    }

    public function criarImagem()
    {
        $this->capa=addslashes(file_get_contents($this->capa));
    }
}
?>



