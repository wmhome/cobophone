<?php
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
session_start();
ob_start();

if (!$_SESSION['usuario']) $_SESSION['usuario']="Invitado";

$link=conecta();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MO-EL SPAIN</title>

    <!-- WM CSS Lib -->
    <link href="../css/wmcsslib.css" rel="stylesheet">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div id="sb-site">
	  	<header>
	  		<?php include("../includes/navbar.php");?>
	  	</header>
	  	<div class="ccontent">
	  		<div class="bradcrumb breadcrumbv1">
	  			<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
				  <li class="active">Carrito de la compra</li>
				</ol>
				<h1 class="lead">Carrito</h1>
	  		</div>
		  	<div class="container ptm pbm mtm">
		  		<div class="row">
		  			<div class="col-sm-12">
		  				<div class="page-title">
						  <h2>Mi compra <small>revise el resumen de su compra.</small></h2>
						  <hr>
						</div>
		  			</div>
		  		</div>
				<?php
				$_SESSION['carrito']->imprime_carrito(1);
				?>
		  	</div>
	  	</div>
  	</div>
    <!-- /#wrapper -->
    <!-- Side nav for responsive views -->
    <div class="sb-slidebar sb-right sb-style-overlay sb-width-wide plm prm pbm xs-nav-up">
      <?php include("../includes/sidenav-right.php");?>
    </div>
    <!-- Side nav -->
    <footer class="footer footer-moel mtm">
  		<div class="container">
  			<?php include("../includes/footer.php");?>
  		</div>
  	</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/components/slidebars/slidebars.js"></script>
    <script src="../js/components/backstretch/jquery.backstretch.min.js"></script>
    <script src="../libs/jquery/moel.js"></script>
    <script>
	  (function($) {
	    $('.sb-slidebar').css('margin-top', '50px');
	    
	    $('.btn-pay').attr('disabled', 'disabled');
	    $('.btn-pay').addClass('disabled');
	    $('.terms').change(function(){
	    	if($(this).is(':checked')){
	    		$('.btn-pay').removeAttr('disabled');
	    		$('.btn-pay').removeClass('disabled');
	    	}
	    	else{
		    	$('.btn-pay').attr('disabled', 'disabled');
		    	$('.btn-pay').addClass('disabled');	
	    	}
	    });
	  }) (jQuery);
	</script>
  </body>
</html>