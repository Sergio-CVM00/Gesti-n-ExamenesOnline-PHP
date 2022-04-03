<?php
	session_start();
	//id de estudiante y asignatura que es pasado por session
	$id_Asignatura=$_SESSION['ID_asignatura'];
	$id_estudiante=$_SESSION['ID_estudiante'];

	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta0="SELECT nombre FROM estudiante WHERE ID_estudiante=$id_estudiante";
			$consulta="SELECT ID_examen,Nota FROM estudiante_examen WHERE ID_estudiante=$id_estudiante";
			$consulta2="SELECT nombre from asignatura WHERE ID_asignatura=$id_Asignatura";

			$resultado0=mysqli_query($conexion,$consulta0);
			$resultado=mysqli_query($conexion,$consulta);
			$resultado2=mysqli_query($conexion,$consulta2);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}

	$nombre_alumno=mysqli_fetch_row($resultado0);
	$nombre_Asignatura=mysqli_fetch_row($resultado2);

	//Creamos vectores vacios para almacenar los id de examenes que ha realizado el alumno y la nota en ese examen
	$examenes=array();
	$nota=array();

	//Almacenamos en los vectores anteriores los datos almacenado en la Base de Datos
	while($row=mysqli_fetch_row($resultado)){
		array_push($examenes,$row[0]);
		array_push($nota, $row[1]);
	}
	
	//Creamos un vector vacio para almacenar el id del tema al que pertenecen los examenes que ha realizado el alumno 
	$temas=array();

	foreach($examenes as $id){
		if($conexion){
			$consulta3="SELECT ID_tema FROM examen WHERE ID_examen=$id";
			$resultado3=mysqli_query($conexion,$consulta3);

			while($row=mysqli_fetch_row($resultado3)){
				array_push($temas, $row[0]);
			}
		}
	}

	//Creamos un vector vacio para almacenar el nombre del tema al que pertenecen los examenes que ha realizado el alumno 
	$nombre_tema=array();

	foreach($temas as $id_t){
		if($conexion){
			$consulta4="SELECT nombre FROM tema WHERE ID_tema=$id_t";
			$resultado4=mysqli_query($conexion,$consulta4);
		}

		while($row=mysqli_fetch_row($resultado4)){
			array_push($nombre_tema, $row[0]);
		}
	}

	//Mostramos los resultados
	echo "<h2>Resultados de la asignatura ".$nombre_Asignatura[0]." del alumno ".$nombre_alumno[0].": ";
	echo "</h2>";


	echo "<table border=1>";
	echo "<tr bgcolor=#091DFB><td><p style=color:white>Nombre del Tema</p></td><td><p style=color:white>Nota del examen</p></td></tr>";
	$i=0;
	$j=0;
	while($i<count($examenes)){
		echo "<tr bgcolor=#C0C0C0>";
		
		echo "<td>";
		echo $nombre_tema[$j];
		echo "</td>";
		echo "<td>";
		echo $nota[$j];
		echo "</td>";
		$j++;
		
		echo "</tr>";
		$i++;
	}
	echo "</table>";
	echo '<a href="..\Login\indexEst.php">Volver</a>';

mysqli_close($conexion);

?>