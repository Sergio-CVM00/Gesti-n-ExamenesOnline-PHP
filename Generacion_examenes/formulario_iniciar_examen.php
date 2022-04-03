<?php
session_start();
//Recoger de tabla examen numero preguntas y el tema del examen según la asignatura y la fecha de realización del examen
//Tablas examen, tema, estudiante_examen

//Asignatura es enviada a través de session
$_SESSION['ID_asignatura_elegida']=2;	//Para comprobar
$id_Asignatura=$_SESSION['ID_asignatura_elegida'];

//id del estudiante que se ha identificado 
$_SESSION['ID_estudiante']=1;	//Para probar
$id_estudiante=$_SESSION['ID_estudiante'];

//Conectar a mysql
$conexion=mysqli_connect("127.0.0.1","root","","gestion_examenes");
if($conexion){
		//Consulta para conseguir los temas que tiene una asignatura
		$consulta0="SELECT nombre FROM asignatura WHERE ID_asignatura=$id_Asignatura";
		$consulta="SELECT ID_tema FROM tema WHERE ID_asignatura=$id_Asignatura";

		$resultado0=mysqli_query($conexion,$consulta0);
		$resultado=mysqli_query($conexion,$consulta);
}
else{
	echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
}

$row=mysqli_fetch_row($resultado0);
$nombre_asignatura=$row[0];

$temas=array();
while($row=mysqli_fetch_row($resultado)){
	array_push($temas,$row[0]);
}

$fecha_actual=date('Y-m-d');

foreach($temas as $id){
	if($conexion){
		$consulta2="SELECT ID_tema FROM examen WHERE ID_tema='$id' AND fecha='$fecha_actual'";
		$resultado2=mysqli_query($conexion,$consulta2);
	}

	$num_row=mysqli_num_rows($resultado2);
	$row=mysqli_fetch_row($resultado2);

	if($num_row != 0){
		$tema=$row[0];
	}
}

if($conexion){
	$consulta3="SELECT nombre FROM tema WHERE ID_tema=$tema";
	$resultado3=mysqli_query($conexion,$consulta3);

	$row=mysqli_fetch_row($resultado3);
	$nombre_tema=$row[0];
}

//Formulario:
	echo "<h2>Examenes de la asignatura $nombre_asignatura</h2>";

	echo "<form action=mostrar_examen_almacenar_respuestasII.php method=POST>";
		echo "<p>";
		echo "Examen Tema ".$nombre_tema;
		echo "</p>";

		echo "<br/>";
		echo "<br/>";

		echo "<input type=hidden name=ID_tema value=$tema />";

		echo "<p>";
		echo "<input type=submit value=Realizar_examen>";
		echo "</p>";
	echo "</form>";


?>