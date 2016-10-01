<?php
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
session_start();
ob_start();
$_SESSION['carrito']->imprime_carrito(2);
?>