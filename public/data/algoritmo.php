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

/*
$nuevoToken = "";
$conexion = conectaBD();
  const INTENTOS = 5;
  $contador = 1;
  while( $contador<=INTENTOS ) {
    
    $tmpToken = obtenToken(8);
    //Validar que no exista ya el token generado
    $sql = "SELECT  count(clave) as total FROM sesiones
            WHERE token = '$tmpToken';";
    $result = mysql_query($sql);
    $fila = mysql_fetch_array($result);
    //Si no existe, entonces el token generado es valido
    if( $fila['total']==0 ) {
      $nuevoToken = $tmpToken;
      break;  //Salir del bucle
    }
    $contador++;
  }*/


?>