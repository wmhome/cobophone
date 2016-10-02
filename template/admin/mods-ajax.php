<?php
include("libs/php/funcions.php");
//include("tienda/classCarrito.php");
session_start();
ob_start();
$link=conecta();
if($_POST['id']){
	$id=$_POST['id'];
	$code=$_POST['code'];
	echo $code;


	$sql="select * from modelos where id_marca='$id'";
	$res=busqueda($sql,$link);
	echo '<option value="0">Escoge tu modelo</option>';
	while($row=recibir_array($res)){
		$id=$row['id_modelo'];
		$data=utf8_encode($row['nombre']);
		echo '<option value="'.$id.'">'.$data.'</option>';
	}
}