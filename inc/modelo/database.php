<?php

require_once 'heroes.php';
require_once 'recursos.php';
require_once 'edificios.php';
require_once 'mundo.php';
require_once 'mapas.php';
require_once 'misionesHeroe.php';
require_once 'mapas_misiones.php';
require_once 'notificacionesUsuario.php';
require_once 'tokenAdmin.php';


/** 
 * Fichero con funciones de utilidad para manejar una BD via DBO
 *
 * "Tablon", aplicacion de ejemplo para el Seminario de Tecnologias Web
 * autor: manuel.freire@fdi.ucm.es, 2011
 * licencia: dominio publico
 */
class Database {

    private $connection;
    private $affectedRows;
    
    private static $dbInstance;
   
    /**
     * Singleton pattern constructor
     */
    public static function getDb() {
        if ( self::$dbInstance === null ) {
            self::$dbInstance = new Database();
        }
        return self::$dbInstance;
    }
    
    private function __construct() {
        global $config;
		try {
    		$server = 'mysql:host=' . $config['bd_host'];
    		$server .= ';dbname=' . $config['bd_name'];
            $this->connection = new PDO($server, $config['bd_user'], $config['bd_pass'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
    	    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch ( PDOException $e ) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function __destruct() {
        if ( isset($this->connection) ) {
            $this->connection = null;
        }
    }

    public function getAffectedRows() {
        return $this->affectedRows;
    }

    public function getInsertId( $seqname = null ) {
        return $this->connection->lastInsertId($seqname);
    }

    /**
     * Returns current PDOStatement
     *
     * @return PDOStatement
     */
    protected function execute( $sql, array $params = null ) {
        /* @var $stmt PDOStatement */
        $stmt = $this->connection->prepare($sql);
        if ( $params !== null ) {
            foreach ( $params as $key => $value ) {
                $paramType = PDO::PARAM_STR;
                if ( is_int($value) ) {
                    $paramType = PDO::PARAM_INT;
                } elseif ( is_bool($value) ) {
                    $paramType = PDO::PARAM_BOOL;
                }
                $stmt->bindValue(is_int($key) ? $key + 1 : $key, $value, $paramType);
            }
        }
        //var_dump($sql, $params);
        $stmt->execute();
        $this->affectedRows = $stmt->rowCount();
        return $stmt;
    }
    
	/**
	 * Returns an object that matches a query, null if not found
	 */
    public function queryForObject( $sql, $className, array $params = null) {
        $stmt = $this->execute($sql, $params);
		//var_dump($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
        $result = $stmt->fetch();
        $stmt->closeCursor();
        if ( $result === false ) {
            $result = null;
        } 
        return ($result === false) ? null : $result;
    }

	/**
	 * Returns a row (as an associative array) that matches a query, null if not found
	 */
    public function queryForRow( $sql, array $params = null, $tags = array() ) {
        $stmt = $this->execute($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

	/**
	 * Returns an array of objects that match a query
	 */
    public function queryForObjectList( $sql, $className, array $params = null) {
        $stmt = $this->execute($sql, $params);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $className);
        return $result;
    }

	/**
	 * Returns an array of assoc. arrays that match a query
	 */
    public function queryForList( $sql, array $params = null ) {
        $stmt = $this->execute($sql, $params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

	/**
	 * No-results query (use for deletes or updates)
	 * Returns the number of rows affected
	 */
    public function query( $sql, array $params = null ) {
        $stmt = $this->execute($sql, $params);
        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowCount;
    }

	/**
	 * Returns last_insert_id of the row inserted
	 */
    public function insert( $sql, array $params = null ) {
        $stmt = $this->execute($sql, $params);
        $lastInsertId = $this->connection->lastInsertId();
        $stmt->closeCursor();
        return $lastInsertId;
    }
	
	
    /**
     * Insert object $obj to table $tableName. Returns last_insert_id
     */
    public function insertObject( $tableName, $obj, $names, $valueNames ) {
        //echo "<br><br><br><br><br><br>";
		//var_dump($names);
		//echo "<br><br><br><br><br><br>";
		//var_dump($valueNames);
        $sql = "INSERT INTO `{$tableName}` ({$names}) VALUES ({$valueNames})";
		/*echo "<br> Esto es el SAVE <br>";
		echo $sql;*/
        return $this->insert($sql);    
    }        

	
    /**
     * Update object $obj to table $tableName
     */
    public function updateObject( $tableName, $obj, $primaryKeyName = 'id') {
		//var_dump($obj);
        $params = get_object_vars($obj);
        $updateArray = array();
        foreach ( $params as $key => $value ) {
            if ( $key !== $primaryKeyName ) {
                $updateArray[] = '`' . $key . '`=:' . $key;
            }
        }
        $updateStmt = join(',', $updateArray);
        $sql = "UPDATE `{$tableName}` SET {$updateStmt} "
        	. "WHERE `{$primaryKeyName}`=:{$primaryKeyName}";
		
        return $this->execute($sql, $params); // cambiado
    }
	
	public function updateObjectDosPK( $tableName, $obj, $primaryKeyName1, $primaryKeyName2) {
        $params = get_object_vars($obj);
        $updateArray = array();
        foreach ( $params as $key => $value ) {
            if ( $key !== $primaryKeyName1 ) 
                $updateArray[] = '`' . $key . '`=:' . $key;
            else if ( $key !== $primaryKeyName2) 
                $updateArray[] = '`' . $key . '`=:' . $key;
            
        }
        $updateStmt = join(',', $updateArray);
        $sql = "UPDATE `{$tableName}` SET {$updateStmt} "
        	. "WHERE `{$primaryKeyName1}`=:{$primaryKeyName1} AND `{$primaryKeyName2}`=:{$primaryKeyName2}";
		//var_dump($sql);
        return $this->execute($sql, $params); // cambiado
    }
	
}

