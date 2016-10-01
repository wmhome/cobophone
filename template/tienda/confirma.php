<?php
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
session_start();
ob_start();

if (!$_SESSION['usuario']) $_SESSION['usuario']="Invitado";
else{
	$id_cliente=$_SESSION['id_cliente'];
}
$link=conecta();
if($_GET['paso1']=="ok"){
	$breadcrumb="Proceso de compra 1/2";
}
if($_GET['paso2']=="ok"){
	$breadcrumb="Proceso de compra 2/2";
}
$id_comanda=$_SESSION['carrito']->id_comanda;
$fecha=$_SESSION['carrito']->fecha_titulo;
$total_compra=$_SESSION['carrito']->total_compra();
$gastos_envio=$_SESSION['carrito']->calcular_gatos_envio();
$iva=round(($total_compra*0.21),2);
$base=$total_compra - $iva;
$total=$total_compra + $gastos_envio;
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
				  <li><a href="carrito.php">Carrito</a></li>
				  <li class="active"><?php echo $breadcrumb;?></li>
				</ol>
				<h1 class="lead"><?php echo $breadcrumb;?></h1>
	  		</div>
		  	<div class="container ptm pbm mtm">
		  		<div class="row">
		  			<div class="col-sm-12">
		  				<?php	    			
						if($_SESSION['usuario']=="Invitado" || !$_SESSION['usuario']){
						?>
						<div class="alert alert-nuna" align="center"><p>Antes de seguir con el proceso de compra debes de identificarte con tu usuario y contraseña en nuestro <a href="#login" role="button" data-toggle="modal">formulario de autentificación</a>, si no tienes puedes darte de alta en mo-el.es en el siguiente formulario, <a href="../regitsro.php">formulario de registro</a>, de esta manera tus datos de envío quedarán registrados para próximas compras.</p><p>También puedes proceder con la compra facilitándonos los datos de envio.</p></div>
						<form class="form-horizontal valform" id="addusertemp" enctype="multipart/form-data" method="post" action="utemp.php">
							<?php
							if($_SESSION['id_dir']){
								$id_dir=$_SESSION['id_dir'];
								$sql="select * from direcciones where id_dir='$id_dir' and id_cliente=$_SESSION[id_cliente]";
							}
							else $sql="select * from clientes where id_cliente='$_SESSION[id_cliente]'";
							$res=busqueda($sql,$link);
							$row=recibir_array($res);
							?>
							<fileset>
								<legend>Datos de envío</legend>	
							</fileset>
							<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
								  	<label for="fecham" class="col-sm-2 control-label">Fecha Creación</label>
								    <div class="col-sm-8">
								      <input type="text" readonly="readonly" class="form-control" name="fechai" id="fechai" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
								    </div>
								</div>
							</div>
							</div>
							<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="nombre">Nombre</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="nombre" id="nombre">
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="apellidos">Apellidos</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="apellidos" id="apellidos">
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="direccion">Dirección</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="direccion" id="direccion">
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="pais">País</label>
				  				<div class="col-sm-8">
				  					<input type="text" readonly="readonly" class="form-control disabled" name="pais" id="pais" value="Espa&ntilde;a">
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="provincia">Provincia</label>
				  				<div class="col-sm-8">
				  					<?php
				  					$sql_pro="select * from provincias order by provincia asc";
				  					$res_pro=busqueda($sql_pro, $link);
				  					?>
				  					<select name="provincia" id="provincia" class="form-control provincia">
				  						<option value="">Seleccione una provincia</option>
				  					<?
				  					while($row_pro=recibir_array($res_pro)){
					  					?>
					  					<option value="<?=utf8_encode($row_pro['id'])?>"><?=utf8_encode($row_pro['provincia'])?></option>
					  					<?
				  					}
				  					?>
				  					</select>
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="poblacion">Población</label>
				  				<div class="col-sm-8">
				  					<select name="poblacion" id="poblacion" class="poblacion form-control">
							    		<option value="" selected="selected">Selecciones su población</option>
							    	</select>
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="cp">Código postal</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="cp" id="cp">
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="email">Email</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="email" id="email">
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="tel">Teléfono</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="tel" id="tel">
				  					<p class="text-muted"><small>Necesario para que el transportista se ponga en contacto con ud. para la entrega.</small></p>
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
				  				<label class="col-sm-2 control-label" for="nif">NIF o CIF</label>
				  				<div class="col-sm-8">
				  					<input type="text" class="form-control" name="nif" id="nif">
				  					<p class="text-muted"><small>Necesario para la generación de factura.</small></p>
				  				</div>
				  			</div>
				  			</div>
				  			</div>
				  			<div class="row">
				  			<div class="col-sm-12">
				  			<div class="form-group">
								<div class="col-sm-8 col-md-offset-2">
									<button type="submit" name="enviauser" id="enviauser" class="btn btn-success btn-block"><span class="fa fa-plus"></span> Enviar</button>
								</div>
							</div>
				  			</div>
				  			</div>
						</form>
						<?php
						}
						else{
							
							if($_GET['paso1']=="ok"){
								
								
								?>
								<fieldset>
					        		<legend>Resumen compra</legend>
					        	</fieldset>
								<table class="table table-condensed">
									<tbody>
										<tr>
											<td>Total compra</td>
											<td class="text-info"><?=$total?> &euro;</td>
										</tr>
										<tr>
											<td>Identificador del pedido</td>
											<td class="text-info"><?=$id_comanda?></td>
										</tr>
										<tr>
											<td>Fecha</td>
											<td class="text-info"><?=$fecha?></td>
										</tr>
									</tbody>
								</table>
			
								<fieldset>
					        		<legend>Verifica datos de envío</legend>
					        	</fieldset>
					        	<div class="row">
					        	<div class="seldirs mlxl mbm">
					        	<label class="control-label mrm">Escoge una dirección de envío</label>
					        	
								<?php
								$sql0="select * from clientes where id_cliente='$id_cliente'";
								$res0=busqueda($sql0, $link);
								$row0=recibir_array($res0);
								if(isset($_GET['id_dir'])){
									if(isset($_GET['id_dir'])) $id_dir=$_GET['id_dir'];
									if(isset($_POST['id_dir'])) $id_dir=$_POST['id_dir'];
									$sql1="select * from direcciones where id_cliente='$id_cliente' and id_dir='$id_dir'";
									$res0=busqueda($sql1, $link);
									$row0=recibir_array($res0);
									$def="";
								}
								else{
									$def="checked='checked'";
									$alt="";
								}
								$sqld="select * from direcciones where id_cliente='$id_cliente'";
								$resd=busqueda($sqld, $link);
								$numrows=mysql_num_rows($resd);
								$a=2;
								?>
								<label class="radio-inline">
								  <input type="radio" class="dir1" name="inlineRadioOptions" id="inlineRadio1" value="option1" <?=$def?>> Dirección 1
								</label>
								<?php
								while($rowd=recibir_array($resd)){
								?>
								<label class="radio-inline">
								  <input type="radio" class="dir1" name="inlineRadioOptions" id="inlineRadiox" value="<?=$rowd['id_dir']?>" <?=$alt?>> Dirección <?=$a?>
								</label>
								<?php
								$a++;
								}
								?>
								</div>
					        	</div>
								<form class="form-horizontal valform form-mod-dir" id="formcart" enctype="multipart/form-data" method="post" action="direcciones.php">
									<div class="formulario-pago">
									<div class="form-group">
									  	<label for="fecham" class="col-sm-2 control-label">Fecha</label>
									    <div class="col-sm-6">
									      <input type="text" readonly="readonly" class="form-control" name="fecham" id="fecham" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
									    </div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Nombre</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly="readonly" name="nombre" id="nombre" value="<?=utf8_encode($row0['nombre'])?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Apellidos</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly="readonly" name="apellidos" id="apellidos" value="<?=utf8_encode($row0['apellidos'])?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Dirección</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly="readonly" name="direccion" id="direccion" value="<?=utf8_encode($row0['direccion'])?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">País</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly="readonly" name="pais" id="pais" value="<?=utf8_encode($row0['pais'])?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Provincia</label>
										<div class="col-sm-6">
											<?php
											$provincia=utf8_encode($row0['provincia']);
						  					$sql_pro0="select id from provincias where provincia='$provincia' order by provincia asc";
						  					$res_pro0=busqueda($sql_pro0, $link);
						  					$row_pro0=recibir_array($res_pro0);
						  					?>
						  					<select name="provincia" id="provincia" class="form-control provincia" readonly="readonly" disabled="disabled">
						  						<option value="<?=$row_pro0['id']?>"><?=$provincia?></option>
						  					<?
						  					$sql_pro="select * from provincias where provincia!='$provincia' order by provincia asc";
						  					$res_pro=busqueda($sql_pro, $link);
						  					while($row_pro=recibir_array($res_pro)){
							  					?>
							  					<option value="<?=$row_pro['id']?>"><?=utf8_encode($row_pro['provincia'])?></option>
							  					<?
						  					}
						  					?>
						  					</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Población</label>
										<div class="col-sm-6">
											<?php
											$poblacion=utf8_encode($row0['poblacion']);
											$sql_pob="select id from municipios where municipio='$poblacion'";
											$res_pob=busqueda($sql_pob, $link);
											$row_pob=recibir_array($res_pob);
											?>
											<select name="poblacion" id="poblacion" class="poblacion form-control" readonly="readonly" disabled="disabled">
									    		<option value="<?=$poblacion?>" selected="selected"><?=$poblacion?></option>
									    	</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Código postal</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly="readonly" name="cp" id="cp" value="<?=$row0['cp']?>">
										</div>
									</div>
									<div class="form-group">
										
										<div class="col-sm-6">
											<input type="hidden" class="form-control" readonly="readonly" name="iddir" id="iddir" value="<?=$row0['id_dir']?>">
										</div>
									</div>
									</div>
									<div class="form-group">
										<div class="col-sm-6 col-md-offset-2">
											<button type="button" class="btn btn-moel btn-moel-default btn-back" style="display: none;"><span class="fa fa-step-backward"></span></button>
											<button type="button" class="btn btn-moel btn-moel-primary btn-mod-dir">Modificar</button>
											<button type="submit" class="btn btn-success btn-mod-dir-send" name="moddir" style="display: none;">Modificar</button>
											<?php
											if($_SESSION['estado']=="activado"){
											?>
											<button type="button" class="btn btn-moel btn-moel-primary btn-new-dir">Crear nuevos datos de envío</button>
											<button type="submit" class="btn btn-success btn-new-dir-send" name="newdir" style="display: none;">Crear nuevos datos de envío</button>
											<?php
											}
											?>
										</div>
									</div>
								</form>
								<?php
							}
						
						?>
		  			</div>
		  			<div class="col-sm-12 pago" id="formaPago">
					        <form method="post" enctype="multipart/form-data" action="confirma.php" name="forma" class="form-horizontal">
					        	<fieldset>
					        		<?php
						        	if($row0['rolcrea']!='comercial'){
							        	?>
						        		<legend>Escoge forma de pago y procede</legend>
						        		<?php
					        		}
					        		else if($row0['rolcrea']=='comercial'){
						        		?>
						        		<legend>Procede con la venta</legend>
						        		<?php
					        		}
					        		?>
					        	</fieldset>
					        	<div class="form-group">
					        		<?php
						        	if($row0['rolcrea']!='comercial'){
						        	?>
							        <label class="col-sm-2 control-label">Forma de pago: </label>
							        <div class="col-sm-6">
							        	
								        <select class="form-control" name="forma_p" id="forma_p" onchange="javascript:forma_pagament()">
								        <?php echo $_GET['option'];?>
								        <?php if(!$_GET['option']){?><option selected="selected" value="Escoge forma de pago">Escoge forma de pago</option><option value="targeta_credito">Tarjeta de crédito</option>
								        <option value="PayPal">PayPal</option><? }
										else if($_GET['option']=="targeta_credito"){ ?> <option selected="selected" value="Tarjeta de crédito">Tarjeta de crédito</option><option value="PayPal">PayPal</option><? } 
								        if($_GET['option']=="PayPal"){?><option selected="selected" value="PayPal">PayPal</option><option value="targeta_credito">Tarjeta de crédito</option><?php }
								        ?>
								        </select>
							        </div>
							        	<?php
								        }
								        else if($row0['rolcrea']=='comercial'){
									        ?>
									        <a href="confirma.php?option=comercial" class="btn btn-success btn-block" title="mostrap, matamosquitos">Finaliza venta</a>
									        <?php
								        }
								        ?>
					        	</div>
						        <input type="hidden" name="id_c" value="<? echo $id_comanda?>" />
						        <input type="hidden" name="fecha" value="<? echo $fecha?>" />
						        <input type="hidden" name="total" value="<? echo $total?>" />
					        </form>
						
					        <?
					        $id_comanda=$_GET['id_comanda'];
							$total_compra=$_SESSION['carrito']->calcular_gatos_envio()+$row['total'];
							$gastos_envio=$_SESSION['carrito']->calcular_gatos_envio();
							
							$total_compra=round($total_compra*100)/100;
							$gastos_envio=round($gastos_envio*100)/100;
							if($_SESSION['factura']=="no") $fa=0;
							if($_SESSION['factura']=="si") $fa=1;
							
							if ($_GET['option']=="targeta_credito"){
								$sql_c="select * from linea_comanda where id_comanda='$id_comanda'";
								//echo $sql_c;
								$res_c=busqueda($sql_c,$link);
								$numero=mysql_num_rows($res_c);
								//echo "Lineas comanda: ".$numero."<br>";
								if($numero > 0){
									//echo "si consulta";
								}
								else{
									//echo "no consulta";
									$_SESSION['carrito']->confirmar();
								} 
								if($_SESSION['id_dir']) $id_dir=$_SESSION['id_dir'];
								else $id_dir=0;
								$forma=$_GET['option'];
								$ssql="update comanda set forma='$forma', id_dir='$id_dir' where id_comanda='$id_comanda'";
								$res=busqueda($ssql,$link);
								
								//<h2 style="color:#F00;">Este módulo está en versión simulación, disculpen las moléstias.</h2>
								?>
					            <p class="help-block muted text-center">A continuación se le redigirá a la página de pago del banco, donde podrá realizar el pago de forma rápida y segura.</p>
								<?php
								include("confirmatpv.php");
							}
							
							if($_GET['option']=="PayPal"){
								$sql_c="select * from linea_comanda where id_comanda='$id_comanda'";
								//echo $sql_c;
								$res_c=busqueda($sql_c,$link);
								$numero=mysql_num_rows($res_c);
								//echo "Lineas comanda: ".$numero."<br>";
								if($numero > 0){
									//echo "si consulta";
								}
								else{
									//echo "no consulta";
									$_SESSION['carrito']->confirmar();
								} 
								
								//$ssql="update envio set forma='$_GET[option]' where id_comanda='$row[id_comanda]'";
								//$res=busqueda($ssql,$link);
								//echo "ID DIR:" .$_SESSION['id_dir'];
								if($_SESSION['id_dir']) $id_dir=$_SESSION['id_dir'];
								else $id_dir=0;
								$ssql="update comanda set forma='$_GET[option]', id_dir='$id_dir' where id_comanda='$id_comanda'";
								//echo $ssql;
								$res=busqueda($ssql,$link);
								
								?><p class="help-block muted text-center">A continuación se le redigirá a la página de pago de PayPal, donde podrá realizar el pago de forma rápida y segura.</p>
					            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> 
									<input type="hidden" name="cmd" value="_xclick">
									<input type="hidden" name="subtotal" value="<?=$total?>">
									<input type="hidden" name="business" value="FPKGH8H9ARWG2">
									
									<input type="hidden" name="item_name" value="Compra en MO-EL Spain">
									<input type="hidden" name="item_number" value="<?=$id_comanda?>"> 
									<input type="hidden" name="amount" value="<?=$total?>">
									<input type="hidden" name="first_name" value="<?=$row['nombre']?>"> 
									<input type="hidden" name="last_name" value="<?=$row['apellidos']?>">
									<input type="hidden" name="address1" value="<?=$row['direccion']?>">  
									<input type="hidden" name="city" value="<?=$row['poblacion']?>">
									<input type="hidden" name="state" value="<?=$row['provincia']?>">
									<input type="hidden" name="country" value="<?=utf8_encode($row['pais'])?>">
									<input type="hidden" name="zip" value="<?=$row['cp']?>"> 
									<input type="hidden" name="email" value="<?=$row['email']?>"> 
									<input type="hidden" name="return" value="http://www.mo-el.es/tienda/trans_autorizada.php?order=<?=$id_comanda?>">
									<input type="hidden" name="cancel_return" value="http://www.mo-el.es/tienda/trans_denegada.php?order=<?=$id_comanda?>">
									<input type="hidden" name="currency_code" value="EUR" />
									<button type="submit" name="submit" class="btn btn-success btn-block">Finalizar Compra</button>
								</form>
					          <?	
							}
							if($_GET['option']=='comercial'){
								if($_SESSION['id_dir']) $id_dir=$_SESSION['id_dir'];
								else $id_dir=0;
								$forma="Pago contado";
								$ssql="update comanda set forma='$forma', id_dir='$id_dir' where id_comanda='$id_comanda'";

								$res=busqueda($ssql,$link);
								$_SESSION['carrito']->confirmar();
								?><script>document.location.href="../index.php?venta=ok";</script><?php
							}
						}				
						?>
					</div>
		  		</div>
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
    <script src="../libs/jquery/script.js"></script>
    <script src="../js/components/validate/dist/jquery.validate.js"></script>
    <script src="../libs/jquery/moel.js"></script>
    <script>
	  (function($) {
	    $('.sb-slidebar').css('margin-top', '50px');
	    
	    $('.btn-mod-dir').on('click', function() {
		    $('.form-mod-dir').find('input[type="text"]').removeAttr('readonly');
		    $('.form-mod-dir').find('select').removeAttr('readonly');
		    $('.form-mod-dir').find('select').removeAttr('disabled');
		    $(this).hide('slow');
		    $('.btn-mod-dir-send').show('slow');
		    $('.btn-back').show('slow');
		    $('.btn-new-dir').attr('disabled', 'disabled').removeClass('btn-info').addClass('btn-default');
		    $('.pago').hide('slow');
	    });
	    $('.btn-back').on('click', function() {
			$('.form-mod-dir').find('input[type="text"]').attr('readonly', 'readonly');
			$('.form-mod-dir').find('select').attr('readonly', 'readonly');
			$('.form-mod-dir').find('select').attr('disabled', 'disabled');
		    //$('.btn-mod-dir').removeClass('btn-success').addClass('btn-info');
		    $(this).hide('slow');
		    $('.btn-new-dir-send').hide('slow');
		    $('.btn-new-dir').show('slow');
		    $('.btn-mod-dir-send').hide('slow');
		    $('.btn-mod-dir').show('slow');
		    $('.btn-mod-dir').removeAttr('disabled').removeClass('btn-default').removeClass('btn-success').addClass('btn-info');
		    $('.btn-new-dir').removeAttr('disabled').removeClass('btn-default').removeClass('btn-success').addClass('btn-info');
		    $('.pago').show('slow'); 
	    });
	    $('.btn-new-dir').on('click', function() {
		    $('.form-mod-dir').find('input[type="text"]').removeAttr('readonly').val('');
		    $(this).hide('slow');
		    $('.btn-new-dir-send').show('slow');
		    $('.btn-back').removeClass('hidden').show('slow');
		    $('.btn-mod-dir').attr('disabled', 'disabled').removeClass('btn-info').addClass('btn-default');
		    $('.pago').hide('slow');
		    var d = new Date();
			var month = d.getMonth()+1;
			var day = d.getDate();
			var hour = d.getHours();
			var minutes = d.getMinutes();
			var output = (day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' + d.getFullYear() + ' ' + hour + ':' + minutes;
		    $('#fecham').val(output).attr('readonly', 'readonly');
	    });
	    $('.dir1').on('change', function(){
	    	var id_dir = $(this).val();
	    	if(id_dir=='option1'){
		    	document.location.href='confirma.php?paso1=ok';
	    	}
	    	else{
	    		$.ajax({
				  type: "POST",
				  url: "canvidir.php",
				  data: { id_dir: id_dir }
				})
				  .done(function( msg ) {
				    //alert(msg);
				    $('.formulario-pago').html(msg);
				  });
		    	//document.location.href='confirma.php?paso1=ok&id_dir='+id_dir;
	    	}
	    });
	    $("#addusertemp").validate({
	    	rules: {
	    		nombre: {
		    		required: true,
		    		minlength: 3
	    		},
		    	apellidos: {
		    		required: true,
			    	minlength: 6 
		    	},
		    	direccion: {
					required: true,
					minlength: 5
				},
				poblacion: "required",
				provincia: "required",
				pais: "required",
				cp: {
					required: true,
					minlength: 5,
					maxlength: 5,
					number: true
				},
				email: {
		    		required: true,
		    		email: true
	    		},
	    		tel: {
		    		required: true,
		    		minlength: 9,
					maxlength: 9,
					number: true
	    		}
	    	},
	    	messages: {
	    		nombre: {
		    		required: "Este campo es obligatorio",
		    		minlength: "Debe de introducir al menos 3 caráteres."
	    		},
			    apellidos: {
			    	required: "Este campo es obligatorio",
			      	minlength: "Debe de introducir al menos 6 caráteres."
			    },
			    direccion: {
			    	required: "Este campo es obligatorio",
			      	minlength: "Debe de introducir al menos 6 caráteres."
			    },
			    poblacion: "Este campo es obligatorio",
			    provincia: "Este campo es obligatorio",
			    pais: "Este campo es obligatorio",
			    cp: {
					required: "Este campo es obligatorio",
					minlength: "Debe de introducir al menos 5 caráteres numéricos.",
					maxlength: "Debe de 5 caráteres.",
					number: "Solo admite carácteres numéricos"
				},
				email: {
		    		required: "Este campo es obligatorio",
		    		email: "Por favor, introduzca una dirección de mail correcta."
	    		},
				tel: {
					required: "Este campo es obligatorio",
					minlength: "Debe de introducir al menos 9 caráteres numéricos.",
					maxlength: "Debe de 9 caráteres.",
					number: "Solo admite carácteres numéricos"
				}
			}
			
	    });
	    $("#formcart").validate({
	    	rules: {
	    		nombre: {
		    		required: true,
		    		minlength: 3
	    		},
		    	apellidos: {
		    		required: true,
			    	minlength: 6 
		    	},
		    	direccion: {
					required: true,
					minlength: 5
				},
				pais: "required",
				poblacion: "required",
				provincia: "required",
				pais: "required",
				cp: {
					required: true,
					minlength: 5,
					maxlength: 5,
					number: true
				}
				
	    	},
	    	messages: {
	    		nombre: {
		    		required: "Este campo es obligatorio",
		    		minlength: "Debe de introducir al menos 3 caráteres."
	    		},
			    apellidos: {
			    	required: "Este campo es obligatorio",
			      	minlength: "Debe de introducir al menos 6 caráteres."
			    },
			    direccion: {
			    	required: "Este campo es obligatorio",
			      	minlength: "Debe de introducir al menos 6 caráteres."
			    },
			    pais: "Este campo es obligatorio",
			    poblacion: "Este campo es obligatorio",
			    provincia: "Este campo es obligatorio",
			    pais: "Este campo es obligatorio",
			    cp: {
					required: "Este campo es obligatorio",
					minlength: "Debe de introducir al menos 5 caráteres numéricos.",
					maxlength: "Debe de 5 caráteres.",
					number: "Solo admite carácteres numéricos"
				}
			}
			
	    });
	    
	    $(".provincia").change(function(){
			var id=$(this).val();
			var code=$(".pais").val();
			var dataString='id='+id+'&code=ESP';
			$.ajax({
				type: "POST",
				url: "../pob-ajax.php",
				data: dataString,
				cache: false,
				success: function(html){
    				$(".poblacion").html(html);
				}
			});
		});
	  }) (jQuery);
	</script>
    <script language=JavaScript>
	function calc() { 
	vent=window.open('','tpv','width=725,height=600,scrollbars=no,resizable=yes,status=yes,menubar=no,location=no');
	document.forms[0].submit();}
	</script>
  </body>
</html>