<?php 

function conectaBDalumno($tipousuario)
{
  $conexion = mysql_connect('localhost',$tipousuario,'');
  mysql_select_db('residenciasitc',$conexion) or die ('No es posible conectarse a la BD residenciasitc');
  return $conexion;
}

function EntraAlumn($u,$c)
{
  $conexion = conectaBDalumno('root');
      if(buscaralumno($u))
      {
        $consulta  = sprintf("select * from dalumn where aluctr=%s and alupas=%s",$u,$c);
        //Ejecutamos la consulta.
        $resultado = mysql_query($consulta);
        //Validamos los datos.
        $res = false; //Saber el correcto
        $nombre = ""; //Nombre completo
        $registro = mysql_fetch_array($resultado);
        if($registro>0)
        {
          $res = true;
          $nombre = $registro["alunom"]." ".$registro["aluapp"];
        }
        else{
         $res = false;     
        }
        $salidaJSON = array('respuesta' => $res,
                  'nombre'    => $nombre);
        //print json_encode($salidaJSON);
        return $salidaJSON;
        
      }
      else
      {//configurar eventos.js para que aparesca el mensaje en un alert();
        $msj = "Lo sentimos el alumno no esta en proceso de recidencias";
        $res = false;
        $salidaJSON = array('respuesta' => $res,
                  'nombre'    => $msj);
        //print json_encode($salidaJSON);
        return $salidaJSON;
      } 
}
 //Busca al alumno en la tabla alureg: esta tabla almacena a todos los alumnos que estan en proceso de residencias
function buscaralumno($aluctr)
{
  $conexion = conectaBDalumno('root');
  $consulta = sprintf("Select * from alureg where aluctr=%s",$aluctr); //Verificamos si ya esta registrado
  $resultado = mysql_query($consulta);
  if($registro = mysql_fetch_array($resultado))
  {
    return true;
    print("El alumno esta en proceso de recidencias");
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
      //print("Registrado con exito");
    }
    else{
      return false;
      //print("No se pudo registrar");
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
  
  $salidaJSON = array('respuesta' => $res);
  return $salidaJSON;
}
?>