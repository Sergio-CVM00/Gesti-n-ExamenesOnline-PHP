<?php
	session_start();
	$id_Asignatura=$_SESSION['ID_asignatura'];
	//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta="SELECT * from tema WHERE ID_asignatura=$id_Asignatura";
			$resultado=mysqli_query($conexion,$consulta);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}
	//Maximo de numero de preguntas es numero de filas de consulta mysql

	

	//Formulario:
	echo "<form action=ver_resultados_profesores.php method=POST>";
		echo "<p>Tema:";
		echo "<select name=Tema>"; 
			echo "<option value= disabled selected>";
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
		echo "<input type=submit value=Ver>";
		echo "</p>";
	echo "</form>";


mysqli_close($conexion);

?>