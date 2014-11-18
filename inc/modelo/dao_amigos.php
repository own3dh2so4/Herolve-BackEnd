<?php

	require_once 'basedao.php';
	
class DaoAmigos extends BaseDao{
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
			return 'amigos';
		}
	
		public function getClassName() {
			return 'Amigos';
		}
		
		public function getColumNames() {
			return 'id, id_user1, id_user2, estado';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->id_user1.','.$u->id_user2.',"'.$u->estado.'"';
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porUser1($id1) {
			$query = "select * from " . $this->getTableName()." where id_user1=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id1));
			return  $ret;
		}   
		
		public function porUser2($id2) {
			$query = "select * from " . $this->getTableName()." where id_user2=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id2));
			return  $ret;
		} 

		public function porUser($id1) {
			$query = "select * from " . $this->getTableName()." where id_user1=:u1 OR id_user2=:u1";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('u1' => $id1));
			return  $ret;
		} 
		
		public function porUsers($id1, $id2) {
			$query = "select * from " . $this->getTableName()." where (id_user1=:u1 AND id_user2=:u2) OR (id_user1=:u2 AND id_user2=:u1)";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('u1' => $id1,'u2' => $id2));
			return  $ret;
		} 

		public function borrar($obj){
			$this->delete($obj);
		}
		
}


