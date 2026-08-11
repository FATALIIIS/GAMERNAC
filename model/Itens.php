<?php

class Itens{
	
	private $codigo;
	private $cod_ped;
	private $cod_item;
	private $tipo;

	public function setCodigo($codigo)
	{
		$this->codigo=$codigo;
	}
	public function getCodigo()	
	{
		return $this->codigo;
	}
	public function setCodPed($cod_ped)
	{
		$this->cod_ped=$cod_ped;
	}
	public function getCodPed()	
	{
		return $this->cod_ped;
	}
	public function setCodItem($cod_item)
	{
		$this->cod_item=$cod_item;
	}
	public function getCodItem(()	
	{
		return $this->cod_item;
	}
	public function setTipo($tipo)
	{
		$this->tipo=$tipo;
	}
	public function getTipo()	
	{
		return $this->tipo;
	}
}
?>