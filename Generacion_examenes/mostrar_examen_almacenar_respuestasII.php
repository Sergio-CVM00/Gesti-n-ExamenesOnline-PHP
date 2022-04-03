 <?php
session_start();

//$tema=$_SESSION['ID_tema_examen'];
//$num_preg=$_SESSION['num_preg_examen'];

///////////////////Función para generar preguntas aleatorias////////////////////
function generar_preguntas($tema,$num_preg){
    //Almacenamos en un vector preguntas aleatorias de la asignatura $asignatura y del tema $tema
    //El numero de preguntas almacenadas es indicado por la variable $num_preg
    
    $conexion=mysqli_connect("localhost","root","",'bdp1');
    if($conexion){
            //Consulta para obtener los datos de las preguntas
            $consulta="SELECT ID_pregunta, pregunta, solucion from preguntas WHERE ID_tema=$tema";
            $resultado=mysqli_query($conexion,$consulta);
    }
    else{
        echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
    }
    //Variables para controlar los bucles
    $cont=0;
    $cont2=0;

    $vector_todas_preguntas=array();    //Almacena todas las preguntas almacenadas en la BD
    $vector_preguntas=array();  //Almacena el nº de preguntas solicitadas por el profesor
    $indices=array();   //Vector que almacena índices aleatorios de las preguntas
    
    //Introducimos en un vector todas las preguntas almacenadas en la base de datos
    while($row=mysqli_fetch_row($resultado)){
        array_push($vector_todas_preguntas,array(
            'id' => $row[0],
            'pregunta' => $row[1],
            'respuestas' => array('Verdadero','Falso'),
            'correcta' => $row[2]
        ));
    }

    //Comprobar que no haya preguntas repetidas en el vector que se devuelve, comprobamos que el índice aleatorio no esté en el vector indices
    while($cont2 < $num_preg){
        $indiceAleatorio=array_rand($vector_todas_preguntas);
        $encontrado=false;

        foreach($indices as $key=>$value){
            if($value==$indiceAleatorio){
                $encontrado=true;
                break;
            }
        }

        if($encontrado==false){
            array_push($indices,$indiceAleatorio);
            $cont2++;
        }
    }
    
    //Introducimos en otro vector preguntas aleatorias que van a ser mostradas a los alumnos
    //La cantidad de preguntas almacenadas dependerá del número elegido por el profesor
    while($cont < $num_preg){


        array_push($vector_preguntas, $vector_todas_preguntas[$indices[$cont]]);
        $cont++;
        
    }

return $vector_preguntas;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
    $id_Asignatura=$_SESSION['ID_asignatura'];
    $id_estudiante=$_SESSION['ID_estudiante'];

    
    if(isset($_POST['ID_tema'])){
        $_SESSION['ID_tema']=$_POST['ID_tema'];
    }

    $tema=$_SESSION['ID_tema'];

    //Nº de preguntas que tiene el examen
    //$num_preg=$_POST['numero_preguntas'];
    $conexion=mysqli_connect("localhost","root","","bdp1");
    if($conexion){
            //Consulta para obtener los datos de las preguntas
            $consulta="SELECT Num_preguntas,ID_examen from examen WHERE ID_tema=$tema";
            $resultado=mysqli_query($conexion,$consulta);
    }
    else{
        echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
    }
    $row=mysqli_fetch_row($resultado);
    $num_preg=$row[0];
    $id_examen=$row[1];

    $conexion=mysqli_connect("localhost","root","","bdp1");
    if($conexion){
            //Consulta para obtener los datos de las preguntas
            $consulta="SELECT nombre from tema WHERE ID_tema=$tema";
            $resultado=mysqli_query($conexion,$consulta);
    }
    else{
        echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
    }
   
    $row=mysqli_fetch_row($resultado);
    $i=$_SESSION['contador_preguntas'];

    if(isset($_POST['respuesta_alumno'])){
        array_push($_SESSION['respuesta_alumno'], $_POST['respuesta_alumno']);
    }
    if(isset($_POST['pregunta'])){
        array_push($_SESSION['enunciado_pregunta'], $_POST['pregunta']);
    }
    if(isset($_POST['respuesta_correcta'])){
       array_push($_SESSION['respuesta_correcta'], $_POST['respuesta_correcta']);
    }

    if(isset($_POST['Comenzar']) || isset($_POST['siguiente'])){
        echo "<html>";
        echo "<head>";
        echo "<title>Examen Tema-";
            echo $row[0];
            echo "nombre_tema";
        echo "</title>";
        echo "</head>";
        echo "<body>";
            echo "<form action=mostrar_examen_almacenar_respuestasII.php method=POST>";
            echo "<h2>Examen $row[0]</h2>";
               
                echo "<p>";
                echo htmlentities($_SESSION['array_preguntas'][$i]["pregunta"]);
                echo "</p>";

                echo "<p>";
                    echo "<input name=respuesta_alumno value=Verdadero type=radio />";
                    echo "Verdadero";
                    echo "<br>";
                    echo "<input name=respuesta_alumno value=Falso type=radio />";
                    echo "Falso";
                    echo "<input type=hidden name=pregunta value=".$_SESSION['array_preguntas'][$i]['id']." />";
                    echo "<input type=hidden name=respuesta_correcta value=".$_SESSION['array_preguntas'][$i]["correcta"]." />";
                    $_SESSION['contador_preguntas']++;
                echo "</p>";
    
                if($i!=$num_preg-1){
                    echo "<input type=submit name=siguiente value=siguiente />";
                }   
                if($i==$num_preg-1){
                    echo "<input type=submit name=terminar value=terminar />";
                }

            echo "</form>";
        echo "</body>";
        echo "</html>";
    }

    else if(isset($_POST["terminar"])){
        echo "<html>";
            echo "<head>";
                echo "<title>Resultado Examen Tema-";
                echo $row[0];
                echo "</title>";
             echo "</head>";
             echo "<body>";
                echo "<h2>Resultado Examen Tema $row[0] </h2>";

                $correctas=0;
                echo "Respuestas erroneas     ";
                echo "     Respuesta correcta";
                echo "<br>";
                $i=0;

                $conexion=mysqli_connect("localhost","root","","bdp1");
                

                while($i<$num_preg){
                    if($_SESSION['respuesta_alumno'][$i]==$_SESSION['respuesta_correcta'][$i]){
                        $correctas++;
                        if($conexion){
                            $id_pregunta=$_SESSION['enunciado_pregunta'][$i];
                            $respuesta_alumno=$_SESSION['respuesta_alumno'][$i];
                            $consulta3="INSERT INTO estudiante_pregunta (ID_estudiante, ID_pregunta, respuesta_alumno, correcta) VALUES ('$id_estudiante','$id_pregunta','$respuesta_alumno','1')";    
                        }
                        
                        $resultado3=mysqli_query($conexion,$consulta3);
                    }
                    else{

                        if($conexion){
                            //Consulta para obtener los datos de las preguntas
                            $consulta2="SELECT pregunta FROM preguntas WHERE ID_pregunta=".$_SESSION['enunciado_pregunta'][$i];
                            $resultado2=mysqli_query($conexion,$consulta2);                 
                        }
                        else{
                            echo "<h2>Error de conexi&oacute;n con la Base de datos</h2>";
                        }
            
                        $fila=mysqli_fetch_row($resultado2);
                        echo $fila[0];
                        echo "=>";
                        echo $_SESSION['respuesta_correcta'][$i];
                        echo "<br>";

                        if($conexion){
                            $id_pregunta=$_SESSION['enunciado_pregunta'][$i];
                            $respuesta_alumno=$_SESSION['respuesta_alumno'][$i];
                            $consulta4="INSERT INTO estudiante_pregunta (ID_estudiante, ID_pregunta, respuesta_alumno, correcta) VALUES ('$id_estudiante','$id_pregunta','$respuesta_alumno','0')";    
                        }

                        $resultado4=mysqli_query($conexion,$consulta4);
                    }
                    $i++;
                }

                $nota=$correctas*10/$num_preg;
                if($conexion){
                     $consulta5="INSERT INTO estudiante_examen (ID_estudiante, ID_examen, Nota) VALUES ('$id_estudiante','$id_examen','$nota')";
                }

                $resultado5=mysqli_query($conexion,$consulta5);

                echo "<br>";
                echo "Respuestas correctas: ";
                echo $correctas."/".$num_preg;
                echo "  Nota: ";
                echo $nota;
                echo "<br>";
                echo '<a href="../Login/indexEst.php">Volver al menu</a>';
            echo "</body>";
        echo "</html>";
    }

    else{
        echo "<html>";
            echo "<head>";
                echo "<title>Examen Tema-";
                echo $row[0];
                echo "</title>";
             echo "</head>";
             echo "<body>";
                echo "<h2>Examen Tema $row[0] </h2>";
                echo "<form action=mostrar_examen_almacenar_respuestasII.php method=POST>";  
                    $_SESSION['respuesta_alumno']=array();
                    $_SESSION['enunciado_pregunta']=array();
                    $_SESSION['respuesta_correcta']=array();

                    $_SESSION['array_preguntas']=generar_preguntas($tema,$num_preg);
                    $_SESSION['contador_preguntas']=0;             
                    echo "<input type=submit name=Comenzar value=Comenzar />";
                echo "</form>";
            echo "</body>";
        echo "</html>";
    }      
?>