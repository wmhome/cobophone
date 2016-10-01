<?php
//Página que graba enm BBDD la transacción como autorizada
include("../libs/php/funcions_moel.php");
include("classCarrito.php");
//$id_comanda=$_GET['PszPurchorderNum'];
$id_comanda=$_GET['order'];
$jsid=$_GET['jsid'];
echo "ORDER: ".$id_comanda."<br>";
$op="si";
$link=conecta();
$consulta="update comanda set autorizada=1, cobrada=1 where id_comanda='$id_comanda'";
$result=busqueda($consulta,$link);
if($result){
	echo "<p>Transaccion autorizada y registrada.</p>";
	unset ($_SESSION['carrito']);
	?>
	<script>document.location.href="../index.php?compra=ok&id_comanda=<?=$id_comanda?>&jsid=<?=$jsid?>";</script>
	<?php
}
else echo "<p><b>ERROR</b></p>";
?>