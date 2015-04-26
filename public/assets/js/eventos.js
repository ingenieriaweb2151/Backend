var inicio = function()
{
	//Declaramos las funciones.
	var validaUsuario = function()
	{
		var u = $("#txtUsuario").val();
		var c = $("#txtClave").val();
		var parametros = "opc=validaentrada"+"&usuario="+u+"&clave="+c+"&id="+Math.random();
		if(u!="" && c!="")
		{
			$.ajax({
				cache:false,
				url: "data/funciones.php",
				type: "POST",
				dataType: "json",
				data: parametros,
				success: function(response){
					if(response.respuesta == true) 
					{
						$("#panelEntrada").hide("slow");
						$("#nav1").show("slow");

						$("#btnEntregas").show("slow");
						$("#informacion").show("slow");
						$("#btnIngresar").hide("slow");
						$("#banco").hide();
						alert("Bienvenido: "+response.nombre);
					}
					else
						alert("Nombre de usuario y/o contraseña incorrectos");
				}
			});
		}
		else
			alert("Llene todos campos");
		// if(u=="pw" && c=="clave")
		// {
		// 	$("#panelEntrada").hide("slow");
		// 	$("nav").show("slow");
		// }
	}

	var traeInicio = function()
	{
		// $.ajax({
		//   url: 'http://api.randomuser.me/',
		//   dataType: 'json',
		//   success: function(data){
		//   	$("img").attr("src",data.results[0].user.picture.medium);
		//   	$("h1").html(data.results[0].user.name.first+' '+
		//   		         data.results[0].user.name.last);
		//   	$("h2").html(data.results[0].user.email);
		//   }
		// });

		$("#informacion").show();
		$("#documentacion").hide();
		$("#banco").hide();
		$("#entregas").hide();

	}

	var traeBanco = function ()
	{
		$("#informacion").hide();
		$("#documentacion").hide();
		$("#entregas").hide();
		$("#banco").show();

	}


		var traeDocumentacion = function()
	{
		$("#informacion").hide();
		$("#documentacion").show();
		$("#banco").hide();
		$("#entregas").hide();

	}

	  var traeEntregas = function ()
	  {
	  	$("#entregas").show();
		$("#informacion").hide();
		$("#documentacion").hide();
		$("#banco").hide();

	  }


	var teclaUsuario = function(tecla)
	{
		if(tecla.which == 13) //Enter
		{
			//Pongo el cursor en el cuadro 
			//de texto de la Clave.
			$("#txtClave").focus();
		}
	}

	var teclaClave = function(tecla)
	{
		if(tecla.which == 13)
		{
			validaUsuario();
		}
	}

	var DivUsuarios = function()
	{
		$("#altaUsuarios").show("slow");
		$("#btnGuardaUsuario").show();
		$("#btnEliminaUsuario").hide();
	}

		var Ingresar = function()
	{
		$("#panelEntrada").show("slow");
		$("#nav1").hide("slow");
		$("#informacion").hide("slow");
		$("#entregas").hide();

	}

	var GuardaUsuario = function()
	{
		var u = $("#txtNombreUsuario").val();
		var n = $("#txtNombre").val();
		var a = $("#txtApellido").val();
		var t = $("#txtTipoUsuario").val();
		var e = $("#txtEstatus").val();
		var c = $("#txtClaveUsuario").val();
		var r = $("#txtRepiteClave").val();
		if(c == r)
		{
			var parametros = "opc=guardausuario"+"&usuario="+u+"&nombre="+n+"&apellido="+a+"&tipousuario="+t+"&estatus="+e+"&clave="+c+"&repiteclave="+r+"&id="+Math.random();
			$.ajax({
				cache:false,
				type: "POST",
				dataType: "json",
				url:'data/funciones.php',
				data: parametros,
				success: function(response){
					if(response.respuesta == true)
					{
						alert("Usuario actualizado con éxito");
					}
					else
						alert("No se ha podido actualizar al usuario");
				},
				error: function(xhr,ajaxOption,x){
					alert("Sin conexión");
				}
			});
		}
		else
			alert("Las claves no coinciden");
	}

	var mostrarDatosUsuario = function()
	{
		var u = $("#txtNombreUsuario").val();
		var parametros = "opc=mostrarDatosUsuario"+
						 "&usuario="+u+
						 "&id="+Math.random();
		$.ajax({
			cache: false,
			type: "POST",
			dataType: "json",
			url: "data/funciones.php",
			data: parametros,
			success: function(response){
				if(response.respuesta == true)
				{
					$("#txtNombre").val(response.nombre);
					$("#txtApellido").val(response.apellido);
					$("#txtTipoUsuario").val(response.tipousuario);
					$("#txtEstatus").val(response.estatus);
				}
				else
					$("#txtNombre").focus();
			},
			error: function(xhr,ajaxOption,x){
				alert("Error de conexión");
			}
		});
	}

	var teclaNombreUsuario = function(tecla)
	{
		if(tecla.which == 13) //Enter
		{
			mostrarDatosUsuario();
		}		
	}


	var EliminaUsuario = function()
	{
		var u = $("#txtNombreUsuario").val();
		var parametros = "opc=EliminaUsuario"+"&usuario="+u+"&id="+Math.random();
		$.ajax({
			cache: false,
			url: "data/funciones.php",
			type: "POST",
			dataType: "json",
			data:parametros,
			success: function(response){
				if(response.respuesta == true)
				{
					alert("El usuario ha sido dado de baja");
					$("#altaUsuarios > input").val("");
				}
			},
			error: function(xhr,ajaxOption,x){

			}
		});
	}

	//Configuramos los eventos.
	$("#btnEntrar").on("click",validaUsuario);
	$("#btnInicio").on("click",traeInicio);
	$("#btnEntregas").on("click", traeEntregas);
	$("#txtUsuario").on("keypress",teclaUsuario);
	$("#txtClave").on("keypress",teclaClave);
	$("#btnDivUsuarios").on("click",DivUsuarios);
	$("#btnDivBanco").on("click",traeBanco);
	$("#btnGuardaUsuario").on("click",GuardaUsuario);
	$("#txtNombreUsuario").on("keypress",teclaNombreUsuario);
	$("#btnDivDocumentacion").on("click",traeDocumentacion);
	$("#btnEliminaUsuario").on("click",EliminaUsuario);


	// Nuevas Acciones

	$("#btnIngresar").on("click",Ingresar);



}
$(document).on("ready",inicio);












