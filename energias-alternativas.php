<?php

	include_once('includes/config/inicio.php');

	// Configuración de la página
 	define('SECCION', 'energias-alternativas');
 	$metas = array(

		'titulo' 		=> 'Energías Alternativas',
		'descripcion' 	=> '',
		'img' 			=> '',
		'slider' 		=> '<h1>ENERGÍAS ALTERNATIVAS</h1>',

	);
	include('includes/header.php');
?>
	<article>
		<section id="energias-1" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 text-center">
						<h3 class="color-1">Implementamos e instalamos sistemas de energías <br class="visible-lg visible-md">alternativas para reducir los consumos diarios</h3>
						<p>Con la última tecnología disponible en el mercado, instalamos sistemas de energía solar fotovoltaica, 
						<br class="visible-lg visible-md">energía solar térmica y energía eólica, que se complementan a los sistemas ya instalados.</p>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-6 energias-beneficios__container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<div class="energias-beneficios__tick">
							<i class="fa fa-check"></i>
						</div>

						<div class="energias-beneficios__cuadro cuadro1">
							<h4>BENEFICIOS ESTRATÉGICOS</h4>
							<ol class="list-unstyled">
								<li> Mejora la imagen pública</li>
								<li> Mayor compromiso de los integrantes de la organización</li>
								<li> Mejora en las relaciones laborales</li>
							</ol>
							
						</div>
					</div>
					<div class="col-sm-6 energias-beneficios__container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
						<div class="energias-beneficios__tick">
							<i class="fa fa-check"></i>
						</div>

						<div class="energias-beneficios__cuadro cuadro2">
							<h4>BENEFICIOS FINANCIEROS</h4>
							<ol class="list-unstyled">
								<li> Ahorros por reducción del consumo de energía y recursos naturales</li>
								<li> Ahorros por el reciclaje de materiales</li>
							</ol>
							
						</div>
					</div>
					<div class="col-sm-6 energias-beneficios__container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
						<div class="energias-beneficios__tick">
							<i class="fa fa-check"></i>
						</div>

						<div class="energias-beneficios__cuadro cuadro2">
							<h4>BENEFICIOS COMERCIALES</h4>
							<ol class="list-unstyled">
								<li> Posibilidad de ganar mercado al mostrar el compromiso con el medioambiente</li>
								<li> Diferenciación respecto de la competencia </li>
							</ol>
							
						</div>
					</div>
					<div class="col-sm-6 energias-beneficios__container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="1200ms">
						<div class="energias-beneficios__tick">
							<i class="fa fa-check"></i>
						</div>

						<div class="energias-beneficios__cuadro cuadro1">
							<h4>RESPONSABILIDAD SOCIAL CORPORATIVA</h4>
							<ol class="list-unstyled">
								<li> Calidad de los productos y/o servicios que se comercializa</li>
								<li> Impacto como fuente de trabajo</li>
							</ol>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="energias-2" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<p class="color-2 h4">Los sistemas que instalamos son de avanzada tecnología, los desarrollamos según su utilización, estos están diseñados de acuerdo 
						a las normas internacionales para cumplir con los requerimientos estándar.</p>
					</div>
					<div class="col-lg-5 col-lg-offset-1 col-md-6">
						<p class="color-2">VENTAJAS</p>
						<ul class="list-check white-list">
							<li>Es energía no contaminante</li>
							<li>La energía solar es inagotables</li>
							<li>Son no contaminantes ni tienen efecto invernadero</li>
							<li>Son de fácil mantenimiento</li>
							<li>En contrapartida con los combustibles fósiles su costo disminuye a medida que la tecnología avanza</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	</article>







<?php include('includes/footer.php'); ?>