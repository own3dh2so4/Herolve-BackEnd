
<?php
/** 
 * Funciones de utilidad que deben estar accesibles desde todas partes
 *
 * "Tablon", aplicacion de ejemplo para el Seminario de Tecnologias Web
 * autor: manuel.freire@fdi.ucm.es, 2011
 * licencia: dominio publico
 */
 
class Util { 
    /**
     * muestra una traza en el ficheros inc/traza.txt con
     * fecha, IP, y todos los argumentos pasados; si los argumentos
     * son variables definidas, se muestra su contenido
     */
    public static function traza() {
        global $config;
        
        if ( ! isset($config['debug_file'])) return;
	    $texto = date("Ymd-H:i:s ") . $_SERVER['REMOTE_ADDR'];
	    foreach (func_get_args() as $arg) {
		    $texto .= ' - ' . var_export($arg, true);
	    }
	    file_put_contents($config['debug_file'], $texto . "\n", FILE_APPEND);
    }

    /* 
     * Genera cadenas hex. aleatorias en multiplos de 4 caracteres; y luego 
     * recorta hasta lo que se haya pedido
     */
    public static function aleat($chars) {
        $res = '';
        for ($i=0; $i<$chars; $i+=4) {			
	        $res = sprintf("%s%04x", $res, mt_rand(0, 0xffff));
        }
        return substr($res, 0, $chars);
    }	 

    /*
     * Genera un hash(pass, salt)
     * Si toda la aplicacion usa esta funcion, es facil cambiar la
     * implementacion
     */
    public static function hash($pass, $salt) {
        return sha1($pass . $salt);
    }

    /*
     * Verifica que hash(pass, salt) coincide con el argumento
     */
    public static function verifica($hash, $pass, $salt) {
        return Util::hash($pass, $salt) == $hash;
    }
}
