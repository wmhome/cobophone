<?php
include("../../libs/php/funcions_moel.php");
session_start();
ob_start();
$RegistrosAMostrar=4;
$con=conecta();
//estos valores los recibo por GET
if(isset($_GET['pag'])){
    $RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
    $PagAct=$_GET['pag'];
    //caso contrario los iniciamos
}else{
    $RegistrosAEmpezar=0;
    $PagAct=1;
}

$query = "select * from productos where estado='activado' order by id_producto desc LIMIT $RegistrosAEmpezar, $RegistrosAMostrar";

$Resultado=mysql_query($query, $con);
echo "<table border='1px'>";
while($MostrarFila=mysql_fetch_array($Resultado)){
    echo "<tr>";
    echo "<td>".$MostrarFila['nombre']."</td>";
    /*if ($PagAct == 1)
        echo "<td>".$MostrarFila['post_title']."</td>";
    else*/
        echo "<td>".utf8_encode($MostrarFila['nombre'])."</td>";
    echo "<td>".$MostrarFila['fecha']."</td>";
    echo "</tr>";
}
echo "</table>";

$NroRegistros=mysql_num_rows(mysql_query("SELECT * FROM table",$con));
$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
$Res=$NroRegistros%$RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
if($Res>0) $PagUlt=floor($PagUlt)+1;

//desplazamiento
echo "<a onclick=\"Pagina('1')\">Primero</a> ";
if($PagAct>1) echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";
?>