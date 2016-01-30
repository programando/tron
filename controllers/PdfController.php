<?php

class PdfController extends Controller
{
    private $Pdf;


    public function __construct() {
        parent::__construct();

          $this->Pdf    = $this->Load_External_Library('tcpdf');
          $this->Pdf    = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    }

    public function index(){}


    public function Convenio_Comercial() {
        $this->Pdf->setFooterData(array(0,64,0), array(0,64,128));
        $this->Pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->Pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->Pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->Pdf->setFontSubsetting(true);
        $this->Pdf->SetFont('helvetica', '', 12, '', false);
        // set auto page breaks
        $this->Pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        # creamos una página en blanco
        $texto_convenio_comercial =  file_get_contents(BASE_PDFS.'convenio_comercial.php','r');

        $fecha_hora_acepta_convenio = Session::Get('fecha_hora_acepta_convenio');

        if (isset($fecha_hora_acepta_convenio )){
            $encabezado ='Firmado digitalmente por ' . Session::Get('nombre_usuario_pedido')  ;
            $encabezado = $encabezado . ' con ' . Session::Get('cod_tp_identificacion').  '. ' . Session::Get('identificacion');
            $encabezado = $encabezado  . ' el ' . strtoupper($fecha_hora_acepta_convenio);
            $this->Pdf->setHeaderFont(Array('helvetica', 'I', 8));
            $this->Pdf->SetHeaderData('', 10, $encabezado, '');
        }

        $this->Pdf->Addpage();
        $this->Pdf->Write(0,'CONVENIO COMERCIAL DE LA RED DE AMIGOS TRON DE BALQUIMIA S.A.S.','',0,'C',1);
        # visualizamos el documento
        $this->Pdf->WriteHTML($texto_convenio_comercial, $ln=true, $fondo=false, $reseth=false, $cell=false, $alineacion='J');
        $this->Pdf->Output();

        /*$this->Pdf->Output($nombre_archivo,'I');
        <a href="algunarchivo" target="_blank">Link</a>
        */
    }


}

?>
