<?php

Class newsletters extends MY_Controller {

    function __construct(){

        parent::__construct();


	     /////////////////////
	    /// Configuración ///
	   /////////////////////

		$controller_config["script"] = "newsletters";


	     //////////////////////////////
	    /// Opciones de las vistas ///
	   //////////////////////////////

        // Nombre del listado
		$controller_config["name"] = "newsletters";

	    $controller_config["paginator_results_per_page"] = 30;

        // Acciones
        $controller_config['actions_list'] = array(
        	'editar'	=>	base_url().$controller_config['script'].'/edit/{id}/{uriParameters}',

			//'copiar'	=>	'javascript:copiarHTML(\''.base_url().'../newsletter/novedades/{id}/\', false)',

			'preview'	=>	base_url().'../newsletter/novedades/{id}/?envio',

        	'delete'	=>	'javascript:areYouSurePrompt(\''.base_url().$controller_config['script'].'/delete/{id}/{uriParameters}\');'
        );

        // Ordeno el listado
	    if(! isset($_GET['order'])){
	    	$_GET['order'] = array(
				'fecha' => 'DESC',
				'id' => 'DESC',
			);
	    }


	 	 ///////////////////////////////////
	    /// Configuración de los campos ///
	   ///////////////////////////////////

		// Opciones de filtrado
		$controller_config['campos_form'] = array(

			array(
				'key'	=>'fecha',
				'label'	=>'Fecha',
				'type'	=>'date',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-quarter label-up cl-b',
				'properties'=> array(
					'name'         => 'fecha',
					'id'           => 'fecha',
				)
			),

			array(
				'key'	=>'titulo',
				'label'	=>'Título',
				'type'	=>'form_input',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-half label-up cl-b',
				'properties'=> array(
					'name'         => 'titulo',
					'id'           => 'titulo',
					'maxlength'    => '255'
				)
			),
			
          	array(
				'key'=>'newsletters_novedades_id',
				'label'=>'',
                'type'=>'child_relation_iframe',
                'filter'=>null,
                'titulo' => 'Novedades',
                'properties'=> array(
                  'child_controller'=>'newsletters_novedades',
                  'child_model'=>'newsletters_novedades_model',
                  'foreign_key'=>'newsletter_id'
                )
            ),

		);

        $this->cargar_config( $controller_config );
    }
}
