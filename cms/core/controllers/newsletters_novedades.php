<?php

class Newsletters_novedades extends MY_Controller {

	var $controller_config;

    function __construct(){

        parent::__construct();


	     ///////////////////////////
	    ////// Configuración //////
	   ///////////////////////////

        $controller_config["script"] 	= "newsletters_novedades";
        $controller_config["model"] 	= $controller_config["script"]."_model";

        $controller_config['parents'] = array(
        	'newsletters' => array(
				'foreign_key'=>'newsletter_id',
				'parent_model'=>'newsletters_model'
			)
        );

	     ////////////////////////////////////
	    ////// Opciones de las vistas //////
	   ////////////////////////////////////

        //Nombre del listado
		$controller_config["name"] = "";

		 // Ordeno el listado
	    if(! isset($_GET['order'])){
	    	$_GET['order'] = array(
				'orden'   => 'ASC',
				'id'      => 'DESC',
			);
	    }

		 // Drag & drop
        $controller_config["ordenar"] = true;
        $controller_config["paginator_results_per_page"] 	= 9999999;

        //Acciones
        $controller_config['actions_list'] = array(
        	'editar'	=>	base_url().$controller_config['script'].'/edit/{id}/{uriParameters}',

			//'preview'	=>	base_url().'../nuevo/emprendimiento/{id}/vista-previa/',

        	'delete'	=>	'javascript:areYouSurePrompt(\''.base_url().$controller_config['script'].'/delete/{id}/{uriParameters}\');'
        );


	 	 /////////////////////////////////////////
	    ////// Configuración de los campos //////
	   /////////////////////////////////////////

		// Opciones de filtrado
		 $controller_config['campos_form'] = array(
		 	
		 	array(
				'key'	=>'destacada',
				'label'	=>'Destacada',
				'type'	=>'form_checkbox',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-quarter label-up cl-b',
				'properties'=> array(
					'name'    => 'destacada',
					'value'   => 1,
				)
			),

			array(
				'key'=>'novedad_id',
				'label'=>'Novedad',
				'type'	=>'form_dropdown',
				'filter'=>false,
				'list'=>true,
				'class'	=>'form-half label-up cl-b',
				'comentario'=>'Se puede cargar hasta 7 novedades.',
				'properties'=> array(
					'name'  => 'novedad_id',
					'options' => array(""=>"Elija una novedad") + $this->getOptions('novedades_model','titulo_es')
				)
			),
		);

        $this->controller_config = $controller_config;
    }
}
