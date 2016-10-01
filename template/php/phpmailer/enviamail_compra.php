<?
	
				
				function envia_mail_compra($id_cliente,$id_comanda){
				//include("../funcions_moel.php");
				$sum=0;
				$link=conecta();
				$sql="SELECT t1.precio, t1.id_producto, quantitat, t2.nombre, t2.img1 FROM linea_comanda as t1, productos as t2 WHERE id_comanda='$id_comanda' and t1.id_producto=t2.id_producto";
				$result=busqueda($sql,$link);
				$sql2="SELECT email FROM clientes WHERE id_cliente='$id_cliente'";
				$ssql="select t1.*, t3.* from comanda as t1, clientes as t3 where t1.id_comanda='$id_comanda' and t1.id_usuario=t3.id_cliente";
				$result2=busqueda($ssql,$link);
				$row2=recibir_array($result2);
				//$zsql="select * from envio where id_comanda='$id_comanda'";
				//$carro=busqueda($zsql,$link);
				//$row3=recibir_array($carro);
				if($row2['id_dir']!=0){
					$id_dir=$row2['id_dir'];
					$ssql="select t1.*, t3.*, t4.email from comanda as t1, direcciones as t3, clientes as t4 where t1.id_comanda='$id_comanda' and t1.id_usuario=t3.id_cliente and t3.id_dir='$id_dir' and t1.id_usuario=t4.id_cliente";
					$result2=busqueda($ssql,$link);
					$row2=recibir_array($result2);
				}
				$cuerpo = "<p><b>Muchas gracias por confiar en mo-el.es</b></p>";
				$cuerpo.= "<p><b>Compra realizada por: </b>".$row2['nombre']." ".$row2['apellidos']."</p>";
				$cuerpo.= "<p><b>Datos de envio</b></p>";
				$cuerpo.= "<p><b>Direcci&oacute;n: </b>".utf8_encode($row2['direccion'])."</p>";
				$cuerpo.= "<p><b>Pa&iacute;s: </b>".utf8_encode($row2['pais'])."</p>";
				$cuerpo.= "<p><b>Provincia: </b>".utf8_encode($row2['provincia'])."</p>";
				$cuerpo.= "<p><b>Poblaci&oacute;n: </b>".utf8_encode($row2['poblacion'])."</p>";
				$cuerpo.= "<p><b>C.P: </b>$row2[cp]</p>";
				$cuerpo.= "<p><b>Identificador de compra: </b>".$id_comanda."</p>";
				if ($row2['forma']=="PayPal") $forma= utf8_decode("PayPal");
				if ($row2['forma']=="targeta_credito") $forma=utf8_decode("Tarjeta de cr&eacute;dito");
				$cuerpo.= "<p><b>Forma de pago: </b>".$forma."</p>";
				
				$cuerpo.= "<p>Recibir&aacute; su pedido en la direcci&oacute;n indicada al sistema en el periodo de tiempo dependiendo de su zona.</p><p>A continuaci&oacute;n, podr&aacute; ver el detalle de su compra</p>";
				
				$cuerpo.= "<table class='table table-condensed' cellpadding='3' style='border: 1px solid #ccc; border-collapse: collapse;'>";
				$cuerpo.= "<tr bgcolor='#CCCCCC' style='border: 1px solid #ccc;'>";
				$cuerpo.= "<td style='border: 1px solid #ccc;'><b>Foto</b></td>";
				$cuerpo.= "<td style='border: 1px solid #ccc;'><b>Nombre producto</b></td>";
				$cuerpo.= "<td style='border: 1px solid #ccc;'><b>Precio</b></td>";
				$cuerpo.= "<td style='border: 1px solid #ccc;'><b>Cantidad</b></td>";
				$cuerpo.= "<td style='border: 1px solid #ccc;'><b>Total producto</b></td></tr>";
				while ($row=recibir_array($result)){
					$img1=$row['img1'];
					$sql3="select * from files where id_file='$img1'";
					$res3=busqueda($sql3, $link);
					$row3=recibir_array($res3);
					$file1=$row3['nombre'];
					$cuerpo.= "<tr><td style='border: 1px solid #ccc;'><img src='http://www.mo-el.es/assets/img/productos/$file1' alt='foto producto' width='40' /></td>";
					
					$cuerpo.= "<td style='border: 1px solid #ccc;'>".utf8_encode($row[3]). "</td>";
					$cuerpo.= "<td style='border: 1px solid #ccc; text-align:right;'>$row[0] &euro;</td>";
					$cuerpo.= "<td style='border: 1px solid #ccc; text-align:right;'>$row[2]</td>";
					$cuerpo.= "<td style='border: 1px solid #ccc; text-align:right;'>".$row[0]*$row[2]." &euro;</td></tr>";
					$sum+=$row[0]*$row[2];
					
					$cant+=$row[2];
					
					$iva=number_format(($sum*0.21),2);
					$sum-=$iva;
					$genvio=$row2['gastos_envio'];
					$total=$sum + $genvio + $iva;
				}
				//muestro el total
				$cuerpo.= "<tr style='border: 1px solid #ccc;'><td colspan='4' style='text-align:left; border: 1px solid #ccc;'><b>Subtotal:</b></td><td style='text-align:right; border: 1px solid #ccc;'><b>" . $sum . " &euro;</b></td></tr>";
				$cuerpo.= "<tr style='border: 1px solid #ccc;'><td colspan='4' style='text-align:left; border: 1px solid #ccc;'><b>IVA 21%:</b></td><td style='text-align:right; border: 1px solid #ccc;'><b>" . $iva . " &euro;</b></td></tr>";
				$cuerpo.= "<tr style='border: 1px solid #ccc;'><td colspan='4' style='text-align:left; border: 1px solid #ccc;'><b>Gastos de envio:</b></td><td style='text-align:right; border: 1px solid #ccc;'><b>" . $genvio . " &euro;</b></td></tr>";
				$cuerpo.= "<tr style='border: 1px solid #ccc;'><td colspan='4' style='text-align:left; border: 1px solid #ccc;'><b>TOTAL:</b></td><td style='text-align:right; border: 1px solid #ccc;'><b>" . $total . " &euro;</b></td></tr>";
				$cuerpo.= "</table>";
				$quien="Compras mo-el spain";

				if(enviaEmilio2("clientes@whitemind.es","Factura mo-el.es",$cuerpo,"Factura mo-el.es",$quien,"clientes@whitemind.es")){

					return "<p>Se ha enviado el resumen de su compra correctamente a: <b>".$row2['email']."</b> con copia a: info@mo-el.es";
				}
				else return "Mail no enviado";
	
				
				}
				function enviaEmilio2($direc,$tasunto,$tcuerpo,$tde,$ttxtde,$treply){
					$admin=$ttxtde;
					$de=$tde;
					$reply=$treply;
					$cabeceras="MIME-Version: 1.0 \n";
					$cabeceras.= "Content-Type: text/html; charset=iso-8859-1 \n";
					$cabeceras.='From: info@mo-el.es' . "\r\n";
					$cabeceras.="Reply-To: $reply \n";
					$asunto=$tasunto;
					$cuerpo=$tcuerpo;
	
					return @mail($direc, $asunto, $cuerpo, $cabeceras);
				}
?> 