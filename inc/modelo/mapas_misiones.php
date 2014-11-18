<?php

	require_once'dao_mapaMisiones.php';

class MapasMisiones{

	public $id_mapa;
	public $id_mision;
	public $posicion;
	public $x;
	public $y;
	
	public static function crea($id_mapa,$id_mision, $posicion, $x, $y) {
       
	        $u = new Mapa();
			$u->id=0;
	        $u->id_mapa = $id_mapa;
			$u->id_mision = $id_mision;
			$u->posicion = $posicion;
			$u->x = $x;
			$u->y = $y;
            DaoMapaMisiones::getDao()->save($u);
        	return $u;
			
		} 
	
	public function setIdMapa($id_mapa){
		$this->id_mapa = $id_mapa;
	}
	
	public function setIdMision($id_mision){
		$this->id_mision = $id_mision;
	}
	
	public function setPosicion($posicion){
		$this->posicion = $posicion;
	}
	
	public function getIdMapa(){
		return $this->id_mapa;
	}
	
	public function getIdMision(){
		return $this->id_mision;
	}
	
	public function getPosicion(){
		return $this->posicion;
	}
	
}