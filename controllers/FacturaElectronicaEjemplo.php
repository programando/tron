<?php
ini_set("display_errors","On");
$client = new SoapClient('http://69.160.41.171/WSfacturatech.asmx?WSDL');

$param = array(
'LayOut' => "[<NIT_EMISOR>]
[<CUENTA_EMISION>]
[NO] //*Requerimiento CUFE - ELIMINAR ESTE COMENTARIO*
[<FACTURA|NOTANC|NOTADR>] //Tipo de documento - ELIMINAR ESTE COMENTARIO
[<CORREO_FACTURATECH>]
[<PASSWORD_FACTURATECH>]






(ADQ)

  ADQ_1:1;

  ADQ_2:985499999;

  ADQ_3:13;

  ADQ_4:2;

  ADQ_6:VANEGAS SOTO LUIS ALEJANDRO;

  ADQ_8:VANEGAS SOTO LUIS ALEJANDRO;

  ADQ_9:VANEGAS SOTO LUIS ALEJANDRO;

  ADQ_10:CL 34  25  44;

  ADQ_11:SANTANDER;

  ADQ_12:BUCARAMANGA;

  ADQ_13:BUCARAMANGA;

  ADQ_15:CO;

  ADQ_17:1234567;

  (TCR)

    TCR_1:O-99;

  (/TCR)

  (ICR/)
  (CDA)
    CDA_1:1;
    CDA_2:Test;
    CDA_3:9999999;
    CDA_4:carlosmario.ep@gmail.co;
  (/CDA)
(/ADQ)

(TOT)

  TOT_1:0.0;

  TOT_2:COP;

  TOT_3:1700.3;

  TOT_4:COP;

  TOT_5:2099.14;

  TOT_6:COP;

  TOT_7:2099.14;

  TOT_8:COP;

  TOT_10:COP;

  TOT_12:COP;

(/TOT)

(TIM)

  TIM_1:false;

  TIM_2:398.84;

  TIM_3:COP;

  (IMP)

    IMP_1:01;

    IMP_2:0.0;

    IMP_3:COP;

    IMP_4:0.0;

    IMP_5:COP;

    IMP_6:19.0;

  (/IMP)

  (IMP)

    IMP_1:01;

    IMP_2:850.15;

    IMP_3:COP;

    IMP_4:199.42;

    IMP_5:COP;

    IMP_6:19.0;

  (/IMP)

  (IMP)

    IMP_1:01;

    IMP_2:850.15;

    IMP_3:COP;

    IMP_4:199.42;

    IMP_5:COP;

    IMP_6:19.0;

  (/IMP)

(/TIM)

(TDC)

  TDC_1:COP;

  TDC_2:COP;

  TDC_3:1.0;

(/TDC)

(DSC)

  DSC_1:false;

  DSC_2:12.0;

  DSC_3:12.0;

  DSC_4:COP;

  DSC_5:19;

  DSC_8:COP;

  DSC_9:1;

(/DSC:

(DRF)

  DRF_1:1234567895;

  DRF_2:2018-02-01;

  DRF_3:2018-12-31;

  DRF_4:FTE;

  DRF_5:1;

  DRF_6:999999;

(/DRF)

(ITD)

  ITD_1:398.84;

  ITD_2:COP;

  ITD_5:398.84;

  ITD_6:COP;

(/ITD)

(NOT)

  NOT_1: SOMOS AUTORETENEDORES RES 6777 JUL 28/2008, GRANDES CONTRIBUYENTES RES 7714 de 16 de Dic de 1998, NO EFECTUAR RETENCI?N SOBRE EL IVA IVA - REGIMEN COMUN;

(/NOT)

(REF)

  REF_1:IV;

  REF_2:0000200216;

  REF_3:2017-09-26;

(/REF)

(CTS)

  CTS_1:CGEN01;

(/CTS)

(FE1)

  FE1_1:                           1.00000;

  FE1_2:COP;

  FE1_3:1700.3;

  FE1_4:398.84;

  FE1_5:1700.3;

  (FT1)

    FT1_1:100;

    FT1_2:0.0;

    FT1_3:0.0;

  (/FT1)

  (FT1)

    FT1_1:101;

    FT1_2:1049.57;

    FT1_3:1049.57;

  (/FT1)

  (FT1)

    FT1_1:102;

    FT1_2:1049.57;

    FT1_3:1049.57;

  (/FT1)

(/FE1)

(ITE)

  ITE_1:101;

  ITE_2:true;

  ITE_3:1.0;

  ITE_4:ST;

  ITE_5:850.15;

  ITE_6:COP;

  ITE_7:850.15;

  ITE_8:COP;

  ITE_11:CINT_FEM_UNIFAZ_HEBILLA_ENGANCHE/ROJO/SM;

  ITE_12:CINT_FEM_UNIFAZ_HEBILLA_ENGANCHE/ROJO/SM;

  ITE_14:CR;

  ITE_19:850.15;

  ITE_20:COP;

  ITE_21:850.15;

  ITE_22:COP;

  (IDE)

    IDE_1:false;

    IDE_2:0.0;

    IDE_3:COP;

    IDE_8:COP;

  (/IDE)

(/ITE)

(ITE)

  ITE_1:102;

  ITE_2:true;

  ITE_3:1.0;

  ITE_4:ST;

  ITE_5:850.15;

  ITE_6:COP;

  ITE_7:850.15;

  ITE_8:COP;

  ITE_11:CINT_FEM_UNIFAZ_HEBILLA_ENGANCHE/ROJO/ME;

  ITE_12:CINT_FEM_UNIFAZ_HEBILLA_ENGANCHE/ROJO/ME;

  ITE_14:CR;

  ITE_19:850.15;

  ITE_20:COP;

  ITE_21:850.15;

  ITE_22:COP;

  (IDE)

    IDE_1:false;

    IDE_2:0.0;

    IDE_3:COP;

    IDE_8:COP;

  (/IDE)

  (IDE)

    IDE_1:false;

    IDE_2:0.0;

    IDE_3:COP;

    IDE_8:COP;

  (/IDE)

(/ITE)
[/FACTURA]");

// Call RemoteFunction ()
$error = 0;
try {
    $result= $client->__call("EmitirComprobante", array($param));

  $EmitirComprobanteResult=$result->EmitirComprobanteResult;

  $XMLFiscalValido=$EmitirComprobanteResult->XMLFiscalValido;
  $fileName=$EmitirComprobanteResult->fileName;
  $documentNumber=$EmitirComprobanteResult->documentNumber;
  $transactionId=$EmitirComprobanteResult->ID;
  $msgError=$EmitirComprobanteResult->MensajeErrorLAYOUT;

  //document status
  $processName=$EmitirComprobanteResult->MensajeDocumentStatus->processName;
  $processStatus=$EmitirComprobanteResult->MensajeDocumentStatus->processStatus;
  $processDate=$EmitirComprobanteResult->MensajeDocumentStatus->processDate;
  $messageType=$EmitirComprobanteResult->MensajeDocumentStatus->messageType;
  $errorMessage=$EmitirComprobanteResult->MensajeDocumentStatus->errorMessage;
  $businessStatus=$EmitirComprobanteResult->MensajeDocumentStatus->businessStatus;

  //get CUFE
  $Status=$EmitirComprobanteResult->MensajeRespuestaCUFE->Status;
  $CUFE=$EmitirComprobanteResult->MensajeRespuestaCUFE->CUFE;

  if(!empty($XMLFiscalValido) and empty($errorMessage)){

    $myfilexmlResponse = fopen($path . "filename.xml", "w");
                fwrite($myfilexmlResponse, $XMLFiscalValido);
                fclose($myfilexmlResponse);


    echo 'Done!';

  }
  else{
    echo $errorMessage;
  }

  echo '<br><br>';
  var_dump($result);



} catch (SoapFault $fault) {
    print("
    alert('Sorry, blah returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.". We will now take you back to our home page.');
    window.location = 'main.php';
    ");
}
catch (Exception $e){
  echo 'Error: '.$e->getMessage();
}
?>
