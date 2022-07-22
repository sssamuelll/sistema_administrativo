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
		//Invocando la función selectAll obtenemos todos los estudiante
		$estudiante=$objUtilidades->selectAll("estudiante",$con);
		$con->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listado de estudiante</title>
	<link rel="stylesheet" href="../css/estilos_form.css">
	<script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
</head>
<body>
	<table align="center" class="tabla_grande">
		<tr class="cabecera_tabla">
			<td colspan="9">Datos de los estudiante</td>
		</tr>
		<tr class="cabecera_columna">
			<td>Nº</td>
			<td>Nombre</td>
			<td>Ciudad</td>    
			<td align="center">Editar</td>
			<td align="center">Borrar</td>
		</tr>
		<?php
			/*Con la función fetch_assoc sacamos en cada vuelta del while,	cada registro del objeto $estudiante y lo pasamos a la variable $datos */
			while(($datos=$estudiante->fetch_assoc())>0)
			{
				echo "<tr>
				<td>$datos[id_estudiante]</td>
				<td>$datos[nom_estudiante]</td>
				<td>$datos[ciudad]</td>			
				<td align='center'><a href='editar_estudiante.php?cli=$datos[id_estudiante]'><img src='../images/editar.png'></a></td>";
				?>
				<td align="center"><button style="outline:0;border:none;" onclick="eliminarFila(this,'estudiante');"><img src="../images/borrar.jpg"></button></td>
				</tr>
			<?php
			}			
		?>
	</table>
	<br>
    <div id="mensaje_ok" class="mensaje_ok" style="display: none;"></div> <!-- Para mostrar el mensaje si se eliminó correctamente -->
    <div id="mensaje_error" class="mensaje_error" style="display: none;"></div> <!-- Para mostrar el mensaje si no se eliminó -->
</body>
</html>
<?php
	}
?>