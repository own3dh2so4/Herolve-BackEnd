
<?php

	require_once'dao_mundo.php';
	
	class Mundo {
		public $id;
		public $usuarios_max;
		public $usuarios;


		public static function crea($usuarios_max) {
       
	        $u = new Mundo();
			$u->id=0;
	        $u->usuarios_max = $usuarios_max;
			$u->usuarios=0;
            DaoMundo::getDao()->save($u);
        	return $u;
			
		} 
		

		

		public function setId($id){
			$this->id = $id;
		}

		public function setUsuarios_max($usuarios_max){
			$this->usuarios_max = $usuarios_max;
		}

		public function setUsuarios ($usuarios){
			$this->usuarios = $usuarios;
		}


		public function getId (){
			return $this->id;
		}

		public function getUsuarios_max (){
			return $this->usuarios_max;
		}

		public function getUsuarios (){
			return $this->usuarios;
		}



	}