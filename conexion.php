<?php

    function getConnect()
    {
        $mysqli = new mysqli("localhost", "root", "", "registro");

        if(mysqli_connect_errno())
        {
            echo "Conexión fallida: ", mysqli_connect_error();
            exit();
        }
        else
        {
            $mysqli->set_charset("utf8");

            return $mysqli;
        }

    }
?>