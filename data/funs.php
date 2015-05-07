 <?php
require('conexionalumno.php');
require('algoritmo.php');
require('conexionpersonal.php');
function conectaBD()
{
  $conexion = mysql_connect('localhost',"root",'');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}
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
	$tipousuario = $_POST["tUsuario"];
	if($tipousuario == 'asesor') //Si el usuario es asesor validamos que solo pueda ver los 
	{							 //proyectos y alumnos a los que asesora.	
		$usuario = GetSQLValueString($_POST["usuario"],"sincomillas");
		$llenarProyectos = ProyectosAsignados($usuario,$tipousuario);
	}
		
	elseif ($tipousuario == 'alumno')
	{
		$ncontrol = GetSQLValueString($_POST["usuario"],"sincomillas");
		$llenarProyectos = MostrarBanco($ncontrol);
	}
	elseif($tipousuario == 'vinculacion' OR $tipousuario == 'divestpro')
	{
		$usuario = GetSQLValueString($_POST["usuario"],"sincomillas");
		$llenarProyectos = ProyectosAsignados($usuario,$tipousuario);
	}
	else
	{
		    //Trae de la BD todos los proyectos siempre y cuando el numero de residentes sea mayor a 0
    		//BancoProy es una vista**
		$conexiion = conectaBD();
    	$consulta  = sprintf("SELECT * FROM BancoProy where numresi > 0");
    	//Ejecutamos la consulta.
    	$resultado = mysql_query($consulta);
    	//Validamos los datos.
    	//Saber el correcto
    	$renglones = "";
    	$renglones.="<tr>";
    	$renglones.="<th>Nombre Proyecto</th>";
    	$renglones.="<th>Objetivo</th>";
    	$renglones.="<th>Justificacion</th>";
    	$renglones.="<th>Empresa</th>";
    	$renglones.="<th>Encargado</th>";
    	$renglones.="<th>Telefono</th>";
    	$renglones.="<th>Cupos</th>";
    	$renglones.="</tr>";
    	while($registro = mysql_fetch_array($resultado)){
      		$res = true;

      		$renglones.="<tr>";
      		$renglones.="<td>".$registro["nombreproy"]."</td>";
      		$renglones.="<td>".$registro["objetiv"]."</td>";
      		$renglones.="<td>".$registro["justifi"]."</td>";
      		$renglones.="<td>".$registro["nombreemp"]."</td>";
      		$renglones.="<td>".$registro["nomresp"]."</td>";
      		$renglones.="<td>".$registro["telef"]."</td>";
      		$renglones.="<td>".$registro["numresi"]."</td>";
      		$renglones.="</tr>";
    	}
    	$llenarProyectos = array('respuesta' => $res,
            'renglones' => $renglones);
	}
		
	print json_encode($llenarProyectos);
}

function enviarSolicitud()
{	
	//Sleccion es el value del radio boton que fue seleccionado, el value contiene la clave del proyecto
	$seleccion = GetSQLValueString($_POST["cargarproy"],"sincomillas"); 
	//ncontrol = aluctr
	$ncontrol = GetSQLValueString($_POST["usuario"],"sincomillas");

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
	$aluctr = GetSQLValueString($_POST["usuario"],"sincomillas");
	$asesor = $_POST["asesor"];
	$asignaproy = AsignarProyecto($aluctr,$asesor);
	print json_encode($asignaproy);
}
//Funcion para cancelar las solicitudes
function CancelarProy()
{	
	$aluctr = GetSQLValueString($_POST["usuario"],"sincomillas");
	$BajaSol = BajaSolicitud($aluctr);
	print json_encode($BajaSol);
	
}

function LlenarTablaEntregas()
{
	$tipousuario = $_POST["tUsuario"];
	$usuario = GetSQLValueString($_POST["usuario"],"sincomillas");
	if($tipousuario !='alumno')
	{
		$entregas = traeEntregas($tipousuario,$usuario);
	}
	else
	{
		$entregas = traeEntregasAlumno($usuario);
	}
	print json_encode($entregas);
}


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
	case 'LlenarTablaEntregas':
		LlenarTablaEntregas();
		break;
	/*case 'RevisionFrom':
		RevisionFrom();
		break;*/
	default:
		# code...
		break;
	
}


?>