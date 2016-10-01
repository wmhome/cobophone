<?
include("classCarrito.php");
$_SESSION['carrito']->modifica_carrito($_GET['id'],$_GET['cant']);
header("Location: carrito.php");
?>
