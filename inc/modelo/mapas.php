<?php

	require_once 'dao_mapas.php';

class Mapa{

	public $id;
	public $id_mundo;
	
	public static function crea($id_mundo) {
       
	        $u = new Mapa();
			$u->id=0;
	        $u->id_mundo = $id_mundo;
            DaoMapa::getDao()->save($u);
        	return $u;
			
		} 
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setIdMundo($id_mundo){
		$this->id_mundo = $id_mundo;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getIdMundo(){
		return $this->id_mundo;
	}

}