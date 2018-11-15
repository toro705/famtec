<?php

Class Suscriptores extends MY_Controller {

    function __construct(){

        parent::__construct();


	     /////////////////////
	    /// Configuración ///
	   /////////////////////

        $controller_config["script"] 	= "suscriptores";


	     //////////////////////////////
	    /// Opciones de las vistas ///
	   //////////////////////////////

        // Nombre del listado
        $controller_config["name"] = "suscriptores";

        // Botones
        $controller_config["add_button"] = false;
        $controller_config["csv_btn"] 	 = true;

        // Acciones
        $controller_config['actions_list'] = array(
        	//'editar'	=>	base_url().$controller_config['script'].'/edit/{id}/{uriParameters}',
        	'delete'	=>	'javascript:areYouSurePrompt(\''.base_url().$controller_config['script'].'/delete/{id}/{uriParameters}\');'
        );


	 	 ///////////////////////////////////
	    /// Configuración de los campos ///
	   ///////////////////////////////////

		// Opciones de filtrado
		$controller_config["campos_form"] = array(

			array(
				'key'	=>'nombre',
				'label'	=>'Nombre',
				'type'	=>'form_input',
				'filter'=> true,
				'list'	=> true,
				'export'=> true,
				'class'	=>'form-third label-up',
				'properties'=> array(
					'name'         => 'nombre',
					'id'           => 'nombre',
					'maxlength'    => '255'
				)
			),

			array(
				'key'	=>'email',
				'label'	=>'Email',
				'type'	=>'form_input',
				'filter'=> true,
				'list'	=> true,
				'export'=> true,
				'class'	=>'form-third label-up',
				'properties'=> array(
					'name'         => 'email',
					'id'           => 'email',
					'maxlength'    => '255'
				)
			),

			array(
				'key'	=>'fecha',
				'label'	=>'fecha',
				'type'	=>'date',
				'filter'=> '>=',
				'list'	=> true,
				'class'	=>'form-third label-up',
				'properties'=> array(
					'name'         => 'fecha',
					'id'           => 'fecha',
				)
			),

		);

        $this->cargar_config( $controller_config );
    }
}
