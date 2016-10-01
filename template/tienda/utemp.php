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
$email=$_POST['email'];
$tel=$_POST['tel'];
$login=utf8_decode($_POST['login']);
$pass=$_POST['pass'];
$fechai=$_POST['fechai'];

$estado='temporal';
$sqls="select max(id_cliente) from clientes";
$ress=busqueda($sqls, $link);
$rows=recibir_array($ress);
$id=$rows[0]+1;


$sql="insert into clientes (id_cliente, nombre, apellidos, direccion, poblacion, cp, provincia, pais, email, tel, fecha_ini, estado) values ('$id', '$nombre', '$apellidos', '$direccion', '$poblacion', '$cp', '$provincia', '$pais', '$email', '$tel', '$fechai', '$estado')";
$res0=busqueda($sql,$link);

if($res0){
	$_SESSION['usuario']=htmlentities($nombre);
	$_SESSION['id_cliente']=$id;
	$_SESSION['estado']=$estado;
	?><script>document.location.href="confirma.php?insert=ok&paso1=ok";</script><?php
}
else{
	?><script>document.location.href="confirma.php?insert=no";</script><?php
}
?>