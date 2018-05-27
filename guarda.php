<?php
    if(isset($_POST['modificar']))
        echo '<script type="text/javascript">window.location.href="modificarRegistro.php"</script>';
    
    require_once ("sendEmail.php");
    require_once(dirname(__FILE__)."/includes/funciones.php");
    require_once ("conexion.php");

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

    //Hace las validaciones
    if(empty($nombre) || empty($apellido_paterno) || empty($apellido_materno))
        alerta("Llene los campos del nombre", "index.php");

    if(empty($direccion))
        alerta("Llene la dirección del usuario", "index.php");

    if($estado_id == 0)
        alerta("Coloque un estado y un municipio", "index.php");

    if(empty($edad) || empty($telefono) || empty($correo))
        alerta("Llene los elementos complementarios", "index.php");

    //Registra en la BD
    $query = "INSERT INTO usuario(nombre, apellido_paterno, apellido_materno, direccion, edad, sexo, telefono, correo, municipio_id) VALUES 
    ('$nombre', '$apellido_paterno', '$apellido_materno', '$direccion', $edad, '$genero', '$telefono', '$correo', $municipio_id)";

    $bd = getConnect();
    $bd->query($query);

    //Saca el id del registro
    $query = "SELECT id FROM usuario WHERE nombre = '$nombre' AND apellido_paterno = '$apellido_paterno' AND apellido_materno = '$apellido_materno'";
    $resultado = getConnect()->query($query);
    $row = $resultado->fetch_assoc();
    $usuario_id = $row['id'];

    //Inserta en anotacion
    if(!empty($mensaje))
    {
        $query = "INSERT INTO anotacion(mensaje, usuario_id) VALUES ('$mensaje', $usuario_id)";
        getConnect()->query($query);
    }

    alerta("Usuario creado correctamente", "modificarRegistro.php");
    mandarCorreo($nombre, $correo, $mensaje);

    function mandarCorreo($nombre, $correo, $titulo)
    {
        /*Configuracion de variables para enviar el correo*/
        $mail_username = "webmaster.atc.mx@gmail.com";//Correo electronico saliente
        $mail_userpassword = "marquesada.466";//Tu contraseña de gmail
        $mail_addAddress = $correo;//correo electronico que recibira el mensaje
        $template = "email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
        
        /*Inicio captura de datos enviados por $_POST para enviar el correo */
        $mail_setFromEmail = $mail_username;
        $mail_setFromName = $name;
        $txt_message = "Hola $name. Este es un correo de confirmación de su información";
        $mail_subject = "Verifique su información";
        
        sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject, $template);//Enviar el mensaje
    }
?>