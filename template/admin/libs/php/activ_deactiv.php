<?php
include("funcions.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}
$link=conecta();

$id=$_POST['id'];
$tipo=$_POST['tipo'];
$taula=$_POST['taula'];

if($taula=="usuarios") $idb="id_usuario";
if($taula=="marcas") $idb="id_marca";
if($taula=="modelos") $idb="id_modelo";
$sql="update $taula set estado='$tipo' where $idb='$id'";
$res=busqueda($sql,$link);

if($res){
	echo "Modificado correctamente";
}
else{
	echo "Ha ocurrido un error";
}
?>