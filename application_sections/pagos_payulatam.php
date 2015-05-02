
<?php
     $numero_pedido         = Session::Get('numero_pedido');
     $vr_total_pedido       = Session::Get('vr_total_pedido');
     $baseIva               = Session::Get('Vr_Base_Iva');
     $pnombre               = utf8_encode(Session::Get('nombre_cliente'));
     $email                 = utf8_encode(Session::Get('email'));
     $identificacion        = Session::Get('identificacion');
     $signature             = md5 ("4uiapnu24digpg1gb05pntuge3~511623~".$numero_pedido."~".$vr_total_pedido."~COP")
?>


<form name="formPaypal" action="https://gateway.payulatam.com/ppp-web-gateway" method="post" id="">
    <input type="hidden" name="merchantId"          id="merchantId" value="511623" />
    <input type="hidden" name="referenceCode"       id="referenceCode"          value = "<?= $numero_pedido ; ?>" />
    <input type="hidden" name="description"         id="description"            value = "<?= "Pedido No. ".$numero_pedido ; ?>" />
    <input type="hidden" name="amount"              id="amount"                 value = "<?= $vr_total_pedido; ?>" />
    <input type="hidden" name="tax"                 id="tax"                    value = "<?= $vr_total_pedido -  $baseIva ;?>" />
    <input type="hidden" name="taxReturnBase"       id="taxReturnBase"          value = "<?= $baseIva ; ?>" />
    <input type="hidden" name="baseDevolucionIva"   id="baseDevolucionIva"      value = "0" />
    <input type="hidden" name="signature"           id="signature"              value = "<?= $signature ; ?>">
    <input type="hidden" name="accountId"           id="accountId"              value = "512832">
    <input type="hidden" name="currency"            id="currency"               value = "COP">
    <input type="hidden" name="payerFullName"       id="buyerEmail"             value = "<?= $pnombre ;?>">
    <input type="hidden" name="buyerEmail"          id="buyerEmail"             value = "<?=  $email ; ?>">
    <input type="hidden" name="payerDocument"       id="payerDocument"          value = "<?= $identificacion ; ?>">
</form>
