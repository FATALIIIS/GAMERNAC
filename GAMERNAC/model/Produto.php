<?php
class Produto
{
    private $nome;
    private $valor;
    private $tipo;
    private $descricao;
    private $imagem;
    private $cod_prod;
    private $quantidade;
    private $cod_adm;

  	public function setNome($nome)
  	{
  		$this->nome=$nome;
  	}

  	public function getNome()
  	{
  		return $this->nome;
  	}
  	public function setValor($valor)
  	{
  		$this->valor=$valor;
  	}

  	public function getValor()
  	{
  		return $this->valor;
  	}
  	public function setTipo($tipo)
  	{
  		$this->tipo=$tipo;
  	}

  	public function getTipo()
  	{
  		return $this->tipo;
  	}
  	public function setDescricao($descricao)
  	{
  		$this->descricao=$descricao;
  	}

  	public function getDescricao()
  	{
  		return $this->descricao;
  	}
  	public function setImagem($imagem)
  	{
  		$this->imagem=$imagem;
  	}

  	public function getImagem()
  	{
  		return $this->imagem;
  	}
  	public function setCodProd($cod_prod)
  	{
  		$this->cod_prod=$cod_prod;
  	}

  	public function getCodProd()
  	{
  		return $this->cod_prod;
  	}
  	public function setQuantidade($quantidade)
  	{
  		$this->quantidade=$quantidade;
  	}

  	public function getQuantidade()
  	{
  		return $this->quantidade;
  	}
  	public function setCodAdm($cod_adm)
  	{
  		$this->cod_adm=$cod_adm;
  	}

  	public function getCodAdm()
  	{
  		return $this->cod_adm;
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
        $this->imagem=addslashes(file_get_contents($this->imagem));
    }
}

}