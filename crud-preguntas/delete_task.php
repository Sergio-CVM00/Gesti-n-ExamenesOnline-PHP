<?php
    include("db.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM preguntas WHERE ID_pregunta = $id ";
        $resultado = mysqli_query($conn, $query);
        if (!$resultado){
            die("Query failed");
        }
        $_SESSION['message'] = 'Pregunta eliminada correctamente';
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
    }
    else{
        echo 'ID_pregunta no reconocido';
    }
?>