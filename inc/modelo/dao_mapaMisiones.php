<?php

	require_once 'basedao.php';
	
class DaoMapaMisiones extends BaseDao{
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
			return 'mapas_misiones';
		}
	
		public function getClassName() {
			return 'MapasMisiones';
		}
		
		public function getColumNames() {
			return 'id_mapa, id_mision, posicion, x, y';
		}
		
		public function getValuesFrom($u){
			return $u->id_mapa.','.$u->id_mision.','.$u->posicion.','.$u->x.','.$u->y;
		}
		
		public function porIdMapa($id) {
			$query = "select * from " . $this->getTableName()." where id_mapa=:login";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $id));
			return  $ret;
		} 
		
		public function porIdMapaIdMision($idMapa, $idMision){
			$query = "select * from " . $this->getTableName()." where id_mapa=:login AND id_mision=:mision";
			//var_dump($query);
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idMapa,'mision'=>$idMision));
			return  $ret;
		}
		
		public function porIdMapaPosicion($idMapa, $posicion){
			$query = "select * from " . $this->getTableName()." where id_mapa=:login AND posicion=:mision";
			$ret= $this->db->queryForObject($query, $this->getClassName(),array('login' => $idMapa, 'mision'=>$posicion));
			return  $ret;
		}
		
		public function porIdMapaIdMisionPosicion($idMapa, $idMision,$posicion){
			$query = "select * from " . $this->getTableName()." where id_mapa=:login AND id_mision=:mision AND posicion=:pos";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idMapa,'mision'=>$idMision, 'pos'=>$posicion));
			return  $ret;
		}
		
}