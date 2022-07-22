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
		require("../../modelo/utilidades.class.php");
		$objUtilidades=new utilidades;
		$con=$objUtilidades->conexion();
		//Recibimos el código del curso
		$codigo=$_GET["curso"];
		//Invocando la función selectOne obtenemos los datos del curso
		$cursoiculo=$objUtilidades->selectOne("curso","num_curso",$codigo,$con);
		$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar curso</title>
	<link rel="stylesheet" href="../css/estilos_form.css">
	<script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/inputmask/dist/jquery.inputmask.js"></script>
</head>

<body>
	<form method="post" action="" name="form_curso" id="form_curso">
	<input type="hidden" name="accion" value="editar_curso">
	<input type="hidden" name="num_curso" value="<?php echo $codigo; ?>">
	<table align="center">
		<tr align="center">
			<td colspan="2" id="encabezado">Editar curso</td>
		</tr>
		<tr>
			<td align="right">Nombre del curso:</td>
			<td><input type="text" name="nom_curso" id="nom_curso" size="40" maxlength="30" placeholder="Nombre" onblur="return SoloMayusculas('nom_curso');" value="<?php echo $cursoiculo['nom_curso']; ?>"></td>
		</tr>
		<tr>
			<td align="right">Precio:</td>
			<td><input type="text" name="precio" id="precio" size="40" maxlength="20" placeholder="999,99" value="<?php echo number_format($cursoiculo['precio'],2,",","."); ?>" class="precio"></td>
		</tr> 		
		<tr><td colspan=2 align="center"><input type="button" value="Guardar" class="boton-submit" onClick="validarcursoiculo(2)"></td></tr>
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