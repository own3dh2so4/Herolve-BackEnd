<?php

	require_once 'dao_chat.php';

class Chat {

	public $id;
	public $id_amigos;
	public $id_user;
	public $mensaje;
	public $fecha;
	
	public static function crea ($id_amigos, $id_user, $mensaje){		
			$h = new Chat();
			$h->id=0;
			$h->id_user = $id_user;
			$h->id_amigos = $id_amigos;
			$h->mensaje=$mensaje;
			$h->fecha=date('Y-m-d H:i:s');
            DaoChat::getDao()->save($h);
        	return $h;
	}
	
	public function __construct(){
	}
	
	public function setId ($id){
		$this->id = $id;
	}
	
	public function setIdAmigos($id_amigos){
		$this->id_amigos = $id_amigos;
	}
	
	public function setIdUser($id_user){
		$this->id_user = $id_user;
	}
	
	public function setMensaje($mensaje){
		$this->mensaje = $mensaje;
	}
	
	public function setFecha($fecha){
		$this->fecha = $fecha;
	}
	
	public function getId (){
		return $this->id;
	}
	
	public function getIdAmigos(){
		return $this->id_amigos;
	}
	
	public function getIdUser(){
		return $this->id_user;
	}
	
	public function getMensaje(){
		return $this->mensaje;
	}
	
	public function getFecha(){
		return $this->fecha;
	}


}
