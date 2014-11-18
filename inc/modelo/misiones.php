
<?php
class Misiones {
	public $id;
	public $nombre	;
	public $descripcion;
	public $tiempo;
	public $nivel;
	public $poder;
	public $fallo;
	public $jugadores;
	public $rec_comida;
	public $rec_experiencia;
	public $rec_madera;
	public $rec_metal;
	public $rec_piedra;
	public $rec_rubies;

	public static function crea($nombre,$desc,$tiempo, $nivel, $poder,$fallo,
							$jug, $rc, $re, $rma,$rme, $rp, $rb) {
       
	        $u = new Misiones();
			$u->id=0;
	        $u->nombre = $nombre;
	        $u->descripcion = $desc;
        	$u->tiempo = $tiempo;
        	$u->nivel = $nivel;
			$u->poder = $poder;
			$u->fallo = $fallo;
			$u->jugadores = $jug;
			$u->rec_comida= $rc;
			$u->rec_experiencia = $re;
			$u->rec_madera = $rma;
			$u->rec_metal = $rme;
			$u->rec_piedra = $rp;
			$u->rec_rubies = $rb;
            DaoMisiones::getDao()->save($u);
        	return $u;
	    
	} 

	public function setId ($id){
		$this->id = $id;
	}

	public function setNombre ($nombre){
		$this->nombre = $nombre;
	}

	public function setDescripcion ($descripcion){
		$this->descripcion = $descripcion;
	}

	public function setTiempo ($tiempo){
		$this->tiempo = $tiempo;
	}

	public function setNivel ($nivel){
		$this->nivel = $nivel;
	}

	public function setPoder ($poder){
		$this->poder = $poder;
	}

	public function setMagia ($magia){
		$this->magia = $magia;
	}

	public function setFallo ($fallo){
		$this->fallo = $fallo;
	}

	public function setJugadores ($jugadores){
		$this->jugadores = $jugadores;
	}

	public function setRec_comida ($rec_comida){
		$this->rec_comida = $rec_comida;
	}

	public function setRec_experiencia ($rec_experiencia){
		$this->rec_experiencia = $rec_experiencia;
	}

	public function setRec_madera ($rec_madera){
		$this->rec_madera = $rec_madera;
	}

	public function setRec_metal ($rec_metal){
		$this->rec_metal = $rec_metal;
	}

	public function setRec_piedra ($rec_piedra){
		$this->rec_piedra = $rec_piedra;
	}

	public function setRec_rubies ($rec_rubies){
		$this->rec_rubies = $rec_rubies;
	}

	public function getId (){
		return $this->id;
	}

	public function getNombre (){
		return $this->nombre;
	}

	public function getDescripcion (){
		return $this->descripcion;
	}

	public function getTiempo (){
		return $this->tiempo;
	}

	public function getNivel (){
		return $this->nivel;
	}

	public function getPoder (){
		return $this->poder;
	}

	public function getMagia (){
		return $this->magia;
	}

	public function getFallo (){
		return $this->fallo;
	}

	public function getJugadores (){
		return $this->jugadores;
	}

	public function getRec_comida (){
		return $this->rec_comida;
	}

	public function getRec_experiencia (){
		return $this->rec_experiencia;
	}

	public function getRec_madera (){
		return $this->rec_madera;
	}

	public function getRec_metal (){
		return $this->rec_metal;
	}

	public function getRec_piedra (){
		return $this->rec_piedra;
	}
	public function getRec_rubies (){
		return $this->rec_rubies;
	}
}