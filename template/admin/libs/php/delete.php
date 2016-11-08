<?php
include("funcions.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.php");
}
$link=conecta();

$id=$_POST['id'];
$taula=$_POST['taula'];

if($taula=="usuarios") $idb="id_usuario";
if($taula=="marcas") $idb="id_marca";
if($taula=="modelos") $idb="id_modelo";
if($taula=="clientes") $idb="id_cliente";
if($taula=="direcciones") $idb="id";
if($taula=="blog") $idb="id_blog";
if($taula=="comanda") $idb="id_comanda";
if($taula=="grupo") $idb="id_grupo";if($taula=="grupo") $idb="id_grupo";
if($taula=="files"){
	$idb="id";
	$file = "/files/proyectos/" . $_POST['name'];
	$do = unlink($file);
	 
	if($do != true){
		echo "There was an error trying to delete the file" . $_POST['name'] . "<br />";
	}
}
$sql="delete from $taula where $idb='$id'";
$res=busqueda($sql,$link);

if($res){
	echo "Eliminado correctamente";
}
else{
	echo "Ha ocurrido algún error";
}
?>