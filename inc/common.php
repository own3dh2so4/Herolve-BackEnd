<?php
/** 
 * Fichero con includes y funciones basicos para "Tablon"
 *
 * "Tablon", aplicacion de ejemplo para el Seminario de Tecnologias Web
 * autor: manuel.freire@fdi.ucm.es, 2011
 * licencia: dominio publico
 */
 
// configuracion
require_once 'inc/config.php';

// utilidades
require_once 'inc/util.php';

// usuarios
require_once 'inc/modelo/usuarios.php';

// -------------- preparacion de la sesion

/* 
 * inicializa la sesion (incorpora la cookie a la respuesta,
 * y si la peticion tenia cookie, almacena sus valores en 
 * el array superglobal _SESSION) 
 */
session_set_cookie_params($config['cookie_timeout'], $config['cookie_path']);
session_name($config['cookie_name']);
session_start();
if ( ! isset($_SESSION['user'])) {
	// inicializa una sesion vacia	
	$_SESSION['user'] = null;
}

