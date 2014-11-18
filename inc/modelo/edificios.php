<?php

class Edificio{
	
	public $id;
	public $clase_edificio;
	public $clase_recurso;
	public $valormadera;
	public $valorpiedra;
	public $valormetal;
	public $valorcomida;
	public $valorrubies;
	public $descripcion;
	public $nombre;
	public $exponente;
	public $cantidad;
	
	public function __construct (/*$id, $clase_edificio, $clase_recurso,$valormadera , $valorpiedra, $valormetal,	$valorcomida, $valorrubies, $descripcion, $nombre, $exponenten, $cantidad*/){
		
		/*$this->id = $id;
		$this->clase_edificio = $clase_edificio;
		$this->clase_recurso = $clase_recurso;
		$this->valormadera = $valormadera;
		$this->valorpiedra = $valorpiedra;
		$this->valormetal = $valormetal;
		$this->valorcomida = $valorcomida;
		$this->valoreubies = $valorrubies;
		$this->descripcion = $descripcion;
		$this->nombre = $nombre;
		$this->exponenten = $exponenten;
		$this->cantidad = $cantidad;*/
	}
	
	
	
	public function setId($id){
		$this->id=$id;
	}
	
	public function setClaseEdificio($clase_edificio){
		$this->clase_edificio = $clase_edificio;
	}
	
	public function setClaseRecurso($clase_recurso){
		$this->clase_recurso = $clase_recurso;
	}
	
	public function setValor($valor){
		$this->valor = $valor;
	}
	
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	

	
	public function setCantidad ($cantidad){
		$this->cantidad = $cantidad;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getClaseEdificio(){
		return $this->clase_edificio;
	}
	
	public function getClaseRecurso(){
		return $this->clase_recurso;
	}
	
	public function getValor(){
		return $this->valor;
	}
	
	public function getDescripcion(){
		return $this->descripcion;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	
	public function getCantidad (){
		return $this->cantidad;
	}

}