<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'gestion-examenes'
    );

    if(isset($conn)){
        echo 'DB is connected';
    }
?>