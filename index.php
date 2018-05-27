<?php
    require('conexion.php');

    $query = "SELECT id, nombre FROM estado";
    $resultado = getConnect()->query($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registro</title>
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
        <h2>Registro de Usuarios</h2>
        <form id="combo" name="combo" action="guarda.php" method="POST">
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
                    <option value="0">Seleccionar Estado</option>
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
            <div>Fecha(dd/mm/yyyy):
                <input id="fecha" name="fecha" placeholder="Fecha" type="text" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"/>
            </div>
            <br/>
            <div>Hora(hh:mm) 24hrs:
                <input id="hora" name="hora" placeholder="hora" type="text" pattern="^([01]?[0-9]|2[0-3]):[0-5][0-9]$"/>
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
            <br/>
            <br/>
            <input type="submit" value="Guardar" name="enviar"/>
            <input type="submit" value="Modificar" name="modificar"/>
        </form>
    </body>
</html>