<?php

	include_once('includes/config/inicio.php');

	// Configuración de la página
 	define('SECCION', 'home');
 	$metas = array(

		'titulo' 		=> '',
		'descripcion' 	=> '',
		'img' 			=> '',
		'slider' 		=> '',

	);
	include('includes/header.php');
?>
	<article>
		<?php array_push($js, 'slider-principal');
			$slider_principal = array(
	        array(
	        	'FACILITY MANAGEMENT',
	        	'Somos especialistas en'
	        	),
	        array(
	        	'FACILITY MANAGEMENT',
	        	'Somos especialistas en'
	        	),
	        array(
	        	'FACILITY MANAGEMENT', 
	        	'Somos especialistas en'
	        	),
	      );
		?>
		<div class="slider-principal">
			<ul class="owl-carousel">
			  <?php foreach ($slider_principal as $i => $slide) {
			  	$indice = $i+1;
			    $medidas = array(1920,1200,990,768,490);
			    $srcset = array();
			    $sources = '';
			    $default_src = '';
			    foreach($medidas as $m){
			      $new_sources = array();
			      for($x=1;$x<=2;$x++){
			        $new_sources[] = 'images/slider-principal/'.$indice.'-'.$m.'-x'.$x.'.jpg?v='.time().' '.$x*$m.'w';
			        if($default_src == ''){
			           $default_src = substr($new_sources[0], 0, strpos($new_sources[0],' '));

			        }
			      }
			      $sources .= '<source media="(min-width: '.$m.'px)" srcset="'.implode(',',$new_sources).'">';
			    }
			    $sources .= '<source srcset="'.implode(',',$new_sources).'">';
			      echo '<li>
			        <picture>
			          '.$sources.'
			          <img class="img-responsive" src="'.$default_src.'">
			        </picture>
			        <div class="slider-principal__contenido slide-'.$indice.'">
			        	<div class="container">
			        		<div class="row">
				        		<div class="col-xs-12">
				        			<div class="slider-principal__texto">
				        				<p class="h1">'.$slide[1].'</p>
				        				<h1 class="h1">'.$slide[0].'</h1>
				        				<a href="javascript:;" class="btn-celeste">CONÓZCANOS</a>
				        			</div>
				        		</div>
				        	</div>
			        	</div>
			        </div>
			      </li>';
			    } ?>
			</ul>
		</div>
		<section id="index-1" class="banda">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h3 class="color-1">Servicio integral de Mantenimiento, 
						<br class="visible-lg visible-md">con personal capacitado en todos sus niveles y áreas</h3>
					</div>
				</div>
			</div>
		</section>
	    <section id="index-2" class="full-width" style="background-image: url('images/bg-1.jpg')">
	      <div class="left wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
	        <div class="full-width__container wow fadeInLeft text-left" data-wow-duration="1000ms" data-wow-delay="300ms">
	          <h2 class="color-2">MANTENIMIENTO</h2>
	          <p class="color-2">Desarrollamos e implementamos Mantenimiento Sustentable, gestionamos el mismo según estándares de la Norma ISO 55000 y 14000.
	          </p>
	          <a href="nosotros.html" class="plus-link">+</a>
	        </div>
	      </div>
	      <div class="right hidden-xs">
	      </div>
	    </section>  
	    <section id="index-3" class="full-width" style="background-image: url('images/bg-2.jpg')">
	      <div class="left wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
	        <div class="full-width__container wow fadeInLeft text-left" data-wow-duration="1000ms" data-wow-delay="300ms">
	          <h2 class="color-2">EFICIENCIA ENERGÉTICA</h2>
	          <p class="color-2">Desarrollamos e implementamos la optimización de los recursos energéticos y minimizamos aquellos que tienen impacto con el medioambiente.
	          </p>
	          <a href="nosotros.html" class="plus-link">+</a>
	        </div>
	      </div>
	      <div class="right hidden-xs">
	      </div>
	    </section>  
	    <section id="index-4" class="full-width" style="background-image: url('images/bg-3.jpg')">
	      <div class="left wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
	        <div class="full-width__container wow fadeInLeft text-left" data-wow-duration="1000ms" data-wow-delay="300ms">
	          <h2 class="color-2">ENERGÍAS ALTERNATIVAS</h2>
	          <p class="color-2">Implementamos e instalamos sistemas de energías alternativas para reducir los consumos diarios, con la última tecnología disponible en el mercado. 

	          </p>
	          <a href="nosotros.html" class="plus-link">+</a>
	        </div>
	      </div>
	      <div class="right hidden-xs">
	      </div>
	    </section>  
	    <section id="index-5" class="full-width" style="background-image: url('images/bg-4.jpg')">
	      <div class="left wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
	        <div class="full-width__container wow fadeInLeft text-left" data-wow-duration="1000ms" data-wow-delay="300ms">
	          <h2 class="color-2">ESPACIOS VERDES</h2>
	          <p class="color-2">Realizamos el mantenimiento de espacios verdes a través de sistemas sostenibles con el medio, poniendo a disposición de nuestros servicios las más novedosas tecnologías.

	          </p>
	          <a href="nosotros.html" class="plus-link">+</a>
	        </div>
	      </div>
	      <div class="right hidden-xs">
	      </div>
	    </section>  
	    <section id="porque-elegirnos" class="banda">	
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h3 class="text-center color-1">¿Por qué elegirnos?</h3>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-4 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
						<i class="icn icn-handshake"></i>
						<h4 class="color-1">COMPROMISO</h4>
						<p>Equipo de trabajo con sólida experiencia en el mercado, dedicados a satisfacer las necesidades de nuestros clientes</p>
					</div>
					<div class="col-sm-4 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
						<i class="icn icn-people"></i>
						<h4 class="color-1">PERSONAL CAPACITADO</h4>
						<p>Capacitamos constantemente a nuestro personal para estar a la vanguardia en cuanto a normas, estándares y tecnologías</p>
					</div>
					<div class="col-sm-4 text-center wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
						<i class="icn icn-config"></i>
						<h4 class="color-1">CALIDAD</h4>
						<p>Gestionamos el Mantenimiento según estándares de la norma ISO 55000 para minimizar el impacto ambiental</p>
					</div>
				</div>
			</div>
	    </section>
	    <section id="index-7" class="banda" style="background-image: url('images/bg-contacto.jpg')">
	    	<div class="container wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
	    		<div class="row">
	    			<div class="col-xs-12 text-center">
	    				<h2>Comuniquese con nosotros</h2>
	    			</div>
	    		</div>
	    		<div class="row">
	    			<div class="col-sm-12 col-md-10 col-md-offset-1">
						<?php include('forms/contacto.php'); ?>
						<?php echo $form_contacto->mensaje_estado ?>
						<?php if ($form_contacto->estado != 'ok') { ?>
							<form class="formulario" role="form" method="post">
								<div class="row">	
									<div class="col-sm-6 col-md-5">
										<div class="row">
					                		<div class="col-xs-12">
							                	<div class="form-group">
							                    	<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre y Apellido" value="<?php echo (isset($_POST['nombre'])) ? $_POST['nombre'] : ''; ?>" />
							                    </div>
							                </div>
							                <div class="col-xs-12">
							                	<div class="form-group">
							                    	<input class="form-control" type="tel" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo (isset($_POST['telefono'])) ? $_POST['telefono'] : ''; ?>" />
							                    </div>
							                </div>
							                <div class="col-xs-12">
							                	<div class="form-group">
							                    	<input class="form-control" type="email" id="email" name="email" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" />
							                    </div>
							                </div>
						                	<div class="col-xs-12">
						                		<div class="form-group">
							                    	<input class="form-control" type="text" id="empresa" name="empresa" placeholder="Empresa" value="<?php echo (isset($_POST['empresa'])) ? $_POST['empresa'] : ''; ?>" />
							                    </div>
							                </div>
											
										</div>
									</div><!-- fin col-md-5 -->
									<div class="col-sm-6 col-md-7">
										<div class="row">
						                	<div class="col-xs-12">
												<div class="form-group">
							                		<textarea class="form-control" id="consulta" name="consulta" placeholder="Consulta" ><?php echo (isset($_POST['consulta'])) ? $_POST['consulta'] : ''; ?></textarea>
							                	</div>
							                </div>
							                <div class="col-xs-12 col-sm-12 col-md-8">
												<div class="form-group">
							                		<div class="form-captcha">
							                			<div class="row">
															<?= $form_contacto->campos['captcha']->html() ?>
							                			</div>
													</div>
												</div>
											</div>
							                <div class="col-xs-12 col-sm-12 col-md-4">
							                    <button class="btn-celeste" type="submit" name="enviar_contacto">ENVIAR</button>
							                </div>
										</div>
									</div><!-- fin col-sm-6 -->
								</div>
							</form>
						<?php } ?>	    			
	    			</div>
	    		</div>
	    		<div class="row">
	    			<div class="col-sm-12 col-md-10 col-md-offset-1 text-center">
	    				<div class="contacto__data"><i class="fa fa-phone"></i><a href="tel:<?=Empresa::$telefono_enlace ?>">Tel: <?=Empresa::$telefono ?></a></div>
	    				<div class="contacto__data"><i class="fa fa-envelope"></i><a href="mailto:<?=Empresa::$email ?>"><?=Empresa::$email ?></a></div>
	    				<div class="contacto__data"><i class="fa fa-map-marker"></i><a href="javascript:;"><?=Empresa::$direccion ?> <?=Empresa::$CP ?> | <?=Empresa::$localidad ?></a></div>
	    				<div class="contacto__data">
	    						<a href="javascript:;">
			    						<i class="fa fa-linkedin"></i>
			    				</a>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </section>
	</article>







<?php include('includes/footer.php'); ?>