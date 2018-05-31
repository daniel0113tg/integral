<?php
//METODO SIMPSON

class simpson{

function h($a,$b,$n){
return (($b-$a)/$n);
}

function integralsimpson ($a,$b,$n,$funcion){
$integral=(evaluar($a,$funcion));
$integral+=(evaluar($b,$funcion));
$sumaimpares=0;
$sumapares=0;
		     for($i=1; $i<$n; $i++){
		   $punto = $a+($i*simpson::h($a,$b,$n));
		     	if(simpson::espar($i))
	{
            $sumapares+=evaluar($punto,$funcion);
	}
	else
	{
		 $sumaimpares+=evaluar($punto,$funcion);
	}
	}
	$integral += 4*$sumaimpares + 2*$sumapares;

        return (($integral*simpson::h($a,$b,$n))/3);
}
function espar($n)
{
	if ($n%2==0)
	{
	return true;
	}
	else
	{
	return false;
	}
}
}

?>