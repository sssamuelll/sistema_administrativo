<?php
require("../modelo/utilidades.class.php");

$objUtilidades=new utilidades;
$con=$objUtilidades->conexion();

switch($_REQUEST["accion"])
{
	case 'agregar_curso':
		$num_curso=$_POST["num_curso"];
		$nom_curso=$_POST["nom_curso"];
		$precio=$_POST["precio"];
		$valor = str_replace('.', '',$precio); //Sacamos el separador de miles .
  		$valor = str_replace(',', '.',$valor); //Cambiamos la coma decimal por un punto
		$sql="INSERT INTO cursos (num_curso,nom_curso,precio) VALUES 
				('$num_curso','$nom_curso','$valor');";
		$ok=$con->query($sql);
		if ($ok)
			echo 1;
			//$respuesta = 1;
		else
			echo 0;
			//$respuesta = 0;
		break;

	case 'editar_curso':
		$num_curso=$_POST["num_curso"];
		$nom_curso=$_POST["nom_curso"];
		$precio=$_POST["precio"];
		$valor = str_replace('.', '',$precio);
		$valor = str_replace(',', '.',$valor);
		$sql="UPDATE cursos SET nom_curso='$nom_curso',precio='$valor' WHERE num_curso=$num_curso";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			echo 1;
			//$respuesta = 1;
		else
			echo 0;
			//$respuesta = 0;
		break;

	case 'eliminar_curso':
		$num_curso=$_GET["curso"];
		$sql="DELETE FROM cursos WHERE num_curso=$num_curso";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			echo 1;
			//$respuesta = 1;
		else
			echo 0;
			//$respuesta = 0;
		break;

	case 'buscar_precio':
		$num_curso=$_GET["curso"];
		$curso = $objUtilidades->selectOne("cursos","num_curso",$num_curso,$con);
		if ($curso)		
			$precio=$curso["precio"];
		else
			$precio=0;
		echo $precio;
		break;
}
$con->close();
?>