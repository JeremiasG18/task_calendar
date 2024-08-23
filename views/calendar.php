<section class="content">
    <div class="title"><h1>Calendario de Tareas</h1></div>
    <?php

        include 'functions/funciones.php';
        $consulta = "SELECT tc.id, d.dayCalendar, t.task, t.duration, tc.state FROM task_calendar tc INNER JOIN tasks t ON t.id = tc.id_task INNER JOIN days d ON d.id = tc.id_day;";
        $consulta = $con->query($consulta);

        $calendario = [];

        // Agrupar las tareas por día
        foreach ($consulta as $datos) {
            $dia = $datos['dayCalendar'];
            if (!isset($calendario[$dia])) {
                $calendario[$dia] = [];
            }
            $calendario[$dia][] = [
                'id_task_calendar' => $datos['id'],
                'task' => $datos['task'],
                'duration' => $datos['duration'],
                'state' => $datos['state']
            ];
        }

        // Mostrar el calendario
        foreach ($calendario as $dia => $tareas) {
            $fechaInfo = obtenerDia($dia);
    ?>
    <details class="content-day">
        <summary>
            <?= $fechaInfo['dia']." ".$fechaInfo['diaN']." de ".$fechaInfo['mes']." del ".$fechaInfo['anio'] ?>
        </summary>
        <table border="1" class="table-task">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Tiempo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea) { ?>
                <tr>
                    <td><?= $tarea['task'] ?></td>
                    <td><?= $tarea['duration'] ?></td>
                    <?php
                        if ($tarea['state'] == 1) {?>
                            <td><input type="checkbox" value="<?= $tarea['id_task_calendar'] ?>" class="checkbox" name="checkbox" checked></td>
                            
                    <?php
                        }else{
                    ?>   
                            <td><input type="checkbox" value="<?= $tarea['id_task_calendar'] ?>" class="checkbox" name="checkbox"></td>                     
                    <?php
                        }
                    ?>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </details>
    <?php
        }
    ?>
</section>