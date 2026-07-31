<?php

class Administrador{
	private $cod_adm;
	private $login;
	private $cpf;
	private $nome;
	private $senha;

	public function setCodAdm($cod_adm)
	{
		$this->cod_adm=$cod_adm;
	}
	public function getCodAdm()	
	{
		return $this->cod_adm;
	}
	public function setLogin($login)
	{
		$this->login=$login;
	}
	public function getLogin()	
	{
		return $this->login;
	}
	public function setCpf($cpf)
	{
		$this->cpf=$cpf;
	}
	public function getCpf()	
	{
		return $this->cpf;
	}
	public function setNome($nome)
	{
		$this->nome=$nome;
	}
	public function getNome()	
	{
		return $this->nome;
	}
	public function setSenha($senha)
	{
		$this->senha=$senha;
	}
	public function getSenha()	
	{
		return $this->senha;
	}
	public function criptografar()
	{
		$this->senha=password_hash($this->senha, PASSWORD_DEFAULT);
	}
	public function logar($cod_adm)
	{
		setcookie("administrador",$cod_adm,time()+172800);
	}
	public function deslogar()
	{
		setcookie("administrador","");
	}
}
?>