<?php
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $_SESSION['ID_asignatura'] = $id;
        $idAsig = $_SESSION['ID_asignatura'];
    }

    //Buscar nombre de la asignatura
    $conexion = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");
    $sqlAsig = "SELECT nombre FROM asignatura WHERE ID_asignatura = $idAsig";
    $queryAsig = mysqli_query($conexion, $sqlAsig);
    $resultado = mysqli_fetch_array($queryAsig);
    mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $resultado['nombre']?></title>
</head>
<body>
	<h1><?php echo $resultado['nombre']?></h1>
    <h4>Opciones del alumno</h4>
    <ul>
        <li>
        <a href = "../Generacion_examenes/formulario_iniciar_examen.php">Realizar examen</a>
        </li>

        <li>
        <a href = "../Visualizacion_resultados/ver_resultados_alumnos.php">Visualización de calificaciones</a>          
        </li>
    </ul>
    <a href = "est_asignatura.php"><input type = "button" value = "Volver"></a>
</body>
</html>