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
/*
function guardaProy($idEmp)
{
  //DATOS DEL PROYECTO
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
      
}*/
//FUNCION CREADA POR LEON AVILA
function LlenarTablaProy(){
	$conexion = conectaBD();
	//Preparar la consulta SQL
	$consulta  = sprintf("SELECT * FROM BancoProy where numresi > 0");
		

	//Ejecutamos la consulta.
	$resultado = mysql_query($consulta);
	//Validamos los datos.
	$res = false; //Saber el correcto
	$renglones = "";
	
		$renglones.="<tr>";
		$renglones.="<th>Nombre Proyecto</th>";
		$renglones.="<th>Objetivo</th>";
		$renglones.="<th>Justificacion</th>";
		$renglones.="<th>Empresa</th>";
		$renglones.="<th>Encargado</th>";
		$renglones.="<th>Telefono</th>";
		$renglones.="<th>Cupos</th>";
		$renglones.="<th>Cargar</th>";
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
			$renglones.="<td>";
			$renglones.="<input type='radio' class='radProy' name='seleccionar' value=".$registro["clave"].">";
			$renglones.="</td>";
			$renglones.="</tr>";
		}
	//}
	$salidaJSON = array('respuesta'	=> $res,
						'renglones'	=> $renglones);
	print json_encode($salidaJSON);
}

function enviarSolicitud()
{	
	$res = false;
	$conexion = conectaBD();
	$seleccion = GetSQLValueString($_POST["cargarproy"],"text");
	$ncontrol = GetSQLValueString($_POST["ncontrol"],"sincomillas");
	$consultlaProy = sprintf("SELECT cveproy,nombre, numresi FROM proyectos WHERE cveproy=%s",$seleccion);
	$resultadoProy = mysql_query($consultlaProy);
	//consultar para verificar si el alumno ya realizo la solicitud
	$consultaSolicitudes = sprintf("SELECT * FROM solicitudes WHERE aluctr=%s",$ncontrol);
	$resultadoSolicitudes = mysql_query($consultaSolicitudes);
	$renglones = mysql_fetch_array($resultadoSolicitudes);
	$aluctr = $renglones["aluctr"];
	
	if ($columna = mysql_fetch_array($resultadoProy))
	{
		$cveproy = $columna["cveproy"];
		
		if($cveproy = $seleccion)
		{
			if($aluctr != $ncontrol)
			{
				$idProy = $columna["cveproy"]; 
				$pdocve = obtenPdo();
				$numr = $columna["numresi"] - 1;
				$insertSol =sprintf("INSERT INTO solicitudes (pdocve,aluctr,cveproy) VALUES(%s,%s,%s)",$pdocve,$ncontrol,$seleccion);
				$otroresultado = mysql_query($insertSol);
			
				if(mysql_affected_rows()>0)
				{
					$res = true;
					$updateProy = sprintf("UPDATE proyectos SET numresi=%d WHERE cveproy =%s",$numr,$idProy);
					mysql_query($updateProy);
				}
			}else
				$res = false;
			
		}
	}
	
	$salidaJSON = array('respuesta'	=> $res);
	print json_encode($salidaJSON);

}

function LlenarTablaSolicitud()
{
	$conexion = conectaBD();
	$res = false;
	$consulta = sprintf("SELECT * FROM solPendientes");
	$resultado = mysql_query($consulta);
	$renglones = "";
		$renglones.="<tr class='warning'>";
		$renglones.="<th>No. Control</th>";
		$renglones.="<th>Alumno </th>";
		$renglones.="<th>Proyecto</th>";
		$renglones.="<th>Empresa</th>";
		$renglones.="</tr>";
		while ($registro = mysql_fetch_array($resultado)) {
			$renglones.="<tr>";
			$renglones.="<td>".$registro["aluctr"]."</td>";
			$renglones.="<td>".$registro["alunom"]." ".$registro["apealumn"]." ".$registro["aluapm"]."</td>";
			$renglones.="<td>".$registro["nombreproy"]."</td>";
			$renglones.="<td>".$registro["nombreempr"]."</td>";
			$renglones.="</tr>";
			$res = true;
		}
		$salidaJSON = array('respuesta'	=> $res,
						'renglones'	=> $renglones);
		print json_encode($salidaJSON);
}
//GUARDA PROYECTO LEON
/*
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
	
	}
	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}*/

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
	default:
		# code...
		break;
	
}
?>