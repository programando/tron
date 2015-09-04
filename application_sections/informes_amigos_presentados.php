<table class="table table-bordered table-hover  tabla_info_compras">
	     	    <thead><!-- cabezera -->
	     	    	    <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">ENE</th>
                    <th class="text-center">FEB</th>
                    <th class="text-center">MAR</th>
                    <th class="text-center">ABR</th>
                    <th class="text-center">MAY</th>
                    <th class="text-center">JUN</th>
                    <th class="text-center">JUL</th>
                    <th class="text-center">AGO</th>
                    <th class="text-center">SEP</th>
                    <th class="text-center">OCT</th>
                    <th class="text-center">NOV</th>
                    <th class="text-center">DIC</th>
                    <th class="text-center">TOTAL</th>
                    <th class="text-center">PROM.</th>
	     	    	    </tr>
	     	    </thead><!-- cabezera -->

	     	    <tbody style="font-size:11px;">
                   <?php $I =0 ;?>
                   <?php foreach ($this->Terceros  as $Tercero)  :?>
                    <?php
                         $nombre   =  substr($Tercero['nombre'],0,25) ;
                         $ene      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['ene']);
                         $feb      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['feb']);
                         $mar      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['mar']);
                         $abr      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['abr']);
                         $may      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['may']);
                         $jun      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['jun']);
                         $jul      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['jul']);
                         $ago      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['ago']);
                         $sep      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['sep']);
                         $oct      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['oct']);
                         $nov      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['nov']);
                         $dic      = Numeric_Functions::Formato_Numero_SinSigno($Tercero['dic']);
                         $total    = Numeric_Functions::Formato_Numero_SinSigno($Tercero['total']);
                         $promedio = Numeric_Functions::Formato_Numero_SinSigno($Tercero['promedio']);
                         if ( $ene == 0) { $ene = '';}
                         if ( $feb == 0) { $feb = '';}
                         if ( $mar == 0) { $mar = '';}
                         if ( $abr == 0) { $abr = '';}
                         if ( $may == 0) { $may = '';}
                         if ( $jun == 0) { $jun = '';}
                         if ( $jul == 0) { $jul = '';}
                         if ( $ago == 0) { $ago = '';}
                         if ( $sep == 0) { $sep = '';}
                         if ( $oct == 0) { $oct = '';}
                         if ( $nov == 0) { $nov = '';}
                         if ( $dic == 0) { $dic = '';}
                         if ( $total == 0) { $total = '';}
                         if ( $promedio == 0) { $promedio = '';}

                         $I++;
                    ?>
                         <tr>
                         	   <td class="text-right"> <?= $I ;?> </td>
                                 <td style="width: 300px;"> <?= $nombre ;?></td>
                         	   <td class="text-right"> <?= $ene ;?> </td>
                         	   <td class="text-right"><?= $feb ;?> </td>
                         	   <td class="text-right"><?= $mar ;?> </td>
                         	   <td class="text-right"><?= $abr ;?> </td>
                         	   <td class="text-right"><?= $may ;?> </td>
                         	   <td class="text-right"><?= $jun ;?> </td>
                         	   <td class="text-right"><?= $jul ;?> </td>
                         	   <td class="text-right"><?= $ago ;?> </td>
                         	   <td class="text-right"><?= $sep ;?> </td>
                         	   <td class="text-right"><?= $oct ;?> </td>
                         	   <td class="text-right"><?= $nov ;?> </td>
                         	   <td class="text-right"><?= $dic ;?> </td>
                         	   <td class="text-right"><?= $total ;?> </td>
                         	   <td class="text-right"><?= $promedio ;?> </td>
                         </tr>

                        <?php endforeach ;?>
	     	    </tbody>
	  	   </table>
