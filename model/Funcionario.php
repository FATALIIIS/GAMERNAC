<?php

class Funcionario{
	
	private $cod_func;
	private $nome;
	private $cpf;
	private $telefone;
	private $login;
	private $senha;
	private $email;
	private $data_nasci;
	private $sexo;
	private $endereco;

	public function setCodFunc($cod_func)
	{
		$this->cod_func=$cod_func;
	}
	public function getCodFunc()	
	{
		return $this->cod_func;
	}
	public function setNome($nome)
	{
		$this->nome=$nome;
	}
	public function getNome()	
	{
		return $this->nome;
	}
	public function setCpf($cpf)
	{
		$this->cpf=$cpf;
	}
	public function getCpf()	
	{
		return $this->cpf;
	}
	public function setTelefone($telefone)
	{
		$this->telefone=$telefone;
	}
	public function getTelefone()	
	{
		return $this->telefone;
	}
	public function setLogin($login)
	{
		$this->login=$login;
	}
	public function getLogin()	
	{
		return $this->login;
	}
	public function setSenha($senha)
	{
		$this->senha=$senha;
	}
	public function getSenha()	
	{
		return $this->senha;
	}
	public function setEmail($email)
	{
		$this->email=$email;
	}
	public function getEmail()	
	{
		return $this->email;
	}
	public function setDataNasci($data_nasci)
	{
		$this->data_nasci=$data_nasci;
	}
	public function getDataNasci()	
	{
		return $this->data_nasci;
	}
	public function setSexo($sexo)
	{
		$this->sexo=$sexo;
	}
	public function getSexo()	
	{
		return $this->sexo;
	}
	public function setEndereco($endereco)
	{
		$this->endereco=$endereco;
	}
	public function getEndereco()	
	{
		return $this->endereco;
	}
	public function criptografar()
	{
		$this->senha=password_hash($this->senha, PASSWORD_DEFAULT);
	}
	public function logar($cod_func)
	{
		setcookie("funcionario",$cod_func,time()+172800);
	}
	public function deslogar()
	{
		setcookie("funcionario","",time()-3600);
	}
}
?>