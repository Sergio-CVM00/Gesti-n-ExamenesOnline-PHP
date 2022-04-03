<?php
	session_start();
	//id asignatura que da el profesor y el tema
	$id_Asignatura=$_SESSION['ID_asignatura'];

	$id_tema=$_POST['Tema'];

	//Conectar a mysql
	$conexion=mysqli_connect("localhost","root","",'bdp1');
	if($conexion){
			//Consultas para conseguir el número de preguntas que tiene un tema
			$consulta="SELECT ID_pregunta from preguntas WHERE ID_tema=$id_tema";
			$resultado=mysqli_query($conexion,$consulta);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}
	//Maximo de numero de preguntas es numero de filas de consulta mysql

	$num_preguntas=mysqli_num_rows($resultado);
	$fecha_actual=date('Y-M-D');
	//Formulario:
	echo "<h2>Creación de examen</h2>";

	echo "<form action=fin_generacion_examen.php method=POST>";
	
		echo "Número de preguntas:";
		echo "<br>";
		echo "<input type=number name=numero_preguntas min=1 max=$num_preguntas >";
		echo "<br>";
		echo "<br>";

		echo "Fecha:";
		echo "<br>";
		echo "<input type=date name=fecha_examen value=$fecha_actual >";

		echo "<input type=hidden name=Tema value=$id_tema />";
		echo "<br>";
		echo "<br>";
		echo "<input type=submit value=Crear Examen>";
	echo "</form>";
	echo "<br>";
	echo "<a href = '../Login/indexPro.php?id=$id_Asignatura'><input type = 'button' value = 'Cancelar'></a>";


mysqli_close($conexion);

?>

<!DOCTYPE html>
<head>
	<title>Crear examen</title>
</head>
</html>