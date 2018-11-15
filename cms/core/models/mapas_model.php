<?php

class Mapas_model extends MY_Model {

	var $fields = array('activo', 'lat', 'lng', 'streetview', 'busqueda');

	var $table = 'mapas';

	 function __construct()
    {
        parent::__construct();
    }

}
