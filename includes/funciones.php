<?php
    function alerta($mensaje, $archivo)
    {
        echo '<script type="text/javascript">
        alert("'.$mensaje.'");
        window.location.href="'.$archivo.'";</script>';
    }
?>