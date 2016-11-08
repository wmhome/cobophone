<?php
include("libs/php/funcions.php");
session_start();
ob_start();

if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}

$link=conecta();
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
    <link href="css/estil.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="css/jquery.datatables.css" rel="stylesheet">
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
		<div class="container mbm">
			<?php
			if($_GET['mod']=='ok' || $_GET['insert']=='ok'){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<span class="fa fa-check"></span> La consulta se ha realizado con éxito.
			</div>
			<?php
			}
			else if($_GET['mod']=='no' || $_GET['insert']=='no'){
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<span class="fa fa-exclamation"></span> Ha ocurrido algún problema, vuela a intentarlo en unos minutos.
			</div>
			<?php
			}
			?>
			<div class="page-header">
			  <h1>Productos <small>listado</small><a class="btn btn-info pull-right mtm" href="productos_new.php"><span class="fa fa-plus"></span> Añadir producto</a></h1>
			</div>
			<?php
			$sql0="select * from modelos order by id_modelo asc";
			$res0=busqueda($sql0, $link);
			?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="table">
					<thead>
						<tr>
							<th>ID#</th>
							<th>Imagen</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>
								Precio
							</th>
							<th>Stock</th>
							<th>Fecha creación</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while($row0=recibir_array($res0)){
							$id_marca=$row0['id_marca'];
							$id_modelo=$row0['id_modelo'];
							$nombre=utf8_encode($row0['nombre']);
							$estado=$row0['estado'];
							$destacado=$row0['destacado'];
							$img1=$row0['id_file'];
							$sql_ma="select nombre from marcas where id_marca='$id_marca'";
							$res_ma=busqueda($sql_ma, $link);
							$row_ma=recibir_array($res_ma);
							$marca=utf8_encode($row_ma[0]);
							if($estado==1){
								$text_color="text-success";
								$action='<a href="#" class="deactivate text-danger mrs" data-toggle="modal" data-target="#deactivate" rel="tooltip" data-original-title="Desactivar" data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$nombre.'"><i class="ico glyphicon glyphicon-ban-circle"></i></a>';
							}
							else if($estado==0){
								$text_color="text-danger";
								$action='<a href="#" class="activate text-success mrs" data-toggle="modal" data-target="#activate" rel="tooltip" data-original-title="Activar"  data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$nombre.'"><i class="ico glyphicon glyphicon-ok"></i></a>';
							}
							if($destacado==1){
								$action_more='<a href="#" class="nodestacar text-success mrs" data-toggle="modal" data-target="#nodestacar" rel="tooltip" data-original-title="Dejar de destacar producto" data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$nombre.'"><i class="fa fa-bookmark"></i></a>';
							}
							else if($destacado==0){
								$action_more='<a href="#" class="destacar text-muted mrs" data-toggle="modal" data-target="#destacar" rel="tooltip" data-original-title="Destacar producto"  data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$nombre.'"><i class="fa fa-bookmark-o"></i></a>';
							}
							$sql3="select * from files where id='$img1'";
							$res3=busqueda($sql3, $link);
							$row3=recibir_array($res3);
							$file1=$row3['url'].$row3['name'];
						?>
						<tr>
							<td><?php echo $row0['id_modelo'];?></td>
							<td><img class="img-responsive img-rounded img-taula centered" data-src="<?=$file1?>" src="<?=$file1?>" alt="<?php echo utf8_encode($row0['nombre']);?>" style="height: 100px;"></td>
							<td><?php echo $marca;?></td>
							<td><?php echo utf8_encode($row0['nombre']);?></td>
							<td><?php echo $row0['precio'];?> €</td>
							<td><?php echo $row0['stock'];?></td>
							<td><?php echo $row0['fecha_ini'];?></td>
							<td class="<?php echo $text_color;?>"><?php echo $row0['estado'];?></td>
							<td>
								<a href="productos_edit.php?id=<?php echo $row0['id_modelo'];?>" rel="tooltip" data-original-title="Editar" class="mrs"><i class="ico glyphicon glyphicon-edit"></i></a>
								<a href="#" class="deleteuser mrs" data-toggle="modal" data-target="#myModal" rel="tooltip" data-original-title="Eliminar" data-user-id="<?php echo $row0['id_modelo'];?>" data-user-name="<?php echo $nombre;?>"><i class="ico glyphicon glyphicon-trash"></i></a>
								<?php echo $action;?>
								<?php echo $action_more;?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
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
  	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Eliminar producto</h4>
	      </div>
	      <div class="modal-body">
	        ¿Seguro que quieres eliminar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
	        <button type="button" class="btn btn-danger delete-user"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="activate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Activar producto</h4>
	      </div>
	      <div class="modal-body">
	        ¿Deaseas activar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
	        <button type="button" class="btn btn-success activate-user"><i class="glyphicon glyphicon-ok"></i> Activar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel">Desactivar producto</h4>
	      </div>
	      <div class="modal-body">
	        ¿Deaseas desactivar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
	        <button type="button" class="btn btn-danger deactivate-user"><i class="glyphicon glyphicon-ban-circle"></i> Desactivar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="destacar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="destacarLabel">Destacar producto</h4>
	      </div>
	      <div class="modal-body">
	        ¿Deaseas destacar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
	        <button type="button" class="btn btn-success des-prod"><i class="glyphicon glyphicon-ok"></i> Activar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="nodestacar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="nodestacarLabel">No destacar producto</h4>
	      </div>
	      <div class="modal-body">
	        ¿Deaseas dejar de destacar el producto: <strong class="username"></strong>, con la id: <strong class="userid"></strong>?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-ban-circle"></i> Cancelar</button>
	        <button type="button" class="btn btn-danger nodes-prod"><i class="glyphicon glyphicon-ban-circle"></i> Desactivar</button>
	      </div>
	    </div>
	  </div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="libs/js/bootstrap.min.js"></script>
    <!-- Scripts for datatables -->
    <script src="libs/js/components/datatable/datatable.js"></script>
    <script src="libs/js/components/chosen/chosen.jquery.min.js"></script>

  	<script src="libs/js/components/slidemenu/menu.js"></script>
  	<script src="libs/js/components/slidemenu/side-navs.js"></script>
    <script>
	  (function($) {
		  $(document).ready(function() {
	      $("[rel=tooltip]").tooltip({ placement: 'right'});

	      var table = $('#table1').DataTable({
		      "sPaginationType": "full_numbers"
		  });
		  //Sergi
		    $('.deleteuser').click(function(){
		    	var username = $(this).attr('data-user-name');
		    	var userid = $(this).attr('data-user-id');
		    	$('.username').html(username);
		    	$('.userid').html(userid);
		    	$('.delete-user').attr('data-user-id', userid);
		    });
		    $('.activate, .deactivate').click(function(){
		    	var username = $(this).attr('data-user-name');
		    	var userid = $(this).attr('data-user-id');
		    	$('.username').html(username);
		    	$('.userid').html(userid);
		    	$('.activate-user, .deactivate-user').attr('data-user-id', userid);
		    });
		    $('.destacar, .nodestacar').click(function(){
		    	var username = $(this).attr('data-user-name');
		    	var userid = $(this).attr('data-user-id');
		    	$('.username').html(username);
		    	$('.userid').html(userid);
		    	$('.des-prod, .nodes-prod').attr('data-user-id', userid);
		    });
		    $('.activate-user').click(function(){
		    	var userid = $(this).attr('data-user-id');
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/activ_deactiv.php",
				  data: { id: userid, tipo: "1", taula: "modelos" }
				})
				  .done(function( msg ) {
				    $('#activate').delay(2000).modal('hide');
				    $('#activate').on('hidden.bs.modal', function (e) {
					   location.reload();
					   $('.alert-success').show('slow');
					});
				  });
		    });
		    $('.deactivate-user').click(function(){
		    	var userid = $(this).attr('data-user-id');
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/activ_deactiv.php",
				  data: { id: userid, tipo: "0", taula: "modelos" }
				})
				  .done(function( msg ) {
				    $('#deactivate').delay(2000).modal('hide');
				    $('#deactivate').on('hidden.bs.modal', function (e) {
					   location.reload();
					   $('.alert-success').show('slow');
					});
				  });
		    });
		    $('.des-prod').click(function(){
		    	var userid = $(this).attr('data-user-id');
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/des_nodes.php",
				  data: { id: userid, destacado: 1, taula: "modelos" }
				})
				  .done(function( msg ) {
				    $('#destacar').delay(2000).modal('hide');
				    $('#destacar').on('hidden.bs.modal', function (e) {
					   location.reload();
					   $('.alert-success').show('slow');
					});
				  });
		    });
		    $('.nodes-prod').click(function(){
		    	var userid = $(this).attr('data-user-id');
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/des_nodes.php",
				  data: { id: userid, destacado: 0, taula: "modelos" }
				})
				  .done(function( msg ) {
				    $('#nodestacar').delay(2000).modal('hide');
				    $('#nodestacar').on('hidden.bs.modal', function (e) {
					   location.reload();
					   $('.alert-success').show('slow');
					});
				  });
		    });
		    $('.delete-user').click(function(){
		    	var userid = $(this).attr('data-user-id');
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/delete.php",
				  data: { id: userid, taula: "modelos" }
				})
				  .done(function( msg ) {
				    $('#myModal').delay(2000).modal('hide');
				    $('#myModal').on('hidden.bs.modal', function (e) {
					   location.reload();
					   
					});
				  });
				  $('.alert-success').show('slow');
		    });
		    $('.btnadd').on('click', function(){
		    	var a = $(this).attr('data-prod-id');
		    	$('#'+a).val( parseInt($('#'+a).val(), 10) + 1);
		    	var orden = parseInt($('#'+a).val());
		    	var prodid = a;
		    	//alert(orden);
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/orden.php",
				  data: { id: prodid, orden: orden, taula: "modelos" }
				})
				  .done(function( msg ) {
				  	$('.alert-success').show('slow');
				    //alert("ok");
				  });
		    });
		    $('.btnminus').on('click', function(){
		    	var a = $(this).attr('data-prod-id');
		    	var cnt = parseInt($('#'+a).val());
		    	if(cnt>0) $('#'+a).val( parseInt($('#'+a).val(), 10) - 1);
		    	var orden = parseInt($('#'+a).val());
		    	var prodid = a;
		    	//alert(orden);
		    	$.ajax({
				  type: "POST",
				  url: "libs/php/orden.php",
				  data: { id: prodid, orden: orden, taula: "modelos" }
				})
				  .done(function( msg ) {
				  	$('.alert-success').show('slow');
				    //alert("ok");
				  });
		    });
		    // Chosen Select
		    $("select[name|='table1_length']").chosen({
		      'min-width': '100px',
		      'white-space': 'nowrap',
		      disable_search_threshold: 10
		    });
	    });
	  }) (jQuery);
	</script>
  </body>
</html>