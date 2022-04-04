<?php include("db.php")?>
<?php include("includes/header.php")?>
    <main class="container p-4">

        <!-- MESSAGES -->
        <?php 
            //session_start();
            $id_Asignatura=$_SESSION['ID_asignatura'];
            if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?> 

        <div class="container p-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <form action="save_task.php" method="POST"> 

                                <div class="form-group">
                                    <label for = "tema">Tema:</label>
                                    <br>
                                    <select id = "tema" name = "tema">
                                        <?php
                                        //$consulta_temas= "SELECT ID_tema from tema WHERE ID_asignatura=$id_Asignatura";
                                        $consulta_temas= "SELECT ID_tema, nombre from tema WHERE ID_asignatura=$id_Asignatura";
                                        $temaHeader = mysqli_query($conn,$consulta_temas);
                                            while($tema_Asignatura = mysqli_fetch_row($temaHeader))
                                            {
                                                echo "<option value = $tema_Asignatura[0]>";
                                                echo $tema_Asignatura[0]." - ".$tema_Asignatura[1];
                                                echo '</option>';
                                            }
                                        ?>
                                    </select>
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
                                
                                //$query = "SELECT * FROM preguntas";
                                $query = "SELECT preguntas.ID_tema AS 'ID_tema', 
                                        preguntas.ID_pregunta AS 'ID_pregunta', 
                                        preguntas.pregunta as 'pregunta', 
                                        preguntas.solucion as 'solucion', 
                                        preguntas.fecha_creacion as 'fecha_creacion'

                                        FROM preguntas, tema
                                        WHERE preguntas.ID_tema = tema.ID_tema AND tema.ID_asignatura = '$id_Asignatura'";

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