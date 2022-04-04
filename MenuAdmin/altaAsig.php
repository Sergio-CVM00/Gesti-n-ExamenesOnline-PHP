<?php
    //Conectar con BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1");

    //Consultas
    $sqlGrados = "SELECT ID_grado, GRADO_NOMBRE FROM grado";
    $sqlPro = "SELECT ID_profesor, PROFESOR_NOMBRE FROM profesor";

    $queryGrados = mysqli_query($conn, $sqlGrados);
    $queryPro = mysqli_query($conn, $sqlPro);

    mysqli_close($conn);

    $nFilasGrados = mysqli_num_rows($queryGrados);
    $nFilasPro = mysqli_num_rows($queryPro);

    if(isset($_POST['annadir']))
    {
        //Comprobar que los campos se han rellenado
        $vacio = false;
        if((trim($_POST["nombreAsig"]) == ""))
        {
            $vacio = true;
        }
        
        if($vacio)  //Mostrar error si algun campo es vacio
        {
            echo '<br>';
            echo "Error:";
            echo '<br>';
            echo "Debe introducir un nombre";
        }
        else
        {
            //Recoger datos
            $nombreAsig = $_POST['nombreAsig'];
            $idGrado = $_POST['grado'];
            $idCoord = $_POST['coord'];

            //Conectar con BD
            $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: no se pudo conectar con la BD");

            //Añadir
            $sqlAnnadir = "INSERT INTO asignatura (ID_asignatura, nombre, ID_grado, ID_coordinador) VALUES ('', '$nombreAsig', '$idGrado', '$idCoord')";
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
	<title>Añadir Asignatura</title>
</head>
<body>
	<h1>Añadir asignatura</h1>
    <h4>Rellene los campos para crear una nueva asignatura</h4>

    <form action = "" name = "asig" method = "post">    
        <label for = "nombreAsig">Nombre de la Asignatura:</label>
        <br>
        <input type = "text" placeholder = "Introduce el nombre" name = "nombreAsig">
        <br>
        <br>
        <label for = "grado">Seleccione el grado:</label>
        <br>
        <select id = "grado" name = "grado">
            <?php
                for($i = 0; $i < $nFilasGrados; $i++)
                {
                    $resultadoGrados = mysqli_fetch_array($queryGrados);
                    echo "<option value = $resultadoGrados[ID_grado]>";
                    echo $resultadoGrados['ID_grado']." - ".$resultadoGrados['GRADO_NOMBRE'];
                    echo '</option>';
                }
            ?>
        </select>
        <br>
        <br>
        <label for = "coord">Seleccione el coordinador:</label>
        <br>
        <select id = "coord" name = "coord">
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
        <input type = "submit" name = "annadir" value = "Añadir asignatura">
    </form>
    
    <br>
    <br>
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a>
</body>
</html>