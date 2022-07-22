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
		//Invocando la función selectSQL obtenemos todas las órdenes
		$ordenes=$objUtilidades->selectSQL("SELECT id_orden,fecha,ordenes.id_cliente,clientes.nom_cliente FROM ordenes,clientes WHERE ordenes.id_cliente=clientes.id_cliente ORDER BY id_orden",$con);
		$con->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listado de Órdenes</title>
	<link rel="stylesheet" href="../css/estilos_form.css">
	<script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
</head>
<body>
	<table align="center" class="tabla_grande">
		<tr class="cabecera_tabla">
			<td colspan="9">Datos de las Órdenes</td>
		</tr>
		<tr class="cabecera_columna">
			<td>Código</td>
			<td>Fecha</td>
			<td width="10%">Id cliente</td>
			<td>Nombre del cliente</td>
			<td align="center">Ver detalle</td>			
		</tr>
		<?php
			while(($datos=$ordenes->fetch_assoc())>0)
			{
				echo "<tr>
				<td>$datos[id_orden]</td>
				<td>$datos[fecha]</td>
				<td>$datos[id_cliente]</td>
				<td>$datos[nom_cliente]</td>"
				?>				
				<td align="center"><button style="outline:0;border:none;" onclick="mostrarDetalle(this);"><img src="../images/lupa.jpg" title="Ver detalle"></button></td>
				</tr>
			<?php
			}			
		?>
	</table>
	<br>
    <div id="detalle" class="" style="display: none;"></div> <!-- Para mostrar el detalle de la orden -->
</body>
</html>
<?php
	}
?>