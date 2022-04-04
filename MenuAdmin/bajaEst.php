<!------------------->
<!--------PHP--------> 
<!------------------->
<?php
    //Conexion con la BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

    //Recoger a todos los estudiantes
    $sqlSelect = "SELECT ID_estudiante, nombre, email FROM estudiante";
    $querySelect = mysqli_query($conn, $sqlSelect);
    
    $nfilas = mysqli_num_rows($querySelect);

    for($i = 0; $i < $nfilas; $i++)
    {
        $resultado = mysqli_fetch_array($querySelect);
        if(isset($_POST['baja'.$resultado['ID_estudiante']]))
        {
            $id_Est = $resultado['ID_estudiante'];

            //Borrar estudiante
            $sqlDel = "DELETE FROM estudiante WHERE ID_estudiante = $id_Est";
            $queryDel = mysqli_query($conn, $sqlDel);
            mysqli_close($conn);
            header("Location: menuAdmin.php");
        }
    }
?>
<!DOCTYPE html>
<head>
    <title>DAR DE BAJA ESTUDIANTE</title>
</head>    

<body>
<h1>Dar de baja a estudiantes</h1>
    <h4>Pulse "Dar de baja" en el estudiante deseado</h4>

    <?php
        //Conexion con la BD
        $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

        //Recoger a todos los estudiantes
        $sqlSelectHTML = "SELECT ID_estudiante, nombre, email FROM estudiante";
        $querySelectHTML = mysqli_query($conn, $sqlSelect);
        
        $nfilas = mysqli_num_rows($querySelectHTML);
        echo '<form action = "" method = "post"';
        for($i = 0; $i < $nfilas; $i++)
        {
            $resultadoHTML = mysqli_fetch_array($querySelectHTML);
            echo '<br>';
            echo '<h5>Estudiante '.$resultadoHTML['ID_estudiante']; echo '</h5>';
            echo '<ul>';
                echo '<li>';
                    echo 'Nombre: '.$resultadoHTML['nombre'];
                echo '</li>';
                echo '<li>';
                    echo 'E-Mail: '.$resultadoHTML['email'];
                echo '</li>';
            echo '</ul>';
            echo '<input type = "submit" name = "baja'.$resultadoHTML['ID_estudiante'];
            echo '" value = "Dar de baja"';
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }
        echo '</form>';
    ?>    
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a> 
</body>
</html>