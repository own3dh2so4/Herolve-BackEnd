<?php
/** 
 * Fichero de configuracion para Tablon
 *
 * "Tablon", aplicacion de ejemplo para el Seminario de Tecnologias Web
 * autor: manuel.freire@fdi.ucm.es, 2011
 * licencia: dominio publico
 */

// Array que contiene toda la configuracin de Tablon
$config = array();
	 

/*
 * Base de datos a usar; estos valores se usan para establecer la conexion
 * con la BD; se leen desde inc/modelo/database.php
 */
$config['bd_pass']   = '';
$config['bd_user']   = 'root';
$config['bd_name']   = 'herolve';
$config['bd_host'] = 'localhost';

/*
 * Util para mostrar que nos envian; no usar en produccion
 */
$config['debug'] = true;
$config['debug_file'] = 'herolve.txt';

/*
 * Modifica la ruta de las cookies de esta aplicacion
 * el tiempo que tardan en caducar, y su nombre
 * mas en http://www.php.net/manual/en/session.configuration.php
 */
$config['cookie_path'] = '/herolve/';
$config['cookie_timeout'] = 60 * 60 * 1; // 1h en segundos
$config['cookie_name'] = 'HEROLVECOOKIE';

