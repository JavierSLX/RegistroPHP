<?php
    require('conexion.php');

    $query = "SELECT id, nombre FROM estado";
    $resultado = getConnect()->query($query);

    $query = "SELECT id, CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) AS nombre
    FROM usuario";
    $usuarios = getConnect()->query($query);
?>

<html>
    <head>
        <title>Modificación</title>
        <meta charset="UTF-8"/>
        <script language="javascript" src="js/jquery-3.1.1.min.js"></script>
        <script language="javascript">
			$(document).ready(function(){
				$("#cbx_estado").change(function () {

					$("#cbx_estado option:selected").each(function () {
						id_estado = $(this).val();
						$.post("includes/getMunicipio.php", { id_estado: id_estado }, function(data){
							$("#cbx_municipio").html(data);
						});            
					});
				})
			});
		</script>
    </head>
    <body style="text-align: center;" background="img/claro.jpg">
        <h2>Modificación de Usuarios</h2>
        <form id="cambio" name="cambio" action="actualizar.php" method="POST">
            <br/>
            <div>Selecciona usuario:
                <select id="cbx_usuario" name="cbx_usuario">
                    <option value="0" selected>Seleccionar Usuario</option>
                    <?php while($row = $usuarios->fetch_assoc())
                    {?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Eliminar" name="eliminar"/>
            </div>
            <br/>
            <div>Nombre:
                <input id="nombre" name="nombre" placeholder="Nombre" type="text"/>
            </div>
            <br/>
            <div>Apellido Paterno:
                <input id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" type="text"/>
            </div>
            <br/>
            <div>Apellido Materno:
                <input id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" type="text"/>
            </div>
            <br/>
            <div>Dirección:
                <input id="direccion" name="direccion" placeholder="Dirección" type="text"/>
            </div>
            <br/>
            <div>Selecciona Estado:
                <select id="cbx_estado" name="cbx_estado">
                    <option value="0" selected>Seleccionar Estado</option>
                    <?php while($row = $resultado->fetch_assoc())
                    {?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br/>
            <div>Selecciona Municipio:
                <select id="cbx_municipio" name="cbx_municipio"></select>
            </div>
            <br/>
            <div>
                <input type="radio" name="genero" value="masculino" id="masculino" checked="true"><label for="masculino">Masculino</label>
                <input type="radio" name="genero" value="femenino" id="femenino"><label for="femenino">Femenino</label>
            </div>
            <br/>
            <div>Edad:
                <input id="edad" name="edad" placeholder="Edad" type="text"/>
            </div>
            <br/>
            <div>Teléfono:
                <input id="telefono" name="telefono" placeholder="Teléfono" type="text"/>
            </div>
            <br/>
            <div>Correo:
                <input id="correo" name="correo" placeholder="Correo" type="text"/>
            </div>
            <br/>
            <div>Mensaje:
                <textarea name="mensaje" id="mensaje" placeholder="mensaje"></textarea>
            </div>
            <br/><br/>
            <input type="submit" value="Modificar" name="modificar"/>
        </form>
    </body>
</html>