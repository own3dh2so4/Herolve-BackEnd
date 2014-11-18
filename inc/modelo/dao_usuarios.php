<?php

	require_once 'basedao.php';
	
class DaoUsuario extends BaseDao {
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
			return 'usuarios';
		}
	
		public function getClassName() {
			return 'Usuario';
		}
		
		public function getColumNames() {
			return 'id, nick, hash, salt, correo, estado, foto';
		}
		
		public function getValuesFrom($u){
			return $u->id.',"'.$u->getNick().'","'.$u->getHash().'","'.$u->getSalt().'","'.$u->getCorreo().'","'.$u->getEstado().'",'.$u->foto;
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

		public function porVariosPorLogin($login_) {
			$query = "select * from " . $this->getTableName()." where nick LIKE :login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $login_));
			return  $ret;
		}  
		
		public function porLogin($login_) {
			$query = "select * from " . $this->getTableName()." where nick=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $login_));
			return  $ret;
		}  

		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function conectados() {
			$query = "select * from " . $this->getTableName()." where estado='c'";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName());
			return  $ret;
		} 
		
		public function borrar($obj){
			$this->delete($obj);
		}
}