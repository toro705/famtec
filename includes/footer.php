<?php 
	if ( SECCION != 'home' && SECCION != 'contacto') { ?>
		<section id="rrhh" class="banda bg-3">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="icn icn-people-plus"></i>
						<div class="clearfix visible-sm visible-xs"></div>
						<span>
							<h3 class="color-2"><b>¿QUERÉS SUMARTE A NUESTRA EMPRESA?</b></h3>
							<h3 class="color-2">Los valores humanos y el medioambiente son nuestros ejes.</h3>
						</span>
						<div class="clearfix visible-sm visible-xs"></div>
						<a href="javascript:;" class="btn-azul">SUMARME</a>
					</div>
				</div>
			</div>
		</section>
<?php 
	}
		
?>
	</main>
	<footer class="pie">
		<div class="copyright">
			<div class="container">
	            <div class="row">
	           		<div class="col-xs-12 col-sm-6 text-left text-center-xs">
						<small> <?=Empresa::$nombre.' ©  '.date('Y')?> Todos los derechos reservados</small>
					</div>
	    			<div class="col-xs-12 col-sm-6 text-right text-center-xs">
						<a class="synapsis" href="http://synapsis.com.ar/" target="_blank" title="Diseño web Argentina">Diseño Web <img src="images/logo_synapsis.png" alt="Synapsis Diseño Web Argentina"></a>
	    			</div>
	    		</div>
	    	</div>
		</div>
	</footer>



   <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/wow.min.js"></script>
    <script src="js/main.js"></script>

	<?php if(in_array('slider-principal', $js)){ ?>

	<!-- Owl Carousel -->

	<!-- http://owlcarousel2.github.io/OwlCarousel2/ -->
    <script src="js/jquery.owl.carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.owl.carousel/owl.animate.js"></script>
	<?php }



	if(in_array('slider-principal', $js)){ ?>
		<script>
			$(document).ready(function () {

				$('.slider-principal > ul').owlCarousel({
					autoplay: true,
					items: 1,
				    loop: true,
				    slideSpeed: 600,
			        paginationSpeed: 400,
			        singleItem: true,
			        nav: false,
			        dots: false,
			        dragBeforeAnimFinish: false,
			        mouseDrag: false,
			        touchDrag: false,
			        animateOut: 'fadeOut'
				});
			   	//Defino el nuevo ancho de las imágenes
		      	var anchoVentana = $(window).width();
		      	var anchos = [1920,1200,990,768,490];
		      	var nuevoAncho = 1920;
		      	for (var i=0; i<anchos.length; i++) {
		      		if( anchoVentana<anchos[i] ){
			      		nuevoAncho = anchos[i];
			      	}
		      	}
		      	//Cambio el src de las imágenes
		      	var imagenes = ['.slider-principal__imagen'];
		      	for (var i=0; i<imagenes.length; i++) {
		      		$(imagenes[i]).each(function(){
		       			var src = $(this).attr('src');
		       			$(this).attr('src',src.replace('1920',nuevoAncho));
		      		});
		      	}
			});
		</script>
	<?php } ?>

	<?php
		if ( SECCION == 'mantenimiento' ) {
	 ?>
	    <script src="js/jquery.owl.carousel/owl.carousel.min.js"></script>
	    <script src="js/jquery.owl.carousel/owl.animate.js"></script>
		<script>
		$( window ).on( "load", function() {
			$('.slider-1').owlCarousel({
			    loop: true,
			    autoWidth: true,
			    margin: 0,
			    nav: true,
		        dots: false,
		        center: true,	
		        mouseDrag: false,
		        touchDrag: true,
		        navText: [
	            "<div class=\"slider-interno__controls prev\"><img class=\"img-responsive\" src=\"images/chevron-left.png\"></div>",
	            "<div class=\"slider-interno__controls next\"><img class=\"img-responsive\" src=\"images/chevron-right.png\"></div>"
	            ]
			});     
			console.log('asdasd');			
		});
		</script>	 
	<?php	}	?>

  </body>

</html>