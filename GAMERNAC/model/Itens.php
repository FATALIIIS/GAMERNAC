<?php

class Itens{
	private $cod_ped;
	private $cod_jogo;
	private $cod_prod;

	public function setCodPed($cod_ped)
	{
		$this->cod_ped=$cod_ped;
	}
	public function getCodPed()	
	{
		return $this->cod_ped;
	}
	public function setCodJogo($cod_jogo)
	{
		$this->cod_jogo=$cod_jogo;
	}
	public function getCodJogo()	
	{
		return $this->cod_jogo;
	}
	public function setCodProd($cod_prod)
	{
		$this->cod_prod=$cod_prod;
	}
	public function getCodProd()	
	{
		return $this->cod_prod;
	}
}
?>