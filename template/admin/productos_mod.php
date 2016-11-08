<?php
include("libs/php/funcions.php");
session_start();
ob_start();
if (!$_SESSION['usuarioa'] || $_SESSION['usuarioa']=="Invitado"){
	header("Location:index.html");
}
$link=conecta();

$id_modelo=$_POST['id'];
$nombre=utf8_decode($_POST['nombre']);
$id_marca=$_POST['marca'];
$precio=$_POST['precio'];

$des=utf8_decode($_POST['editor0']);
$fecham=$_POST['fecham'];
$creado=$_SESSION['usuarioa'];
$estado=$_POST['estado'];
$stock=$_POST['stock'];
$ref=$_POST['ref'];

//Imagenes
if($_FILES['img1']['name']!=""){
    echo "name=".$_FILES['img1']['name'];
    $target_path = "assets/img/productos/";
    $target_path = $target_path . basename( $_FILES['img1']['name']);
    if(move_uploaded_file($_FILES['img1']['tmp_name'], $target_path)) {
        echo "El archivo ". basename( $_FILES['img1']['name']). " ha sido subido";
        $img1_name=$_FILES['img1']['name'];
        $img1_size=$_FILES['img1']['size'];
        $img1_formato=$_FILES['img1']['type'];
        $ubicacion='assets/img/productos/';
        $sqls="select max(id) from files";
        $ress=busqueda($sqls, $link);
        $rows=recibir_array($ress);
        $id_file=$rows[0]+1;
        $sql="insert into files (id, name, size, type, url, fecha_ini) values ('$id_file', '$img1_name', '$img1_size', '$img1_formato', '$ubicacion', '$fecham')";
        $res=busqueda($sql,$link);
        $sql10="update modelos set id_file='$id_file' where id_modelo='$id_modelo'";
        $res10=busqueda($sql10, $link);

    } else{
        echo "Ha ocurrido un error, trate de nuevo!";
    }
}

$sql="update modelos set id_marca='$id_marca', ref='$ref', nombre='$nombre', des='$des', precio='$precio', fecha_mod='$fecham', mod_por='$creado', estado='$estado' where id_modelo='$id_modelo'";
$res0=busqueda($sql,$link);
if($res0){
	?><script>document.location.href="productos.php?mod=ok";</script><?php
}
else{
	?><script>document.location.href="productos.php?mod=no";</script><?php
}

?>