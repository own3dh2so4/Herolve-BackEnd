<?php 

require_once 'basedao.php';
	
class DaoEdificioHeroe extends BaseDao {
		private static $dao;

		public static function getDao() {
			if ( self::$dao === null ) {
				self::$dao = new self();
			}
			return self::$dao;
		}
	
		protected function __construct() {
			parent::__construct();
		}
	
		public function getTableName() {
			return 'edificios_heroe';
		}
	
		public function getClassName() {
			return 'EdificioHeroe';
		}
		
		public function getColumNames() {
			return 'id_heroe, id_edificio, estado, nivel';
		}
		
		public function getValuesFrom($u){
			return $u->getIdHeroe().','.$u->getIdEdificio().',"'.$u->getEstado().'",'.$u->nivel;
		}
		
		

		
		public function porIdHeroe($idH) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idH));
			return  $ret;
		}  
		
		public function porIdHeroeIdEdificio($idH, $idE) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login and id_edificio=:ide";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idH, 'ide' => $idE));
			return  $ret;
		}

		public function enConstruction($idH){
			$query = "select * from " . $this->getTableName()." where id_heroe=:login AND estado ='c'";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idH));
			return  $ret;
		} 
}