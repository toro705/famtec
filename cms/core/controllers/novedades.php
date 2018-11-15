<?php

Class Novedades extends MY_Controller {

    function __construct(){

        parent::__construct();


	     /////////////////////
	    /// Configuración ///
	   /////////////////////

		$controller_config["script"] = "novedades";


	     //////////////////////////////
	    /// Opciones de las vistas ///
	   //////////////////////////////

        // Nombre del listado
		$controller_config["name"] = "novedades";

		// Ordeno el listado
	    if(! isset($_GET['order'])){
	    	$_GET['order'] = array(
				'fecha' => 'DESC',
			);
	    }

	    $controller_config["paginator_results_per_page"] = 30;

        // Acciones
        $controller_config['actions_list'] = array(
        	'preview'	=>	'/novedad/{id}-vista-previa',
        	'editar'	=>	base_url().$controller_config['script'].'/edit/{id}/',
        	'delete'	=>	'javascript:areYouSurePrompt("'.base_url().$controller_config['script'].'/delete/{id}/");'
        );


	 	 ///////////////////////////////////
	    /// Configuración de los campos ///
	   ///////////////////////////////////

		// Opciones de filtrado
		$controller_config['campos_form'] = array(

			array(
				'key'	=>'activa',
				'label'	=>'Activa',
				'type'	=>'form_checkbox',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-quarter label-up cl-b',
				'properties'=> array(
					'name'    => 'activa',
					'value'   => 1,
					'checked' => 'checked',
				)
			),

			array(
				'key'	=>'fecha',
				'label'	=>'Fecha',
				'type'	=>'date',
				'filter'=>'=',
				'list'	=>true,
				'class'	=>'form-quarter label-up cl-b',
				'properties'=> array(
					'id'   => 'fecha',
					'name' => 'fecha',
				)
			),

			array(
				'key'    =>'foto_destacada_id',
				'label'  =>'Foto destacada',
				'type'   =>'jcropimage',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'form-full label-up cl-b',
				'comentario'  =>'Solo para cuando se agrega como destacada a un newsletter.<br> Medidas: 640px x 120px (ancho x alto)',
				'properties'=> array(
					'id'       => 'foto_destacada_id',
					'name'     => 'foto_destacada_id',
					'quantity' =>1,
					'sizes'    =>array(
						array('width'=>'640','height'=>'210'),
					),
				'siempre_jpg' => true,
				'margenes'    => false,
				'controller'  => $controller_config["script"]
				)
			),

			array(
				'key'    =>'foto_id',
				'label'  =>'Foto',
				'type'   =>'jcropimage',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'form-full label-up cl-b',
				'comentario'  =>'Medida mínima: 654px x 545px (ancho x alto)',
				'properties'=> array(
					'id'       => 'foto_id',
					'name'     => 'foto_id',
					'quantity' =>1,
					'sizes'    =>array(
						array('width'=>'300','height'=>'250'),
						array('width'=>'360','height'=>'300'),
						array('width'=>'654','height'=>'545'),
					),
				'siempre_jpg' => true,
				'margenes'    => false,
				'controller'  => $controller_config["script"]
				)
			),

			array(
				'key'     =>'titulo',
				'label'   =>'Título',
				'type'    =>'form_input',
				'filter'  =>null,
				'list'    =>true,
				'idiomas' => true,
				'class'   =>'form-half label-up',
				'properties'=> array(
					'name'      => 'titulo',
					'maxlenght' => 100,
				)
			),


			array(
				'key'     =>'bajada',
				'label'   =>'Bajada',
				'type'    =>'form_textarea',
				'filter'  =>null,
				'list'    =>false,
				'idiomas' => true,
				'class'   =>'form-half label-up',
				'properties'=> array(
					'name'      => 'bajada',
					'maxlenght' => 255,
					'rows' => 5
				)
			),

			array(
				'key'     =>'cuerpo',
				'label'   =>'Cuerpo',
				'type'    =>'form_textarea',
				'filter'  =>null,
				'list'    =>false,
				'idiomas' => true,
				'class'   =>'form-full label-up cl-b',
				'properties'=> array(
					'name'  => 'cuerpo',
					'class' => 'tinymce-novedad',
					'row' => 15
				)
			),

		);

        $this->cargar_config( $controller_config );
    }
}
