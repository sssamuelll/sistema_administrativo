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
?>
<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Agregar estudiante</title>
    <link rel="stylesheet" href="../css/estilos_form.css">
    <script src="../js/validaciones.js" language="javascript" type="text/javascript"></script>
</head>

<body onload="document.getElementById('id_estudiante').focus();">
    <form method="post" action="" name="form_estudiante" id="form_estudiante">
        <input type="hidden" name="accion" value="agregar_estudiante">
    	<table align="center">
    		<tr align="center">
            	<td colspan="2" id="encabezado">Agregar estudiante</td>
            </tr>
            <tr>
                <td align="right">Código del estudiante:</td>
                <td><input type="text" name="id_estudiante" id="id_estudiante" size="40" maxlength="4" placeholder="Id" onkeypress="return SoloNumeros(event);"></td>
            </tr>    
            <tr>
            	<td align="right">Nombre del estudiante:</td>
                <td><input type="text" name="nom_estudiante" id="nom_estudiante" size="40" maxlength="30" placeholder="Nombre" onblur="return SoloMayusculas('nom_estudiante');"></td>
            </tr>
    		<tr>
            	<td align="right">Ciudad del estudiante:</td>
                <td><input type="text" name="ciudad" id="ciudad" size="40" maxlength="30" placeholder="Ciudad" onblur="return SoloMayusculas('ciudad');"></td>
            </tr>		
    	<tr><td colspan="2" align="center"><input type="button" value="Guardar" class="boton-submit" onestudianteck="validarestudiante(1);">
            <input type="reset" value="Limpiar" class="boton-cancel" ></td>
        </tr>
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