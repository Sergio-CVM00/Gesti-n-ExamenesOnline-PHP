<?php
session_start();
$num_preg=$_POST['numero_preguntas'];
$fecha_examen=$_POST['fecha_examen'];
$id_tema=$_POST['Tema'];

$id_Asignatura = $_SESSION['ID_asignatura'];
$_SESSION['num_preg_examen']=$num_preg;

//Conectar a mysql
	$conexion=mysqli_connect("127.0.0.1","root","","bdp1");
	if($conexion){
			//Consulta para conseguir los temas que tiene una asignatura
			$consulta="INSERT INTO examen (ID_tema,num_preguntas,fecha) VALUES ('$id_tema','$num_preg','$fecha_examen')";
			$resultado=mysqli_query($conexion,$consulta);
	}
	else{
		echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
	}
//Introducir datos (tema, num_preguntas) en tabla examen
//Hay que crear tabla examen (tendrá campos ID_examen num_preg y ID_tema), estudiante_tema tendrá campo ID_examen en lugar de ID_tema


echo "<h2>El examen ha sido generado con éxito</h2>";
echo "<a href = '../Login/indexPro.php?id=$id_Asignatura'><input type = 'button' value = 'Volver'></a>";
?>
