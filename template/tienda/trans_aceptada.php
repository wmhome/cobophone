<?php
//Página que graba enm BBDD la transacción como autorizada
include("../libs/php/funcions_moel.php");
$link=conecta();
$consulta="UPDATE comanda SET autorizada='si' WHERE id_comanda='$_GET[PszPurchorderNum]'";
$result=busqueda($consulta,$link);
if($result) echo "<p>OK</p>";
else echo "<p><b>ERROR</b></p>";
