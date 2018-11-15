<?php

/** Permite definir qué plugins JavaScript se quiere cargar en la página actual
*/
class Plugins{

	private static $plugins = array();

	/** Carga en un array con cada plugin que queremos incluir en la página
	*/
	public static function activar( $plugin ){
		if(! in_array($plugin, self::$plugins)){
			self::$plugins[] = $plugin;
		}
	}

	/** Imprime como un array JS los nombres de los plugins cargados.
	*/
	public static function cargar(){
		$nombres_plugins = array();
		foreach(self::$plugins as $p){
			$nombres_plugins[] = '"'.$p.'"';
		}
		echo '<script> window.jsplugins = ['.implode(',',$nombres_plugins).']; </script>'."\n\r";
	}
}
