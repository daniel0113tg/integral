<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>INTEGRAL</title>
	<?php
include("trapecios.php");
include("simpson.php");
include("cuadraturagaussiana.php");
	?>
</head>
<body>
<header>
	<h1 align="center">ALGORITMOS NUMÉRICOS </h1>
</header>
<hr>
	<p>Por favor seguir las recomendaciones de ingreso:</br>-En el caso de funciones cuadraticas o de mayor exponente poner la notacion (x*x*x...n) dependiendo el grado al cual quiera elevar, los parentesis son muy importantes para evitar errores.</br>Ej. 2*(x*x*x)+ (2*x)+6.</br>-En el caso de la funcion senosoidal poner la notacion sin(x) y los valores a evaluar tienen que estar en radianes.</br>Ej. sin(x) evaluación en 45° en radianes = 0.785398. </br></p>
	<table align = 'center'>
<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method = "post"  >
		<tr bgcolor="#58FA58">
			<td   >FUNCION:</td>
		<td>
			<input type="text" name="fx" >

		</td>
		</tr>
		<tr  bgcolor="#F4FA58">
			<td>INTEGRAL:</td>
			<td>
				<input type="text" name="Dx">
			</td>
		</tr>
			<tr bgcolor="#D0A9F5">
			<td>LIMITE DE INTEGRACION a:</td>
			<td>
				<input type="text" name="a"> 
			</td>
		</tr>
					<tr bgcolor="#11BDAF">
			<td>LIMITE DE INTEGRACION b:</td>
			<td>
				<input type="text" name="b">
			</td>
		</tr>
		<tr bgcolor="#A5BCA9">
			<td>TOLERANCIA:</td>
			<td>
				<input type="text" name="tolerancia">
			</td>
		</tr>
		<tr bgcolor="#F5BCA9">
			<td>METODO DE INTEGRACION:</td>
  <td   align="center">
				<select type = "text" name="metodointegral">
					<option value=0> </option>
					<option value=1> 1. MÉTODO TRAPECIOS  </option> 
<option value=2> 2. MÉTODO DE SIMPSON  </option> 
<option value=3> 2. MÉTODO DE CUADRATURA GAUSSIANA   </option> 
</select> 
			</td>
		</tr>
		<tr bgcolor="#B5BCA9">
			<td colspan="2" align="center">
				<hr>
				<input type="submit" name="boton" value = "CALCULAR">		
			</td>
		</tr>
		</form>
	</table>
</hr>
<section>
<?php 

function evaluar($x,$funcion)
{
	$evaluado = str_replace("x", "(".$x.")", $funcion);
	eval("\$resultado= ".$evaluado.";");
	return $resultado;
}

function encuentraerror($real,$aproximado)
{
	$error = abs($real-$aproximado);
	$error /= $real;
	$error *= 100; 
return $error;
}

function integralanalitica($a,$b,$integralanalitica)
{
	return evaluar($b,$integralanalitica)-evaluar($a,$integralanalitica);
}


function encuentraNTrapecios($a,$b,$tolerancia,$funcion,$integralanalitica){
//%n es el anteior y $n2 es el actual 
$n = 1;//actual
$n2 = $n+1;
do {
echo '<tr align="center">';
echo "<td>$n</td>";
echo "<td>".trapecios::integraltrapecios($a,$b,$n,$funcion)."</td>";
echo "<td>".integralanalitica($a,$b,$integralanalitica)."</td>";
echo "<td>".encuentraerror(integralanalitica($a,$b,$integralanalitica),trapecios::integraltrapecios($a,$b,$n,$funcion))."%</td>";
echo "</tr>";
$n = $n2;
$n2 = $n2+1;
} while( abs(trapecios::integraltrapecios($a,$b,$n2,$funcion) - trapecios::integraltrapecios($a,$b,$n,$funcion) ) >=  $tolerancia);
echo '</table>';
}

function encuentraNCuadraturaGaussiana($a,$b,$tolerancia,$funcion,$integralanalitica){
//%n es el anteior y $n2 es el actual 
$n = 1;
$n2 = $n+1;
do {
echo '<tr align="center">';
echo "<td>$n</td>";
echo "<td>".cuadraturagaussiana::integralgaussiana($funcion,$a,$b,$n)."</td>";
echo "<td>".integralanalitica($a,$b,$integralanalitica)."</td>";
echo "<td>".encuentraerror(integralanalitica($a,$b,$integralanalitica),cuadraturagaussiana::integralgaussiana($funcion,$a,$b,$n))."%</td>";
echo "</tr>";
$n = $n2;
$n2 = $n2+1;
} while( abs(cuadraturagaussiana::integralgaussiana($funcion,$a,$b,$n2) - cuadraturagaussiana::integralgaussiana($funcion,$a,$b,$n) ) >=  $tolerancia);
echo '</table>';
}


function encuentraNSimpson($a,$b,$tolerancia,$funcion,$integralanalitica){
//%n es el anteior y $n2 es el actual 
$n = 2;
$n2 = $n+2;
do {
echo '<tr align="center">';
echo "<td>$n</td>";
echo "<td>".simpson::integralsimpson($a,$b,$n,$funcion)."</td>";
echo "<td>".integralanalitica($a,$b,$integralanalitica)."</td>";
echo "<td>".encuentraerror(integralanalitica($a,$b,$integralanalitica),simpson::integralsimpson($a,$b,$n,$funcion))."%</td>";
echo "</tr>";
$n = $n2;
$n2 = $n2+2;
} while( abs(simpson::integralsimpson($a,$b,$n2,$funcion) - simpson::integralsimpson($a,$b,$n,$funcion) ) >=  $tolerancia);
echo '</table>';
}


//IMPRIMIR CUADRO
function imprimir($a,$b,$funcion,$integral,$tolerancia,$metodointegral)
{
echo "<h3>FUNCION ELEGIDA: " . $funcion . "</h3><h3>INTEGRAL ANALITICA: " . $integral . "</h3><h3>LIMITE DE INTEGRACION a: " . $a . "</h3><h3>LIMITE DE INTEGRACION b: ".$b."</h3><h3>TOLERANCIA: ".$tolerancia."</h3>";
	if($metodointegral == 1)
	{
echo '<table width="70%" aling = "center" border ="2">';
echo "<tr>";
echo '<th colspan="4" aling="center" bgcolor="#819FF7"'."<h1>"."    METODO REGLA TRAPECIOS   "."</h1".'</th>';
echo "</tr>";
echo '<th aling="center" bgcolor="#58FA58"'."<h3>"."    NUMERO DE TRAPECIOS   "."</h3".'</th>';
echo '<th aling="center" bgcolor="#F4FA58"'."<h3>"."∫f(x) NUMERICA"."</h3".'</th>';
echo '<th aling="center" bgcolor="#D0A9F5"'."<h3>"."∫f(x) ANALITICA"."</h3".'</th>';
echo '<th aling="center" bgcolor="#F5BCA9"'."<h3>"."ERROR"."</h3".'</th>';
echo "</tr>";
encuentraNTrapecios($a,$b,$tolerancia,$funcion,$integral);
	}
	else
	{
			if($metodointegral == 2)
	{
echo '<table width="70%" aling = "center" border ="2"> ';
echo "<tr>";
echo '<th colspan="4" aling="center" bgcolor="#819FF7"'."<h1>"."    METODO DE SIMPSON   "."</h1".'</th>';
echo "</tr>";
echo "<tr>";
echo '<th aling="center" bgcolor="#58FA58"'."<h3>"."    NUMERO DE INTERVALOS PARES   "."</h3".'</th>';
echo '<th aling="center" bgcolor="#F4FA58"'."<h3>"."∫f(x) NUMERICA"."</h3".'</th>';
echo '<th aling="center" bgcolor="#D0A9F5"'."<h3>"."∫f(x) ANALITICA"."</h3".'</th>';
echo '<th aling="center" bgcolor="#F5BCA9"'."<h3>"."ERROR"."</h3".'</th>';
echo "</tr>";
encuentraNSimpson($a,$b,$tolerancia,$funcion,$integral);
    }
    else
    	if($metodointegral == 3)
    	{
echo '<table width="70%" aling = "center" border ="2"> ';
echo "<tr>";
echo '<th colspan="4" aling="center" bgcolor="#819FF7"'."<h1>"."    METODO CUADRATURA GAUSSIANA   "."</h1".'</th>';
echo "</tr>";
echo '<th aling="center" bgcolor="#58FA58"'."<h3>"."    GRADO POLINOMIO LEGRENGE   "."</h3".'</th>';
echo '<th aling="center" bgcolor="#F4FA58"'."<h3>"."∫f(x) NUMERICA"."</h3".'</th>';
echo '<th aling="center" bgcolor="#D0A9F5"'."<h3>"."∫f(x) ANALITICA"."</h3".'</th>';
echo '<th aling="center" bgcolor="#F5BCA9"'."<h3>"."ERROR"."</h3".'</th>';
echo "</tr>";
encuentraNCuadraturaGaussiana($a,$b,$tolerancia,$funcion,$integral);
    	}
	}

}

//PHP GENERAL
if(isset($_POST['boton'])){
$funcion=$_POST['fx'];
$integral=$_POST['Dx'];
$a=$_POST['a'];
$b=$_POST['b'];
$tolerancia=$_POST['tolerancia'];
$metodointegral=$_POST['metodointegral'];
if(is_numeric($a) && is_numeric($b) && is_numeric($tolerancia) && $tolerancia > 0)
{
	if($metodointegral == 0){
echo "POR FAVOR SELECCIONE UN METODO DE INTEGRACION PRIMERO";
	}
	else
	{
	imprimir($a,$b,$funcion,$integral,$tolerancia,$metodointegral);
	}
}
else
{
echo "POR FAVOR INGRESE VALORES CORRECTOS";
}
}

?>	
</section>
<footer>
	<br>
	<hr>
	<p align="center">Todos los derechos reservados ©</p>
</footer>
</body>
</html>