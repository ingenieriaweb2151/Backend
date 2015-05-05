<?php
require('conexionalumno.php');
require('algoritmo.php');
require('conexionpersonal.php');
function conectaBD()
{
  $conexion = mysql_connect('localhost','root','');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}
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


//ESTA FUNCION LA DEBE REALIZAR DIVICION DE ESTUDIOS PROFECIONALES, POR LO TANTO
//DEBE ESTAR EN EL  ARCHIVO conexionpersonal.php -> AQUI ESTAN ALMACENADAS LAS FUNCIONES
//QUE REALIZA EL PERSONAL. 
/*
function registraNvoProy()
{	
		$conexion = conectaBD();
		$res = false;
		//DATOS DE LA EMPRESA
		$idEm = rand();
		$nomEm = GetSQLValueString($_POST["nomEm"],"text");
		$dir = GetSQLValueString($_POST["di"],"text");
		$col = GetSQLValueString($_POST["col"],"text");
		$ciudad = GetSQLValueString($_POST["ciudad"],"text");
		$cp = GetSQLValueString($_POST["cp"],"text");
		$tel = GetSQLValueString($_POST["tel"],"text");
		$enc = GetSQLValueString($_POST["encargado"],"text");
		$puesEnc = GetSQLValueString($_POST["puestoenc"],"text");
		/*
		//DATOS DEL PROYECTO
		$idPro = ran(); 
		$nomPro = GetSQLValueString($_POST["nomPro"],"text");
		$cupos = GetSQLValueString($_POST["cupos"],"text");
		$obj = GetSQLValueString($_POST["obj"],"text");
		$just = GetSQLValueString($_POST["just"],"text");
		$car = GetSQLValueString($_POST["car"],"text");
		$nomResp = GetSQLValueString($_POST["nomResp"],"text");
		$puesResp = GetSQLValueString($_POST["puesResp"],"text");*/

		$consultaEmp = sprintf("INSERT INTO empresas (cveempr, nombre, domicil, colonia, ciudad, cp, telef, nomtitu,puetitu)
					VALUES ('$idEm','$nomEm','$dir','$col','$ciudad','$cp','$tel','$enc','$puesEnc') ");

		//$consultaProy = sprintf("INSERT INTO proyectos (cveproy, cveempr, pdocve, nombre, numresi, objetiv, justifi,carre, nomresp,puestoresp)
		//			VALUES ('$idPro','$idEm','10','$nomPro','$cupos','$obj','$just','$car','$nomResp','$puesResp') ");

		$respuestaEmp = mysql_query($consultaEmp);
		if (mysql_affected_rows()>0)
		{
			$res=true;
			/*$respuestaProy = mysql_query($consultaProy);
			if (mysql_affected_rows()>0)
			{
				$res = true;
			}
		}

		$salidaJSON = array('respuesta' => $respuesta);
		print json_encode($salidaJSON);
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
	case 'registraNvoProy':
		registraNvoProy();
	default:
		# code...
		break;
}

 ?>
?>