<?php
require('conexionalumno.php');
require('algoritmo.php');
require('conexionpersonal.php');

function ValidaEntrada()
{	
	$tipousuario = $_POST["tu"];
	$u = GetSQLValueString($_POST["usuario"],"text");
	$c = GetSQLValueString($_POST["clave"],"text");
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

//Funcion para mostrar los proyectos registrados  (NO FUNCIONA u.u)
/*function traeBanco()
{
	$respuesta   = false;
	$conexion    = conectaBD();
	$consulta    = sprintf("select * from bancoproy");
	$resconsulta = mysql_query($consulta);
	$renglones   = "";
	while ($registro = mysql_fetch_array($resconsulta))
	{
		$respuesta = true;
		$renglones.= "<tr>";
		$renglones.= "<td>".$registro["usuario"]."</td>";
		$renglones.= "<td>".$registro["nombre"]."</td>";
		$renglones.= "<td>".$registro["apellido"]."</td>";
		$renglones.= "<td>".$registro["estatus"]."</td>";
		$renglones.= "</tr>";
	}
	$salidaJSON = array('respuesta' => $respuesta,
						'renglones' => $renglones);
	print json_encode($salidaJSON);
}*/
//Sección de opciones para elegir la funcion correspondiente que pide el .js
$opcion =  $_POST ["opc"];
switch ($opcion) 
{
	case 'validaentrada':
		 ValidaEntrada();
	
		break;
	case 'traeBanco':
		traeBanco();
	default:
		# code...
		break;
}
?>