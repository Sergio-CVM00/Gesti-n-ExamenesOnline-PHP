<!DOCTYPE html>
<head>
    <title>REGISTRAR PROFESOR</title>
<head>

<body>
    <h1>Registro de profesor</h1>
    <form action = "" method = "post">
        <label for = "nombre">Nombre</label>
        <br>
        <input type = "text" placeholder = "Introduce un nombre" name = "nombre">
        <br>
        <br>

        <label for = "dni">DNI</label>
        <br>
        <input type = "text" placeholder = "Introduce un DNI" name = "dni">
        <br>
        <br>

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

        <input type = "submit" name = "singup" value = "Completar registro">
    </form>
    <br>
    <a href = "menuAdmin.php"><input type = "button" value = "Volver"></a>  
</body>
<!------------------->
<!--------PHP--------> 
<!------------------->
<?php
    //Comprobar el envio del formulario
    if(isset($_POST["singup"]))
    {
        //Comprobar que los campos se han rellenado
        $vacio = false;
        if((trim($_POST["nombre"]) == "") || (trim($_POST["dni"]) == "") || (trim($_POST["email"]) == "" || (trim($_POST["pass"]) == "")))
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
            $nombre = $_POST["nombre"];
            $dni = $_POST["dni"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            //Conexion con la BD
            $conn = mysqli_connect("localhost", "root", "", "bdp1") or die("Error: No se pudo conecta con la BD");

            //Query
            $sql = "INSERT INTO profesor (ID_profesor, PROFESOR_NOMBRE, DNI, email, pass) VALUES ('', '$nombre', '$dni', '$email', '$pass')";
            $sqlComprobar = "SELECT email FROM profesor WHERE email = '$email'";
            $queryComprobar = mysqli_query($conn, $sqlComprobar);

            if(mysqli_num_rows($queryComprobar) >= 1)
            {
                echo '<br>';
                echo 'Error:';
                echo '<br>';
                echo 'Ya existe un profesor con credenciales iguales';
            }
            else
            {
                $query = mysqli_query($conn, $sql) or die ("Error: No se pudo realizar el registro");

                //Cerrar conexion con la BD
                mysqli_close($conn);

                //Confirmacion
                header("Location: confirmRegistro.php");
            }            
        }
    }
?>
</html>