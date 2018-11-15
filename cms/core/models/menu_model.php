<?php

class menu_model extends MY_Model {

	var $fields = array(
		'nombre',
		'perfil',
		'controlador',
		'tipo',
		'listar',
		'categoria',
		'orden'
	);

	var $table = 'menu';

	 function __construct()
    {
        parent::__construct();
    }

}
