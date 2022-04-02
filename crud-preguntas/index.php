<?php include("db.php")?>
<?php include("includes/header.php")?>

   <div class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-body">
                    <form action="save_task.php" method="POST"> 

                        <div class="form-group">
                            <input type="text" name="indice" class="form-control"
                            placeholder= "Nº pregunta" autofocus>
                        </div>

                        <div class="form-group">
                            <input type="text" name="tema" class="form-control"
                            placeholder= "Tema al que pertenece" autofocus>
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
                        <th>Nº</th>
                        <th>Tema</th>
                        <th>Pregunta</th>
                        <th>Creado en</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                </table>
            </div>            
        </div>
   </div>

<?php include ("includes/footer.php")?>