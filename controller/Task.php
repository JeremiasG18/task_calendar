<?php

require "../config/conexion.php";
require "../model/Main.php";
use model\Main;

class Task extends Main{

    public function guardarNota(string $tarea, string $duracion, string $dias){

        if ($tarea === "" || $duracion === "" || $dias === "") {
            return [
                "title" => 'Error!',
                "text" => 'No has rellenado los campos que son obligatorios',
                "icon" => 'error'
            ];
        }

        if (preg_match("/^{a-zA-Z}[1,4]$/", $tarea)) {
            return [
                "title" => 'Error!',
                "text" => 'El campo Tarea no cumple con los caracteres requeridos: a-zA-Z 1,4',
                "icon" => 'error'
            ];
        }

        if (preg_match("/^{1-9}[1,4]$/", $duracion)) {
            return [
                "title" => 'Error!',
                "text" => 'El campo Duración no cumple con los caracteres requeridos: 1-9 1,4',
                "icon" => 'error'
            ];
        }

        $datos = [
            [
                "campo_clave" => "task",
                "campo_valor" => $tarea,
                "campo_marcador" => ":task"
            ],
            [
                "campo_clave" => "duration",
                "campo_valor" => $duracion,
                "campo_marcador" => ":duration"
            ],
            [
                "campo_clave" => "day",
                "campo_valor" => $dias,
                "campo_marcador" => ":day"
            ]
        ];

        $respuesta = $this->guardarDatos("tasks", $datos);

        if ($respuesta) {
            return [
                "title" => '¡Tarea Guardada!',
                "text" => 'La tarea se ha guardado exitosamente',
                "icon" => 'success',
                "url" => URL.'?view=tasks'
            ];
        }else{
            return [
                "title" => 'Ocurrió un error inesperado!',
                "text" => 'Ha ocurrido un error inesperado, por favor intente mas tarde!',
                "icon" => 'error'
            ];
        }

    }

}

?>