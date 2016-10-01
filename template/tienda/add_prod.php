<?php
    //session_start();
	//if (!$_SESSION['usuario']) $_SESSION['usuario']="Invitado";
	//if ($_SESSION['usuario']==Invitado || $_SESSION['us']==normal) header("Location:registro.php");
	include("../libs/php/funcions_moel.php");
	include("classCarrito.php");
	function cort2($texto){
    	$cantidad = strlen($texto);
    	return substr($texto, 20, $cantidad);
    }
	$id=$_POST['id'];
	$qtt=$_POST['cantidad'];
	$preu=$_POST['precio'];
	$nom=$_POST['nombre'];
	$foto=$_POST['foto'];
	echo "ID:".$id."<br>";
	echo "CANT:".$qtt."<br>";
	
	$enlace="../".cort2($_SERVER["HTTP_REFERER"]);
	echo $enlace;
	$_SESSION['carrito']->addItem($id,$qtt,$preu,$nom,$foto);
	$cantidad=$_SESSION['carrito']->totalItems();
	$precio=$_SESSION['carrito']->total_compra();
	echo "TOTAL PRODS:".$cantidad;
	echo "<span class'items'>Items: ".$cantidad."</span> - <span class='price'>Precio: ".$precio." €";
	//header("location: $enlace"); 
	$_SESSION['carrito']->imprime_carrito(1);
	return true;
?>