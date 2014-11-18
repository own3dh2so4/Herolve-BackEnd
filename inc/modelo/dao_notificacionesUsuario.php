<?php 

require_once 'basedao.php';
	
class DaoNotificacionesUsuario extends BaseDao {
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
			return 'notificaciones_usuario';
		}
	
		public function getClassName() {
			return 'NotificacionesUsuario';
		}
		
		public function getColumNames() {
			return 'id, id_heroe, descripcion, fecha';
		}
		
		public function getValuesFrom($u){
			return $u->id.','.$u->id_heroe.',"'.$u->descripcion.'","'.$u->fecha.'"';
		}
		
		

		
		public function porIdHeroe($idH) {
			$query = "select * from " . $this->getTableName()." where id_heroe=:login ORDER BY fecha DESC";
			//var_dump($query);
			$ret= $this->db->queryForObjectList($query, $this->getClassName(),array('login' => $idH));
			return  $ret;
		}   
		
		public function borrar($obj){
			$this->delete($obj);
		}
}