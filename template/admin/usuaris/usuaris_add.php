<?php
include("../libs/php/funcions_moel.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}
$link=conecta();

$nombre=utf8_decode($_POST['nombre']);
$apellidos=utf8_decode($_POST['apellidos']);
$tipo=$_POST['tipo'];
$login=utf8_decode($_POST['login']);
$pass=$_POST['pass'];
$fechai=$_POST['fechai'];
$creado=$_SESSION['usuarioa'];
$estado='activado';
$sqls="select max(id_user) from users";
$ress=busqueda($sqls, $link);
$rows=recibir_array($ress);
$id=$rows[0]+1;


$sql="insert into users (id_user, nombre, apellidos, tipo, fecha_ini, creado_por, estado, login, pass) values ('$id', '$nombre', '$apellidos', '$tipo', '$fechai', '$creado', '$estado', '$login', '$pass')";
$res0=busqueda($sql,$link);

if($res0){
	?><script>document.location.href="usuaris.php?insert=ok";</script><?php
}
else{
	?><script>document.location.href="usuaris.php?insert=no";</script><?php
}
?>