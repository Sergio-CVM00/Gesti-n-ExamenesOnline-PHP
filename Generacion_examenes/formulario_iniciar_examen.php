<?php
session_start();
//Recoger de tabla examen numero preguntas y el tema del examen según la asignatura y la fecha de realización del examen
//Tablas examen, tema, estudiante_examen

$id_Asignatura=$_SESSION['ID_asignatura'];

//id del estudiante que se ha identificado 
$id_estudiante=$_SESSION['ID_estudiante'];

//Conectar a mysql
$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
if($conexion)
{
	//Consulta para conseguir el nombre de la asignatura
	$consulta0="SELECT nombre FROM asignatura WHERE ID_asignatura=$id_Asignatura";

	//Consulta para conseguir los temas de la asignatura elegida
	$consulta="SELECT ID_tema FROM tema WHERE ID_asignatura=$id_Asignatura";

	$resultado0=mysqli_query($conexion,$consulta0);
	$resultado=mysqli_query($conexion,$consulta);
}
else
{
	echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
}

$row=mysqli_fetch_row($resultado0);
$nombre_asignatura=$row[0];

$temas=array();
while($row=mysqli_fetch_row($resultado))
{
	array_push($temas,$row[0]);
}


$fecha_actual=date('Y-m-d');
$examen_fecha_actual=false;
$examen_realizado=false;

foreach($temas as $id)
{
	if($conexion)
	{
		//Consulta para conseguir los temas cuya fecha es la actual
		$consulta2="SELECT ID_tema,ID_examen FROM examen WHERE ID_tema='$id' AND fecha='$fecha_actual'";
		$resultado2=mysqli_query($conexion,$consulta2);
	}

	$num_row=mysqli_num_rows($resultado2);
	$row=mysqli_fetch_row($resultado2);

	if($num_row != 0)
	{
		$tema=$row[0];
		$examen=$row[1];
		$examen_fecha_actual=true;
	}
}

if($conexion AND $examen_fecha_actual)
{
	$consulta3="SELECT nombre FROM tema WHERE ID_tema=$tema";
	$resultado3=mysqli_query($conexion,$consulta3);

	$consulta4="SELECT * FROM estudiante_examen WHERE ID_estudiante='$id_estudiante' AND ID_examen='$examen'";
	$resultado4=mysqli_query($conexion,$consulta4);

	$row=mysqli_fetch_row($resultado3);
	$nombre_tema=$row[0];

	if(mysqli_num_rows($resultado4) != 0)
	{
		$examen_realizado=true;
	}
}


//Formulario:
	echo "<h2>Examenes de la asignatura: $nombre_asignatura</h2>";

	echo "<form action=mostrar_examen_almacenar_respuestasII.php method=POST>";

		if($examen_realizado==false && $examen_fecha_actual==true)
		{
			echo "Examen del tema: ".$nombre_tema;

			echo "<br>";
			echo "<br>";
			echo "<input type=hidden name=ID_tema value=$tema />";


			echo '<input type="submit" value="Realizar examen">';
		}
		else if($examen_realizado==true && $examen_fecha_actual==true)
		{
			echo "Examen del tema: ".$nombre_tema;

			echo "<br/>";
			echo "<br/>";

			echo "Ya ha realizado este examen";
		}
		else
		{
			echo "No hay ningún examen programado para hoy";			
		}
	echo "</form>";
	echo "<br>";
	echo "<br>";
	echo "<a href = '../Login/indexEst.php?id=$id_Asignatura'><input type = 'button' value = 'Volver'></a>";

?>

<!DOCTYPE html>
<head>
	<title>Realizar examen</title>
</head>
</html>