<!------------------->
<!--------PHP--------> 
<!------------------->
<?php
    //Conexion con la BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

    //Recoger a todos los estudiantes
    $sqlSelect = "SELECT ID_asignatura, nombre FROM asignatura";
    $querySelect = mysqli_query($conn, $sqlSelect);
    
    $nfilas = mysqli_num_rows($querySelect);

    for($i = 0; $i < $nfilas; $i++)
    {
        $resultado = mysqli_fetch_array($querySelect);
        if(isset($_POST['baja'.$resultado['ID_asignatura']]))
        {
            $id_Asig = $resultado['ID_asignatura'];

            //Borrar estudiante
            $sqlDel = "DELETE FROM asignatura WHERE ID_asignatura = $id_Asig";
            $queryDel = mysqli_query($conn, $sqlDel);
            mysqli_close($conn);
            header("Location: confirmBaja.php");
        }
    }
?>
<!DOCTYPE html>
<head>
    <title>ELIMINAR ASIGNATURA</title>
</head>    

<body>
<h1>Eliminar una asignatura</h1>
    <h4>Pulse "Eliminar" en la asignatura deseada</h4>

    <?php
        //Conexion con la BD
        $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

        //Recoger a todos los estudiantes
        $sqlSelectHTML = "SELECT ID_asignatura, nombre FROM asignatura";
        $querySelectHTML = mysqli_query($conn, $sqlSelect);
        
        $nfilas = mysqli_num_rows($querySelectHTML);
        echo '<form action = "" method = "post"';
        for($i = 0; $i < $nfilas; $i++)
        {
            $resultadoHTML = mysqli_fetch_array($querySelectHTML);
            echo '<br>';
            echo '<h5>Asignatura '.$resultadoHTML['ID_asignatura']; echo '</h5>';
            echo '<ul>';
                echo '<li>';
                    echo 'Nombre: '.$resultadoHTML['nombre'];
                echo '</li>';
            echo '</ul>';
            echo '<input type = "submit" name = "baja'.$resultadoHTML['ID_asignatura'];
            echo '" value = "Eliminar"';
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }
        echo '</form>';
    ?>    
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a> 
</body>
</html>