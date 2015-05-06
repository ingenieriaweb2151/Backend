<?php

function conectaBDpersonal($tipousuario)
{
  $conexion = mysql_connect('localhost',$tipousuario,'');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}

function EntraAsesor($u,$c)
{	
	$conexion = conectaBDpersonal('asesor');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where not (perdepa ='0') and not (pernom = '.') and percve=%s and perpas=%s",$u,$c);
	$resultado = mysql_query($consulta);
	 
    if($registro = mysql_fetch_array($resultado))
    {
    	$res = true;
    	$nombre = $registro["pernom"]." ".$registro["perape"];
    }
	$salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
    return $salidaJSON;
   
}

function EntraVinculacion($u,$c)
{
	$conexion = conectaBDpersonal('vinculacion');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where not (perdep ='0') and not (pernom = '.') and percve=%s and perpas=%s",$u,$c);
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
	{
		$res = true;
    $nombre = $registro["pernom"]." ".$registro["perape"];
	}
	$salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
        //print json_encode($salidaJSON);
    return $salidaJSON;
}

function EntraDivespro($u,$c)
{
	$conexion = conectaBDpersonal('divestpro');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where not (perdep ='0') and not (pernom = '.') and percve=%s and perpas=%s",$u,$c);
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
	{
		$res = true;
        $nombre = $registro["pernom"]." ".$registro["perape"];
	}
	$salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
        //print json_encode($salidaJSON);
    return $salidaJSON;
}

function BajaSolicitud($aluctr)
{
	$conexion = conectaBDpersonal('divestpro');
	//$aluctr = GetSQLValueString($_POST["ncontrol"],"sincomillas");
	$consulta = sprintf("SELECT * FROM solicitudes WHERE aluctr=%s",$aluctr);
	$resultado = mysql_query($consulta);
	if($renglones = mysql_fetch_array($resultado))
		$idProy = $renglones["cveproy"];
	$res = false;
	$consultaDelete =sprintf("DELETE FROM solicitudes WHERE aluctr=%s",$aluctr);
	$resultadoDelete = mysql_query($consultaDelete);
	//Si la solicitud fue cancelada, el numero residentes incrementa en uno.
	if(mysql_affected_rows()>0)
	{

		$res = true;
		$updateProy = sprintf("UPDATE proyectos SET numresi=numresi+1 WHERE cveproy =%s",$idProy);
		mysql_query($updateProy);

	}
	$salidaJSON = array('respuesta'	=> $res);
	return $salidaJSON;
}

?>