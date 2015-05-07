<?php

  $cargarArchivo="true";
  $tipo=$_FILES['archivoSubido']['type'];
  $size=$_FILES['archivoSubido']['size'];
  $file_name=$_FILES['archivoSubido']['name'];
  $URL="archivos/$file_name";
  $tipodocx="application/vnd.openxmlformats-officedocument.wordprocessingml.document";
  $tipodoc="application/msword";

  //echo $_FILES['archivoSubido']['name'];

  if (!(($tipo ==$tipodocx) OR ($tipo ==$tipodoc))){
    $msg=$msg." Tu archivo tiene que ser .doc, otros archivos no son permitidos<BR>";
    $cargarArchivo="false";
  }
  if ($size>256000){
    $msg=$msg."El archivo es mayor que 250KB, debes reduzcirlo antes de subirlo<BR>";
    $cargarArchivo="false";
  }

  if($cargarArchivo=="true"){

    if(move_uploaded_file ($_FILES['archivoSubido']['tmp_name'], $URL)){
      mysql_connect("localhost","root","");
      mysql_select_db("residenciasitc");
      $consulta = "INSERT INTO proyalumfor(forcve, aluctr, estado, url) VALUES (3,'10170903',0,'$URL')";
      $resultado = mysql_query($consulta);
      
      if (mysql_affected_rows()>0){
         echo "<script>alert('Archivo subido');window.location = '/funciones';</script>";
      }
      else
       echo "<script>alert('El archivo no pudo guardarse en la BD');window.location = '/funciones';</script>";

  }    
    }
  else{echo $msg;}
?>