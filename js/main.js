var App = function () {
    return {

        internos: function () {
			// Animación de enlaces internos
				$(function() {
				 $('a[href*="#"]:not([href="#"])').filter(':not([data-toggle])').click(function() {
				   if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				     var target = $(this.hash);
				     target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				     if (target.length) {
				       $('html,body').animate({
				         scrollTop: target.offset().top - 100
				       }, 1000);
				       location.hash = this.hash;
				       return false;
				     }
				   }
				 });
				});
        },

        wow: function () {
			wow = new WOW({
				boxClass:     'wow',     
				animateClass: 'animated',
				offset:       0,         
				mobile:       true,      
				live:         false       
		    }).init();
		    console.log('wow');
        },
        scrollNav: function () {
			/// Scroll en cabecera ///
			// Anima el menú cuando hay scroll
			$( window ).scroll(function(){
				var $cabecera = $('.cabecera');
				if( $(window).scrollTop() > 20){
					$cabecera.addClass('scroll');
				}else{
					$cabecera.removeClass('scroll');
				}
			});        	
			// Oculta y muestra el menú cuando hay scroll
			var $cabecera = $('.cabecera');
			var previousScroll = 0;
			$(window).scroll(function(event){
			   var scroll = $(this).scrollTop();
			   if (scroll > previousScroll && scroll > 400){
			       $cabecera.addClass('ocultar');
			       //Cierra el menú cuando hay scroll
					$(".navbar-collapse").removeClass("in").addClass("collapse");
					$(".hamburger").removeClass("is-active");
			   } else {
			      $cabecera.removeClass('ocultar');
			   }
			   previousScroll = scroll;
			});			
        },
        hamburguesa: function () {
			/// Hamburguesa ///
			$(document).ready(function(){
				$('.hamburger').click(function(){
					$(this).toggleClass('is-active');
				});
			});        	
        },
        init: function () {
            App.internos();
            App.wow();
            App.scrollNav();
            App.hamburguesa();
        }
    }
}();

jQuery(document).ready(function () {
    App.init();
});
