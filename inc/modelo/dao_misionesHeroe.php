<?php

	require_once 'basedao.php';
	
class DaoMisionesHeroe extends BaseDao{
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
			return 'misiones_heroe';
		}
	
		public function getClassName() {
			return 'MisionesHeroe';
		}
		
		public function getColumNames() {
			return 'id_heroe, id_mision, estado';
		}
		
		public function getValuesFrom($u){
			return $u->id_heroe.','.$u->id_mision.',"'.$u->estado.'"';
		}
		
		public function porIdHeroe($id) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porIdHeroeIdMision($id, $idM) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login and id_mision=:mision";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id, 'mision' => $idM));
			return  $ret;
		} 
		
		public function porIdHeroeSinCompletar($id) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login and estado = 'n'";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		}   
		
		public function porIdHeroeCompletado($id) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login and estado = 'c'";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		}  

		public function porIdHeroeProceso($id) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login and estado = 'p'";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 

}