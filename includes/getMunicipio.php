<?php
    require('../conexion.php');

    $id = $_POST['id_estado'];
    $queryM = "SELECT id, nombre FROM municipio WHERE estado_id = $id";
    $resultadoM = getConnect()->query($queryM);

    $html = "<option value='0'>Seleccionar Municipio</option>";
    while($rowM = $resultadoM->fetch_assoc())
    {
        $html .= "<option value='".$rowM['id']."'>".$rowM['nombre']."</option>";
    }

    echo $html;
?>