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
		$sql_1="select DISTINCT tipo as total from modelos where id_marca='$id_marca'";
		$res_1=busqueda($sql_1, $link);
		$data=mysql_num_rows($res_1);
		if($data > 1) $cols="col-sm-6";
		else if($data < 1) $cols="col-sm-12";
		?>
		<article class="content col-sm-12">
			<h3 class="text-center"><?=$marca?></h3>
			<?php
			for ($i=1;$i<=$data;$i++){
				while($row_1=mysql_fetch_assoc($res_1)){
					$tipo=utf8_encode($row_1['total']);
					?>
					<div class="<?=$cols?>">
						<div class="list-group">
							<a href="#" class="list-group-item active">
								<h4 class="list-group-item-heading cursor-default"><?=$tipo?></h4>
							</a>
						<?php
						$current_cat = null;
						$sql_mod="select * from modelos where id_marca='$id_marca' and tipo='$tipo'";
						$res_mod=busqueda($sql_mod, $link);
						while($row_mod=recibir_array($res_mod)){
						  	$nombre_modelo=utf8_encode($row_mod['nombre']);
						  	$id_modelo=$row_mod['id_modelo'];
						  	?>
								<a href="#" class="list-group-item enlace-2" data-marca="<?=$id_marca?>">
									<h4 class="list-group-item-heading"><?=$nombre_modelo?></h4>
								</a>
							<?php
							}
							?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</article>
		<article class="content col-sm-12">
			<hr>
			<div class="btns text-center">
				<button type="button" class="btn btn-primary btn-lg btn-return">Volver al listado de marcas</button>
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
			url: 'layout/marcas.php',
			data: {id : 0},
			type: 'POST',
			success : function(data) {
				$('.wrapper-1').html(data);
		    },
		});
	});
	$('.enlace-2').on('click', function(){
		id_marca=$(this).attr('data-marca');
		//alert(id_marca);
		$('.contenidor-1').animate({width: 'toggle'});
		$.ajax({
			url: 'layout/reparaciones.php',
			data: {id : id_marca},
			type: 'POST',
			success : function(data) {
				$('.wrapper-1').html(data);
		    },
		});
	});
});
</script>