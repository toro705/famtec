<?php

Class Plantilla extends MY_Controller {

    function __construct(){

        parent::__construct();

	     /////////////////////
	    /// Configuración ///
	   /////////////////////

        $controller_config["script"] = "plantilla";

        // Opcionales
        $controller_config["model"]  = $controller_config["script"]."_model";

        // Solo para los controladores que se ven en un iframe o popup
        /*$controller_config['parents'] = array(
        	'muestras' => array(
				'foreign_key'=>'muestra_id',
				'parent_model'=>'muestras_model'
			)
        );*/


	     //////////////////////////////
	    /// Opciones de las vistas ///
	   //////////////////////////////


        //Nombre del listado
        $controller_config["name"] = "plantillas";

        // Opcionales
        $controller_config["label_add"] = "Agregar";
        $controller_config["add_button"] = true;
        $controller_config["paginator_results_per_page"] = 9999999;

        // Drag & drop
        $controller_config["ordenar"] = false;

        // URL de retorno
        $controller_config["return_url"] = base_url().'precios_invernada';

        // Vistas personalizadas
        // $this->vistas['add']  = 'campana_form';
        // $this->vistas['edit'] = 'campana_form';
        // $this->vistas['list'] = 'campana_list';

        // Ordeno el listado
	    /*if(! isset($_GET['order'])){
	    	$_GET['order'] = array(
				'pais' => 'ASC',
				'localidad' => 'ASC',
				'nombre' => 'ASC',
			);
	    }*/

	    // Filtro el listado
        /*if(! isset($_GET['pais'])){
        	$_GET['pais'] = '3';
        }*/

        //Acciones
        $controller_config['actions_list'] = array(

			'editar'    =>	base_url().$controller_config['script'].'/edit/{id}/{uriParameters}',
			//'clonar'  =>	base_url().$controller_config['script'].'/clonar_inmueble/{id}',
			//'preview' =>	base_url().'../nuevo/emprendimiento/{id}/vista-previa/',
			//'ficha'   =>	base_url().'newsletter/generar_ficha/?prop1={id}{uriParameters}',
			'delete'    =>	'javascript:areYouSurePrompt(\''.base_url().$controller_config['script'].'/delete/{id}/{uriParameters}\');'
        );


	 	 ///////////////////////////////////
	    /// Configuración de los campos ///
	   ///////////////////////////////////

		$controller_config["campos_form"] = array(

			/* Input text */
			array(
				'key'	=>'titulo',
				'label'	=>'Titulo',
				'type'	=>'form_input',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-third label-up',
				'properties'=> array(
					'name'         => 'titulo',
					'maxlength'    => '255',
					'filtros'=> array('nombre-del-filtro' => 'valor-del-filtro'),
				)
			),

			/* Textarea común */
			array(
				'key'	=>'descripcion',
				'label'	=>'Descripción',
				'type'	=>'form_textarea',
				'filter'=>null,
				'list'	=>false,
				'class'	=>'form-half clear label-up',
				'properties'=> array(
					'name'  => 'descripcion',
					'id'    => 'descripcion'
				)
			),

			/* Checkbox */
			array(
				'key'	=>'activo',
				'label'	=>'Activo',
				'type'	=>'form_checkbox',
				'filter'=>false,
				'list'	=>true,
				'class'	=>'form-half clear label-up',
				'properties'=> array(
					'name'     => 'activo',
					'id'       => 'activo',
					'value'    => '1',
					'checked'    => 'checked',
				)
			),

			/* Imagen simple (se recorta/redimensiona automáticamente) */
			array(
				'key'    =>'foto',
				'label'  =>'Portada',
				'type'   =>'images',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'form-third label-up',
				'comentario' => '<a href="'.base_url().'../archivos/categorias_portada.psd" target="_blank">Descargar el PSD base.</a>',
				'properties'=> array(
					'id'       => 'foto',
					'name'     => 'foto',
					'quantity' =>1,
					'sizes'    =>array(
						array('width'=>'650','height'=>'200','master_dim'=>'width', 'method'=>'resize'),
					),
				'controller' => $controller_config["script"]
				)
			),

			/* Imagen con control para recortar */
			array(
				'key'    =>'foto',
				'label'  =>'Foto',
				'type'   =>'jcropimage',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'form-third label-up',
				'properties'=> array(
					'id'       => 'foto',
					'name'     => 'foto',
					'quantity' =>1,
					'sizes'    =>array(
						array('width'=>'50','height'=>'35', 'method'=>'crop'),
						array('width'=>'100','height'=>'70', 'method'=>'crop'),
					),
				'siempre_jpg' => true,
				'margenes'    => false,
				'controller'  => $controller_config["script"]
				)
			),

			/* Input select con opciones estáticas */
			array(
				'key'	=>'autor2_id',
				'label'	=>'Autor 2',
				'type'	=>'form_dropdown',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-full label-up',
				'properties'=> array(
					'name'    => 'autor2_id',
					'es_filtro' => false,
					'options' => array(
						"" => "Elija una opción",
						1 => "Opción 1",
						2 => "Opción 2",
						3 => "Opción 3",
					)
				)
			),

			/* Input select con opciones dinámicas */
			array(
				'key'	=>'autor2_id',
				'label'	=>'Autor 2',
				'type'	=>'form_dropdown',
				'filter'=>null,
				'list'	=>true,
				'class'	=>'form-full label-up',
				'properties'=> array(
					'name'       => 'autor2_id',
					'es_filtro' => false,
					'options'    => array(""=>"Elija un autor") + $this->getOptions('miembros_model','nombre')
				)
			),

			/* Input select AJAX con opciones dinámicas */
			array(
				'key'    =>'localidades_id',
				'label'  =>'Localidad',
				'type'   =>'form_dropdown_ajax',
				'filter' =>true,
				'list'   =>true,
				'class'  =>'form-full label-up',
				'properties'=> array(
					'es_filtro' => false,
					'name'      => 'localidades_id',
					'id'        => 'localidades_id',
					'child_model'			=> 'localidades',
					'child_describe_field'	=> 'nombre',
					'child_foreign_key'		=> 'departamento_id',
					'parent_select_id'		=> 'departamentos_id',
					'options' => array( ""=>"Elija una localidad:") + $this->getOptions('localidades_model','nombre')
				)
			),

			/* Input select multiple (simple) */
			array(
				'key'    =>'clientes_id',
				'label'  =>'Clientes',
				'type'   =>'form_multiselect_simple',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'form-third label-up',
				'comentario' => 'Para seleccionar varios filtros mantené apretada la tecla Ctrl o Command.',
				'properties'=> array(
					'name'    => 'clientes_id',
					'options' =>  $this->getOptions('clientes_model','nombre')
				)
			),

			/* Input select múltiple (simple) con AJAX */
			array(
				'key'    =>'tipos',
				'label'  =>'Filtros',
				'type'   =>'form_multiselect_simple_ajax',
				'filter' =>null,
				'list'   =>false,
				'hidden' =>false,
				'class'  =>'form-third label-up',
				'comentario' => 'Para seleccionar varios filtros mantené apretada la tecla Ctrl o Command.',
				'properties'=> array(
					'name'      	=> 'tipos',
					'id'        	=> 'tipos',
					'child_model'			=> 'tipos',
					'child_describe_field'	=> 'nombre',
					'child_foreign_key'		=> 'categoria_id',
					'parent_select_id'		=> 'categoria_id',
					'local_key'				=> 'producto_id',
					'local_model'			=>  $controller_config['script'],
					'options'				=>  $this->getOptions('tipos_model','nombre')
				)
			),

			/* Input file */
			array(
				'key'    =>'pdf',
				'label'  =>'PDF',
				'type'   =>'form_upload',
				'filter' =>null,
				'class'  =>'form-half clear label-up',
				'properties'=> array(
					'name'          => 'pdf',
					'allowed_types' => 'pdf|doc|docx',
					'max_size'      => 2080,
				)
			),

			/* Galería */
			array(
				'key'    =>'galeria',
				'label'  =>'',
				'type'   =>'gallery',
				'filter' =>null,
				'list'   =>false,
				'hidden' =>false,
				'titulo' => 'Galería',
				'comentario' => 'Las fotos deben tener al menos 800px de ancho y alto para verse bien. <br />Podés reordenar las fotos
					 agarrandolas y arrastrandolas.',
				'properties'=> array(
					'name'  => 'galeria',
					'sizes' =>array(
						array('width' =>1200,'height'=>1200, 'method'=>'crop'),
						array('width' =>800,'height'=>800, 'method'=>'crop'),
						array('width' =>235,'height'=>235, 'method'=>'crop'),
						array('width' =>110,'height'=>110, 'method'=>'crop')
					),
					'marca_de_agua' => 'marca_de_agua',
					'controller'    => $controller_config['script']
				)
			),

			/* Selector de fecha y hora */
			array(
				'key'    =>'fecha',
				'label'  =>'Fecha',
				'type'   =>'datetime',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'label-up clear',
				'hidden' =>false,
				'properties'=> array(
						'name' => 'fecha',
						'id'   => 'fecha',
					  // http://api.jqueryui.com/datepicker/
					  'opciones' => array(
					  	'constrainInput' => true
					  )
					)
			),

			/* Selector de fecha*/
			array(
				'key'    =>'fecha',
				'label'  =>'Fecha',
				'type'   =>'date',
				'filter' =>null,
				'list'   =>false,
				'class'  =>'form-quarter label-up cl-b',
				'hidden' =>false,
				'properties'=> array(
						'name' => 'fecha',
						'id'   => 'fecha',
						// http://api.jqueryui.com/datepicker/
					  'opciones' => array(
					  	'constrainInput' => true
					  )
					)
			),

			/* Elemento hijo en iframe */
			array(
				'key'    =>'combinaciones_colores',
				'label'  =>'',
				'type'   =>'child_relation_iframe',
				'filter' =>null,
				'titulo' => 'Combinaciones de colores',
				'properties' => array(
					'child_controller' =>'colores_combinaciones',
					'child_model'      =>'colores_combinaciones_model',
					'foreign_key'      =>'producto_id'
                )
            ),

            // Mapa

			array(
				'key'    =>'mapa_id',
				'label'  =>'',
				'type'   =>'mapa',
				'titulo' => 'Mapa',
				'comentario' => '',
				'properties'=> array(
					'name'   => 'mapa_id',
					'activo' => true,
					'lat'    => false,
					'lng'    => false,
					'opciones' => array(
						//'streetview' => false
					),
					'controller' => $controller_config['script'],
					'filtros' => array('operacion' => 'venta'),
				)
			),

		);

        $this->cargar_config( $controller_config );
    }
}


  /////////////////////////////////////////
 ///////////////  TRUCOS  ////////////////
/////////////////////////////////////////

/* Dividir un controlador en categorías

 Para mostrar el contenido de un mismo controlador en varias pestañas
 discriminado los ítems según un categoría seguí estos pasos:

   1 - En el menú agregá las pestañas y definile una categoría a cada una
   2 - Agregá el campo categ en el modelo y en la base de datos.
   3 - ¡Listo! ¿simple, no?

*/

/* Mostrar 1 solo ítem en una pestaña

 Para acceder desde una pestaña a la pantalla de edición de un ítem en particular
 en vez de mostrar un listado de ítems:

 Andá a la pestaña menú y en el campo "listar" del controlador que quieras modificar
 poné el ID del único ítem que querés que se pueda cer y editar.

*/

/* Traducir los campos

 Solo agregá la opción "idiomas" => true y el campo se va a cargar en todos los
 idiomas que estén definidos en MY_Controler.php. El primer idioma va a ser el
 idioma por defecto.

 Los campos que estén en varios idiomas va a haber que agregarlos con el formato
 $campo.'_'.$codigo_idioma en el modelo y en la base de datos.

 Ej: nombre_es, nombre_en

*/