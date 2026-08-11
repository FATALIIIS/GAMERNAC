<?php require_once 'Banco.php';

class ProdutoPA{

	private $con;

	public function __construct()
	{
		$this->con=new Banco();
	}
	public function cadastrar($produto)
	{
		$sql="INSERT INTO produtos(nome,valor,descricao,imagem,quantidade,tipo,cod_adm)
		VALUES(?,?,?,?,?,?,?)";
		$campos=[$produto->getNome(),$produto->getValor(),$produto->getDescricao(),$produto->getImagem(),$produto->getQuantidade(),$produto->getTipo(),$produto->getCodAdm()];
		$resposta=$this->con->executar($sql,$campos,"sdssisi");
		$this->con->desconectar();
		return $resposta;
	}
	public function verificar($campo,$valor)
	{
		$sql="SELECT $campo FROM produtos WHERE $campo=?";
		$consulta=$this->con->consultar($sql,[$valor],"s");
		if(!$consulta){
			return true;
		}else{
			return false;
		}
	}
	public function listar($limite,$offset){
		$sql="SELECT * FROM produtos ORDER BY cod_prod LIMIT ? OFFSET ?";
		$consulta=$this->con->consultar($sql,[$limite,$offset],'ii');
		$this->con->desconectar();
		return $consulta;
	}

	public function listarPor($tipo,$termo,$valor,$limite,$offset){
		if(!empty($valor)){
			$sql="SELECT * FROM produtos WHERE $tipo=? AND nome LIKE ? ORDER BY $tipo LIMIT ? OFFSET ?";
			$consulta=$this->con->consultar($sql,[$termo,'%'.$valor.'%',$limite,$offset],'ssii');
		}else if(!empty($tipo)){
			$sql="SELECT * FROM produtos WHERE $tipo=? ORDER BY $tipo LIMIT ? OFFSET ?";
			$consulta=$this->con->consultar($sql,[$termo,$limite,$offset],'sii');
		}else{
			$sql="SELECT * FROM produtos ORDER BY cod_prod LIMIT ? OFFSET ?";
			$consulta=$this->con->consultar($sql,[$limite,$offset],'ii');
		}
		$this->con->desconectar();
		return $consulta;
	}
	public function buscar($termo,$tipo)
	{
			$sql="SELECT * FROM produtos WHERE $tipo LIKE ?";
			$consulta=$this->con->consultar($sql,[$termo],'s');
			//$this->con->desconectar();
			return $consulta;
	}
	public function buscarporcod($cod_prod)
	{
		$sql="SELECT * FROM produtos WHERE cod_prod=?";
		$consulta=$this->con->consultar($sql,[$cod_prod],'i');
		return $consulta;
	}
	public function alterar($produto)
	{
		$sql="UPDATE produtos SET nome=?,valor=?,descricao=?,imagem=?,quantidade=?,tipo=? WHERE cod_prod=?";
		$campos=[
		$produto->getNome(),
		$produto->getValor(),
		$produto->getDescricao(),
		$produto->getImagem(),
		$produto->getQuantidade(),
		$produto->getTipo(),
		$produto->getCodProd()
		];
		$resposta=$this->con->executar($sql,$campos,'sdssisi');
		$this->con->desconectar();
		return $resposta;
	}
	public function contar()
	{
		$sql="SELECT COUNT(cod_prod) AS 'total' FROM produtos";
		$consulta=$this->con->consultar($sql,[],'');
		$linha=$consulta->fetch_assoc();
		return $linha['total'];
	}
	public function excluir($cod_prod)
	{
		$sql="DELETE FROM produtos WHERE cod_prod=?";
		$resposta=$this->con->executar($sql,[$cod_prod],'i');
		$this->con->desconectar();
		return $resposta;
	}
}
?>