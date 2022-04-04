<!------------------->
<!--------PHP--------> 
<!------------------->
<?php
    //Conexion con la BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

    //Recoger a todos los estudiantes
    $sqlSelect = "SELECT ID_profesor, PROFESOR_NOMBRE, email FROM profesor";
    $querySelect = mysqli_query($conn, $sqlSelect);
    
    $nfilas = mysqli_num_rows($querySelect);

    for($i = 0; $i < $nfilas; $i++)
    {
        $resultado = mysqli_fetch_array($querySelect);
        if(isset($_POST['baja'.$resultado['ID_profesor']]))
        {
            $id_Pro = $resultado['ID_profesor'];

            //Borrar estudiante
            $sqlDel = "DELETE FROM profesor WHERE ID_profesor = $id_Pro";
            $queryDel = mysqli_query($conn, $sqlDel);
            mysqli_close($conn);
            header("Location: confirmBaja.php");
        }
    }
?>
<!DOCTYPE html>
<head>
    <title>DAR DE BAJA PROFESOR</title>
</head>    

<body>
<h1>Dar de baja a profesores</h1>
    <h4>Pulse "Dar de baja" en el profesor deseado</h4>

    <?php
        //Conexion con la BD
        $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

        //Recoger a todos los estudiantes
        $sqlSelectHTML = "SELECT ID_estudiante, PROFESOR_NOMBRE, email FROM profesor";
        $querySelectHTML = mysqli_query($conn, $sqlSelect);
        
        $nfilas = mysqli_num_rows($querySelectHTML);
        echo '<form action = "" method = "post"';
        for($i = 0; $i < $nfilas; $i++)
        {
            $resultadoHTML = mysqli_fetch_array($querySelectHTML);
            echo '<br>';
            echo '<h5>Profesor '.$resultadoHTML['ID_profesor']; echo '</h5>';
            echo '<ul>';
                echo '<li>';
                    echo 'Nombre: '.$resultadoHTML['PROFESOR_NOMBRE'];
                echo '</li>';
                echo '<li>';
                    echo 'E-Mail: '.$resultadoHTML['email'];
                echo '</li>';
            echo '</ul>';
            echo '<input type = "submit" name = "baja'.$resultadoHTML['ID_profesor'];
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