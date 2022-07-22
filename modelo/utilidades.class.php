<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class Utilidades
{
	private $servidor;
	private $usuario;
	private $clave;
	private $basedatos;
//A través del constructor, inicializo los atributos permanentes de la clase
	public function __construct()
	{
		$this->servidor="localhost";
		$this->usuario="root";
		$this->clave="";
		$this->basedatos="sistema_administrativo";
	}
//Función que establece la conexión con la BD MySQL señalada en el constructor
	function conexion()
	{
		$con = new mysqli($this->servidor,$this->usuario,$this->clave,$this->basedatos);
		if ($con->connect_errno)
		{
		    echo "Fallo al conectar al servidor: (" . $con->connect_errno . ") " . $con->connect_error;
		}		
		else
		{
			$con->set_charset('utf8');		
			return $con;
		}
	}
//Función que devuelve todos los registros de una tabla, en un objeto
	function selectAll($tabla,$con)
	{
		$sql="SELECT * FROM $tabla";
		$registros=$con->query($sql);
		return $registros;
	}
//Función que devuelve un registro de una tabla, en un array
	function selectOne($tabla,$campo,$valor,$con)
	{
		$sql="SELECT * FROM $tabla WHERE $campo='$valor' LIMIT 1";
		$registros=$con->query($sql);
		return $registros->fetch_assoc();
	}
//Función que ejecuta un comando SELECT SQL que se pasa por parámetro y devuelve los registros en un objeto
	function selectSQL($sql,$con)
	{
		$registros=$con->query($sql);
		return $registros;
	}
//Función que elabora una lista desplegable HTML a partir de los datos generados en una consulta SQL
	function makeDropdown($con,$tabla,$valor,$mostrar,$ident,$sql,$funcion,$select=true)
	{
		if(empty($sql))
			$registros=$this->selectAll($tabla,$con);
		else
			$registros=$this->selectSQL($sql,$con);
		$html = "";
		if ($select)
			$html.= "<select id='$ident' name='$ident' onChange='$funcion' class='form-control'>";
		$html.= "<option value=''>Seleccione...</option>";
		while (($fila=$registros->fetch_assoc())>0)
		{
			$html.= "<option value='$fila[$valor]'> $fila[$mostrar] </option>";	
	    }
		if ($select)
			$html.= "</select>";

		return $html;
	}
//Función que voltea una fecha de formato SQL a natural y viceversa
	//---------------------------------------------
	// convertir fecha de dd-mm-aaa -> aaaa-mm-dd
	//---------------------------------------------
	static function cvDate($cad, $tipo) {
	    if ($tipo == 'D') // de aaaa-mm-dd  ->  dd-mm-aaaa
	    {
	        $cadena = substr($cad, 8, 2) . "-" . substr($cad, 5, 2) . "-" . substr($cad, 0, 4);
	    } else
	    // de dd-mm-aaaa -> aaaa-mm-dd
	    {
	        $cadena = substr($cad, 6, 4) . "-" . substr($cad, 3, 2) . "-" . substr($cad, 0, 2);
	    }
	    return ($cadena);
	}
//Función que devuelve la ruta completa de carpetas de un script PHP
	function ruta_script()
	{
		return trim(substr($_SERVER['PHP_SELF'],15));
	}
//Función que recupera el ID autoincremental del último registro insertado en una tabla
	function recuperarUltimoID($con,$tabla)
	{    
	    $sql="SELECT AUTO_INCREMENT-1 as ultimo FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$this->basedatos' AND TABLE_NAME='$tabla'";
	    $resultado = $this->selectSQL($sql,$con);
	    $resultset[]=$resultado->fetch_row();

	    return $resultset;
	}
//Función que concatena ceros a la izquierda de una cifra y la devuelve
	static function number_pad($number,$n) {
    	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}
//Función que cuenta la cantidad de registros de una tabla que cumplan con determinada condición
	function contar_registros($tabla,$condicion,$con)
	{
		$sql="SELECT COUNT(*) AS cuenta FROM $tabla WHERE $condicion";
		$resultado = $this->selectSQL($sql,$con);
		$numregs=$resultado->fetch_assoc();

		return $numregs['cuenta'];
	}
}
?>