<?php require_once 'Banco.php';

class ClientePA{

	private $con;

	public function __construct()
	{
		$this->con=new Banco();
	}
	public function cadastrar($cliente)
	{
		$sql="INSERT INTO cliente(nome, login, senha, cpf, data_nasci,endereco, telefone, sexo, email)
		VALUES(?,?,?,?,?,?,?,?,?)";
		$campos=[$cliente->getNome(),$cliente->getLogin(),$cliente->getSenha(),$cliente->getCpf(),$cliente->getDataNasci(),$cliente->getEndereco(),$cliente->getTelefone(),	$cliente->getSexo(),$cliente->getEmail()];
		$resposta=$this->con->executar($sql,$campos,"sssssssss");
		$this->con->desconectar();
		return $resposta;
	}
	public function verificar($campo,$valor)
	{
		$sql="SELECT $campo FROM cliente WHERE $campo=?";
		$consulta=$this->con->consultar($sql,[$valor],"s");
		if(!$consulta){
			return true;
		}else{
			return false;
		}
	}
	public function logar($login,$senha)
	{
		$sql="SELECT cod_cli,login,senha FROM cliente WHERE login=?";
		$consulta=$this->con->consultar($sql,[$login], 's');
		if(!$consulta){
			return false;
		}else{
			$linha=$consulta->fetch_assoc();
			if(password_verify($senha,$linha['senha'])){
				return $linha['cod_cli'];
			}else{
				return false;
			}
		}
	}
	public function verificarLoginEmail($login,$email)
	{
		$sql="SELECT cod_cli FROM cliente WHERE login=? AND email=?";
		$consulta=$this->con->consultar($sql,[$login,$email],'ss');
		if(!$consulta){
			return false;
		}else{
			$linha=$consulta->fetch_assoc();
			return $linha['cod_cli'];
		}
	}
	public function redefinirSenha($cod_cli,$novaSenha)
	{
		$sql="UPDATE cliente SET senha=? WHERE cod_cli=?";
		$resposta=$this->con->executar($sql,[$novaSenha,$cod_cli],'si');
		$this->con->desconectar();
		return $resposta;
	}
	public function listar($limite,$offset){
		$sql="SELECT * FROM cliente ORDER BY cod_cli LIMIT ? OFFSET ?";
		$consulta=$this->con->consultar($sql,[$limite,$offset],'ii');
		$this->con->desconectar();
		return $consulta;
	}
	public function contar()
	{
		$sql="SELECT COUNT(cod_cli) AS 'total' FROM cliente";
		$consulta=$this->con->consultar($sql,[],'');
		$linha=$consulta->fetch_assoc();
		return $linha['total'];
	}
	public function buscar($termo,$tipo)
	{
		if($tipo=="data_nasci"){
			$data_ame=new DateTime;;createFromFormat('d/m/Y',$termo);
			if(!$data_ame){
				return false;
			}else{
				$sql="SELECT * FROM cliente WHERE data_nasci like ?";
				$consulta=$this->con->consultar($sql,[$data_ame->format('Y-m-d')],'s');
				$this->con->desconectar();
				return $consulta;
			}

		}else{
			$sql="SELECT * FROM cliente WHERE $tipo LIKE ?";
			$consulta=$this->con->consultar($sql,[$termo],'s');
			$this->con->desconectar();
			return $consulta;
		}
	}
	public function buscarporcod($cod_cli)
	{
		$sql="SELECT * FROM cliente WHERE cod_cli=?";
		$consulta=$this->con->consultar($sql,[$cod_cli],'s');
		return $consulta;
	}
	public function alterar($cliente)
	{
		$sql="UPDATE cliente SET nome=?,endereco=?,
		telefone=?,data_nasci=?,login=?,senha=?,email=?,avatar=? WHERE cod_cli=?";
		$campos=[
		$cliente->getNome(), 
		$cliente->getEndereco(),
		$cliente->getTelefone(),
		$cliente->getDataNasci(), 
		$cliente->getLogin(),
		$cliente->getSenha(),
		$cliente->getEmail(), 
		$cliente->getAvatar(),
		$cliente->getCodCli(),
		];
		$resposta=$this->con->executar($sql,$campos,'ssssssssi');
		$this->con->desconectar();
		return $resposta;
	}
	public function atualizarAvatar($cod_cli,$avatar)
	{
		$sql="UPDATE cliente SET avatar=? WHERE cod_cli=?";
		$resposta=$this->con->executar($sql,[$avatar,$cod_cli],'si');
		$this->con->desconectar();
		return $resposta;
	}
	public function excluir($cod_cli)
	{
		$sql="DELETE FROM cliente WHERE cod_cli=?";
		$sql2="DELETE FROM pet WHERE cod_cli=?";
		$resposta=$this->con->executar($sql,[$thiscod_cli],'i');
	if(!$resposta){	
		$this->con->desconectar();
		return  false;
	}else{
		$resposta=$this->con->executar($sql2,[$cod_cli],'i');
		$this->con->desconectar();
		return $resposta;
	}
}
}
?>