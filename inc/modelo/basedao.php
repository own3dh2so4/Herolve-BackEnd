<?php

require_once 'database.php';

abstract class BaseDao {

    public abstract function getTableName();
    public abstract function getClassName();
	public abstract function getColumNames();
	public abstract function getValuesFrom($entity);

    protected $db;
   
    protected function __construct() {
        $this->db = Database::getDb();
    }
   
    public function delete( $entity ) {
        $this->deleteById($entity->id);
    }
    
    public function save( $entity ) {
        $entity->id = (int) $entity->id;
		// si tiene ID <= 0 se asume que es un objeto nuevo
        if ( $entity->id > 0 ) {
            $this->db->updateObject($this->getTableName(), $entity);
        } else {
            $entity->id = $this->db->insertObject($this->getTableName(), $entity, $this->getColumNames(), $this->getValuesFrom($entity));   
        }

        return $entity->id;
    }

	public function guarda($entity, $primarykey1, $primarykey2 ){
		$this->db->updateObjectDosPK($this->getTableName(), $entity , $primarykey1, $primarykey2);
	}
	
	public function create ($entity){
		$this->db->insertObject($this->getTableName(), $entity, $this->getColumNames(), $this->getValuesFrom($entity));
	}
    
	public function deleteById( $id ) {
        $id = (int) $id;
        if ( $id > 0 ) {
            $query = 'DELETE FROM ' . $this->getTableName() . ' WHERE `id`=:id ';
            $result = $this->db->query($query, array("id" => $id));
            return $result;
        }
        return 0;
    }
    
    public function porId( $id ) {
        $id = (int) $id;    
        $query = 'SELECT * FROM ' . $this->getTableName() . ' WHERE `id`=:id ';
        return $this->db->queryForObject( $query, 
            $this->getClassName(), array("id" => $id));
    }
}

