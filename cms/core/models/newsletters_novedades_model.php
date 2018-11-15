<?php

class Newsletters_novedades_model extends MY_Model {

	var $fields = array(
		'destacada',
		'novedad_id',
		'newsletter_id',
		'orden'
	);

	var $table = 'newsletters_novedades';

	function __construct(){
        parent::__construct();
    }

    public function save_item($o, $isUpdate, $validar = true){

    	if( $validar ){

	    	// Es obligatorio elegir una novedad
	    	if(! $o->novedad_id){
				throw new Exception('Seleccioná alguna novedad.');
				return false;
			}

	    	// No permito asignar 2 veces la misma novedad
			if($isUpdate){
				$this->db->where('id !=', $o->id);
			}
			$this->db->where('newsletter_id', $o->newsletter_id);
			$this->db->where('novedad_id', $o->novedad_id);
			$this->db->from( $this->table );
			if($this->db->count_all_results() > 0){
				throw new Exception('Esta novedad ya está asignada a este newsletter.');
				return false;
			}

			// Permito solo 1 novedad destacada
			if($o->destacada){
				$this->db->where('destacada', 1);
				$this->db->where('newsletter_id', $o->newsletter_id);
				$this->db->update($this->table, array('destacada' => 0));
			}

			// Limito a 7 la cantidad de novedades
			if(! $isUpdate){
				$this->db->where('newsletter_id', $o->newsletter_id);
				$this->db->from( $this->table );
				if($this->db->count_all_results() == 7){
					throw new Exception('Ya se llegó al máximo de 7 novedades, no se puede agregar otras.');
					return false;
				}
			}
		}

		return parent::save_item($o,$isUpdate);

	}

}
