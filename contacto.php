<?php

	include_once('includes/config/inicio.php');

	// Configuración de la página
 	define('SECCION', 'contacto');
 	$metas = array(

		'titulo' 		=> 'Contacto',
		'descripcion' 	=> '',
		'img' 			=> '',
		'slider' 		=> '<h1>CONTACTO
							<br><small>Descubra todo lo que podemos hacer <br class="visible-lg visible-md">por su organización</small></h1>',

	);
	include('includes/header.php');
?>
	<article>
		<section id="contacto" class="banda blanca">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<h3 class="color-1">COMUNÍQUESE CON NOSOTROS</h3>
						<p>Complete el siguiente formulario y nos estaremos contactando a la brevedad.</p>
					</div>
				</div>
				<div class="row">
	            	<div class="col-md-4 col-lg-4 sidebar-container">
	            		<div class="contact__sidebar">
	            			<img src="images/logo_nav-principal-cabecera.png" alt="" class="img-responsive">
							<div class="clearfix"></div>
	            			<div class="contact__sidebar__element telefono">
	            				<div><i class="fa fa-phone"></i></div><div><a href="tel:<?=Empresa::$telefono_enlace ?>">Tel: <?=Empresa::$telefono ?></a></div>
	            				<div class="clearfix"></div>
	            			</div>

	            			<div class="contact__sidebar__element">
	            				<div><i class="fa fa-envelope"></i></div><div><a href="mailto:<?=Empresa::$email ?>"><?=Empresa::$email ?></a></div>
	            				<div class="clearfix"></div>
	            			</div>
	            			<div class="contact__sidebar__element last">
	            				<div><i class="fa fa-map-marker"></i></div><div><a href="javascript:;"><?=Empresa::$direccion ?> - <?=Empresa::$CP ?> <br><?=Empresa::$localidad ?></a></div>
	            				<div class="clearfix"></div>
	            			</div>
							<div class="clearfix"></div>
	            		</div>
	            	</div>				
					<div class="col-xs-12 col-md-7 col-md-offset-1 col-lg-8 col-lg-offset-0">
						<?php include('forms/contacto.php'); ?>
						<?php echo $form_contacto->mensaje_estado ?>
						<?php if ($form_contacto->estado != 'ok') { ?>
							<form class="formulario" role="form" method="post">
								<div class="row">	
			                		<div class="col-xs-12">
					                	<div class="form-group">
					                    	<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre y Apellido" value="<?php echo (isset($_POST['nombre'])) ? $_POST['nombre'] : ''; ?>" />
					                    </div>
					                </div>
					                <div class="col-xs-12 col-md-5">
					                	<div class="form-group">
					                    	<input class="form-control" type="tel" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo (isset($_POST['telefono'])) ? $_POST['telefono'] : ''; ?>" />
					                    </div>
					                </div>
					                <div class="col-xs-12 col-md-7">
					                	<div class="form-group">
					                    	<input class="form-control" type="email" id="email" name="email" placeholder="E-mail" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" />
					                    </div>
					                </div>
					                <div class="col-xs-12">
					                	<div class="form-group">
					                    	<input class="form-control" type="text" id="empresa" name="empresa" placeholder="Empresa" value="<?php echo (isset($_POST['empresa'])) ? $_POST['empresa'] : ''; ?>" />
					                    </div>
					                </div>
				                	<div class="col-xs-12">
										<div class="form-group">
					                		<textarea class="form-control" id="consulta" name="consulta" placeholder="Consulta" ><?php echo (isset($_POST['consulta'])) ? $_POST['consulta'] : ''; ?></textarea>
					                	</div>
					                </div>
					                <div class="col-xs-12 col-md-6">
										<div class="form-group">
					                		<div class="form-captcha">
					                			<div class="row">
													<?= $form_contacto->campos['captcha']->html() ?>
					                			</div>
											</div>
										</div>
									</div>
					                <div class="col-xs-12 col-md-6 text-right">
					                    <button class="btn-celeste" type="submit" name="enviar_contacto">ENVIAR <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>
					                </div>
								</div>

							</form>
						<?php } ?>
						<div class="clearfix"></div>
					</div>		

	            </div>
			</div>
		</section>
		<section id="contacto-mapa" class="">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3283.395927169054!2d-58.430604649623284!3d-34.619433665740075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca45340ad739%3A0xda9ce279378e80e5!2sGuayaquil+4%2C+C1424CAB+CABA!5e0!3m2!1ses-419!2sar!4v1486766378527" width="100%" height="476" frameborder="0" style="border:0" allowfullscreen></iframe>
		</section>
		<div class="clearfix"></div>
	</article>
	






<?php include('includes/footer.php'); ?>