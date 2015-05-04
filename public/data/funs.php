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

function RegistraProyecto()
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
			$NvoProy = guardaProy();
			if($NvoProy)
				$res=true;
		}
		
		$salidaJSON = array('respuesta' => $respuesta);
		print json_encode($salidaJSON);			
}

function guardaProy($idEmp)
{
  //DATOS DEL PROYECTO
	$conexion = conectaBDpersonal();
    $idp 	= rand();
    $pdocve = obtenPdo();
    $np 	= GetSQLValueString ($_POST["nomproy"],"text");
    $numr 	= GetSQLValueString ($_POST["numresi"],"text" );
    $obj 	= GetSQLValueString ($_POST["objetivo"],"text");
    $just 	= GetSQLValueString ($_POST["justif"],"text");
    $carre 	= GetSQLValueString ($_POST["carrera"],"text");
    $nr 	= GetSQLValueString ($_POST["nomresp"],"text" );
    $pr 	= GetSQLValueString ($_POST["puestresp"],"text");
    
    $consultlaProy = " INSERT INTO proyectos(cveproy, cveempr, pdocve, nombre, numresi, objetiv, justifi, carre, nomresp, pueresp)
    VALUES ('$idp','$idEmp','$pdocve','$np','$numr','$obj','$just','$carre','$nr','$pr')";
    $resultadoProy = mysql_query($consultlaProy);
    if(mysql_affected_rows()>0)
      return true;
  	else
  	  return false;
      
}

$opcion =  $_POST ["opc"];
switch ($opcion) 
{
	case 'validaentrada':
		 ValidaEntrada();
	
		break;
	case 'RegistraProyecto':
		RegistraProyecto();
	default:
		# code...
		break;
}
?>