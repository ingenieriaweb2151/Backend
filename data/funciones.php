<?php 
	require('funs.php');

	function GuardaEmpProy()
	{
		$conexion = conectaBDpersonal('divestpro');
		$res = false;

		//Empresas
		$NumEmp = mt_rand(10000, 99999);
		$a = GetSQLValueString($_POST["nombre_empresa"], "text");
		$b = GetSQLValueString($_POST["direccion"], "text");
		$c = GetSQLValueString($_POST["colonia"], "text");
		$d = GetSQLValueString($_POST["ciudad"], "text");
		$e = GetSQLValueString($_POST["codigo_postal"], "text");
		$f = GetSQLValueString($_POST["telefono"], "text");
		$g = GetSQLValueString($_POST["encargado"], "text");
		$h = GetSQLValueString($_POST["puesto"], "text");

		//Proyectos
		$NumProy = mt_rand(10000, 99999);
		$Periodo = "2151";
		$i = GetSQLValueString($_POST["nombre_proyecto"], "text");
		$j = GetSQLValueString($_POST["cupos"], "text");
		$k = GetSQLValueString($_POST["objetivo"], "text");
		$l = GetSQLValueString($_POST["justificacion"], "text");
		$m = GetSQLValueString($_POST["carrera"], "text");
		$n = GetSQLValueString($_POST["nombre_responsable"], "text");
		$o = GetSQLValueString($_POST["puesto_responsable"], "text");

		$queryEmp = sprintf("Insert into empresas values(%d, %s, %s, %s, %s, %s, %s, %s, %s)", $NumEmp, $a, $b, $c, $d, $e, $f, $g, $h);
		$queryProy = sprintf("Insert into proyectos values (%d, %d, %d, %s, %s, %s, %s, %s, %s, %s)", $NumProy, $NumEmp, $Periodo, $i, $j, $k, $l, $m, $n, $o);

		$resultadoEmp = mysql_query($queryEmp);

		if(mysql_affected_rows()>0)
		{
			$resultadoProy = mysql_query($queryProy);
			$res = true;
		}

		$salidaJSON = array('respuesta' => $res);

		print json_encode($salidaJSON);
	}
	//Opciones del menú para las funciones
	$opcion = $_POST["opc"];

	switch($opcion)
	{
		case 'guardaempresaproyecto':
			GuardaEmpProy();
			break;
		default:
			echo "Error: No se hará ninguna acción";
			break;
	}
 ?>