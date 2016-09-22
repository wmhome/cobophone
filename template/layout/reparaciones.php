<?php
include("../libs/php/funcions.php");
session_start();
ob_start();


$link=conecta();
$id_modelo=$_GET['id'];
?>
<div class="container contenidor-2">
	<div class="row">
		<?php
		$sql_mod="select * from modelos where id_modelo='$id_modelo'";
		$res_mod=busqueda($sql_mod, $link);
		$row_mod=recibir_array($res_mod);
		$id_marca=$row_mod['id_marca'];
		$nombre_modelo=utf8_encode($row_mod['nombre']);
		$id_file=$row_mod['id_file'];
		$sql_file="select * from files where id='$id_file'";
		$res_file=busqueda($sql_file, $link);
		$row_file=recibir_array($res_file);
		$url=$row_file['url'];
		$name_file=$row_file['name'];
		$image=$url.$name_file;
		?>
		<article class="content col-sm-12">
			<h3 class="text-center"><?=$nombre_modelo?></h3>
			<div class="row">
			<div class="col-sm-6">
				<img src="<?=$image?>" class="img-responsive centered">
			</div>
			<div class="col-sm-6">
				<p>En Cobophone te reparamos, arreglamos o actualizamos el <?=$nombre_modelo?>.</p>
				<p>Puedes traerlo en persona a nuestro establecimiento y dependiendo de la avería, lo reparamos en el momento.</p>
				<p>Si no estas en Madrid o no tienes tiempo para pasarte por nuestra tienda nuestra empresa de transporte te lo recoge nosotros te lo reparamos en nuestras instalaciones y te lo enviamos allí donde nos digas para que no tengas que preocuparte de nada, nosotros lo hacemos por ti.</p>
				<p>Ademas puedes ver el precio de tu reparacion en la lista pero recuerda que es orientativo ya que puede tener componentes dañados que solo se ven una vez abierto.</p>
			</div>
			</div>
			<table class="table table-hover table-striped" style="margin-top: 25px;">
			<thead>
				<tr>
					<th class="text-left">Tabla de precios de las distintas reparaciones que ofrecemos para el <?=$nombre_modelo?></th>
					<th>Reparación Express desde</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sql_2="select * from reparacion where id_marca='$id_marca'";
			$res_2=busqueda($sql_2, $link);
			while($row_2=recibir_array($res_2)){
			?>
			<tr>
				<td class="text-left"><?=utf8_encode($row_2['nombre'])?></td>
				<td><?=$row_2['precio']." €";?></td>
			</tr>
			<?php
			}
			?>
			</tbody>
			</table>
		</article>
		<article class="content col-sm-12">
			<hr>
			<div class="btns text-center">
				<a href="<?=$_SERVER['HTTP_REFERER']?>" type="button" class="btn btn-primary btn-lg btn-return">Volver al listado de modelos</a>
			</div>
		</article>
	</div>
</div>