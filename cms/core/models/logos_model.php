<?php

class Logos_model extends MY_Model {

	var $fields = array(
		'empresa',
		'categ',
		'foto_id',
		'orden'
	);

	var $table = 'logos';

	function __construct(){
        parent::__construct();
    }

}
