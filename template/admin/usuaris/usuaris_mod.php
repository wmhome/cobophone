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
$fecham=$_POST['fecham'];
$creado=$_SESSION['usuarioa'];
$estado=$_POST['estado'];
$id_user=$_POST['id'];


$sql="update users set nombre='$nombre', apellidos='$apellidos', tipo='$tipo', fecha_mod='$fecha_m', mod_por='$creado', estado='$estado', login='$login', pass='$pass' where id_user='$id_user'";
$res0=busqueda($sql,$link);

if($res0){
	?><script>document.location.href="usuaris.php?mod=ok";</script><?php
}
else{
	?><script>document.location.href="usuaris.php?mod=no";</script><?php
}
?>