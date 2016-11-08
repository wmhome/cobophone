<?php
include("libs/php/funcions.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.html");
}
$link=conecta();

$id_marca=$_POST['marca'];
$id_modelo=$_POST['modelo'];
$nombre=utf8_decode($_POST['nombre']);
$precio=$_POST['precio'];
$fechai=$_POST['fechai'];
$creado=$_SESSION['usuarioa'];
$estado=1;
$sqls="select max(id_reparacion) from reparacion";
$ress=busqueda($sqls, $link);
$rows=recibir_array($ress);
$id=$rows[0]+1;


$sql="insert into reparacion (id_reparacion, id_modelo, id_marca, nombre, precio, fecha_ini, creado_por, estado) values ('$id', '$id_modelo', '$id_marca', '$nombre', '$precio', '$fechai', '$creado', '$estado')";
$res0=busqueda($sql,$link);

if($res0){
    ?><script>document.location.href="tarifas.php?insert=ok";</script><?php
}
else{
    ?><script>document.location.href="tarifas.php?insert=no";</script><?php
}
?>