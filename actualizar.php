<?php
    require('conexion.php');
    require_once(dirname(__FILE__)."/includes/funciones.php");

    $usuario_id = $_POST['cbx_usuario'];

    if($usuario_id == 0)
    {
        alerta("Elija un usuario", "modificarRegistro.php");
    }

    $bd = getConnect();
    if(isset($_POST['eliminar']))
    {
        $query = "DELETE FROM anotacion WHERE usuario_id = $usuario_id";
        $bd->query($query);

        $query = "DELETE FROM usuario WHERE id = $usuario_id";
        $bd->query($query);
        alerta("Usuario eliminado", "modificarRegistro.php");
    }
    
    if (isset($_POST['modificar']))
    {
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $direccion = $_POST['direccion'];
        $estado_id = $_POST['cbx_estado'];
        $municipio_id = $_POST['cbx_municipio'];
        $genero = $_POST['genero'];
        $edad = $_POST['edad'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $mensaje = $_POST['mensaje'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];

        //Hace las validaciones
        if(empty($nombre) || empty($apellido_paterno) || empty($apellido_materno))
        alerta("Llene los campos del nombre", "index.php");

        if(empty($direccion))
            alerta("Llene la dirección del usuario", "index.php");

        if($estado_id == 0)
            alerta("Coloque un estado y un municipio", "index.php");

        if(empty($edad) || empty($telefono) || empty($correo))
            alerta("Llene los elementos complementarios", "index.php");

        if(empty($fecha) || empty($hora))
            alerta("Llene los datos de la cita", "index.php");

        //Actualiza en la BD
        $query = "UPDATE usuario SET nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno',
        direccion = '$direccion', edad = $edad, sexo = '$genero', telefono = '$telefono', correo = '$correo', municipio_id = $municipio_id
         WHERE id = $usuario_id";

        $bd->query($query);

        //Inserta en anotacion en caso de existir el mensaje
        list($dia, $mes, $ano) = split('[/]', $fecha);
        $fecha = $ano."-".$mes."-".$dia." ".$hora;
        if(!empty($mensaje))
        {
            $query = "UPDATE anotacion SET mensaje = '$mensaje', fecha = '$fecha' WHERE usuario_id = $usuario_id";
            $bd->query($query);
        }
        else
        {
            $query = "UPDATE anotacion SET fecha = '$fecha' WHERE usuario_id = $usuario_id";
            $bd->query($query);
        }

        alerta("Usuario actualizado", "citas.php");
    }
?>