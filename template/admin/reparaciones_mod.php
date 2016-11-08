<?php
include("libs/php/funcions.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.html");
}
$link=conecta();

$id_reparacion=$_POST['id'];
$nombre=utf8_decode($_POST['nombre']);
$id_marca=$_POST['marca'];
$id_modelo=$_POST['modelo'];
$precio=$_POST['precio'];
$fecham=$_POST['fecham'];
$creado=$_SESSION['usuarioa'];
$estado=$_POST['estado'];

$sql="update reparacion set id_marca='$id_marca', id_modelo='$id_modelo', nombre='$nombre', precio='$precio', fecha_mod='$fecham', mod_por='$creado', estado='$estado' where id_reparacion='$id_reparacion'";
$res0=busqueda($sql,$link);
if($res0){
	?><script>document.location.href="tarifas.php?mod=ok";</script><?php
}
else{
	?><script>document.location.href="tarifas.php?mod=no";</script><?php
}

?>