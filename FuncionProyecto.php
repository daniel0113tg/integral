<?php
		//Funcion para reemplazar n's por el valor de n
		function reemplazar($n, $function){
			
			//Asignar a la variable funcion los $n's ya reemplazados
			$function = str_replace("n", $n, $function);
			//Retornar el string procesado
			return $function;
		
		}
		
		//Funcion Polinomios Lagrange
		function poli($n){

			//Retornar solucion 1
			if($n == 0)
				return "1";

			//Retornar solucion 2
			else if($n == 1)
				return "x";
	
			//Asignar recursivamente los polinomios hasta llegar al caso base (concatenar)
			$poli = reemplazar($n, "(1/n)")."*((".reemplazar($n, "(2*n - 1)")."*x*(".poli($n - 1).")"."-(".reemplazar($n, "(n - 1)")."*".poli($n - 2).")))";
						
			//Retornar el resultado			
			return $poli;
		
		}
		
		//PRUEBA
		
		//Asignar el resultado a la variable string
		$string = poli(4);

		//Imprimir la variable string
		print $string;
		
?>
