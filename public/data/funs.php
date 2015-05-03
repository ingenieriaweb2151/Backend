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

function GuardaEmp()
{
		$conexion = conectaBDpersonal('divestpro');
		$res = false; 
		$id = rand();//Elegimos un numero aleatorio para asignarlo como cveempr 
		$ne = GetSQLValueString($_POST["nomemp"],"text");
		$di = GetSQLValueString($_POST["dir"],"text");
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
			$res = true;

		}
		
		$salidaJSON = array('respuesta' => $respuesta);
		print json_encode($salidaJSON);			
}

$opcion =  $_POST ["opc"];
switch ($opcion) 
{
	case 'validaentrada':
		 ValidaEntrada();
	
		break;
	case 'GuardaEmp':
		GuardaEmp();
	default:
		# code...
		break;
}
?>