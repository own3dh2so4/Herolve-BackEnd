<?php

	require_once 'basedao.php';
	
class DaoMisiones extends BaseDao{
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
			return 'misiones';
		}
	
		public function getClassName() {
			return 'Misiones';
		}
		
		public function getColumNames() {
			return 'id, nombre, descripcion, tiempo, nivel, poder,  fallo, jugadores,rec_comida,rec_experiencia, rec_madera, rec_metal, rec_piedra, rec_rubies';
		}
		
		public function getValuesFrom($u){
			return $u->id.',"'.$u->nombre.'","'.$u->descripcion.'",'.$u->tiempo.','.$u->nivel.','.$u->poder.', '.$u->fallo.','.$u->jugadores.','.$u->rec_comida.','.$u->rec_experiencia.','.$u->rec_madera.','.$u->rec_metal.','.$u->rec_piedra.','.$u->rec_rubies;
		}
		
		public function porId($id) {
			$query = "select * from " . $this->getTableName()." where id=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porNombre($nombre) {
			$query = "select * from " . $this->getTableName()." where nombre=:login";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $nombre));
			return  $ret;
		} 
		
		 

}