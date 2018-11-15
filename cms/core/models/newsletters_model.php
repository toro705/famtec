<?php

class Newsletters_model extends MY_Model {

	var $fields = array(
		'titulo',
		'fecha',
		'orden'
	);

	var $table = 'newsletters';

	function __construct(){
        parent::__construct();
    }

}
