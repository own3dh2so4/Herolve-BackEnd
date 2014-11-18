<?php

require_once 'dao_recursos.php';

class Recursos {
	public $id_heroe;
	public $clase;
	public $cantidad;


	public static function crea($idUser, $clase, $cantidad) {      
	        $r = new Recursos();
			$r->id_heroe = $idUser;
			$r->clase = $clase;
			$r->cantidad = $cantidad;
            DaoRecursos::getDao()->create($r);
        	return $r;
	}
	

	public function __construct (){

	}

	public function setIdHeroe($id_heroe){
		$this->id_heroe = $id_heroe;
	}

	public function setClase($clase){
		$this->clase = $clase;
	}

	public function setCantidad ($cantidad){
		$this->cantidad = $cantidad;
	}


	public function getIdHeroe(){
		return $this->id_heroe;
	}

	public function getClase (){
		return $this->clase;
	}

	public function getCantidad (){
		return $this->cantidad;
	}



}