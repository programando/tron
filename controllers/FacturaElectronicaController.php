<?php

class FacturaElectronicaController extends Controller
{
    private $TxtoWbSrvce, $id_fact_elctrnca;
    private $_01_Enc, $_02_Emi, $_03_Adq, $_04_Tot, $_05_Imp, $_06_Dsc;
    private $_07_Drf, $_08_Ttd, $_09_Not, $_10_Ref, $_11_Fe1, $_12_Ite;

    private $Coma = ';'. "\n";
    public function __construct() {
        parent::__construct();
        $this->Factura = $this->Load_Model('FacturaElectronica');
    }

    public function index(){}

    public function EmitirFactura () {
      $this->_01_Enc = $this->Factura->fact_01_enc();
      $this->id_fact_elctrnca = $this->_01_Enc[0]['id_fact_elctrnca'];
      /*-------------------------------------------------------------------*/
      $this->_02_Emi = $this->Factura->fact_02_emi ( $this->id_fact_elctrnca );
      /*
      $this->_03_Adq = $this->Factura->fact_03_adq ( $this->id_fact_elctrnca );
      $this->_04_Tot = $this->Factura->fact_04_tot ( $this->id_fact_elctrnca );
      $this->_05_Imp = $this->Factura->fact_05_imp ( $this->id_fact_elctrnca );
      $this->_06_Dsc = $this->Factura->fact_06_dsc ( $this->id_fact_elctrnca );
      $this->_07_Drf = $this->Factura->fact_07_drf ( $this->id_fact_elctrnca );
      $this->_08_Ttd = $this->Factura->fact_08_ttd ( $this->id_fact_elctrnca );
      $this->_09_Not = $this->Factura->fact_09_not ( $this->id_fact_elctrnca );
      $this->_10_Ref = $this->Factura->fact_10_ref ( $this->id_fact_elctrnca );
      $this->_11_Fe1 = $this->Factura->fact_11_fe1 ( $this->id_fact_elctrnca );
      $this->_12_Ite = $this->Factura->fact_12_ite ( $this->id_fact_elctrnca );
      */

      $this->InicioArchivo();
      $this->Fact_01_ENC();
      $this->Fact_02_EMI();
      Debug::Mostrar ( $this->TxtoWbSrvce) ;
      Debug::Mostrar ( $this->_02_Emi) ;
    }

    private function InicioArchivo(){
      $this->TxtoWbSrvce = '';
      $this->TxtoWbSrvce = 'LayOut => "[900755214]';
      $this->TxtoWbSrvce .=  '[DEMO900755214_1]';
      $this->TxtoWbSrvce .=  '[SI]';
      $this->TxtoWbSrvce .=  '[FACTURA]';
      $this->TxtoWbSrvce .=  '[nit900755214@facturatech.co]';
      $this->TxtoWbSrvce .=  '[YsgU_fGM]';
    }

    private function Fact_01_ENC (){
      $this->TxtoWbSrvce .= '(ENC)';
        $this->TxtoWbSrvce .= 'ENC_1:'. $this->_01_Enc[0]['_01_tp_doc']       . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_2:'. $this->_01_Enc[0]['_02_nit_emprsa']   . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_3:'. $this->_01_Enc[0]['_03_nit_clinte']   . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_4:'. $this->_01_Enc[0]['_04_vrsion_equma'] . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_5:'. $this->_01_Enc[0]['_05_vrsion_frmto'] . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_6:'. $this->_01_Enc[0]['_06_nro_fctra']    . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_7:'. $this->_01_Enc[0]['_07_fcha_fctra']   . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_8:'. $this->_01_Enc[0]['_08_hra_fctra']    . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_9:'. $this->_01_Enc[0]['_09_tp_fctra']     . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_10:'.$this->_01_Enc[0]['_10_mnda']         . $this->Coma  ;
        $this->TxtoWbSrvce .= 'ENC_16:'.$this->_01_Enc[0]['_16_fcha_vncmnto'] . $this->Coma  ;
      $this->TxtoWbSrvce .= '(/ENC)';
    }

    private function Fact_02_EMI () {
      $this->TxtoWbSrvce .= '(EMI)';
          $this->TxtoWbSrvce .= 'EMI_1:'. $this->_02_Emi[0]['_01_tp_prsna']       . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_2:'. $this->_02_Emi[0]['_02_nit_emprsa']     . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_3:'. $this->_02_Emi[0]['_03_tp_doc']         . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_4:'. $this->_02_Emi[0]['_04_rgmen']          . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_6:'. $this->_02_Emi[0]['_06_emprsa']         . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_10:'. $this->_02_Emi[0]['_10_drccion']       . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_11:'. $this->_02_Emi[0]['_11_dpto']          . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_12:'. $this->_02_Emi[0]['_12_mcipio']        . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_13:'. $this->_02_Emi[0]['_13_mcipio']        . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_15:'. $this->_02_Emi[0]['_15_pais']          . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_19:'. $this->_02_Emi[0]['_19_dpto']          . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_20:'. $this->_02_Emi[0]['_20_mcipio']        . $this->Coma  ;
          $this->TxtoWbSrvce .= 'EMI_21:'. $this->_02_Emi[0]['_21_pais']          . $this->Coma  ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_1']  ) ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_2']  ) ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_3']  ) ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_4']  ) ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_5']  ) ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_6']  ) ;
          $this->Fact_02_EMI_TAC ( $this->_02_Emi[0]['_tac_01_rut_53_7']  ) ;
          $this->TxtoWbSrvce .= '(ICC)'                                               . $this->Coma  ;
          $this->TxtoWbSrvce .= 'ICC_1:NUMERO MATRICULA MERCANTIL'                    . $this->Coma  ;
          $this->TxtoWbSrvce .= '(/ICC)';
      $this->TxtoWbSrvce .= '(/EMI)';
    }

    private function Fact_02_EMI_TAC( $Campo ){
       $this->TxtoWbSrvce .= '(TAC)'  . $this->Coma  ;
       $this->TxtoWbSrvce .= 'TAC_1:'. $Campo         . $this->Coma  ;
       $this->TxtoWbSrvce .= '(/TAC)';
    }

  }
?>
