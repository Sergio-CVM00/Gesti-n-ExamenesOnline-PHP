<?php
	session_start();
	//Para probar ponemos el ID_Asignatura a 1
	$_SESSION['ID_asignatura_elegida']=2;

	//ID asignatura es enviado a través de Session
	$id_Asignatura=$_SESSION['ID_asignatura_elegida'];

	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","gestion_examenes");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta="SELECT * FROM tema WHERE ID_asignatura=$id_Asignatura";
			$resultado=mysqli_query($conexion,$consulta);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}

	//Formulario:
	echo "<h2>Formulario Generaci&oacute;n de Examenes</h2>";

	echo "<form action=formulario_generacionII.php method=POST>";
		echo "<p>Tema:";
		echo "<select name=Tema>"; 
			echo "<option value=disabled selected>";
				echo "Elija un tema";
			echo "</option>";
			while($row=mysqli_fetch_row($resultado)){
				echo "<option value=$row[0]>";
				echo $row[1];
				echo "</option>";
			}
		echo "</select>";
		echo "</p>";
		echo "<br/>";
		echo "<br/>";

		echo "<p>";
		echo "<input type=submit value=Siguiente>";
		echo "</p>";
	echo "</form>";


mysqli_close($conexion);

?>