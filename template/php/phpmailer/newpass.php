<?php


//function envia_mail($nom,$apellidos,$email){	
	

require "includes/class.phpmailer.php";

if($_SERVER['HTTP_HOST']=="www.mo-el.es"){
	include("../funcions_moel.php");
	$on="themes";
}
if($_SERVER['HTTP_HOST']=="www.wmhome.es"){
	include("../funcions_mostrap.php");
	$on="mostrap";
}
$link=conecta();
$correoe=$_POST['email'];
$newpass=generaPass();
$sql1="update clientes set pass='$newpass' where email='$correoe'";
$res=busqueda($sql1, $link);

$sql="select * from clientes where email='$correoe'";
$res=busqueda($sql, $link);
$row=recibir_array($res);
$email=$row['email'];

if($correoe==$email){
	$cliente=htmlentities($row['nombre'])." ".htmlentities($row['apellidos']);
	$login=htmlentities($row['login']);
	
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
	
	$mail->AddAddress($correoe);
	$mail->AddBCC("clientes@whitemind.es");
	
	
	$mail->IsHTML(true);
	$assunto=$asunto.utf8_encode("(Nueva contraseña)");
	$mail->Subject = utf8_decode($assunto);
	$mail->Body = "<b>Nueva contraseña para ".$cliente."</b><br /><br />Su nueva contraseña :  <b>". $newpass ."</b><br />Recuerde su nombre de usuario (login): <b>".$login."</b><br />Podrá cambiar esta contraseña cuando lo desee desde su perfil de usuario.<br />";
	
	  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
	  	$message = "Nueva contraseña.\r\n\n";
		
		$message .= "Podrá cambiar esta contraseña cuando lo desee desde su perfil de usuario.\n";
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
		$enlace=$_SERVER["HTTP_REFERER"];
		?><script type="text/javascript"> alert("Nueva contraseña enviada correctamente") </script><?
		?><script type="text/javascript">document.location.href="<?=$enlace?>";</script><?	
	}
}
else{
	?><script type="text/javascript"> alert("Este mail no figura en nuestra base de datos.") </script><?
	?><script type="text/javascript">document.location.href="<?=$enlace?>";</script><?
}
function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=6;
     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}
//}
?>