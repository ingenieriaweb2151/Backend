<?php

function conectaBDpersonal($tipousuario)
{
  $conexion = mysql_connect('localhost',$tipousuario,'');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}

function EntraAsesor($u,$c)
{	
	$conexion = conectaBDpersonal('alumno');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where percve=%s and perdepa=%s",$u,$c);
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
	$conectaBDpersonal('vinculacion');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where percve=%s and perdep=%s",$u,$c);
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
	$conectaBDpersonal('divestpro');
	$res = false;
	$nombre = "";
	$consulta = sprintf("select * from dperso where percve=%s and perdep=%s",$u,$c);
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