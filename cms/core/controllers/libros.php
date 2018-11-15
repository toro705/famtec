<?php

Class Libros extends MY_Controller {

    function __construct(){

        parent::__construct();


	     /////////////////////
	    /// Configuración ///
	   /////////////////////

		$controller_config["script"] = "libros";


	     //////////////////////////////
	    /// Opciones de las vistas ///
	   //////////////////////////////

        // Nombre del listado
		$controller_config["name"] = 'libros';

	     // Drag & drop
        $controller_config["ordenar"] = true;
	    $controller_config["paginator_results_per_page"] = 99999;

        // Acciones
        $controller_config['actions_list'] = array(
        	'editar'	=>	base_url().$controller_config['script'].'/edit/{id}/',
        	'delete'	=>	'javascript:areYouSurePrompt("'.base_url().$controller_config['script'].'/delete/{id}/");'
        );


	 	 ///////////////////////////////////
	    /// Configuración de los campos ///
	   ///////////////////////////////////

		// Opciones de filtrado
		$controller_config['campos_form'] = array(

			array(
				'key'     =>'nombre',
				'label'   =>'Nombre',
				'type'    =>'form_input',
				'filter'  =>null,
				'list'    =>true,
				'class'   =>'form-third label-up cl-b',
				'properties'=> array(
					'name'      => 'nombre',
					'maxlenght' => 100,
				)
			),

			array(
				'key'     =>'url',
				'label'   =>'URL',
				'type'    =>'form_input',
				'filter'  =>null,
				'list'    =>false,
				'class'   =>'form-third label-up cl-b',
				'properties'=> array(
					'name'      => 'url',
					'maxlenght' => 255,
				)
			),

			array(
				'key'    =>'foto_id',
				'label'  =>'Foto',
				'type'   =>'jcropimage',
				'filter' =>null,
				'list'   =>true,
				'class'  =>'form-full label-up cl-b',
				'properties'=> array(
					'id'       => 'foto_id',
					'name'     => 'foto_id',
					'quantity' =>1,
					'sizes'    =>array(
						array('width'=>'98','height'=>'138'),
					),
				'siempre_jpg' => true,
				'margenes'    => false,
				'controller'  => $controller_config["script"]
				)
			),


		);

        $this->cargar_config( $controller_config );
    }
}
