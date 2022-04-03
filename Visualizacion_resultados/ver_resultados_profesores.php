<?php
	session_start();
	//id de profesor (y asignatura que da?) es pasado por session
	$id_tema=$_POST['Tema'];
	$id_Asignatura=$_SESSION['ID_asignatura'];
	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta1="SELECT nombre from asignatura WHERE ID_asignatura=$id_Asignatura";
			$consulta2="SELECT nombre from tema WHERE ID_tema=$id_tema";

			$resultado1=mysqli_query($conexion,$consulta1);
			$resultado2=mysqli_query($conexion,$consulta2);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}
	$nombre_Asignatura=mysqli_fetch_row($resultado1);
	$nombre_tema=mysqli_fetch_row($resultado2);
	$examen_realizado=true;
	
	if($conexion){
		$consulta="SELECT estudiante_examen.Nota from estudiante_examen, examen WHERE estudiante_examen.ID_examen=examen.ID_examen AND examen.ID_tema=$id_tema";
		$resultado=mysqli_query($conexion,$consulta);

		if(mysqli_num_rows($resultado)==0){
			$examen_realizado=false;
		}
	}
	echo "<h1>$nombre_Asignatura[0]</h1>";
	echo "<br>";
	echo "<h2>Resultados globales del examen del tema "; 
	echo $nombre_tema[0];
	echo "</h2>";

	if($examen_realizado){
		$cont=0;
		$suma=0;

		while($row=mysqli_fetch_row($resultado)){
			$suma=$suma+$row[0];
			$cont++;
		}

		echo "Nota media del tema: ";
		echo $suma/$cont;
	}
	else{
		echo "El examen del tema ".$nombre_tema[0]." de la asignatura ".$nombre_Asignatura[0]." no se ha realizado a&uacute;n";
	}
	echo '<br>';
	echo "<a href = '../Login/indexPro.php?id=$id_Asignatura'><input type = 'button' value = 'Volver'></a>";
	
mysqli_close($conexion);

?>