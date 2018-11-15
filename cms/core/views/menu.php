
	<div id="topmenu">
		<ul>
			<?php
			foreach( $menu AS $solapa ){

				$activo = false;
				if($current_script == $solapa->controlador){
					if($solapa->categoria!=''){
						if(isset($_GET['categ']) AND $_GET['categ'] == $solapa->categoria){
							$activo = true;
						}
					}else{
						$activo = true;
					}
				}

				echo '<li class="'.($activo ? 'current' : '').' '.
									($this->session->userdata('perfil')=='superadmin' ? $solapa->tipo : '').
									( ($this->session->userdata('perfil')!='superadmin' AND $solapa->tipo=='oculta') ? 'hidden': '').'">'.
									'<a href="'.
										base_url().
										$solapa->controlador.
										($solapa->listar!='todos' ? '/edit/'.$solapa->listar : '').
										($solapa->categoria!='' ? ($solapa->listar=='todos' ? '/index' : '').'?categ='.$solapa->categoria : '').
									'">'.$solapa->nombre.'</a></li>';
			}
			?>
		</ul>
	</div>

</div>
