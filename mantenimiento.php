<?php

	include_once('includes/config/inicio.php');

	// Configuración de la página
 	define('SECCION', 'mantenimiento');
 	$metas = array(

		'titulo' 		=> 'Mantenimiento',
		'descripcion' 	=> '',
		'img' 			=> '',
		'slider' 		=> '<h1>MANTENIMIENTO SUSTENTABLE</h1>',

	);
	include('includes/header.php');
?>
	<article>
		<section id="mantenimiento-1" class="banda">
			<div class="container">
				<div class="row wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
					<div class="col-sm-10 col-sm-offset-1 text-center">
						<h3 class="color-1">Desarrollamos e implementamos Mantenimiento Sustentable </h3>
						<p>​​Gestionamos el mismo según estándares de la norma ISO 55000 y 14000 para minimizar el impacto ambiental 
							<br class="visible-lg">en las operaciones y en los recursos utilizados, para ello usamos materiales reciclables y no contaminantes, implementamos un Sistema de trazabilidad para optimizar la gestión de los activos físicos.</p>
					</div>
				</div>
			</div>
		</section>
		<section id="mantenimiento-2" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 text-center">
						<div class="row text-center">
							<div class="col-sm-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
								<ul class="list-check">
									<li>General</li>
									<li>Aire Acondicionado</li>
									<li class="visible-xs">Electricidad</li>
									<li class="visible-xs">De detalle</li>
								</ul>
							</div>
							<div class="col-sm-6 hidden-xs wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="600ms">
								<ul class="list-check">
									<li>Electricidad</li>
									<li>De detalle</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	    <section id="slider-1">
	    	<ul class="slider-1">
		    	<li>
		    		<div class="overlay"></div>
		    		<img src="images/temp/1.jpg" alt="">
	    		</li>
		    	<li>
		    		<div class="overlay"></div>
		    		<img src="images/temp/2.jpg" alt="">
	    		</li>
		    	<li>
		    		<div class="overlay"></div>
		    		<img src="images/temp/3.jpg" alt="">
	    		</li>
		    	<li>
		    		<div class="overlay"></div>
		    		<img src="images/temp/1.jpg" alt="">
	    		</li>
		    	<li>
		    		<div class="overlay"></div>
		    		<img src="images/temp/2.jpg" alt="">
	    		</li>
		    	<li>
		    		<div class="overlay"></div>
		    		<img src="images/temp/3.jpg" alt="">
	    		</li>
	    	</ul>
	    	<div class="clearfix"></div>
	    </section>
	</article>







<?php include('includes/footer.php'); ?>