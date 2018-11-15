<?php

class Libros_model extends MY_Model {

	var $fields = array(
		'nombre',
		'url',
		'foto_id',
		'orden'
	);

	var $table = 'libros';

	function __construct(){
        parent::__construct();
    }

}
