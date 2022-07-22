<?php
	session_start();
	if (!(array_key_exists("id_sesion", $_SESSION)) || ($_SESSION["id_sesion"]!=session_id()))
	{
		echo "<script>
			alert('El usuario no ha iniciado sesión en el sistema');
			location.replace('../../login.html');
			</script>";
	}
	else
	{
		$usuario=$_SESSION['usuario'];
		require("../../modelo/utilidades.class.php");
		$objUtilidades=new utilidades;
		$con=$objUtilidades->conexion();
		//Invocando la función selectAll obtenemos todos los clientes
		$clientes=$objUtilidades->selectAll("clientes",$con);
		$articulos=$objUtilidades->selectAll("articulos",$con);
		$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Orden</title>
	<link rel="stylesheet" href="../css/estilos_form.css">
	<script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/inputmask/dist/jquery.inputmask.js"></script>
</head>

<body onload="document.getElementById('id_orden').focus();">
	<form method="post" action="" name="form_ord" id="form_ord">
		<input type="hidden" name="accion" value="agregar_orden">
		<input type="hidden" name="num_fila" id="num_fila" value="1"> <!-- Para pasarle al JS las filas iniciales a insertar -->
		<table align="center">
			<tr align="center">
				<td colspan="2" id="encabezado">Agregar Orden</td>
			</tr>
			<tr>
				<td align="right">Código de la Orden:</td>
				<td><input type="text" name="id_orden" id="id_orden" size="40" maxlength="4" placeholder="Id" onkeypress="return SoloNumeros(event);"></td>
			</tr>    
			<tr>
				<td align="right">Fecha de la Orden:</td>
				<td><input type="date" name="fecha" id="fecha" size="40" maxlength="30"></td>
			</tr>
			<tr>
				<td align="right">Cliente:</td>
				<td>
					<select name="id_cliente" id="id_cliente">
						<option value="">Seleccione</option>
					<?php
						while(($datos=$clientes->fetch_assoc())>0)
						{
							echo "<option value=$datos[id_cliente]>$datos[id_cliente]-> $datos[nom_cliente]</option>\n";
						}
					?>
					</select>
				</td>
			</tr>		
		</table>
		<br>
		<div align="center"><p class="boton_agregar">Agregar Artículos</p></div>
		<br>
		<div id="table_layout">
			<table align="center" class="tabla_grande" id="tabla_detalle">
				<tr class="cabecera_tabla">
					<td>-</td>
					<td>Artículo</td>
					<td>Precio</td>
					<td>Cantidad</td>
					<td>Total</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>-</td>
					<td>
						<select name="num_art0" id="num_art0" onchange="mostrarPrecio(this);">
							<option value="">Seleccione</option>
						<?php
							while(($datos=$articulos->fetch_assoc())>0)
							{
								echo "<option value=$datos[num_art]>$datos[num_art]-> $datos[nom_art]</option>\n";
							}
						?>
						</select>
					</td>
					<td><input type="text" name="precio0" id="precio0" class="full_size right" readonly=""></td>
					<td><input type="text" name="cant0" id="cant0" class="full_size left" maxlength="3" onkeypress="return SoloNumeros(event);" onblur="return subTotal(this);" readonly=""></td>
					<td><input type="text" name="total0" id="total0" class="full_size right" readonly=""></td>
					<td>&nbsp;</td>
					<td><div id="boton0"><img src="../images/addbutton.png" alt="Añadir producto" title="Añadir producto" onclick="agregar_fila();"></div></td>
				</tr>
			</table>
		</div>
		<br>
		<table align="center" class="tabla_grande">
			<tr><td colspan="2" align="center"><input type="button" value="Guardar" class="boton-submit" onClick="validarOrden()">
			</td>
			</tr>
		</table>
	</form>
	<div id="mensaje_ok" class="mensaje_ok" style="display: none;"></div> <!-- Para mostrar el mensaje si se insertó correctamente -->
	<div id="mensaje_error" class="mensaje_error" style="display: none;"></div> <!-- Para mostrar el mensaje si no se insertó -->
</body>
</html>
<?php
	}
?>