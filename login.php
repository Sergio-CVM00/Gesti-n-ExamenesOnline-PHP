<h1>Iniciar sesión</h1>
<?php
//Formulario
echo '<form action = "/login.php" method = "post">';
    echo '<label for = "DNI">DNI</label>';
    echo '<br>';
    echo '<input type = "text" name = "DNI">';
    echo '<br>';
    echo '<br>';
    echo '<label for = "pass">Contraseña</label>';
    echo '<br>';
    echo '<input type = "password" name = "pass">';
    echo '<br>';
    echo '<br>';
    echo '<input type = "submit" value = "Iniciar sesión">';
echo '</form>';

//Obtener los datos del formulario
$dni = _POST['DNI'];
$pass = _POST['pass'];

//Datos y conexion a BBDD
$nombreServidor = "localhost";
$nombreUsuario = "root";
$passBBDD = "";
$nombreBBDD = //#//;

$conn = mysqli_connect($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

//Consulta SQL.
$sql = sprintf("SELECT * FROM usuarios WHERE DNI='%s' AND pass = %s", $dni, $pass);
$consulta = mysqli_query ($conn, $sql);

if($consulta)
{
    //Usuario correcto->Inicio de sesion correcto
}
else
{
    //Usuario no existe->Inicio de sesion fallido
}
?>
