<?php

require_once('inc/modelo/dao_usuariosAdmin.php');
require_once('inc/modelo/dao_tokenAdmin.php');
require_once('inc/modelo/usuariosAdmin.php');
require_once('inc/modelo/tokenAdmin.php');
require_once('inc/util.php');
require_once('inc/common.php');

	$nombreUsuario = $_GET['nombreUsuario'];
	$pass = $_GET['pass'];
	
	$user = DaoUsuarioAdmin::getDao()->porLogin($nombreUsuario);
	if ($user==null)
		echo json_encode(array ("tipo"=>"error", "msn" => "baduser"));
	else {
		if (Util::verifica($user->hash, $pass, $user->salt)){
			$token = Util::aleat(64);
			if (($tokenR =DaoTokenAdmin::getDao()->porId($user->id)) != null) {
				DaoTokenAdmin::getDao()->borrar($tokenR);
				$r=TokenAdmin::crea($user->id,$token);
				echo json_encode(array ("tipo"=>"ok", "token" => $token, "dentro"=>"si"));
			}else if (DaoTokenAdmin::getDao()->porToken($token) != null) {
				echo json_encode(array ("tipo"=>"error", "msn" => "tokenRepetido"));
			}
			else {
			$r=TokenAdmin::crea($user->id,$token);
			echo json_encode(array ("tipo"=>"ok", "token" => $token));
			}
		}
		else {
			echo json_encode(array ("tipo"=>"error", "msn" => "badpass"));
		}
	}
