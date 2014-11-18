<?php

	require_once 'basedao.php';
	
class DaoUsuarioAdmin extends BaseDao {
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
			return 'usuariosadmin';
		}
	
		public function getClassName() {
			return 'UsuarioAdmin';
		}
		
		public function getColumNames() {
			return 'id, nick, hash, salt';
		}
		
		public function getValuesFrom($u){
			return $u->id.',"'.$u->nick.'","'.$u->hash.'","'.$u->salt.'"';
		}
		
		public function autentifica($login_, $pass_) {
			$u = $this->porLogin($login_);	
			if ($this->db->getAffectedRows() == 1 
					&& Util::verifica($u->hash, $pass_, $u->salt)) {
				return $u;
			} else {
				return null;   
			}
		}

		
		public function porLogin($login_) {
			$query = "select * from " . $this->getTableName()." where nick=:login";
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $login_));
			return  $ret;
		}  

		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function borrar($obj){
			$this->delete($obj);
		}
}