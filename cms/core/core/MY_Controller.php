<?php

class MY_Controller extends CI_Controller {

    var $controller_config = array();

    var $campos_export = '';
    var $export_fields = array();
    var $special_fields = array('gallery','form_multiselect','images','images_jcrop','validate_password','child_relation');

    public static $idiomas = array(
        'es' => 'Español',
        'en' => 'Inglés',
    );

    function __construct(){

        parent::__construct();

        $this->vistas = array(
            'add'  => 'form',
            'edit' => 'form',
            'list' => 'lista'
        );

    }

    function index() {

        $popup = (isset($_GET["isPopup"]) && $_GET["isPopup"]=="true") ? true : false;

        $header_data = $this->_generar_data('cabecera');
        $menu_data   = $this->_generar_data('menu');
        $lista_data  = $this->_generar_data('lista');

        $this->load_list_view( $header_data, $menu_data, $lista_data, $popup);

    }

    function load_list_view($header_data,$menu_data,$lista_data=null,$popup=false){

        if( !$this->input->get('modo')=='simple' ){
            if(!$popup){
                $this->load_header_only_view( $header_data );
                $this->load_menu_only_view( $menu_data );
            }else{
                $this->load->view('includes/header_popup',$header_data);
            }

            $this->load_list_only_view( $lista_data );

            if(!$popup){
                $this->load->view('includes/footer');
            }else{
                $this->load->view('includes/footer_popup');
            }
        }else{
            $this->load->view('includes/head', $header_data);
            $this->load_list_only_view( $lista_data );
        }

    }


    function load_simple_list_view($data){

        $this->load->view('includes/head', $data['header']);

        $this->load_list_only_view();

        $this->load->view('includes/footer_popup');


    }

    function load_header_only_view($header_data = null){

        if( is_null($header_data) ){
             $header_data = $this->_generar_data('cabecera');
        }

        $this->load->view('includes/header',$header_data);

    }

    function load_menu_only_view($head_data = null, $menu_data = null){

        if( is_null($menu_data) ){
            $menu_data = $this->_generar_data('menu');
        }

        $this->load->view('menu',$menu_data);

    }

    function load_list_only_view($lista_data = null){

        if( is_null($lista_data) ){
            $lista_data = $this->_generar_data('lista');
        }

        $this->load->view(  $this->vistas['list'], $lista_data );

    }

    function _generar_data( $vista ){

        $data = array();
        switch( $vista){

            case 'cabecera' : {

                //URL de retorno
                if(isset($this->controller_config["return_url"]) AND $this->controller_config["return_url"]!=''){
                    $return_url = $this->controller_config["return_url"];
                }else{

                    $return_url = base_url().$this->router->fetch_class();
                }

                $data = array(
                    'nombre' => $this->session->userdata('nombre'),
                    'uriParameters' => $this->_get_uriParameters(),
                    'return_url' => $return_url
                );
                break;
            }

            case 'menu' : {
                $this->load->model('menu_model');

                $solapas = $this->menu_model->get_query_list( null, array('orden') );
                $data = array(
                    'current_script' => $this->controller_config["script"],
                    'menu' => $solapas,
                    'uriParameters' => $this->_get_uriParameters()
                );
                break;
            }

            case 'lista' : {

                $model = $this->controller_config["model"];

                // Obtengo los filtros
                $filters = $this->getFilters();

                // Si es un controlador hijo también filtramos por el padre
                if( isset($this->controller_config['parents']) AND is_array($this->controller_config['parents'])){

                    $parent_controller  = $this->input->get('parent_controller');
                    $parent_id          = $this->input->get('parent_id');
                    $foreign_key        = $this->controller_config['parents'][$parent_controller]['foreign_key'];

                   $filters[] = ' AND '.$this->getRelationFilters($foreign_key,$parent_id);
                }

                // Le aplico el orden
                $orders = $this->getOrders();

                //Preparo la paginación
                $paginator = array();
                $paginator['pagination'] = (isset($this->controller_config['paginator_results_per_page'])) ? $this->controller_config['paginator_results_per_page'] : 9999999;

                $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
                if (!is_numeric($currentPage)){
                    $paginator['startrow'] = 0;
                    $currentPage = 1;
                } else {
                    $currentPage = (int)$currentPage;
                    $paginator['startrow'] = $currentPage*$paginator['pagination']-$paginator['pagination'];
                }


                $numrows = count( $this->$model->get_query_list( $filters, $orders) );
                $pages = ceil($numrows/$paginator['pagination']);

                // Genero la consulta a la base de datos
                $items = $this->$model->get_query_list( $filters, $orders, $paginator);

                // Genero el objeto DQL basico para exportar
                $itemsExport = $this->$model->get_query_list( $filters, $orders, $this->campos_export );

                //Obtengo el orden en que se listan los items
                $orden = array();
                foreach($items AS $item){
                    $orden[] = $item->id;
                }

                $data = array(
                    'campos_form'   => $this->controller_config["campos_form"],
                    'controller'    => $this->router->class,
                    'actions'       => $this->controller_config["actions_list"],
                    'paginator'     => $this->get_pages( $currentPage, $pages, $paginator['pagination'] ),
                    'name' => $this->controller_config["name"],
                    'items' => $items,
                    'add_button'        => isset($this->controller_config["add_button"]) ? $this->controller_config["add_button"] : true,
                    'csv_btn'           => isset($this->controller_config["csv_btn"])    ? $this->controller_config["csv_btn"]    : false,
                    'add_button_label' => (isset($this->controller_config["label_add"])) ? $this->controller_config["label_add"] : 'Agregar' ,
                    'sql_serialized' =>  base64_encode(serialize($this->$model->sql_query_list($filters,$orders))),
                    'uriParameters' => $this->_get_uriParameters(),
                    'ordenar' => isset($this->controller_config["ordenar"]) ? $this->controller_config["ordenar"] : false,
                    'orden' => $orden,
                    'orden_inicio' => ($currentPage - 1) * $paginator['pagination']
                );
                break;
            }

            case 'add' :{
                $tmp_id = -rand(1,10000);
                $data = array(
                    'current_script' => $this->controller_config["script"],
                    'title' => (isset($this->controller_config["label_add"])) ? $this->controller_config["label_add"] : 'Agregar' ,
                    'form_action' => $this->router->class.'/save/',
                    'campos' =>  $this->prepare_add_fields($tmp_id,$this->controller_config["campos_form"]),
                    'tmp_id' => $tmp_id,
                    'uriParameters' => $this->_get_uriParameters()
                );
                break;
            }

            case 'edit' :{

                $id = $this->uri->segment(3, $this->input->get('id') );
                $data = array(
                    'campos' =>  $this->prepare_edit_fields($id,$this->controller_config["campos_form"]),
                    'current_script' => $this->controller_config["script"],
                    'title' => (isset($this->controller_config["label_edit"])) ? $this->controller_config["label_edit"] : 'Editar',
                    'form_action' =>  $this->router->class.'/save/'.$id.'/',
                    'id' => $id,
                    'uriParameters' => $this->_get_uriParameters()
                );
                break;
            }
        }

        return $data;

    }

    function get_pages($actual, $cantidad_paginas, $pagination){

        //No muestro el paginador si solo hay una página
        if( $cantidad_paginas<=1 ){
            return '';
        }

        unset($_GET['c']);

		$html_paginador = "";
		for ($pagina=1; $pagina<=$cantidad_paginas; $pagina++){

            $_GET['page'] = $pagina;
            $url = base_url().$this->router->class.'/?'.http_build_query($_GET);

            $html_paginador .= '<a '.( $pagina==$actual ? 'class="actual"' : 'href="'.$url.'"').'>';
            $html_paginador .= $pagina;
            $html_paginador .= '</a>&nbsp;';
		}

		/* Return the names */
		return $html_paginador;

	}


    function get_fields($fieldsArray){

		$fields = array();

        foreach($fieldsArray as $field){
            $fields[] = $this->controller_config["model"].".".$field['key'];
        }

        return implode(',',$fields);

    }

    function getRelationFilters($foreign_key,$parent_id){
		return $foreign_key." = ".$parent_id;
	}

	function getOrders(){

        $orders = $this->input->get('order');

        // Agrego orden por defecto
		$o_aux = array(
            'orden' => 'orden ASC',
            'id'    => 'id DESC',
            );

        // Agrego nuevos criterios de orden y sobreeescribo los por defecto
        // Y me aseguro que los criterios nuevos estén primeros
        if(is_array($orders)){
            $o = array();
			foreach($orders as $key=>$orden){
                if(array_key_exists($key, $o_aux)){
				    $o_aux[$key] = $key." ".$orden;

                }else{
                    $o[$key] = $key." ".$orden;
                }
			}
            $o = array_merge($o, $o_aux);

		}else{
            $o = $o_aux;
        }

		return $o;

	}

    function getFilters(){

		$filters = array();

        // Si el controlador está dividido en categorías filtro por esa categoría
        if($this->input->get('categ')){
            $filters[] = " AND categ = '".$this->input->get('categ')."'";
        }

		foreach($this->controller_config["campos_form"] as $key=>$field){

				// Si no esta activado el filter para este campo continuo
                if(!isset($field['filter']) OR $field['filter']==false OR !$this->input->get($field['key'])){
                    continue;
                }

                switch($field['type']){

                    case 'datetime':
                        if($field['filter']=='like' and is_array($this->input->get($field['key']))){

                            $datedata = $this->input->get($field['key']);

                            if($datedata[0] < 32 && $datedata[0] > 0){
                                $filters[] = " AND DAY(".$field['key'].") = ".$datedata[0]."";
                            }

                            if($datedata[1] < 13 && $datedata[1] > 0){
                                $filters[] = " AND MONTH(".$field['key'].") = ".$datedata[1]."";
                            }

                            if($datedata[2] != ""){
                                $filters[] = " AND YEAR(".$field['key'].") = ".$datedata[2]."";
                            }

                        }

                    case 'date':
                        if($field['filter']=='like' and is_array($this->input->get($field['key']))){

                            $datedata = $this->input->get($field['key']);

                            if($datedata[0] < 32 && $datedata[0] > 0){
                                $filters[] = " AND DAY(".$field['key'].") = ".$datedata[0]."";
                            }

                            if($datedata[1] < 13 && $datedata[1] > 0){
                                $filters[] = " AND MONTH(".$field['key'].") = ".$datedata[1]."";
                            }

                            if($datedata[2] != ""){
                                $filters[] = " AND YEAR(".$field['key'].") = ".$datedata[2]."";
                            }

                        }elseif(in_array($field['filter'], array('>','<','>=','<=','=')) and !is_array($this->input->get($field['key']))){

                            $date = date('Y-m-d', strtotime($this->input->get($field['key'])));
                            $filters[] = " AND ".$field['key']." ".$field['filter']." '".$date."'";
                        }
                        break;

                    default:
                        if($field['filter']=='like' and $this->input->get($field['key'])!=""){

                            $filters[] = " AND ".$field['key']." LIKE '%".$this->input->get($field['key'])."%'";

                        }elseif($field['filter']=='match' and $this->input->get($field['key'])!=""){
                            $filters[] = " AND ".$field['key']." = '".$this->input->get($field['key'])."'";
                        }
                        break;
                }


            }

            return $filters;

    }

    function _get_uriParameters(){

        //Estos son los parámetors que quiero mantener siempre
        $parameters = array(
            'isPopup',
            'parent_id',
            'parent_controller',
            'modo',
            'categ'
        );

        //Chequeo si están definidos
        $uriParameters = array();
        foreach($parameters AS $param){

            if( isset($_GET[$param]) AND $_GET[$param]!='' ){

                if($param=='isPopup'){

                    if( $_GET['isPopup']!='true' ){
                        continue;
                    }

                }elseif( $param=='modo' ){

                    if( isset($_GET['isPopup']) AND $_GET['isPopup']=='true' ){
                        $_GET['modo'] = 'popup';
                    }

                }

                $uriParameters[$param] = $_GET[$param];
            }
        }

        //Los convierto en una cadena de texto
        $uriParameters = http_build_query($uriParameters);

        return $uriParameters!='' ? '?'.$uriParameters : '';
    }

    function add(){

        $popup = (isset($_GET["isPopup"]) && $_GET["isPopup"]=="true") ? true : false;

        $data = $data = array(
            'header' => $this->_generar_data( 'cabecera' ),
            'menu' => $this->_generar_data( 'menu' ),
            'add' => $this->_generar_data( 'add' )
        );
        $this->load_add_view($data,$popup);

    }

    function load_add_view($data,$popup=false){

        if( ! $this->input->get('modo')=='simple' ){
            if(!$popup){
                $this->load->view('includes/header',$data['header']);
                $this->load->view('menu',$data['menu']);
            }else{
                $this->load->view('includes/header_popup',$data['header']);
            }

            $this->load->view(  $this->vistas['edit'], $data['add'] );

            if(!$popup){
                $this->load->view('includes/footer');
            }else{
                $this->load->view('includes/footer_popup');
            }

        }else{
             $this->load->view('includes/head', $data['header']);
             $this->load->view('form',$data['add']);
             $this->load->view('includes/footer_popup');
        }

    }

    function prepare_add_fields($tmp_id,$campos){

        // Propiedades opcionales
        $values['attr'] = ! isset($values['attr']) ? '' : $values['attr'];

        foreach($campos as $key=>$values){

                switch($values['type']){

                    case 'data_grid':
                        $html = $this->functions->getDataGrid($values['properties']);
                        break;

                    case 'gallery':
                         $html = $this->functions->getGallery($values['properties']);
                        break;

                    case 'jcropimage':
                        $html = $this->functions->getJCropImage($values['properties'], $tmp_id);
                        break;

                    case 'child_relation':
                    case 'child_relation_popup':
                    case 'child_relation_iframe':
                        $values['properties']['parent_id'] = $tmp_id;
                        $values['properties']['parent_controller'] = $this->controller_config['script'];
                        $html = $this->functions->make_form($values['type'], $values['properties']);
                        break;

                    default:

                        //Muestro un valor por defecto para los inputs_text y form_dropdowns
                        if( in_array($values['type'], array('form_dropdown','form_input')) AND isset($values['properties']['default']) ){
                            $html = $this->functions->make_form(
                                $values['type'],
                                $values['properties'],
                                $values['properties']['default']
                            );
                        }else{
                            $html = $this->functions->make_form($values['type'], $values['properties']);
                        }
                        break;
                }

            // Agrego los atributos data-* para los filtros JavaScript
            if(isset( $values['properties']['filtros'] )){
                $filtros_js = array();
                if(isset($values['properties']['filtros']) AND is_array($values['properties']['filtros'])){
                    foreach($values['properties']['filtros'] as $filtro_tipo => $filtro_valor){
                        $filtros_js[] = 'data-filtro-'.$filtro_tipo.'="'.$filtro_valor.'"';
                    }
                }
                $html = '<div '.implode(' ', $filtros_js).' style="float: none;">'. $html .'</div>';
            }

            $campos[$key]['html'] = $html;

        }

        return $campos;

	}

    function edit(){

        $popup = (isset($_GET["isPopup"]) && $_GET["isPopup"]=="true") ? true : false;
        $data = $data = array(
            'header' => $this->_generar_data( 'cabecera' ),
            'menu' => $this->_generar_data( 'menu' ),
            'edit' => $this->_generar_data( 'edit' )
        );
        $this->load_edit_view($data, $popup);

    }

    function load_edit_view($data,$popup=false){

        if( ! $this->input->get('modo')=='simple' ){
            if(!$popup){
                $this->load->view('includes/header',$data['header']);
                $this->load->view('menu',$data['menu']);
            }else{
                $this->load->view('includes/header_popup',$data['header']);
            }

            $this->load->view(  $this->vistas['add'], $data['edit'] );

            if(!$popup){
                $this->load->view('includes/footer');
            }else{
                $this->load->view('includes/footer_popup');
            }
        }else{
            $this->load->view('includes/head', $data['header']);
            $this->load->view('form',$data['edit']);
            $this->load->view('includes/footer_popup');
        }

    }

    function prepare_edit_fields( $id, $campos ){

		$model = $this->controller_config["model"];
		$item = $this->$model->get_item($id);

        foreach($campos as $i => $values){

            $key = $values['key'];

            // Si el campo esta en modo hidden no lo muestro
            if(isset($values['properties']['hidden']) && $values['properties']['hidden']==true){
                unset($campos[$key]);
                continue;
            }

            switch($values['type']){

                case 'data_grid':
                    $data = $this->_getDataGridContent($id,$values['properties']);
                   $html = $this->functions->getDataGrid($values['properties'],$data);
                    break;

                 case 'images':
                   $html = $this->functions->make_form($values['type'], $values['properties'], $id);
                    break;

                 case 'form_upload':
                   $html = $this->functions->make_form(
                            $values['type'],
                            $values['properties'],
                            $item->$key
                        );
                    break;

                 case 'gallery':
                    $gallery_name = $values['properties']['name'].'_id';
                   $html = $this->functions->getGallery($values['properties'],$item->$gallery_name);
                    break;

                 case 'jcropimage':
                    $id_foto = $item->{$values['properties']['name']};
                    $html = $this->functions->getJcropImage($values['properties'], $id, $id_foto);
                    break;

                case 'form_multiselect_simple':
                    $selected = $item->$key;
                   $html = $this->functions->make_form($values['type'], $values['properties'], $selected);
                    break;

                case 'form_multiselect_simple_ajax':
                    $selected = $item->$key;
                    $values['properties']['local_id'] = $id;
                    $values['properties']['options'] = $this->getOptions(
                        $values['properties']['child_model'].'_model',
                        $values['properties']['child_describe_field'],
                        $values['properties']['child_foreign_key'],
                        $item->{$values['properties']['parent_select_id']}
                    );
                   $html = $this->functions->make_form($values['type'], $values['properties'], $selected);
                    break;

                case 'form_multiselect':
                case 'form_multiselect_ajax':
                    $selected = $this->getSelectedOptions(
                        $values['properties']['child_model'].'_model',
                        $values['properties']['child_describe_field'],
                        $values['properties']['child_foreign_key'],
                        $item->{$values['properties']['parent_select_id']}
                    );
                    $selected = array_keys($selected);

                   $html = $this->functions->make_form($values['type'],$values['properties'],$selected);
                    break;

                case 'datetime':
                   $html = $this->functions->make_form($values['type'],$values['properties'],$item->$key);
                    break;

                case 'time':
                   $html = $this->functions->make_form($values['type'],$values['properties'],$item->$key);
                    break;

                case 'child_relation':
                case 'child_relation_popup':
                case 'child_relation_iframe':
                    $values['properties']['parent_id'] = $id;
                    $values['properties']['parent_controller'] = $this->controller_config["script"];
                   $html = $this->functions->make_form($values['type'],$values['properties']);
                    break;

                case 'form_password':
                   $html = $this->functions->make_form($values['type'],$values['properties'],"");
                    break;

                default:
                    $val = ! in_array($values['type'], $this->special_fields) ? $item->$key : '';
                    $html = $this->functions->make_form($values['type'], $values['properties'], $val);
                    break;
            }

            // Agrego los atributos data-* para los filtros JavaScript
            if(isset( $values['properties']['filtros'] )){
                $filtros_js = array();
                if(isset($values['properties']['filtros']) AND is_array($values['properties']['filtros'])){
                    foreach($values['properties']['filtros'] as $filtro_tipo => $filtro_valor){
                        $filtros_js[] = 'data-filtro-'.$filtro_tipo.'="'.$filtro_valor.'"';
                    }
                }
                $html = '<div '.implode(' ', $filtros_js).' style="float: none;">'. $html .'</div>';
            }

             $campos[$i]['html'] = $html;
        }

        return $campos;

	}

    /**
    * Controlador para guardar registro
    *
    * @return bool Resultado del save
    */

    public function save() {

		$id = $this->uri->segment(3, $this->input->get('id') );

        if($this->saveTriggers($id)){
            return $this->doSave($id);
        }else{
            /* Hubo algun error de validacion */
            $this->errorHeader('Hubo algun problema al intentar guardar el registro.');
        }

    }

    /**
    * Placeholder para triggers
    *
    * @return bool Resultado del save
    */

    function saveTriggers(){
        return true;
    }

    /**
    * Placeholder para triggers post save
    *
    * @return bool Resultado del save
    */

    function afterSaveTriggers($id,$post){
        return true;
    }

    /**
    * Metodo para el guardado del registro a nivel interno
    *
    * @return bool Resultado del save
    */

    private function doSave($item_id = 0){

        $model = $this->controller_config["model"];

        // Estamos haciendo un UPDATE
        if($item_id != 0){
            $update_mode = true;
            $item = $this->$model->get_item($item_id);

        }else{
            $update_mode = false;
            $item = new stdClass();
        }

        foreach($this->controller_config["campos_form"] as $i => $values){

            $key = $values['key'];

            switch($values['type']){

                case 'form_password':
                    //Chequeo que el campo validador coincida
                    if(trim($this->input->post($key)) != ''){
                        $item->$key = md5($this->input->post($key));
                        /*
                        if(isset($values['validate']) && $this->input->post($key)==$this->input->post($values['validate'])){
                            $item->$key = md5($this->input->post($key));
                        }elseif(isset($values['validate']) && $this->input->post($key)!=$this->input->post($values['validate'])){

                            $this->errorHeader('El campo "'.$values['label'].'" no coincide con su validador.');
                        }else{
                            continue;
                        }
                        */
                    //Chequeo que si estoy editando y no ingreso password en los campos tipo form_password no piso la clave vieja
                    }else{
                        if($update_mode){
                             continue;
                        }
                    }
                    break;


                case 'form_multiselect_simple':
                case 'form_multiselecte':
                case 'form_multiselect_ajax':
                    $item->$key  = $this->input->post($key) ? implode(",",$this->input->post($key)) : '';
                    break;


                case 'time':
                    if($fecha = $this->input->post($key)){
                        $item->$key = ($val AND is_array($val)) ? implode(':',$val).':00' : '00:00:00';
                    }else{
                        $item->$key = '';
                    }
                    break;


                case 'datetime':
                    if($fecha = $this->input->post($key)){
                        $item->$key = implode(' ', array($fecha[0], $fecha[1].':'.$fecha[2].':00'));
                    }else{
                        $item->$key = '';
                    }
                    break;


                // Relaciono las galerías con el objeto
                case 'gallery':
                    $gallery_name = $values['properties']['name'].'_id';
                    $galeria_id = $this->input->post( $gallery_name );

                    if( is_numeric($galeria_id) && $galeria_id > 0){
                        $item->$gallery_name = $galeria_id;
                    }
                    break;


                case 'mapa':

                    $mapa_id = $this->input->post( $key );

                    // Creo el mapa si no existía
                    if(! $mapa_id){

                        // Si se creó el mapa lo relaciono al objeto
                        if($mapa_id = $this->mapas_model->save_item(null, false)){
                            $item->$key = $mapa_id;
                        }else{
                            log_message('error', 'Mapa: No se pudo crear el mapa.');
                        }
                    }
                    break;


                default:
                    if(! in_array($values['type'], $this->special_fields)){
                        $item->$key = $this->input->post($key);
                    }
                    break;
            }

        }

        // Si el controlador está dividido en categorías guardamos la categoría de este ítem
        if($this->input->get('categ')){
            $item->categ = $this->input->get('categ');
        }

        // Si es un controlador hijo de otro, relacionamos al hijo con el padre
        if(isset($this->controller_config['parents']) AND is_array($this->controller_config['parents'])){

            $parent_controller   = $_GET['parent_controller'];
            $parent_id           = $_GET['parent_id'];
            $foreign_key         = $this->controller_config['parents'][$parent_controller]['foreign_key'];

            $item->$foreign_key = $parent_id;
        }

        try{
            $item->id = $this->$model->save_item($item, $update_mode);

        } catch (Exception $e) {
            $this->errorHeader( $e->getMessage() );
        }




          ////////////////////////////////////////////////////////////////////////////
         //// Acciones especiales para algunos tipos de campo después de guardar ////
        ////////////////////////////////////////////////////////////////////////////

        foreach($this->controller_config["campos_form"] as $i=>$values){

            $key = $values['key'];

            switch($values['type']){
                case 'images':
                    $this->_generateImages($item->id,$key,$values['properties']['sizes']);
                    break;

                case 'jcropimage':
                    // Si acabo de crear un nuevo elemento
                    if(! $update_mode){
                        // Y se había subido una foto
                        // Cambio el nombre de la carpeta (que tenía un ID temporal) al ID final
                        if($item->$key != 0){
                            $ruta_base = IMAGES_RESOURCES_PATH.$this->controller_config["script"].'/';
                            if(! rename($ruta_base.intval($this->input->post('tmp_id')).'/', $ruta_base.intval($item->id).'/')){
                                log_message('error','Jcrop: Hubo un problema al renombrar la carpeta de la imagen.');
                            }
                        }
                    }
                    break;


                case 'form_upload':
                    // Si ya se guardó antes con AJAX, no lo vuelvo a guardar.
                    log_error('error','uploadFile: $this->input->post($key) = '.$this->input->post($key));
                     if($archivo_id = $this->input->post($key)){
                        if($archivo = $this->archivos_model->get_item($archivo_id)){
                            log_error('error','uploadFile: $archivo_nombre = '.$archivo->nombre);
                            if($archivo->nombre == ''){
                                log_error('error','uploadFile: uploading... ');
                                $this->_uploadFile($key, $item->id);
                                return;
                            }else{
                                log_error('error','uploadFile: se guardó antes con AJAX');
                                $this->archivos_model->delete_item($archivo_id);
                            }
                        }
                     }
                    break;


                case 'child_relation':
                case 'child_relation_popup':
                case 'child_relation_iframe':
                    // Si es un controlador hijo de otro, actualizamos las
                    // foreign keys en caso de estar agregando
                    if(!$update_mode){

                        $child_model = $values['properties']['child_model'];
                        $foreign_key = $values['properties']['foreign_key'];
                        $parent_id = $this->input->post('tmp_id');

                        $this->db->where($foreign_key, $parent_id);
                        $this->db->update($this->$child_model->table, array($foreign_key=>$item->id));

                    }
                    break;


                case 'form_multiselect':
                case 'form_multiselect_ajax':
                    $this->_saveChilds( $item->id, $this->input->post($key), $values['properties']);
                    break;


                case 'mapa':

                    // Obtengo el mapa con el ID que calculamos antes
                    if($mapa = $this->mapas_model->get_item( $mapa_id )){

                        // Actualizo los datos del mapa
                        foreach($this->mapas_model->fields as $f){
                            $mapa->$f = $this->input->post( 'mapa_'.$f.'_'.$key );
                        }

                        // Evito que se guarden los valores por defecto si no se editó
                        if(! $this->input->post( 'mapa_editado_'.$key )){
                            unset($mapa->lat);
                            unset($mapa->lng);
                        }
                        $this->mapas_model->save_item($mapa, true);

                    }else{
                        log_message('error','Mapa: no se pudo actualizar los datos.');
                    }
                    break;
            }
        }

        if($this->afterSaveTriggers($item->id,$_POST)){
            $this->successHeader();

        }else{
            $this->errorHeader('Hubo algun problema con los triggers luego del guardado.');
        }

    }

    function exportCSV(){

        @apache_setenv('no-gzip', 1);
        @ini_set('zlib.output_compression', 'Off');

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$this->controller_config['script'].".csv\"");
        header("Content-Transfer-Encoding: UTF-8");

        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        $campos = $this->_getExportFields();
        if(empty( $campos )){
            $campos = $this->_getListFields();
        }

        // Genero el header del CSV
        $campos_csv_labels = array();
        foreach($campos as $c){
             $campos_csv_labels[] = $c['label'];
        }
        echo implode('; ', $campos_csv_labels)."\r\n";

        // Genero el contenido del CSV
        $sql = $this->{$this->controller_config["model"]}->sql_query_list($this->getFilters(), $this->getOrders());
        $query = $this->db->query($sql);
        foreach($query->result() as $item){
            $campos_csv_contenido = array();
            foreach($campos as $c){
                $campos_csv_contenido[] = $item->{$c['key']};
            }
            echo utf8_decode(implode('; ',$campos_csv_contenido))."\r\n";
        }
    }

    function exportXLS(){

        // Inicio el XLSWriter
        $objPHPExcel = $this->xlswriter->getHandler();

        // Set properties
		$objPHPExcel->getProperties()->setCreator("Admin")
									 ->setLastModifiedBy("Admin")
									 ->setTitle("Exportacion ".$this->controller_config["script"])
									 ->setKeywords("office 2007 openxml php");

        // The actual data
		$sql = unserialize(base64_decode($this->input->post('sql_serialized')));

        $query = $this->db->query($sql);
        $items = $query->result_array();

        // Preparo los campos para exportar
        $this->export_fields = (isset($this->controller_config["export_fields"])) ? $this->controller_config["export_fields"] : $this->_getListFields();

        // Genero el header del CSV
        $c = 0; // Contador de columnas
        $r = 1; // Para los headers dejo fija la fila 1
        foreach($this->export_fields as $field){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($c,$r,$field['label']);
            $c++;
        }

        // Genero el contenido del CSV
        $r = 2; // Arranco desde la fila 2 y avanzo
        foreach($items as $item){

            //Contador de columnas
            for($c=1;$c<count($item)/2;$c++){

                $txt = $item[$c];
                $txt = str_replace("&aacute;","á",$txt);
                $txt = str_replace("&eacute;","é",$txt);
                $txt = str_replace("&iacute;","í",$txt);
                $txt = str_replace("&oacute;","ó",$txt);
                $txt = str_replace("&uacute;","ú",$txt);
                $txt = str_replace("&Aacute;","Á",$txt);
                $txt = str_replace("&Eacute;","É",$txt);
                $txt = str_replace("&Iacute;","Í",$txt);
                $txt = str_replace("&Oacute;","Ó",$txt);
                $txt = str_replace("&Uacute;","Ú",$txt);
                $txt = str_replace("&ntilde;","ñ",$txt);
                $txt = str_replace("&Ntilde;","Ñ",$txt);

				$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($c-1,$r,strip_tags(html_entity_decode($txt)) );

            }

           $r++;
        }

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Exportacion');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$this->controller_config["script"].'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;

    }

    function actualizarOrden(){

        if(! $this->input->post('orden') ){
            $orden_inicio = intval($this->uri->segment(3));
            $orden = $this->uri->segment(4);

        }else{
            $orden_inicio = intval($this->input->post('ordenInicio'));
            $orden = $this->input->post('orden');
        }

        $orden = explode('-', $orden );


        $model = $this->controller_config["model"];
        $this->$model->fields = array('orden');

        foreach($orden AS $posicion => $id){

           $item = new stdClass;
           $item->id = $id;
           $item->orden = (intval($orden_inicio) + intval($posicion));

           $this->$model->save_item($item, true);
        }

    }

    function delete() {

        $id = $this->uri->segment(3, $this->input->get('id') );
        $model = $this->controller_config["model"];

        // Limpio todos sus imagenes, archivos, etc
        $this->_cleanResources($id);

        try{
           $this->$model->delete_item($id);

        } catch (Exception $e) {
            $this->errorHeader( $e->getMessage() );
        }


        $this->load->library('user_agent');
        if ($this->agent->is_referral()) {
            $url =  $this->agent->referrer();
        }else{
            $url =  base_url().$this->controller_config["script"].$this->_get_uriParameters();
        }
        redirect($url, 'refresh');
    }

    function delete_image(){

        $id   = $this->input->get('id');
        $name = $this->input->get('name');
        $num  = $this->input->get('num');

        $this->_deleteImage($id,$name,$num);

        $uriParameters = $this->_get_uriParameters();

        $this->load->library('user_agent');
        if ($this->agent->is_referral()) {
            $url =  $this->agent->referrer();
        }else{
            $url =  base_url().$this->router->class.'/edit/'.$id.$this->_get_uriParameters();
        }
        redirect($url, 'refresh');
    }

    function deleteFile(){

        $name           = $this->uri->segment(3);
        $id             = $this->uri->segment(4);
		$controlador_id = $this->uri->segment(5);

        $this->_deleteFile($id, $name, $controlador_id);

        $this->successHeader();
    }

    function uploadFile(){
        $name             = $this->uri->segment(3);
        $controlador_id   = $this->uri->segment(4);
        $allowed_types    = $this->uri->segment(5);
        $max_size         = $this->uri->segment(6);


        $config = array(
            'allowed_types'  => $allowed_types,
            'max_size'       => $max_size,
        );
        $this->_uploadFile($name, $controlador_id, $config);
    }

     function showFile(){
        $name               = $this->uri->segment(3);
        $id                 = $this->uri->segment(4);
        $controlador_id     = $this->uri->segment(5,0);
        $allowed_types      = $this->uri->segment(6);
        $max_size           = $this->uri->segment(7);

        $properties = array(
            'name'              => $name,
            'controlador'       => $this->controller_config["script"],
            'controlador_id'    => $controlador_id,
            'allowed_types'     => $allowed_types,
            'max_size'          => $max_size,
        );


        echo $this->functions->make_form('form_upload', $properties, $id);

    }

    function jsonGetConfig(){
		echo json_encode($this->controller_config);
	}

    function getHTMLOptions( $model, $child_describe_field, $where, $selected = '' ){

        $sql = 'SELECT * FROM '.$this->$model->table.' WHERE '.$where.' ORDER BY '.$child_describe_field.' ASC';
        $query = $this->db->query($sql);

        if( $this->db->_error_number()!==0 ){
            return false;
        }

        $items = $query->result();

        $selected = explode(',', $selected);

        $html = '';
        foreach($items as $item){
             $html .= '<option value="'.$item->id.'" '.( in_array($item->id,$selected) ? 'selected' : '').'>'.(string) htmlentities ( $item->$child_describe_field, ENT_COMPAT, 'UTF-8' )."</option>\n";
        }

       echo $html;
    }

    function getHTMLOptionsSimple($local_model, $local_id, $field_key, $child_model, $child_describe_field){

        //Obtengo los elemntos seleccionados
        /*$sql = 'SELECT * FROM '.$this->$local_model->table.' WHERE id='.$local_id.' LIMIT 1';
        $query = $this->db->query($sql);

        $selected = array();
        while( $item = $query->result() ){
            $selected[] = $item->id;
        }
        $selected = implode(',', $selected);*/

        $where = ( trim($item->$field_key)!='' ) ? 'id IN ('.$item->$field_key.')' : '1=0';
        $this->getHTMLOptions( $child_model, $child_describe_field, $where, $item->$field_key );
    }

    /************************** Metodos privados ************************************/

    function errorHeader($msg=''){

        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=utf-8');
        die($msg);

    }

    private function successHeader($msg=''){

        header("HTTP/1.0 200 OK");
        die($msg);

    }

    function _getFields($filtro = 'list'){
        $fields = array();
        foreach($this->controller_config['campos_form'] as $field){
            if(isset($field[ $filtro ]) && $field[ $filtro ]===true){
                $fields[] = $field;
            }
        }
        return $fields;
    }

    function _getListFields(){
        return $this->_getFields('list');
    }

    function _getExportFields(){
        return $this->_getFields('export');
    }

    function _cleanResources($controlador_id){

        if(! $controlador_id){
            return;
        }

        $controlador = $this->controller_config["script"];

        $dir = IMAGES_RESOURCES_PATH.$controlador.'/'.$controlador_id;
        $this->functions->rrmdir($dir);

        foreach($this->controller_config["campos_form"] AS $campo){
            switch ($campo['type']) {

                // Elimino todos los archivos
                case 'form_upload':
                    $item = $this->{$controlador.'_model'}->get_item( $controlador_id );
                    if(is_object($item)){
                        $this->_deleteFile($item->{$campo['key']}, $campo['key'], $controlador_id);
                    }else{
                        log_message('error','No se pudo eliminar el archivo con ID: '.$controlador_id);
                    }
                    break;

                // Elimino todas las galerías
                case 'gallery':
                    $item = $this->{$controlador.'_model'}->get_item( $controlador_id );
                    $galeria_id =  $item->{$campo['key'].'_id'};
                    $this->_deleteGallery($galeria_id, $campo['key'], $controlador_id);
                    break;
            }
        }
    }

    function _deleteImage($id,$name,$num){

        if(! $id){
            return;
        }

        $path = IMAGES_RESOURCES_PATH.$this->router->class.'/'.$id.'/'.$num.'_'.$name.'_*';

        $files = glob($path);
        if(is_array($files)){
			foreach($files as $file){
				unlink($file);
			}
		}
    }

    function _deleteFile($id, $name = '', $controlador_id = 0){

        $dir = FILES_RESOURCES_PATH.$this->router->class.'/'.$id.'/';
        $this->functions->rrmdir( $dir );
        $this->archivos_model->delete_item( $id );

        if($controlador_id != 0){
            $item = new stdClass();
            $item->id = $controlador_id;
            $item->$name = 0;
            $this->{$this->router->class.'_model'}->save_item($item, true);
        }

        return true;
    }

    function _deleteGallery($id, $name = '', $controlador_id = 0){

        $this->functions->rrmdir( GALLERIES_RESOURCES_PATH.$id );
        $this->galerias_model->delete_item( $id );

        if($controlador_id != 0){
            $item = new stdClass();
            $item->id = $controlador_id;
            $item->{$name.'_id'} = 0;
            $this->{$this->router->class.'_model'}->save_item($item, true);
        }
    }

    function _uploadFile($name, $controlador_id, $config){

        $this->lang->load('upload');

        if(! isset($_FILES[$name]['name'])){
            if($this->input->get('qqfile')){
                $ajax = true;
            }else{
                $this->errorHeader($this->lang->line('upload_userfile_not_set'));
                return false;
            }
        }

        // Cargo el archivo en la BD
        $archivo = new stdClass();
        $archivo->extension   = '';
        $archivo->controlador = $this->router->class;
        $archivo->orden       = 999999;
        $id = $this->archivos_model->save_item($archivo, false);

        $ruta = FILES_RESOURCES_PATH.$archivo->controlador.'/'.$id.'/';

        if(! file_exists($ruta)){
            mkdir($ruta, DIR_WRITE_MODE, true);
        }

        $config['upload_path'] = $ruta;


        // Subo el archivo
        $subido = false;
        if(! $ajax){
            $nombre = str_replace(' ','-', $this->security->sanitize_filename($_FILES[$name]['name']));

            $this->load->library('upload', $config);
            if($subido = $this->upload->do_upload($name)){
                $datos = $this->upload->data();
                $nombre    = str_replace($datos['file_ext'],'',$nombre);
                $extension = str_replace('.','',$datos['file_ext']);
            }else{
                $this->errorHeader($this->upload->display_errors());
            }

        }else{

            $this->load->library('FileUploader');

            $allowedExtensions = explode('|', $config['allowed_types']);
            $sizeLimit = $config['max_size'] * 1024;
            $uploader = $this->fileuploader->newUploader($allowedExtensions, $sizeLimit);

            // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
            $result = $uploader->handleUpload($config['upload_path']);

            if(array_key_exists('success', $result)){
                $subido = true;
                $extension  = substr(strrchr($result['newFilename'], '.'), 1);
                $nombre     = str_replace('.'.$extension, '', $result['newFilename']);

            }else{
                // Si no lo devolvemos de esta manera no se va a mostrar el mensaje
                echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                return false;
            }

        }

        // Si se subió actualizo la BD
        if($subido){

            // Actualizo los datos del archivo
            $archivo->id        = $id;
            $archivo->nombre    = $nombre;
            $archivo->extension = $extension;
            $this->archivos_model->save_item($archivo, true);

            // Relaciono el archivo con la tabla del controlador
            $item = new stdClass();
            $item->id = $controlador_id;
            $item->$name = $id;
            $this->{$this->controller_config["model"]}->save_item($item, true);

            if($ajax){
                $result['archivo_id'] = $id;
                echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                return true;
            }

        }
    }

    function _saveChilds($parent_id, $childs, $properties){

        $model = $properties['child_model'].'_model';
        $table = $this->$model->table;

        $this->db->where( $properties['local_key'], $parent_id );
		$this->db->delete($table);


		foreach($childs as $child){

			$c = new stdClass();
			$c->{$properties['local_key']} = $parent_id;
			$c->{$properties['foreign_key']} = $child;
			$this->$model->save_item($c,false);

		}

	}

    function _generateImages($id,$name,$sizes){

        $upload_path = IMAGES_RESOURCES_PATH.$this->controller_config["script"].'/'.$id.'/';

        // Si no existe la carpeta la creo
        if(!file_exists($upload_path)){
            mkdir($upload_path, 0777, true);
        }

        if(isset($_FILES[$name]['tmp_name'])){

            $i = key($_FILES[$name]['name']);
            $fotos = count($_FILES[$name]['name'])-1;

            for($i;$i<=$fotos;$i++){

                if(file_exists($_FILES[$name]['tmp_name'][$i])){

                   //Genero el thumbnail
                    $config['image_library']  = 'gd2';
                    $config['source_image']   = $_FILES[$name]['tmp_name'][$i];
                    $config['new_image']      = $upload_path.$i.'_'.$name.'_thumbnail.jpg';
                    $config['maintain_ratio'] = TRUE;
                    $config['width']          = 150;
                    $config['height']         = 150;

                    $this->image_lib->initialize($config);

                    if ( ! $this->image_lib->resize())
                    {
                        echo $this->image_lib->display_errors();
                    }

                    $this->image_lib->clear();

                    foreach($sizes as $size){

                        if( $size['method']=='crop'){

							$filepath = $_FILES[$name]['tmp_name'][$i];

							//Primero ajustamos el tamaño de la imagen redimensionándola
							$config['image_library']  = 'gd2';
                            $config['source_image']   = $_FILES[$name]['tmp_name'][$i];
                            $config['new_image']      = $upload_path.$i.'_'.$name.'_'.$size['height'].'x'.$size['width'].'.jpg';
                            $config['maintain_ratio'] = isset($size['maintain_ratio']) ? $size['maintain_ratio'] : TRUE;
                            $config['master_dim']     = isset($size['master_dim']) ? $size['master_dim'] : 'auto';
                            $config['width']          = $size['width'];
                            $config['height']         = $size['height'];

							//Guardamos las medidas de la imagen original
							list($original_width, $original_height) = getimagesize($filepath);

							//Para evitar que al recortar queden espacios en negro vemos qué lado nos conviene mantener fijo

							$R = ($size["height"]/$size["width"]);//Proporción de la imagen a generar
							$RO = ($original_height/$original_width);//Proporción de la imagen a original

							//Según la proporción de los lados definimos qué tipo de figura es
							if($R == 1){
								$figura_generar = 'C';//Cuadrado
							}elseif( $R > 1 ){
								$figura_generar = 'RV';//Rectángulo Vertical
							}else{
								$figura_generar = 'RH';//Rectángulo Horizontal
							}

							if($RO == 1){
								$figura_original = 'C';//Cuadrado
							}elseif( $RO > 1 ){
								$figura_original = 'RV';//Rectángulo Vertical
							}else{
								$figura_original = 'RH';//Rectángulo Horizontal
							}

							//Cuando las figuras son distintas tenemos que respetar el lado de la figura original que coincide con el lado más grande de la figura a generar
							if($figura_generar != $figura_original){

								if($size["height"] > $size["width"]){
									$config['master_dim'] = 'height';

								}elseif($size["width"] > $size["height"]){
									$config['master_dim'] = 'width';

								}else{//Si son iguales los lados de la figura a generar

									if($figura_original == 'RV'){
										$config['master_dim'] = 'width';

									}elseif($figura_original == 'RH'){
										$config['master_dim'] = 'height';

									}else{
										$config['master_dim'] = 'width';//Puede ser cualquiera
									}
								}
							}else{//Cuando las figuras son iguales el lado a respetar depende de la relación entre las proporciones de las figuras
								if($R > $RO){
									$config['master_dim'] = 'height';
								}else{//Si es menor (No pueden ser iguales, si no serían figuras iguales)
									$config['master_dim'] = 'width';
								}
							}

							//-- Opciones: --//

							//Dejar espacio en negro en imágenes  de 767x496 cuando la original es vertical
							$RV_con_negro = false;

							/*
							if($figura_original == 'RV' AND $RV_con_negro == true
								AND ( $size["width"]==767 AND $size["height"]==496 )){

								if($config['master_dim'] == 'height'){
									$config['master_dim'] = 'width';
								}else{
									$config['master_dim'] = 'height';
								}
							}
							*/

							//-- Fin opciones --//

							$this->image_lib->initialize($config);


							if ( ! $this->image_lib->resize()){
								return array('error' => $this->image_lib->display_errors());
							}


							//Guardamos las medidas de la imagen redimensionada
							list($redimensionada_width, $redimensionada_height) = getimagesize($upload_path.$i.'_'.$name.'_'.$size['height'].'x'.$size['width'].'.jpg');

							$this->image_lib->clear();


							//Después recortamos la imagen redimensionada
							$config['image_library'] = 'gd2';
							$config['source_image']	= $upload_path.$i.'_'.$name.'_'.$size['height'].'x'.$size['width'].'.jpg';
							$config['new_image'] = $upload_path.$i.'_'.$name.'_'.$size['height'].'x'.$size['width'].'.jpg';
							$config['maintain_ratio'] = FALSE;
							$config['width']   = $size["width"];
							$config['height']	= $size["height"];

							//Sobra alto o ancho. Si sobra alto recortamos alto
							if(($redimensionada_height > $size["height"]) AND ($redimensionada_width == $size["width"])){
								$config['x_axis']	= 0;
								$config['y_axis']	= ($redimensionada_height - $size["height"])/2;
							}elseif(($redimensionada_width > $size["width"]) AND ($redimensionada_height == $size["height"])){//Sino sobra alto sobra ancho, entonces recortamos ancho
								$config['x_axis']	= ($redimensionada_width - $size["width"])/2;
								$config['y_axis']	= 0;
							}else{
								//No recortamos
								$config['x_axis']	= 0;
								$config['y_axis']	= 0;
							}

							//Dejar espacio en negro en imágenes  de 767x496 cuando la original es vertical
							if($figura_original == 'RV' AND $RV_con_negro == true
								AND ( $size["width"]==767 AND $size["height"]==496 )){
								$config['x_axis']	= ($redimensionada_width - $size["width"])/(2);
								$config['y_axis']	= 0;
							}

							$this->image_lib->initialize($config);

							if ( ! $this->image_lib->crop())
							{
								return array('error' => $this->image_lib->display_errors());
							}

							$this->image_lib->clear();

                        }elseif( $size['method']=='resize'){

							$config['image_library'] = 'gd2';
							$config['source_image']  = $_FILES[$name]['tmp_name'][$i];
							$config['new_image']     = $upload_path.$i.'_'.$name.'_'.$size['height'].'x'.$size['width'].'.jpg';
							$config['maintain_ratio']= (isset($size['maintain_ratio'])) ? $size['maintain_ratio']   : TRUE;
                            $config['master_dim']    = (isset($size['master_dim']))     ? $size['master_dim']       : 'width';
							$config['width']         = $size['width'];
							$config['height']        = $size['height'];

							$this->image_lib->initialize($config);

							if ( ! $this->image_lib->resize())
							{
								echo $this->image_lib->display_errors();
							}

							$this->image_lib->clear();
                        }

                    }

                }

            }

        }

    }



    //Carga las opciones de un desplegable leyendo los campos de la base de datos
    function getOptions($model, $child_describe_field, $child_foreign_key=null, $parent_id=null){

        $sql  = 'SELECT * FROM '.$this->$model->table;
        $sql .= ! is_null($child_foreign_key) ? ' WHERE '.$child_foreign_key.' = '.$parent_id : '';
        $sql .= ' ORDER BY '.$child_describe_field.' ASC';

        $query = $this->db->query($sql);
        $items = $query->result();

        $options = array();

        foreach($items as $item){
            $options[$item->id] = $item->$child_describe_field;
        }

        return $options;

    }

    //Carga las opciones de un desplegable leyendo los campos de la base de datos
    function getSelectedOptions($model, $child_describe_field, $child_foreign_key, $parent_id){

        $sql = 'SELECT * FROM '.$this->$model->table.' WHERE '.$child_foreign_key.' = '.$parent_id.' ORDER BY '.$child_describe_field.' ASC';
        $query = $this->db->query($sql);
        $items = $query->result();

        $options = array();

        foreach($items as $item){
            $options[$item->id] = $item->$child_describe_field;
        }

        return $options;

    }

    function _getFileName($model,$field_name){

        $id = $this->uri->segment(3, $this->input->get('id') );

        if($id && is_numeric($id) ){

            $item = $this->$model->get_item($id);

            return $item->$field_name;

        }else{
            return '';
        }
    }

    // Clonar
    function clonar(){

        $id = intval($this->uri->segment(3, $this->input->get('id')));
        if(empty($id) OR is_null($id)){
            return;
        }

        $modelo = $this->controller_config["model"];

        // Reviso todas las relaciones de este elemento con otros
        $item = $this->$modelo->get_item( $id );
        foreach($this->controller_config["campos_form"] AS $campo){
            switch($campo['type']){
                case 'gallery':
                    $item->{$campo['key'].'_id'} = 0;
                    break;
            }
        }

        // Y elimino el ID, que se genera automáticamente
        $item->id = null;

        $nuevo_id = $this->$modelo->save_item($item, false);

        redirect(base_url().$this->controller_config["script"].'/edit/'.$nuevo_id, 'refresh');
    }

    // Actualizar checkbox con AJAX
    function actualizarCheckbox(){

        $id_item   = intval($this->uri->segment(3, $this->input->get('id_item')));
        $key_campo = $this->uri->segment(4, $this->input->get('key_campo'));
        if(! $id_item OR is_null($key_campo)){
            log_message('error','Checkbox AJAX: Falta un parámetro.');
            return false;
        }

        $modelo = $this->controller_config["model"];

        if(! ($item = $this->$modelo->get_item( $id_item ))){
            log_message('error','Checkbox AJAX: No existe el item en la base de datos.');
            return false;
        }

        $item->$key_campo = !$item->$key_campo;

        if(! $this->$modelo->save_item($item, true)){
            log_message('error','Checkbox AJAX: No se pudo actualizar la base de datos.');
            return false;
        }
    }


    // Cargar configuración para el controlador
    function cargar_config($config){


         ///////////////////////////////////////////////////////////////
        /// Genero las versiones de los campos en todos los idiomas ///
       ///////////////////////////////////////////////////////////////

        $aux_campos_form = array();
        foreach($config['campos_form'] as $campo){
            if(isset($campo['idiomas']) AND $campo['idiomas']){


                $primero = true;
                foreach(self::$idiomas as $cod_idioma => $nombre_idioma){
                    $campo_aux = $campo;
                    $campo_aux['label_original'] = $campo['label'];
                    $campo_aux['class']          .= $primero ? ' cl-l' : '';
                    $campo_aux['key']            = $campo['key'].'_'.$cod_idioma;
                    $campo_aux['filter']         = ($cod_idioma=='es') ? (isset($campo['filter']) ? $campo['filter'] : false) : false;
                    $campo_aux['list']           = ($cod_idioma=='es') ? $campo['list'] : false;
                    if(! empty($campo['label'])){
                        $campo_aux['label'] = $campo['label'].' en '.$nombre_idioma;
                    }
                    if(isset($campo['titulo'])){
                        $campo_aux['titulo'] = $campo['titulo'].' en '.$nombre_idioma;
                    }
                    if(isset($campo['properties']['name'])){
                        $campo_aux['properties']['name'] =  $campo_aux['key'];
                    }
                    if(isset($campo['id'])){
                        $campo_aux['properties']['id'] =  $campo_aux['key'];
                    }
                    $aux_campos_form[] = $campo_aux;
                    $primero = false;
                }
            }else{
                $aux_campos_form[] = $campo;
            }
        }
        $config['campos_form'] = $aux_campos_form;


         ////////////////////////
        /// Defino el modelo ///
       ////////////////////////

        $config['model'] = (isset($config['model']) AND $config['model']!='') ? $config['model'] : $config["script"].'_model';

        $this->controller_config = $config;
    }
}
