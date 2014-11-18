<?php

require_once 'basedao.php';
	
class DaoTokenAdmin extends BaseDao{
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
			return 'tokenAdmin';
		}
	
		public function getClassName() {
			return 'TokenAdmin';
		}
		
		public function getColumNames() {
			return 'id, token';
		}
		
		public function getValuesFrom($u){
			return $u->id.',"'.$u->token.'"';
		}
		

		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		}   
		
		public function porToken($token) {
			$query = "select * from " . $this->getTableName()." where token=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $token));
			return  $ret;
		}   
		
		public function borrar($obj){
			$this->delete($obj);
		}

}