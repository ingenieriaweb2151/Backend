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
	$conexion = mysql_connect('localhost','root','');
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
	$res = false;
	//Cachamos los valores que hay en los campos aluctr y aluapas
	$u = GetSQLValueString($_POST["aluctr"],"text");
	   //["campo de la BD"] ,"tipo del dato"
	$c = GetSQLValueString($_POST["alupas"],"text");

	if(buscaralumno($u))
	{
		$consulta = sprintf("select * from dalumn where aluctr=%s and alupas=%s", $u,$c);
		$resultado = mysql_query($consulta);
		$nombre = "";
		if($registro = mysql_fetch_array($resultado))
		{
			$res = true;
			$nombre = $registro["alunom"]." ".$registro["aluapp"];
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
	$respuesta = false;
	$conexion = conectaBD();
	$consulta = sprintf("Select * from alureg where aluctr=%s",$aluctr);
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
	{
		$respuesta = true;
		return $respuesta;
	}
	elseif (condition) {
		# code...
	}
}
/*
*
*SECCION DE FUNCIONES INTERNAS A USAR POR LAS FUNCIONES SELECCIONADAS SEGUN EL OPC
*


//Funcion para saber si el alumno ya esta en proceso de recidencias
function busalumn()
{
	$conexion = conectaBD();
	$aluctr = GetSQLValueString($_POST["aluctr"],"text");
	$alupas = GetSQLValueString($_POST["alupas"],"text");

	$res = false;
	$consulta  = sprintf("select * from alureg where aluctr=%s", $aluctr);
	$resultado = mysql_query($consulta);
	$registro = mysql_fetch_array($resultado);
	//Si la consulta regresa un valor damos por echo que el alumno ya esta dado de alta en el proceso de recidencias
	if(	$registro)
	{
		$res = true;
		print("Alumno en proceso de recidencias");
		EntradaAlum();
	}
	//sino verificamos si cuenta con los creditos necesarios para realizar el proceso de recidencias
	//tambien verificamos que plan es para verificar si es plan viejo o nuevo 
	else
	{
		//$res = true;
		print("El alumno no esta registrado");
		busplan();

	} ----prubea salidajson
	$salidaJSON = array('respuesta' => $res,
						'nombre'    => $nombre);
	print json_encode($salidaJSON);
}


//funcion para verificar el tipo de plan al que pertenece el alumno
function busplan()
{
	$conexion = conectaBD();
	//$variable = GetSQLValueString($_POST["aluctr"],"text");
	$aluctr = GetSQLValueString($_POST["aluctr"],"text");
	//Deacuerdo a los 2 primeros dijitos del numero de control sabemos a que año pertenece el alumno
	// >=9: Plan viejo
	//<9: Plan nuevo
	$num = substr($aluctr, 0,2);
	$numplan = (int)$num;

	$consulta = sprintf("select * from dalumn where aluctr=%s", $aluctr);
	$resultado = mysql_query($consulta);
	$nombre = "";
	if($registro = mysql_fetch_array($resultado)>0) //verificamos si el alumno esta en la base de datos residenciasitc
	{
		if($numplan > 9)
		{
			//Verificamos si cuenta con los creditos necesarios para darse de alta en el sistema de residencias
				//Si cuenta con los creditos necesarios: verificamos si ya realizo su servicio social
			$consulta = sprintf("select * from dcalum where caltcala >= 220 and aluctr=%s",$aluctr); //Consulta para verificar si tiene vas de 220(es un ejemplo)
			$resultado = mysql_query($consulta);
			if($registro = mysql_fetch_array($resultado) > 0)
			{
				//Buscamos si ya realizo el servicio social
				$consulta = "insert into alureg values (".$aluctr."dfd)";//cambiar al estado anterior u.u
				$resultado = mysql_query($consulta);
				printf("resultado <br>");
				if(mysql_affected_rows() > 0 )
					printf("LISTO!!");
			}
			else
				printf("NO CUMPLE CON LOS CREDITOS REQUERIDOS PARA REALIZAR EL PROCESO DE RESIDENCIAS");
		}
		else
		{
			//Verificamos si cuenta con los creditos necesarios para darse de alta en el sistema de residencias
			$consulta = sprintf("select * from dcalum where caltcala >= 220 and aluctr=%s",$aluctr); //Consulta para verificar si tiene vas de 220
			$resultado = mysql_query($consulta);
			if($registro = mysql_fetch_assoc($resultado) > 0)
			{	
				$consulta = sprintf("insert into alureg values (%s, %s)", $aluctr,"def"); //NO SE COMO SACAR EL PARFOL1 u.u
				$resultado = mysql_query($consulta);

				if (mysql_affected_rows() > 0) 
				{
					printf("ALUMNO REGISTRADO CORRECTAMENTE");
					EntradaAlum();
				}
				else
					printf("NO SE PUDO REGISTRAR");
			}
			else
				printf("EL ALUMNO NO CUENTA CON LOS CREDITOS NECESARIOS PARA REALIZAR EL PROCESO DE RECIDENCIASP PROFECIONALES");

		}
    }
    else
    	print("EL ALUMNO NO ESTA EN LA BASE DE DATOS residenciasitc.");
	
}

*/

/*
*
*SECCION DE OPCIONES (OPC) PARA ELEGIR LA FUNCION CORRESPONDIENTE QUE PIDE JS
*
*/


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