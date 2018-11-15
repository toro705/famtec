<?php

class Novedades_model extends MY_Model {

	var $fields = array(
		'activa',
		'fecha',
		'titulo_es',
		'titulo_en',
		'bajada_es',
		'bajada_en',
		'cuerpo_es',
		'cuerpo_en',
		'foto_id',
		'foto_destacada_id',
		'orden'
	);

	var $table = 'novedades';

	function __construct(){
        parent::__construct();
    }

}
