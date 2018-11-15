<?php

class Admins_model extends MY_Model {

	var $fields = array(
		'username',
		'password',
		'nombre',
		'perfil'
	);

	var $table = 'admins';

	 function __construct()
    {
        parent::__construct();
    }

    public function get_user($username,$password=NULL)
	{
		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password,));
		return $query->row_array();
	}

}
