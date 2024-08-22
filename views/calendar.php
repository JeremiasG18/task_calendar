<section class="content">
    <div class="title"><h1>Calendario de Tareas</h1></div>
    <?php

        include 'functions/funciones.php';
        $consulta = "SELECT d.id, d.dayCalendar, t.task, t.duration, tc.state FROM task_calendar tc INNER JOIN tasks t ON t.id = tc.id_task INNER JOIN days d ON d.id = tc.id_day;";
        $consulta = $con->query($consulta);
        // foreach ($consulta as $kek) {
        //     print_r($kek);
        // }
        $idDias = [];
        foreach ($consulta as $dia) {
            $idDias[] = $dia['id'];
        }

        // var_dump($idDias);
        $diaNoRepetido = [];
        for ($i=0; $i < count($idDias)-1; $i++) { 
            // echo $i+1;
            echo $idDias[$i+1];
            if ($idDias[$i+1] !== $idDias[$i]) {
                $diaNoRepetido[] = $idDias[$i];
            }
            // echo $idDias[$i];
        }
        var_dump($diaNoRepetido);
        // $dias = [];
        foreach ($consulta as $dia) {
            $dia = obtenerDia($dia['dayCalendar']);
            for ($i=0; $i < count($idDias); $i++) { 
                // if ($dia['dia'] !== $dias[$i]) {
                // }
            }
        }

        // var_dump($idDias);
        
        foreach ($datos as $dato) {
    ?>
    <details class="content-day">
        <summary>
            <?= $dato['dia']." ".$dato['diaN']." de ".$dato['mes']." del ".$dato['anio']?>
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
                <tr>
                    <td><?= $dato['tarea'] ?></td>
                    <td><?= $dato['duracion'] ?></td>
                    <td><input type="checkbox" value="<?= $dato['estado'] ?>" class="checkbox" name=""></td>
                </tr>
            </tbody>
        </table>
    </details>
    <?php
        }
    ?>
</section>