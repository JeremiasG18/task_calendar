<?php

    const URL = 'http://localhost/task_calendar/';

    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'task_calendar';

    $con = new mysqli($server,$user,$password,$db_name);

    if ($con->errno) {
        echo "existe un error en el codigo de conexion";
    }

?>