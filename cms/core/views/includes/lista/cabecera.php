<?php

//Obtengo los títulos del listado
$html_listado_cabecera = '';
foreach($campos_form as $field){

	$mostrar_campo = (isset($field['list']) && $field['list']===true);

	// No muestro el campo si está activo el filtro JavaScript para ese campo y se está filtrando
	if( isset($field['properties']['filtros']) ){
		foreach($field['properties']['filtros'] as $filtro_tipo => $filtro_valor){
	 			if(isset($_GET[ $filtro_tipo ]) AND $_GET[ $filtro_tipo ]!=$filtro_valor AND $_GET[ $filtro_tipo ]!=''){
	 				$mostrar_campo = false;
	 			}
	 		}
	}

	if( !$mostrar_campo)
		continue;

	// ¿Agregamos la flecha para ordenar?
	$order_arrow = '';
	if(isset($_GET['order'][$field['key']]) && $_GET['order'][$field['key']]=='asc'){
		$order_arrow = '&and;';

	}elseif(isset($_GET['order'][$field['key']]) && $_GET['order'][$field['key']]=='desc'){
		$order_arrow = '&or;';

	}

	$html_listado_cabecera .= '<th'.($field['type']=='date' ? ' width="65"' : '').'><a href="'.$controller.'?order['.$field['key'].']='.( (isset($_GET['order'][$field['key']]) && $_GET['order'][$field['key']]=='asc') ? 'desc' : 'asc' ).'">'.(isset($field['label_original']) ? $field['label_original'] : $field['label'] ).' '.$order_arrow.'</a></th>';
}

$html_listado_cabecera = '<tr>
							'.($ordenar ? '<th>&nbsp;</th>' : '').'
							'.$html_listado_cabecera.'
							<th>&nbsp;</th>
						  </tr>';

return $html_listado_cabecera;