<?php
include("libs/php/funcions.php");
session_start();
ob_start();

$link=conecta();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CoboPhone \ Reparación Moviles, Tablets, Ordenadores Y Consolas</title>
  <meta name="keywords" content="CoboPhone">
  <meta name="description" content="CoboPhone \ Reparación Moviles, Tablets, Ordenadores Y Consolas">
  <meta name="author" content="WhiteMind.es">
  <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon.ico">
  
  <!-- Font -->
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic'>

  <!-- Plugins CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/jslider.css">
  <link rel="stylesheet" href="css/revslider/settings.css">
  <link rel="stylesheet" href="css/jquery.fancybox.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/video-js.min.css">
  <link rel="stylesheet" href="css/morris.css">
  <link rel="stylesheet" href="css/royalslider/royalslider.css">
  <link rel="stylesheet" href="css/royalslider/skins/minimal-white/rs-minimal-white.css">
  <link rel="stylesheet" href="css/layerslider/css/layerslider.css">
  <link rel="stylesheet" href="css/ladda.min.css">
  <link rel="stylesheet" href="css/datepicker.css">
  <link rel="stylesheet" href="css/jquery.scrollbar.css">
  <?php include ("layout/metas.html");?>
  <!-- Theme CSS -->
  <link rel="stylesheet" href="css/cbpcsslib.css">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/customizer/pages.css">
  <link rel="stylesheet" href="css/customizer/pages-pages-customizer.css">

  <!-- IE Styles-->
  <link rel='stylesheet' href="css/ie/ie.css">
  
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<link rel='stylesheet' href="css/ie/ie8.css">
  <![endif]-->
</head>
<body  class="fixed-header">
<div class="page-box">
<div class="page-box-content">

<header class="header header-two">
  <?php include("layout/header.php"); ?>
</header><!-- .header -->

<div class="breadcrumb-box">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="index.html">Home</a> </li>
      <li class="active">Tarifas reparaciones</li>
    </ul>	
  </div>
</div><!-- .breadcrumb-box -->

<section id="main">
  <header class="page-header">
    <div class="container">
      <h1 class="title">Tarifas</h1>
    </div>	
  </header>
  <div class="wrapper-1">
  <?php include("layout/marcas.php"); ?>
  </div>
  <div class="wrapper-2">
      <div class="col-xs-12 centered text-center">
          <hr>
          <a href="tel://+34916422257" class="btn btn-primary"><span class="fa fa-phone"></span> Llámanos</a>
          <a href="whatsapp://send?tel:+34631188349" class="btn btn-primary visible-xs"><span class="fa fa-whatsapp"></span> WhatsApp</a>
          <a href="presupuesto.php" class="btn btn-success">Pide tu presupuesto</a>
      </div>
  </div>
</section><!-- #main -->

</div><!-- .page-box-content -->
</div><!-- .page-box -->

<footer id="footer">
  <?php include("layout/footer.php"); ?>
</footer>
<?php include("layout/cookies.php"); ?>
<div class="clearfix"></div>

<!--[if (!IE)|(gt IE 8)]><!-->
  <script src="js/jquery-3.0.0.min.js"></script>
<!--<![endif]-->

<!--[if lte IE 8]>
  <script src="js/jquery-1.9.1.min.js"></script>
<![endif]-->
<script src="js/bootstrap.min.js"></script>
<script src="js/price-regulator/jshashtable-2.1_src.js"></script>
<script src="js/price-regulator/jquery.numberformatter-1.2.3.js"></script>
<script src="js/price-regulator/tmpl.js"></script>
<script src="js/price-regulator/jquery.dependClass-0.1.js"></script>
<script src="js/price-regulator/draggable-0.1.js"></script>
<script src="js/price-regulator/jquery.slider.js"></script>
<script src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script src="js/jquery.touchwipe.min.js"></script>
<script src="js/jquery.elevateZoom-3.0.8.min.js"></script>
<script src="js/jquery.imagesloaded.min.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/jquery.easypiechart.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/jquery.knob.js"></script>
<script src="js/jquery.selectBox.min.js"></script>
<script src="js/jquery.royalslider.min.js"></script>
<script src="js/jquery.tubular.1.0.js"></script>
<script src="js/SmoothScroll.js"></script>
<script src="js/country.js"></script>
<script src="js/spin.min.js"></script>
<script src="js/ladda.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael.min.js"></script>
<script src="js/video.js"></script>
<script src="js/pixastic.custom.js"></script>
<script src="js/livicons-1.4.min.js"></script>
<script src="js/layerslider/greensock.js"></script>
<script src="js/layerslider/layerslider.transitions.js"></script>
<script src="js/layerslider/layerslider.kreaturamedia.jquery.js"></script>
<script src="js/revolution/jquery.themepunch.tools.min.js"></script>
<script src="js/revolution/jquery.themepunch.revolution.min.js"></script>
<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
	(Load Extensions only on Local File Systems !
	The following part can be removed on Server for On Demand Loading) -->	
  <script src="js/revolution/extensions/revolution.extension.actions.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.carousel.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.migration.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.navigation.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.parallax.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
  <script src="js/revolution/extensions/revolution.extension.video.min.js"></script>
<script src="js/bootstrapValidator.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jplayer/jquery.jplayer.min.js"></script>
<script src="js/jplayer/jplayer.playlist.min.js"></script>
<script src="js/jquery.scrollbar.min.js"></script>
<script src="js/main.js"></script>


<script src="libs/js/hovereffect/jquery.hoverdir.js"></script>
<script src="libs/js/hovereffect/modernizr.custom.97074.js"></script>
<script>
$(function() {
	$(' #da-thumbs > div ').each( function() { $(this).hoverdir(); } );
});
$(document).ready(function(){
	if($('.contenedor-1').css('display', 'none')){
		$('.contenidor-1').fadeToggle('slow','linear');
	}
});
</script>
</body>
</html>