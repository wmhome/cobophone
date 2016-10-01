<?php
include("classCarrito.php");
include("../libs/php/funcions_moel.php");
$_SESSION["carrito"]->eliminar_compra();
$cantidad=$_SESSION['carrito']->totalItems();
$precio=$_SESSION['carrito']->total_compra();
header("location: carrito.php");
?>