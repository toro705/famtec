<?php

	include_once('includes/config/inicio.php');

	// Configuración de la página
 	define('SECCION', 'espacios-verdes');
 	$metas = array(

		'titulo' 		=> 'Espacios Verdes',
		'descripcion' 	=> '',
		'img' 			=> '',
		'slider' 		=> '<h1>ESPACIOS VERDES</h1>',

	);
	include('includes/header.php');
?>
	<article>
		<section id="verdes-1" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<h3 class="color-1">Realizamos el mantenimiento de espacios verdes <br class="visible-lg visible-md">a través de sistemas sostenibles con el medioambiente</h3>
						<p>Ponemos a disposición de nuestros servicios las más novedosas tecnologías en materia de sistemas de riego, tratamientos de residuos vegetales, utilización de nuevos materiales ecológicos que conforman una jardinería respetuosa con el entorno.

						<br><br>Aplicamos técnicas de sostenibilidad en el diseño de los jardínes y espacios, adaptándolos al medio donde 
						se sitúan, además de ayudar a la introducción de aire fresco y limpio constituyen lugares de esparcimiento, recreo y de relax para las personas.</p>
					</div>
				</div>
			</div>
		</section>
	    <section id="verdes-2" class="full-width">
	      <div class="left hidden-xs" style="background-image: url('images/bg-7.jpg')">
	      </div>
	      <div class="right">
	        <div class="full-width__container text-lef wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms"">
		          <p class="color-2">
		          	Según las necesidades del espacio que disponga el cliente, se hace un  plan de mantenimiento 
		          </p>
					<ul class="list-check white-list">
						<li>Asesoramiento</li>
						<li>Diseño</li>
						<li>Sistemas de riego</li>
						<li>Mantenimiento</li>
						<li>Tratamiento fitosanitario</li>
					</ul>
	        </div>
	        <div class="clearfix">	</div>
	      </div>
	    </section>  		
	</article>







<?php include('includes/footer.php'); ?>