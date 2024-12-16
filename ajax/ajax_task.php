<?php

require "../controller/Task.php";

if ($_POST["accion"]) {
    if ($_POST["accion"] == "guardarTarea") {
        
        $task = new Task;

        if (isset($_POST['dia']) || $_POST['dia'] == "") {
            $dia = $_POST['dia'];
        }else{
            $dia = json_encode($_POST['option']);
        }

        echo $task->guardarNota($_POST['tarea'], $_POST['tiempo'], $dia);
        
    }else{
        echo [
            "title" => 'Ocurrió un error inesperado!',
            "text" => 'Ha ocurrido un error inesperado, por favor intente mas tarde!',
            "icon" => 'error'
        ];
    }
}

?>