<?php

require_once 'dao_heroes.php';

class Heroe{

	public $id;
	public $id_user;
	public $nombre;
	public $id_mundo;
	public $estado;
	public $nivel;
	public $experiencia;
	public $poder;
	public $last;
	
	
	public static function crea ($idUser, $nombre, $mundo){
		if (DaoHeroe::getDao()->porNombre($nombre,$mundo) != null) {
            return "Heroe existente - elije otro heroe";
        } else if ( !mb_strlen($nombre) >= 2 ) {
	        return "Nombre del heroe demasiado cortos";
	    } else {
		
			$h = new Heroe();
			$h->id=0;
			$h->id_user = $idUser;
			$h->nombre = $nombre;
			$h->id_mundo=$mundo;
			$h->estado=0;
			$h->nivel=1;
			$h->experiencia=0;
			$h->poder=1;
			$h->last=date('Y-m-d H:i:s');
            DaoHeroe::getDao()->save($h);
        	return $h;
	    }
	}
	
	public function __construct(){
		
	}
	
	public function setIdUser($id_user){
		$this->id_user = $id_user;
	}
	
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	
	public function setIdMundo($id_mundo){
		$this->id_mundo = $id_mundo;
	}
	
	public function setEstado($estado){
		$this->estado = $estado;
	}
	
	public function setNivel($nivel){
		$this->nivel = $nivel;
	}
	
	public function setExperiencia($experiencia){
		$this->experiencia = $experiencia;
	}
	
	public function setMagia($magia){
		$this->magia = $magia;
	}
	
	public function setPoder($poder){
		$this->poder = $poder;
	}
	
	
	
	public function getIdUser(){
		return $this->id_user;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function getIdMundo(){
		return $this->id_mundo;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	
	public function getNivel(){
		return $this->nivel;
	}
	
	public function getExperiencia(){
		return $this->experiencia;
	}
	
	public function getMagia(){
		return $this->magia;
	}
	
	public function getPoder(){
		return $this->poder;
	}
	
	public function getLast(){
		return $this->last;
	}
	
	public function setLast($a){
		$this->last=$a;
	}
	
	

}