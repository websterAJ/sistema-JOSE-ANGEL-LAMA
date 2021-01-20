<?php
define('_BASE_FOLDER_',$_SERVER['DOCUMENT_ROOT']."/sistema-escolar/");
require _BASE_FOLDER_.'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(_BASE_FOLDER_);
$dotenv->load();

$conn=null;

/**
 * Metodo connect_mysqli
 *
 * Metodo encargado de realizar la conexion a la base de datos
 * utilizado las constante o variables de entornos encargada para dicha funcion
 */
function connect_mysqli()
{
	global $conn;

	$conn= mysqli_connect($_ENV['HOST'],$_ENV['USER'],$_ENV['PASS'],$_ENV['DATABASE']) ;

	if (mysqli_connect_errno()) {
	    printf("Conexión fallida: %s\n", mysqli_connect_error());
	    exit();
	}

	return $conn;
}
/**
 * Metodo close_mysqli
 *
 * Metodo encargado de realizar la desconexion de la base de datos
 */
function close_mysqli()
{
	global $conn;

	mysqli_close($conn);
}

/**
 * Metodo SelectAll
 *
 * Metodo encargado de realizar una consulta general a una tabla de la base de datos
 * especificando la tabla a consultar al igual que las columnas a retornar 
 *
 * Parametros que recibe el metodo
 *
 *	$attr   String
 *	$table  String
 *  Return array
 */
function SelectAll($attr,$table){
	global $conn;
	$data = null;

	$db = mysqli_query($conn,"SELECT $attr FROM $table ;");
	if (!$db) {
		$data = mysqli_error($conn);
	}else{
		$data = mysqli_fetch_all($db,MYSQLI_ASSOC);
	}
	return $data;
	
}

/**
 * Metodo SelectWhere
 *
 * Metodo encargado de realizar una consulta mas especifica a una tabla 
 * de la base de datos
 *
 * Especificando la tabla a consultar al igual que las columnas a retornar 
 * segun cumpla una condicion especificada
 *
 *
 * Parametros que recibe el metodo
 *
 *	$attr   String
 *	$table  String
 *	$where  String
 *  Return array
 */
function SelectWhere($attr,$table,$where){
	global $conn;
	$data = null;
	$db = mysqli_query($conn,"SELECT $attr FROM $table WHERE $where;");
	if (!$db) {
		$data = mysqli_error($conn);
	}else{
		$data = mysqli_fetch_all($db,MYSQLI_ASSOC);
	}
	return $data;
	
}

/**
 * Metodo Delete
 *
 * Metodo encargado de eliminar datos en la tablas de la base de datos
 *
 *
 * Parametros que recibe el metodo
 *
 *	$where   String
 *	$table  String
 *  Return void
 */
function Delete($where,$table){
	global $conn;
	
	$db = mysqli_query($conn,"DELETE FROM $table WHERE $where;");

	return $db;

	
}

/**
 * Metodo Update
 *
 * Metodo encargado de eliminar datos en la tablas de la base de datos
 *
 *
 * Parametros que recibe el metodo
 *
 *	$table   String
 *	$columnas  String
 *	$where  String
 *  Return void
 */
function Update($table,$columnas,$where){
	global $conn;
	$valores ="";
	
  
    foreach ($columnas as $key => $value) {

      $valores .="`$key`='".$value."',";
    }      	
	$valores = substr($valores,0,strlen($valores)-1);
	$db = mysqli_query($conn,"UPDATE `$table` SET $valores WHERE $where;");

	return $db;
	
}

function UpdateAula($table,$columnas,$where)
{
	global $conn;
	$db = mysqli_query($conn,"UPDATE `$table` SET $columnas WHERE $where;");
	if (!$db) {
		$data = mysqli_error($conn);
	}

	return $db;
}

/**
 * Metodo Insert
 *
 * Metodo encargado de insertar datos en tablas especificada y en las columnas
 * indicadas
 *
 * Parametros que recibe el metodo
 *
 *	$table   String
 *	$columns  String
 *	$where  String
 *  Return void
 */
function Insert($table,$columns){
	global $conn;
	$columnas=null;
  	$datos=null;
   
	foreach ($columns as $key => $value) {
        $columnas.=$key.",";
        if($value == 'NULL'){
        	$datos.=$value.',';
        }else{
        	$datos.="'".$value."',";
        }
        
	}
	$columnas = substr($columnas, 0, -1);
	$datos = substr($datos, 0, -1);
	$db = mysqli_query($conn,"INSERT INTO $table ($columnas) VALUES ($datos)");
	return $db;
	
}
/**
 * Metodo Islogin
 *
 * Metodo encargado de validar si hay un usuario logiado en el equipo
 */
function Islogin()
{
	if (isset($_SESSION['autch'])) {
		return true;
	} else {
		return false;
	}
	
}
/**
 * Metodo DescribeTable
 *
 * Metodo encargado de realizar descricion de una tabla de la base de datos
 */
function DescribeTable($table){
	global $conn;
	$data = null;

	$db = mysqli_query($conn,"DESCRIBE $table;");
	if (!$db) {
		$data = mysqli_error($conn);
	}else{
		$data = mysqli_fetch_all($db,MYSQLI_ASSOC);
	}

	return $data;
}
?>