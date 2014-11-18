<?php

require_once('inc/modelo/dao_usuarios.php');
require_once('inc/modelo/dao_heroes.php');
require_once('inc/modelo/dao_token.php');
require_once('inc/modelo/token.php');
require_once('inc/util.php');
require_once('inc/common.php');

	$nombreUsuario = $_GET['nombreUsuario'];
	$pass = $_GET['pass'];
	$mundoHeroe = $_GET['mundoHeroe'];
	
	$user = DaoUsuario::getDao()->porLogin($nombreUsuario);
	if ($user==null)
		echo json_encode(array ("tipo"=>"error", "msn" => "baduser"));
	else {
		if (Util::verifica($user->hash, $pass, $user->salt)){
			$h = DaoHeroe::getDao()->porIdUser($user->id,$mundoHeroe);
			$token = Util::aleat(64);
			$user->estado="c";
			DaoUsuario::getDao()->save($user);
			if (($tokenR =DaoToken::getDao()->porId($h->id)) != null) {
				DaoToken::getDao()->borrar($tokenR);
				$r=Token::crea($h->id,$token);
				echo json_encode(array ("tipo"=>"ok", "token" => $token, "dentro"=>"si"));
			}else if (DaoToken::getDao()->porToken($token) != null) {
				echo json_encode(array ("tipo"=>"error", "msn" => "tokenRepetido"));
			}
			else {
			$r=Token::crea($h->id,$token);
			echo json_encode(array ("tipo"=>"ok", "token" => $token));
			}
		}
		else {
			echo json_encode(array ("tipo"=>"error", "msn" => "badpass"));
		}
	}
