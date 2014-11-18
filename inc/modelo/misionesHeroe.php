
<?php

	require_once('dao_misionesHeroe.php');

class MisionesHeroe {
	public $id_heroe;
	public $id_mision	;
	public $estado;
	public $final;


	public static function crea ($idHeroe, $idMision, $estado){
			$h = new MisionesHeroe();
			$h->id_heroe=$idHeroe;
			$h->id_mision = $idMision;
			$h->estado = $estado;
            DaoMisionesHeroe::getDao()->create($h);
        	return $h;
	    
	}

	public function setId_heroe ($id_heroe){
		$this->id_heroe = $id_heroe;
	}

	public function setId_mision ($id_mision){
		$this->id_mision = $id_mision;
	}

	public function setEstado ($estado){
		$this->estado = $estado;
	}

	public function setFinal ($final){
		$this->final = $final;
	}

	public function getId_heroe (){
		return $this->id_heroe;
	}

	public function getId_mision (){
		return $this->id_mision;
	}

	public function getEstado (){
		return $this->estado;
	}

	public function getFinal (){
		return $this->final;
	}

}