
	function Carrito_Sumar(iddeinput)
	{
		var i;
		var cant = document.getElementById(iddeinput);

		if(cant.value>=0){
			i = cant.value;
			i++;
			cant.value = i;
		}else{
			i = 0;
			cant.value = i;
		}
	}

	function Carrito_Restar(iddeinput)
	{
		var i;
		var cant = document.getElementById(iddeinput);

		if(cant.value>1){
			i = cant.value;
			i--;
			cant.value = i;
		}else{
			cant.value="1";
		}
	}

	function Carrito_RestarTRON(iddeinput)
	{
		var i;
		var cant = document.getElementById(iddeinput);

		if(cant.value>=1){
			i = cant.value;
			i--;

			if (i<=0)
			{
				i=0;
			}
			cant.value = i;
		}
	}


