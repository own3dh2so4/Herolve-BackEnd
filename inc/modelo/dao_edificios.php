<?php

	require_once 'basedao.php';
	
class DaoEdificio extends BaseDao{
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
			return 'edificios';
		}
	
		public function getClassName() {
			return 'Edificio';
		}
		
		public function getColumNames() {
			return 'id, clase_edificio, clase_recurso, valormadera, valorpiedra, valormetal, valorcomida, valorrubies, descripcion, nombre, cantidad, exponente';
		}
		
		public function getValuesFrom($u){
			return $u->id.',"'.$u->clase_edificio.'","'.$u->clase_recurso.'",'.$u->valormadera.','.$u->valorpiedra.','.$u->valormetal.','.$u->valorcomida.','.$u->valorrubies.',"'.$u->descripcion.'","'.$u->nombre.'",'.$u->cantidad.','.$u->exponente;
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