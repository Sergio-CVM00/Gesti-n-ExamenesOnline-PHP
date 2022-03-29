<h1>Iniciar sesión</h1>
<?php
////////
//HTML//
////////
echo '<form action = "login.php" method = "post">';
    echo '<label for = "nombre">Nombre</label>';
    echo '<br>';
    echo '<input type = "text" name = "nombre">';
    echo '<br>';
    echo '<br>';
    echo '<label for = "pass">Contraseña</label>';
    echo '<br>';
    echo '<input type = "password" name = "pass">';
    echo '<br>';
    echo '<br>';
    echo '<input type = "submit" name = "login" value = "Iniciar sesión">';
echo '</form>';

///////
//PHP//
///////
//Obtener los datos del formulario
$nombre = $_POST['nombre'];
$pass = $_POST['pass'];

//Datos y conexion a BBDD
$nombreServidor = "localhost";
$nombreUsuario = "root";
$passBBDD = "";
$nombreBBDD = "bdp1";

$conn = mysqli_connect($nombreServidor, $nombreUsuario, $passBBDD, $nombreBBDD);

//Consulta SQL.
$sqlAlumno = sprintf("SELECT * FROM estudiante WHERE nombre = '%s' AND pass = '%s'", $nombre, $pass);
$consultaAlumno = mysqli_query($conn, $sqlAlumno);
//$sqlProfesor = sprintf("SELECT * FROM profesor WHERE PROFESOR_NOMBRE='%s' AND pass = %s", $nombre, $pass);

//$consultaProfesor = mysqli_query ($conn, $sqlProfesor);
$filaAlumno = mysqli_fetch_row($consultaAlumno);
mysqli_free_result($consultaAlumno);
if(($filaAlumno[0] == $nombre && $filaAlumno[1] == $pass))
{
    echo("chachi");
    mysqli_close($conn);
}
else
{
    echo("nada chachi");
    mysqli_close($conn);
}

?>


