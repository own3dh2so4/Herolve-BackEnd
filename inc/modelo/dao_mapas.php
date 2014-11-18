<?php

	require_once 'basedao.php';
	
class DaoMapa extends BaseDao{
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
			return 'mapas';
		}
	
		public function getClassName() {
			return 'Mapa';
		}
		
		public function getColumNames() {
			return 'id, id_mundo';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->id_mundo;
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porIdMundo($id_mundo) {
			$query = "select * from " . $this->getTableName()." where id_mundo=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id_mundo));
			return  $ret;
		}   
		

}