<?php 
//En este archivo se encuentran todas las funciones de las operaciones que puede realizar 
//un usuario de tipo alumno

//conectaBDalumno(): Permite conectarnos a la BD segun el tipo de usuario, en este caso 'alumno'
function conectaBDalumno($tipousuario)
{
  $conexion = mysql_connect('localhost',$tipousuario,'');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}

//EntraAlumn(): Valida si el alumno esta en proceso de residencias, verifica
function EntraAlumn($u,$c)
{
  $conexion = conectaBDalumno('alumno');
      if(buscaralumno($u))
      {
        $consulta  = sprintf("select * from dalumn where aluctr=%s and alupas=%s",$u,$c);
        //Ejecutamos la consulta.
        $resultado = mysql_query($consulta);
        //Validamos los datos.
        $res = false; 
        $nombre = ""; 
        $fecha = date("y-m-d");
        $hora = time("H:i:s");
        $registro = mysql_fetch_array($resultado);
        if($registro>0)
        {
          $res = true;
          $nombre = $registro["alunom"]." ".$registro["aluapp"];
          $newToken = obtenToken(8);
          $sql = "INSERT INTO sesiones (nomusuario, fecha, hora, token)
                  VALUES('$nombre','$fecha','$hora','$newToken');";
          mysql_query($sql);
          
        }
        else{
         $res = false;     
        }
        $salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre, 'token' => $newToken); //
        //print json_encode($salidaJSON);
        return $salidaJSON;
        
      }
      else
      {
        $msj = "Lo sentimos el alumno no esta en proceso de recidencias";
        $res = false;
        $salidaJSON = array('respuesta' => $res,
                  'nombre'    => $msj);
        //print json_encode($salidaJSON);
        return $salidaJSON;
      } 
}
 //Busca al alumno en la tabla alureg: esta tabla almacena a todos los alumnos que estan 
//en proceso de residencias
function buscaralumno($aluctr)
{
  $conexion = conectaBDalumno('alumno');
  $consulta = sprintf("Select * from alureg where aluctr=%s",$aluctr); //Verificamos si ya esta registrado
  $resultado = mysql_query($consulta);
  if($registro = mysql_fetch_array($resultado))
  {
    return true;
  }//sino esta registrado verificamos si cargo la mat. residencias y así darlo de alta
  elseif(cargoresidencias($aluctr)){
    $registrar = registraalumno($aluctr);
    return $registrar; 
  }
  else
    return false;
}

//funcion para registrar al alumno en el proceso de recidencias
function registraalumno($aluctr)
{
  $conexion = conectaBDalumno('root');
  $consulta = sprintf("insert into alureg values (%s)",$aluctr);
    $resultado = mysql_query($consulta,$conexion);
    if (mysql_affected_rows() > 0) {
      return true;
    }
    else{
      return false;
    }
      
}

//Funcion buscar la materia de residencias y si el alumno la cargo
//buscamat: vista que contiene la consulta para buscar al alumno.
function cargoresidencias($aluctr)
{
  $conexion = conectaBDalumno('root');
  //Consulara para buscar al alumno en la tabla DLISTA: aqui se almacena las materias que cargo 
  $consulta = sprintf("select * from buscarmat where aluctr=%s",$aluctr);
  $resultado = mysql_query($consulta);
  if($registro = mysql_fetch_array($resultado))
    return true;
  else
    return false;
}
//EnviarSol(): Permite que el alumno seleccione un proyecto y envie una solicitud a
//division de estudios profecionales
function EnviarSol($seleccion,$ncontrol)
{ 
  $res = false;
  $conexion = conectaBDalumno('alumno');
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
    if($cveproy == $seleccion)
    {
      if($aluctr != $ncontrol) //if = sin son iguales significa que ya tiene una solicitud enviada
      {
        $idProy = $columna["cveproy"]; 
        $pdocve = obtenPdo();
        $numr = $columna["numresi"] - 1;
        $insertSol =sprintf("INSERT INTO solicitudes (pdocve,aluctr,cveproy) VALUES(%s,%s,%s)",$pdocve,$ncontrol,$seleccion);
        $otroresultado = mysql_query($insertSol);
      
        if(mysql_affected_rows()>0)
        {
          $res = true;
          //Al enviar la solicitud de proyecto, actualiza el numero de residentes -1
          $updateProy = sprintf("UPDATE proyectos SET numresi=%d WHERE cveproy =%s",$numr,$idProy);
          mysql_query($updateProy);
        }
      }else
        $res = false;
      
    }
  }
  
  $salidaJSON = array('respuesta' => $res);
  return $salidaJSON;
}
//FUNCION CREADA POR LEON AVILA
function MostrarBanco($ncontrol)
{
  $conexion = conectaBDalumno('alumno');
  $tieneProy = tieneProyecto($ncontrol);
  $res = false;
  if(!($tieneProy))
  {
    //Trae de la BD todos los proyectos siempre y cuando el numero de residentes sea mayor a 0
    //BancoProy es una vista**
    $consulta  = sprintf("SELECT * FROM BancoProy where numresi > 0");
    //Ejecutamos la consulta.
    $resultado = mysql_query($consulta);
    //Validamos los datos.
    //Saber el correcto
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
      $renglones.="<td>"; //Asignamos al value del radio boton la clave del proyecto.
      $renglones.="<input type='radio' class='radProy' name='seleccionar' value=".$registro["clave"].">";
      $renglones.="</td>";
      $renglones.="</tr>";
    }
  }
  else
  { 
    $consultlaProy = sprintf("SELECT * FROM proyAsignado WHERE aluctr=%s",$ncontrol);
    
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
  
  $salidaJSON = array('respuesta' => $res,
            'renglones' => $renglones);
  //print json_encode($salidaJSON);
  return $salidaJSON;
}

function tieneProyecto($ncontrol)
{
  $conexion = conectaBDalumno('alumno');
  $consulta = sprintf("SELECT * FROM asignproyectos WHERE aluctr=%s",$ncontrol);
  $resultado = mysql_query($consulta);
  if($renglones = mysql_fetch_array($resultado))
    return true;
  else
    return false;
}
?>