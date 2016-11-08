<?php
include("libs/php/funcions.php");
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


    <link rel="stylesheet" href="css/components/mfileupload/jquery.fileupload.css">
    <!-- Jasny Bootstrap for uploadfiles -->
    <link href="css/components/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="ckeditor/contents.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- WM CSS Lib -->
    <link href="css/wmhcsslib.css" rel="stylesheet">
  </head>
  <body>
  	<header>
  		<?php include("layout/header.php");?>
  	</header>
  	<div class="page-wrap" id="page-content-wrapper">
  	<div class="container">
  		<div class="page-header">
		  <h1>Productos <small>modificar</small></h1>
		</div>
		<?php
		$sql0="select * from modelos where id_modelo='$ids'";
		$res0=busqueda($sql0,$link);
		$row0=recibir_array($res0);
		$id_marca=$row0['id_marca'];
		$img1=$row0['id_file'];
		$sql1="select * from files where id='$img1'";
		$res1=busqueda($sql1, $link);
		$row1=recibir_array($res1);
		$file1=$row1['url'].$row1['name'];
		$sql_ma="select nombre from marcas where id_marca='$id_marca'";
		$res_ma=busqueda($sql_ma, $link);
		$row_ma=recibir_array($res_ma);
		$nombre_marca=utf8_encode($row_ma['nombre']);
		?>
  		<form class="form-horizontal" method="post" name="servicios" enctype="multipart/form-data" action="productos_mod.php">
  		<div class="form-group">
		  	<label for="id" class="col-sm-2 control-label">ID#</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" readonly="readonly" name="id" id="id" placeholder="Identificador producto" value="<?php echo utf8_encode($row0['id_modelo']);?>">
		    </div>
		</div>
		<div class="form-group">
		  	<label for="nombre" class="col-sm-2 control-label">Referéncia</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="ref" id="ref" placeholder="Referéncia producto" value="<?php echo $row0['ref'];?>">
		    </div>
		</div>
    	<div class="form-group">
		  	<label for="nombre" class="col-sm-2 control-label">Nombre</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre producto" value="<?php echo utf8_encode($row0['nombre']);?>">
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Marca</label>
			<div class="col-sm-10">
				<select class="form-control" name="marca" id="marca">
					<option value="<?=$id_marca?>" selected><?=$nombre_marca?></option>
					<?php
					$sql_ma="select * from marcas where id_marca!='$id_marca' order by id_marca asc";
					$res_ma=busqueda($sql_ma, $link);
					while($row_ma=recibir_array($res_ma)){
						$id_marca=$row_ma['id_marca'];
						$nombre_marca=utf8_encode($row_ma['nombre']);
						?>
						<option value="<?=$id_marca?>"><?=$nombre_marca?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
			<!--
		<div class="form-group">
			<label for="familia" class="col-sm-2 control-label">Familia</label>
			<div class="col-sm-10">
				<select name="familia" id="familia" class="form-control">
				<option value="<?php echo $row0['id_familia'];?>" selected="selected"><?php echo utf8_encode($row3['nombre']);?></option>
				<?php
				$sql_f="select * from familia where id_familia!='$id_familia' order by nombre";
				$res_f=busqueda($sql_f, $link);
				while($row_f=recibir_array($res_f)){
				?>
				<option value="<?php echo $row_f['id_familia'];?>"><?php echo utf8_encode($row_f['nombre']);?></option>
				<?php
				}
				?>
				</select>
			</div>
		</div>
		-->
    	<div class="form-group">
		  	<label for="fecham" class="col-sm-2 control-label">Fecha modificación</label>
		    <div class="col-sm-10">
		      <input type="text" readonly="readonly" class="form-control" name="fecham" id="fecham" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
		    </div>
		</div>
		<div class="form-group">
		  	<label for="precio" class="col-sm-2 control-label">Precio</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio producto" value="<?php echo $row0['precio'];?>">
		    </div>
		</div>
			<!--
		<div class="form-group">
		  	<label for="stock" class="col-sm-2 control-label">Stock</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="stock" id="stock" placeholder="Stock producto" value="<?php echo $row0['stock'];?>">
		    </div>
		</div>
		-->
		<div class="form-group">
			<label class="col-sm-2 control-label" for="img1">Imagen producto</label>
			<div class="col-sm-10">
				<div class="fileinput fileinput-new" data-provides="fileinput">
				  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
				    <img data-src="<?=$file1?>" src="<?=$file1?>" alt="...">
				  </div>
				  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				  <div>
				    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="img1" id="img1"></span>
				    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				  </div>
				</div>
			</div>
		</div>
			<!--
		<div class="form-group">
			<label class="col-sm-2 control-label" for="img1">Imagen descripción</label>
			<div class="col-sm-10">
				<div class="fileinput fileinput-new" data-provides="fileinput">
				  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
				    <img data-src="<?php echo "../$file2";?>" src="<?php echo "../$file2";?>" alt="...">
				  </div>
				  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
				  <div>
				    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="img2"></span>
				    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				  </div>
				</div>
			</div>
		</div>
		-->
		<div class="form-group">
			<label class="col-sm-2 control-label">Descripción</label>
			<div class="col-sm-10">
				<textarea class="ckeditor form-control" cols="80" id="editor0" name="editor0" rows="10" placeholder="Descripción...">
				<?php echo utf8_encode($row0['des']); ?></textarea>
			</div>
		</div>
			<!--
		<div class="form-group">
			<label class="col-sm-2 control-label">Características técnicas</label>
			<div class="col-sm-10">
				<textarea class="ckeditor form-control" cols="80" id="editor1" name="editor1" rows="10" placeholder="Características técnicas...">
				<?php echo utf8_encode($row0['caractec']); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Texto destacado</label>
			<div class="col-sm-10">
				<textarea class="ckeditor form-control" cols="80" id="editor2" name="editor2" rows="10" placeholder="Texto descriptivo...">
				<?php echo utf8_encode($row0['txt']); ?></textarea>
			</div>
		</div>
		-->
		<div class="form-group">
		  	<label for="estado" class="col-sm-2 control-label">Estado</label>
		  	<div class="col-sm-10">
			  	<label class="radio-inline">
				  <input type="radio" name="estado" id="estado_on" value="1" <?php if($row0['estado']=="1"){?> checked <?php }?>> Activado
				</label>
				<label class="radio-inline">
				  <input type="radio" name="estado" id="estado_off" value="0" <?php if($row0['estado']=="0"){?> checked <?php }?>> Desactivado
				</label>
		  	</div>
		  </div>	
		  <div class="form-group">
			<div class="col-sm-6 col-md-offset-2">
				<button type="submit" name="editaproducto" id="editaproducto" class="btn btn-info"><span class="fa fa-pencil-square-o"></span> Modificar</button>
				<a href="productos.php" class="btn btn-default"><span class="fa fa-step-backward"></span> Volver al listado de productos</a>
			</div>
		</div>
	</form>
  	</div>
  	</div>
	<footer class="site-footer">
		<div class="container">
			<p class="text-muted text-center mtl">&copy; WhiteMind - <a href="http://www.whitemind.es" target="_blank">www.whitemind.es</a> - <a href="http://www.wmhome.es" target="_blank">www.wmhome.es</a></p>
		</div>
	</footer>
	<!-- Side nav for responsive views -->
	<div class="sb-slidebar sb-right sb-style-overlay sb-width-wide plm prm pbm mt52">
		<?php include("layout/side-navs.html");?>
	</div>
	<!-- Side nav -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/components/slidebars/slidebars.js"></script>
    <!-- Jasny bootstrap for uploadfiles -->
	<script src="libs/js/components/jasny/jasny-bootstrap.min.js"></script>
	<!-- Images holder -->
	<script src="libs/js/components/holder/holder.js"></script>
	
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/lang/es.js"></script>
    <script>
	  (function($) {
	    $(document).ready(function() {

	      $("[rel=tooltip]").tooltip({ placement: 'right'});
	    
	    var editor = CKEDITOR.replace('editor0');  
	    //var editor = CKEDITOR.replace('editor1');
	    //var editor2 = CKEDITOR.replace('editor2');
	    CKFinder.setupCKEditor( editor, 'ckfinder/' ) ;
	    });
	  }) (jQuery);
	</script>
  </body>
</html>