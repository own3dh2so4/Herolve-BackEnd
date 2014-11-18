<?php

	require_once 'basedao.php';
	
class DaoMundo extends BaseDao{
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
			return 'mundos';
		}
	
		public function getClassName() {
			return 'Mundo';
		}
		
		public function getColumNames() {
			return 'id, usuarios_max, usuarios';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->usuarios_max.','.$u->usuarios;
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function todos() {
			$query = "select * from " . $this->getTableName();
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName());
			return  $ret;
		}   
		

}