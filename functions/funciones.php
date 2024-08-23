<?php

    function guardarTarea($tarea, $duracion, $dias, $con) {
        $dias = json_encode($dias);

        # Verifica si el dia de la tarea coincide con el ultimo dia agregado en el calendario

        // Busca el ultimo id agregado de el calendario
        $consultaUDCalendario = "SELECT MAX(`id`) AS `last_id` FROM `days`";
        $consultaUDCalendario = $con->query($consultaUDCalendario);
        foreach ($consultaUDCalendario as $last_id) {
            $last_id = $last_id['last_id'];
        }
        $consultaUDCalendario = "SELECT `id`, `dayCalendar` FROM `days` WHERE `id` = $last_id";
        $consultaUDCalendario = $con->query($consultaUDCalendario);
        foreach ($consultaUDCalendario as $last_day) {
            $id_last_day = $last_day['id'];
            $last_day = $last_day['dayCalendar'];
        }
        $dia = obtenerDia($last_day);

        // Insertar tarea
        $consulta = "INSERT INTO tasks(`task`, `duration`, `day`) VALUES ('$tarea', '$duracion', '$dias')";
        $ejecutarConsulta = $con->query($consulta);

        // Busca el ultimo id de la tarea agregada recientemente
        $consultaUTareaAgregado = "SELECT MAX(`id`) AS `last_id` FROM `tasks`";
        $consultaUTareaAgregado = $con->query($consultaUTareaAgregado);
        foreach ($consultaUTareaAgregado as $last_id) {
            $last_id = $last_id['last_id'];
        }
        
        // Agregar la ultima tarea agregada con su respectivo dia en el calendario
        if ((strpos($dias, $dia['dia'])) !== false) {
            $insertarTareaConDia = "INSERT INTO task_calendar(`id_day`, `id_task`, `state`) VALUES ($id_last_day, $last_id, 0)";
            $con->query($insertarTareaConDia);
        }

        if (!$ejecutarConsulta) {
            $datos = [
                "title" => 'Ocurrió un error inesperado!',
                "text" => 'Ha ocurrido un error inesperado, por favor intente mas tarde!',
                "icon" => 'error'
            ];
        }else{
            $datos = [
                "title" => 'Tarea Agregada!',
                "text" => 'Se ha agregado la tarea exitosamente!',
                "icon" => 'success',
                "url" => URL.'?view=tasks'
            ];
        }

        return $datos;
    }

    function obtenerDia($day){
        $timestamp = strtotime($day);
        $diaSemana = date('l', $timestamp);
        $mes = date('F', $timestamp);

        switch ($mes) {
            case 'January':
                $mes = 'Enero';
                break;
            case 'February':
                $mes = 'Febrero';
                break;
            case 'March':
                $mes = 'Marzo';
                break;
            case 'April':
                $mes = 'Abril';
                break;
            case 'May':
            $mes = 'Mayo';
                break;
            case 'June':
                $mes = 'Junio';
                break;
            case 'July':
                $mes = 'Julio';
                break;
            case 'August':
                $mes = 'Agosto';
                break;
            case 'September':
                $mes = 'Septiembre';
                break;
            case 'October':
                $mes = 'Octubre';
                break;
            case 'November':
                $mes = 'Noviembre';
                break;
            case 'December':
                $mes = 'Diciembre';
                break;
            default:
                $mes = "No es un mes";
                break;
        }

        switch ($diaSemana) {
            case 'Monday':
                $diaSemana = 'Lunes';
                break;
            case 'Tuesday':
                $diaSemana = 'Martes';
                break;
            case 'Wednesday':
                $diaSemana = 'Miercoles';
                break;
            case 'Thursday':
                $diaSemana = 'Jueves';
                break;
            case 'Friday':
                $diaSemana = 'Viernes';
                break;
            case 'Saturday':
                $diaSemana = 'Sabado';
                break;
            case 'Sunday':
                $diaSemana = 'Domingo';
                break;
            default:
                $diaSemana = 'No es un dia de la semana';
                break;
        }

        $datosN = explode('-', $day);

        $tiempo = [
            "mes" => $mes,
            "dia" => $diaSemana,
            "anio" => $datosN[0],
            "mesN" => $datosN[1],
            "diaN" => $datosN[2]
        ];

        return $tiempo;

    }

    function actualizarEstadoTarea($id_checkbox, $con){
        $consultaEstado = "SELECT `state` FROM task_calendar WHERE id = $id_checkbox";
        $ejecutarConsulta = $con->query($consultaEstado);
        foreach ($ejecutarConsulta as $estado) {
            $estado = $estado['state'];
        }

        if ($estado == 1) {
            $estado = 0;
        }else{
            $estado = 1;
        }

        $consulta = "UPDATE task_calendar SET `state` = $estado WHERE `id` = $id_checkbox";
        $ejecutarConsulta = $con->query($consulta);
        if (!$ejecutarConsulta) {
            $datos = [
                "title" => 'Ocurrió un error inesperado!',
                "text" => 'Ha ocurrido un error inesperado, por favor intente mas tarde!',
                "icon" => 'error'
            ];
        }else{
            $datos = [
                "title" => 'Dia Agregado!',
                "text" => 'Se ha agregado el dia exitosamente!',
                "icon" => 'success'
            ];
        }

        return $datos;

    }

    function guardarDia($fecha , $con){
        // Verifica si ya existe el dia agregado en la db
        $consulta = "SELECT * FROM `days` WHERE dayCalendar = '$fecha'";
        $ejecutarConsulta = $con->query($consulta);
        if ($ejecutarConsulta->num_rows > 0) {
            $datos = [
                "title" => 'No se agrego el dia disculpame!',
                "text" => 'No se ha agregado el dia exitosamente!',
                "icon" => 'error'
            ];
        }

        $consulta = "INSERT INTO `days`(`dayCalendar`) VALUES ('$fecha')";
        $ejecutarConsulta = $con->query($consulta);

        // Busca el ultimo id del dia agregado recientemente
        $consultaUDiaAgregado = "SELECT MAX(`id`) AS `last_id` FROM `days`";
        $consultaUDiaAgregado = $con->query($consultaUDiaAgregado);
        foreach ($consultaUDiaAgregado as $last_id) {
            $last_id = $last_id['last_id'];
        }

        $consulta = "SELECT * FROM tasks";
        $ejecutarConsulta = $con->query($consulta);
        $obtenerDia = obtenerDia($fecha);
        foreach ($ejecutarConsulta as $datos) {
            $diaDeHoy = $obtenerDia['dia'];
            if ((strpos($datos['day'], $diaDeHoy)) ==  !false) {
                $dias = $datos['id'];
                $consulta = "INSERT INTO `task_calendar`(`id_day`, `id_task`, `state`) VALUES ($last_id, $dias, 0)";
                $con->query($consulta);
            }
        }
        
        if (!$ejecutarConsulta) {
            $datos = [
                "title" => 'Ocurrió un error inesperado!',
                "text" => 'Ha ocurrido un error inesperado, por favor intente mas tarde!',
                "icon" => 'error'
            ];
        }else{
            $datos = [
                "title" => 'Dia Agregado!',
                "text" => 'Se ha agregado el dia exitosamente!',
                "icon" => 'success'
            ];
        }

        return $datos;

    }

?>