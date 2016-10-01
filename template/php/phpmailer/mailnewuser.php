<?php


function envia_mail($id_cliente){	
require "includes/class.phpmailer.php";

$link=conecta();
$sql="select * from clientes where id_cliente='$id_cliente'";
$res=busqueda($sql,$link);
$row=recibir_array($res);

$correu="info@mo-el.es";


$nombre=utf8_decode($row['nom']);
$correoe=utf8_decode($row['email']);

$mensaje=utf8_decode($_POST['textarea']);
		
$mail = new phpmailer();

$mail->PluginDir = "includes/";	
$mail->IsSendmail();

$mail->Host = "smtp.1and1.es";
$mail->Port = 587;

$mail->SMTPAuth = true;

$mail->Username = "clientes@whitemind.es"; 
$mail->Password = "lopercal";

$mail->From = $correoe."(Nuevo Usuario en mo-el.es)";

$mail->FromName = $nombre;

$mail->Timeout=30;

$mail->AddAddress($correu);
$mail->AddBCC("clientes@whitemind.es");
//$mail->AddAddress($correu3);

$mail->IsHTML(true);
$assunto=$correoe."(Nuevo Usuario)";
$mail->Subject = utf8_decode($assunto);
$mail->Body = "<b>Registro de nuevo cliente.</b><br /><br />Nombre :  <b>". $nombre ."</b><br />Apellidos: <b>".$row['apellidos']."</b><br>e-mail: <b>".$correoe."</b><br />";

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  	$message = "Nuevo Usuario en mo-el.es.\r\n\n";
	
	$message .= " Nombre : " . $nombre . "\r\n\n";
	 	
	$message .= " e-mail : " .$correoe . " \r\n\n";
	
  
  $mail->AltBody = $message;

  $exito = $mail->Send();

  $intentos=1; 
  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	//echo $mail->ErrorInfo;
     	$exito = $mail->Send();
     	$intentos=$intentos+1;	
	
   }
if ($exito){
	
	?><script type="text/javascript"></script><?	
}
}
?>