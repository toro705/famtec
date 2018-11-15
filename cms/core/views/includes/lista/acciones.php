<?php

	$html_acciones = '';

	foreach( $actions as $action_key => $href ){

		// Remplazo los uri_parameters definidos
		$href = str_replace('{uriParameters}', $uriParameters, $href);

		// Y todos los otros valos extraidos de cada item
		preg_match_all("/{(.*?)}/", $href, $variables);
		foreach($variables[1] as $var){
			if(isset($item->$var)){
				$href = str_replace('{'.$var.'}', $item->$var, $href);
			}
		}

		switch( $action_key ){

			case 'delete':
				$html_acciones = '<a href="'.$href.'"><i class="fa fa-times" style="color: #a61c1c;" aria-hidden="true"></i></a>'.$html_acciones;
				break;

			case 'edit':
				$html_acciones = '<a href="'.$href.'" class="boton boton--sm">Editar</a>'.$html_acciones;
				break;

			case 'preview':
				$html_acciones = '<a href="'.$href.'" target="_blank"><i class="fa fa-search" style="color: #cccccc;" aria-hidden="true"></i></a>'.$html_acciones;
				break;

			case 'presentacion':
				if( isset($item->activa) AND $item->activa ){
					$html_acciones = '<a href="'.$href.'" target="_blank">.<i class="fa fa-file-text-o" aria-hidden="true"></i></a>'.$html_acciones;
				}
				break;

			default:
				$html_acciones = '<a href="'.$href.'" class="boton boton--sm">'.$action_key.'</a>'.$html_acciones;
				break;
		}

	}

	return $html_acciones;

