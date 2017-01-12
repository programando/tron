<?php



			$to      = "william@singularlab.co";
			$subject = "Desde el contacto de Balquimia | Asunto: ";
			

			$headers = "From: Contacto OM <sistema@ion.com> \r\n";
			$headers .= 'Reply-To: '.$email."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=utf-8\r\n";
						

			$txt 	 = '
			
		
		
		
		
		
		
			
			';

			if(mail($to , $subject, $txt, $headers)) { 
				echo "<div class='exito'>Mensaje enviado con éxito</div>";
			} else echo "<div class='error'>No se pudo enviar el mensaje</div>"; 

?>

