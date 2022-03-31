<?php

include("conexion.php");
$con=conectar();

$ID_pregunta=$_GET['id'];

$sql="DELETE FROM preguntas  WHERE ID_pregunta='$ID_pregunta'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: pregunta.php");
    }
?>
