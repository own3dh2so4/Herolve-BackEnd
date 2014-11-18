<?php

require_once 'basedao.php';
	
class DaoRecursos extends BaseDao {
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
			return 'recursos';
		}
	
		public function getClassName() {
			return 'Recursos';
		}
		
		public function getColumNames() {
			return 'id_heroe, clase, cantidad';
		}
		
		public function getValuesFrom($u){
			return $u->getIdHeroe().',"'.$u->getClase().'",'.$u->getCantidad();
		}
		
		

		
		public function porIdHeroe($idH) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idH));
			return  $ret;
		} 

		public function porIdHeroeTipoRecurso($idH, $tR){
			$query = "select * from " . $this->getTableName()." where id_heroe=:login and clase=:clase";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idH, 'clase' => $tR));
			return  $ret;
		}
}