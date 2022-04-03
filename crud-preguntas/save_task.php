<?php
    include("db.php");

    if (isset($_POST['save_task'])){
        
        //$indice = $_POST['indice'];
        $tema = $_POST['tema'];
        $pregunta = $_POST['pregunta'];
        $solucion = $_POST['solucion'];

        $query = "INSERT INTO `preguntas` (`ID_pregunta`, `ID_tema`, `pregunta`, `solucion`, `fecha_creacion`) VALUES ('', '$tema', '$pregunta', '$solucion', current_timestamp())";

        $result = mysqli_query($conn, $query) or die("query failed");

        $_SESSION['message'] = 'Pregunta guardada correctamente';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
    }

?>