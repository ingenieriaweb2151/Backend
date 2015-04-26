<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Uso de Bootstrap</title>
	<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/eventos.js"></script>
</head>
<body>
	<header>
		<div class="page-header">
		  <h1>Sistema de Residencias<br> <small>Instituto Tecnológico de Culiacán
		  </small></h1>
		</div>
		<nav id="nav1">
			<ul>
				<li>
					<button class="btn btn-default" id="btnInicio">
						<span class="glyphicon glyphicon-home"></span>
						Inicio 
					</button>
				</li>
				<li>
					<button class="btn btn-warning" id="btnDivDocumentacion">
						<span class="glyphicon glyphicon-cloud-download"></span>
						 Documentación
					</button>
				</li>
				<li>
					<button class="btn btn-warning" id="btnDivBanco">
						<span class="glyphicon glyphicon-folder-open"></span>
						Banco de Proyectos
					</button>
				</li>

				<li>
					<button class="btn btn-success" id="btnEntregas">
						<span class="glyphicon glyphicon-inbox"></span>
						Entregas						
					</button>
				</li>

				<li>
					<button class="btn btn-info" id="btnIngresar">
						<span class="glyphicon glyphicon-user"></span>
						Ingresar
					</button>
				</li>
			</ul>
		</nav>

		<!-- <nav id="nav2"> 
			<ul>
				<li>
					<button class="btn btn-default" id="btnInicio">
						<span class="glyphicon glyphicon-home"></span>
						Inicio 
					</button>
				</li>
				<li>
					<button class="btn btn-warning" id="btnDivDocumentacion">
						<span class="glyphicon glyphicon-cloud-download"></span>
						 Documentación
					</button>
				</li>
				<li>
					<button class="btn btn-warning" id="btnDivBanco">
						<span class="glyphicon glyphicon-folder-open"></span>
						Banco de Proyectos
					</button>
				</li>
				<li>
					<button class="btn btn-success" id="btnEntregas">
						<span class="glyphicon glyphicon-inbox"></span>
						Entregas						
					</button>
				</li>
			</ul>
		</nav> -->
	</header>
    
	<div id="informacion"> <br>
		<h4>Fecha de inicio para solicitar residencias profecionales:</h4>
		<h4 id="fecha">XX/XX/XXXX</h4>

		<article id="info1">¿Que son las residencias profecionales? <br> <br>
			<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi illo ratione, ad voluptate sapiente corporis ex libero expedita recusandae fugiat deleniti, dolorem obcaecati corrupti doloremque modi aliquid, velit sunt reiciendis?</span>
		</article>
	</div>

	<div id="banco">
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem modi dolores minima et, iusto repellendus hic ipsa suscipit doloribus ex expedita, amet quasi dicta, fugiat, a commodi iste eveniet dolorem.</p>
	</div>

	<div id="entregas">
		<p> Entregables </p>
	</div>

	<div class="panel panel-primary" id="panelEntrada">
	  <div class="panel-heading">
	    <h3 class="panel-title">Proporcione sus datos</h3>
	  </div>
	  <div class="panel-body" >
	  	<input type="text" id="txtUsuario" class="form-control" placeholder="Usuario" autofocus>
	  	<input type="password" id="txtClave" class="form-control" placeholder="Contraseña">
	  	<button id="btnEntrar" class="btn btn-success btn-lg btn-block">
	  		Entrar
	  		<span class="glyphicon glyphicon-credit-card"></span>
	  	</button>
	  </div>
	</div>
	<div id="datosUsuarios">
		<img src="" alt="">
		<h1></h1>
		<h2></h2>
	</div>

	<div id="documentacion">
		<h2>Catálogo de Usuarios</h2>
		<input type="text" id="txtNombreUsuario" class="form-control" placeholder="Nombre de Usuario">
		<input type="text" id="txtNombre" class="form-control" placeholder="Nombre">
		<input type="text" id="txtApellido" class="form-control" placeholder="Apellido">
		<input type="text" id="txtTipoUsuario" class="form-control" placeholder="Tipo Usuario (0=Normal,1=Administrador)">
		<input type="text" id="txtEstatus" class="form-control" placeholder="Estatus (V=Vigente,B=Baja)">
		<input type="password" id="txtClaveUsuario" class="form-control" placeholder="Contraseña">
		<input type="password" id="txtRepiteClave" class="form-control" placeholder="Repite Contraseña">
		<button id="btnGuardaUsuario" class="btn btn-success btn-lg btn-block">
			Guardar 
			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">	
			</span>
		</button>
		<button id="btnEliminaUsuario" class="btn btn-danger btn-lg btn-block">
			Eliminar 
			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">	
			</span>
		</button>
	</div>

	<footer>
		<small>
			DR &copy; Programación Web 2014.
		</small>
	</footer>
</body>
</html>

