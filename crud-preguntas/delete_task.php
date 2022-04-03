<?php
    include("db.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        /*
        $consulta6= "SELECT ID_tema from preguntas WHERE ID_pregunta = $id";
        $resultado6=mysqli_query($conn,$consulta6);
        $var=mysqli_fetch_row($resultado6);
        */
        $query = "DELETE FROM preguntas WHERE ID_pregunta = $id";
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