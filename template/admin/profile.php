<?php
include("libs/php/funcions.php");
session_start();
ob_start();

if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}

$link=conecta();
$ids=$_GET['id'];

$sql0="select * from usuarios where id_usuario='$ids'";
$res0=busqueda($sql0, $link);
$row0=recibir_array($res0);
$nombre=utf8_encode($row0['nombre']);
$apellidos=utf8_encode($row0['apellidos']);
$login=utf8_encode($row['login']);
$pass=$row0['pass'];
$estado=$row0['estado'];
$tipo=$row0['tipo'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMLiB</title>

    <!-- WM CSS Lib -->
    <link href="css/wmhcsslib.css" rel="stylesheet">
	  <!-- Slide Menus CSS -->
	  <link href="css/components/slidemenu/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="page-wrap o-wrapper" id="wrapper">
		<header>
			<?php include("layout/header.php");?>
		</header>
  		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">
					  <h1><? echo $nombre." ".$apellidos;?> <small>profile</small></h1>
					</div>

					<form class="form-horizontal" enctype="multipart/form-data" method="post" action="usuaris_mod.php">
						<div class="form-group">
							<label for="id" class="col-sm-2 control-label">ID#</label>
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
								  <input type="radio" name="estado" id="estado_on" value="activado" <?php if($row0['estado']==1){?> checked <?php }?>> Activado
								</label>
								<label class="radio-inline">
								  <input type="radio" name="estado" id="estado_off" value="desactivado" <?php if($row0['estado']==0){?> checked <?php }?>> Desactivado
								</label>
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-6 col-md-offset-2">
								<button type="submit" name="enviauser" id="enviauser" class="btn btn-info"><span class="fa fa-pencil-square-o"></span> Modificar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
  		</div>
  	</div>
	<!-- Side nav for responsive views -->
	<div class="sb-slidebar sb-right sb-style-overlay sb-width-wide plm prm pbm mt52">
		<?php include("layout/side-navs.html");?>
	</div>
	<!-- Side nav -->
	<footer class="site-footer">
		<div class="container">
			<p class="text-muted text-center mtl">&copy; WhiteMind - <a href="http://www.whitemind.es" target="_blank">www.whitemind.es</a> - <a href="http://www.wmhome.es" target="_blank">www.wmhome.es</a></p>
		</div>
	</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="libs/js/bootstrap.min.js"></script>
	<script src="libs/js/components/slidemenu/menu.js"></script>
	<script src="libs/js/components/slidemenu/side-navs.js"></script>
  </body>
</html>