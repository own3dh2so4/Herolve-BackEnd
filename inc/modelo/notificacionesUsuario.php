<?php
	class NotificacionesUsuario {
		public $id;
		public $id_heroe;
		public $descripcion;
		public $fecha;

		public static function crea ($id_heroe, $descripcion, $fecha){
		
			$nu = new NotificacionesUsuario();
			$nu->id=0;
			$nu->id_heroe = $id_heroe;
			$nu->descripcion = $descripcion;
			$nu->fecha = $fecha;
            DaoNotificacionesUsuario::getDao()->save($nu);
        	return $nu;
	}

		public function __construct (){

		}

		public function setid_heroe($id_heroe){
			$this->id_heroe = $id_heroe;
		}

		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function setFecha ($fecha){
			$this->fecha = $fecha;
		}


		public function getid_heroe (){
			return $this->id_heroe;
		}

		public function getDescripcion (){
			return $this->descripcion;
		}

		public function getFecha (){
			return $this->fecha;
		}



	}