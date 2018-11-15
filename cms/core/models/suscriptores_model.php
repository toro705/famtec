<?php

class Suscriptores_model extends MY_Model {

	var $fields = array(
		'nombre',
		'email',
		'fecha',
		'orden'
	);

	var $table = 'contactos';

	 function __construct()
    {
        parent::__construct();
    }

}
