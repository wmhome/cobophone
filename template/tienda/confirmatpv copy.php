<?php
//include("../../libs/php/funcions_moel.php");
//include("classCarrito.php");
session_start();
ob_start();


// Posted data
global $HTTP_POST_VARS;
$id_comanda=$_SESSION['carrito']->id_comanda;
$fecha=$_SESSION['carrito']->fecha_titulo;
$total_compra=$_SESSION['carrito']->total_compra();
$gastos_envio=$_SESSION['carrito']->calcular_gatos_envio();
$iva=round(($total_compra*0.21),2);
$total=$total_compra + $gastos_envio + $iva;
$total=number_format($total, 2, '', '');
//Redsys 
// Se incluye la librería
include 'apiRedsys.php';
// Se crea Objeto
$miObj = new RedsysAPI;
	
// Valores de entrada
$fuc="341278919";
$terminal="1";
$moneda="978";
$trans="0";
$url="http://www.mo-el.es/tienda/recepcion.php";
$urlOK="http://www.mo-el.es/tienda/trans_autorizada.php?order=<?=$id_comanda?>";
$urlKO="http://www.mo-el.es/tienda/trans_denegada.php?order=<?=$id_comanda?>";
$id=time();
$amount=$total;

// Se Rellenan los campos
$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
$miObj->setParameter("DS_MERCHANT_ORDER",strval($id));
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
$miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);		
$miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);

//Datos de configuración
$version="HMAC_SHA256_V1";
$kc = 'q4vKyflyhfWS2mL8AZ+H31eRNxXOckzV';//Clave recuperada de CANALES
// Se generan los parámetros de la petición
$request = "";
$params = $miObj->createMerchantParameters();
$signature = $miObj->createMerchantSignature($kc);
?>
<form class="form-horizontal" name="frm" action="https://sis.redsys.es/sis/realizarPago" method="POST" target="_blank">
	<input type="hidden" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
	<input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
	<input type="hidden" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<div class="col-sm-8 col-md-offset-2">
					<input type="submit" class="btn btn-success btn-block mtm mbl" name="aceptar" class="benviar" value="Finalizar compra" />
				</div>
			</div>
		</div>
	</div>
</form>