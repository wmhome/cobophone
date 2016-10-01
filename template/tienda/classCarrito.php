<?
//echo ("HOLA");
class Carr
{
	
	var $cnt;
	var $temp;
	var $Array_id= array();
	var $Array_qtt=array();
	var $Array_pr=array();
	var $Array_nom=array();
	
	var $p_rep;
	var $total_compra;
	var $id_comanda;
	var $fecha_titulo;
	var $gastos_envio;
	var $total;
	
	function Carr(){
		$this->cnt=0;
		//echo "estoy dentro";
		//include("funcions.php");
		//$link=conecta();
		//$this->total_compra=0;
		//$sql="SELECT MAX(id_comanda) FROM pedidos_momento";
		//$result=busqueda($sql,$link);
		//$row=recibir_array($result);
		//$this->id_comanda=$row[0];
		//$this->id_comanda++;
		//$asql="insert into pedidos_momento (id_comanda) values ('$this->id_comanda')";
		//$resultado=busqueda($asql,$link);
		//$fila=recibir_array($resultado);
		//$bsql="select max(id_comanda) from pedidos_momento";
		//$resultado=busqueda($bsql,$link);
		//$fila2=recibir_array($resultado);
		//if($this->id_comanda==$fila2[0]) $this->id_comanda++;
	}
	function existe($id){
		if ($this->cnt==0){return false;}
		else{
			for ($i=0;$i<$this->cnt;$i++){
				if ($this->Array_id[$i]==$id){
					$this->p_rep=$i;
					return true;
				}
			}
			return false;
		}
	}
	function addItem($id,$qtt,$pr,$nombre,$foto){
		if (!$this->existe($id)){
			$this->Array_id[$this->cnt]=$id;
			$this->Array_qtt[$this->cnt]=$qtt;
			$this->Array_pr[$this->cnt]=$pr;
			$this->Array_nom[$this->cnt]=$nombre;
			$this->Array_foto[$this->cnt]=$foto;
			$this->cnt++;
		}
		else{
			$this->Array_qtt[$this->p_rep]+=$qtt;
		}
	}
	function totalItems(){
		$contador_prods=0;
		for ($i=0;$i<$this->cnt;$i++){
			if($this->Array_id[$i]!=0){
				$contador_prods+= $this->Array_qtt[$i];
			}
		}
		return $contador_prods;
	}
	function total_compra(){
		$suma=0;
		for ($i=0;$i<$this->cnt;$i++){
			if($this->Array_id[$i]!=0){
				$suma += $this->Array_pr[$i]*$this->Array_qtt[$i];
			}
		}
		//$suma=round(($suma*1.21)*100)/100;
		return $suma;
	}
	function total_compra_sin_iva(){
		$suma=0;
		for ($i=0;$i<$this->cnt;$i++){
			if($this->Array_id[$i]!=0){
				$suma += $this->Array_pr[$i]*$this->Array_qtt[$i];
			}
		}
		$suma=round($suma*100)/100;
		return $suma;
	}
	function imprime_carrito($num){
		//include("funcions.php");
		$link=conecta();
		$this->total_compra=0;
		
		
		$link=conecta();
		$this->total_compra=0;
		$sql="SELECT MAX(id_comanda) FROM comanda";
		$result=busqueda($sql,$link);
		$row=recibir_array($result);
		$this->id_comanda=$row[0];
		$this->id_comanda++;
		$id_comanda=$this->id_comanda;
		//echo $this->fecha_titulo;
		$suma = 0;
		$cant = 0;
		//FECHA
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=$dias[date('w')].",".date(j)." de ".$meses[date('n')]." de ".date(Y)." a las: ".date("H:i:s");
		$this->fecha_titulo=$dias[date('w')].",".date(j)." de ".$meses[date('n')]." de ".date(Y);
		//			
		if($this->totalItems()!=0 && $num==1){
		?>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-hover table-carrito">
  					<thead>
  						<tr>
  							<th></th>
  							<th>Producto</th>
  							<th></th>
  							<th>Precio Und.</th>
  							<th>Cantidad</th>
  							<th>Precio</th>
  						</tr>
  					</thead>
  					<tbody>
  						<?php
						for ($i=0;$i<$this->cnt;$i++){
							if($this->Array_id[$i]!=0){
								$id=$this->Array_id[$i];
								$sql="select nombre,img1 from productos where id_producto='$id'";
								$res=busqueda($sql,$link);
								$row=recibir_array($res);
								$id_file=$row['img1'];
								$nombre=utf8_encode($row['nombre']);
								$precio=$row['precio'];
								$sql_f="select * from files where id_file='$id_file'";
								$res_f=busqueda($sql_f, $link);
								$row_f=recibir_array($res_f);
								$file=$row_f['ubicacion'].$row_f['nombre'];
								$genvio=$this->calcular_gatos_envio();
								$apagar=$this->total_compra() + $genvio;
								//$total1_no_factura=$apagar + $genvio;
								$total1_factura=round(($apagar/1.21),2);
								$IVA=round(($total1_factura*0.21),2);
								if($_SESSION['id_usuario']==1){ $genvio=0; $apagar=$this->total_compra() + $genvio;}
								if($_SESSION['usuario']=="Invitado" || !$_SESSION['usuario']){$genvio=0; $apagar=$this->total_compra() + $genvio; $genvio='Por confirmar';}
						?>
  						<tr>
  							<td><a href="eliminar_producto.php?linea=<?=$i?>" type="button" class="btn btn-moel btn-moel-primary"><span class="fa fa-times"></span></a></td>
  							<td class="hidden-xs"><img src="<?php echo "../$file";?>" class="img-rounded cartimgmini"></td>
  							<td><?php echo $nombre;?></td>
  							<td><?=$this->Array_pr[$i]?> &euro;</td>
  							<td>
	  							<div class="input-group cantidadproductos mbs">
							      <span class="input-group-btn">
							        <a href="mod.php?id=<?=$i?>&cant=<?=$this->Array_qtt[$i]-1?>" class="btn btn-moel btn-moel-primary" type="button">-</a>
							      </span>
							      <input type="text" class="form-control" value="<?=$this->Array_qtt[$i];?>">
							      <span class="input-group-btn">
							        <a href="mod.php?id=<?=$i?>&cant=<?=$this->Array_qtt[$i]+1?>" class="btn btn-moel btn-moel-primary" type="button">+</a>
							      </span>
							    </div><!-- /input-group -->
  							</td>
  							<td><?=$this->Array_pr[$i]*$this->Array_qtt[$i]?> &euro;</td>
  						</tr>
  						<?php
  							}
  						}
  						?>
  					</tbody>
  				</table>
			</div>
		</div>
		<?php
			$iva=round(($this->total_compra()*0.21),2);
			$base=$this->total_compra()-$iva;
			$total1=$apagar;
			?>
  			<div class="col-xs-12 pull-right visible-xs">
  				<table class="table table-condensed">
  					<thead>
  						<tr>
  							<th colspan="2" class="txt-right"><h3>Total compra</h3></th>
  						</tr>
  					</thead>
  					<tbody>
  						<tr>
  							<td>Subtotal</td>
  							<td class="txt-right"><?=$base?> &euro;</td>
  						</tr>
  						<tr>
  							<td>IVA 21%</td>
  							<td class="txt-right"><?=$iva?> &euro;</td>
  						</tr>
  						<tr>
  							<td>Gastos de envio</td>
  							<td class="txt-right"><?=$genvio?> <?php if($_SESSION['usuario']!="Invitado"){echo "&euro;";}?></td>
  						</tr>
  						<tr>
  							<td>Total compra</td>
  							<td class="txt-right"><?=$total1?> &euro;</td>
  						</tr>
  					</tbody>
  				</table>
  			</div>
		<div class="row">
			<div class="col-sm-12 txt-right prl">
				<div class="checkbox">
				    <label>
				      <input type="checkbox" class="terms"> He leído y acepto los <a href="/condiciones_compra.php" target="_blank">términos y condiciones de compra.</a>
				    </label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-9 col-lg-offset-3">
  				<div class="actions txt-right">
  					<div class="col-xs-12 col-sm-4 mbs">
  						<a href="javascript:history.back()" type="button" class="btn btn-moel btn-moel-default btn-block">Seguir comprando</a>
  					</div>
  					<div class="col-xs-12 col-sm-4 mbs">
  						<a href="confirma.php?id_comanda=<?=$this->id_comanda?>&apagar=<?=$apagar?>&paso1=ok" type="button" class="btn btn-success btn-block btn-pay">Proceder con la compra</a>
  					</div>
  					<div class="col-xs-12 col-sm-4 mbs">
  						<a href="eliminar_carrito.php" type="button" class="btn btn-danger btn-block">Eliminar compra</a>
  					</div>
  					
  				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 pull-left mtxl">
  				<img class="img-responsive" src="/assets/img/pagoseguro.png">
  			</div>
			<?php
			$iva=round(($this->total_compra()*0.21),2);
			$base=$this->total_compra()-$iva;
			$total1=$apagar;
			?>
  			<div class="col-sm-4 pull-right hidden-xs">
  				<table class="table table-condensed">
  					<thead>
  						<tr>
  							<th colspan="2" class="txt-right"><h3>Total compra</h3></th>
  						</tr>
  					</thead>
  					<tbody>
  						<tr>
  							<td>Subtotal</td>
  							<td class="txt-right"><?=$base?> &euro;</td>
  						</tr>
  						<tr>
  							<td>IVA 21%</td>
  							<td class="txt-right"><?=$iva?> &euro;</td>
  						</tr>
  						<tr>
  							<td>Gastos de envio</td>
  							<td class="txt-right"><?=$genvio?> <?php if($_SESSION['usuario']!="Invitado"){echo "&euro;";}?></td>
  						</tr>
  						<tr>
  							<td>Total compra</td>
  							<td class="txt-right"><?=$total1?> &euro;</td>
  						</tr>
  					</tbody>
  				</table>
  			</div>
		</div>
		<?php
		}
		else if($this->totalItems()!=0 && $num==2){
			?>
			<table class="table table-carrito">
				<tbody>
					<?php
					$url="/";
					$urlb="/";
					for ($i=0;$i<$this->cnt;$i++){
						if($this->Array_id[$i]!=0){
							$id=$this->Array_id[$i];
							$sql="select nombre,img1 from productos where id_producto='$id'";
							$res=busqueda($sql,$link);
							$row=recibir_array($res);
							$id_file=$row['img1'];
							$nombre=utf8_encode($row['nombre']);
							$precio=$row['precio'];
							$sql_f="select * from files where id_file='$id_file'";
							$res_f=busqueda($sql_f, $link);
							$row_f=recibir_array($res_f);
							$file=$row_f['ubicacion'].$row_f['nombre'];
							$genvio=$this->calcular_gatos_envio();
							$apagar=$this->total_compra() + $genvio;
							//$total1_no_factura=$apagar + $genvio;
							$total1_factura=round(($apagar/1.21),2);
							$iva=round(($total1_factura*0.21),2);
							$apagar=$this->total_compra() + $genvio + $iva;
							if($_SESSION['id_usuario']==1){ $genvio=0; $apagar=$this->total_compra() + $genvio + $iva;}
					?>
					<tr>
						<td><img src="<?php echo "/$file";?>" class="img-rounded cartimgmini"></td>
						<td class="mts"><?php echo $nombre;?><br><?=$this->Array_qtt[$i];?> x <?=$this->Array_pr[$i]?> &euro;</td>
					</tr>
					<?php
						}
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2" class="txt-left text-muted"><strong>Subtotal: <?=$this->total_compra()?> &euro;</strong></td>
					</tr>
				</tfoot>
			</table>
			<a href="/tienda/confirma.php?id_comanda=<?=$this-id_comanda?>&apagar=<?=$apagar?>&paso1=ok" type="button" class="btn btn-moel btn-moel-primary btn-pay mls mbs">Pagar</a>
			<a href="/tienda/carrito.php" type="button" class="btn btn-moel btn-moel-default btn-view mls mbs">Ver carrito</a>
			<?php
		}
		else if ($this->totalItems()==0){
			echo "<div class='alert alert-danger txt-center mbn'>EL CARRITO DE LA COMPRA EST&Aacute; VACIO</div>";
		}
	}
	function addone($id){
		$this->Array_qtt[$id]++;
	}
	function elimina_producto($linea){
		$this->Array_id[$linea]=0;
	}
	function modifica_carrito($id,$cant){
		$this->Array_qtt[$id]=$cant;
	}
	function eliminar_compra(){
		for ($i=0;$i<$this->cnt;$i++){
			if($this->Array_id[$i]!=0){
				$this->Array_id[$i]=0;
			}
		}
	}
	function confirmar(){
		//include("funcions.php");
		if($_SESSION['id_dir']) $id_dir=$_SESSION['id_dir'];
		else $id_dir=0;
		$link=conecta();
		$id_cliente=$_SESSION['id_cliente'];
		$sql="SELECT * FROM clientes WHERE id_cliente='$id_cliente'";
		$result=busqueda($sql,$link);
		$row=recibir_array($result);
		$nombre=$row['nombre'];
		$apellidos=$row['apellidos'];
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=$dias[date('w')].",".date(j)." de ".$meses[date('n')]." de ".date(Y)." a las: ".date("H:i:s");
		$this->fecha_titulo=$dias[date('w')].",".date(j)." de ".$meses[date('n')]." de ".date(Y);
		
		$id_comanda=$_SESSION['carrito']->id_comanda;
		//$fecha=$_SESSION['carrito']->fecha_titulo;
		$total_compra=$_SESSION['carrito']->total_compra();
		$gastos_envio=$_SESSION['carrito']->calcular_gatos_envio();
		//if($id_cliente==1) $gastos_envio=0;
		$total=$total_compra + $gastos_envio;
		$sql="insert into comanda (id_comanda,data,id_usuario,total,forma,gastos_envio,total_compra,autorizada,cobrada,enviada,factura) values ('$id_comanda','$fecha','$id_cliente','$total_compra','SE','$gastos_envio','$total',0,0,0,0)";
		$result=busqueda($sql,$link);
		
		for ($i=0;$i<$this->cnt;$i++){
			if($this->Array_id[$i]!=0){
			
				$id=$this->Array_id[$i];
				$qtt=$this->Array_qtt[$i];
				$pr=$this->Array_pr[$i];
				$nom=utf8_decode($this->Array_nom[$i]);
		
				$sql="insert into linea_comanda (id_comanda, id_producto, nombre_producto, quantitat, precio) values ('$id_comanda','$id','$nom','$qtt','$pr')";
				$result=busqueda($sql,$link);	
			}
		}
		//header("location: forma_pagament.php?id_comanda=$this->id_comanda&nombre=$nombre&apellidos=$apellidos&fecha=$fecha&total=$this->total_compra");
	}
	function calcular_gatos_envio(){
		$link=conecta();
		$id_comanda=$_SESSION['id_carrito'];
		$id_cliente=$_SESSION['id_cliente'];
		//Recalcular gastos
		
		//Fi gastos
		//echo $id_usuario;
		//$sql="select pais from envio where id_comanda='$id_comanda' order by id_envio desc";
		$sql="select pais from clientes where id_cliente='$id_cliente'";
		$smtp=busqueda($sql,$link);
		$fila=recibir_array($smtp);
		$pais=utf8_encode($fila['pais']);
		//echo $pais;
		if($pais=="España" || $pais==""){
			//echo "SI";
			//$sql="select provincia, envio from envio where id_comanda='$id_comanda'";
			$sql="select provincia from clientes where id_cliente='$id_cliente'";
			$result=busqueda($sql,$link);
			$row=recibir_array($result);
			if($row[0]=="Barcelona"){
				$this->gastos_envio=5.00;
				//$this->total=$this->gastos_envio+$row[1];
			}
			if($row[0]=="Tarragona" || $row[0]=="Lleida" || $row[0]=="Girona"){
				//$this->gastos_envio=round((5.09*1.18)*100)/100;
				$this->gastos_envio=8.00;
				//$this->total=$this->gastos_envio+$this->total_compra();
			}
			if($row[0]=="Baleares (Illes)"){
				$this->gastos_envio=10.00;
				//$this->total=$this->gastos_envio+$this->total_compra();	
			}
			if($row[0]=="Ceuta" || $row[0]=="Melilla"){
				$this->gastos_envio=15.00;
				//$this->total=$this->gastos_envio+$this->total_compra();	
			}
			if($row[0]!="Barcelona" && $row[0]!="Tarragona" && $row[0]!="Lleida" && $row[0]!="Girona" && $row[0]!="Baleares (Illes)" && $row[0]!="Ceuta" && $row[0]!="Melilla"){
				$this->gastos_envio=12.00;
				//$this->total=$this->gastos_envio+$this->total_compra();	
			}
			if($row[0]=="Santa Cruz de Tenerife" || $row[0]=="Las Palmas"){
				//if($row[1]=='envialia') $this->gastos_envio=21;
				//else if($row[1]=='correos') $this->gastos_envio=10;
				//$this->total=$this->gastos_envio+$this->total_compra();
				$this->gastos_envio=15;
					
			}
			//if($_SESSION['id_cliente']==1) $this->gastos_envio=0;
			return $this->gastos_envio;	
		}
		else if($pais!="España" && $pais!=""){
			$sql="select precio from genvio where nombre_local=(select pais from usuarios where id_usuario='$id_usuario')";
			$smtp_precio=busqueda($sql,$link);
			$fila_precio=recibir_array($smtp_precio);
			
			$this->gastos_envio=round(($fila_precio['precio']*1.21)*100)/100;
			$this->gastos_envio=$fila_precio['precio'];
			if(!$smtp_precio || $fila_precio==""){
				$this->gastos_envio=40;	
			}
			return $this->gastos_envio;
		}
	}
}
//inicio la sesión
session_start();
//include("include/funcions.php");
//si no esta creado el objeto carrito en la sesion, lo creo
if (!isset($_SESSION['carrito'])){
	$_SESSION['carrito'] = new Carr();
}
?>