

<style>
	 .derechos_inscripcion nav ul li {
	 	  display: block;
	 	  width: 100%;
	 	  padding: 5px;
	 }

	 .caja_text {
	 	  border-radius:  4px;
	 	  border: 1px solid #9B9B9B;
	 	  padding: 5px;
	 	  text-align: center;
     width: 90px;
     text-align: right;
	 }

    .tabla_bonificaiones{

    	 display: block;
    	 width: 70%;
    	 text-align: center;
    	 margin: 0px auto;
    	 border-top: 0px;
    	 border-right: 0px;
    	 border-bottom:  0px;
    	 border-left:  0px;
         font-size: 14px;

    }

    .tabla_cabezera {
    	 width:150px;
    	 background: #003E90;
    	 color: white;
    	 border: 1px solid #011835;
         text-align: center;
    }

    .table_cuerpo {

    }


</style>




         <!-- Contenedor principal -->
         <div>
         	  <!-- Derechos de Inscripcion -->
         	  <br>
              <!-- Tabla = distribucion de las bonificaciones -->
              <div class="cont_tabla_bonificacines">
              	 <h4 style="color: #003E90; text-align: center; font-size: 14px;"><strong>DISTRIBUCIÓN DE LAS BONIFICACIONES/ PRIMAS EN LA RED</strong> </h4><br>
				 <table  border="1" class="tabla_bonificaiones" style="border-collapse: collapse; ">
				      <!-- Cabezera -->
				        <thead style="border-bottom: 1px solid red; ">
				           <tr>
						      <th class="tabla_cabezera">Cuota</th>
						      <th class="tabla_cabezera">Nivel 1</th>
						      <th class="tabla_cabezera">Nivel 2</th>
						      <th class="tabla_cabezera">Nivel 3</th>
						      <th class="tabla_cabezera">Nivel 4</th>
						      <th class="tabla_cabezera">Nivel 5</th>
						      <th class="tabla_cabezera">Nivel 6</th>
				           </tr>
				        </thead>
                      <!-- Cuerpo -->
				        <tbody>
				        	<?php foreach ($this->Bonificaciones_Porcentajes as $Porcentajes) :?>
				           <tr>
				              <td class="table_cuerpo"> <?= $Porcentajes['idcuota'] ;?> </td>
				              <td class="table_cuerpo"> <?= number_format( $Porcentajes['porciento_nivel_1'] ).'%' ;?> </td>
				              <td class="table_cuerpo"> <?= number_format( $Porcentajes['porciento_nivel_2'] ).'%' ;?></td>
				              <td class="table_cuerpo"> <?= number_format( $Porcentajes['porciento_nivel_3'] ).'%' ;?></td>
				              <td class="table_cuerpo"> <?= number_format( $Porcentajes['porciento_nivel_4'] ).'%' ;?></td>
				              <td class="table_cuerpo"> <?= number_format( $Porcentajes['porciento_nivel_5'] ).'%' ;?></td>
				              <td class="table_cuerpo"> <?= number_format( $Porcentajes['porciento_nivel_6'] ).'%' ;?></td>
				           </tr>

				         	<?php endforeach ;?>
				        </tbody>
				 </table>
              </div>
         </div><br><br>







