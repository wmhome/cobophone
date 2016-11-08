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
    <!-- WM CSS Lib -->
    <link href="css/wmhcsslib.css" rel="stylesheet">
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
  		<div class="page-header">
		  <h1>Productos <small>añadir</small></h1>
		</div>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#mtarifas" aria-controls="mtarifas" role="tab" data-toggle="tab">Modelo Tarifas</a></li>
			<li role="presentation"><a href="#ptienda" aria-controls="ptienda" role="tab" data-toggle="tab" class="disabled">Producto tienda online</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="mtarifas">
				<form class="form-horizontal mtl" method="post" name="productosAdd" enctype="multipart/form-data" action="productos_add.php">
					<input type="hidden" name="mtarifas" id="mtarifaso" value="1">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Fecha Creación</label>
						<div class="col-sm-10">
							<input type="text" readonly="readonly" class="form-control" name="fechai" id="fechai" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Referéncia</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ref" id="ref" placeholder="Referéncia producto" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Marca</label>
						<div class="col-sm-10">
							<select class="form-control" name="marca" id="marca">
								<option value="0">Escoge una opción</option>
								<?php
								$sql_ma="select * from marcas order by id_marca asc";
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
					<div class="form-group">
						<label class="control-label col-sm-2">Tipo</label>
						<div class="col-sm-10">
							<select class="form-control" name="tipo" id="tipo">
								<option value="0">Escoge una opción</option>
								<option value="smartphone">Smartphone</option>
								<option value="tablet">Tablet</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre producto" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="img1">Imagen producto</label>
						<div class="col-sm-10">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
									<img data-src="holder.js/100%x100%" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
								<div>
									<span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="img1" id="img1"></span>
									<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6 col-md-offset-2">
							<button type="submit" name="enviaservicios" id="enviaempresa" class="btn btn-info"><span class="fa fa-plus"></span> Añadir</button>
							<a href="productos.php" class="btn btn-default"><span class="fa fa-step-backward"></span> Volver al listado de productos</a>
						</div>
					</div>
				</form>
			</div>
			<div role="tabpanel" class="tab-pane" id="ptienda">
				<form class="form-horizontal mtl" method="post" name="productosAdd" enctype="multipart/form-data" action="productos_add.php">
					<input type="hidden" name="ptienda" id="ptiendao" value="1">
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Fecha Creación</label>
						<div class="col-sm-10">
							<input type="text" readonly="readonly" class="form-control" name="fechai" id="fechai" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Referéncia</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ref" id="ref" placeholder="Referéncia producto" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Marca</label>
						<div class="col-sm-10">
							<select class="form-control" name="marca" id="marca">
								<option value="0">Escoge una opción</option>
								<?php
									$sql_ma="select * from marcas order by id_marca asc";
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

					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre producto" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Capacidades / Precio</label>
						<div class="section-prices col-xs-12 col-sm-10 pln prn">
							<div class="col-xs-6">
								<input type="text" class="form-control" name="capacidad" id="capacidad" placeholder="Capacidad ej. 16GB">
							</div>
							<div class="col-xs-6">
								<input type="text" class="form-control" name="precio" id="precio" placeholder="Precio">
							</div>
						</div>
						<div class="col-xs-10 col-sm-offset-2">
							<button type="button" class="btn btn-default add-cat mts">Añadir capacidad</button>
						</div>
					</div>

					<!--
                <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Precio</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio producto">
                    </div>
                </div>
                    -->
					<div class="form-group">
						<label for="stock" class="col-sm-2 control-label">Stock</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" name="stock" id="stock" placeholder="Stock disponible del producto">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="img1">Imagen producto</label>
						<div class="col-sm-10">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
									<img data-src="holder.js/100%x100%" alt="...">
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
                    <label class="col-sm-2 control-label" for="img2">Imagen descripción</label>
                    <div class="col-sm-10">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img data-src="holder.js/100%x100%" alt="...">
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
							<textarea class="ckeditor form-control" cols="80" id="editor0" name="editor0" rows="10" placeholder="Descripción..."></textarea>
						</div>
					</div>
					<!--
                <div class="form-group">
                    <label class="col-sm-2 control-label">Características técnicas</label>
                    <div class="col-sm-10">
                        <textarea class="ckeditor form-control" cols="80" id="editor1" name="editor1" rows="10" placeholder="Características técnicas..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Texto descriptivo</label>
                    <div class="col-sm-10">
                        <textarea class="ckeditor form-control" cols="80" id="editor2" name="editor2" rows="10" placeholder="Texto servicios..."></textarea>
                    </div>
                </div>
                    -->
					<div class="form-group">
						<div class="col-sm-6 col-md-offset-2">
							<button type="submit" name="enviaservicios" id="enviaempresa" class="btn btn-info"><span class="fa fa-plus"></span> Añadir</button>
							<a href="productos.php" class="btn btn-default"><span class="fa fa-step-backward"></span> Volver al listado de productos</a>
						</div>
					</div>
				</form>
			</div>
		</div>
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
    <!-- Scripts for datatables -->
    <script src="libs/js/components/datatable/datatable.js"></script>
    <script src="libs/js/components/chosen/chosen.jquery.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/lang/es.js"></script>
  	<script src="ckeditor/ckfinder/ckfinder.js"></script>
    <!-- Jasny bootstrap for uploadfiles -->
	<script src="libs/js/components/jasny/jasny-bootstrap.min.js"></script>
	<!-- Images holder -->
	<script src="libs/js/components/holder/holder.js"></script>

    <script>
	  (function($) {
		  var num = 1;
			$(document).ready(function() {

			  $("[rel=tooltip]").tooltip({ placement: 'right'});

			  var editor = CKEDITOR.replace('editor0');
			  //var editor = CKEDITOR.replace('editor1');
			  //var editor2 = CKEDITOR.replace('editor2');
			  CKFinder.setupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
			});

			$('.add-cat').click(function(){

			  $.ajax({
				  url: 'layout/add-variant.html',
				  success: function(data) {
					  $('.section-prices').append(data).slideDown(5000);
					  $('.variant').find('.precio0').removeClass('precio0').addClass('precio'+num).attr('name', 'precio'+num).delay(6000);
					  num +=1;
				  }
			  });
			});
		  $(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
			  if ($(this).hasClass("disabled")) {
				  e.preventDefault();
				  return false;
			  }
		  });
	  }) (jQuery);
	</script>
  </body>
</html>