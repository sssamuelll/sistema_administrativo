<?php
require("../modelo/utilidades.class.php");

$objUtilidades=new utilidades;
$con=$objUtilidades->conexion();

switch($_REQUEST["accion"])
{
	case 'agregar_orden':		
		$id_orden=$_POST["id_orden"];
		$fecha=$_POST["fecha"];
		$id_cliente=$_POST["id_cliente"];		
		$sql="INSERT INTO ordenes (id_orden,fecha,id_cliente) VALUES ('$id_orden','$fecha','$id_cliente');";
		$ok=$con->query($sql);
		if ($ok)
		{			
			$num_filas = intval($_POST["num_fila"]); /* Recupera la cantidad de filas de detalle */				
			for ($i=0;$i<$num_filas;$i++)
			{
				$num_art=$_POST["num_art".$i];
				if ($num_art!=null)
				{
					$cant=$_POST["cant".$i];
					$sql="INSERT INTO detalle_ordenes (id_orden,num_art,cant) VALUES ($id_orden,$num_art,$cant);";
					$ok=$con->query($sql);
					if ($ok)
						echo 1;
					else
						echo 0;
				}
			}
		}		
		else
			echo 0;
		break;

	case 'mostrar_detalle':
		$id_orden=$_GET["ord"];
		$html ="";
		$sql = "SELECT detalle_ordenes.num_art,nom_art,precio,detalle_ordenes.cant,(detalle_ordenes.cant*precio) AS total FROM detalle_ordenes,articulos WHERE detalle_ordenes.num_art=articulos.num_art AND detalle_ordenes.id_orden=$id_orden ORDER BY detalle_ordenes.num_art";
		$articulos=$objUtilidades->selectSQL($sql,$con);
		if ($articulos)
		{
			$html = "<table align='center' class='tabla_grande' id='tabla_detalle'>
				<tr class='cabecera_tabla'>
					<td>Código</td>
					<td>Nombre</td>
					<td>Precio</td>
					<td align='right'>Cantidad</td>
					<td>Total</td>					
				</tr>\n";
			while(($datos=$articulos->fetch_assoc())>0)
			{
				$html.= "<tr>
				<td>$datos[num_art]</td>
				<td>$datos[nom_art]</td>
				<td align='right'>".number_format($datos['precio'],2,",",".")."</td>
				<td align='right'>$datos[cant]</td>
				<td align='right'>".number_format($datos['total'],2,",",".")."</td></tr>\n";
			}
			$html.="</table>";
		}
		echo $html;
		break;
}
$con->close();
?>