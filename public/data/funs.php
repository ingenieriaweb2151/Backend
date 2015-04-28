<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  //Desactiva código HTML.
  $theValue = htmlentities($theValue);
  //Lo contrario de HTMLEntities
  //html_entity_decode(string)

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

//Funcion para conectarnos a la BD residenciasitc
function conectaBD()
{
	$conexion = mysql_connect('localhost','alumno','');
	mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
	return $conexion;
}

/*
*
*SECCION DE FUNCIONES A USAR SEGUN OPC RECIVIDA
*
*/

function EntradaAlum()
{
	$conexion = conectaBD();
	//$res = false;
	$u = $_POST["aluctr"];
	$c = $_POST["alupas"];
	//$nombre="";
	if(buscaralumno($u))
	{
		$consulta  = sprintf("select * from dalumn where aluctr=%s and alupas=%s",$u,$c);
		//Ejecutamos la consulta.
		$resultado = mysql_query($consulta);
		//Validamos los datos.
		$res = false; //Saber el correcto
		$nombre = ""; //Nombre completo
		$registro = mysql_fetch_array($resultado);
		if($registro>0)
		{
			$res = true;
			$nombre = $registro["alunom"]." ".$registro["aluapp"];
		}
		else{
			$res = false;
			print("algo salio mal :c");				
		}
		$salidaJSON = array('respuesta' => $res,
							'nombre'    => $nombre);
		print json_encode($salidaJSON);
	}
	else
	{
		$msj = "Lo sentimos el alumno no esta en proceso de recidencias";
		$res = false;
		$salidaJSON = array('respuesta' => $res,
							'nombre'    => $msj);
		print json_encode($salidaJSON);
	}
	

}
//Funcion para buscar al alumno en la tabla alureg, dicha tabla almacena a los
//alumnos que estan en proceso de recidencias

	
function buscaralumno($aluctr)
{
	$conexion = conectaBD();
	$consulta = sprintf("Select * from alureg where aluctr=%s",$aluctr); //Verificamos si ya esta registrado
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
	{
		return true;
		print("El alumno esta en proceso de recidencias");
	}//sino esta registrado verificamos si cargo la mat. residencias y así darlo de alta
	elseif(cargoresidencias($aluctr)){
		$registrar = registraalumno($aluctr);
		return $registrar; 
	}
	else
		return false;
}

//funcion para registrar al alumno en el proceso de recidencias
function registraalumno($aluctr)
{
	$conexion = conectaBD();
	$consulta = sprintf("insert into alureg values (%s)",$aluctr);
		$resultado = mysql_query($consulta,$conexion);
		if (mysql_affected_rows() > 0) {
			return true;
			print("Registrado con exito");
		}
		else{
			return false;
			print("No se pudo registrar");
		}
			
}
function cargoresidencias($aluctr)
{
	$conexion = conectaBD();
	//Consulara para buscar al alumno en la tabla DLISTA: aqui se almacena las materias que cargo 
	$consulta = sprintf("select * from buscarmat where aluctr=%s",$aluctr);
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
		return true;
	else
		return false;
}

//Sección de opciones para elegir la funcion correspondiente que pide el .js
$opcion =  $_POST ["opc"];

switch ($opcion) 
{
	case 'validaentrada':
		 EntradaAlum();
	
		break;
	
	default:
		# code...
		break;
}
?>