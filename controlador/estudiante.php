<?php
require("../modelo/utilidades.class.php");

$objUtilidades=new utilidades;
$con=$objUtilidades->conexion();

switch($_REQUEST["accion"])
{
	case 'agregar_estudiante':
		$id_estudiante=$_POST["id_estudiante"];
		$nom_estudiante=$_POST["nom_estudiante"];
		$ciudad=$_POST["ciudad"];
		$sql="INSERT INTO estudiantes (id_estudiante,nom_estudiante,ciudad) VALUES	('$id_estudiante','$nom_estudiante','$ciudad');";
		$ok=$con->query($sql);
		if ($ok)
			echo 1;
		else
			echo 0;
		break;

	case 'editar_estudiante':
		$id_estudiante=$_POST["cod_estudiante"];
		$nom_estudiante=$_POST["nom_estudiante"];
		$ciudad=$_POST["ciudad"];
		$sql="UPDATE estudiantes SET nom_estudiante='$nom_estudiante',ciudad='$ciudad' WHERE id_estudiante=$id_estudiante";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			echo 1;
		else
			echo 0;
		break;

	case 'eliminar_estudiante':
		$id_estudiante=$_GET["estudiante"];
		$sql="DELETE FROM estudiantes WHERE id_estudiante=$id_estudiante";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			echo 1;
		else
			echo 0;
		break;
}
$con->close();
?>