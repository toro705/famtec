<?php

	include_once('includes/config/inicio.php');

	// Configuración de la página
 	define('SECCION', 'famtec');
 	$metas = array(

		'titulo' 		=> 'Famtec',
		'descripcion' 	=> '',
		'img' 			=> '',
		'slider' 		=> '<h1>FAMTEC
							<br><small>Especialistas en Facility Management</small></h1>',

	);
	include('includes/header.php');
?>
	<article>
		<section id="famtec-1" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<h3 class="color-1">Servicio integral de Mantenimiento, 
						<br class="visible-lg visible-md">con personal capacitado en todos sus niveles y áreas</h3>
						<p>​FamTec es una empresa dedicada a satisfacer las necesidades de facilities de las organizaciones, implementando las últimas actualizaciones en cuanto a Normas y procesos para llevar a cabo sus operaciones.
  						<br><br>
						​Para ello cuenta con personal capacitado en todos sus niveles y áreas, nos actualizamos constantemente, aplicamos los más altos estándares de mantenimiento; implementamos Mantenimiento Sustentable para fomentar el ahorro energético ser más eficientes y amigables con el medioambiente.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr>
					</div>
				</div>
			</div>
		</section>				
		<section id="famtec-2" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h3 class="color-1">NUESTRA METODOLOGÍA</h3>
						<p>Al iniciar el mantenimiento realizamos un diagnóstico con base a nuestra metodología la cual consiste en:</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-3 list-container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<div class="list-title-container">
							<p class="color-1">ANÁLISIS ESTRATÉGICO</p>
						</div>
						<hr>
						<ul class="list-caret">
							<li>Auditoría de áreas y espacios.</li>
							<li>Auditoría de servicios.</li>
							<li>Auditoría de recursos.</li>
						</ul>
					</div>
					<div class="clearfix visible-xs"></div>
					<div class="col-sm-6 col-md-3 list-container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
						<div class="list-title-container">
							<p class="color-1">ANÁLISIS TÁCTICO</p>
						</div>
						<hr>
						<ul class="list-caret">
							<li>Determinación de metodoloogías.</li>
							<li>Implementación de estándares.</li>
							<li>Medidas de desempeño.</li>
						</ul>
					</div>
					<div class="clearfix visible-xs"></div>
					<div class="col-sm-6 col-md-3 list-container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
						<div class="list-title-container">
							<p class="color-1">DESARROLLO DE SOLUCIONES</p>
						</div>
						<hr>
						<ul class="list-caret">
							<li>Evaluación de opciones.</li>
							<li>Generación de soluciones.</li>
							<li>Evaluación y selección de soluciones.</li>
						</ul>
					</div>
					<div class="clearfix visible-xs"></div>
					<div class="col-sm-6 col-md-3 list-container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="1200ms">
						<div class="list-title-container">
							<p class="color-1">IMPLEMENTACIÓN ESTRATÉGICA</p>
						</div>
						<hr>
						<ul class="list-caret">
							<li>Personas, sistemas y métodos.</li>
							<li>Planificación.</li>
							<li>Comunicación.</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	    <section id="porque-elegirnos" class="banda bg-1">	
			<div class="container">
				<div class="row">
					<div class="col-xs-12 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<h3 class="text-center color-2">¿Por qué elegirnos?</h3>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-4 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<i class="icn icn-handshake-grey"></i>
						<h4 class="color-2">COMPROMISO</h4>
						<p class="color-2">Equipo de trabajo con sólida experiencia en el mercado, dedicados a satisfacer las necesidades de nuestros clientes</p>
					</div>
					<div class="col-sm-4 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
						<i class="icn icn-people-grey"></i>
						<h4 class="color-2">PERSONAL CAPACITADO</h4>
						<p class="color-2">Capacitamos constantemente a nuestro personal para estar a la vanguardia en cuanto a normas, estándares y tecnologías</p>
					</div>
					<div class="col-sm-4 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
						<i class="icn icn-config-grey"></i>
						<h4 class="color-2">CALIDAD</h4>
						<p class="color-2">Gestionamos el Mantenimiento según estándares de la norma ISO 55000 para minimizar el impacto ambiental</p>
					</div>
				</div>
			</div>
	    </section>
	    
	</article>







<?php include('includes/footer.php'); ?>