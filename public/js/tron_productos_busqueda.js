
function search( $valor_busqueda ) {
    var query_value = $valor_busqueda ;
        $.ajax({
            type: "POST",
            url: 'productos/Busqueda_Productos',
            data: { texto_busqueda: query_value },
            cache: false,
            success: function(html){
                $("ul#resultados").html(html);
            }
        });
    return false;

}




$(".page-busqueda").on("keyup","#texto-busqueda-live", function(e) {

    // Set Search String
    var search_string = $(this).val();
   // Set Timeout
    clearTimeout($.data(this, 'timer'));

    // Set Search String
    var search_string = $(this).val();

    // Do Search
    if (search_string == '') {
        $("ul#results").fadeOut();
    }else{
        $("ul#results").fadeIn();
    };
     $(this).data('timer', setTimeout(search ( search_string ), 100));
});

