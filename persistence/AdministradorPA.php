<?php

require_once 'Banco.php';

class AdministradorPA{

	private $con;

	public function __construct()
	{
		$this->con=new Banco();
	}

	public function logar($login,$senha)
	{
		$sql="SELECT cod_adm,Login,Senha FROM administrador WHERE Login=?";
		$consulta=$this->con->consultar($sql,[$login],'s');
		if (!$consulta) {
			var_dump($sql);
			var_dump($login);
			return false;
		}else{
			$linha=$consulta->fetch_assoc();
			if (password_verify($senha,$linha['Senha'])) {
				return [$linha['cod_adm']];
			}else{
				return false;
			}
		}
	}

	public function cadastrar($administrador)
	{
		$sql="INSERT INTO administrador (login,cpf,nome,senha) VALUES(?,?,?,?)";
		$campos=[$administrador->getNome(),$administrador->getCpf(),$administrador->getLogin(),$administrador->getSenha()];
		$resposta=$this->con->executar($sql,$campos,"ssss");
		$this->con->desconectar();
		return $resposta;
	}

	public function verificar($campo,$valor)
	{
		$sql="SELECT $campo FROM administrador
		WHERE $campo=?";
		$consulta=$this->con->consultar($sql,[$valor],"s");
		if (!$consulta) {
			return true;
		}else{
			return false;
		}
	}

	public function listar($limite,$offset)
	{
		$sql="SELECT * FROM administrador 
		ORDER BY cod_adm LIMIT ? OFFSET ?";
		$consulta=$this->con->consultar($sql,[$limite,$offset],'ii');
		$this->con->desconectar();
		return $consulta;
	}

	public function contar()
	{
		$sql="SELECT COUNT(cod_adm) AS 'total' FROM 
		administrador";
		$consulta=$this->con->consultar($sql,[],'');
		$linha=$consulta->fetch_assoc();
		return $linha['total'];
	}

}

?>