<?php

include_once('forms/core/Formulario.php');

$form_contacto = new Formulario(
	array(
		'destinatarios' => array(
			Empresa::$email
		),
		'asunto' 	=> 'Contacto - '.Empresa::$nombre,
		'remitente' => array(
			'nombre' => 'Web '.Empresa::$nombre,
			'email' => 'web@famtec.com.ar'
		),
		'responder_a' => array(
			'nombre' => 'nombre',
			'email' => 'email'
		),
		'opciones' => array(
			'debug' => false,
			'guardar_contacto' => false,
			'guardar_form' => false
		)
	)
);

$form_contacto->agregarCampos(
	array(

		array(
			'name' 		=> 'nombre',
			'label' 	=> 'Nombre y Apellido',
			'tipo' 		=> 'text',
			'validar' 	=> array('requerido'),
		),

		array(
			'name' 		=> 'telefono',
			'label' 	=> 'Teléfono',
			'tipo' 		=> 'tel',
			'validar' 	=> array('requerido'),
		),

		array(
			'name' 		=> 'email',
			'label' 	=> 'Email',
			'tipo' 		=> 'email',
			'validar' 	=> array('requerido','formato'),
		),

		array(
			'name' 		=> 'empresa',
			'label' 	=> 'Empresa',
			'tipo' 		=> 'text',
			'validar' 	=> array('requerido'),
		),

		array(
			'name' 		=> 'consulta',
			'label' 	=> 'Consulta',
			'tipo' 		=> 'textarea',
			'validar' 	=> array('requerido'),
		),

		array(
			'name' 		=> 'captcha',
			'label' 	=> 'Captcha',
			'tipo' 		=> 'Captcha',
			 'validar' 	=> array('requerido'),
		),
	)
);

$form_contacto->agregarMensajeEstado(
	array(
		'incompleto' =>	'Todos los campos son requeridos.',
	)
);

if( isset($_POST['enviar_contacto']) ){
	$form_contacto->enviar();
}


