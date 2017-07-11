<?php

class PdfController extends Controller
{
    private $Pdf;


    public function __construct() {
        parent::__construct();

        //$this->Pdf    =  $this->Load_External_Library('tcpdf/tcpdf');
        //$this->Pdf    = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->Pdf = $this->Load_External_Library('fpdf/app_pdf');
        $this->Pdf = new PDF();
    }

    public function index(){}


    public function abrir_archivo( $nombre_archivo ){

        $mi_pdf = BASE_STATIC_FILES .  $nombre_archivo;
        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="'.$mi_pdf.'"');
        readfile($mi_pdf);

    }


    public function Convenio_Comercial() {
        $encabezado                 = '';
        $fecha_hora_acepta_convenio = Session::Get('fecha_hora_acepta_convenio');

        if (isset($fecha_hora_acepta_convenio )){
            $encabezado ='Convenio comercial firmado digitalmente por : ' . Session::Get('nombre_usuario_pedido')  ;
            $encabezado = $encabezado .  ' con ' . Session::Get('cod_tp_identificacion').  '. ' . Session::Get('identificacion');
            $encabezado = $encabezado  . ' en ' . strtoupper($fecha_hora_acepta_convenio);
        }
        $this->Pdf->AddPage();
        $this->Pdf->Header($encabezado);

        $this->Pdf->SetFont('Arial','I',13);
        $this->Pdf->Cell(190,10, "CONVENIO COMERCIAL DE LA RED DE AMIGOS TRON - BALQUIMIA S.A.S." ,0,0,'C');
        $texto_convenio_comercial   =  file_get_contents(BASE_PDFS.'convenio_comercial.php','r');
        $texto_convenio_comercial   = utf8_decode($texto_convenio_comercial );
        $this->Pdf->SetFont('Arial','',9);
        $this->Pdf->WriteHTML('<br><br>'.  $texto_convenio_comercial);

        $this->Pdf->Output();


        //$html  = $html.'<style> .justy { text-align: justify;} </style> <div class="justy ">Texto justificado</div>';

    }


    public function Convenio_Comercial_olf() {

        set_time_limit(300);
        $this->Pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set header and footer fonts
        $this->Pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->Pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->Pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->Pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->Pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->Pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->Pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set default font subsetting mode
        $this->Pdf->setFontSubsetting(true);

        $encabezado                 = '';
        $fecha_hora_acepta_convenio = Session::Get('fecha_hora_acepta_convenio');

        if (isset($fecha_hora_acepta_convenio )){
            $encabezado ='Convenio comercial firmado digitalmente por :' . Session::Get('nombre_usuario_pedido')  ;
            $encabezado = $encabezado . ' con ' . Session::Get('cod_tp_identificacion').  '. ' . Session::Get('identificacion');
            $encabezado = $encabezado  . ' el ' . strtoupper($fecha_hora_acepta_convenio);
            $this->Pdf->setHeaderFont(Array('helvetica', 'I', 8));
            $this->Pdf->SetHeaderData(PDF_HEADER_LOGO, 25,  $encabezado, '', array(0,64,255), array(0,64,128));
        }

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $this->Pdf->AddPage();
        $this->Pdf->Write(0,'CONVENIO COMERCIAL DE LA RED DE AMIGOS TRON DE BALQUIMIA S.A.S.','',0,'C',1);
        // Set some content to print
        $texto_convenio_comercial   =  file_get_contents(BASE_PDFS.'convenio_comercial.php','r');

        $this->Pdf->WriteHTML($texto_convenio_comercial, $ln=true, $fondo=false, $reseth=false, $cell=false, $alineacion='J');

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        ob_end_clean();
        $this->Pdf->Output('example_001.pdf', 'I');
    }

 }

?>
