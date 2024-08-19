<?php

    if (isset($_POST['accion'])) {
        if ($_POST['accion'] === 'guardarTarea') {
            if (!isset($_POST['tarea']) || !isset($_POST['tiempo']) || $_POST['tarea'] === '' || $_POST['tiempo'] === '') {
                $datos = [
                    "error" => '¡No se ha insertado los datos importantes!',
                ];
                
            }else {
                $tarea = $_POST['tarea'];
                $tiempo = $_POST['tiempo'];
                $datos = [
                    "error" => '¡Si se ha insertado los datos importantes!',
                    "tarea" => $tarea,
                    "datos" => $tiempo
                ];
            }
            echo json_encode($datos);
        }
    }


?>