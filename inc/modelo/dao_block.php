<?php

	require_once 'basedao.php';
	
class DaoBlock extends BaseDao{
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
			return 'block';
		}
	
		public function getClassName() {
			return 'Block';
		}
		
		public function getColumNames() {
			return 'id, id_blokeador, id_blokeado';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->id_blokeador.','.$u->id_blokeado;
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porIdUsuarios($idBlokeador, $idBlokeado) {
			$query = "select * from " . $this->getTableName()." where id_blokeado=:login AND id_blokeador=:idB";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idBlokeado, 'idB' =>$idBlokeador ));
			return  $ret;
		}   
		
		public function saberBlock($idBlokeador, $idBlokeado) {
			$query = "select * from " . $this->getTableName()." where (id_blokeado=:login AND id_blokeador=:idB) OR (id_blokeador=:login AND id_blokeado=:idB)";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idBlokeado, 'idB' =>$idBlokeador ));
			return  $ret;
		}   
		
		public function borrar($obj){
			$this->delete($obj);
		}
		
		public function borrarPorIds($id, $idB){
			$id = (int) $id;
			if ( $id > 0 ) {
				$query = 'DELETE FROM ' . $this->getTableName() . ' WHERE id_blokeador=:id AND id_blokeado=:idB ';
				$result = $this->db->query($query, array("id" => $id, "idB"=> $idB));
				return $result;
			}
			return 0;
		}
		
		

}