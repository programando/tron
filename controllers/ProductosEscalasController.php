<?php

class ProductosEscalasController extends Controller
{
    private $Cantidad_Registros;
    public  $IdEscala_Compra;
    Public  $Posicion_Escala;
    public  $Precio_Final_Tron;
    public function __construct()
    {
        parent::__construct();
        $this->Escalas = $this->Load_Model('ProductosEscalas');
    }

    public function Index() {}

    public function Escalas_Consultar($idescala,$CantidadComprada,$Precio_Amigo_Tron,$Precio_Escala_A,$Precio_Escala_B,$Precio_Escala_C)
    {
    	/** ENERO 08 DE 2014
    	*			CONSULTA LAS ESCALAS POR ID ESCALA Y DETERMINA EL PRECIO A APLICAR DE ACUERDO A LA CANTIDAD COMPRADA
    	*/
      $Escalas_Compra          = $this->Escalas->Escalas_Consultar($idescala);
      $this->Precio_Final_Tron = $Precio_Amigo_Tron;
      $this->Posicion_Escala   = 0;  // PUEDE SER 0, 1, 2, 3 .. IMPORTANTE PARA LOS PRESUPUESTOS
      $this->IdEscala_Compra   = 0;
    	if ($CantidadComprada >= $Escalas_Compra[0]["inicio_a"] && $CantidadComprada <= $Escalas_Compra[0]["final_a"] )
         {
           $this->Precio_Final_Tron =  $Precio_Escala_A;
           $this->IdEscala_Compra   =  $Escalas_Compra[0]["idescala_dt_a"];
           $this->Posicion_Escala   =  $Escalas_Compra[0]["posicion_a"];
         }
         if ($CantidadComprada >= $Escalas_Compra[0]["inicio_b"] && $CantidadComprada <= $Escalas_Compra[0]["final_b"] )
         {
           $this->Precio_Final_Tron =  $Precio_Escala_B;
           $this->IdEscala_Compra   =  $Escalas_Compra[0]["idescala_dt_b"];
           $this->Posicion_Escala   =  $Escalas_Compra[0]["posicion_b"];
         }
         if ($CantidadComprada >= $Escalas_Compra[0]["inicio_c"] )
         {
           $this->Precio_Final_Tron =  $Precio_Escala_C;
           $this->IdEscala_Compra   =  $Escalas_Compra[0]["idescala_dt_c"];
           $this->Posicion_Escala   =  $Escalas_Compra[0]["posicion_c"];
         }


    }

    public function  Escalas_Consultar_Rangos($idescala)
    {
    		 $Productos_Escalas_Rangos = $this->Escalas->Escalas_Consultar_Rangos($idescala);
    		 return $Productos_Escalas_Rangos;
    }



  }
  ?>
