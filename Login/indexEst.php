<?php
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $_SESSION['ID_asignatura'] = $id;
    }
?>


<h1>Eres estudiante</h1>
<a href = "../Generacion_examenes/formulario_iniciar_examen.php">Empezar examen</a>
<br>
<a href = "../Visualizacion_resultados/ver_resultados_alumnos.php">Visualización de calificaciones</a>
<br>
<a href = "login.php">Cerrar sesion</a>

<?php
?>