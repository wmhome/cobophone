<?php
include("../libs/php/funcions.php");
session_start();
ob_start();


$link=conecta();
?>
<div class="container-fluid contenidor-1" style="display:none;">
    <div class="row-fluid">
		<section class="galeria col-xs-12 pln prn da-thumbs" id="da-thumbs">
			<?php
	      	$sql="select * from marcas where estado=1";
	      	$res=busqueda($sql, $link);
	      	while($row=recibir_array($res)){
		      	$nombre=utf8_encode($row['nombre']);
		      	$id_file=$row['id_file'];
		      	$id_marca=$row['id_marca'];
		      	$sql_f="select * from files where id='$id_file'";
		      	$res_f=busqueda($sql_f, $link);
		      	$row_f=recibir_array($res_f);
		      	$src=$row_f['url'];
		      	$img=$row_f['name'];
		      	$image=$src.$img;
		      	echo "Hola: ".$image;
	      	?>
			<div>
				<a href="#" class="enlace" data-marca="<?=$id_marca?>">	
					<img src="<?=$image?>" alt="<?=$nombre?>">
					<div>
						<span class="inf">
							<p class="num"><?=$nombre?></p>
						</span>
					</div>
				</a>		
			</div>
			<?php
			}
			?>
		</section>
    </div>
</div><!-- .container -->
<script>
$(function() {
	$(' #da-thumbs > div ').each( function() { $(this).hoverdir(); } );
});
$(document).ready(function(){
	if($('.contenedor-1').css('display', 'none')){
		$('.contenidor-1').fadeToggle('slow','linear');
	}
	$('.enlace').on('click', function(){
		id_marca=$(this).attr('data-marca');
		//alert(id_marca);
		$('.contenidor-1').animate({width: 'toggle'});
		$.ajax({
			url: 'layout/modelos.php',
			data: {id : id_marca},
			type: 'POST',
			success : function(data) {
				$('.wrapper-1').html(data);
		    },
		});
	});
});
</script>