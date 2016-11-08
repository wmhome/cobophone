<?php
include("libs/php/funcions.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.html");
}
$link=conecta();

$nombre=utf8_decode($_POST['nombre']);
$id_marca=$_POST['marca'];
$ref=$_POST['ref'];
$des=utf8_decode($_POST['editor0']);
$fechai=$_POST['fechai'];
$stock=$_POST['stock'];
$creado=$_SESSION['usuarioa'];
$estado=1;
$tipo=$_POST['tipo'];
$sqls="select max(id_modelo) from modelos";
$ress=busqueda($sqls, $link);
$rows=recibir_array($ress);
$id=$rows[0]+1;

//Imagenes
$target_path = "assets/img/productos/";
$target_path = $target_path . basename( $_FILES['img1']['name']); 
if(move_uploaded_file($_FILES['img1']['tmp_name'], $target_path)) { 
	echo "El archivo ". basename( $_FILES['img1']['name']). " ha sido subido<br>";
	$img1_name=$_FILES['img1']['name'];
	$img1_size=$_FILES['img1']['size'];
	$img1_formato=$_FILES['img1']['type'];
	$ubicacion='assets/img/productos/';
	$sqls="select max(id) from files";
	$ress=busqueda($sqls, $link);
	$rows=recibir_array($ress);
	$id_file=$rows[0]+1;
	$sql="insert into files (id, name, size, type, url, fecha_ini, creado_por, estado) values ('$id_file', '$img1_name', '$img1_size', '$img1_formato', '$ubicacion', '$fechai', '$creado','1')";
	$res=busqueda($sql,$link);
} else{
	echo "<br>Ha ocurrido un error, trate de nuevo!<br>";
}
if($_POST['mtarifas']==1){
	$sql0="insert into modelos (id_modelo, id_marca, id_file, ref, tipo, nombre, des, precio, fecha_ini, creado_por, estado) values ('$id', '$id_marca', '$id_file', '$ref', '$tipo', '$nombre', '$txt', '$precio', '$fechai', '$creado', '1')";
}
else if($_POST['ptienda']==1){
	//TODO
	$capacidad=$_POST['capacidad'];
	$precio=$_POST['precio'];
	$color=$_POST['color'];
	//
	echo "<br>Insertar productos para tienda online<br>";
}
$res0=busqueda($sql0,$link);
echo "<br>".$sql0;
if($res0){
	?><script>document.location.href="productos.php?mod=ok";</script><?php
}
else{
	?><script>document.location.href="productos.php?mod=no";</script><?php
}
?>