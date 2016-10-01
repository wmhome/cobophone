<?php


//function envia_mail($nom,$apellidos,$email){	
	

require "includes/class.phpmailer.php";
	
$correu="info@mo-el.es";

$nombre=utf8_decode($_POST['nombre']);
//$apellidos=utf8_decode($_POST['apellidos']);
//$empresa=utf8_decode($_POST['empresa']);
$correoe=$_POST['email'];
$tel=$_POST['tel'];
$cp=$_POST['cp'];
$antibot=$_POST['antibot'];
//$asunto=utf8_decode($_POST['asunto']);
$mensaje=utf8_decode($_POST['mensaje']);
		
$mail = new phpmailer();

$mail->PluginDir = "includes/";

$mail->IsSendmail();

$mail->Host = "smtp.1and1.es";
$mail->Port = 587;

$mail->SMTPAuth = true;

$mail->Username = "clientes@whitemind.es"; 
$mail->Password = "lopercal";

$mail->From = $correoe;

$mail->FromName = $nombre;

$mail->Timeout=30;

$mail->AddAddress($correu);
$mail->AddBCC("clientes@whitemind.es");


$mail->IsHTML(true);
$assunto=$asunto."(Presupuesto estimado)";
$mail->Subject = utf8_decode($assunto);
$mail->Body = "<b>Email enviado desde el formulario de presupuesto estimado de CoboPhone.es.</b><br /><br />
			Nombre :  ". $nombre ."<br />
			e-mail: ".$correoe."<br />
			Tel&eacute;fono: ".$tel."<br />
			C&oacute;digo postal: ".$cp."<br />
			Tipo reparaci&oacute;n: ".$tipo."<br />
			Mensaje: ".$mensaje." <br />";

  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
  	$message = "Email enviado desde el formulario de cpresupuesto estimado de CoboPhone.es.\r\n\n";
	
	$message .= " Nombre : " . $nombre . "\r\n\n";
	
	$message .= " e-mail : " .$correoe . " \r\n\n";
	
	$message .= "Mensaje : " .$mensaje."\n";
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
	if($antibot==4){
		$enlace=$_SERVER["HTTP_REFERER"];
		?><script type="text/javascript"> alert("Mail enviado correctamente") </script><?
		?><script type="text/javascript">document.location.href="../../index.php";</script><?
	}
}
//}
?>