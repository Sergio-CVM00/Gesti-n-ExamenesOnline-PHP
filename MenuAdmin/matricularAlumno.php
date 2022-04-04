<?php
    //Conectar con BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1");

    //Consultas
    $sqlAsig = "SELECT ID_asignatura, nombre FROM asignatura";
    $sqlEst = "SELECT ID_estudiante, nombre FROM estudiante";

    $queryAsig = mysqli_query($conn, $sqlAsig);
    $queryEst = mysqli_query($conn, $sqlEst);

    mysqli_close($conn);

    $nFilasAsig = mysqli_num_rows($queryAsig);
    $nFilasEst = mysqli_num_rows($queryEst);

    if(isset($_POST['matricula']))
    {
        
        //Recoger datos
        $idAsig = $_POST['asig'];
        $idEst = $_POST['est'];

        //Conectar con BD
        $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: no se pudo conectar con la BD");

        //Añadir
        $sqlAnnadir = "INSERT INTO asignatura_alumno (ID_asignatura, ID_estudiante) VALUES ('$idAsig', '$idEst')";
        $sqlComprobar = "SELECT ID_asignatura, ID_estudiante FROM asignatura_alumno WHERE ID_asignatura = $idAsig AND ID_estudiante = $idEst";
        $queryComprobar = mysqli_query($conn, $sqlComprobar);

        if(mysqli_num_rows($queryComprobar) >= 1)
        {
            echo "Error:";
            echo "<br>";
            echo "Ese alumno ya pertenece a esa asignatura";
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
	<h1>Matricular alumno</h1>
    <h4>Seleccione una asignatura y un alumno</h4>

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
        <label for = "est">Seleccione estudiante:</label>
        <br>
        <select id = "est" name = "est">
            <?php
                for($i = 0; $i < $nFilasEst; $i++)
                {
                    $resultadoEst = mysqli_fetch_array($queryEst);
                    echo "<option value = $resultadoEst[ID_estudiante]>";
                    echo $resultadoEst['ID_estudiante']." - ".$resultadoEst['nombre'];
                    echo '</option>';
                }
            ?>
        </select>
        <br>
        <br>
        <input type = "submit" name = "matricula" value = "Hacer matricula">
    </form>    
    <br>
    <br>
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a>
</body>
</html>