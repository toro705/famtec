function areYouSurePrompt(url){
	if(confirm("¿Está seguro que desea realizar la acción?")){
		document.location.href = url;
	}
}

/* INICIALIZACION */

function fancyInit(){

	$(".fancyBox").fancybox({
         'width' : '98%',
         'height' : '90%',
         'autoScale' : true,
         'transitionIn' : 'none',
         'transitionOut' : 'none',
         'type' : 'iframe'
     });
}

$(function() {

	var URI_PARAMETERS 	= $('#uriParameters').val();

	$('.exportButton').click(function() {
		$('form.export').attr('action',$(this).attr('href'));
		$('form.export').submit();
		return false;
	});

	// bind form using 'ajaxForm'
	$('form.registro').ajaxForm({

		beforeSubmit: function(){
			$('.info').html('<img src="'+DOCUMENT_ROOT+'/core/images/ajax-loader.gif">&nbsp;&nbsp;Guardando...');
			$('.info').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
		},

		success: function (responseText, statusText, xhr, $form)  {
			window.location.replace( RETURN_URL );
		},

		error: function(x,e) {
			$('.info').hide();
			$('.error').html(x.responseText);
			$('.error').show();
			$("html, body").animate({ scrollTop: 0 }, "slow");
		}
	});

	$('form.registro').bind('form-pre-serialize', function(e) {
	    tinyMCE.triggerSave();
	});

	// Inicializo los fancybox

	fancyInit();

    // Inicializo los editores WYSIWYG

	tinymce.init({
		selector: "textarea.tinymce-novedad",
		theme: "modern",
		plugins: [
			 "autolink link searchreplace image lists hr anchor pagebreak spellchecker",
			 "searchreplace wordcount visualblocks visualchars fullscreen insertdatetime media nonbreaking",
			 "save table paste textcolor jbimages code"
	   ],
	  relative_urls: false,//Para que funcione jbimages >> http://justboil.me/
	  convert_urls: false,
	  image_list : "/cms/core/js/tinymce/plugins/jbimages/tinymce-image-list.php",//Importa un listado de las imágenes que se subieron (para que funcione modificar las url en tinymce-image-list.php)
	 // content_css : "core/css/estilos-wysiwyg/articulos.css",//Estilos personalizados

	  menu : {
       // file   : {title : 'File'  , items : 'newdocument'},
        edit   : {title : 'Editar'  , items : 'undo redo | cut copy paste pastetext | selectall'},
        insert : {title : 'Insertar', items : 'link jbimages'},
        view   : {title : 'Ver'  , items : 'fullscreen code'},
        format : {title : 'Formato', items : 'bold italic underline | removeformat'},
        //table  : {title : 'Tabla' , items : 'inserttable tableprops deletetable | cell row column'},
        //tools  : {title : 'Herramientas' , items : 'spellchecker code'}
		},
		 media_filter_html: false,
		// extended_valid_elements: '@[flashvars|type|src|width|height],embed',//Evita que se rompan los embed de picasa
		// entity_encoding : "raw",//Evita que se rompan las url con caracteres especiales (Ej:&)
	  contextmenu: "link | paste",
	  toolbar: "undo redo  | bold italic underline | bullist numlist | link ",
	  /* style_formats: [
			{title: 'Grande', inline: 'span', styles: {font: '22px/30px Arial,sans-serif'}},
			{title: 'Mediano', inline: 'span', styles: {font: '18px/24px Arial,sans-serif'}},
			{title: 'Normal',inline: 'span', styles: {font: '14px/20px Arial,sans-serif'}},
			{title: 'Chico', inline: 'span', styles: {font: '12px/16px Arial,sans-serif'}},
		],*/

		image_caption: true,
	  	image_advtab: true,
	  	image_description: true,
	  	image_dimensions: false,
	  	image_title: true,
	  	imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",

		valid_elements : "a[href|target=_blank],strong/b,em,u,ul,ol,li,br,p,img[*],span[style|class]",

		//Fuerza el uso de <br> en vez de <p>
		force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
	 });

	tinymce.init({
		selector: "textarea.tinymce",
		theme: "modern",
		plugins: [
			 "autolink link searchreplace image lists hr anchor pagebreak spellchecker",
			 "searchreplace wordcount visualblocks visualchars fullscreen insertdatetime media nonbreaking",
			 "save table paste textcolor jbimages code"
	   ],
	  relative_urls: false,//Para que funcione jbimages >> http://justboil.me/
	  convert_urls: false,
	  image_list : "/cms/core/js/tinymce/plugins/jbimages/tinymce-image-list.php",//Importa un listado de las imágenes que se subieron (para que funcione modificar las url en tinymce-image-list.php)
	 // content_css : "core/css/estilos-wysiwyg/articulos.css",//Estilos personalizados
	  menu : {
       // file   : {title : 'File'  , items : 'newdocument'},
        edit   : {title : 'Editar'  , items : 'undo redo | cut copy paste pastetext | selectall'},
        insert : {title : 'Insertar', items : 'link | hr'},
        view   : {title : 'Ver'  , items : 'fullscreen code'},
        format : {title : 'Formato', items : 'bold italic underline | formats | removeformat'},
        //table  : {title : 'Tabla' , items : 'inserttable tableprops deletetable | cell row column'},
        //tools  : {title : 'Herramientas' , items : 'spellchecker code'}
		},
		 media_filter_html: false,
		 extended_valid_elements: '@[flashvars|type|src|width|height],embed',//Evita que se rompan los embed de picasa
		// entity_encoding : "raw",//Evita que se rompan las url con caracteres especiales (Ej:&)
	  //contextmenu: "link inserttable | cell row column deletetable | paste",
	  toolbar: "undo redo | styleselect | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
	   /*style_formats: [
			{title: 'Grande', inline: 'span', styles: {font: '22px/30px Arial,sans-serif'}},
			{title: 'Mediano', inline: 'span', styles: {font: '18px/24px Arial,sans-serif'}},
			{title: 'Normal',inline: 'span', styles: {font: '14px/20px Arial,sans-serif'}},
			{title: 'Chico', inline: 'span', styles: {font: '12px/16px Arial,sans-serif'}},
		],*/
		//valid_elements : "a[href|target=_blank],strong/b,em,u,ul,ol,li,br,p,img,span[style|class],table,tr,td,th,tbody",
		//Fuerza el uso de <br> en vez de <p>
		force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
	 });

	//http://www.eyecon.ro/colorpicker/
	$(".colorpicker_selector").ColorPicker({

		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},

		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
			$('.colorpicker_selector').css('backgroundColor', '#' + this.value);
		},

		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},

		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},

		onChange: function (hsb, hex, rgb) {
			$('.colorpicker_selector').css('backgroundColor', '#' + hex);
			$('.colorpicker_selector').val(hex);
		}
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});




});



		//Devuelve el HTML para un select según la opción seleccionado en otro select
	function ajaxListarOpciones(listaHija, listaPadre, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados){

	  var listaPadreValor = $('[name="'+listaPadre+'"]').val();

	  if( seleccionados=='' ){
	  	$('[name="'+listaHija+'"]').html('<option value="">---</option>');

	  }else{
	  	 ajaxListarOpcionesHTML(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor);
	  }

	  $('[name="'+listaPadre+'"]').change(function(e) {
	    var listaPadreValor = $(this).val();
	    $('[name="'+listaHija+'"]').html('<option value="">Cargando...</option>');

	    if (listaPadreValor == "") {
	       $('[name="'+listaHija+'"]').html('<option value="">---</option>');

	    }else{
	      ajaxListarOpcionesHTML(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor);
	    }

	  });
	}



	function ajaxListarOpcionesHTML(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor){

	  DOCUMENT_ROOT = $('#document_root').val();

	  listaPadreValor = listaPadreValor!='' ? listaPadreValor : 0;

	  $.ajax({url: DOCUMENT_ROOT + modeloHijo +'/getHTMLOptions/'+ modeloHijo +'_model/'+ campoDescriptorHijo + '/'+ modeloHijoFK + '=' + listaPadreValor + '/' + seleccionados,
	         success: function(output) {
	            //alert(output);
	            output = (output=='') ? '<option value="">No hay opciones </option>' : '<option value="">Seleccione una opción: </option>' + output;
	            $('[name="'+listaHija+'"]').html(output).trigger("change");
	        },
	      error: function (xhr, ajaxOptions, thrownError) {
	        alert(xhr.status + " "+ thrownError);
	      }});

	}

	//Devuelve el HTML para un select según la opción seleccionado en otro select
	function ajaxListarOpcionesMultiple(listaHija, listaPadre, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados){

	  var listaPadreValor = $('[name="'+listaPadre+'"]').val();

	  listaPadreValor = listaPadreValor!='' ? listaPadreValor : 0;

	  if( seleccionados=='' ){
	  	//$('[name="'+listaHija+'"]').html('<option value="">---</option>');

	  }else{
	  	 ajaxListarOpcionesHTMLmultiple(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor);
	  }

	  $('[name="'+listaPadre+'"]').change(function(e) {
	    var listaPadreValor = $(this).val();
	    $('[name="'+listaHija+'"]').html('<option value="">Cargando...</option>');

	    if (listaPadreValor == "") {
	       $('[name="'+listaHija+'"]').html('<option value=""></option>');

	    }else{
	      ajaxListarOpcionesHTMLmultiple(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor);
	    }

	  });
	}


	function ajaxListarOpcionesHTMLmultiple(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor){

	  DOCUMENT_ROOT = $('#document_root').val();

	  listaPadreValor = listaPadreValor!='' ? listaPadreValor : 0;

	  $.ajax({url: DOCUMENT_ROOT + modeloHijo +'/getHTMLOptions/'+ modeloHijo +'_model/'+ campoDescriptorHijo + '/'+ modeloHijoFK + '=' + listaPadreValor + '/' + seleccionados,
	         success: function(output) {
	            //alert(output);
	            output = (output=='') ? '<option value="">No hay opciones </option>' : output;
	            $('[name="'+listaHija+'"]').html(output).trigger("change");
	        },
	      error: function (xhr, ajaxOptions, thrownError) {
	        alert(xhr.status + " "+ thrownError);
	      }});

	}
/*
	function ajaxListarOpcionesSimple(listaHija, listaPadre, modeloLocal, idLocal, campo, modeloHijo, campoDescriptorHijo, seleccionados){

	  var listaPadreValor = $('[name="'+listaPadre+'"]').val();

	  if( seleccionados=='' ){
	  	$('[name="'+listaHija+'"]').html('<option value="">---</option>');

	  }else{
	  	 ajaxListarOpcionesHTML(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor);
	  	 //ajaxListarOpcionesSimpleHTML(listaHija, modeloLocal, idLocal, campo, modeloHijo, campoDescriptorHijo);
	  }

	  $('[name="'+listaPadre+'"]').change(function(e) {
	    var listaPadreValor = $(this).val();
	    $('[name="'+listaHija+'"]').html('<option value="">Cargando...</option>');

	    if (listaPadreValor == "") {
	       $('[name="'+listaHija+'"]').html('<option value="">---</option>');

	    }else{
	    	 ajaxListarOpcionesHTML(listaHija, modeloHijo, modeloHijoFK, campoDescriptorHijo, seleccionados, listaPadreValor);
	      //ajaxListarOpcionesSimpleHTML(listaHija, modeloLocal, idLocal, campo, modeloHijo, campoDescriptorHijo);
	    }

	  });
	}
*/

	function ajaxListarOpcionesSimpleHTML(listaHija, modeloLocal, idLocal, campo, modeloHijo, campoDescriptorHijo){

	  DOCUMENT_ROOT = $('#document_root').val();
	  //alert(DOCUMENT_ROOT + modeloLocal +'/getHTMLOptions/'+ modeloLocal + '_model/' + idLocal + '/' + campo + '/' + modeloHijo + '_model/' + campoDescriptorHijo);
	  $.ajax({url: DOCUMENT_ROOT + modeloLocal +'/getHTMLOptionsSimple/'+ modeloLocal + '_model/' + idLocal + '/' + campo + '/' + modeloHijo + '_model/' + campoDescriptorHijo,
	         success: function(output) {
	            //alert(output);
	            output = (output=='') ? '<option value="">No hay opciones </option>' : '<option value="">Seleccione una opción: </option>' + output;
	            $('[name="'+listaHija+'"]').html(output).trigger("change");
	        },
	      error: function (xhr, ajaxOptions, thrownError) {
	        alert(xhr.status + " "+ thrownError);
	      }});

	}


// Filtra los campos
$(document).ready(function(){
	$('[data-filtro]').each(function(){
		filtrar( $(this) );
		$(this).change(function(){
			filtrar( $(this) );
		});
	});
});

function filtrar( $filtro ) {

	var valor = $filtro.val();
	var tipoFiltro  = $filtro.attr('name');

	//console.log("Filtrar por " + tipoFiltro + " = " + valor);

	// Deshabilito/habilito y oculto/muestro los campos que tienen activado el filtro
	$('[data-filtro-'+ tipoFiltro +']').each(function(){

		var valores =  $(this).data('filtro-' + tipoFiltro).split(' ');
		if($.inArray(valor, valores) == -1){

			// Para los campos de la vista "form"
			$(this).find('input, select, textarea').prop('disabled',true);
			$(this).parents('.form__campo ').css({'position':'absolute','left':-9999999});
			$(this).parents('.form__campo ').prev('.form__titulo').css({'position':'absolute','left':-9999999});

			// Para los campos del buscador de la vista "lista"
			if( $(this).parents('.filtro').length ){
				$(this).find('input, select').prop('disabled',true);
				$(this).parent('fieldset').css({'position':'absolute','left':-9999999});
			}

		}else{
			// Para los campos de la vista "form"
			$(this).find('input, select, textarea').prop('disabled',false);
			$(this).parents('.form__campo ').css({'position':'static','left':0});
			$(this).parents('.form__campo ').prev('.form__titulo').css({'position':'static','left':0});

			// Para los campos del buscador de la vista "lista"
			if( $(this).parents('.filtro').length ){
				$(this).find('input, select').prop('disabled',false);
				$(this).parent('fieldset').css({'position':'static','left':0});
			}
		}
	});
}


