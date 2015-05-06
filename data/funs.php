 <?php
require('conexionalumno.php');
require('algoritmo.php');
require('conexionpersonal.php');

function ValidaEntrada()
{	
	$tipousuario = $_POST["tu"];
	$u = GetSQLValueString($_POST["usuario"],"text");
	$c = GetSQLValueString($_POST["clave"],"text");
	//global $u;
	//print ($tipousuario);
	if($tipousuario == "alumno")
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

//ESTA FUNCION LA DEBE REALIZAR DIVICION DE ESTUDIOS PROFECIONALES, POR LO TANTO
//DEBE ESTAR EN EL  ARCHIVO conexionpersonal.php -> AQUI ESTAN ALMACENADAS LAS FUNCIONES
//QUE REALIZA EL PERSONAL. 
function conectaBD()
{
  $conexion = mysql_connect('localhost','root','');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}


function GuardaEmp()
{
		$conexion = conectaBDpersonal('divestpro');
		$res = false; 
		$id = rand();//Elegimos un numero aleatorio para asignarlo como cveempr 
		$ne = GetSQLValueString($_POST["nomemp"],"text");
		$di = GetSQLValueString($_POST["di"],"text");
		$co = GetSQLValueString($_POST["col"],"text");
		$ci = GetSQLValueString($_POST["ciu"],"text");
		$cp = GetSQLValueString($_POST["cp"],"text");
		$te = GetSQLValueString($_POST["tel"],"text");
		$en = GetSQLValueString($_POST["enc"],"text");
		$pu = GetSQLValueString($_POST["pues"],"text");
		
		$consultaInsert = "INSERT INTO  empresas(cveempr, nombre, domicil, colonia, ciudad, cp, telef, nomtitu, puetitu)
                  			   VALUES ('$id','$ne','$di','$co','$ci','$cp','$te','$en','$pu')";
   		 $resultadoInsert = mysql_query($consultaInsert);
		if(mysql_affected_rows()>0){
			$NvoProy = guardaProy();
			if($NvoProy)
				$res=true;
		}
		
		$salidaJSON = array('respuesta' => $res);
		print json_encode($salidaJSON);			
}



function LlenarTablaProy()
{
	$llenarProyectos = MostrarBanco();
	print json_encode($llenarProyectos);
}

function enviarSolicitud()
{	

	$seleccion = GetSQLValueString($_POST["cargarproy"],"text");
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