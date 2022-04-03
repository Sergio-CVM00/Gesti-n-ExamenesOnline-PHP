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
    <h4>Opciones del profesor</h4>
    <ul>
        <li>
        <a href = "../Generacion_examenes/formulario_generacion.php">Generar examen</a>
        </li>

        <li>
        <a href = "../crud-preguntas/index.php">Gestor de preguntas</a>            
        </li>

        <li>
        <a href = "../Visualizacion_resultados/formulario_visualizacion_profesores.php">Visualizar resultados</a>
        </li>
    </ul>
    <a href = "pro_asignatura.php"><input type = "button" value = "Volver"></a>
</body>
</html>


