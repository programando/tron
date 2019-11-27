<?php

class FacturaElectronicaController extends Controller
{
    private $TxtoWbSrvce, $id_fact_elctrnca;
    private $_01_Enc, $_02_Emi, $_03_Adq, $_04_Tot, $_05_Imp, $_06_Dsc;
    private $_07_Drf, $_08_Ttd, $_09_Not, $_10_Ref, $_11_Fe1, $_12_Ite;
    private $TotalDscto, $TotalFletes, $VrBaseDcmnto , $TipoDocumento;
    private $Coma = ';' ;
    private $Salto = '';

    public function __construct() {
        parent::__construct();
        $this->Factura = $this->Load_Model('FacturaElectronica');
        $this->Correos             = $this->Load_Controller('Emails');
    }

    public function index(){}



    private function enviarDocumentoFacturaTech( $CadenaWebService, $id_fact_elctrnca  ){
        ini_set("display_errors","On");
        $param          = array('LayOut' =>    $CadenaWebService );
        $CUFE           = '';
        $documentNumber = '';
        $error          = 0;
        $transactionId  = '';
        Debug::Mostrar( $CadenaWebService );
        //return ;
         try {
            $client                  = new SoapClient('http://webservice.facturatech.co/WSFacturatechPruebEstruc21.asmx?WSDL');
            //$result                  = $client->__call("EmitirComprobante", array( $param ) );
            $result                  = $client->__call("ValidarLayout21", array( $param ) );
            $EmitirComprobanteResult = $result->EmitirComprobanteResult;
            Debug::Mostrar ( $EmitirComprobanteResult ) ;
            /*
              $fileName                = $EmitirComprobanteResult->fileName;
              $processName             = $EmitirComprobanteResult->MensajeDocumentStatus->processName;

              $processDate             = $EmitirComprobanteResult->MensajeDocumentStatus->processDate;
              $messageType             = $EmitirComprobanteResult->MensajeDocumentStatus->messageType;
              $businessStatus          = $EmitirComprobanteResult->MensajeDocumentStatus->businessStatus;

            */

            $Status                  = $EmitirComprobanteResult->MensajeRespuestaCUFE->Status;
            $XMLFiscalValido         = $EmitirComprobanteResult->XMLFiscalValido;
            $documentNumber          = $EmitirComprobanteResult->documentNumber;
            $transactionId           = $EmitirComprobanteResult->ID;
            $errorMessage            = $EmitirComprobanteResult->MensajeDocumentStatus->errorMessage;
            $processStatus           = $EmitirComprobanteResult->MensajeDocumentStatus->processStatus;
            //$CUFE                    = $EmitirComprobanteResult->MensajeRespuestaCUFE->CUFE;

            $this->VerificarFirmaDocumento  ( $XMLFiscalValido, $errorMessage,$processStatus,  $id_fact_elctrnca, $transactionId, $documentNumber, 'CUFE'  );
            //$this->VerificarErrorEstructura ( $EmitirComprobanteResult->MensajeErrorLAYOUT , $id_fact_elctrnca);

          } catch (SoapFault $fault) {
              $errorMessage = 'Sorry, blah returned the following Soap ERROR ' . $fault->faultcode."-".$fault->faultstring ;
              Debug::Mostrar( $errorMessage );
              //$this->Factura->fact_01_Respuesta_Operador( $id_fact_elctrnca , $errorMessage, $transactionId , $documentNumber, 'CUFE');
            }

            catch (Exception $e){
                $errorMessage =  'Error: '. $e->getMessage();
                Debug::Mostrar( $errorMessage );
              //$this->Factura->fact_01_Respuesta_Operador( $id_fact_elctrnca , $errorMessage, $transactionId , $documentNumber, 'CUFE' );
          }
  }

      private function VerificarFirmaDocumento ( $XMLFiscalValido, $errorMessage, $processStatus, $id_fact_elctrnca, $transactionId, $documentNumber, $CUFE){

           if (!empty( $XMLFiscalValido ) and $processStatus == 'OK' ){
                $this->Factura->fact_01_Respuesta_Operador( $id_fact_elctrnca , $errorMessage, $transactionId , $documentNumber, 'CUFE' );
            }
            else {
                $errorMessage = '--> ERROR --> ' . $errorMessage ;
                $this->Factura->fact_01_Respuesta_Operador( $id_fact_elctrnca , $errorMessage, $transactionId , $documentNumber, 'CUFE' );
            }
      }

      private  function VerificarErrorEstructura (  $ErrorEstructura, $id_fact_elctrnca ){
         $ErrorEstructuraVacio =  (array)$ErrorEstructura ;
          if  ( empty( $ErrorEstructuraVacio ) )   return ;
          //$ErrorEstructura = $ErrorEstructura->string;
          foreach ( $ErrorEstructura as $Error) {
              $this->Factura->fact_01_UpdateErroresLayout( $id_fact_elctrnca ,$Error );
          }
          //$this->Correos->FacturaElectronicaError ( implode( "," ,$ErrorEstructura), $id_fact_elctrnca );
      }

    public function emitirFacturas ()    {
      $FacturasPendientes = $this->Factura->fact_01_enc();
      foreach ( $FacturasPendientes as $Factura ) {
           $this->_01_Enc    = $Factura;
           $id_fact_elctrnca = $Factura['id_fact_elctrnca']  ;
           $this->configuraDatosFactura( $id_fact_elctrnca );
           $this->enviarDocumentoFacturaTech( $this->TxtoWbSrvce, $id_fact_elctrnca ) ;
           //$this->Factura->fact_01_UpdateCadenaWebService($id_fact_elctrnca, $this->TxtoWbSrvce) ;
        }

    }

    public function configuraDatosFactura ( $id_fact_elctrnca ) {

      $this->id_fact_elctrnca = $id_fact_elctrnca ;
      /*-------------------------------------------------------------------
        LLAMADA A CADA UNO DE LO PROCEDIMIENTOS ALMACENADOS
      */
      $this->_02_Emi = $this->Factura->fact_02_emi ( $this->id_fact_elctrnca );
      $this->_03_Adq = $this->Factura->fact_03_adq ( $this->id_fact_elctrnca );
      $this->_04_Tot = $this->Factura->fact_04_tot ( $this->id_fact_elctrnca );
      $this->_05_Imp = $this->Factura->fact_05_imp ( $this->id_fact_elctrnca );
      $this->_07_Drf = $this->Factura->fact_07_drf ( $this->id_fact_elctrnca );
      $this->_12_Ite = $this->Factura->fact_12_ite ( $this->id_fact_elctrnca );

     /* $this->_06_Dsc = $this->Factura->fact_06_dsc ( $this->id_fact_elctrnca );

      $this->_08_Ttd = $this->Factura->fact_08_ttd ( $this->id_fact_elctrnca );
      $this->_09_Not = $this->Factura->fact_09_not ( $this->id_fact_elctrnca );
      $this->_10_Ref = $this->Factura->fact_10_ref ( $this->id_fact_elctrnca );
      $this->_11_Fe1 = $this->Factura->fact_11_fe1 ( $this->id_fact_elctrnca );

        */
      $this->TipoDocumento = $this->_02_Emi[0]['_01_tp_doc'] ;


      $this->InicioArchivo(  );
      $this->Fact_01_ENC () ;
      $this->Fact_02_EMI () ;
      $this->Fact_03_TAC();
      $this->Fac_04_DEF();
      $this->Fac_05_GTE();
      $this->Fact_03_ADQ () ;
      $this->Fact_TCR () ;
      $this->Fact_ILA () ;
      $this->Fact_ICR () ;
      $this->Fact_GTA () ;
      $this->Fact_04_TOT () ;
      $this->Fact_05_IMP () ;
      $this->Fact_06_DRF () ;
      $this->Fact_12_ITE () ;

      /*$this->Fact_06_DSC () ;
      $this->Fact_08_TTD () ;
      $this->Fact_09_NOT () ;
      $this->Fact_10_REF () ;
      $this->Fact_11_FE1 () ;
      */

      if ( $this->TipoDocumento == 'INVOIC')  $this->TxtoWbSrvce .= $this->Salto . '[/FACTURA]'  ;
      if ( $this->TipoDocumento == 'NC')  $this->TxtoWbSrvce .= $this->Salto . '[/NOTANC]'  ;
      if ( $this->TipoDocumento == 'ND')  $this->TxtoWbSrvce .= $this->Salto . '[/NOTADR]'  ;


      return $this->id_fact_elctrnca ;
    }

    private function InicioArchivo(  ){
      $this->TxtoWbSrvce = '';
      $this->TxtoWbSrvce = '[900755214]';
      $this->TxtoWbSrvce .=  '[DEMO900755214_1]';
      $this->TxtoWbSrvce .=  '[SI]';
      if ( $this->TipoDocumento == 'INVOIC')  $this->TxtoWbSrvce .=  '[FACTURA]';
      if ( $this->TipoDocumento == 'NC')  $this->TxtoWbSrvce .=  '[NOTANC]';
      if ( $this->TipoDocumento == 'ND')  $this->TxtoWbSrvce .=  '[NOTADR]';

      $this->TxtoWbSrvce .=  '';
      $this->TxtoWbSrvce .=   '' ; // '[BZF%C7x1]';

    }

    private function Fact_01_ENC (){
        $this->TxtoWbSrvce .= $this->Salto . '(PDF)PDF_1:P1;(/PDF)'  . $this->Salto ;
        $this->TxtoWbSrvce .= $this->Salto . '(ENC)'  . $this->Salto ;
        $this->TxtoWbSrvce .= 'ENC_1:'. $this->_01_Enc['_01_tp_doc']       . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_2:'. $this->_01_Enc['_02_nit_emprsa']   . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_3:'. $this->_01_Enc['_03_nit_clinte']   . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_4:'. $this->_01_Enc['_04_vrsion_equma'] . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_5:'. $this->_01_Enc['_05_vrsion_frmto'] . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_6:'. $this->_01_Enc['_06_nro_fctra']    . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_7:'. $this->_01_Enc['_07_fcha_fctra']   . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_8:'. $this->_01_Enc['_08_hra_fctra']    . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_9:'. $this->_01_Enc['_09_tp_fctra']     . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_10:'.$this->_01_Enc['_10_mnda']         . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_15:'.$this->_01_Enc['_15_nro_lineas']   . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_16:'.$this->_01_Enc['_16_fcha_vncmnto'] . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_20:'.$this->_01_Enc['_20_ambnte'] . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ENC_21:'.$this->_01_Enc['_21_tp_oprcion'] . $this->Coma  . $this->Salto  ;

      $this->TxtoWbSrvce .= '(/ENC)'  . $this->Salto;
    }

    private function Fact_02_EMI () {
      $this->TxtoWbSrvce .=      $this->Salto . '(EMI)'  . $this->Salto;
          $this->TxtoWbSrvce .= 'EMI_1:'. $this->_02_Emi[0]['_01_tp_prsna']       . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_2:'. $this->_02_Emi[0]['_02_nit_emprsa']     . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_3:'. $this->_02_Emi[0]['_03_tp_doc']         . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_4:'. $this->_02_Emi[0]['_04_rgmen']          . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_6:'. $this->_02_Emi[0]['_06_emprsa']         . $this->Coma  . $this->Salto  ;
          $this->generaNodoSiExiste ( 'EMI_6',  $this->_02_Emi[0]['_07_nom_ccial']   );
          $this->TxtoWbSrvce .= 'EMI_10:'. $this->_02_Emi[0]['_10_drccion']       . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_11:'. $this->_02_Emi[0]['_11_dpto']          . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_13:'. $this->_02_Emi[0]['_13_mcipio']        . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_15:'. $this->_02_Emi[0]['_15_pais']          . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_19:'. $this->_02_Emi[0]['_19_dpto']          . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_21:'. $this->_02_Emi[0]['_21_pais']          . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_22:'. $this->_02_Emi[0]['_22_dv_emprsa']          . $this->Coma  . $this->Salto  ;
          $this->TxtoWbSrvce .= 'EMI_23:'. $this->_02_Emi[0]['_23_cod_mcipio']          . $this->Coma  . $this->Salto  ;
          $this->generaNodoSiExiste ( 'EMI_24',  $this->_02_Emi[0]['_07_nom_ccial']   );
      $this->TxtoWbSrvce .= $this->Salto . '(/EMI)'  ;
    }

    private function Fact_03_TAC () {

        $this->TxtoWbSrvce .=      $this->Salto . '(TAC)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'TAC_1:'. $this->_02_Emi[0]['_tac_01']       . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= $this->Salto . '(/TAC)'  ;

      }


      private function Fac_04_DEF (){
        if ( $this->TipoDocumento == 'INVOIC' ){
            $this->TxtoWbSrvce .=      $this->Salto . '(DEF)'  . $this->Salto;
            $this->TxtoWbSrvce .= 'DFE_1:'. $this->_02_Emi[0]['_23_cod_mcipio'] . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DFE_2:'. $this->_02_Emi[0]['_11_dpto']       . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DFE_3:'. $this->_02_Emi[0]['_15_pais']       . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= $this->Salto . '(/DEF)'  ;
        }
    }

    private function Fac_05_GTE (){
        $this->TxtoWbSrvce .=      $this->Salto . '(GTE)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'GTE_1:01'. $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'GTE_2:IVA'. $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= $this->Salto . '(/GTE)'  ;
    }




    private function Fact_03_ADQ () {
          $this->TxtoWbSrvce .=      $this->Salto . '(ADQ)'  . $this->Salto;
          $this->generaNodoSiExiste ( 'ADQ_1',  $this->_03_Adq[0]['_01_tp_prsna']   );
          $this->generaNodoSiExiste ( 'ADQ_2',  $this->_03_Adq[0]['_02_nit_emprsa']   );
          $this->generaNodoSiExiste ( 'ADQ_3',  $this->_03_Adq[0]['_03_tp_doc']   );
          $this->generaNodoSiExiste ( 'ADQ_4',  $this->_03_Adq[0]['_04_rgmen']   );
          $this->generaNodoSiExiste ( 'ADQ_6',  $this->_03_Adq[0]['_06_emprsa']   );
          $this->generaNodoSiExiste ( 'ADQ_7',  $this->_03_Adq[0]['_07_nom_ccial']   );
          $this->generaNodoSiExiste ( 'ADQ_8',  $this->_03_Adq[0]['_09_ape_prsna_ntral']  );
          $this->generaNodoSiExiste ( 'ADQ_10',  utf8_encode($this->_03_Adq[0]['_10_drccion']) );
          $this->generaNodoSiExiste ( 'ADQ_11',  $this->_03_Adq[0]['_11_dpto'] );
          $this->generaNodoSiExiste ( 'ADQ_13',  $this->_03_Adq[0]['_13_mcipio'] );
          $this->generaNodoSiExiste ( 'ADQ_15',  $this->_03_Adq[0]['_15_pais'] );
          $this->generaNodoSiExiste ( 'ADQ_22',  $this->_03_Adq[0]['_22_dv_adq'] );
          $this->TxtoWbSrvce .= $this->Salto . '(/ADQ)'  ;
    }

    private function Fact_TCR () {
        $this->TxtoWbSrvce .=      $this->Salto . '(TCR)'  . $this->Salto;
          $this->generaCampoInterno ('TCR', $this->_03_Adq[0]['tcr_01'] ) ;
        $this->TxtoWbSrvce .= $this->Salto . '(/TCR)'  ;
    }

    private function Fact_ILA () {
        if ( !empty( $this->_03_Adq[0]['_07_nom_ccial'] ) )  {
           $this->TxtoWbSrvce .=      $this->Salto . '(ILA)'  . $this->Salto;
           $this->generaNodoSiExiste ( 'ILA_1',  $this->_03_Adq[0]['_07_nom_ccial']   );
           $this->TxtoWbSrvce .= $this->Salto . '(/ILA)'  ;
        }
    }


    private function Fact_ICR () {
        if ( $this->_03_Adq[0]['_01_tp_prsna'] == '1' && !empty($this->_03_Adq[0]['icr_num_mtrcla_mcntil_clnte']) ){
           $this->TxtoWbSrvce .=      $this->Salto . '(ICR)'  . $this->Salto;
            $this->generaNodoSiExiste ( 'ICR_1',  $this->_03_Adq[0]['icr_num_mtrcla_mcntil_clnte']   );
           $this->TxtoWbSrvce .= $this->Salto . '(/ICR)'  ;
        }
    }

    private function Fact_GTA (){
        $this->TxtoWbSrvce .=      $this->Salto . '(GTA)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'GTA_1:01'. $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'GTA_2:IVA'. $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= $this->Salto . '(/GTA)'  ;
    }






    private function Fact_04_TOT () {
        $this->TotalFletes  = 0;
        $this->VrBaseDcmnto = 0;
        $this->TxtoWbSrvce .=      $this->Salto . '(TOT)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'TOT_1:'. $this->_04_Tot[0]['_01_sub_total']             . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_2:'. $this->_04_Tot[0]['_02_mnda']                  . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_3:'. $this->_04_Tot[0]['_03_base_impsto']           . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_4:'. $this->_04_Tot[0]['_04_mnda']                  . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_5:'. $this->_04_Tot[0]['_05_tot_fctra']             . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_6:'. $this->_04_Tot[0]['_06_mnda']                  . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_7:'. $this->_04_Tot[0]['_07_tot_fctra']             . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'TOT_8:'. $this->_04_Tot[0]['_08_mnda']                  . $this->Coma  . $this->Salto  ;
        $this->Fact_04_TOT_Descuentos();
        $this->Fact_04_TOT_Fletes();
        $this->TxtoWbSrvce .= $this->Salto . '(/TOT)'  ;
        $this->VrBaseDcmnto =  $this->_04_Tot[0]['_03_base_impsto'] ;
    }

    private function Fact_04_TOT_Descuentos (){
        $this->TotalDscto   =  $this->_04_Tot[0]['_09_dsctos'] ;
        if ( $this->TotalDscto > 0 ) {
              $this->TxtoWbSrvce .= 'TOT_9:'. $this->TotalDscto                . $this->Coma  . $this->Salto  ;
              $this->TxtoWbSrvce .= 'TOT_10:'. $this->_04_Tot[0]['_10_mnda']                 . $this->Coma  . $this->Salto  ;
          }

    }

    private function Fact_04_TOT_Fletes(){
        $this->TotalFletes  =  $this->_04_Tot[0]['_11_tot_crgos'] ;
        if ( $this->TotalFletes > 0 )  {
              $this->TxtoWbSrvce .= 'TOT_11:'. $this->TotalFletes           . $this->Coma  . $this->Salto  ;
              $this->TxtoWbSrvce .= 'TOT_12:'. $this->_04_Tot[0]['_12_mnda']                 . $this->Coma  . $this->Salto  ;
           }
        }





    private function Fact_05_IMP () {
        $this->TxtoWbSrvce .=      $this->Salto . '(IMP)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'IMP_1:'. $this->_05_Imp[0]['imp_01_tp_impsto']     . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'IMP_2:'. $this->_05_Imp[0]['imp_02_base']          . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'IMP_3:'. $this->_05_Imp[0]['imp_03_mnda']          . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'IMP_4:'. $this->_05_Imp[0]['imp_04_vr_impsto']     . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'IMP_5:'. $this->_05_Imp[0]['imp_05_mnda']          . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'IMP_6:'. $this->_05_Imp[0]['imp_06_pctje']         . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= $this->Salto . '(/IMP)'  ;

    }

    private function Fact_06_DSC () {
        if ( $this->TotalDscto > 0 ) {
            $this->TxtoWbSrvce .=      $this->Salto . '(DSC)'  . $this->Salto;
            $this->TxtoWbSrvce .= 'DSC_1:'. $this->_06_Dsc[0]['_01_tp_dscto']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_2:'. $this->_06_Dsc[0]['_02_pctje']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_3:'. $this->_06_Dsc[0]['_03_vr_dscto']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_4:'. $this->_06_Dsc[0]['_04_mnda']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_5:'. $this->_06_Dsc[0]['_05_cod_dscto']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_6:'. 'DESCUENTO COMERCIAL'              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_7:'. $this->VrBaseDcmnto              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_8:'. $this->_06_Dsc[0]['_08_mnda']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_9:'. $this->_06_Dsc[0]['_09_indcdor']              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= $this->Salto . '(/DSC)'  ;
      }
        if ( $this->TotalFletes > 0 ) {
            $this->TxtoWbSrvce .=      $this->Salto . '(DSC)'               . $this->Salto;
            $this->TxtoWbSrvce .= 'DSC_1:'. 'true'                          . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_2:'. '0'                             . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_3:'. $this->TotalFletes              . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_4:'. 'COP'                           . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_5:'. '55'                            . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_6:'. 'FLETE PRODUCTOS'               . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_8:'. $this->_06_Dsc[0]['_08_mnda']   . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DSC_9:'. '2'                             . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= $this->Salto . '(/DSC)'  ;
      }

    }

    private function Fact_06_DRF () {
        $this->TxtoWbSrvce .=      $this->Salto . '(DRF)'  . $this->Salto;
         if ( $this->TipoDocumento == 'INVOIC') {
            $this->TxtoWbSrvce .= 'DRF_1:'. $this->_07_Drf[0]['_01_num_rslcion']        . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DRF_2:'. $this->_07_Drf[0]['_02_fcha_ini']           . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'DRF_3:'. $this->_07_Drf[0]['_03_fcha_fin']           . $this->Coma  . $this->Salto  ;
        }

        $this->TxtoWbSrvce .= 'DRF_4:'. $this->_07_Drf[0]['_04_prfjo']              . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'DRF_5:'. $this->_07_Drf[0]['_05_num_ini']            . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'DRF_6:'. $this->_07_Drf[0]['_06_num_fin']            . $this->Coma  . $this->Salto  ;
       $this->TxtoWbSrvce .= $this->Salto . '(/DRF)'  ;
    }

    public function Fact_08_TTD () {
        $this->TxtoWbSrvce .=      $this->Salto . '(ITD)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'ITD_1:'. $this->_08_Ttd[0]['_01_impstos']           . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ITD_2:'. $this->_08_Ttd[0]['_02_mnda']              . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ITD_5:'. $this->_08_Ttd[0]['_05_tot_fctra']         . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'ITD_6:'. $this->_08_Ttd[0]['_06_mnda']              . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= $this->Salto . '(/ITD)'  ;
    }

    public function Fact_09_NOT () {

        if ( !empty( trim ( $this->_09_Not[0]['_01_notas'] ))) {
            $this->TxtoWbSrvce .=      $this->Salto . '(NOT)'  . $this->Salto;
            $this->TxtoWbSrvce .= 'NOT_1:'. $this->_09_Not[0]['_01_notas']           . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= $this->Salto . '(/NOT)'  ;
          }
            $this->TxtoWbSrvce .=      $this->Salto . '(ORC)'  . $this->Salto;
           $this->TxtoWbSrvce .= 'ORC_1:'. $this->_09_Not[0]['ord_cpra']           . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= $this->Salto . '(/ORC)'  ;
    }

    public function Fact_10_REF () {
        $this->TxtoWbSrvce .=      $this->Salto . '(REF)'  . $this->Salto;
        $this->TxtoWbSrvce .= 'REF_1:'. $this->_10_Ref[0]['_01_tp_doc']         . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'REF_2:'. $this->_10_Ref[0]['_02_num_doc']        . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= 'REF_3:'. $this->_10_Ref[0]['_03_fcha']           . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= $this->Salto . '(/REF)'  ;
        //$this->generaCampoInterno( 'CTS', $this->_01_Enc[0]['cts_01_cod_plntlla_fctra'] );
    }

    public function Fact_11_FE1 () {
        /// FACTURA DE EXPORTACIÓN
    }

    public function Fact_12_ITE () {
        foreach ($this->_12_Ite as $Producto ) {
            $this->TxtoWbSrvce .=      $this->Salto . '(ITE)'  . $this->Salto;
            $this->TxtoWbSrvce .= 'ITE_1:'. $Producto['_01_consecutivo']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_2:'. $Producto['_02_tp_reg']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_3:'. $Producto['_03_cant']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_4:'. $Producto['_04_und_med']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_5:'. $Producto['_05_csto_total']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_6:'. $Producto['_06_mnda']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_7:'. $Producto['_07_vr_unit']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_8:'. $Producto['_08_mnda']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_11:'. utf8_encode ($Producto['_11_nom_prdcto'])         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_12:'. $Producto['_12_nom_prdcto']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_14:'. $Producto['_14_und_med']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_19:'. $Producto['_19_total_item']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_20:'. $Producto['_20_mnda']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_21:'. $Producto['_21_total_item']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_22:'. $Producto['_22_mnda']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_27:'. $Producto['_27_cantidad']         . $this->Coma  . $this->Salto  ;
            $this->TxtoWbSrvce .= 'ITE_28:'. $Producto['_28_unidad']         . $this->Coma  . $this->Salto  ;

           $this->TxtoWbSrvce .= $this->Salto . '(/ITE)'  ;
        }
    }



    private function generaCampoInterno( $Texto, $Campo ){
        $this->TxtoWbSrvce .= $this->Salto . '('. $Texto .  ')'                   ;
        $this->TxtoWbSrvce .= $this->Salto . $Texto .    '_1:' . $Campo         . $this->Coma  . $this->Salto  ;
        $this->TxtoWbSrvce .= '(/' . $Texto . ')' ;
     }

     private function generaNodoSiExiste ( $Nodo, $Valor ){
       if ( !empty( $Valor  ))
           $this->TxtoWbSrvce .= "$Nodo:". $Valor                . $this->Coma  . $this->Salto  ;
     }


  }
?>
