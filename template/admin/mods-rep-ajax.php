<?php
include("libs/php/funcions.php");
//include("tienda/classCarrito.php");
session_start();
ob_start();
$link=conecta();
if($_POST['id_modelo']){
	$id_modelo=$_POST['id_modelo'];
	$id_marca=$_POST['id_marca'];
	$code=$_POST['code'];
	echo $code;


	$sql="select * from reparacion where id_modelo='$id_modelo' or id_marca='$id_marca'";
	$res=busqueda($sql,$link);
	echo $sql;
    while($row=recibir_array($res)){
        $id=$row['id_reparacion'];
        $data=utf8_encode($row['nombre']);
        $precio=$row['precio'];
        $idestado=$row['estado'];
        if($idestado==1) $estado='Activado';
        if($idestado==0) $estado='Desactivado';
        echo '<tr><td>'.$id.'</td><td>'.$data.'</td><td>'.$fecha_ini.'</td><td>'.$precio.'</td><td>'.$estado.'</td>';
        if($estado=="Activado"){
            $text_color="text-success";
            $action='<a href="#" class="deactivate text-danger" data-toggle="modal" data-target="#deactivate" rel="tooltip" data-original-title="Desactivar" data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$data.'"><i class="ico glyphicon glyphicon-ban-circle"></i></a>';
        }
        else if($estado=="Desactivado"){
            $text_color="text-danger";
            $action='<a href="#" class="activate text-success" data-toggle="modal" data-target="#activate" rel="tooltip" data-original-title="Activar"  data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$data.'"><i class="ico glyphicon glyphicon-ok"></i></a>';
        }
        echo '<td>
                <a href="reparacion_edit.php?id='.$row0['id_modelo'].'" rel="tooltip" data-original-title="Editar" class="mrs"><i class="ico glyphicon glyphicon-edit"></i></a>
                <a href="#" class="deleteuser mrs" data-toggle="modal" data-target="#myModal" rel="tooltip" data-original-title="Eliminar" data-user-id="'.$row0['id_modelo'].'" data-user-name="'.$data.'"><i class="ico glyphicon glyphicon-trash"></i></a>
                '.$action.'</td></tr>';
    }
}