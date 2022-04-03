<!DOCTYPE html>
<head>
    <title>DAR DE BAJA ESTUDIANTE</title>
</head>    

<body>
<h1>Dar de baja al estudiante</h1>
    <form action = "" method = "post">
        <label for = "email">E-Mail</label>
        <br>
        <input type = "text" placeholder = "Introduce un email" name = "email">
        <br>
        <br>

        <label for = "pass">Contraseña</label>
        <br>
        <input type = "password" placeholder = "Introduce una contraseña" name = "pass">
        <br>
        <br>

        <input type = "submit" name = "singup" value = "Completar dar de baja">
    </form>
    <br>
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a>
</body>
</html>
<!------------------->
<!--------PHP--------> 
<!------------------->
<?php
    //Conexion con la BD
    $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

    //Recoger a todos los estudiantes
    $sql = "SELECT ID_estudiante, nombre, email FROM estudiante";
    $query = mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    $nfilas = mysqli_num_rows($query);

    if(isset($_POST["baja"]))
    {
        //Conexion con la BD
        $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

        //Borrar estudiante
        $sql = "DELETE FROM estudiante WHERE ";
        $query = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

/*
    //Comprobar el envio del formulario
    if(isset($_POST["singup"]))
    {
        //Comprobar que los campos se han rellenado
        $vacio = false;
        if((trim($_POST["email"]) == "" || (trim($_POST["pass"]) == "")))
        {
            $vacio = true;
        }
        
        if($vacio)  //Mostrar error si algun campo es vacio
        {
            echo '<br>';
            echo "Error:";
            echo '<br>';
            echo "Debes rellenar todos los campos";
        }
        else
        {
            //Insertar el usuario en la BD
            //Recoger valores del formulario
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            //Conexion con la BD
            $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

            //Query
            $sql = "DELETE FROM estudiante WHERE email = '$email' AND pass = '$pass'";
            $query = mysqli_query($conn, $sql) or die ("Error: No se pudo realizar la eliminacion");

            //Cerrar conexion con la BD
            mysqli_close($conn);

            //Confirmacion
            header("Location: confirmBaja.php");
        }
    }

    <h1>Dar de baja a estudiantes</h1>
    <h4>Pulse "Dar de baja" en el estudiante deseado</h4>

    <?php
        echo '<form action = "" method = "post"';
        for($i = 0; $i < $nfilas; $i++)
        {
            $resultado = mysqli_fetch_array($query);
            echo '<br>';
            echo '<h5>Estudiante '.$resultado['ID_estudiante']; echo '</h5>';
            echo '<ul>';
                echo '<li>';
                    echo 'Nombre: '.$resultado['nombre'];
                echo '</li>';
                echo '<li>';
                    echo 'E-Mail: '.$resultado['email'];
                echo '</li>';
            echo '</ul>';
            echo '<input type = "submit" name = "baja" value = "Dar de baja"';
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }
        echo '</form>';
    ?>    
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a> 

    
*/
?>
