<?php
//require ('algoritmo.php');
function conectaBDpersonal($tipousuario)
{
  $conexion = mysql_connect('localhost',$tipousuario,'');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}
 //Valida la entrada de un maestro buscando su usuario (percve) y contraseña (perpas) en la BD
function EntraAsesor($u,$c)
{	
	$conexion = conectaBDpersonal('asesor');
	$res = false;
	$nombre = ""; 
	//Vrifica si el maestro sea asesor de uno o mas proyectos, de lo contrario no se le permite el acceso al sistema
	$consulta = sprintf("SELECT * FROM maestroAsesor WHERE percve=%s AND perpas=%s",$u,$c);
	$resultado = mysql_query($consulta);

	if($registro = mysql_fetch_array($resultado))
    {
    	$res = true;
    	$nombre = $registro["pernom"]." ".$registro["perape"];
/*
        $fecha = date("y-m-d");
        $hora = time("H:i:s");
		$newToken = obtenToken(8);
        $sql = "INSERT INTO sesiones (nomusuario, fecha, hora, token)
                  VALUES('$nombre','$fecha','$hora','$newToken');";
        mysql_query($sql);*/
    }
	$salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
    return $salidaJSON;
   
}

 //Valida la entrada de un maestro buscando su usuario (percve) y contraseña (perpas) en la BD
function EntraVinculacion($u,$c)
{
	$conexion = conectaBDpersonal('vinculacion');
	$res = false;
	$nombre = "";
	$consulta = sprintf("SELECT * FROM buscavinculacion WHERE percve=%s AND perpas=%s",$u,$c);
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
	{
		$res = true;
    	$nombre = $registro["pernom"]." ".$registro["perape"];
    	/*$fecha = date("y-m-d");
        $hora = time("H:i:s");
		$newToken = obtenToken(8);
        $sql = "INSERT INTO sesiones (nomusuario, fecha, hora, token)
                  VALUES('$nombre','$fecha','$hora','$newToken');";
        mysql_query($sql);*/
	}
	$salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
        //print json_encode($salidaJSON);
    return $salidaJSON;
}

 //Valida la entrada de un maestro buscando su usuario (percve) y contraseña (perpas) en la BD
function EntraDivespro($u,$c)
{
	$conexion = conectaBDpersonal('divestpro');
	$res = false;
	$nombre = "";
	$consulta = sprintf("SELECT * FROM buscadivestpro WHERE percve=%s AND perpas=%s",$u,$c);
	$resultado = mysql_query($consulta);
	if($registro = mysql_fetch_array($resultado))
	{
		$res = true;
        $nombre = $registro["pernom"]." ".$registro["perape"];
       /* $fecha = date("y-m-d");
        $hora = time("H:i:s");
		$newToken = obtenToken(8);
		var_dump($newToken);
        $sql = "INSERT INTO sesiones (nomusuario, fecha, hora, token)
                  VALUES('$nombre','$fecha','$hora','$newToken');";
        mysql_query($sql);*/
	}
	$salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
        //print json_encode($salidaJSON);
    return $salidaJSON;
}

//Muestra al usuario division de estudios profecionales las solicitudes de proyecto enviadas por el alumno
function SolicitudesPendientes()
{
	$conexion = conectaBDpersonal('divestpro');
	$res = false;
	//solPendientes es una vista
	//Trae todas las solicitudes pendientes
	$consulta = sprintf("SELECT * FROM solPendientes");
	$resultado = mysql_query($consulta);
	$renglones = "";
	$renAsesor="";
		$renglones.="<tr class='warning'>";
		$renglones.="<th>No. Control</th>";
		$renglones.="<th>Alumno </th>";
		$renglones.="<th>Proyecto</th>";
		$renglones.="<th>Empresa</th>";
		$renglones.="<th>Asesor</th>";
		$renglones.="<th>Seleccionar</th>";
		$renglones.="</tr>";
		while ($registro = mysql_fetch_array($resultado)) {
			$consultaAsesor = sprintf("SELECT * FROM buscarAsesores WHERE aluctr=%s",$registro["aluctr"]);
			$resultadoAsesor = mysql_query($consultaAsesor);

			$renglones.="<tr>";
			$renglones.="<td>".$registro["aluctr"]."</td>";
			$renglones.="<td>".$registro["alunom"]." ".$registro["apealumn"]." ".$registro["aluapm"]."</td>";
			$renglones.="<td>".$registro["nombreproy"]."</td>";
			$renglones.="<td>".$registro["nombreempr"]."</td>"; 
			$renglones.="<td>
			<select  class='ddlAsesores ddl dropdown-toggle' value=".$registro["aluctr"].">";
			//Asignamos a cada option el asesor correspondiente a la carrera
			 while ($renAsesor=mysql_fetch_array($resultadoAsesor))
			 {
			 	$renglones.="<option value=".$renAsesor["percve"].">".$renAsesor["pernom"]." ".$renAsesor["perape"]."</option>";
			 }
			 $renglones.="</select></td>"; 
			 $renglones.="<td><button class=' btnAsignar btn btn-success' value=".$registro["aluctr"].">
						<span class='glyphicon glyphicon-ok' value=></span>
						Asignar 
						<button class='btnCancelar btn btn-danger' value=".$registro["aluctr"].">
						<span class='glyphicon glyphicon-remove'></span>
						Cancelar</td>";
			$renglones.="</tr>";
			$res = true;
			//El value de cada uno de los botones es el aluctr, para poder manupilar las acciones
			//de dar de baja o asignar.
		}
		$salidaJSON = array('respuesta'	=> $res,
						'renglones'	=> $renglones);
		return $salidaJSON;
}



function BajaSolicitud($aluctr)
{
	$conexion = conectaBDpersonal('divestpro');
	$consulta = sprintf("SELECT * FROM solicitudes WHERE aluctr=%s",$aluctr);
	$resultado = mysql_query($consulta);
	if($renglones = mysql_fetch_array($resultado))
		$idProy = $renglones["cveproy"];
	$res = false;
	//Elimina de la tabla solicitudes la solicitud enviada por el alumno.
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

function AsignarProyecto($aluctr,$asesor)
{
	
	$conexion = conectaBDpersonal('divestpro');
	$res = false;
	$consulta = sprintf("SELECT * FROM solPendientes  WHERE aluctr=%s",$aluctr);
	$resultado = mysql_query($consulta);
	if($renglones = mysql_fetch_array($resultado))
	{
		//de la vista solPendientes sacamos los datos que necesitamos para agregar al alumo
		//en su proyecto asignado.
		$pdocve = $renglones["pdocve"];
		$cveproy = $renglones["cveproy"];
		$cveempr = $renglones["cveempr"];
		
		$consultaInsertAP = sprintf("INSERT INTO asignproyectos(pdocve, aluctr, cveproy, cveempr) 
									VALUES (%s,%s,%s,%s)",$pdocve,$aluctr,$cveproy,$cveempr);
		$resultadoInsertAP = mysql_query($consultaInsertAP);
		//ASIGNAMOS AL ASESOR
		$consultaInsertAsesor = sprintf("INSERT INTO asignaseinternos(pdocve, percve, cveproy, aluctr)
		 								VALUES (%s,%s,%s,%s)",$pdocve,$asesor,$cveproy,$aluctr);	
		if(mysql_affected_rows()>0)
		{
			//Al pasar a la tabla asignaproyecto se elimina al alumno de la tabla solicitudes.
			$res = true;
			$consultaDelete =sprintf("DELETE FROM solicitudes WHERE aluctr=%s",$aluctr);
			$resultadoDelete = mysql_query($consultaDelete);
			$resultadoAsesor = mysql_query($consultaInsertAsesor);
		}
			
	}
	$salidaJSON = array('respuesta'	=> $res);
	return $salidaJSON;
	
}

//Funcion que permite al asesor visualizar los proyectos y alumnos que asesora !
function ProyectosAsignados($usuario,$tipousuario)
{
	$conexion = conectaBDpersonal('asesor');
  	$res = false;
/*************************PAHO*********************************/
    if($tipousuario == 'asesor') //Muestra los proyectos que el maestro tiene asignados
    {
    	$consultlaProy = sprintf("SELECT * FROM proyAsignado WHERE percve=%s",$usuario);
    	$resultadoProy = mysql_query($consultlaProy);
   		$renglones = "";
   		$renglones.="<tr>";
   		$renglones.="<th>Alumno</th>";
   		$renglones.="<th>Proyecto</th>";
   		$renglones.="<th>Empresa</th>";
   		$renglones.="<th>Asesor</th>";
   		$renglones.="</tr>";
   		while($registro = mysql_fetch_array($resultadoProy))
   		{
   		  $res=true;
   		  $renglones.="<tr>";
   		  $renglones.="<td>".$registro["alunom"]." ".$registro["apealumn"]." ".$registro["aluapm"]."</td>";
   		  $renglones.="<td>".$registro["nombreproy"]."</td>";
   		  $renglones.="<td>".$registro["nombreempr"]."</td>";
   		  $renglones.="<td>".$registro["pernom"].$registro["perape"]."</td>";
   		  $renglones.="</tr>";
   		}
    }
    elseif ($tipousuario == 'divestpro' or $tipousuario =='vinculacion')
    	//Muestra todos los proyectos de todos los alumnos 
    {
    	$consultlaProy = sprintf("SELECT * FROM proyAsignado");
    	$resultadoProy = mysql_query($consultlaProy);
   		$renglones = "";
   		$renglones.="<tr>";
   		$renglones.="<th>Alumno</th>";
   		$renglones.="<th>Proyecto</th>";
   		$renglones.="<th>Empresa</th>";
   		$renglones.="<th>Asesor</th>";
   		$renglones.="</tr>";
   		while($registro = mysql_fetch_array($resultadoProy))
   		{
   		  $res=true;
   		  $renglones.="<tr>";
   		  $renglones.="<td>".$registro["alunom"]." ".$registro["apealumn"]." ".$registro["aluapm"]."</td>";
   		  $renglones.="<td>".$registro["nombreproy"]."</td>";
   		  $renglones.="<td>".$registro["nombreempr"]."</td>";
   		  $renglones.="<td>".$registro["pernom"].$registro["perape"]."</td>";
   		  $renglones.="</tr>";
   		}
    }
    else
    {	//Muestra los proyectos existentes, pero sin el radio boton para seleccionar y cargar
    	$consulta  = sprintf("SELECT * FROM BancoProy where numresi > 0");
    	$resultado = mysql_query($consulta);

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
   	 while($registro = mysql_fetch_array($resultado))
   	  {
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
    }
    
    
    $salidaJSON = array('respuesta' => $res,
            'renglones' => $renglones);
  	return $salidaJSON;
}
?>