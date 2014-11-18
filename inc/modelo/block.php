<?php

	require_once 'dao_block.php';

class Block{
	public $id;
	public $id_blokeador;
	public $id_blokeado;
	
	public static function crea ($id_blokeador, $id_blokeado){		
			$h = new Block();
			$h->id=0;
			$h->id_blokeador = $id_blokeador;
			$h->id_blokeado = $id_blokeado;
            DaoBlock::getDao()->save($h);
        	return $h;
	}

}