<?php
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
session_start();
ob_start();

if (!$_SESSION['usuario']) $_SESSION['usuario']="Invitado";

$link=conecta();
$id_dir=$_POST['id_dir'];
$id_cliente=$_SESSION['id_cliente'];
$_SESSION['id_dir']=$id_dir;
$sql="select * from direcciones where id_dir='$id_dir' and id_cliente='$id_cliente'";
$res=busqueda($sql, $link);
$row=recibir_array($res);
?>
<div class="form-group">
  	<label for="fecham" class="col-sm-2 control-label">Fecha</label>
    <div class="col-sm-6">
      <input type="text" readonly="readonly" class="form-control" name="fecham" id="fecham" placeholder="Fecha" value="<?php echo date('d/m/Y H:s');?>">
    </div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Nombre</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" readonly="readonly" name="nombre" id="nombre" value="<?=utf8_encode($row['nombre'])?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Apellidos</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" readonly="readonly" name="apellidos" id="apellidos" value="<?=utf8_encode($row['apellidos'])?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Dirección</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" readonly="readonly" name="direccion" id="direccion" value="<?=utf8_encode($row['direccion'])?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Código postal</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" readonly="readonly" name="cp" id="cp" value="<?=$row['cp']?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">País</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" readonly="readonly" name="pais" id="pais" value="<?=utf8_encode($row['pais'])?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Provincia</label>
	<div class="col-sm-6">
		<?php
			$provincia=utf8_encode($row['provincia']);
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
		$poblacion=utf8_encode($row['poblacion']);
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
	<label class="col-sm-2 control-label hidden">ID DIR</label>
	<div class="col-sm-6">
		<input type="hidden" class="form-control" readonly="readonly" name="iddir" id="iddir" value="<?=$_SESSION['id_dir']?>">
	</div>
</div>
<script>
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
</script>