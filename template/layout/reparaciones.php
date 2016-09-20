<?php
include("../libs/php/funcions.php");
session_start();
ob_start();


$link=conecta();
$id_marca=$_POST['id'];
?>
<div class="container contenidor-2" style="display:none;">
	<div class="row">
		<?php
		$sql_0="select nombre from marcas where id_marca='$id_marca'";
		$res_0=busqueda($sql_0, $link);
		$row_0=recibir_array($res_0);
		$marca=utf8_encode($row_0[0]);
		$sql_mod="select nombre from modelos where id_marca='$id_marca'";
		$res_mod=busqueda($sql_mod, $link);
		$row_mod=recibir_array($res_mod);
		$nombre_modelo=utf8_encode($row_mod['nombre']);
		?>
		<article class="content col-sm-12">
			<h3 class="text-center"><?=$nombre_modelo?></h3>
			<table class="table table-hover table-striped">
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
<script>
$(document).ready(function(){
	$('.contenidor-2').animate({width: 'toggle'});
	$('.btn-return').on('click', function(){
		$('.contenidor-2').fadeToggle('slow', 'linear');
		$.ajax({
			url: 'layout/modelos.php',
			data: {id : 0},
			type: 'POST',
			success : function(data) {
				$('.wrapper-1').html(data);
		    },
		});
	});
	$('.enlace-2').on('click', function(){
		id_marca=$(this).attr('data-modelo');
		//alert(id_marca);
		$('.contenidor-1').animate({width: 'toggle'});
		$.ajax({
			url: 'layout/reparaciones.php',
			data: {id : id_modelo},
			type: 'POST',
			success : function(data) {
				$('.wrapper-1').html(data);
		    },
		});
	});
});
</script>