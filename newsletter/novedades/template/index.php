<?php

include_once('../../../includes/config/inicio.php');

	define('MAILING', 'newsletter/novedades/');
	define('URL', 'http://'.DOMINIO.'/'.MAILING);
	define('IMAGENES', URL.'images/');
	define('RECURSOS', 'http://'.DOMINIO.'/newsletter/recursos/');

$news = null;
if(isset($_GET['id'])){
	$news = Newsletter::obtener('id', $_GET['id']);
}

if(! $news ){
	define('TITULO', 'Novedades de '.Empresa::$nombre);
}else{
	define('TITULO', $news->titulo);
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head>
	<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
	
	<meta property="og:title" content="<?=TITULO?>" />
    <meta property="og:site_name" content="<?=Empresa::$nombre?>"/>
    <meta name="og:description" content="Le&eacute; y compart&iacute; las novedades de <?=Empresa::$nombre?>">
    <meta property="og:image" content="<?=($news->novedad_destacada->foto) ? $news->novedad_destacada->foto->src : ''?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="/images/favicons/favicon.ico" >
	<link rel="icon" href="/images/favicons/favicon.ico" >
	<title><?=TITULO?> - <?=Empresa::$nombre?></title>
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
								<a href="<?= $news->url ?>" target="_blank" style="color: #DB010F; text-decoration: none;">Ver online</a>
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
											<?=mb_strtoupper($news->titulo,'utf-8');?>
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
		<?php if($news->novedad_destacada){?>
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
								<img src="<?= $news->novedad_destacada->foto_destacada->src ?>" style="display: block; width: 100%; height: auto; border: 0;" />
							</td>
						</tr>
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 22px; font-weight: bold; line-height: 22px; color: #DB010F; text-align: left; padding-bottom: 15px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
								<a href="<?= $news->novedad_destacada->url.'?vp'?>" target="_blank" style="color: #DB010F; text-decoration: none;">
									<?= htmlentities($news->novedad_destacada->titulo) ?>
								</a>
							</td>
						</tr>
						<tr>
							<td style="font-family: Arial, sans-serif; font-size: 14px; line-height: 20px; color: #000000; text-align: left; padding-bottom: 5px; padding-left: 10px; padding-right: 10px; background-color: #FFFFFF;">
								<?= htmlentities($news->novedad_destacada->bajada) ?>
							</td>
						</tr>
						<tr>
							<td style="text-align: left; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; background: #FFFFFF; vertical-align: top; ">
								<table align="left" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; background-color: #FFFFFF;">
											<a href="<?= $news->novedad_destacada->url.'?vp' ?>" target="_blank" style="color: #000000; text-decoration: none;">
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
		<?php } // Fin if novedad destacada ?>
		<?php
			function modulo_imagen($novedad) {
				return '<div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
							<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td height="226" style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; padding-top: 20px; padding-bottom: 20px; padding-left: 10px; padding-right: 10px; background-color: #DDDEDF; vertical-align: top;">
										<a style="color: #000000; text-decoration: none;" href="'. $novedad->url .'?vp" target="_blank">
											<img src="'. $novedad->foto->src .'" style="display: block; width: 100%; height: auto; border: 0;" />
										</a>
									</td>
								</tr>
							</table>
						</div>';
			}
			function modulo_texto($novedad) {
				return '<div style="width: 320px; display: inline-block; vertical-align: top; font-size: 0;">
							<table align="left" width="320" cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td style="padding-top: 20px; padding-bottom: 25px; padding-left: 10px; padding-right: 10px; background-color: #DDDEDF; vertical-align: top;">
										<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 24px; color: #000000; text-align: left; padding-bottom: 20px; background-color: #DDDEDF; vertical-align: top;">
													<a style="color: #000000; text-decoration: none;" href="'. $novedad->url .'?vp" target="_blank">
														'.htmlentities($novedad->titulo).'
													</a>
												</td>
											</tr>
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 14px; line-height: 20px; color: #000000; text-align: left; padding-bottom: 5px; background-color: #DDDEDF; vertical-align: top;">
													'.htmlentities($novedad->bajada).'
												</td>
											</tr>
											<tr>
												<td style="padding-top: 5px; background-color: #DDDEDF; vertical-align: top;">
													<table align="left" cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td style="font-family: Arial, sans-serif; font-size: 10px; line-height: 12px; color: #000000; text-align: center; background-color: #DDDEDF;">
																<a style="color: #FFFFFF; text-decoration: none;" href="'. $novedad->url .'?vp" target="_blank">
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
		$cant = 1;
		foreach($news->novedades as $novedad) {
			if ($cant%2 == 0) {
				echo $apertura;
				echo modulo_texto($novedad);
				echo $medio;
				echo modulo_imagen($novedad);
				echo $cierre;
			}else{
				echo $apertura;
				echo modulo_imagen($novedad);
				echo $medio;
				echo modulo_texto($novedad);
				echo $cierre;
			}
			$cant ++;
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