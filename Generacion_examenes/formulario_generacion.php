<?php
	session_start();
	//ID asignatura es enviado a través de Session
	$id_Asignatura=$_SESSION['ID_asignatura'];

	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta="SELECT * FROM tema WHERE ID_asignatura=$id_Asignatura";
			$resultado=mysqli_query($conexion,$consulta);
	}
	else{
		echo "<h2>Error de conexion con la Base de datos</h2>";
	}

	//Formulario:
	echo "<h2>Creación de examen</h2>";

	echo "<form action=formulario_generacionII.php method=POST>";
		echo "Tema:";
		echo "<br>";
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
		echo "<br>";
		echo "<br>";
		echo "<input type=submit value=Siguiente>";
	echo "</form>";
	echo "<br>";
	echo "<a href = '../Login/indexPro.php'><input type = 'button' value = 'Cancelar'></a>";


mysqli_close($conexion);

?>