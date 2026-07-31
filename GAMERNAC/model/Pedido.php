<?php

class Pedido{

	private $cod_ped;
	private $data;
	private $valor;

	public function setCodPed($cod_ped)
	{
		$this->cod_ped=$cod_ped;
	}
	public function getCodPed()	
	{
		return $this->cod_ped;
	}
	public function setData($data)
	{
		$this->data=$data;
	}
	public function getData()	
	{
		return $this->data;
	}
	public function setValor($valor)
	{
		$this->valor=$valor;
	}
	public function getValor()	
	{
		return $this->valor;
	}
}

?>