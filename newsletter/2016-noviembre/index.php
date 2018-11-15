<?php
	
	error_reporting(-1);
	ini_set('display_errors', -1);

	include('../../includes/config/config.php');
	include('../../includes/config/empresa.php');

	define('TITULO', 'Novedades de '.Empresa::$nombre);

	define('MAILING', 'newsletter/2016-noviembre/');

	define('URL', 'http://'.DOMINIO.'/'.MAILING);

	define('IMAGENES', URL.'images/');

	define('RECURSOS', 'http://'.DOMINIO.'/newsletter/recursos/');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head>
	<meta charset="utf-8">
	<meta property="og:title" content="Newsletter <?=Empresa::$nombre?>" />
    <meta property="og:site_name" content="<?=Empresa::$nombre?>"/>
    <meta name="og:description" content="Le&eacute; y compart&iacute; las novedades de <?=Empresa::$nombre?>">
    <meta property="og:image" content="<?=IMAGENES?>cabecera.jpg" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="/images/favicons/favicon.ico" >
	<link rel="icon" href="/images/favicons/favicon.ico" >
	<title>Newsletter <?=Empresa::$nombre?></title>
</head>
<body style="margin:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;" >

<table width="100%" cellspacing="0" cellpadding="0" style="background-color: #FFFFFF; text-align: center;">
	<!-- Cabecera -->
	<?php if ( isset($_GET['envio']) ) { ?>
		<tr>
			<td align="center" style="background-color: #E5E5E5;">
			<!--[if (mso)|(IE)]> 
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td align="center">
			<![endif]--><center>
					<table style="max-width: 640px; width: 100%; min-width: 320px; text-align: center;" cellspacing="0" cellpadding="0">
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 12px; line-height: 20px; color: #DB010F; text-align: right; padding-top: 5px; padding-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #E5E5E5;">
								<a href="<?=URL?>" target="_blank" style="color: #DB010F; text-decoration: none;">Ver online</a>
							</td>
						</tr>
					</table>
				</center><!--[if (mso)|(IE)]> 	
						</td>
					</tr>
				</table>
			<![endif]-->
			</td>
		</tr>
	<?php } ?>
		<tr>
			<td align="center" style="text-align: center; background-color: #FFFFFF;">
				<center>
				<!--[if (mso)|(IE)]> 
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td align="center">
						<center>
			<![endif]-->
					<table style="max-width: 640px; width: 100%; min-width: 320px; text-align: center;" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="background-color: #FFFFFF; font-size: 0;">
							<!--[if (mso)|(IE)]> 
								<table width="640" cellspacing="0" cellpadding="0" border="0" style="vertical-align: top;">
									<tr>
										<td align="center" style="vertical-align: top;">
										<center>
							<![endif]--><div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
								<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; padding-top: 20px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
											<a href="http://<?=DOMINIO?>" target="_blank" style="color: #000000; text-decoration: none;">
												<img src="<?=RECURSOS?>logo_top.gif" width="252" height="51" alt="<?=Empresa::$nombre?>" style="border: 0;" />
											</a>
										</td>
									</tr>
								</table>
							</div><!--[if (mso)|(IE)]> 
										</center>
										</td>
										<td align="center" style="vertical-align: top;">
										<center>
							<![endif]--><div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
								<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td style="font-family: Arial, sans-serif; font-size: 20px; line-height: 20px; letter-spacing: 1px; color: #908F8F; text-align: center; padding-top: 35px; padding-bottom: 40px; background-color: #FFFFFF; vertical-align: top;">
											NOVIEMBRE 2016
										</td>
									</tr>
								</table>
							</div><!--[if (mso)|(IE)]> 
										</center>	
										</td>
									</tr>
								</table>
							<![endif]-->
							</td>
						</tr>
					</table>
				<!--[if (mso)|(IE)]> 
						</center>	
						</td>
					</tr>
				</table>
			<![endif]-->
				</center>
			</td>
		</tr>
		<!-- Fin cabecera -->

		<!-- Cuerpo -->
		<tr>
			<td align="center" style="background-color: #FFFFFF; ">
				<center>
				<!--[if (mso)|(IE)]> 
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td align="center" style="vertical-align: top;">
			<![endif]-->
					<table style="max-width: 640px; width: 100%; min-width: 320px;" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; padding-bottom: 20px; background-color: #FFFFFF;">
								<img src="<?=IMAGENES?>novedad-destacada.jpg" style="display: block; width: 100%; height: auto; border: 0;" />
							</td>
						</tr>
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 22px; font-weight: bold; line-height: 22px; color: #DB010F; text-align: left; padding-bottom: 15px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
								<a href="http://bibliografika.com/es/novedad/3-bibliografika-digital-link-from-publisher-to-the-retail-book-trades" target="_blank" style="color: #DB010F; text-decoration: none;">
									Bibliogr&aacute;fika: digital link from publisher to the retail (book) trades
								</a>
							</td>
						</tr>
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 14px; line-height: 20px; color: #000000; text-align: left; padding-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
								Today, the company defines itself as &quot;the only one that gives publishing companies solutions enabling them to exploit business opportunities in the new technologies&quot;. Its range has increased from PoD to the service of creating and commercialising e-books. The company believes it is well placed to deal with the upcoming arrival of e-readers.
							</td>
						</tr>
						<tr>
							<td style="text-align: left; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; background: #FFFFFF; vertical-align: top; ">
								<table align="left" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; background-color: #FFFFFF;">
											<a href="http://bibliografika.com/es/novedad/3-bibliografika-digital-link-from-publisher-to-the-retail-book-trades" target="_blank" style="color: #000000; text-decoration: none;">
												<img src="<?=RECURSOS?>ver-mas-blanco.gif" style="border: 0;" />
											</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				<!--[if (mso)|(IE)]> 	
						</td>
					</tr>
				</table>
			<![endif]-->
				</center>
			</td>
		</tr>
		<?php $novedades = array(
			array(
				'Libranda y Podiprint llegan a un acuerdo para ofrecer nuevas oportunidades al sector del libro',
				'Libranda, principal distribuidora digital de libros electr&oacute;nicos en lengua espa&ntilde;ola a nivel internacional, ha firmado un acuerdo con la empresa Podiprint para prestar el servicio de impresi&oacute;n bajo demanda y distribuci&oacute;n 1:1 de libros en papel a sus clientes.',
				'http://bibliografika.com/es/novedad/4-libranda-y-podiprint-llegan-a-un-acuerdo-para-ofrecer-nuevas-oportunidades-al-sector-del-libro'
				),
			array(
				'Imprescindible Bibliomanager',
				'El sector del libro presenta en su cadena de valor un conjunto de ineficiencias y disfuncionalidades muy profundas, industriales, ecol&oacute;gicas y sobre todo, econ&oacute;micas y financieras.',
				'http://bibliografika.com/es/novedad/1-imprescindible-bibliomanager'
				),
			);
			function modulo_imagen ($novedad, $indice){
				return '<div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
							<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td height="226" style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; padding-top: 20px; padding-bottom: 20px; padding-left: 10px; padding-right: 10px; background-color: #DDDEDF; vertical-align: top;">
										<a style="color: #000000; text-decoration: none;" href="'.$novedad[2].'" target="_blank">
											<img src="'.IMAGENES.'novedad-'.$indice.'.jpg" style="display: block; width: 100%; height: auto; border: 0;" />
										</a>
									</td>
								</tr>
							</table>
						</div>';
			}
			function modulo_texto ($novedad){
				return '<div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
							<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td style="padding-top: 20px; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; background-color: #DDDEDF; vertical-align: top;">
										<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 24px; color: #000000; text-align: left; padding-bottom: 20px; background-color: #DDDEDF; vertical-align: top;">
													<a style="color: #000000; text-decoration: none;" href="'.$novedad[2].'" target="_blank">
														'.$novedad[0].'
													</a>
												</td>
											</tr>
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 14px; line-height: 20px; color: #000000; text-align: left; padding-bottom: 5px; background-color: #DDDEDF; vertical-align: top;">
													'.$novedad[1].'
												</td>
											</tr>
											<tr>
												<td style="padding-top: 5px; background-color: #DDDEDF; vertical-align: top;">
													<table align="left" cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; background-color: #DDDEDF;">
																<a style="color: #FFFFFF; text-decoration: none;" href="'.$novedad[2].'" target="_blank">
																	<img src="'.RECURSOS.'ver-mas-gris.gif" style="border: 0;" />
																</a>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</div>';
			}
			$apertura = '<tr>
				<td align="center" style="text-align: center; background-color: #DDDEDF;">
					<center>
					<!--[if (mso)|(IE)]> 
					<table width="640" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td align="center" style="vertical-align: top;">
							<center>
				<![endif]-->
						<table style="max-width: 640px; width: 100%; min-width: 320px; text-align: center; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #FFFFFF;" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td style="background-color: #DDDEDF; font-size: 0;">
								<!--[if (mso)|(IE)]> 
									<table width="640" cellspacing="0" cellpadding="0" border="0">
										<tr>
											<td align="center" style="vertical-align: top;">
											<center>
								<![endif]-->';
			$medio = '<!--[if (mso)|(IE)]> 
							</center>
							</td>
							<td align="center" style="vertical-align: top;">
							<center>
						<![endif]-->';
			$cierre = '<!--[if (mso)|(IE)]> 
										</center>	
										</td>
									</tr>
								</table>
							<![endif]-->
							</td>
						</tr>
					</table>
				<!--[if (mso)|(IE)]> 
						</center>	
						</td>
					</tr>
				</table>
			<![endif]-->
				</center>
			</td>
		</tr>';
		foreach ($novedades as $i => $novedad) {
			$indice = $i+1;
			if ($indice%2 == 0) {
				echo $apertura;
				echo modulo_texto($novedad);
				echo $medio;
				echo modulo_imagen($novedad, $indice);
				echo $cierre;
			}else{
				echo $apertura;
				echo modulo_imagen($novedad, $indice);
				echo $medio;
				echo modulo_texto($novedad);
				echo $cierre;
			}
		} ?>
		<!-- Fin cuerpo -->
		
		<!-- Pie -->
		<tr>
			<td align="center" style="background-color: #FFFFFF; ">
				<center>
				<!--[if (mso)|(IE)]> 
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td align="center" style="vertical-align: top;">
			<![endif]-->
					<table style="max-width: 640px; width: 100%; min-width: 320px;" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 18px; color: #272425; text-align: left; padding-top: 25px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
								CONTACTO
							</td>
						</tr>
					</table>
				<!--[if (mso)|(IE)]> 	
						</td>
					</tr>
				</table>
			<![endif]-->
				</center>
			</td>
		</tr>
		<tr>
			<td align="center" style="text-align: center; background-color: #FFFFFF;">
				<center>
				<!--[if (mso)|(IE)]> 
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td align="center" style="vertical-align: top;">
						<center>
			<![endif]-->
					<table style="max-width: 640px; width: 100%; min-width: 320px; text-align: center;" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td style="background-color: #FFFFFF; font-size: 0;">
							<!--[if (mso)|(IE)]> 
								<table width="640" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td align="center" style="vertical-align: top;">
										<center>
							<![endif]-->
							<div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
								<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td style="padding-bottom: 25px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF; vertical-align: top;">
											<table align="left" cellspacing="0" cellpadding="0" border="0">
												<tr>
													<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: left; background-color: #FFFFFF; vertical-align: top;">
														<img src="<?=RECURSOS?>icono-mail.gif" width="29" height="35" style="display: block; border: 0;" />
													</td>
												</tr>
												<tr>
													<td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 13px; color: #000000; text-align: left; background-color: #FFFFFF; vertical-align: top;">
														<a style="color: #000000; text-decoration: none;" href="mailto:<?=Empresa::$email?>"><?=Empresa::$email?></a>
													</td>
												</tr>
											</table>
										</td>
										<td style="padding-bottom: 25px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF; vertical-align: top;">
											<table align="left" cellspacing="0" cellpadding="0" border="0">
												<tr>
													<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: left; background-color: #FFFFFF; vertical-align: top;">
														<img src="<?=RECURSOS?>icono-telefono.gif" width="29" height="35" style="display: block; border: 0;" />
													</td>
												</tr>
												<tr>
													<td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 13px; color: #000000; text-align: left; background-color: #FFFFFF; vertical-align: top;">
														<a style="color: #000000; text-decoration: none;" href="tel:<?=Empresa::$telefono?>"><?=Empresa::$telefono?></a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>
							<!--[if (mso)|(IE)]> 
								</center>
									</td>
									<td align="center" style="vertical-align: top;">
								<center>
							<![endif]-->
							<div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
								<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: left; padding-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
											<a href="http://<?=DOMINIO?>" target="_blank" style="color: #000000; text-decoration: none;">
												<img src="<?=RECURSOS?>logo_pie.gif" width="153" height="30" alt="<?=Empresa::$nombre?>" style="border: 0;" />
											</a>
										</td>
									</tr>
									<tr>
										<td style="font-family: Arial, sans-serif; font-size: 12px; line-height: 12px; color: #908F8F; text-align: left; padding-bottom: 30px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF; vertical-align: top;">
											2016 &copy; Todos los derechos reservados.
										</td>
									</tr>
								</table>
							</div>
							<!--[if (mso)|(IE)]> 
										</center>	
										</td>
									</tr>
								</table>
							<![endif]-->
							</td>
						</tr>
					</table>
				<!--[if (mso)|(IE)]> 
						</center>	
						</td>
					</tr>
				</table>
			<![endif]-->
				</center>
			</td>
		</tr>
		<!-- Fin pie -->

</table>
</body>
</html>