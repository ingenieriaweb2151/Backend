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

//FUNCIONES QUE RESALIZAN LOS USUARIOS QUE NO SON ALUMNOS.
function BajaSolicitud($aluctr)
{
	$conexion = conectaBDpersonal('divestpro');
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

function AsignarProyecto($aluctr)
{
	
	$conexion = conectaBDpersonal('divestpro');
	$res = false;
	$consulta = sprintf("SELECT * FROM solPendientes  WHERE aluctr=%s",$aluctr);
	$resultado = mysql_query($consulta);
	if($renglones = mysql_fetch_array($resultado))
	{
		$pdocve = $renglones["pdocve"];
		$cveproy = $renglones["cveproy"];
		$cveempr = $renglones["cveempr"];
		
		$consultaInsert = sprintf("INSERT INTO asignproyectos(pdocve, aluctr, cveproy, cveempr) 
									VALUES (%s,%s,%s,%s)",$pdocve,$aluctr,$cveproy,$cveempr);
		$resultadoInsert = mysql_query($consultaInsert);
		if(mysql_affected_rows()>0)
		{
			$res = true;
			$consultaDelete =sprintf("DELETE FROM solicitudes WHERE aluctr=%s",$aluctr);
			$resultadoDelete = mysql_query($consultaDelete);
		}
			
	}
	$salidaJSON = array('respuesta'	=> $res);
	return $salidaJSON;
	
}

function SolicitudesPendientes()
{
	$conexion = conectaBDpersonal('divestpro');
	$res = false;
	$consulta = sprintf("SELECT * FROM solPendientes");
	$resultado = mysql_query($consulta);
	$renglones = "";
		$renglones.="<tr class='warning'>";
		$renglones.="<th>No. Control</th>";
		$renglones.="<th>Alumno </th>";
		$renglones.="<th>Proyecto</th>";
		$renglones.="<th>Empresa</th>";
		$renglones.="<th>Seleccionar</th>";
		$renglones.="</tr>";
		while ($registro = mysql_fetch_array($resultado)) {
			$renglones.="<tr>";
			$renglones.="<td>".$registro["aluctr"]."</td>";
			$renglones.="<td>".$registro["alunom"]." ".$registro["apealumn"]." ".$registro["aluapm"]."</td>";
			$renglones.="<td>".$registro["nombreproy"]."</td>";
			$renglones.="<td>".$registro["nombreempr"]."</td>";
			$renglones.="<td><button class=' btnAsignar btn btn-success' value=".$registro["aluctr"].">
						<span class='glyphicon glyphicon-ok' value=></span>
						Asignar 
						<button class='btnCancelar btn btn-danger' value=".$registro["aluctr"].">
						<span class='glyphicon glyphicon-remove'></span>
						Cancelar</td>";
			$renglones.="</tr>";
			$res = true;
		}
		$salidaJSON = array('respuesta'	=> $res,
						'renglones'	=> $renglones);
		return $salidaJSON;
}


?>