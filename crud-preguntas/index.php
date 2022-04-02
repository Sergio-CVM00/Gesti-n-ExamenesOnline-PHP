<?php include("db.php")?>
<?php include("includes/header.php")?>
<main class="container p-4">

    <!-- MESSAGES -->
    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php session_unset(); } ?> <!-- limpiar los datos una vez refresco -->

   <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-body">
                    <form action="save_task.php" method="POST"> 

                        <div class="form-group">
                            <input type="text" name="tema" class="form-control"
                            placeholder= "Nº Tema" autofocus>
                        </div>

                        <div class="form-group">
                            <input type="text" name="indice" class="form-control"
                            placeholder= "Nº pregunta" autofocus>
                        </div>

                        

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"></label>
                            <textarea name="pregunta" placeholder= "Enunciado..." class="form-control" id="pregunta" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Solución:</label>
                            <select name="solucion" class="form-control">
                                <option>Verdadero</option>
                                <option>Falso</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-success btn-block"
                        name="save_task" value="Añadir pregunta">
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Pregunta</th>
                        <th>Enunciado</th>
                        <th>Solucion</th>
                        <th>Fecha</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `preguntas`";
                        $result_preguntas = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($result_preguntas)) { ?>
                            <tr>
                              <td><?php echo $row['ID_tema']; ?></td>
                              <td><?php echo $row['ID_pregunta']; ?></td>
                              <td><?php echo $row['pregunta']; ?></td>
                              <td><?php echo $row['solucion']; ?></td>
                              <td><?php echo $row['fecha_creacion']; ?></td>
                              <td>
                                <a href="edit.php?id=<?php echo $row['ID_pregunta']?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="delete_task.php?id=<?php echo $row['ID_pregunta']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                              </td>
                            </tr>
                            <?php } ?>
                        
                    </tbody>
                </table>
            </div> 

        </div>
   </div>
</main>
<?php include ("includes/footer.php")?>