<?
include("classCarrito.php");
$_SESSION["carrito"]->elimina_producto($_GET["linea"]);
header("location: carrito.php");
?>

