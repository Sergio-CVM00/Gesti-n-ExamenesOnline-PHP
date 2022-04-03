<!DOCTYPE html>
<head>
    <title>DAR DE BAJA PROFESOR</title>
<head>

<body>
    <h1>Dar de baja al profesor</h1>
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
    <a href = "menuAdmin.php">Volver</a> 
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
            $sql = "DELETE FROM profesor WHERE email = '$email' AND pass = '$pass'";
            $query = mysqli_query($conn, $sql) or die ("Error: No se pudo realizar la eliminacion");

            //Cerrar conexion con la BD
            mysqli_close($conn);

            //Confirmacion
            header("Location: confirmBaja.php");
        }
    }
?>
</html>