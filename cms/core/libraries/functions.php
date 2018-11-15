<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions {

	function __construct(){

        $this->CI =& get_instance();
    }

   	 function make_form($type, $properties, $extra=""){

        switch($type){
            case 'form_dropdown':
            case 'form_dropdown_ajax':

				$selected = (string) $extra;

				$attr_extra = $properties;
		    	unset($attr_extra['name']);
		    	unset($attr_extra['options']);
		    	unset($attr_extra['filtros']);

				if(isset($attr_extra['es_filtro']) AND $attr_extra['es_filtro']){
					$attr_extra['data-filtro'] = 'true';
					unset($attr_extra['es_filtro']);
				}

                $html = form_dropdown(
						$properties['name'],
						$properties['options'],
						$selected,
						_parse_form_attributes($attr_extra, array())
					);

                if($type =='form_dropdown_ajax'){
            	 $html .=
            	 	"<script>
        				$(document).ready(function() {
					 		ajaxListarOpciones('".$properties['name']."', '".$properties['parent_select_id']."', '".$properties['child_model']."', '".$properties['child_foreign_key']."', '".$properties['child_describe_field']."', '".$selected."');
						});
					</script>";
                }
                break;

            case 'form_multiselect':
            case 'form_multiselect_ajax':
            /*IMPORTANTE: Esto no funciona
				$parameters = isset($properties['style']) ? 'style="'.$properties['style'].'"' : ' ';
				$parameters .= ' size="5" ';
				$selected = ! is_array($extra) ? explode(",",$extra) : $extra;

                $html = form_multiselect($properties['name'].'[]', $properties['options'], $selected, $parameters);
                if( $type=='form_multiselect_ajax' ){
            	$html .= "<script>
            				$(document).ready(function() {
						 		ajaxListarOpciones('".$properties['name']."', '".$properties['parent_select_id']."', '".$properties['child_model']."', '".$properties['child_foreign_key']."', '".$properties['child_describe_field']."', '".implode(',', $selected)."');
							});
						</script>";
                }
              FIN IMPORTANTE*/
                break;

            case 'form_multiselect_simple':
            case 'form_multiselect_simple_ajax':

				$selected = isset($extra) ? (! is_array($extra) ? explode(",",$extra) : $extra) : array();

				if(empty($selected) AND isset($properties['default'])){
					$selected[] = $properties['default'];
				}

				$attr_extra = $properties;
		    	unset($attr_extra['name']);
		    	unset($attr_extra['options']);
		    	unset($attr_extra['filtros']);

                $html = form_multiselect(
						$properties['name'].'[]',
						$properties['options'],
						$selected,
						_parse_form_attributes($attr_extra, array())
					);

                if($type == 'form_multiselect_simple_ajax'){
            	$html .=
            		"<script>
        				$(document).ready(function() {
					 		ajaxListarOpcionesMultiple('".$properties['name']."[]', '".$properties['parent_select_id']."', '".$properties['child_model']."', '".$properties['child_foreign_key']."', '".$properties['child_describe_field']."', '".implode(',',$selected)."');
						});
					</script>";
                }
                break;

            case 'images':
			case 'images_jcrop':
				$img = new Images(array(
						'properties' => $properties,
						'id'         => $extra,
						'tipo'       => $type
					));
				$html = $img->getHTML();
                break;

            case 'date':
				$date = ($extra!='') ? $extra : date('Y-m-d');
				$opciones = array('dateFormat' => 'yy-mm-dd') + (isset($properties['opciones']) ? $properties['opciones'] : array());
                $html = '<script>'.
                			'$("#'.$properties['id'].'").ready(function() {
								$( "#'.$properties['id'].'" ).datepicker('.
									json_encode($opciones).
								');
							});'.
						'</script>';
                $html .= form_input($properties,$date);
                break;

            case 'form_checkbox':
                $properties['checked'] = (($extra=="" && isset($properties['checked']) && $properties['checked']) || $extra==1) ? true : false;
                $html = form_checkbox($properties);
                break;

            case 'email':
                $properties['value'] = $extra;
                $html = form_input($properties);
                break;

            case 'form_upload':
            	$properties['controlador'] 	  = !isset($properties['controlador']) 	  ? $this->CI->uri->segment(1) : $properties['controlador'];
            	$properties['controlador_id'] = !isset($properties['controlador_id']) ? $this->CI->uri->segment(3) : $properties['controlador_id'];
            	$properties['allowed_types']  = array_key_exists('allowed_types',$properties) ? $properties['allowed_types'] : 'pdf|doc|docx';
       			$properties['max_size']       = array_key_exists('max_size',$properties) 	  ? $properties['max_size'] : 2080;

                $file = new Files(array(
					'properties' => $properties,
					'archivo_id' =>($extra=='' ? 0 : $extra)
					));
                $html = $file->getHTML();
                break;

            case 'time':
				$time = $extra;
				$html = '<select class="time" name="'.$properties['name'].'[]" id="'.$properties['id'].'"> '.$this->getHourOptions($time).' </select> <span class="dots">:</span> <select class="time" name="'.$properties['name'].'[]" id="'.$properties['id'].'2"> '.$this->getMinuteOptions($time).' </select><span class="dots">hs.</span>';
                break;

            case 'datetime':
				$valdata = @explode(' ',$extra);
				$valdate = @$valdata[0];
				$valtime = @$valdata[1];
				$properties['name'] = $properties['name'].'[]';
				$opciones = array('dateFormat' => 'yy-mm-dd') + (isset($properties['opciones']) ? $properties['opciones'] : array());
				$html = '<script>'.
                			'$("#'.$properties['id'].'").ready(function() {
								$( "#'.$properties['id'].'" ).datepicker('.
									json_encode($opciones).
								');
							});'.
						'</script>';
                $html .= form_input($properties,$valdate);
				$html .= '<select class="time" name="'.$properties['name'].'" id="'.$properties['id'].'"> '.$this->getHourOptions($valtime).' </select> <span class="dots">:</span> <select class="time" name="'.$properties['name'].'" id="'.$properties['id'].'2"> '.$this->getMinuteOptions($valtime).' </select><span class="dots">hs.</span>';
                break;

			case 'child_relation':
            case 'child_relation_popup':
				$html = 'Haga click <a class="fancyBox" href="'.base_url().'index.php?c='.$properties['child_controller'].'&parent_id='.$properties['parent_id'].'&parent_controller='.$properties['parent_controller'].'&isPopup=true&modo=popup">aqui</a> para administrarlos';
				break;

			case 'child_relation_iframe':
				$html = ' <iframe src="'.base_url().$properties['child_controller'].'/?parent_id='.$properties['parent_id'].'&parent_controller='.$properties['parent_controller'].'&modo=simple" class="iframe-child-relation"></iframe>';
				break;


			case 'validate_password':
				$properties['value'] = $extra;
                $html = form_password($properties);
                break;

            case 'form_hidden':
				$properties['value'] = $extra!='' ? $extra : $properties['value'];
                $html = form_hidden($properties['name'],$properties['value']);
                break;

            case 'mapa':
				$p = $properties;

				$mapa_id = intval($extra);
				$mapa = $this->CI->mapas_model->get_item( $mapa_id );

				$html = '';

				// Activo
				$valor = false;
				if( $mapa ){
					$valor = $mapa->activo;
				}elseif( isset($p['activo']) ){
					$valor = $p['activo'];
				}
                $html .=
                '<label for="mapa_activo_'.$p['name'].'">Activo '.form_checkbox(array(
					'name'  => 'mapa_activo_'.$p['name'],
					'id'    => 'mapa_activo_'.$p['name'],
					'class' => 'mapa__activo',
					'value' => 1,
					) + ($valor ? array('checked' => 1) : array())).
                '</label>';


                // StreetView
                if(array_key_exists('streetView', $p['opciones'])){
					$valor = false;
					if( $mapa ){
						$valor = $mapa->streetview;
					}elseif( isset($p['opciones']['streetView']) ){
						$valor = $p['opciones']['streetView'];
					}
	                $html .=
	                '<label for="mapa_streetview_'.$p['name'].'">Mostrar StreetView '.form_checkbox(array(
						'name'  => 'mapa_streetview_'.$p['name'],
						'id'    => 'mapa_streetview_'.$p['name'],
						'class' => 'mapa__streetview',
						'value' => 1,
						) + ($valor ? array('checked' => 1) : array())).
					'</label>';
				}

				// Búsqueda
				$valor = '';
				if( $mapa ){
					$valor = $mapa->busqueda;
				}
                $html .=
                '<label for="mapa_busqueda_'.$p['name'].'" style="clear: both;">Buscar: '.form_input(array(
					'name'  => 'mapa_busqueda_'.$p['name'],
					'id'    => 'mapa_busqueda_'.$p['name'],
					'class' => 'mapa__busqueda',
					'value' => $valor,
					'style' => 'width: 100%;',
					'max-size'=> '255',
					)).
                '</label>';

                // Latitud
				$lat_defecto = -34.60805832470608;
				if( isset($p['lat']) AND $p['lat']){
					$lat_defecto = $p['lat'];
				}
				$valor_lat = $lat_defecto;
				if( $mapa AND $mapa->lat){
					$valor_lat = $mapa->lat;
				}
                $html .= form_input(array(
					'type'  => 'hidden',
					'name'  => 'mapa_lat_'.$p['name'],
					'value' => $valor_lat,
					));

                // Longitud
				$lng_defecto = -58.370281912620044;
				if( isset($p['lng']) AND $p['lng']){
					$lng_defecto = $p['lng'];
				}
				$valor_lng = $lng_defecto;
				if( $mapa AND $mapa->lng){
					$valor_lng = $mapa->lng;
				}
                $html .= form_input(array(
					'type'  => 'hidden',
					'name'  => 'mapa_lng_'.$p['name'],
					'value' => $valor_lng,
					));

                $html .= form_input(array(
					'type'  => 'hidden',
					'name'  => $p['name'],
					'value' => $mapa_id,
					'class'  => 'js-mapa',
					));

                // ¿editado?
               	$html .= form_input(array(
					'type'  => 'hidden',
					'name'  => 'mapa_editado_'.$p['name'],
					'value' => 0,
					));

                $html =
                	'<div class="mapa">
						<div class="mapa__campos">
							'. $html .'
							<p style="padding:10px 5px; width: 100%; clear: both;">Ej: <em>San Martín 123, Palermo</em></p>
							<button type="button" class="boton js-mapa-cargar">Encontrar</button>
							<button type="button" class="boton js-mapa-restablecer">Restablecer</button>

							<p class="form__comentario" style="margin-top: 30px;">Puede arrastrar el marcador rojo del mapa para señalar la ubicación exacta. </p>
						</div>
						<div class="mapa__gmap">
							Esto va a ser reemplazado por el mapa, si tenés Javascript habilitado.
						</div>
                	 </div>
					</div>

					<script src="'.base_url().'core/js/jquery.geolocation.edit.min.js"></script>
					<script src="http://maps.google.com/maps/api/js?key='.GOOGLE_API_KEY.'"></script>
					<script>
					$(document).ready(function () {


						// Busca en el mapa (cuando clickeás)
						$(".mapa__campos .js-mapa-cargar").click(function(){
							$(this).parents(".mapa__campos").next(".mapa__gmap").geolocate("callGeocoding");
							return false;
						});

						// Restablece el mapa
						$(".mapa__campos .js-mapa-restablecer").click(function(){
							$("[name=mapa_lat_'.$p['name'].']").val("'.$lat_defecto.'").change();
							$("[name=mapa_lng_'.$p['name'].']").val("'.$lng_defecto.'").change();
							$(this).parents(".mapa__campos").next(".mapa__gmap").geolocate(this,"updateLatLng",{
									"lat": "[name=mapa_lat_'.$p['name'].']",
									"lng": "[name=mapa_lng_'.$p['name'].']"
								});
							$("[name=mapa_lat_'.$p['name'].']").val("0");
							$("[name=mapa_lng_'.$p['name'].']").val("0");

							return false;
						});

						// Busca en el mapa (cuando apretás enter)
						$("[name=mapa_busqueda_'.$p['name'].']").focus(function(){
							$(this).keypress(function(e) {
							    if(e.which == 13) {
						    		$(this).parents(".mapa__campos").next(".mapa__gmap").geolocate("callGeocoding");
							       	return false;
							    }
							});
						});

						crearMapa("'.$p['name'].'");

						$("[name=mapa_lat_'.$p['name'].']").change(function(){
							$("[name=mapa_editado_'.$p['name'].']").val("1");
						});

						function crearMapa(key){

							$(".mapa__gmap").geolocate({
								lat: "[name=mapa_lat_" + key + "]",
								lng: "[name=mapa_lng_" + key + "]",
								address: ["[name=mapa_busqueda_" + key + "]"],
								changeOnEdit: true,
								mapOptions: {
									disableDefaultUI: false,
									'.((array_key_exists('mapTypeId', $p['opciones']) AND $p['opciones']['mapTypeId']!='') ?
									   'mapTypeId: google.maps.MapTypeId.'.$p['opciones']['mapTypeId'].',' : '').'
									zoom: 15
								},
								geoCallback(data, status){
									var msj = "";
									switch( status ){

										case "ZERO_RESULTS" :
											msj = "No se encontraron coincidencias. Pruebe otra búsqueda."
											break;

										case "OVER_QUERY_LIMIT" :
											msj = "Se superó el límite de consultas. Contacte a su administrador."
											break;

										case "REQUEST_DENIED" :
										case "INVALID_REQUEST" :
										case "UNKNOWN_ERROR" :
											msj = "Ocurrió un error: " + status
											break;
									}

									if(status!="OK"){
										alert(msj);
									}
								}
							});
						}
					});
					</script>';
                break;

            default:
                $properties['value'] = $extra;
                $html = $type($properties);
                break;
        }

        return $html;

    }

    function getSelectedOptions($rel_model,$local_key,$foreign_key,$parent_id){


		$sql = 'SELECT '.$foreign_key.' FROM '.$this->$rel_model->table.' WHERE '.$local_key.' = '.$parent_id.'';
		$query = $this->db->query($sql);
		$items = $query->result();

		$childs = array();

		foreach($items as $item){
			$childs[] = $item->$foreign_key;
		}

		return $childs;

	}

	function getOptions($table,$child_describe_field, $db){

		$sql = 'SELECT * FROM '.$table.' ORDER BY '.$child_describe_field.' ASC';
		$query = $db->query($sql);
		$items = $query->result();

		$options = array();

		foreach($items as $item){
			$options[$item->id] = htmlentities ( $item->$child_describe_field);
		}

		return $options;

	}


    function getGallery($properties,$id=0){

		$html = '<script>
						$(document).ready(function() { $( "#gallery_'.$properties["name"].'" ).sortable({

						update: function(event, ui) {
							var info = $(this).sortable("serialize");
							$.ajax({
								type: "POST",
								url: "'.base_url().'index.php?c=gallery_ajax&m=sort",
								data: info,
								context: document.body,
								success: function(){
									// alert("cool");
								}
						  });

						}
						});
						$( "#gallery_'.$properties["name"].'" ).disableSelection();
						loadGallery("'.base_url().'",'.$id.',"'.$properties["name"].'",'.(isset($properties["marca_de_agua"]) ? '"'.$properties["marca_de_agua"].'"' : 'false').'); });
						</script>';
		$html .= "<ul id='gallery_".$properties["name"]."' class='gallery sortable'></ul><div id='uploader_".$properties["name"]."'  style='float: left; clear: both; width: auto;'></div>";
		$html .= "<input type='hidden' id='".$properties["name"]."_id' name='".$properties["name"]."_id' value='0'>";
		$html .= "<input type='hidden' id='gallery_sizes_".$properties["name"]."' name='gallery_sizes_".$properties["name"]."' value='".base64_encode(serialize($properties["sizes"]))."'>";

   	 	return $html;

    }


    function getJcropImage( $properties, $controlador_id=0, $foto_id=0 ){

    	//Si la imagen ya está subida la cargo
    	if( $foto_id>0 ){
    		$html =    '<script>
							$(document).ready(function() {
								cargarImagen( "'.base_url().'", "'.$properties["name"].'", "'.$properties["controller"].'", '.$controlador_id.', '.$foto_id.');
							});
						</script>';
    	}else{

    		//Si la imagen no está subida doy la opción de cargarla

    			$html = '<script>
	    					$(document).ready(function() {
	    						cargarUploader( \''.base_url().'\', \''.$properties["name"].'\', \''.$properties["controller"].'\', '.$controlador_id.');
	    					});
						</script>';

    	}


    	//Preparo las medidas para pasar por url
        foreach( $properties["sizes"] AS $v ){
            $anchos[] = $v["width"];
            $altos[] = $v["height"];
        }

        $html .= '<div id="jcrop_'.$properties["name"].'" style="width:auto;"
        			data-jcrop-ancho="'.implode(',',$anchos).'"
        			data-jcrop-alto="'.implode(',',$altos).'"
        			data-jcrop-siempre-jpg="'.$properties['siempre_jpg'].'"
        			data-jcrop-margenes="'.$properties['margenes'].'"
        		>
        		</div>
                <div id="uploader_'.$properties["name"].'" style="width:auto;"></div>';

        return $html;
    }


	function getHourOptions($selectedtime=""){

		$selectedhour = '';
		$selectedtime = explode(':',$selectedtime);

		if(isset($selectedtime[0])){
			$selectedhour = $selectedtime[0];
		}

		$ret = '';

		for($i=0;$i<24;$i++){
			$hour = str_pad($i,2,'0',STR_PAD_LEFT);
			$ret .= '<option '.( ($selectedhour==$hour) ? 'selected' : '' ).' value="'.$hour.'">'.$hour.'</option>';
		}

		return $ret;

	}

	function getMinuteOptions($selectedtime=""){

		$selectedminute = '';
		$selectedtime = explode(':',$selectedtime);

		if(isset($selectedtime[1])){
			$selectedminute = $selectedtime[1];
		}

		$ret = '';

		for($i=0;$i<60;$i++){
			$minute = str_pad($i,2,'0',STR_PAD_LEFT);
			$ret .= '<option '.( ($selectedminute==$minute) ? 'selected' : '' ).' value="'.$minute.'">'.$minute.'</option>';
		}

		return $ret;

	}

	function getMonthsOptions($selectedMonth=''){

		$html = '';
		$html .= '<option '.( ($selectedMonth=='0') ? 'selected' : '' ).' value="0">-- Ninguno --</option>';
		$html .= '<option '.( ($selectedMonth=='1') ? 'selected' : '' ).' value="1">Enero</option>';
		$html .= '<option '.( ($selectedMonth=='2') ? 'selected' : '' ).' value="2">Febrero</option>';
		$html .= '<option '.( ($selectedMonth=='3') ? 'selected' : '' ).' value="3">Marzo</option>';
		$html .= '<option '.( ($selectedMonth=='4') ? 'selected' : '' ).' value="4">Abril</option>';
		$html .= '<option '.( ($selectedMonth=='5') ? 'selected' : '' ).' value="5">Mayo</option>';
		$html .= '<option '.( ($selectedMonth=='6') ? 'selected' : '' ).' value="6">Junio</option>';
		$html .= '<option '.( ($selectedMonth=='7') ? 'selected' : '' ).' value="7">Julio</option>';
		$html .= '<option '.( ($selectedMonth=='8') ? 'selected' : '' ).' value="8">Agosto</option>';
		$html .= '<option '.( ($selectedMonth=='9') ? 'selected' : '' ).' value="9">Septiembre</option>';
		$html .= '<option '.( ($selectedMonth=='10') ? 'selected' : '' ).' value="10">Octubre</option>';
		$html .= '<option '.( ($selectedMonth=='11') ? 'selected' : '' ).' value="11">Noviembre</option>';
		$html .= '<option '.( ($selectedMonth=='12') ? 'selected' : '' ).' value="12">Diciembre</option>';

		return $html;

	}

	# recursively remove a directory
	function rrmdir($dir) {
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir"){
			 	$this->rrmdir($dir."/".$object);
			 }else{
			 	unlink($dir."/".$object);
			 }
		   }
		 }
		 reset($objects);
		 rmdir($dir);
	   }
	 }

}

class Images {

    var $config = array();
    var $html="";
    var $name="";
    var $controller="";
    var $id ="";

    function __construct($params){
		$this->config     = $params['properties'];
		$this->id         = $params['id'];
		$this->tipo       = $params['tipo'];
		$this->alto       = $params['properties']['sizes'][0]['height'];
		$this->ancho      = $params['properties']['sizes'][0]['width'];
		$this->buildModule($this->tipo);
    }

    function buildModule($tipo){

		// Si estamos en modo popup mantengo el pasaje por url
		$popupStr = (isset($_GET["isPopup"]) && $_GET["isPopup"]=="true") ? '&isPopup=true' : '';

        $q = $this->config["quantity"];
        $html = "";

        $parent_controller = '';
		$parent_id = '';

        if(isset($_GET["isPopup"]) && $_GET["isPopup"]=="true"){
			$parent_controller = $_GET['parent_controller'];
			$parent_id = $_GET['parent_id'];
		}

        for($i=0;$i<$q;$i++){

        	if( $tipo=='images_jcrop'){

        		//Si no hay $id no puedo guardar la iámagen (Ej:cuando no se está editando sino que se está agregando un artículo)
        		//No es la mejor manera de hacer las cosas, pero es la más sencilla. Por ahora quedará así.
        		if( $this->id!='' ){

	        		$path = IMAGES_RESOURCES_PATH.$this->config['controller'].'/'.$this->id.'/'.$i.'_'.$this->config["name"].'_thumbnail.jpg';
		            $url = base_url().'resources/images/'.$this->config['controller'].'/'.$this->id.'/'.$i.'_'.$this->config["name"].'_thumbnail.jpg';

		            if(file_exists($path)){

		                $image = '<img src="'.$url.'"/> <a href="'.base_url().'index.php?c='.$this->config['controller'].'&m=delete_image&id='.$this->id.'&name='.$this->config["name"].'&num='.$i.''.$popupStr.'&parent_id='.$parent_id.'&parent_controller='.$parent_controller.'"><img src="'.base_url().'core/images/icons/delete.png"></a><br/>';

		            }else{

						//Agrego la funcionalidad que va a permitir recortar la imagen
						$image = '<a class="boton fancyBox" href="'.base_url().'index.php?c=jcrop&isPopup=true&id='.$this->id.'&controlador='.$this->config['controller'].'&ancho='.$this->ancho.'&alto='.$this->alto.'&campo='.$this->config["name"].'&medida='.$i.'">Cargar una imagen</a>';
		           }

		        }else{
		         	$image = '<p>Para cargar una imagen primero grabá.</p>';
		        }


        	}else{

        		$path = IMAGES_RESOURCES_PATH.$this->config['controller'].'/'.$this->id.'/'.$i.'_'.$this->config["name"].'_thumbnail.jpg';
	            $url_base = base_url().'resources/images/'.$this->config['controller'].'/'.$this->id.'/'.$i.'_'.$this->config["name"];
	            $url_thumbnail = $url_base.'_thumbnail.jpg';
	            $url_medidas = $url_base.'_'.$this->alto.'x'.$this->ancho.'.jpg';

	            if(file_exists($path)){

	                $image = '	<a href="'. $url_medidas.'" target="_blank">
	                				<img src="'.$url_thumbnail.'?v='.time().'"/>
		                		</a>
		                		<a href="'.base_url().'index.php?c='.$this->config['controller'].'&m=delete_image&id='.$this->id.'&name='.$this->config["name"].'&num='.$i.''.$popupStr.'&parent_id='.$parent_id.'&parent_controller='.$parent_controller.'">
		                			<img src="'.base_url().'core/images/icons/delete.png">
		                		</a><br/>';

	            }else{

					$image = form_upload( array(
											'name'   => $this->config["name"].'['.$i.']',
											'id'     => $this->config["name"].'_'.$i
										)
					);

	            }

			}

            $html = $image;

        }

        $this->html = $html;

    }

    function getHTML(){
        return $this->html;
    }

}

class Files {

    public $id;
    public $nombre;
    public $extension;

    private $name;
    private $controlador;
    private $html;

    function __construct($params){

    	$this->CI =& get_instance();

        $this->id 				= $params['archivo_id'];
        $this->name 			= $params['properties']['name'];
        $this->allowed_types 	= $params['properties']['allowed_types'];
        $this->max_size 		= $params['properties']['max_size'];

        $this->controlador 		= $params['properties']['controlador'];
        $this->controlador_id 	= $params['properties']['controlador_id']!='' ? $params['properties']['controlador_id'] : 0;

        if($this->id != 0){
        	$datos = $this->CI->archivos_model->get_item( $this->id );
        	$this->nombre = $datos->nombre;
        	$this->extension = $datos->extension;
        }

        $this->buildModule();
    }

    function buildModule(){


    	$url_upload = base_url().$this->controlador.'/showFile'.
						  		'/'.$this->name.
						  		'/"+ archivo_id +"'.
						  		'/'.$this->controlador_id.
						  		'/'.$this->allowed_types.
						  		'/'.$this->max_size;

    	$showFile = '$.ajax({
						  url: "'.$url_upload.'",

						  beforeSend: function(){
						  	$("#js-file-upload-container-'.$this->name.'").html("<img src=\"'.base_url().'core/images/ajax-loader.gif\"/>");
						  },

						  error:function(jqXHR, textStatus, errorThrown){
						  	alert(jqXHR.responseText);
						  },

						  success:function(response){
						  	$("#js-file-upload-container-'.$this->name.'").html(response);
						  }
					});';

		if($this->id != 0){

        	$url_eliminar = base_url().$this->controlador.'/deleteFile'.
        		'/'.$this->name.
        		'/'.$this->id.
        		'/'.$this->controlador_id;

        	$url  = FILES_RESOURCES_URL.$this->controlador.'/'.$this->id.'/'.$this->nombre.'.'.$this->extension;

            $this->html = 	'<div id="js-file-upload-container-'.$this->name.'">'.
            					'<a href="'.$url.'" target="_blank">'.$this->nombre.'.'.$this->extension.'</a>'.
	            				'&nbsp;<a href="'.$url_eliminar.'" class="js-uploadFile-delete-'.$this->name.'">'.
	            					'<img src="'.base_url().'core/images/icons/delete.png">'.
	            				'</a><br/>'.
	            				'<input type="hidden" name="'.$this->name.'" value="'.$this->id.'">'.

	            				'<script>'.
	            				'$(".js-uploadFile-delete-'.$this->name.'").click(function(){
									$.ajax({
									  url: "'.$url_eliminar.'",

									  beforeSend: function(){
									  	$("#js-file-upload-container-'.$this->name.'").html("<img src=\"'.base_url().'core/images/ajax-loader.gif\"/>");
									  },

									  error:function(jqXHR, textStatus, errorThrown){
									  	alert(jqXHR.responseText);
									  },

									  success:function(){
										var archivo_id = 0;
										'.$showFile.'
									  }
									});
									return false;
	            				});'.
	            				'</script>'.
	            			'</div>';

        }else{
            $this->html = form_upload(
				array(
                    'name' => $this->name,
                    'id'   => $this->name,
                    'class'=> 'js-file-upload-'.$this->name,
                )
            );
            $this->html .= '<script>'.
            				'$("<div id=\"js-file-upload-container-'.$this->name.'\"></div>").insertBefore(".js-file-upload-'.$this->name.'");'.
            				'$("#'.$this->name.'").remove();'.

         			//Documentación: http://valums-file-uploader.github.io/file-uploader/
					'jQuery(function(){
						var uploader_'.$this->name.' = new qq.FileUploader({
							element: document.getElementById("js-file-upload-container-'.$this->name.'"),
							action: "'.base_url().$this->controlador.'/uploadFile'.
							'/'. $this->name.
							'/'.$this->controlador_id.
							'/'.$this->allowed_types.
							'/'.$this->max_size.'",
							messages: {
					            typeError: "{file} tiene una extensión inválida. Dole están permitidas las siguientes: {extensions}.",
					            sizeError: "{file} es muy grande, el tamaño máximo permitido es {sizeLimit}.",
					            minSizeError: "{file} es muy chico, el tamaño mínimo es {minSizeLimit}.",
					            emptyError: "{file} está vacío, por favor seleccioná el archivo de nuevo.",
					            onLeave: "Los archivos se están subiendo, si te vas ahora la transferencia va a ser cancelada."
					        },

							onError: function(id, fileName, xhr){
								alert(xhr.responseText);
							},
							onComplete: function(id, fileName, responseJSON){
								if(responseJSON.success === true){
									var archivo_id;
									if(responseJSON.archivo_id==undefined){
										archivo_id = 0;
									}else{
										archivo_id = responseJSON.archivo_id;
									}
									'.$showFile.'
								}
							},
						    debug: true,

						    dragText: "Arrastrá y soltá los archivos acá para subirlos",
					        uploadButtonText: "Subir archivo",
					        cancelButtonText: "Cancelar",
					        failUploadText: "Subida fallida",
						});
					});'.
           		'</script>';
        }
    }

    function getHTML(){
        return $this->html;
    }

}


