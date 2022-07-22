<?php
	session_stcurso();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar curso</title>
	<link rel="stylesheet" href="../css/estilos_form.css">
	<script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/inputmask/dist/jquery.inputmask.js"></script>
</head>

<body onload="document.getElementById('num_curso').focus();">
	<form method="post" action="" name="form_curso" id="form_curso">
		<input type="hidden" name="accion" value="agregar_curso">
		<table align="center">
			<tr align="center">
				<td colspan="2" id="encabezado">Agregar curso</td>
			</tr>
			<tr>
				<td align="right">Código del curso:</td>
				<td><input type="text" name="num_curso" id="num_curso" size="40" maxlength="4" placeholder="Id" onkeypress="return SoloNumeros(event);"></td>
			</tr>    
			<tr>
				<td align="right">Nombre del curso:</td>
				<td><input type="text" name="nom_curso" id="nom_curso" size="40" maxlength="30" placeholder="Nombre" onblur="return SoloMayusculas('nom_curso');"></td>
			</tr>
			<tr>
				<td align="right">Precio del curso:</td>
				<td><input type="text" name="precio" id="precio" size="40" maxlength="10" placeholder="999,99" class="precio"></td>
			</tr>		
		<tr><td colspan="2" align="center"><input type="button" value="Guardar" class="boton-submit" onClick="validarcurso(1);">
			<input type="reset" value="Limpiar" class="boton-cancel" ></td>
		</tr>
		</table>	
	</form>
	<div id="mensaje_ok" class="mensaje_ok" style="display: none;"></div> <!-- Para mostrar el mensaje si se insertó correctamente -->
	<div id="mensaje_error" class="mensaje_error" style="display: none;"></div> <!-- Para mostrar el mensaje si no se insertó -->
</body>
</html>
<script>
var input = $('input.precio');
$(input).attr('maxLength', 10);
Inputmask('decimal', {
	digits: '2',
	radixPoint: ',',
	groupSeparator: '.',
	inputtype: 'text'
}).mask(input);
</script>
<?php
	}
?>