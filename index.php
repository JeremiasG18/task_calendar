<?php

    require './config/conexion.php';

    include __DIR__.'/templates/header.php';
    include __DIR__.'/templates/navbar.php';

    if (isset($_GET['view'])) {
        $view = $_GET['view'];
        
        require __DIR__.'/views/'.$view.'.php';
    }else {
        require __DIR__.'/views/calendar.php';
    }

    include __DIR__.'/templates/footer.php';

?>