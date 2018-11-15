<?php



//Defino la URL actual

if(! defined('URL_SECCION')){

  define('URL_SECCION', url(SECCION));

}



include('metas.php');



?>

<!DOCTYPE html>

<html lang="<?= IDIOMA ?>">
  <head>
    <meta http-equiv="Content-Type"     content="text/html; charset=utf-8"/>

    <title><?= $metas['titulo']?></title>
    <meta name="description"            content="<?= $metas['descripcion'];?>"/>

    <!-- Twitter Card data -->
    <meta name="twitter:card"           content="summary_large_image"/>
    <meta name="twitter:site"           content="@<?= Empresa::$redes['tw'] ?>"/>
    <meta name="twitter:title"          content="<?= $metas['titulo'] ?>" />
    <meta name="twitter:description"    content="<?= substr($metas['descripcion'], 0, 200);?>" />
    <meta name="twitter:image"          content="<?= $metas['img'] ?>" />

    <!-- Open Graph data -->
    <meta property="og:title"           content="<?= $metas['titulo'] ?>" />
    <meta property="og:description"     content="<?= substr($metas['descripcion'], 0, 200);?>"/>
    <meta property="og:image"           content="<?= $metas['img']; ?>" />
    <meta property="og:site_name"       content="<?= Empresa::$nombre; ?>"/>
    <meta property="og:url"             content="<?= URL_SECCION; ?>"/>
    <meta name="robots"   content="all">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <base href="<?=BASE_URL?>">
    <link rel="canonical" href="<?= URL_SECCION ?>" />
    <?php

    if( count(json_decode(IDIOMA_ENABLED)) > 1 ){

      $dato_url = isset(${SECCION}) ? ${SECCION} : null;

      foreach(json_decode(IDIOMA_ENABLED) AS $lang){

          echo '   <link rel="alternate" hreflang="'.$lang.'" href="'.url(SECCION, $dato_url, $lang).'" />'."\r\n";

      }

    }

    ?>



    <!-- Favicons: http://realfavicongenerator.net/ -->

    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/favicons/favicon.ico">
    <meta name="msapplication-config" content="/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="js/jquery.owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="js/jquery.owl.carousel/assets/animate.min.css">

    <?php

     // Uno y minifico todos los CSS comunes a todas las páginas

    $main_css = $minified->merge( 'css/main.min.css', 'css', array(

            'css/bootstrap.min.css',

            'css/styles-theme.css'

        ));

    echo ' <link rel="stylesheet" href="'.$main_css.'?v='.filemtime(BASE_PATH.$main_css).'" />'."\r\n";

    ?>


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,600,700|Rubik:300,400,500,700,900" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>



<body role="document" class="<?= 's_'.SECCION ?>">
<!-- GOOGLE ANALYTICS -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-38298392-20', 'auto');
    ga('send', 'pageview');

  </script>
<!-- GOOGLE ANALYTICS -->

  <header class="cabecera anim-suave" id="home" itemscope itemtype="http://schema.org/LocalBusiness">
    <nav class="navbar anim-suave">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="navbar-header anim-suave">
              <button class="hamburger hamburger--efecto visible-xs" type="button" aria-label="Menu" aria-controls="cabecera-navbar-collapse" data-toggle="collapse" data-target=".js-navbar-cabecera">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
              <a class="cabecera__logo anim-suave" href="<?=url('home')?>">
                <img class="img-responsive anim-suave" src="images/logo_nav-principal-cabecera.png" alt="<?=Empresa::$nombre;?>" itemprop="logo">
              </a>
            </div>
          </div> 
          <div class="col-xs-12 col-sm-9 col-md-9">
              <div class="nav-head  anim-suave clearfix hidden-xs">
                  <ul class="list-inline list-unstyled pull-right">
                    <li><a href="<?=url('famtec')?>">FamTec</a></li>
                    <li><a href="<?=url('contacto')?>">RRHH</a></li>
                    <li><a href="<?=url('contacto')?>">Contacto</a></li>
                    <li><a href="<?=url('contacto')?>"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
              </div>
            <div id="cabecera-navbar-collapse" class="navbar-collapse collapse js-navbar-cabecera">
              <nav class="nav-principal anim-suave">
                <ul>
                  <li><a href="<?=url('home')?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li><a href="<?=url('mantenimiento')?>">Mantenimiento</a></li>
                  <li><a href="<?=url('eficiencia-energetica')?>">Eficiencia Energética</a></li>
                  <li><a href="<?=url('energias-alternativas')?>">Energías Alternativas</a></li>
                  <li><a href="<?=url('espacios-verdes')?>">Espacios Verdes</a></li>
                  <li class="visible-xs"><a href="<?=url('famtec')?>">FamTec</a></li>
                  <li class="visible-xs"><a href="<?=url('contacto')?>">RRHH</a></li>
                  <li class="visible-xs"><a href="<?=url('contacto')?>">Contacto</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </nav>
  

    <!-- HEADERS -->

    <?php if(SECCION != 'home'){
      switch (SECCION) {
        case 'categorias':
          $header = 'categoria';
          break; 
        default:
          $header = SECCION;
          break;
    } ?>

      <div id="headerimg" style="background-image: url(images/cabeceras/<?=$header?>.jpg)">
        <div class="headerimg__contenido">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="headerimg__texto">
                  <?php echo $metas['slider']?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- HEADERS -->

    </header>



    <!-- Sección principal -->

    <main id="main" role="main">