<div class="contenedor-datos-informe">

<?php
  $row = $this->row;

  $var_0 =1;
  $var_1 =1;
  $var_2 =1;
  $var_3 =1;
  $var_4 =1;
  $var_5 =1;
  $var_6 =1;
  //
  //    $compra_mes_anterior_idtercero_nv1 = $row['compra_mes_anterior_idtercero_nv1'];
  $compra_mes_actual_idtercero_nv1   = $row[0]['compra_mes_actual_idtercero_nv1'];
  $compra_mes_actual_idtercero_nv2   = $row[0]['compra_mes_actual_idtercero_nv2'];
  $compra_mes_actual_idtercero_nv3   = $row[0]['compra_mes_actual_idtercero_nv3'];
  $compra_mes_actual_idtercero_nv4   = $row[0]['compra_mes_actual_idtercero_nv4'];
  $compra_mes_actual_idtercero_nv5   = $row[0]['compra_mes_actual_idtercero_nv5'];
  $compra_mes_actual_idtercero_nv6   = $row[0]['compra_mes_actual_idtercero_nv6'];
  //compra_mes_anterior_idtercero_nv1
  $compra_mes_anterior_idtercero_nv1    = $row[0]['compra_mes_anterior_idtercero_nv1'];
  $compra_mes_anterior_idtercero_nv2    = $row[0]['compra_mes_anterior_idtercero_nv2'];
  $compra_mes_anterior_idtercero_nv3    = $row[0]['compra_mes_anterior_idtercero_nv3'];
  $compra_mes_anterior_idtercero_nv4    = $row[0]['compra_mes_anterior_idtercero_nv4'];
  $compra_mes_anterior_idtercero_nv5    = $row[0]['compra_mes_anterior_idtercero_nv5'];
  $compra_mes_anterior_idtercero_nv6    = $row[0]['compra_mes_anterior_idtercero_nv6'];
  //compra_mes_anterior_idtercero_nv1
  $compra_hace_2_meses_idtercero_nv1    = $row[0]['compra_hace_2_meses_idtercero_nv1'];
  $compra_hace_2_meses_idtercero_nv2    = $row[0]['compra_hace_2_meses_idtercero_nv2'];
  $compra_hace_2_meses_idtercero_nv3    = $row[0]['compra_hace_2_meses_idtercero_nv3'];
  $compra_hace_2_meses_idtercero_nv4    = $row[0]['compra_hace_2_meses_idtercero_nv4'];
  $compra_hace_2_meses_idtercero_nv5    = $row[0]['compra_hace_2_meses_idtercero_nv5'];
  $compra_hace_2_meses_idtercero_nv6    = $row[0]['compra_hace_2_meses_idtercero_nv6'];



  // en esta parte asignamos el primer registro a variables
  $nombre0             =  $row[0]['nombre_nv_0'];
  $idtercero0          =  $row[0]['idtercero_nv_0'];
  $nombre1             =  $row[0]['nombre_nv_1'];
  $idtercero1          =  $row[0]['idtercero_nv_1'];
  $idtercero_niveles_1 =  $row[0]['idtercero_nv_1'];
  $nombre2             =  $row[0]['nombre_nv_2'];
  $idtercero2          =  $row[0]['idtercero_nv_2'];
  $nombre3             =  $row[0]['nombre_nv_3'];
  $idtercero3          =  $row[0]['idtercero_nv_3'];
  $nombre4             =  $row[0]['nombre_nv_4'];
  $idtercero4          =  $row[0]['idtercero_nv_4'];
  $nombre5             =  $row[0]['nombre_nv_5'];
  $idtercero5          =  $row[0]['idtercero_nv_5'];
  $nombre6             =  $row[0]['nombre_nv_6'];
  $idtercero6          =  $row[0]['idtercero_nv_6'];

  $total_amigos_nivel_1=1;
  $total_amigos_nivel_2=1;
  $total_amigos_nivel_3=1;
  $total_amigos_nivel_4=1;
  $total_amigos_nivel_5=1;
  $total_amigos_nivel_6=1;

  $amigos_compraron_mes             = $row[0]['amigos_que_compraron_este_mes'];
  $amigos_que_no_compraron_este_mes = $row[0]['amigos_que_no_compraron_este_mes'];
  $amigos_no_compraron_mes          = $row[0]['amigos_sin_compras_este_mes_ni_mes_anterior'];
  $amigos_dejaron_comprar           = $row[0]['amigos_sin_compras_por_3_meses'];
  //$amigos_que_no_compran_hace_dos_meses   = $row['amigos_que_no_compran_hace_dos_meses'];
/**/
  $total_amigos_nivel_1 = $row[0]['total_amigos_nivel_1'];
  $total_amigos_nivel_2 = $row[0]['total_amigos_nivel_2'];
  $total_amigos_nivel_3 = $row[0]['total_amigos_nivel_3'];
  $total_amigos_nivel_4 = $row[0]['total_amigos_nivel_4'];
  $total_amigos_nivel_5 = $row[0]['total_amigos_nivel_5'];
  $total_amigos_nivel_6 = $row[0]['total_amigos_nivel_6'];


?>

    <style>
      th            { text-align: center;}
	  td, tr		{ vertical-align:middle; }
    .actual         { color: #090; font-weight:700; }
    .anterior         { color: #F60; font-weight:700; }
    .dos_meses        { /*color: #F69;*/ color:#bfaa1d; font-weight:700; }
    .compraron        { color: #090; font-weight:700; }
    .noCompraron      { color: #F60; font-weight:700; }
    .noCompraron2       { color: #bfaa1d; font-weight:700; }
    .aEliminar        { color: #F00; line-height: 12px; font-weight:700; }
    .numEspion        { font-size:70px; line-height:60px; text-align:right; font-weight:400 !important;  }
    .txtNumIon        { font-size:16px; line-height:20px; padding-left:10px; vertical-align:middle; font-weight:400 !important; }

    </style>

    <?php

    $mes = date("m");
    $mes =  String_Functions::Nombre_Mes($mes );

  ?>


    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
        <tr>
            <td class="numEspion compraron"><?php echo $amigos_compraron_mes;?></td>
            <td class="txtNumIon compraron"> Amigos ya<br />compraron<br />en <?php echo $mes;?></td>
        
            <td class="numEspion noCompraron"><?php echo ($amigos_que_no_compraron_este_mes - $amigos_no_compraron_mes);?></td>
            <td class="txtNumIon noCompraron"> Amigos cumplirán<br />un (1) mes<br />de inactividad</td>
        
            <td class="numEspion noCompraron2"><?php echo ($amigos_no_compraron_mes - $amigos_dejaron_comprar);?></td>
            <td class="txtNumIon noCompraron2"> Amigos cumplirán<br />dos (2) meses<br />de inactividad</td>
        
            <td class="numEspion aEliminar"><?php echo $amigos_dejaron_comprar;?></td>
            <td class="txtNumIon aEliminar"> Amigos cumplirán<br /> tres (3) meses<br />de inactividad</td>
        
            <td class="numEspion"><?php echo $amigos_compraron_mes + $amigos_que_no_compraron_este_mes;?></td>
            <td class="txtNumIon">Total<br />Amigos</td>
        </tr>
    </table>

    <hr />
        

    <table id="ver-ion"  class="table table-bordered table-hover">
        <colgroup>
            <col class="vion-6" />
            <col class="vion-5" />
            <col class="vion-4" />
            <col class="vion-3" />
            <col class="vion-2" />
            <col class="vion-1" />
        </colgroup>
        <thead>
            <th scope="col" id=""><strong>Nivel 1</strong></th>
            <th scope="col" id=""><strong>Nivel 2</strong></th>
            <th scope="col" id=""><strong>Nivel 3</strong></th>
            <th scope="col" id=""><strong>Nivel 4</strong></th>
            <th scope="col" id=""><strong>Nivel 5</strong></th>
            <th scope="col" id=""><strong>Nivel 6</strong></th>
      </thead>
        <tbody class="t12">
    
            <tr>
                <th><?php  echo $total_amigos_nivel_1; ?> Amigos</th>
                <th><?php  echo $total_amigos_nivel_2; ?> Amigos</th>
                <th><?php  echo $total_amigos_nivel_3; ?> Amigos</th>
                <th><?php  echo $total_amigos_nivel_4; ?> Amigos</th>
                <th><?php  echo $total_amigos_nivel_5; ?> Amigos</th>
                <th><?php  echo $total_amigos_nivel_6; ?> Amigos</th>
            </tr>
    
            <tr>
                <td>
            <?php if ($var_1==1){
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero1.'">';
                  if     ($nombre1 != "" && $compra_mes_actual_idtercero_nv1==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre1)."</p>";
                  else if($nombre1 != "" && $compra_mes_actual_idtercero_nv1==0 && $compra_mes_anterior_idtercero_nv1== 0 && $compra_hace_2_meses_idtercero_nv1==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre1)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre1 != "" && $compra_mes_actual_idtercero_nv1==0 && $compra_mes_anterior_idtercero_nv1==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre1)."</p>";
                  else if($nombre1 != "" && $compra_mes_actual_idtercero_nv1==0 && $compra_mes_anterior_idtercero_nv1== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre1)."</p>";
                echo '</a>';
    
                $var_1++;
              }
            ?>
                </td>
                <td>
                  <?php if ($var_2==1){
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero2.'">';
                  if     ($nombre2 != "" && $compra_mes_actual_idtercero_nv2==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre2)."</p>";
                  else if($nombre2 != "" && $compra_mes_actual_idtercero_nv2==0 && $compra_mes_anterior_idtercero_nv2== 0 && $compra_hace_2_meses_idtercero_nv2==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre2)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre2 != "" && $compra_mes_actual_idtercero_nv2==0 && $compra_mes_anterior_idtercero_nv2==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre2)."</p>";
                  else if($nombre2 != "" && $compra_mes_actual_idtercero_nv2==0 && $compra_mes_anterior_idtercero_nv2== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre2)."</p>";
                echo '</a>';
    
                $var_2++;
              }
            ?>
                </td>
                <td>
                  <?php if ($var_3==1){
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero3.'">';
                  if     ($nombre3 != "" && $compra_mes_actual_idtercero_nv3==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre3)."</p>";
                  else if($nombre3 != "" && $compra_mes_actual_idtercero_nv3==0 && $compra_mes_anterior_idtercero_nv3== 0 && $compra_hace_2_meses_idtercero_nv3==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre3)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre3 != "" && $compra_mes_actual_idtercero_nv3==0 && $compra_mes_anterior_idtercero_nv3==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre3)."</p>";
                  else if($nombre3 != "" && $compra_mes_actual_idtercero_nv3==0 && $compra_mes_anterior_idtercero_nv3== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre3)."</p>";
                echo '</a>';
    
                $var_3++;
              }
            ?>
    
                </td>
                <td>
                  <?php if ($var_4==1){
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero4.'">';
                  if     ($nombre4 != "" && $compra_mes_actual_idtercero_nv4==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre4)."</p>";
                  else if($nombre4 != "" && $compra_mes_actual_idtercero_nv4==0 && $compra_mes_anterior_idtercero_nv4== 0 && $compra_hace_2_meses_idtercero_nv4==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre4)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre4 != "" && $compra_mes_actual_idtercero_nv4==0 && $compra_mes_anterior_idtercero_nv4==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre4)."</p>";
                  else if($nombre4 != "" && $compra_mes_actual_idtercero_nv4==0 && $compra_mes_anterior_idtercero_nv4== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre4)."</p>";
                echo '</a>';
    
                $var_4++;
              }
            ?>
    
                </td>
                <td>
                  <?php if ($var_5==1){
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero5.'">';
                  if     ($nombre5 != "" && $compra_mes_actual_idtercero_nv5==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre5)."</p>";
                  else if($nombre5 != "" && $compra_mes_actual_idtercero_nv5==0 && $compra_mes_anterior_idtercero_nv5== 0 && $compra_hace_2_meses_idtercero_nv5==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre5)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre5 != "" && $compra_mes_actual_idtercero_nv5==0 && $compra_mes_anterior_idtercero_nv5==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre5)."</p>";
                  else if($nombre5 != "" && $compra_mes_actual_idtercero_nv5==0 && $compra_mes_anterior_idtercero_nv5== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre5)."</p>";
                echo '</a>';
    
                $var_5++;
              }
            ?>
    
                </td>
                <td>
                  <?php if ($var_6==1){
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero5.'">';
                  if     ($nombre6 != "" && $compra_mes_actual_idtercero_nv6==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre6)."</p>";
                  else if($nombre6 != "" && $compra_mes_actual_idtercero_nv6==0 && $compra_mes_anterior_idtercero_nv6== 0 && $compra_hace_2_meses_idtercero_nv6==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre6)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre6 != "" && $compra_mes_actual_idtercero_nv6==0 && $compra_mes_anterior_idtercero_nv6==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre6)."</p>";
                  else if($nombre6 != "" && $compra_mes_actual_idtercero_nv6==0 && $compra_mes_anterior_idtercero_nv6== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre6)."</p>";
                echo '</a>';
    
                $var_6++;
              }
            ?>
    
                </td>
            </tr>
    
            <?php
    
          foreach ($this->row as $row){
    
                $idtercero1_mirar_info   =  $row['idtercero_nv_1'];
                $idtercero2_mirar_info   =  $row['idtercero_nv_2'];
                $idtercero3_mirar_info   =  $row['idtercero_nv_3'];
                $idtercero4_mirar_info   =  $row['idtercero_nv_4'];
                $idtercero5_mirar_info   =  $row['idtercero_nv_5'];
                $idtercero6_mirar_info   =  $row['idtercero_nv_6'];
         ?>
             <tr>
    
                <td>
                  <?php
    
                    if ($var_1>1 && $idtercero1_mirar_info != $idtercero1)  {
    
                        $idtercero1              = $row['idtercero_nv_1'];
                        $nombre1               = $row['nombre_nv_1'];
                $compra_mes_anterior_idtercero_nv1 = $row['compra_mes_anterior_idtercero_nv1'];
                $compra_mes_actual_idtercero_nv1   = $row['compra_mes_actual_idtercero_nv1'];
                $compra_mes_actual_idtercero_nv1   = $row['compra_mes_actual_idtercero_nv1'];
                $compra_hace_2_meses_idtercero_nv1   = $row['compra_hace_2_meses_idtercero_nv1'];
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero1.'">';
                  if     ($nombre1 != "" && $compra_mes_actual_idtercero_nv1==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre1)."</p>";
                  else if($nombre1 != "" && $compra_mes_actual_idtercero_nv1==0 && $compra_mes_anterior_idtercero_nv1== 0 && $compra_hace_2_meses_idtercero_nv1==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre1)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre1 != "" && $compra_mes_actual_idtercero_nv1==0 && $compra_mes_anterior_idtercero_nv1==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre1)."</p>";
                  else if($nombre1 != "" && $compra_mes_actual_idtercero_nv1==0 && $compra_mes_anterior_idtercero_nv1== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre1)."</p>";
    
    
                echo '</a>';
    
                //$var_1 = 1;
              }
                   ?>
                </td>
    
                <td>
                  <?php
    
                    if ($var_2>1 && $idtercero2_mirar_info != $idtercero2)  {
    
                        $idtercero2              = $row['idtercero_nv_2'];
                        $nombre2               = $row['nombre_nv_2'];
                $compra_mes_anterior_idtercero_nv2 = $row['compra_mes_anterior_idtercero_nv2'];
                $compra_mes_actual_idtercero_nv2   = $row['compra_mes_actual_idtercero_nv2'];
                $compra_hace_2_meses_idtercero_nv2 = $row['compra_hace_2_meses_idtercero_nv2'];
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero2.'">';
                  if     ($nombre2 != "" && $compra_mes_actual_idtercero_nv2==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre2)."</p>";
                  else if($nombre2 != "" && $compra_hace_2_meses_idtercero_nv2==0 && $compra_mes_anterior_idtercero_nv2== 0 && $compra_hace_2_meses_idtercero_nv2==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre2)."<br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre2 != "" && $compra_mes_actual_idtercero_nv2==0 && $compra_mes_anterior_idtercero_nv2==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre2)."</p>";
                  else if($nombre2 != "" && $compra_mes_actual_idtercero_nv2==0 && $compra_mes_anterior_idtercero_nv2== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre2)."</p>";
                echo '</a>';
                //$var_2 = 1;
              }
                   ?>
                </td>
    
                <td>
                  <?php
    
                    if ($var_3>1 && $idtercero3_mirar_info != $idtercero3)  {
    
                        $idtercero3              = $row['idtercero_nv_3'];
                        $nombre3               = $row['nombre_nv_3'];
                $compra_mes_anterior_idtercero_nv3 = $row['compra_mes_anterior_idtercero_nv3'];
                $compra_mes_actual_idtercero_nv3   = $row['compra_mes_actual_idtercero_nv3'];
                $compra_hace_2_meses_idtercero_nv3   = $row['compra_hace_2_meses_idtercero_nv3'];
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero3.'">';
                  if     ($nombre3 != "" && $compra_mes_actual_idtercero_nv3==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre3)."</p>";
                  else if($nombre3 != "" && $compra_mes_actual_idtercero_nv3==0 && $compra_mes_anterior_idtercero_nv3== 0 && $compra_hace_2_meses_idtercero_nv3==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre3)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre3 != "" && $compra_mes_actual_idtercero_nv3==0 && $compra_mes_anterior_idtercero_nv3==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre3)."</p>";
                  else if($nombre3 != "" && $compra_mes_actual_idtercero_nv3==0 && $compra_mes_anterior_idtercero_nv3== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre3)."</p>";
                echo '</a>';
                //$var_3 = 1;
              }
                   ?>
                </td>
    
                <td>
                  <?php
    
                    if ($var_4>1 && $idtercero4_mirar_info != $idtercero4)  {
    
                        $idtercero4              = $row['idtercero_nv_4'];
                        $nombre4               = $row['nombre_nv_4'];
                $compra_mes_anterior_idtercero_nv4 = $row['compra_mes_anterior_idtercero_nv4'];
                $compra_mes_actual_idtercero_nv4   = $row['compra_mes_actual_idtercero_nv4'];
                $compra_hace_2_meses_idtercero_nv4   = $row['compra_hace_2_meses_idtercero_nv4'];
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero4.'">';
                  if     ($nombre4 != "" && $compra_mes_actual_idtercero_nv4==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre4)."</p>";
                  else if($nombre4 != "" && $compra_mes_actual_idtercero_nv4==0 && $compra_mes_anterior_idtercero_nv4== 0 && $compra_hace_2_meses_idtercero_nv4==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre4)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre4 != "" && $compra_mes_actual_idtercero_nv4==0 && $compra_mes_anterior_idtercero_nv4==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre4)."</p>";
                  else if($nombre4 != "" && $compra_mes_actual_idtercero_nv4==0 && $compra_mes_anterior_idtercero_nv4== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre4)."</p>";
                echo '</a>';
                //$var_4 = 1;
              }
                   ?>
                </td>
    
                <td>
                  <?php
    
                    if ($var_5>1 && $idtercero5_mirar_info != $idtercero5)  {
    
                        $idtercero5              = $row['idtercero_nv_5'];
                        $nombre5               = $row['nombre_nv_5'];
                $compra_mes_anterior_idtercero_nv5 = $row['compra_mes_anterior_idtercero_nv5'];
                $compra_mes_actual_idtercero_nv5   = $row['compra_mes_actual_idtercero_nv5'];
                $compra_hace_2_meses_idtercero_nv5   = $row['compra_hace_2_meses_idtercero_nv5'];
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero5.'">';
                  if     ($nombre5 != "" && $compra_mes_actual_idtercero_nv5==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre5)."</p>";
                  else if($nombre5 != "" && $compra_mes_actual_idtercero_nv5==0 && $compra_mes_anterior_idtercero_nv5== 0 && $compra_hace_2_meses_idtercero_nv5==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre5)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre5 != "" && $compra_mes_actual_idtercero_nv5==0 && $compra_mes_anterior_idtercero_nv5==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre5)."</p>";
                  else if($nombre5 != "" && $compra_mes_actual_idtercero_nv5==0 && $compra_mes_anterior_idtercero_nv5== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre5)."</p>";
                echo '</a>';
                //$var_5 = 1;
              }
                   ?>
                </td>
    
                <td>
                  <?php
    
                    if ($var_6>1 && $idtercero6_mirar_info != $idtercero6)  {
    
                        $idtercero6              = $row['idtercero_nv_6'];
                        $nombre6               = $row['nombre_nv_6'];
                $compra_mes_anterior_idtercero_nv6 = $row['compra_mes_anterior_idtercero_nv6'];
                $compra_mes_actual_idtercero_nv6   = $row['compra_mes_actual_idtercero_nv6'];
                $compra_hace_2_meses_idtercero_nv6   = $row['compra_hace_2_meses_idtercero_nv6'];
    
                echo '<a href="#infoTerceroRED" class="btnUsuarioRed" id="'.$idtercero6.'">';
    
                  if     ($nombre6 != "" && $compra_mes_actual_idtercero_nv6==1)                       echo "<p class='actual'>■ ".utf8_encode($nombre6)."</p>";
                  else if($nombre6 != "" && $compra_mes_actual_idtercero_nv6==0 && $compra_mes_anterior_idtercero_nv6== 0 && $compra_hace_2_meses_idtercero_nv6==0 ) echo "<p class='aEliminar'>■ ".utf8_encode($nombre6)." <br><span class = 'nombreEliminar'>Este usuario será eliminado</span></p>";
                  else if($nombre6 != "" && $compra_mes_actual_idtercero_nv6==0 && $compra_mes_anterior_idtercero_nv6==1)  echo "<p class='anterior'>■ ".utf8_encode($nombre6)."</p>";
                  else if($nombre6 != "" && $compra_mes_actual_idtercero_nv6==0 && $compra_mes_anterior_idtercero_nv6== 0) echo "<p class='dos_meses'>■ ".utf8_encode($nombre6)."</p>";
                echo '</a>';
    
                //$var_6 = 1;
              }
                   ?>
                </td>
    
             </tr>
    
    
             <?php }?>
    
        </tbody>
    </table>

</div>
