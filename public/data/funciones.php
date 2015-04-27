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

function conectaBD()
{
	//Servidor, Usuario, Contraseña
	$conexion =  mysql_connect("localhost","root","");
	//Seleccionamos la BD
	mysql_select_db("pw15");
	return $conexion;
}	


function ValidaEntrada()
{
	$u = GetSQLValueString($_POST["usuario"],"text");
	$c = GetSQLValueString(md5($_POST["clave"]),"text");
	//Conectar a la BD
	$conexion = conectaBD();
	//Preparar la consulta SQL
	$consulta  = sprintf("select * from usuarios where usuario=%s and clave=%s",$u,$c);
	//Ejecutamos la consulta.
	$resultado = mysql_query($consulta);
	//Validamos los datos.
	$res = false; //Saber el correcto
	$nombre = ""; //Nombre completo
	$tipousuario = 0;
	if($registro = mysql_fetch_array($resultado)>0)
	{
		$res = true;
		$nombre = $registro["nombre"]." ".$registro["apellido"];
		$tipousuario = $registro["tipousuario"];
	}
	$salidaJSON = array('respuesta' => $res,
						'nombre'    => $nombre,
						'tipousuario' => $tipousuario);
	//Codificamos a JSON el array asociativo.
	print json_encode($salidaJSON);
}

function consultaUsuario($usuario)
{
	$respuesta = false;
	$conexion = conectaBD();
	$consulta = sprintf("select usuario from usuarios where usuario=%s",$usuario);
	$resconsulta = mysql_query($consulta); //ejecutamos la consulta.
	if($registro = mysql_fetch_array($resconsulta))
	{
		$respuesta = true;
	}
	return $respuesta;
}

function GuardaProyecto()
{
	$nombre_empresa     = GetSQLValueString($_POST["usuario"],"text");
	$direccion      = GetSQLValueString($_POST["direccion"],"text");
	$telefono    = GetSQLValueString($_POST["telefono"],"text");
	$encargado = GetSQLValueString($_POST["encargado"],"long");
	$nombre_proyecto     = GetSQLValueString($_POST["nombre_proyecto"],"text");
	$carrera       = GetSQLValueString($_POST["carrera"],"text");
	$cupos = GetSQLValueString($_POST["cupos"],"text");
	$respuesta   = false; 
	if($clave == $repiteclave)
	{
		$conexion    = conectaBD();
		if(consultaUsuario($usuario) == false)
		{
			$consulta = sprintf("insert into proyectos values(%s,%s,%s,%s,%d,%s)",$nombre_empresa,$direccion,$telefono,$encargado,$nombre_proyecto,$carrera,$cupos);
			$resconsulta = mysql_query($consulta);
			if(mysql_affected_rows() > 0)
				$respuesta = true;
		}
		// else
		// {
		// 	$consulta = sprintf("update proyectos set clave=%s,nombre=%s,apellido=%s,tipousuario=%d,estatus=%s where usuario=%s",$clave,$nombre,$apellido,$tipousuario,$estatus,$usuario);
		// 	$resconsulta = mysql_query($consulta);
		// 	if(mysql_affected_rows() > 0)
		// 		$respuesta = true;
		// }
	}
	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}

function MostrarDatosUsuario()
{
	$respuesta = false;
	$usuario   = GetSQLValueString($_POST["usuario"],"text");
	$conexion  = conectaBD();
	$consulta  = sprintf("select * from usuarios where usuario=%s",$usuario);
	$resconsulta =  mysql_query($consulta);
	//Inicializar variables.
	$nombre      = "";
	$apellido    = "";
	$tipousuario = 0;
	$estatus     = "";
	if($registro = mysql_fetch_array($resconsulta))
	{
		$nombre      = $registro["nombre"];
		$apellido    = $registro["apellido"];
		$tipousuario = $registro["tipousuario"];
		$estatus     = $registro["estatus"];
		$respuesta   = true;
	}
	$salidaJSON = array('respuesta'  => $respuesta, 
						'nombre'     => $nombre,
						'apellido'   => $apellido,
						'tipousuario'=> $tipousuario,
						'estatus'    => $estatus);
	print json_encode($salidaJSON);
}

function EliminaUsuario()
{
	$usuario =  GetSQLValueString($_POST["usuario"],"text");
	$conexion = conectaBD();
	$consulta = sprintf("delete from usuarios where usuario=%s",$usuario);
	$resconsulta = mysql_query($consulta);
	$respuesta = false;
	if(mysql_affected_rows()>0)
		$respuesta = true;
	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}

//Opciones a ejecutar.
$opcion = $_POST["opc"];
switch ($opcion) {
	case 'validaentrada':
		ValidaEntrada();
		break;
	case 'guardaproyecto':
		GuardaUsuario();
		break;
	case 'mostrarDatosUsuario':
		MostrarDatosUsuario();
		break;
	case 'EliminaUsuario':
		EliminaUsuario();
		break;
	default:
		# code...
		break;
}
?>




