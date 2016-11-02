

<div class="contenido-input-buscar rr10" style="z-index: 200;">
    <div class="columan-input rr10">
        <input name ="typeahead" type="text"
        class="form-control input-buscar rr10 taL t14"
        placeholder='Buscar Producto'
        id="texto-busqueda-live" />

    </div>


    <div class="cont-btn-buscar">
    	<button type="button" class="btn-buscar">
        	<div class="tabAll">
            	<div class="tabIn"><img src="<?= BASE_IMG_CATEGORIAS_INDEX; ?>lupa.png" /></div>
            </div>
        </button>
    </div>

</div>

<style>

	.contenSearAuto 					{ background-color:#eee; position:absolute; width:76%; margin:0 12%; z-index:98465153514819613; max-height:300px; overflow:auto;}
	.contenSearAuto ul					{ list-style:none; padding:0; margin:0; border:solid 1px #ccc; border-top:0; border-bottom:0; }
	.contenSearAuto li 					{ padding:10px; border-bottom:solid 1px #ccc; }
	.contenSearAuto li:hover			{ background-color:#FFFFFF; }
	
</style>


<div class="contenSearAuto">
    <ul  id="resultados" >

    </ul>
</div>

