<?php

    include '../config/conexion.php';
    include '../functions/funciones.php';

    if (isset($_POST['accion'])) {
        if ($_POST['accion'] === 'guardarTarea') {
            if (isset($_POST['tarea']) && isset($_POST['tiempo']) && $_POST['tarea'] !== '' && $_POST['tiempo'] !== '' && (isset($_POST['option'])  && $_POST['option'] !== '' || (isset($_POST['dia']) && $_POST['dia'] !== ''))) {
                $tarea = $_POST['tarea'];
                $duracion = $_POST['tiempo'];
                if (isset($_POST['dia']) && $_POST['dia'] !== '') {
                    $dias = $_POST['dia'];
                }else{
                    $dias = $_POST['option'];
                }
                $respuesta = guardarTarea($tarea, $duracion, $dias, $con);
                
            }else {
                $respuesta = [
                    "title" => 'Tarea No Agregada!',
                    "text" => 'No se ha completado los campos que son obligatorios!',
                    "icon" => 'error'
                    
                ];
            }

            echo json_encode($respuesta);

        }elseif ($_POST['accion'] === 'guardarDia') {
            if (isset($_POST['fecha']) && $_POST['fecha'] !== '') {
                $fecha = $_POST['fecha'];
                $respuesta = guardarDia($fecha, $con);
            }

            echo json_encode($respuesta);

        }elseif ($_POST['accion'] === 'guardarTareaRealizada'){
            if (isset($_POST['checkbox']) && $_POST['checkbox'] !== '') {
                $checkbox = $_POST['checkbox'];
                $respuesta = actualizarEstadoTarea($checkbox, $con);
            }else{
                $respuesta = ['datos' => 'hola'];
            }

            echo json_encode($respuesta);
        }
    }

?>