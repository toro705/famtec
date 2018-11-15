<?php

Class Logos extends MY_Controller {

    function __construct(){

        parent::__construct();


	     /////////////////////
	    /// Configuración ///
	   /////////////////////

		$controller_config["script"] = "logos";


	     //////////////////////////////
	    /// Opciones de las vistas ///
	   //////////////////////////////

        // Nombre del listado
		$controller_config["name"] = ($this->input->get('categ')=='libreria') ? 'librerías' : 'editoriales';

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
				'key'     =>'empresa',
				'label'   =>'Empresa',
				'type'    =>'form_input',
				'filter'  =>null,
				'list'    =>true,
				'class'   =>'form-third label-up cl-b',
				'properties'=> array(
					'name'      => 'empresa',
					'maxlenght' => 100,
				)
			),

			array(
				'key'    =>'foto_id',
				'label'  =>'Foto',
				'type'   =>'jcropimage',
				'filter' =>null,
				'list'   =>true,
				'class'  =>'form-full label-up cl-b',
				'comentario'  =>'Tamaño: 242px x 130px',
				'properties'=> array(
					'id'       => 'foto_id',
					'name'     => 'foto_id',
					'quantity' =>1,
					'sizes'    =>array(
						array('width'=>'242','height'=>'130'),
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
