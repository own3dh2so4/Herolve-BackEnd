<?php

	require_once 'basedao.php';
	
class DaoChat extends BaseDao{
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
			return 'chat';
		}
	
		public function getClassName() {
			return 'Chat';
		}
		
		public function getColumNames() {
			return 'id, id_amigos, id_user, mensaje, fecha';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->id_amigos.','.$u->id_user.',"'.$u->mensaje.'","'.$u->fecha.'"';
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porIdAmigo($id) {
			$query = "select * from " . $this->getTableName()." where id_amigos=:login order by fecha";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		}   
		
		public function porIdUser($id) {
			$query = "select * from " . $this->getTableName()." where id_user=:login ";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 

		public function porIdUserYIdAmigo($idA, $idU){
			$query = "select * from " . $this->getTableName()." where id_user=:login and id_amigos=:amigo";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idU, 'amigo' => $idA));
			return  $ret;
		}
		
		
		public function borrar($obj){
			$this->delete($obj);
		}
		
		public function borrarPorIdAmigos($id){
			$id = (int) $id;
			if ( $id > 0 ) {
				$query = 'DELETE FROM ' . $this->getTableName() . ' WHERE `id_amigos`=:id ';
				$result = $this->db->query($query, array("id" => $id));
				return $result;
			}
			return 0;
		}

}