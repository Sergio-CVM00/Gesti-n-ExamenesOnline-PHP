<?php
    include("conexion.php");
    $con=conectar();
    $sql="SELECT * FROM preguntas";
    $query=mysqli_query($con,$sql);
                     
    $row=msqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PREGUNTAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
            <div class="container mt-5">
                    <div class="row"> 
                        
                        <div class="col-md-3">
                            <h1>Ingrese datos</h1>
                                <form action="insertar.php" method="POST">

                                    <input type="text" class="form-control mb-3" name="ID_pregunta" placeholder="ID_pregunta">
                                    <input type="text" class="form-control mb-3" name="ID_tema" placeholder="ID_tema">
                                    <input type="text" class="form-control mb-3" name="pregunta" placeholder="pregunta">
                                    <input type="text" class="form-control mb-3" name="solucion" placeholder="solucion">
                                    
                                    <input type="submit" class="btn btn-primary">
                                </form>
                        </div>

                        <div class="col-md-8">
                            <table class="table" >
                                <thead class="table-success table-striped" >
                                    <tr>
                                        <th>Pregunta</th>
                                        <th>Tema</th>
                                        <th>descripcion</th>
                                        <th>solucion</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query)){
                                        ?>
                                            <tr>
                                                <th><?php  echo $row['ID_pregunta']?></th>
                                                <th><?php  echo $row['ID_tema']?></th>
                                                <th><?php  echo $row['pregunta']?></th>
                                                <th><?php  echo $row['solucion']?></th>    
                                                <th><a href="actualizar.php?id=<?php echo $row['ID_pregunta'] ?>" class="btn btn-info">Editar</a></th>
                                                <th><a href="delete.php?id=<?php echo $row['ID_pregunta'] ?>" class="btn btn-danger">Eliminar</a></th>                                        
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
            </div>
    </body>
</html>