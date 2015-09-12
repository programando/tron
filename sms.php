<?php
    $server = "panel.centralsms.co";
    $port   = 80;

    $client = new
        SoapClient(
        "http://panel.centralsms.co/ws/sms.wsdl"
    );

    //create Ad test structure
    $message = array(
        "destinos" => "573113369005",
        "mensaje" => "Hello. Is there anybody in there?",
        "user" => "myusername",
        "password" => "osito99",
    );

    $result = $client->__call('smsEnviar', $message );
?>
