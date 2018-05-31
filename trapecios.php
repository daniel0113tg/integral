<?php

//TRAPECIOS
class trapecios{

function h($a,$b,$n){
return (($b-$a)/$n);
}


function integraltrapecios($a,$b,$n,$funcion){
$suma=(evaluar($a,$funcion)+evaluar($b,$funcion))/2;
        for($i=1; $i<$n; $i++){
        	$punto = $a+($i*trapecios::h($a,$b,$n));
            $suma+=evaluar($punto,$funcion);
        }
        return $suma*trapecios::h($a,$b,$n);
}
}



?>