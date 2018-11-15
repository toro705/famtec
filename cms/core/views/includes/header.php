<?php include('head.php');?>

	<div id="container">
		<div class="contenedor">
			<div id="header">
				<h2>Bienvenido<?php if( isset($nombre) AND $nombre!="" ){echo ', '.$nombre.'';} ?></h2>
				<?php if( isset($nombre) AND $nombre!="" ){
					echo '<div class="salir"><a href="'.base_url().'login/logout" title="Cerrar sesión">Salir</a></div>';
				}

				?>
