<?php

//Obtengo los campos del listado
$campos = '';
foreach( $campos_form as $field ){


	$mostrar_campo = (isset($field['list']) && $field['list']===true);

	// No muestro el campo si está activo el filtro JavaScript para ese campo y se está filtrando
	if( isset($field['properties']['filtros']) ){
		foreach($field['properties']['filtros'] as $filtro_tipo => $filtro_valor){
	 			if(isset($_GET[ $filtro_tipo ]) AND $_GET[ $filtro_tipo ] != $filtro_valor AND $_GET[ $filtro_tipo ]!=''){
	 				$mostrar_campo = false;
	 			}
	 		}
	}

	if( !$mostrar_campo)
		continue;

	$key = $field['key'];

	switch( $field['type'] ){

		case 'email':
			$html_campo = '<a href="mailto:'.$item->$key.'">'.$item->$key.'</a>';
			break;

		case 'images': 
				$html_campo = '<img src="'.IMAGES_RESOURCES_URL.'/'.$controller.'/'.$item->id.'/0_'.$field['key'].'_thumbnail.jpg" style="height: 30px; width: auto;"/>';
				break;

		case 'jcropimage': 
				$html_campo = '<img src="'.IMAGES_RESOURCES_URL.'/'.$controller.'/'.$item->id.'/0_'.$field['key'].'_'.$field['properties']['sizes'][0]['height'].'x'.$field['properties']['sizes'][0]['width'].'.jpg" style="height: 30px; width: auto;"/>';
				break;

		case 'gallery':
				$galeria_id = $item->{$field['key'].'_id'};
				
				$CI =& get_instance();
				$CI->load->model('fotos_model');
				
				if($fotos_galeria = $CI->fotos_model->fotos_galeria($galeria_id)){
					$html_campo = '<img src="'.GALLERIES_RESOURCES_URL.$galeria_id.'/'.$fotos_galeria[0]->filename.'_thumbnail.'.$fotos_galeria[0]->extension.'" style="height: 30px; width: auto;"/>';
				}
				break;

		case 'form_checkbox':
			$html_campo =
			'<a href="#" class="js-checkbox-ajax">
				<i class="fa fa-'.($item->$key ? 'check-square-o' : 'square-o').'" aria-hidden="true"></i>
			</a>';
			break;

		case 'form_dropdown':
		case 'form_dropdown_ajax':
			$html_campo = isset($field['properties']['options'][$item->$key]) ? $field['properties']['options'][$item->$key] : '-' ;
			break;

		default:
			$html_campo = ($item->$key!='') ? $item->$key : '-';
			break;
	}


	$campos .= '<td data-key="'.$key.'">'.$html_campo.'</td>';

}

return $campos;