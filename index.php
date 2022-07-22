<?php
	/*session_start();
	if (!(array_key_exists("id_sesion", $_SESSION)) || ($_SESSION["id_sesion"]!=session_id()))
	{
		echo "<script>
			alert('El usuario no ha iniciado sesión en el sistema');
			location.replace('login.html');
			</script>";
	}
	else
	{
		$usuario=$_SESSION['usuario'];*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Control de Existencias-Página principal</title>
<link rel="icon" type="image/png" href="vista/images/grafico.ico">
<link href="vista/css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="contenedor">
		<div id="cabecera">
			<div class="izquierda"><img src="vista/images/inventario.jpg" width="55%"></div>
			<div id="titulo"><h1>Sistema de Control de Existencias</h1></div>
		</div>
		<div id="menu">
			<div class="boton boton-primario">Estudiantes</div>
			<div class="boton"><a href="vista/estudiantes/agregar_estudiante.php" target="enlace">Agregar Estudiante</a></div>
			<div class="boton"><a href="vista/estudiantes/listar_estudiantes.php" target="enlace">Listar Estudiantes</a></div>
			<div class="boton boton-primario">Cursos</div>
			<div class="boton"><a href="vista/cursos/agregar_curso.php" target="enlace">Agregar Curso</a></div>
			<div class="boton"><a href="vista/cursos/listar_curso.php" target="enlace">Listar Cursos</a></div>            
			<div class="boton boton-primario">Ord. de Compra</div>
			<div class="boton"><a href="vista/ordenes/agregar_orden.php" target="enlace">Agregar Ordenes</a></div>
			<div class="boton"><a href="vista/ordenes/listar_ordenes.php" target="enlace">Listar Ordenes</a></div>
			<div class="boton-primario"><a href="logout.php">Cerrar Sesión</a></div>
		</div>
		<div id="centro">
			<iframe src="vista/images/fondologo.html" width="100%" height="100%" name="enlace"></iframe>
		</div>
		<div id="pie">
			<p>Sistema desarrollado por Vince Q</p>
			<p><strong>profesor.vincenzo@gmail.com</strong></p>
		</div>
	</div>
</body>
</html>
<?php
?>