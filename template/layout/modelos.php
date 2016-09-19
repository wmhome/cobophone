<?php
include("../libs/php/funcions.php");
session_start();
ob_start();


$link=conecta();
?>
<div class="container contenidor-2" style="display:none;">
	<div class="row">
		<article class="content col-sm-12 col-md-12">
			<ul class="list-unstyled">
			<?php
			$id_marca=$_POST['id'];
			echo "MARCA: ".$id_marca;
			$sql_mod="select * from modelos where id_marca='$id_marca'";
			$res_mod=busqueda($sql_mod, $link);
			while($row_mod=recibir_array($res_mod)){
		  	$nombre_modelo=utf8_encode($row_mod['nombre']);
		  	$id_modelo=$row_mod['id_modelo'];
			?>
				<li>
					<p><a href="#"><?=$nombre_modelo?></a></p>
				</li>
			<?php
			}
			?>
			</ul>
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
	})
});
</script>