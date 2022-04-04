<?php
    //Conectar con BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1");

    //Consultas
    $sqlAsig = "SELECT ID_asignatura, nombre FROM asignatura";
    $sqlPro = "SELECT ID_profesor, PROFESOR_NOMBRE FROM profesor";

    $queryAsig = mysqli_query($conn, $sqlAsig);
    $queryPro = mysqli_query($conn, $sqlPro);

    mysqli_close($conn);

    $nFilasAsig = mysqli_num_rows($queryAsig);
    $nFilasPro = mysqli_num_rows($queryPro);

    if(isset($_POST['matricula']))
    {
        
        //Recoger datos
        $idAsig = $_POST['asig'];
        $idPro = $_POST['pro'];

        //Conectar con BD
        $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: no se pudo conectar con la BD");

        //Añadir
        $sqlAnnadir = "INSERT INTO profesor_asignatura (ID_asignatura, ID_profesor) VALUES ('$idAsig', '$idPro')";
        $sqlComprobar = "SELECT ID_asignatura, ID_profesor FROM profesor_asignatura WHERE ID_asignatura = '$idAsig' AND ID_profesor = '$idPro'";
        $queryComprobar = mysqli_query($conn, $sqlComprobar);

        if(mysqli_num_rows($queryComprobar) >= 1)
        {
            echo "Error:";
            echo "<br>";
            echo "Ese profesor ya pertenece a esa asignatura";
        }
        else
        {
            $queryAnnadir = mysqli_query($conn, $sqlAnnadir) or die("Error: no se pudo añadir la asignatura");
            mysqli_close($conn);
            header("Location: confirmRegistro.php");
        }                
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nueva matricula</title>
</head>
<body>
	<h1>Asignar profesor a una asignatura</h1>
    <h4>Seleccione una asignatura y un profesor</h4>

    <form action = "" name = "matricula" method = "post">    
        <label for = "asig">Asignatura:</label>
        <br>
        <select id = "asig" name = "asig">
            <?php
                for($i = 0; $i < $nFilasAsig; $i++)
                {
                    $resultadoAsig = mysqli_fetch_array($queryAsig);
                    echo "<option value = $resultadoAsig[ID_asignatura]>";
                    echo $resultadoAsig['ID_asignatura']." - ".$resultadoAsig['nombre'];
                    echo '</option>';
                }
            ?>
        </select>
        <br>
        <br>
        <label for = "pro">Seleccione profesor:</label>
        <br>
        <select id = "pro" name = "pro">
            <?php
                for($i = 0; $i < $nFilasPro; $i++)
                {
                    $resultadoPro = mysqli_fetch_array($queryPro);
                    echo "<option value = $resultadoPro[ID_profesor]>";
                    echo $resultadoPro['ID_profesor']." - ".$resultadoPro['PROFESOR_NOMBRE'];
                    echo '</option>';
                }
            ?>
        </select>
        <br>
        <br>
        <input type = "submit" name = "matricula" value = "Hacer asignacion">
    </form>    
    <br>
    <br>
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a>
</body>
</html>