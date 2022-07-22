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
		//Recibimos el código del estudiante
		$codigo=$_GET["estudiante"];
		//Invocando la función selectOne obtenemos los datos del estudiante
		$estudiante=$objUtilidades->selectOne("estudiantes","id_estudiante",$codigo,$con);
		$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar estudiante</title>
	<link rel="stylesheet" href="../css/estilos_form.css">
	<script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
</head>

<body>
	<form method="post" action="" name="form_estudiante" id="form_estudiante">
	<input type="hidden" name="accion" value="editar_estudiante">
	<input type="hidden" name="cod_estudiante" value="<?php echo $codigo; ?>">
	<table align="center">
		<tr align="center">
			<td colspan="2" id="encabezado">Editar estudiante</td>
		</tr>
		<tr>
			<td align="right">Nombre del estudiante:</td>
			<td><input type="text" name="nom_estudiante" id="nom_estudiante" size="40" maxlength="30" placeholder="Nombre" onblur="return SoloMayusculas('nom_estudiante');" value="<?php echo $estudiante['nom_estudiante']; ?>"></td>
		</tr>
		<tr>
			<td align="right">Ciudad:</td>
			<td><input type="text" name="ciudad" id="ciudad" size="40" maxlength="20" placeholder="Ciudad" onblur="return SoloMayusculas('ciudad');" value="<?php echo $estudiante['ciudad']; ?>"></td>
		</tr> 		
		<tr><td colspan=2 align="center"><input type="button" value="Guardar" class="boton-submit" onestudianteck="validarestudiante(2)"></td></tr>
	</table>	
</form>
<br>
	<div id="mensaje_ok" class="mensaje_ok" style="display: none;"></div> <!-- Para mostrar el mensaje si se insertó correctamente -->
	<div id="mensaje_error" class="mensaje_error" style="display: none;"></div> <!-- Para mostrar el mensaje si no se insertó -->
</body>
</html>
<?php
	}
?>