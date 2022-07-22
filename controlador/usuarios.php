<?php
require("../modelo/utilidades.class.php");

$objUtilidades=new utilidades;
$con=$objUtilidades->conexion();

switch($_REQUEST["accion"])
{
	case 'chequear_usuario':
		$usuario=$_POST["usuario"];
		$clave=$_POST["clave"];			
 		$user=$objUtilidades->selectOne("usuarios","usuario",$usuario,$con);
 		if ($user)
 		{
 			if ($user['clave']===$clave)
 			{
 				session_start(); //Arranca la sesión
				$_SESSION['id_sesion']=session_id(); //Se guarda la sesión en una variable
				$_SESSION['usuario']=$user['usuario']; //Guardo el usuario como variable de sesión para usarlo en otro script
 				echo 1; //El usuario y la clave coinciden
 			}
 			else
 				echo 2; //Clave incorrecta
 		}
 		else
 			echo 0; //El usuario no existe
		break;
}
$con->close();
?>