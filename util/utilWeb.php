<?php

	require_once('inc/modelo/dao_edificios_heroe.php');
	require_once('inc/modelo/dao_edificios.php');
	require_once('inc/modelo/dao_edificios_heroe.php');
	require_once('inc/modelo/dao_amigosPendientes.php');
	require_once('inc/modelo/dao_mapaMisiones.php');
	require_once('inc/modelo/dao_misionesHeroe.php');
	require_once('inc/modelo/dao_mapas.php');
	require_once('inc/modelo/dao_mundo.php');
	require_once('inc/modelo/dao_usuarios.php');
	require_once('inc/modelo/dao_usuariosAdmin.php');
	require_once('inc/modelo/dao_misiones.php');
	require_once ('inc/modelo/dao_chat.php');
	require_once('inc/modelo/edificios_heroe.php');
	require_once('inc/modelo/amigosPendiente.php');
	require_once('inc/modelo/edificios.php');
	require_once('inc/modelo/amigos.php');
	require_once('inc/modelo/misiones.php');
	require_once('inc/modelo/chat.php');
	require_once('inc/modelo/usuariosAdmin.php');
	require_once('inc/modelo/usuarios.php');
	require_once('inc/modelo/mundo.php');
	require_once('inc/modelo/mapas.php');
	require_once('inc/modelo/misiones.php');
	require_once('inc/modelo/mapas_misiones.php');
	require_once('inc/modelo/block.php');
	require_once('inc/modelo/dao_notificacionesUsuario.php');

class UtilWeb{
	
	public static function getRecursos($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		
		$e = DaoEdificio::getDao()->todos();
		$maderaProd = $e[0]->cantidad * $e[0]->exponente ;
		$comidaProd = $e[1]->cantidad * $e[1]->exponente ;
		$metalProd = $e[5]->cantidad * $e[5]->exponente ;
		$piedraProd = $e[6]->cantidad * $e[6]->exponente ;
		$rubiesProd = $e[7]->cantidad * $e[7]->exponente ;
		$soldadosProd = $e[2]->cantidad * $e[2]->exponente ;
		$magosProd = $e[3]->cantidad * $e[3]->exponente ;
		
		
		$edificiosHeroe = DaoEdificioHeroe::getDao()->porIdHeroe($h->id);
		
		
		$ahora = date('Y-m-d H:i:s');
		$ahoraUnix = strtotime($ahora);
		$tiempoProduccion = $ahoraUnix - strtotime($h->last);
		$h->last = $ahora ;
		$produccionMadera = $edificiosHeroe[0]->nivel * $maderaProd * $tiempoProduccion;
		$produccionComida = $edificiosHeroe[1]->nivel * $comidaProd * $tiempoProduccion;
		$produccionMetal = $edificiosHeroe[5]->nivel * $metalProd * $tiempoProduccion;
		$produccionPiedra = $edificiosHeroe[6]->nivel * $piedraProd * $tiempoProduccion;
		$produccionRubies = $edificiosHeroe[7]->nivel * $rubiesProd * $tiempoProduccion;
		$producionSoldados = $edificiosHeroe[2]->nivel * $soldadosProd * $tiempoProduccion;
		$producionMagos = $edificiosHeroe[3]->nivel * $magosProd * $tiempoProduccion;
		
		$recursos = DaoRecursos::getDao()->porIdHeroe($h->id);
		$recursos[0]->cantidad = $recursos[0]->cantidad + $produccionComida;
		$recursos[1]->cantidad = $recursos[1]->cantidad + $produccionMadera;
		$recursos[2]->cantidad = $recursos[2]->cantidad + $producionMagos;
		$recursos[3]->cantidad = $recursos[3]->cantidad + $produccionMetal;
		$recursos[4]->cantidad = $recursos[4]->cantidad + $produccionPiedra;
		$recursos[5]->cantidad = $recursos[5]->cantidad + $produccionRubies;
		$recursos[6]->cantidad = $recursos[6]->cantidad + $producionSoldados;
		
		DaoRecursos::getDao()->guarda($recursos[0],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[1],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[2],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[3],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[4],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[5],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[6],"id_heroe","clase");
		DaoHeroe::getDao()->save($h);
		
		return $recursos;
	}
	
	public static function getEdificios (){
		return  DaoEdificio::getDao()->todos();
	}
	
	public static function getEdificiosHeroe($t){
		return DaoEdificioHeroe::getDao()->porIdHeroe($t->id);
	}
	
	public static function getHeroe($t){
		return DaoHeroe::getDao()->porId($t->id);
	}
	
	public static function getNotificaciones($t){
		$n = DaoNotificacionesUsuario::getDao()->porIdHeroe($t->id);
		if (count($n)>10)
			for ($i=10; $i<count($n);$i++)
				DaoNotificacionesUsuario::getDao()->borrar($n[$i]);
		return $n;
	}
	
	public static function getUser($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		$user = DaoUsuario::getDao()->porId($h->id_user);
		return array ("id" => $user->id, "nick" => $user->nick, "estado" => $user->estado, "foto" => $user->foto);
	}
	
	public static function mejoraEdificio($t,$idEdificio){
		$edificiosMejorando = DaoEdificioHeroe::getDao()->enConstruction($t->id);
		if ($edificiosMejorando!=null)
			return json_encode(array("tipo"=>"error","msn"=>"hayEdificioConstrucion"));
		$h = DaoHeroe::getDao()->porId($t->id);
		$r = UtilWeb::getRecursos($t);
		
		$e = DaoEdificio::getDao()->porId($idEdificio); //edificio general
		
		$edificio = DaoEdificioHeroe::getDao()->porIdHeroeIdEdificio($h->id, $e->id);	//del heroe
		
		$preciomadera = $e->valormadera * ($edificio->nivel+1);
		$preciopiedra = $e->valorpiedra * ($edificio->nivel+1);
		$preciometal = $e->valormetal * ($edificio->nivel+1);
		$preciocomida = $e->valorcomida * ($edificio->nivel+1);
		$preciorubies = $e->valorrubies * ($edificio->nivel+1);
		
		
		
		if ($preciomadera> $r[1]->cantidad)
			return json_encode(array("tipo"=>"error","falta"=>"madera"));
		else if ($preciopiedra > $r[4]->cantidad)
			return json_encode(array("tipo"=>"error","falta"=>"piedra"));
		else if ($preciometal > $r[3]->cantidad)
			return json_encode(array("tipo"=>"error","falta"=>"metal"));
		else if ($preciocomida > $r[0]->cantidad)
			return json_encode(array("tipo"=>"error","falta"=>"comida"));
		else if ($preciorubies > $r[5]->cantidad)
			return json_encode(array("tipo"=>"error","falta"=>"rubies"));
		else{
		
			$r[0]->cantidad = $r[0]->cantidad - $preciocomida;
			$r[1]->cantidad = $r[1]->cantidad - $preciomadera;
			$r[3]->cantidad = $r[3]->cantidad - $preciometal;
			$r[4]->cantidad = $r[4]->cantidad - $preciopiedra;
			$r[5]->cantidad = $r[5]->cantidad - $preciorubies;
			
			DaoRecursos::getDao()->guarda($r[0],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($r[1],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($r[3],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($r[4],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($r[5],"id_heroe","clase");
			
			$sumaTotal = $preciocomida + $preciomadera +$preciometal + $preciopiedra +$preciorubies;
			
			$ahora = date('Y-m-d H:i:s');
			$finalizacionUnix = strtotime($ahora)+$sumaTotal;
			//$finalizacionUnix = strtotime($ahora)+20;
			$edificio->final = date("Y-m-d H:i:s", $finalizacionUnix);
			$edificio->estado = "c";
			
			DaoEdificioHeroe::getDao()->guarda($edificio, "id_heroe", "id_edificio");
			return json_encode(array("tipo"=>"ok"));
			}
	}

	
	public static function actualizaEdificio($t){
		$e = DaoEdificioHeroe::getDao()->enConstruction($t->id);
		if ($e !=null){
			if ($e->final!=null){
				$h = DaoHeroe::getDao()->porId($t->id);
				$ahora = date('Y-m-d H:i:s');
				$ahoraUnix = strtotime($ahora);
				$finalUnix = strtotime($e->final);
				if ($ahoraUnix>$finalUnix){
					$e->final=null;
					$e->nivel++;
					$e->estado="d";
					DaoEdificioHeroe::getDao()->guarda($e, "id_heroe", "id_edificio");
					$edificio = DaoEdificio::getDao()->porId($e->id_edificio);
					if ($edificio->id==5){ //es la herreria
						$h->poder = $h->poder + $e->nivel*10;
						DaoHeroe::getDao()->save($h);
					}
					UtilWeb::setNotificacion ($h->id, "Has terminado el edificio: ".$edificio->nombre);
					return $e;
				}
			}
		}
		return null;
		
	}
	
	public static function agregarAmigo ($t, $idA){
		$h = DaoHeroe::getDao()->porId($t->id);
		$userAgregar = DaoUsuario::getDao()->porLogin($idA);
		$userName = UtilWeb::getUser($t)["nick"];
		if ($userAgregar==null){
			return false;
		}
		$ap = DaoAmigosPendientes::getDao()->porIdUser1Y2($h->id_user,$userAgregar->id);
		$a = DaoAmigos::getDao()->porUsers($h->id_user,$userAgregar->id);
		if (UtilWeb::isBlock($h->id_user,$userAgregar->id))
			return true;
		else if ($ap == null && $a == null){
			AmigosPendiente::crea($h->id_user,$userAgregar->id);
			$heroesAmigo = DaoHeroe::getDao()->porIdUserList($userAgregar->id);
			for ($i=0; $i<count($heroesAmigo); $i++)
				UtilWeb::setNotificacion ($heroesAmigo[$i]->id, "Te ha solicitado amistad ".$userName);
			UtilWeb::setNotificacion ($h->id, "Has solicitado amistad a ".$idA);
			return true;
		}else
			return false;
	}
	
	public static function aceptaAmigo($t, $idUser2){
		$user = UtilWeb::getUser($t);
		$user2= DaoUsuario::getDao()->porLogin($idUser2);
		$u1 = DaoAmigosPendientes::getDao()->porIdUser1Y2($user["id"], $user2->id);
		
		if($u1 == null){
			return false;
		}
		else{
			if ($u1==!null)				
				DaoAmigosPendientes::getDao()->borrar($u1);
			else if ($u2==!null)
				DaoAmigosPendientes::getDao()->borrar($u2);
			Amigos::crea($user["id"], $user2->id);
			$heroesAmigo = DaoHeroe::getDao()->porIdUserList($user2->id);
			for ($i=0; $i<count($heroesAmigo); $i++)
				UtilWeb::setNotificacion ($heroesAmigo[$i]->id, "Ya eres amigo de ".$user["nick"]);
			UtilWeb::setNotificacion ($t->id, "Ya eres amigo de ".$idUser2);
			return true;
		}
		
	}
	
	public static function getMundos(){
		return DaoMundo::getDao()->todos();
	}
	
	public static function getMapas($t){
		$h = UtilWeb::getHeroe($t);
		return DaoMapa::getDao()->porIdMundo($h->id_mundo);
	}
	
	public static function getMisionesMapa($idMapa){
		return DaoMapaMisiones::getDao()->porIdMapa($idMapa);
	}
	
	public static function getMision($id){
		return DaoMisiones::getDao()->porId($id);
	}
	
	public static function getMisionesHeroe($t){
		$heroe =  UtilWeb::getHeroe($t);
		$ret = array();
		$misionesPosicion = DaoMapaMisiones::getDao()->porIdMapa($heroe->id_mundo);
		$ret["misionesPosicion"] = $misionesPosicion;
		$arrayMisiones = array();
		for ($i=0; $i<count($ret["misionesPosicion"]); $i++)
			$arrayMisiones[$i] = DaoMisiones::getDao()->porId($misionesPosicion[$i]->id_mision);
		$ret["misiones"] = $arrayMisiones;
		$ret["misionesHeroe"] = DaoMisionesHeroe::getDao()->porIdHeroe($t->id);
		return $ret;
	}
	
	public static function inicializaMisiones($heroe){
		$misiones = UtilWeb::getMisionesMapa($heroe->id_mundo);
		for ($i=0; $i<count($misiones); $i++)
		{
			if ($i==0)
				MisionesHeroe::crea ($heroe->id, $misiones[$i]->id_mision, "n");
			else	
				MisionesHeroe::crea ($heroe->id, $misiones[$i]->id_mision, "f");
		}
	}
	
	public static function hacerMision($t, $id_mision){
		$misionesProceso = DaoMisionesHeroe::getDao()->porIdHeroeProceso($t->id);
		if($misionesProceso!=null)
			return false;
		else{
			$mision = DaoMisionesHeroe::getDao()->porIdHeroeIdMision($t->id,$id_mision);
			if ($mision !=null){

				$m = DaoMisiones::getDao()->porId($mision->id_mision);
				//$mh = new MisionesHeroe();
				$mh = DaoMisionesHeroe::getDao()->porIdHeroeIdMision($t->id, $id_mision );
				if ($mh->estado == 'c' || $mh->estado == 'f'){
					return false;
				}
				$mh->estado = 'p';
				$ahora = date('Y-m-d H:i:s');
				$finalizacionUnix = strtotime($ahora)+$m->tiempo;
				$mh->final = date("Y-m-d H:i:s", $finalizacionUnix);
				DaoMisionesHeroe::getDao()->guarda($mh,"id_heroe", "id_mision");
				return true;
			}
			else
				return false;
		}	
	}
	
	public static function terminoMision($t){
		$misionCurso = DaoMisionesHeroe::getDao()->porIdHeroeProceso($t->id);
		if ($misionCurso == null)
			return false;
		else{
			$ahora = date('Y-m-d H:i:s');
			$ahoraUnix = strtotime($ahora);
			$finalUnix = strtotime($misionCurso->final);
			if ($ahoraUnix>$finalUnix){
				$misionCurso->final=null;
				$misionCurso->estado = "c";
				DaoMisionesHeroe::getDao()->guarda($misionCurso ,"id_heroe", "id_mision");
				
				$m = UtilWeb::getMision($misionCurso->id_mision);
				
				$recursos = DaoRecursos::getDao()->porIdHeroe($t->id);
				$recursos[0]->cantidad = $recursos[0]->cantidad + $m->rec_comida;
				$recursos[1]->cantidad = $recursos[1]->cantidad + $m->rec_madera;
				$recursos[3]->cantidad = $recursos[3]->cantidad + $m->rec_metal;
				$recursos[4]->cantidad = $recursos[4]->cantidad + $m->rec_piedra;
				$recursos[5]->cantidad = $recursos[5]->cantidad + $m->rec_rubies;
				
				DaoRecursos::getDao()->guarda($recursos[0],"id_heroe","clase");
				DaoRecursos::getDao()->guarda($recursos[1],"id_heroe","clase");
				DaoRecursos::getDao()->guarda($recursos[3],"id_heroe","clase");
				DaoRecursos::getDao()->guarda($recursos[4],"id_heroe","clase");
				DaoRecursos::getDao()->guarda($recursos[5],"id_heroe","clase");
				
				$h = DaoHeroe::getDao()->porId($t->id);
				$h->experiencia = $h->experiencia + $m->rec_experiencia;
				if ($h->experiencia>= 100*pow($h->nivel,1.5)){
					$h->experiencia =(int) ($h->experiencia -  100*pow($h->nivel,1.5));
					$h->nivel++;
				}
				DaoHeroe::getDao()->save($h);
				UtilWeb::setNotificacion ($h->id, "Has terminado la mision: ".$m->nombre);
				
				
				
				
				$h = DaoHeroe::getDao()->porId($t->id);
				$mapa = DaoMapa::getDao()->porIdMundo($h->id_mundo);
				$misionPosicion = DaoMapaMisiones::getDao()->porIdMapaIdMision($mapa->id,$m->id);
				$misionNext = DaoMapaMisiones::getDao()->porIdMapaPosicion($mapa->id,$misionPosicion->posicion+1);
				
				if ($misionNext!=null){
					$misionDisponible = DaoMisionesHeroe::getDao()->porIdHeroeIdMision($t->id,$misionNext->id_mision);
					$misionDisponible->estado = 'n';
					DaoMisionesHeroe::getDao()->guarda($misionDisponible,"id_heroe", "id_mision");
					
				}	

				//$mh = DaoMisionesHeroe::getDao()->porIdHeroeIdMision($t->id, $id_mision);
				return $misionCurso;
			}
			else
				return false;
		
		}
	}
	
	public static function setNotificacion ($idH, $msn){
		
		NotificacionesUsuario::crea($idH, $msn, date('Y-m-d H:i:s'));
	
	}
	
	public static function getAmigos ($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		$amigos = DaoAmigos::getDao()->porUser($h->id_user);
		$amigosRet = array();
		for ($i=0; $i<count($amigos); $i++)
		{
			$asearch;
			if ($amigos[$i]->id_user1==$h->id_user)
				$asearch = $amigos[$i]->id_user2;
			else if ($amigos[$i]->id_user2==$h->id_user)
				$asearch = $amigos[$i]->id_user1;
			$u = DaoUsuario::getDao()->porId($asearch);
			$a = array();
			$a["nombre"] = $u->nick;
			$a["estado"] = $u->estado;
			if ($amigos[$i]->estado=="a")
				$a["block"] = "no";
			else if($amigos[$i]->estado=="b")
				$a["block"] = "si";
			else	
				$a["block"] = "undefined";
			$amigosRet[$i] = $a;
		}
		return $amigosRet;
	}
	
	public static function enviarMensaje($t,$nombreUser, $msn){
		$userRecibe = DaoUsuario::getDao()->porLogin($nombreUser);
		if ($userRecibe==null)
			return false;
		$h = DaoHeroe::getDao()->porId($t->id);
		if ($h==null)
			return false;
		$amigos = DaoAmigos::getDao()->porUsers($h->id_user,$userRecibe->id );
		if ($amigos==null)
			return false;
		Chat::crea($amigos->id,$h->id_user,$msn);
			return true;
	}
	
	public static function getMensajes ($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		$c = DaoChat::getDao()->porIdUser($h->id_user);
		$chatRet = array();
		if (count($c)>20)
			for ($i=20; $i<count($c);$i++)
				DaoChat::getDao()->borrar($c[$i]);
		$amigos = array(); // estas dos variables son para evitar hacer consultas ya realizadas
		$am = array();
		for ($i=0; $i<count($c); $i++){
			$a;
			if (!array_key_exists($c[$i]->id_amigos, $amigos)){
				$a = DaoAmigos::getDao()->porId($c[$i]->id_amigos);
				$am[$c[$i]->id_amigos] = $a;
			}
			else {
				$a = $am[$c[$i]->id_amigos];
			}
			$asearch;
			if ($a->id_user1==$h->id_user)
				$asearch = $a->id_user2;
			else if ($a->id_user2==$h->id_user)
				$asearch = $a->id_user1;
			$u;
			if (!array_key_exists($asearch, $amigos)){
				$u = DaoUsuario::getDao()->porId($asearch)->nick;
				$amigos[$asearch ]= $u;
			}else{
				
				$u =  $amigos[$asearch];}
			$chat = array();
			$chat["de"] = $u;
			$chat["msn"] = $c[$i]->mensaje;
			$chat["fecha"] = $c[$i]->fecha;
			$chatRet[$i] = $chat;
		}
			
		return $chatRet;
	}
	
	public static function getMensajesFromUser ($t, $user){
		$userE = DaoUsuario::getDao()->porLogin($user);
		$u = DaoUsuario::getDao()->porId(DaoHeroe::getDao()->porId($t->id)->id_user);
		
		if ($user==null)
			return false;
		$amigos = DaoAmigos::getDao()->porUsers($u->id, $userE->id);
		$chats = DaoChat::getDao()->porIdAmigo($amigos->id);
		$msns = array();
		for ($i=0; $i<count($chats); $i++){
			$chat = array();
			if ($chats[$i]->id_user == $userE->id)
				$chat["de"] = $userE->nick;
			else if ($chats[$i]->id_user == $u->id)
				$chat["de"] = $u->nick;
			else 
				$chat["de"] = "Desconocido";
			$chat["msn"] = $chats[$i]->mensaje;
			$chat["fecha"] = $chats[$i]->fecha;
			$msns[$i] = $chat;
		}
		return $msns;
		
	}
	
	public static function cambiarHashSalt ($t, $nuevaPass){
		$h = DaoHeroe::getDao()->porId($t->id);
		$user = DaoUsuario::getDao()->porId($h->id_user);
		$user->salt = Util::aleat(10);
		$user->hash = Util::hash($nuevaPass,$user->salt);
		DaoUsuario::getDao()->save($user);
	}
	
	public static function cambiarCorreo ($t,$nuevoCorreo){
		$h = DaoHeroe::getDao()->porId($t->id);
		$user = DaoUsuario::getDao()->porId($h->id_user);
		$user->correo = $nuevoCorreo;
		DaoUsuario::getDao()->save($user);
	}
	
	public static function cambiarFoto($t,$foto){
		$h = DaoHeroe::getDao()->porId($t->id);
		$user = DaoUsuario::getDao()->porId($h->id_user);
		$user->foto = $foto;
		DaoUsuario::getDao()->save($user);
	}
	
	public static function unLog($t){
		$idHeroe = $t->id;
		$h = DaoHeroe::getDao()->porId($t->id);
		$h->last = $h->last=date('Y-m-d H:i:s');
		DaoHeroe::getDao()->save($h);
		
		$u = DaoUsuario::getDao()->porId($h->id_user);
		$u->estado="d";
		DaoUsuario::getDao()->save($u);
		
		DaoToken::getDao()->borrar($t);
		
		$amigos = DaoAmigos::getDao()-> porUser($u->id);
		for ($i=0; $i<count($amigos); $i++)
			DaoChat::getDao()->borrarPorIdAmigos($amigos[$i]->id);
	}
	
	public static function buscarAmigos($nombreAmigo){
		$amigos = DaoUsuario::getDao()->porVariosPorLogin("%".$nombreAmigo."%");
		$a = array();
		for ($i=0; $i<count($amigos);$i++){
			$a[$i]=$amigos[$i]->nick;
		}
		return $a;
	}

	public static function blockearUsuario($t, $user){
		$h = DaoHeroe::getDao()->porId($t->id);
		$u = DaoUsuario::getDao()->porLogin($user);
		if($u==null)
			return false;
		Block::crea($h->id_user, $u->id);
		$amigos = DaoAmigos::getDao()->porUsers($h->id_user, $u->id);
		if ($amigos !=null){
			$amigos->estado="b";
			DaoAmigos::getDao()->save($amigos);
			DaoChat::getDao()->borrarPorIdAmigos($amigos->id);
		}
		return true;
	}
	
	public static function isBlock($idB1, $idB2){
		$b = DaoBlock::getDao()->saberBlock($idB1, $idB2);
		return $b != null;
	}
	
	public static function unBlock($t, $user){
		$h = DaoHeroe::getDao()->porId($t->id);
		$u = DaoUsuario::getDao()->porLogin($user);
		if($u==null)
			return false;
		DaoBlock::getDao()->borrarPorIds($h->id_user, $u->id);
		$amigos = DaoAmigos::getDao()->porUsers($h->id_user, $u->id);
		$amigos->estado="a";
		DaoAmigos::getDao()->save($amigos);
		return true;
	}
	
	
	public static function getPeticionesAmigo($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		$aa = DaoAmigosPendientes::getDao()->porIdUser2($h->id_user);
		$amigos = array();
		for ($i=0; $i<count($aa); $i++){
			$amigos[$i] = DaoUsuario::getDao()->porId($aa[$i]->idUser1)->nick;
		}
		return $amigos;
	}
	
	public static function jugarPartida($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		$recursos = DaoRecursos::getDao()->porIdHeroe($h->id);
		if($recursos[0]->cantidad< 5 || $recursos[1]->cantidad< 5 || $recursos[4]->cantidad< 5)
			return false;
		$recursos[0]->cantidad = $recursos[0]->cantidad - 5;
		$recursos[1]->cantidad = $recursos[1]->cantidad - 20;
		$recursos[4]->cantidad = $recursos[4]->cantidad - 20;

		DaoRecursos::getDao()->guarda($recursos[0],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[1],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[3],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[4],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[5],"id_heroe","clase");
		
		return true;
	
	}
	
	public static function ganaPartida($t){
		$h = DaoHeroe::getDao()->porId($t->id);
		$recursos = DaoRecursos::getDao()->porIdHeroe($h->id);
		$recursos[0]->cantidad = $recursos[0]->cantidad + 15;
		$recursos[1]->cantidad = $recursos[1]->cantidad + 50;
		$recursos[3]->cantidad = $recursos[3]->cantidad + 2;
		$recursos[4]->cantidad = $recursos[4]->cantidad + 50;
		$recursos[5]->cantidad = $recursos[5]->cantidad + 1;
		DaoRecursos::getDao()->guarda($recursos[0],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[1],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[3],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[4],"id_heroe","clase");
		DaoRecursos::getDao()->guarda($recursos[5],"id_heroe","clase");
			
		
		
		return true;
	
	}
	
	
	/* FUNCIONES DE ADMINISTRADOR */
	
	public static function borraUser($nombreUser){
		$u = DaoUsuario::getDao()->porLogin($nombreUser);
		if ($u!=null){
			DaoUsuario::getDao()->borrar($u);
			return true;
		}else
			return false;
	}
	
	public static function borraUserAdmin($nombreUser){
		$u = DaoUsuarioAdmin::getDao()->porLogin($nombreUser);
		if ($u!=null){
			DaoUsuarioAdmin::getDao()->borrar($u);
			return true;
		}else
			return false;
	}
	
	public static function setRecursos($nombreHeroe,$idMundo,$comida,$madera,$magos,$metal,$piedra,$rubies,$soldados){
		$h = DaoHeroe::getDao()->porNombre($nombreHeroe,$idMundo);
		if ($h==null)
			return false;
		else{
			$recursos = DaoRecursos::getDao()->porIdHeroe($h->id);
			if($comida!=null)
				$recursos[0]->cantidad = $comida;
			if($madera!=null)
				$recursos[1]->cantidad = $madera;
			if($magos!=null)
				$recursos[2]->cantidad = $magos;
			if($metal!=null)
				$recursos[3]->cantidad = $metal;
			if($piedra!=null)
				$recursos[4]->cantidad = $piedra;
			if($rubies!=null)
				$recursos[5]->cantidad = $rubies;
			if($soldados!=null)
				$recursos[6]->cantidad = $soldados;
			DaoRecursos::getDao()->guarda($recursos[0],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($recursos[1],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($recursos[2],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($recursos[3],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($recursos[4],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($recursos[5],"id_heroe","clase");
			DaoRecursos::getDao()->guarda($recursos[6],"id_heroe","clase");
			
			$ahora = date('Y-m-d H:i:s');
			$ahoraUnix = strtotime($ahora);
			$tiempoProduccion = $ahoraUnix - strtotime($h->last);
			$h->last = $ahora ;
			DaoHeroe::getDao()->save($h);
			
			return true;
		}
		
	}
	
	public static function crearMundo($numMax){
		Mundo::crea($numMax);
	}
	
	public static function creaMapa($idMundo){
		Mapa::crea($idMundo);
	}
	
	public static function agregarMisionAMapa($idMapa, $idMision,$posicion, $x, $y){
		$mapa = DaoMapa::getDao()->porId($idMapa);
		$mision = DaoMisiones::getDao()->porId($idMision);
		$mapaMision = DaoMapaMisiones::getDao()->porIdMapaIdMisionPosicion($idMapa, $idMision,$posicion);
		if ($x>20 || $x<0 || $y>20 || $y<0){
			return false;
		}else if ($mapa==null || $mision==null || $mapaMision !=null){
			return false;
		}else {
			MapasMisiones::crea($idMapa, $idMision,$posicion, $x, $y);
			return true;
		}
	}
	
	public static function creaMision($nombre,$desc,$tiempo, $nivel, $poder,$fallo, $jug, $rc, $re, $rma, $rme, $rp, $rb){
		$m = DaoMisiones::getDao()->porNombre($nombre);
		if ($m==null){
			return Misiones::crea ($nombre,$desc,$tiempo, $nivel, $poder,$fallo, $jug, $rc, $re, $rma,$rme, $rp, $rb);;
		} else	
			return -1;
			
	}
	
	public static function getUsuariosConectados(){
		$usuariosConectados = DaoUsuario::getDao()->conectados();
		$usuariosRet = array();
		for ($i=0; $i<count($usuariosConectados); $i++){
			$user = array();
			$user["id"] = $usuariosConectados[$i]->id;
			$user["nombre"] = $usuariosConectados[$i]->nick;
			$usuariosRet[$i] = $user;
		}
		return $usuariosRet;
	}
	
	public static function getUsuariosConectadosNumero(){		
		return count (DaoUsuario::getDao()->conectados());
	}
	
	public static function unLogAdmin($t){
		DaoTokenAdmin::getDao()->borrar($t);
	}
	
	//Flata de tiempo se da por hecho que es el heroe del mundo 1
	public static function getInfoUser($nickUser){
		$user = DaoUsuario::getDao()->porLogin($nickUser);
		if ($user== null){
			return false;
		}
		$userRet = array ("id" => $user->id, "nick" => $user->nick, "estado" => $user->estado);
		$h = DaoHeroe::getDao()->porIdUser($user->id,1);
		$recursos = DaoRecursos::getDao()->porIdHeroe($h->id);
		return array("usuario" =>$userRet, "heroe" =>$h, "recursos"=>$recursos);
	}
	
	public static function cambiarHashSaltAdmin ($t, $nuevaPass){
		$user = DaoUsuarioAdmin::getDao()->porId($t->id);
		$user->salt = Util::aleat(10);
		$user->hash = Util::hash($nuevaPass,$user->salt);
		DaoUsuarioAdmin::getDao()->save($user);
	}
}



