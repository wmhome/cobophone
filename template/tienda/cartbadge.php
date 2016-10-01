<?php
include("classCarrito.php");
if($_SESSION['carrito']->totalItems()!=0) echo '<span class="fa fa-shopping-cart"></span> Carrito <span class="badge">'.$_SESSION['carrito']->totalItems().'</span>';
?>