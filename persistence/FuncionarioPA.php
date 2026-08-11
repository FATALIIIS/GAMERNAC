<?php require_once 'Banco.php';

class FuncionarioPA{

	private $con;

	public function __construct()
	{
		$this->con=new Banco();
	}
	public function cadastrar($funcionario)
	{
		$sql="INSERT INTO funcionario(nome, cpf, data_nasci, endereco, telefone, sexo, email, login, senha)
		VALUES(?,?,?,?,?,?,?,?,?)";
		$campos=[$funcionario->getNome(),$funcionario->getCpf(),$funcionario->getDataNasci(),$funcionario->getEndereco(),$funcionario->getTelefone(),$funcionario->getSexo(),$funcionario->getEmail(),$funcionario->getLogin(),$funcionario->getSenha()];
		var_dump($sql);
		var_dump($campos);
		$resposta=$this->con->executar($sql,$campos,"sssssssss");
		$this->con->desconectar();
		return $resposta;
	}
	public function verificar($campo,$valor)
	{
		$sql="SELECT $campo FROM funcionario WHERE $campo=?";
		$consulta=$this->con->consultar($sql,[$valor],"s");
		if(!$consulta){
			return true;
		}else{
			return false;
		}
	}
	public function logar($login,$senha)
	{
		$sql="SELECT cod_func,login,senha FROM funcionario WHERE login=?";
		$consulta=$this->con->consultar($sql,[$login], 's');
		if(!$consulta){
			return false;
		}else{
			$linha=$consulta->fetch_assoc();
			if(password_verify($senha,$linha['senha'])){
				return [$linha['cod_func']];
			}else{
				return false;
			}
		}
	}
	public function logar2($login,$email)
	{
		$sql="SELECT login,email FROM funcionario WHERE login=? and email=?";
		$consulta=$this->con->consultar($sql,[$login,$email], 'ss');
		if(!$consulta){
			return false;
		}else{
			return true;
		}
	}
	public function listar($limite,$offset){
		$sql="SELECT * FROM funcionario ORDER BY cod_func LIMIT ? OFFSET ?";
		$consulta=$this->con->consultar($sql,[$limite,$offset],'ii');
		$this->con->desconectar();
		return $consulta;
	}
	public function contar()
	{
		$sql="SELECT COUNT(cod_func) AS 'total' FROM funcionario";
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
				$sql="SELECT * FROM funcionario WHERE data_nasci like ?";
				$consulta=$this->con->consultar($sql,[$data_ame->format('Y-m-d')],'s');
				$this->con->desconectar();
				return $consulta;
			}

		}else{
			$sql="SELECT * FROM funcionario WHERE $tipo LIKE ?";
			$consulta=$this->con->consultar($sql,[$termo],'s');
			$this->con->desconectar();
			return $consulta;
		}
	}
	public function buscarporcod($cod_func)
	{
		$sql="SELECT * FROM funcionario WHERE cod_func=?";
		$consulta=$this->con->consultar($sql,[$cod_func],'i');
		return $consulta;
	}
	public function alterar($funcionario)
	{
		$sql="UPDATE funcionario SET nome=?, endereco=?, telefone=?,data_nasci=?,email=? WHERE cod_func=?";
		$campos=[
		$funcionario->getNome(),
		$funcionario->getEndereco(),
		$funcionario->getTelefone(),
		$funcionario->getDataNasci(),
		$funcionario->getEmail(),
		$funcionario->getCodFunc(),
		];
		$resposta=$this->con->executar($sql,$campos,'sssssi');
		$this->con->desconectar();
		return $resposta;
	}
	public function alterarSenha($cod_func,$senha)
	{
		$sql="UPDATE funcionario SET senha=? WHERE cod_func=?";
		$resposta=$this->con->executar($sql,[$senha,$cod_func],'si');
		$this->con->desconectar();
		return $resposta;
	}
	public function excluir($cod_func)
	{
		$sql="DELETE FROM funcionario WHERE cod_func=?";
		$sql2="DELETE FROM funcionario WHERE cod_func=?";
		$resposta=$this->con->executar($sql,[$cod_func],'i');
	if(!$resposta){	
		$this->con->desconectar();
		return  false;
	}else{
		$resposta=$this->con->executar($sql2,[$cod_func],'i');
		$this->con->desconectar();
		return $resposta;
	}
}
}
?>