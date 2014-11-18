<?php


require_once('dao_edificios_heroe.php');

class EdificioHeroe{
	
	public $id_heroe;
	public $id_edificio;
	public $estado;
	public $final;
	public $nivel;
	
	public static function crea($idUser, $id_edificio, $estado, $nivel) {       
	        $eh = new EdificioHeroe();
			$eh->id_heroe = $idUser;
			$eh->id_edificio = $id_edificio;
			$eh->estado = $estado;
			$eh->final = null;
			$eh->nivel = $nivel; 
            DaoEdificioHeroe::getDao()->create($eh);
        	return $eh;
	}
	
	public function __construct (){
	}
	
	public function setIdHeroe($id_heroe){
		$this->id_heroe = $id_heroe;
	}
	
	public function setIdEdificio($id_edificio){
		$this->id_edificio = $id_edificio;
	}
	
	public function setEstado($estado){
		$this->estado = $estado;
	}
	
	public function setfinal($final){
		$this->final = $final;
	}
	
	public function getIdHeroe(){
		return $this->id_heroe;
	}
	
	public function getIdEdificio(){
		return $this->id_edificio;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	
	public function getfinal(){
		return $this->final;
	}

}