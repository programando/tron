 

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
          width: 70px;
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
         	  <div class="derechos_inscripcion">
         	  	   <h4 style="color: #003E90; text-align: center; font-size: 14px;"><strong>DERECHOS DE INSCRIPCION</strong></h4><br>
         	  	   <nav style="">
         	  	   	   <ul>
         	  	   	   	   <li>
         	  	   	   	       <label for="cuota_1">Valor de la cuota 1 : </label>
         	  	   	   	       <input type="text" class="caja_text" id="cuota_1">	 
         	  	   	   	   </li>

         	  	   	   	   <li>
         	  	   	   	       <label for="cuota_2">Valor de la cuota 2 : </label>
         	  	   	   	       <input type="text" class="caja_text" id="cuota_2"> Cuando las ganancias sean mayores a :  <input type="text" class="caja_text" id="">	 
         	  	   	   	   </li>

         	  	   	   	   <li>
         	  	   	   	       <label for="cuota_3">Valor de la cuota 3 : </label>
         	  	   	   	       <input type="text" class="caja_text" id="cuota_3"> Cuando las ganancias sean mayores a : <input type="text" class="caja_text" id="">	 
         	  	   	   	   </li>

                           <li>
                                <label for="total">Total : </label>
                                <input type="text" class="caja_text" id="total" style="margin-left: 92px;">
                           </li>

         	  	   	   </ul>
         	  	   </nav>
 
         	  </div><br>
              <!-- Tabla = distribucion de las bonificaciones -->
              <div class="cont_tabla_bonificacines">
              	 <h4 style="color: #003E90; text-align: center; font-size: 14px;"><strong>DISTRIBUCION DE LAS BONIFICACIONES/ PRIMAS EN LA RED</strong> </h4><br>
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
				           <tr>
				              <td class="table_cuerpo">1</td>
				              <td class="table_cuerpo">32%</td>
				              <td class="table_cuerpo">16%</td>
				              <td class="table_cuerpo">8%</td>
				              <td class="table_cuerpo">4%</td>
				              <td class="table_cuerpo">2%</td>
				              <td class="table_cuerpo">1%</td>
				           </tr>
				 
				           <tr >
				              <td class="table_cuerpo">2</td>
				              <td class="table_cuerpo">1%</td>
				              <td class="table_cuerpo">2%</td>
				              <td class="table_cuerpo">4%</td>
				              <td class="table_cuerpo">8%</td>
				              <td class="table_cuerpo">16%</td>
				              <td class="table_cuerpo">32%</td>
				           </tr>

				           <tr>
				              <td class="table_cuerpo">2</td>
				              <td class="table_cuerpo">1%</td>
				              <td class="table_cuerpo">2%</td>
				              <td class="table_cuerpo">4%</td>
				              <td class="table_cuerpo">8%</td>
				              <td class="table_cuerpo">16%</td>
				              <td class="table_cuerpo">32%</td>
				           </tr>           
				        </tbody>
				 </table>  
              </div>
         </div><br><br>

 





