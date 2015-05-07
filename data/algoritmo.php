<?php

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  //$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  //Desactiva código HTML.
  $theValue = htmlentities($theValue);
  //Lo contrario de HTMLEntities
  //html_entity_decode(string)

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
    case "sincomillas":
      $theValue = ($theValue != "") ? "" . $theValue . "" : "NULL";
      break; 
  }
  return $theValue;
}

function obtenCaracterAleatorio($arreglo) {
    $clave_aleatoria = array_rand($arreglo, 1); //obtén clave aleatoria
    return $arreglo[ $clave_aleatoria ];  //devolver ítem aleatorio
  }
 
  function obtenCaracterMd5($car) {
    $md5Car = md5($car.Time()); //Codificar el carácter y el tiempo POSIX (timestamp) en md5
    $arrCar = str_split(strtoupper($md5Car)); //Convertir a array el md5
    $carToken = obtenCaracterAleatorio($arrCar);  //obtén un ítem aleatoriamente
    return $carToken;
  }
 
  function obtenToken($longitud) {
    //crear alfabeto
    $mayus = "ABCDEFGHIJKMNPQRSTUVWXYZ";
    $mayusculas = str_split($mayus);  //Convertir a array
    //crear array de numeros 0-9
    $numeros = range(0,9);
    //revolver arrays
    shuffle($mayusculas);
    shuffle($numeros);
    //Unir arrays
    $arregloTotal = array_merge($mayusculas,$numeros);
    $newToken = "";
    
    for($i=0;$i<=$longitud;$i++) {
        $miCar = obtenCaracterAleatorio($arregloTotal);
        $newToken .= obtenCaracterMd5($miCar);
    }
    return $newToken;
  }


//Funcion para obtener el periodo actual
function obtenPdo()
{
  //Tomamos la fecha actual y la convertimos a la clave del periodo correspondiente
  $fecha =  date("y-m-d");
  $year = substr($fecha, 0,2);
  $mes = substr($fecha,3,2);
  $month = (int)$mes;
  if($month >= 1 && $month <=6)
    $periodo = "2".$year."1";
  elseif ($month = 7) 
    $periodo = "2".$year."2";
  
  elseif ($month>=8 && $month<=12) 
    $periodo = "2".$year."3";
  
  return $periodo;  
}

  //Funcion para eliminar los espacios vacios de una cadena
function quitaespacios($cadena)
  {
    $longitud = strlen($cadena);
    $arraycadena = str_split($cadena);
    $nuevacadena="";;
    for($i=0;$i<=$longitud;$i++)
    { 
      //echo $cadena{$i}."<br>";
      if(isset($arraycadena[$i]))
      {
        if($arraycadena[$i] != ' ')
        {
          $nuevacadena.=$arraycadena[$i];
        } 
      }
      
    }
    return $nuevacadena;
  }

function quitacomillas($cadena)
{
  $longitud = strlen($cadena);
    $arraycadena = str_split($cadena);
    $nuevacadena="";;
    for($i=0;$i<=$longitud;$i++)
    { 
      //echo $cadena{$i}."<br>";
      if(isset($arraycadena[$i]))
      {
        if($arraycadena[$i] != ' ' && $arraycadena[$i] !="'")
        {
          $nuevacadena.=$arraycadena[$i];
        } 
      }
      
    }
    return $nuevacadena;
}

?>