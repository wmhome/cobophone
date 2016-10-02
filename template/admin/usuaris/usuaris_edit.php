<?php
include("../libs/php/funcions_moel.php");
session_start();
ob_start();

if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}

$link=conecta();
$ids=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMLiB</title>

    <!-- WM CSS Lib -->
    <link href="../css/wmcsslib.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="../css/jquery.datatables.css" rel="stylesheet">
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
  		<?php include("includes/nav.php");?>
  	</header>
  	<div class="page-wrap" id="page-content-wrapper">
  	<div class="container">
  		<div class="page-header">
		  <h1>Usuarios <small>editar</small></h1>
		</div>
  		<?php
  		$sql0="select * from users where id_user='$ids'";
  		$res0=busqueda($sql0, $link);
  		$row0=recibir_array($res0);
  		$nombre=htmlentities($row0['nombre']);
  		$apellidos=htmlentities($row0['apellidos']);
  		$login=htmlentities($row['login']);
  		$pass=$row0['pass'];
  		$estado=$row0['estado'];
  		$tipo=$row0['tipo'];
  		?>
  		<form class="form-horizontal" enctype="multipart/form-data" method="post" action="usuaris_mod.php">
  			<div class="form-group">
  				<label for="id_user" class="col-sm-2 control-label">ID#</label>
  				<div class="col-sm-10">
  					<input type="text" readonly="readonly" class="form-control" name="id" id="id" value="<?php echo $ids;?>">
  				</div>
  			</div>
  			<div class="form-group">
			  	<label for="fecham" class="col-sm-2 control-label">Fecha Modificación</label>
			    <div class="col-sm-10">
			      <input type="text" readonly="readonly" class="form-control" name="fecham" id="fecham" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
			    </div>
			</div>
  			<div class="form-group">
  				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
  				<div class="col-sm-10">
  					<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre;?>">
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
  				<div class="col-sm-10">
  					<input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos;?>">
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="tipo" class="col-sm-2 control-label">Tipo</label>
  				<div class="col-sm-10">
  					<select name="tipo" id="tipo" class="form-control">
  						<option value="<?php echo $tipo;?>" selected="selected"><?php echo $tipo;?></option>
  						<option value="superusuario">Superusuario</option>
  						<option value="administrador">Administrador</option>
  						<option value="logistica">Logística</option>
  						<option value="comercial">Comercial</option>
  					</select>
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="login" class="col-sm-2 control-label">Login</label>
  				<div class="col-sm-10">
  					<input type="text" class="form-control" name="login" id="login" value="<?php echo $login;?>">
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="pass" class="col-sm-2 control-label">Cambiar contraseña</label>
  				<div class="col-sm-10">
  					<input type="password" class="form-control" name="pass" id="pass" value="<?php echo $pass;?>">
  				</div>
  			</div>
  			<div class="form-group">
			  	<label for="estado" class="col-sm-2 control-label">Estado</label>
			  	<div class="col-sm-10">
				  	<label class="radio-inline">
					  <input type="radio" name="estado" id="estado_on" value="activado" <?php if($row0['estado']=="activado"){?> checked <?php }?>> Activado
					</label>
					<label class="radio-inline">
					  <input type="radio" name="estado" id="estado_off" value="desactivado" <?php if($row0['estado']=="desactivado"){?> checked <?php }?>> Desactivado
					</label>
			  	</div>
			  </div>	
			  <div class="form-group">
				<div class="col-sm-6 col-md-offset-2">
					<button type="submit" name="enviauser" id="enviauser" class="btn btn-info"><span class="fa fa-pencil-square-o"></span> Modificar</button>
					<a href="usuaris.php" class="btn btn-default"><span class="fa fa-step-backward"></span> Volver al listado de usuarios</a>
				</div>
			</div>
  		</form>
  	</div>
  	</div>
  	</div>
  	<!-- Side nav for responsive views -->
    <div class="sb-slidebar sb-right sb-style-overlay sb-width-wide plm prm pbm mt52">
      <?php include("includes/sidenav-right.html");?>
    </div>
    <!-- Side nav -->
  	<footer class="footer">
  		<div class="container">
  			<p class="text-muted"><a href="http://www.whitemind.es" class="btn btn-icon" target="_blank">Create by WhiteMind.es </a></p>
  		</div>
  	</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/components/slidebars/slidebars.js"></script>
    <script>
	  (function($) {
	    $(document).ready(function() {
	      $.slidebars({
	        scrollLock: true // true or false
	      });
	      
		  
	    });
	  }) (jQuery);
	</script>
  </body>
</html>