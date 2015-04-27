<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Instituto Tecnológico de Culiacán - Residencias Profesionales</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/eventos.js"></script>
</head>
<body>
<header>
    <div class="page-header">
        <h1>Sistema de Residencias Profesionales<br> <small>Instituto Tecnológico de Culiacán
            </small></h1>
        <h id="tusuario" class="usuarios"></h> <h id="usuario" class="usuarios"></h>
        <img src="img/logoitc.png" id="logotec">
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
                <button class="btn btn-info" id="btnDivDocumentacion">
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
                <button class="btn btn-danger" id="btnEntregas">
                    <span class="glyphicon glyphicon-inbox"></span>
                    Entregas
                </button>
            </li>

            <li>
                <button class="btn btn-primary" id="btnIngresar">
                    <span class="glyphicon glyphicon-user"></span>
                    Ingresar
                </button>
            </li>
        </ul>
    </nav>
</header>

<div id="informacion" class="jumbotron">
    <h2 id="rp">RESIDENCIAS PROFESIONALES</h2>
    <h4> Fecha de inicio para solicitar residencias profesionales:<small id="fecha"> XX/XX/XXXX </ small> </ h4>
    <br><br>
    <img id="imgInicio" class= "img-rounded" src="img/residencias.png"> <br><br>
    <section id="seccionInfo">
        <article>

            <img id="imgMini" class= "img-rounded" src="img/residencias3.png">
            <div class="caption">
                <h3>¿Qué son las Residencias Profesionales?</h3>
                <p>Se concibe la residencia profesional como una estrategia educativa, con carácter curricular, que permite al estudiante, aun estando en proceso de formación, incorporarse profesionalmente a los sectores productivos de bienes y servicios, a través del desarrollo de un proyecto, asesorado por instancias académicas e instancias externas.
                    <br>
                    El desarrollo de la residencia profesional puede representar una forma de transitar entre la teoría y la práctica.</p>
                <p><button class="btn btn-primary"role="button">Leer más</button>
            </div>
            </p>
        </article>
        <article>
            <img id="imgMini" class= "img-rounded" src="img/requisitos.png">
            <div class="caption ">
                <h3>¿Cuales son los Requisitos?</h3>
                <div class="comentario">
                    <p>El alumno que ha cubierto el 75% del total de sus créditos puede solicitar la realización de sus Residencias Profesionales mediante los siguientes mecanismos: <br>

                        A través de su selección en el banco de proyectos de la coordinación respectiva.
                        Proponiendo su propio tema directamente a la División de Estudios Profesionales, la que turnara al Departamento Académico para su análisis,
                        Presentando a la División de Estudios Profesionales su situación como trabajador de alguna empresa, para que se dictamine la correspondencia entre las actividades que realiza y las de un proyecto de Residencias Profesionales.
                        En los casos en que el alumno propone su propio proyecto o somete a consideración su situación como trabajador es conveniente que su propuesta de proyecto de Residencias Profesionales con tenga la siguiente información:
                        <br>
                        Nombre y objetivo del proyecto. <br>
                        Cronograma preliminar de actividades. <br>
                        Descripción detallada de las actividades. <br>
                        Lugar donde se realizará el proyecto. <br>
                        Información de la empresa o institución donde se desarrollara el trabajo.</p> </div>
                <p><button class="btn btn-primary"role="button">Leer más</button></p>
            </div>

        </article>
        <article>
            <img id="imgMini" class= "img-rounded" src="img/residencias1.png">
            <div class ="caption">
                <h3>Asignación y Acreditación de las residencias profesionales</h3>
                <p>
                    La oportunidad de asignación de proyecto de residencia será única para cada estudiante y la participación en un mismo proyecto podrá ser individual, grupal o multidisciplinaria, dependiendo de las características del propio proyecto. <br>
                    La participación simultanea de varios residentes en un mismo proyecto se justificara únicamente cuando se asegure que las actividades de cada residente se desarrollen entre los limites de 4 a 6 meses de duración y 640 horas acumuladas.  <br>
                    A solicitud del candidato a residente, el departamento de servicios escolares, a través de la oficina de control escolar, le extenderá una constancia de su situación académica, en la que se defina si ha aprobado al menos el 75% de los créditos de su plan de estudios y si es alumno regular.
                    Una vez aprobado el proyecto de residencia profesional el alumno deberá sustentar entrevistas con asesores internos y externos para determinar los horarios definitivos de actividades.
                    El jefe de la división de estudios profesionales, previo aval de la academia autorizará una segunda asignación de proyecto para el mismo estudiante únicamente cuando por circunstancias especiales tales como: huelgas, quiebras, cierre de empresas, enfermedades, cambios de políticas empresariales, etc., haya tenido como consecuencias el truncamiento del proyecto.
                <p><button class="btn btn-primary"role="button">Leer más</button>
            </div>
            </p>
        </article>
    </section>
</div>

<div id="banco">
    <!-- <div class="container"> -->
    <h3>Banco de Proyectos</h3>
    <table class="table table-striped table-hover">
        <tr class="warning">
            <th>Nombre Empresa</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Encargado</th>
            <th>Nombre del Proyecto</th>
            <th>Carrera</th>
            <th>Cupos</th>
            <th>Validar</th>
        </tr>
    </table>
    <button class="btn btn-success" id="btnRegistrar">
        <span class="glyphicon glyphicon-home"></span>
        Registrar Proyecto
    </button>
</div>

<div id="altaProyectos">
    <h2>Registrar Proyecto</h2>
    <input type="text" id="txtNombreEmpresa" class="form-control" placeholder="Nombre de la Empresa">
    <input type="text" id="txtDireccion" class="form-control" placeholder="Direccion">
    <input type="text" id="txtTelefono" class="form-control" placeholder="Telefono">
    <input type="text" id="txtEncargado" class="form-control" placeholder="Encargago">
    <input type="text" id="txtNombreProyecto" class="form-control" placeholder="Nombre del Proyecto">
    <input type="password" id="txtCarrrera" class="form-control" placeholder="Carrera">
    <input type="password" id="txtCupos" class="form-control" placeholder="Cupos Disponibles">
    <button id="btnGuardaProyecto" class="btn btn-success btn-lg btn-block">
        Guardar
			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
			</span>
    </button>
    <button id="btnEliminaProyecto" class="btn btn-danger btn-lg btn-block">
        Eliminar
			<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
			</span>
    </button>
</div>

    <div class="panel panel-primary" id="panelEntrada">
        <div class="panel-heading">
            <h3 class="panel-title">Proporcione sus datos</h3>
        </div>
        <div class="panel-body" >
            <select>
                <option value="1">Alumno</option>
                <option value="2">Maestro</option>
                <option value="3">Administrativo</option>
                <option value="4">Asesor Externo</option>
            </select><br/>
            <input type="text" id="txtUsuario" class="form-control" placeholder="Usuario" autofocus>
            <input type="password" id="txtClave" class="form-control" placeholder="Contraseña">
            <button id="btnEntrar" class="btn btn-success btn-lg btn-block">
                Entrar
                <span class="glyphicon glyphicon-log-out"></span>
            </button>

        </div>
    </div>
<!-- <div class="panel panel-primary" id="panelEntrada">
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
</div> -->
<div id="datosUsuarios">
    <img src="" alt="">
    <h1></h1>
    <h2></h2>
</div>

<div id="documentacion" class="jumbotron">

    <section id="seccionlinks">
        <article id="AmbosPlanes">
            <h2 id="docsAmbos">AMBOS PLANES</h2>
            <h2 id="docsGenerales">Documentos Generales</h2>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/06/ITC-AC-PO-007-01-Formato-para-Solicitud-de-Residencias-Profesionales.doc">1. Solicitud de Residencias Profesionales.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/10/ITC-AC-PO-007-02-Formato-para-Asignaci%C3%B3n-de-Asesor-Interno-de-Residencias-Profesionales..doc">2. Asignación de Asesor Interno de Residencias Profesionales.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-PO-007-04-Formato-para-Dictamen-de-Anteproyectos-de-Residencias-Profesionales2.doc">3. Dictamen de Anteproyectos de Residencias Profesionales.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/06/ITC-AC-PO-007-05-Formato-para-Seguimiento-de-Proyecto-de-Residencias-Profesionales-rev-2.doc">4. NUEVA REV 2 Seguimiento de Proyecto de Residencias Profesionales.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/08/ITC-AC-FE-001-Formato-de-anteproyecto-de-residencias-profesionales.docx">5. Anteproyecto de Residencias Profesionales.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-FE-002-Formato-Electr%C3%B3nico-de-Resumen-Ejecutivo-de-Residencias-Profesionales2.docx">6. Resumen Ejecutivo Electrónico de Residencias Profesionales.</a><br>
        </article>

        <article id="PlanViejo">
            <h2>Plan 2004 - 2005</h2>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/06/ITC-AC-PO-007-03-Formato-de-la-Carta-de-Presentaci%C3%B3n-rev-2.docx">1. NUEVO REV 2 Carta de Presentación.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/09/ITC-AC-PO-007-06-Formato-para-Asignaci%C3%B3n-de-Revisor-de-Residencias-Profesionales.doc">2. Asignación de Revisor de Residencias Profesionales (Plan 2004-2005).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-PO-007-07-Evaluaci%C3%B3n-del-proyecto-de-residencias-profesionales2.doc">3. Evaluación del Proyecto de Residencias Profesionales(Plan 2004-2005).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/10/ITC-AC-PO-007-09-Formato-para-constancia-de-liberaci%C3%B3n-y-evaluaci%C3%B3n-de-las-residencias-pr.doc">4. Constancia de Liberación y Evaluación de las Residencias Profesionales (Plan 2004-2005).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-PO-007-ANEXO-1-Estructura-del-informe-t%C3%A9cnico-Plan-2004-20052.docx">5. Estructura de Informe Técnico (Plan 2004-2005).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-PO-007-ANEXO-3-Actividades-del-asesor-interno-para-el-proyecto-de-residencia-profesional-Plan-2004-20052.docx">6. Actividades del Asesor interno para el proyecto de Residencias Profesionales (Plan 2004-2005).</a><br>

        </article>

        <article id="PlanNuevo">
            <h2>Plan 2009 - 2010 COMPETENCIAS</h2>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/06/ITC-AC-PO-007-11-Formato-de-la-Carta-de-Presentaci%C3%B3n-rev-1.docx">1. NUEVO REV 1 Carta de Presentación.</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/09/ITC-AC-PO-007-08-Formato-de-Registro-para-Asesorias..docx">2. Registro para Asesorías (Plan 2009-2010).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2014/09/ITC-AC-PO-007-10-Formato-para-Evaluaci%C3%B3n-del-proyecto-de-residencias-profesionales.docx">3. Evaluación del Proyecto de Residencias Profesionales (Plan de Estudios 2009-2010).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-PO-007-ANEXO-2-Estructura-del-informe-t%C3%A9cnico-Plan-2009-200102.docx">4. Estructura de Informe Técnico (Plan 2009-2010).</a><br>
            <a href="http://itculiacan.edu.mx/wp-content/uploads/2013/07/ITC-AC-PO-007-ANEXO-4-Actividades-del-asesor-interno-para-el-proyecto-de-residencia-profesional-Plan-2009-20102.docx">5. Actividades del asesor interno para el proyecto de Residencias Profesional (Plan 2009-2010).</a><br>
        </article>
    </section>

</div>

<div id="entregas">
    <div id="proyectosbox">
        <p> Seleccionar proyecto a revisión: </p>
        <select>
            <!-- <option value="1">Alumno</option>
             <option value="2">Maestro</option>
             <option value="3">Administrativo</option>
             <option value="4">Asesor Externo</option> -->
        </select>
    </div>
    <div id="tablaEntregables">
        <table class="table table-striped table-hover">
            <tr class="warning">
                <th>Nombre Formato</th>
                <th>Fecha Entrega</th>
                <th>Nombre Asesor</th>
                <th>Archivo Alumno</th>
                <th>Revisión</th>
                <th>Comentarios</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <input type="file" name="archivo" id="archivo" />
                </td>
                <td>
                    <select>
                        <option value="1">Pendiente</option>
                        <option value="2">Rechazado</option>
                        <option value="3">Aceptado</option>
                    </select>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

<footer>
    <small>
        DR &copy; Ingeniería Web 2015.
    </small>
</footer>
</body>
</html>






