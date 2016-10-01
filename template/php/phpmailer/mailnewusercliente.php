<?php


function envia_mail_user($id_cliente){	
require "includes/class.phpmailer.php";

$link=conecta();
$sql="select * from clientes where id_cliente='$id_cliente'";
$res=busqueda($sql,$link);
$row=recibir_array($res);

$correu=$row['email'];


$nombre=utf8_decode($row['nombre']);
$apellidos=utf8_decode($row['apellidos']);
$login=$row['login'];
$pass=$row['pass'];
$correoe=utf8_decode($row['email']);
		
$mail = new phpmailer();

$mail->PluginDir = "includes/";	
$mail->IsSendmail();

$mail->Host = "smtp.1and1.es";
$mail->Port = 587;

$mail->SMTPAuth = true;

$mail->Username = "clientes@whitemind.es"; 
$mail->Password = "lopercal";

$mail->From = $correoe."(Nuevo Usuario en mo-el.es)";

$mail->FromName = "mo-el.es";

$mail->Timeout=30;

$mail->AddAddress($correu);
$mail->AddBCC("clientes@whitemind.es");
//$mail->AddAddress($correu3);

$mail->IsHTML(true);
$assunto=$correoe."(Nuevo Usuario)";
$mail->Subject = "Bienvenido a mo-el.es";
$mail->Body = "<img src='http://www.mo-el.es/assets/img/logo_moel_02.png' height='250'><br><br><b>Bienvenido a mo-el.es.</b><br /><br /><b>". $nombre ." ".$apellidos."</b><br><br>Los datos para acceder a tu zona web son los siguientes: <br>Login: <b>".$login."</b><br>Contrase&ntilde;a: <b>".$pass."</b><br><br>Para cualquier duda, consulta o cambio de tus datos personales ponte en contacto con nosotros a trav&eacute;s de nuestro formulario de contacto <a href='http://www.mo-el.es/contacto.php' style='color:red;'>aqu&iacute;</a>";

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
	?><script type="text/javascript"> alert("Usuario creado correctamente, revise su mail.") </script><?
	
}
}
?>