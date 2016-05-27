
<?php
//Incluimos la clase de PHPMailer
require_once('libs_external/class.phpmailer.php');

	$email  = 'contactos@entreamigosalcanzamos.com';
	$pass 	 = '*TECN0TR0N*';
	$correo = new PHPMailer();

	 $correo->IsSMTP();
	 $correo->SMTPDebug     = 0;
	 $correo->SMTPAuth      = true;
	 $correo->IsHTML        = true;              				 // enable SMTP authentication
	 $correo->ContentType   = "text/html";
	 $correo->CharSet       = "utf-8";
	 $correo->SMTPSecure    = 'ssl';                     // sets the prefix to the servier
	 $correo->Host          = 'smtp.gmail.com';      		// sets GMAIL as the SMTP server
	 $correo->Port          = 465;
	 $correo->SMTPKeepAlive = true;
	 $correo->Mailer        = "smtp";                   // set the SMTP port
	 $correo->Username      = $email;					// GMAIL username
	 $correo->Password      = $pass;    // GMAIL password
	 $correo->From          = $email;
	 $correo->FromName      = 'TRON Entre amigos alcanzamos';
	 $correo->Subject       = 'Prueba de Correo' ;
	 $correo->AltBody       = ""; //Text Body
	 $correo->WordWrap      = 50; // set word wrap																// send as HTML
	 $correo->AddAddress('jhonjamesmg@hotmail.com');
	 $correo->Body 			='mensaje de prueba' . rand(1,150);

	if(!$correo->Send()) {
			echo rand(1,150);
	  echo "Hubo un error: " . $correo->ErrorInfo;
	} else {
		 echo rand(1,150);
	  echo "Mensaje enviado con exito." ;
	}

?>
