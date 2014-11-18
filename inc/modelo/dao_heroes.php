<?php

	require_once 'basedao.php';
	
class DaoHeroe extends BaseDao{
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
			return 'heroes';
		}
	
		public function getClassName() {
			return 'Heroe';
		}
		
		public function getColumNames() {
			return 'id, id_user, nombre, id_mundo, estado, nivel, experiencia,  poder, last';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->id_user.',"'.$u->getNombre().'",'.$u->getIdMundo().','.$u->getEstado().','.$u->getNivel().','.$u->getExperiencia().','.$u->getPoder().',"'.$u->getLast().'"';
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porNombre($nombre,$mundo) {
			$query = "select * from " . $this->getTableName()." where nombre=:login and id_mundo=:mundo";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $nombre,'mundo' => $mundo));
			return  $ret;
		}   
		
		public function porIdUser($id,$mundo) {
			$query = "select * from " . $this->getTableName()." where id_user=:login and id_mundo=:mundo";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id,'mundo' => $mundo));
			return  $ret;
		}   
		
		public function porIdUserList($id) {
			$query = "select * from " . $this->getTableName()." where id_user=:login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		}  

}