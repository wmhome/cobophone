<html> 
<body> 
<?php

	include 'apiRedsys.php';
	// Se crea Objeto
	$miObj = new RedsysAPI;
	$id_comanda=$miObj->getParameter("Ds_Order");
	echo $id_comanda;

	if (!empty( $_POST ) ) {//URL DE RESP. ONLINE
					
		$version = $_POST["Ds_SignatureVersion"];
		$datos = $_POST["Ds_MerchantParameters"];
		$signatureRecibida = $_POST["Ds_Signature"];
		

		$decodec = $miObj->decodeMerchantParameters($datos);	
		$kc = 'q4vKyflyhfWS2mL8AZ+H31eRNxXOckzV'; //Clave recuperada de CANALES
		$firma = $miObj->createMerchantSignatureNotif($kc,$datos);	

		if ($firma === $signatureRecibida){
			echo "FIRMA OK";
			
		} else {;
			echo "FIRMA KO"
			
		}
	}

?>
</body> 
</html> 