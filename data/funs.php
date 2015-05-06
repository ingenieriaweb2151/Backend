 <?php
require('conexionalumno.php');
require('algoritmo.php');
require('conexionpersonal.php');

function ValidaEntrada()
{	
	$tipousuario = $_POST["tu"];
	$u = GetSQLValueString($_POST["usuario"],"text");
	$c = GetSQLValueString($_POST["clave"],"text");
	
	if($tipousuario == 'alumno')
	{
		$respuesta = EntraAlumn($u,$c);
		print json_encode($respuesta); 
		
	}

	elseif ($tipousuario == 'asesor')
	{

		$respuesta = EntraAsesor($u,$c);
		print json_encode($respuesta);
	}

	elseif ($tipousuario == 'divestpro') 
	{
		$respuesta = EntraDivespro($u,$c);
		print json_encode($respuesta);
	}

	elseif ($tipousuario == 'vinculacion') {
		$respuesta =  EntraVinculacion($u,$c);
		print json_encode($respuesta);
	}

}

function LlenarTablaProy()
{
	$ncontrol = GetSQLValueString($_POST["ncontrol"],"sincomillas");
	$llenarProyectos = MostrarBanco($ncontrol);
	print json_encode($llenarProyectos);
}

function enviarSolicitud()
{	
	//Sleccion es el value del radio boton que fue seleccionado, el value contiene la clave del proyecto
	$seleccion = GetSQLValueString($_POST["cargarproy"],"text"); 
	//ncontrol = aluctr
	$ncontrol = GetSQLValueString($_POST["ncontrol"],"sincomillas");

	$enviarSol = EnviarSol($seleccion,$ncontrol);
	print json_encode($enviarSol);
}

function LlenarTablaSolicitud()
{	
	$solicitudes = SolicitudesPendientes();
	print json_encode($solicitudes);
}

//FUNCION PARA PASAR LAS SOLICITUDES DE PROYECTO A ASIGNAR PROYECTO :D
function AsignaProy()
{
	$aluctr = GetSQLValueString($_POST["ncontrol"],"sincomillas");
	$asignaproy = AsignarProyecto($aluctr);
	print json_encode($asignaproy);
}
//Funcion para cancelar las solicitudes
function CancelarProy()
{	
	$aluctr = GetSQLValueString($_POST["ncontrol"],"sincomillas");
	$BajaSol = BajaSolicitud($aluctr);
	print json_encode($BajaSol);
	
}
//Sección de opciones para elegir la funcion correspondiente que pide el .js
$opcion =  $_POST ["opc"];
switch ($opcion) 
{
	case 'validaentrada':
		 ValidaEntrada();
		break;
	
	case 'llenarTablaProy':
		LlenarTablaProy();
		break;
	case 'GuardaEmp':
		GuardaEmp();
		break;
	case 'enviarSolicitud':
		enviarSolicitud();
		break;
	case 'LlenarTablaSolicitud':
		LlenarTablaSolicitud();
		break;
	case 'AsignaProy':
		AsignaProy();
		break;
	case 'CancelarProy':
		CancelarProy();
		break;
	default:
		# code...
		break;
	
}
?>