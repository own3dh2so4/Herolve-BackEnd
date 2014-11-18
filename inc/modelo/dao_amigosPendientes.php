<?php

	require_once 'basedao.php';
	
class DaoAmigosPendientes extends BaseDao{
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
			return 'amigospendiente';
		}
	
		public function getClassName() {
			return 'AmigosPendiente';
		}
		
		public function getColumNames() {
			return 'id, idUser1, idUser2';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->idUser1.','.$u->idUser2;
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porIdUser1($idUser1) {
			$query = "select * from " . $this->getTableName()." where idUser1=:login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idUser1));
			return  $ret;
		}  

		public function porIdUser1Y2($idUser1, $idUser2) {
			$query = "select * from " . $this->getTableName()." where (idUser1=:u1 AND idUser2=:u2) OR (idUser1=:u2 AND idUser2=:u1)";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('u1' => $idUser1,'u2' => $idUser2));
			return  $ret;
		}  
		
		public function porIdUser2($idUser2) {
			$query = "select * from " . $this->getTableName()." where idUser2=:login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idUser2));
			return  $ret;
		}   
		
		public function borrar($obj){
			$this->delete($obj);
		}

}