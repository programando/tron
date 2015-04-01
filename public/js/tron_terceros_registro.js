


   $(document).ready(function(){
      $('#btn-continuar').click(function(){

            var $expr = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
            var $numero_nit         = $('#numero-nit').val();   // Numero Nit
            var $d_v                = $('#campo-dv').val();     // D.V
            var $confi_nit          = $('#confi-nit').val();    // Confirmar Numero Nit
            var $confi_dv           = $('#confirmar-dv').val(); // Confirmar D.V
            var $razon_scl          = $('#razon-social').val(); // Razon Social
            var $numero_docut       = $('#numero-docut').val(); // Numero Documento
            var $nombre             = $('#nombres').val();      // Nombres
            var $pais               = $('#pais').val();         // Pais Residencia
            var $confi_numero_docut = $('#confirmar-docut').val(); // Confirmar Documento
            var $apellidos          = $('#apellidos').val();    // Apellidos
            var $departamento       = $('#departamento').val(); // Departamento
            var $residencia         = $('#direccion').val();    // Direccion de Residencia
            var $barrio             = $('#barrio').val();       // Barrio
            var $correo             = $('#correo').val();       // Correo Electronico
            var $num_cel            = $('#celular').val();      // Numero Celular
            var $confi_correo       = $('#confirmar-correo').val(); // Confirmar Correo Electronico




            if($numero_nit == ''){  // Condicional => NUMERO NIT
               $('.mjs-valid-nit').fadeIn();
               $('#numero-nit').focus(function(){
                  $('.mjs-valid-nit').fadeOut();
               });
               return false;
            }else{
               $('.mjs-valid-nit').fadeOut();
             }


            if($d_v == ''){    // Condicion  => D.V
               $('.mjs-valid-D-V').fadeIn();
               $('#campo-dv').focus();
               return false;
            }else{
               $('.mjs-valid-D-V').fadeOut();
            }


            if($confi_nit == ''){  // Condicion => Confirmar Numero Nit
               $('.mjs-valid-Confi-NIT').fadeIn();
               $('#confi-nit').focus();
               return false;
            }else{
                $('.mjs-valid-Confi-NIT').fadeOut();
            }


            if($confi_dv == ''){  // Condicion => Confirmar D.V
               $('.mjs-valid-confi-D-V ').fadeIn();
               $('#confirmar-dv').focus();
               return false;
            }else{
                $('.mjs-valid-confi-D-V ').fadeOut();
            }


            if($razon_scl == ''){  // Condicion => Razon Social
               $('.mjs-valid-nit-razon-scl').fadeIn();
               $('#razon-social').focus();
               return false;
            }else{
                $('.mjs-valid-nit-razon-scl').fadeOut();
            }


            if($numero_docut == ''){  // Condicion => Numero Documento
               $('.mjs-valid-Num-dcto ').fadeIn();
               $('#numero-docut').focus();
               return false;
            }else{
                $('.mjs-valid-Num-dcto ').fadeOut();
            }


            if($nombre == ''){  // Condicion => Nombres
              $('.mjs-valid-nombre').fadeIn();
              $('#nombres').focus();
              return false;
            }else{
               $('.mjs-valid-nombre').fadeOut();
            }


            if($pais == ''){  // Condicion => Pais Residencia
               $('.mjs-valid-pais ').fadeIn();
               $('#pais').focus();
               return false;
            }else{
               $('.mjs-valid-pais ').fadeOut();
            }


            if($confi_numero_docut == ''){ // Condicion => Confirmar Documento
               $('.mjs-valid-confi-num-dcto').fadeIn();
               $('#confirmar-docut').focus();
               return false;
            }else{
               $('.mjs-valid-confi-num-dcto').fadeOut();
            }


            if($apellidos == ''){  // Condicion => Apellidos
               $('.mjs-valid-apellidos').fadeIn();
               $('#apellidos').focus();
               return false;
            }else{
               $('.mjs-valid-apellidos').fadeOut();
            }


            if($departamento == ''){  // Condicion => Departamento
               $('.mjs-valid-departamento').fadeIn();
               $('#departamento').focus();
               return false;
            }else{
               $('.mjs-valid-departamento').fadeOut();
            }

            if($residencia == ''){  // Condicion => Direccion de Residencia
               $('.mjs-valid-residencia').fadeIn();
               $('#direccion').focus();
               return false;
            }else{
               $('.mjs-valid-residencia').fadeOut();
            }


            if($barrio == ''){   // Condicion =>  Barrio
               $('.mjs-valid-barrio').fadeIn();
               $('#barrio').focus();
               return false;
            }else{
               $('.mjs-valid-barrio').fadeOut();
            }


            if($correo == '' || !$expr.test($correo)){ // Condicion => Correo Electronico
               $('.mjs-valid-correo').fadeIn();
               $('#correo').focus();
               return false;
            }else{
               $('.mjs-valid-correo').fadeOut();
            }


            if($num_cel == ''){   // Condicion => Numero Celular
               $('.mjs-valid-cel').fadeIn();
               $('#celular').focus();
               return false;
            }else{
               $('.mjs-valid-cel').fadeOut();
            }


            if($confi_correo == ''){  // Condicion => Confirmar Correo Electronico
               $('.mjs-valid-confi-correo').fadeIn();
               $('#confirmar-correo').focus();
               return false;
            }else{
               $('.mjs-valid-confi-correo').fadeOut();
            }


      });

   });


// https://www.youtube.com/watch?v=N8_bRPd6Z6o  =>> esta lo que sige confirmar











