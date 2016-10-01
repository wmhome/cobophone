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
include_once('Tpv.php');

try{
    //Key de ejemplo
    $key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';

    $redsys = new Tpv();
    $redsys->setAmount($total);
    $redsys->setOrder(time());
    $redsys->setMerchantcode('341278919'); //Reemplazar por el código que proporciona el banco
    $redsys->setCurrency('978');
    $redsys->setTransactiontype('0');
    $redsys->setTerminal('1');
    $redsys->setMethod('C'); //Solo pago con tarjeta, no mostramos iupay
    $redsys->setNotification('http://www.mo-el.es/tienda/recepcion.php'); //Url de notificacion
    $redsys->setUrlOk('http://www.mo-el.es/tienda/trans_autorizada.php?order=<?=$id_comanda?>'); //Url OK
    $redsys->setUrlKo('http://localhost/ko.php'); //Url KO
    $redsys->setVersion('HMAC_SHA256_V1');
    $redsys->setTradeName('Tienda S.L');
    $redsys->setTitular('Pedro Risco');
    $redsys->setProductDescription('Compras varias');
    $redsys->setEnviroment('test'); //Entorno test

    $signature = $redsys->generateMerchantSignature($key);
    $redsys->setMerchantSignature($signature);

    $form = $redsys->createForm();
}
catch(Exception $e){
    echo $e->getMessage();
}
echo $form;