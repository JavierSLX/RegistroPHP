<?php
    require('conexion.php');

    $db = getConnect();
    $query = "SELECT u.id, CONCAT(u.nombre, ' ', u.apellido_paterno, ' ', u.apellido_materno) AS nombre, u.telefono, u.correo, a.fecha, a.mensaje
    FROM usuario AS u
    INNER JOIN anotacion AS a ON u.id = a.usuario_id";

    $resultado = $db->query($query);
    $arreglo = $resultado->fetch_all();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Citas Registradas</title>
    </head>
    <body style="text-align: center;" background="img/claro.jpg">
        <h2>Tabla de Citas Registradas</h2>
        </br></br>
        <table border=1 style="margin: 0 auto;">
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Nombre</strong></td>
                <td><strong>Telefono</strong></td>
                <td><strong>Correo</strong></td>
                <td><strong>Fecha</strong></td>
                <td><strong>Observaciones</strong></td>
            </tr>
            <?php
                for($i = 0; $i < count($arreglo); $i++)
                {
                    echo "<tr>";
                    $id = $arreglo[$i][0];
                    for($j = 0; $j < count($arreglo[$i]); $j++)
                        echo "<td>".$arreglo[$i][$j]."</td>";
                }
            ?>
        </table>

        </br>
        <form id="cambio" name="cambio" action="modificarRegistro.php" method="POST">
            <input type="submit" value="Modificar" name="modificar"/>
        </form>
    </body>
</html>