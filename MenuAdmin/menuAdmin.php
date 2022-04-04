<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Admin</title>
</head>
<body>
	<h1>Menu del Administrador</h1>
    <h4>Opciones de Administrador</h4>
    <dl>
        <dt>Estudiantes</dt>
        <dd>
        <a href = "altaEst.php">- Dar de alta a un estudiante</a>
        </dd>
        <dd>
        <a href = "bajaEst.php">- Dar de baja a un estudiante</a>
        </dd>
        <br>

        <dt>Profesores</dt>
        <dd>
        <a href = "altaPro.php">- Dar de alta a un profesor</a>
        </dd>
        <dd>
        <a href = "bajaPro.php">- Dar de baja a un profesor</a>
        </dd>
        <br>

        <dt>Asignaturas</dt>
        <dd>
        <a href = "altaAsig.php">- Añadir asignatura</a>
        </dd>
        <dd>
        <a href = "bajaAsig.php">- Eliminar asignatura</a>  
        </dd>
        <br>
    </dl>
    <a href = "../Login/login.php"><input type = "button" value = "Cerrar sesion"></a>
</body>
</html>