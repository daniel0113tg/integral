<?php 

	//FUNCION QUE DADA UNA FUNCION EN STRING Y UN PUNTO X DEVUELVE EL VALOR DE LA FUNCION EVALUADA EN ESE PUNTO
	function remfuncion($x,$funcion) {
    	$resultado=0;
		$funcion=str_replace("x",$x,$funcion);
		eval ("\$resultado=$funcion;");
		return $resultado;
    }

    //FUNCION QUE CALCULA LA PENDIENTE DADO UNA FUNCION, UN PUNTO Y UN DESVIO POR EL METODO DE DIFERENCIAS CENTRADAS
    function difCentra($punto,$desvio,$funcion){
		return ((remfuncion($punto+$desvio,$funcion)-remfuncion($punto-$desvio,$funcion))/(2*$desvio));
	}

	//FUNCION QUE DEVUELVE LA DERIVADA DADA LA FUNCION Y UN PUNTO PARA ESTO USA UNA TOLERANCIA Y UN DEVIO Y EL METODO DE DIFERENCIAS CENTRADAS
    function derivadaPunto($funcion,$punto) {

    	//DECLARACION DEL DESVIO Y LA TOLERANCIA
    	$desvio=0.1;
     	$tolA=1e-6;

     	//PRIMER CALCULO DE LA PENDIENTE A Y B
     	$pendA=abs(difCentra($punto,$desvio,$funcion));
		$desvio=$desvio/2;
		$pendB=abs(difCentra($punto,$desvio,$funcion));

		//SE EJECUTA UN LAZO WHILE HASTA QUE LA DIFERENCIA ENTRE LA PENDIENTE A Y B SEA MENOR QUE LA TOLERANCIA ADMITIDA
		while((abs($pendA-$pendB))>$tolA){
        	$pendA=$pendB;
      		$desvio/=2;
        	$pendB=abs(difCentra($punto,$desvio,$funcion));
      	}

      	//RETORNO DE LA DERIVADA EVALUADA
      	return $pendB;
    }
?>
