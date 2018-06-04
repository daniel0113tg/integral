<?php

//LLAMADA AL ARCHIVO FUNCIONESPR.PHP QUE CONTIENE FUNCIONES A USARSE
require_once("FuncionesPr.php");

class cuadraturagaussiana{

	//FUNCION QUE DEVUELVE EL VALOR DE W
	function w($n,$raiz,$polinomio0,$polinomio1){
		//EL VALOR DE W CALCULADO A PARTIR DE FUNCIONES DECLARADAS EN FUNCIONESPR.PHP
		$w=(-2)/(($n+1)*derivadaPunto($funcion,$raiz)*remfuncion($raiz,$polinomio1));
		//RETORNO DEL VALOR DE W
		return $w;	
	}

	function integralgaussiana($funcion,$a,$b,$n)
	{
		//GUARDA EN STRING EL POLINOMIO DE LEGRENGE EN LA VARIABLE $polinomio 
		$polinomio = polinomio($n);
		//GUARDA LAS RAICES DEL POLINOMIO DE LEGRNEGE EN LA VARIABLE $raices
		$raices[$n] = calcularaices($polinomio,$n);
		//$integral VARIABLE DONDE ESTARA EL VALOR DE LA INTEGRAL CON VALOR INICIAL DE ($b-$a)/2
		$integral = ($b-$a)/2;
		//$sumatoria VARIABLE DONDE GUARDARA LA SUMATORIA DE LA INTEGRAL DESDE 1 HASTA N
		$sumatoria =0;
		for(int $i = 1, $i <= $n;$i++)
		{
		//ASIGNO EL VALOR DE Xi
		$xi=((($b-$a)/2)*raices[i-1])+(($b+$a)/2);
		//VOY SUMANDO LOS VALORES DE MULTIPLICAR LA FUNCION EVALUADA EN Xi Y W
		$sumatoria +=  evaluar($funcion,$xi)*w($n,$raices[i-1],$polinomio,polinomio($n+1)); 
		}
		//MULTIPLICO EL VALOR DE LA SUMATORIA POR LO QUE TENIA ANTERIORMENTE EN LA VARIABLE INTEGRAL
		$integral*=$sumatoria;
		//RETORNO LA INTEGRAL
		return $integral;
	}
}
?>
