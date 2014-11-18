<?php

	require_once('inc/modelo/dao_token.php');
	require_once('inc/util.php');
	require_once('inc/common.php');
	require_once('inc/modelo/token.php');
	require_once('util/utilWeb.php');

	$token = $_GET['token'];

	$t = DaoToken::getDao()->porToken($token);
	if ($t != null)
	{
		if (isset($_GET['pass']) && ($_GET['pass']!=null )){
			UtilWeb::cambiarHashSalt($t, $_GET['pass']);
		}
		if (isset($_GET['correo']) && ($_GET['correo']!=null)){
			UtilWeb::cambiarCorreo($t,$_GET['correo']);
		}
		if (isset($_GET['foto']) && ($_GET['foto']!=null)){
			UtilWeb::cambiarFoto($t,$_GET['foto']);
			
		}
		echo json_encode(array ("tipo"=>"ok"));
	}
	else
		echo json_encode(array ("tipo"=>"ok", "msn"=>"badToken"));

