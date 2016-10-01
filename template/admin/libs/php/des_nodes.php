<?php
include("../../libs/php/funcions_moel.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}
$link=conecta();

$id=$_POST['id'];
$destacado=$_POST['destacado'];
$taula=$_POST['taula'];

if($taula=="users") $idb="id_user";
if($taula=="productos") $idb="id_producto";
if($taula=="familia") $idb="id_familia";
if($taula=="clientes") $idb="id_cliente";
if($taula=="direcciones") $idb="id";
if($taula=="blog") $idb="id_blog";
if($taula=="grupo") $idb="id_grupo";
$sql="update $taula set destacado='$destacado' where $idb='$id'";
$res=busqueda($sql,$link);

if($res){
	echo "Modificado correctamente";
}
else{
	echo "Ha ocurrido un error";
}
?>