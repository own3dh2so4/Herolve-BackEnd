<?php


	require_once('inc/modelo/dao_amigosPendientes.php');

	class AmigosPendiente{
		
		public $id;
		public $idUser1;
		public $idUser2;
		
		public static function crea ($idUser1, $idUser2){
			$ap = new AmigosPendiente();
			$ap->id=0;
			$ap->idUser1 = $idUser1;
			$ap->idUser2 = $idUser2;
            DaoAmigosPendientes::getDao()->save($ap);
        	return $ap;
	}
		
		public function __construct(){
		
		}
		
	
	}