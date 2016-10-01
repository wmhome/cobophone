<?php
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
session_start();
ob_start();

if (!$_SESSION['usuario']) $_SESSION['usuario']="Invitado";

$link=conecta();

$nombre=utf8_decode($_POST['nombre']);
$apellidos=utf8_decode($_POST['apellidos']);
$direccion=utf8_decode($_POST['direccion']);
$poblacion=utf8_decode($_POST['poblacion']);
$cp=$_POST['cp'];
$id_provincia=$_POST['provincia'];
$sql_pro="select provincia from provincias where id='$id_provincia'";
$res_pro=busqueda($sql_pro, $link);
$row_pro=recibir_array($res_pro);
$provincia=utf8_encode($row_pro['provincia']);
$pais=utf8_decode($_POST['pais']);
$fecham=$_POST['fecham'];
$id_cliente=$_SESSION['id_cliente'];
if($_POST['iddir']!=""){
	$id_dir=$_POST['iddir'];
	if(isset($_POST['moddir'])){
		echo "moddir iddir<br>";
		$sql="update direcciones set nombre='$nombre', apellidos='$apellidos', direccion='$direccion', poblacion='$poblacion', cp='$cp', provincia='$provincia', pais='$pais', fecha_mod='$fecham' where id_cliente='$id_cliente' and id_dir='$id_dir'";
		$res0=busqueda($sql,$link);
		if($res0){
			echo $sql;
			?><script>document.location.href="confirma.php?insert=ok&paso1=ok&id_dir=<?=$id_dir?>#formaPago";</script><?php
		}
		else{
			echo $sql;
			?><script>document.location.href="confirma.php?insert=no";</script><?php
		}
	}
}
else{
	if(isset($_POST['moddir'])){
		echo "moddir no iddir<br>";
		$sql="update clientes set nombre='$nombre', apellidos='$apellidos', direccion='$direccion', poblacion='$poblacion', cp='$cp', provincia='$provincia', pais='$pais', fecha_mod='$fecham' where id_cliente='$id_cliente'";
		$res0=busqueda($sql,$link);
		if($res0){
			echo $sql;
			?><script>document.location.href="confirma.php?insert=ok&paso1=ok#formaPago";</script><?php
		}
		else{
			echo $sql;
			?><script>document.location.href="confirma.php?insert=no";</script><?php
		}
	}
}
if(isset($_POST['newdir'])){
	$sqls="select max(id_dir) from direcciones";
	$ress=busqueda($sqls, $link);
	$rows=recibir_array($ress);
	$id_dir=$rows[0]+1;
	$sql="insert into direcciones (id_dir, id_cliente, nombre, apellidos, direccion, poblacion, cp, provincia, pais, fecha_mod) values ('$id_dir', '$id_cliente', '$nombre', '$apellidos', '$direccion', '$poblacion', '$cp', '$provincia', '$pais', '$fecham')";
	$res0=busqueda($sql,$link);
}
if($res0){
	//echo $sql;
	?><script>document.location.href="confirma.php?insert=ok&paso1=ok#formaPago";</script><?php
}
else{
	//echo $sql;
	?><script>document.location.href="confirma.php?insert=no";</script><?php
}
?>