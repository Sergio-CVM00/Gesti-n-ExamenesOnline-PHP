<?php
    include("db.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM preguntas WHERE ID_pregunta = $id ";
        $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $indice = $row['ID_pregunta'];
            $tema = $row['ID_tema'];
            $pregunta = $row['pregunta'];
            $solucion = $row['solucion'];    
    }    


    if (isset($_POST['update'])) {
        //$indice = $_GET['id'];
        //$tema = $_POST['tema'];
        $pregunta = $_POST['pregunta'];
        $solucion = $_POST['solucion'];
      
        $query = "UPDATE preguntas set ID_tema = '$tema', ID_pregunta = '$indice', pregunta = '$pregunta', solucion = '$solucion' WHERE ID_pregunta=$id";
        mysqli_query($conn, $query);
        $_SESSION['message'] = 'Pregunta actualizada';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }
?>


<?php include("includes/header.php");?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">

      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">

            <div class="form-group">
                <p>Pregunta nº:  <?php echo $indice; ?></p>
            </div>

            <div class="form-group">
                <p>Enunciado previo: <?php echo $pregunta;?></p>
                <textarea name="pregunta" class="form-control" cols="30" rows="10"><?php echo $pregunta;?></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Solución previa: <?php echo $solucion;?></label>
                <select name="solucion" class="form-control">
                    <option>Verdadero</option>
                    <option>Falso</option>
                </select>
            </div>

            <button class="btn-success" name="update">
                Actualizar
            </button>

      </form>
      </div>
    </div>
  </div>
</div>
<?php include("includes/footer.php");?>