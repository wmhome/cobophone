<?php
session_start();
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
//$id_comanda=$_GET['pszPurchorderNum'];
$id_comanda=$_GET['order'];
$jsid=$_GET['jsid'];
$_SESSION['carrito']->option=$_GET['opcion'];
/*
if($_GET['result']==2){
	$_SESSION['coderror_t']=$_GET['Coderror'];	
	if($_SESSION['coderror_t']==100) $texto="Operación rechazada, por Time Out";
	if($_SESSION['coderror_t']==101) $texto="Tarjeta cadudada, Operación denegada";
	if($_SESSION['coderror_t']==102) $texto="Operación denegada. Tarjeta en lista negra.";
	if($_SESSION['coderror_t']==107) $texto="Operación denegada. Llamar al emisor.";
	if($_SESSION['coderror_t']==114) $texto="Operación denegada. Error en datos, algunos de los datos no son correctos.";
	if($_SESSION['coderror_t']==180) $texto="Operación denegada. Tarjetamno válida, analizar el tipo de tarjeta.";
	if($_SESSION['coderror_t']==189) $texto="Tarjeta no permitida en autorización off-line.";
	if($_SESSION['coderror_t']==190) $texto="Tarjeta denegada. Diversos motivos, normalmente, no hay saldo en la tarjeta.";
	if($_SESSION['coderror_t']==191) $texto="Tarjeta denegada, no hay respuesta del host, reintentar la operación.";
	if($_SESSION['coderror_t']==201) $texto="Tarjeta caducada.";
	if($_SESSION['coderror_t']==202) $texto="Operación denegada, tarjeta capturada.";
	if($_SESSION['coderror_t']==290) $texto="Denegada, diversos motivos.";
	if($_SESSION['coderror_t']==300) $texto="Cierre con acuerdo, conciliación de acuerdo.";
	if($_SESSION['coderror_t']==301) $texto="Cierre con desacuerdo, llamar al centro de llamadas de Sistema 4B.";
	if($_SESSION['coderror_t']==302) $texto="No puede realizarse el cierre en este momento, existen operaciones pendientes.";
	if($_SESSION['coderror_t']==303) $texto="No se recibiorespuesta del HOST, repetir operación más tarde.";
	if($_SESSION['coderror_t']==304) $texto="No se han realizado transacciones, no hay operaciones a coniliar.";
	if($_SESSION['coderror_t']==400) $texto="Referéncia de compra duplicada.";
	if($_SESSION['coderror_t']==644) $texto="Formato de mensaje erróneo.";
	if($_SESSION['coderror_t']==687) $texto="Mensaje enviado nor econocido por el sistema, contactar con el centro de llamadas 4B.";
	if($_SESSION['coderror_t']==777) $texto="Operación cancelada.";
	if($_SESSION['coderror_t']==800) $texto="Error en la autenticación del usuario con tarjeta registrada en Visa o MasterCard secure code.";
	if($_SESSION['coderror_t']==801) $texto="La transacción no cumple el nivel de seguridad establecido por la entidad bancaria para este comercio.";
	if($_SESSION['coderror_t']==904) $texto="Mensaje erróneo de PUC, contacte con el sistema 4B.";
	if($_SESSION['coderror_t']==909) $texto="Error de sistema, intente la operación más tarde.";
	if($_SESSION['coderror_t']==913) $texto="Operación duplicada, contactar con el dentro de llamadas 4B.";
	if($_SESSION['coderror_t']==916) $texto="Error MAC, sincronizar/verificar l¡claves msc en el comercio y en 4B.";
	if($_SESSION['coderror_t']==944) $texto="Conciliación denegada, sesion no permitida.";
	if($_SESSION['coderror_t']==948) $texto="Fecha/hora del sistema no sincronizada.";
	if($_SESSION['coderror_t']==949) $texto="Fecha de caducidad de la tarjeta inválida).";
	$_SESSION['texto_denegado']=$texto;
}
*/
$link=conecta();
$sql="update comanda set autorizada=0 where id_comanda='$id_comanda'";
$result=busqueda($sql,$link);
if($result) echo "<p>OK</p>";
else echo "<p><b>ERROR</b></p>";
?>
<script>document.location.href="../index.php?compra=ko&id_comanda=<?=$id_comanda?>&jsid=<?=$jsid?>";</script>