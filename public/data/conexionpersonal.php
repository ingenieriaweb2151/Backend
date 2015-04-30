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
	$consulta = sprintf("select * from dperso where not (perdepa ='') and not (pernom = '.') and percve=%s and perpas=%s",$u,$c);
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
	$conexion = $conectaBDpersonal('vinculacion');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where percve=%s and perpas=%s",$u,$c);
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
	$consulta = sprintf("select * from dperso where percve=%s and perpas=%s",$u,$c);
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

?>