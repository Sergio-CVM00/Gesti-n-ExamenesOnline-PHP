<?php
	session_start();
	//id de profesor (y asignatura que da?) es pasado por session
	$id_tema=$_POST['Tema'];
	$id_Asignatura=$_SESSION['ID_asignatura'];
	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta0="SELECT ID_examen FROM examen WHERE ID_tema=$id_tema";
			$consulta2="SELECT nombre from asignatura WHERE ID_asignatura=$id_Asignatura";
			$consulta3="SELECT nombre from tema WHERE ID_tema=$id_tema";

			$resultado0=mysqli_query($conexion,$consulta0);
			$resultado2=mysqli_query($conexion,$consulta2);
			$resultado3=mysqli_query($conexion,$consulta3);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}
	$nombre_Asignatura=mysqli_fetch_row($resultado2);
	$nombre_tema=mysqli_fetch_row($resultado3);
	$id_examen=mysqli_fetch_row($resultado0);

	if($conexion){
		$consulta1="SELECT Nota from estudiante_examen WHERE ID_examen=$id_examen[0]";
		$resultado=mysqli_query($conexion,$consulta1);
	}
	echo "<h2>Resultados globales del ex&aacute;men del tema ".$nombre_tema[0]." de la asignatura ".$nombre_Asignatura[0].": ";
	echo "</h2>";

	$cont=0;
	$suma=0;
	while($row=mysqli_fetch_row($resultado)){
		$suma=$suma+$row[0];
		$cont++;
	}

	echo "Nota media del tema: ";
	echo $suma/$cont;
	echo '<a href="..\Login\indexPro.php">Volver</a>';
	
mysqli_close($conexion);

?>