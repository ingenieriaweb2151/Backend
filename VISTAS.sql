-- VISTAS:

-- Vista para el Banco de Proyectos

use residencias;

-- Vista para ver el banco de proyectos
 create view BancoProy as (
 select p.cveproy, e.nombre as 'Nombre de la empresa', e.domicil as 'Domicilio', e.telef as 'Telefono', p.nomresp as 'Nombre del responsable', p.nombre as 'Nombre del proyecto',c.carnom as 'Carrera', p.numresi as 'cupos'
 from empresas e, proyectos p, dcarre c
 where e.cveempr = p.cveempr and p.carcve = c.carcve);
 

 -- Vista para buscar a los alumnos que cargaron recidencias 
 create view buscarmat as (
 select dl.aluctr  
 from dlista dl, dalumn da, dmater dm
 where dl.aluctr=da.aluctr and dl.matcve = dm.matcve and dm.matnom like '%RESIDEN%');
 
 -- Vista para ver las solicitudes pendientes
 create view solPendientes as(
 Select a.aluctr, a.alunom, a.aluapp as apealumn, a.aluapm, p.nombre as nombreproy,
 p.cveproy, e.nombre as nombreempr, e.cveempr,s.pdocve from dalumn a, proyectos p, 
 solicitudes s, empresas e WHERE a.aluctr = s.aluctr and p.cveproy = s.cveproy and 
 e.cveempr = p.cveempr);
 
 -- VISTA DE LOS PROYECTOS ASIGNADOS AL ALUMNO Y ASESOR
 
create view proyAsignado as(
Select ap.aluctr, a.alunom, a.aluapp as apealumn, a.aluapm, p.nombre as nombreproy, p.cveproy,
 e.nombre as nombreempr, e.cveempr, dp.pernom, dp.perape, dp.percve 
 from dalumn a, proyectos p,
 asignproyectos ap, empresas e, dperso dp, asignaseinternos ai 
 WHERE a.aluctr = ap.aluctr and p.cveproy = ap.cveproy and ai.cveproy = p.cveproy and e.cveempr = ap.cveempr and ai.percve = dp.percve and ai.aluctr = ap.aluctr);
 -- VISTA PARA BUSCAR A LOS POSIBLES ASESORES PARA ASIGNAR A LOS ALUMNOS DEPENDIENDO LA CARRERA
create view buscarAsesores as(
SELECT s.aluctr, dc.carcve, dp.percve, dcar.depcve, dcar.carnom, dp.pernom, dp.perape 
FROM solicitudes s, dcarre dcar, dperso dp, dcalum dc 
WHERE s.aluctr = dc.aluctr and dc.carcve = dcar.carcve and dcar.depcve = dp.perdepa
    and not (dp.pernom = '.'));
    
-- VISTA PARA BUSCAR SOLO AL PERSONAL QUE PERTENECE AL DEPARTAMENTO DE VINCULACION
create view buscaVinculacion as (select dp.percve, dp.pernom, dp.perape, dp.perdep, dp.perpas, dd.depcve
from dperso dp, ddepto dd 
where dp.perdep = dd.depcve and dp.perdep = 111);

-- VISTA PARA BUSCAR SOLO AL PERSONAL QUE PERTENECE AL DEPARTAMENTO DE DIVICION DE ESTUDIOS PROFECIONALES

create view buscaDivestPro as (select dp.percve, dp.pernom, dp.perape, dp.perdep, dp.perpas, dd.depcve
from dperso dp, ddepto dd 
where dp.perdep = dd.depcve and dp.perdep = 401);

-- VISTA PARA BUSCAR SOLO A LOS MAESTROS QUE ESTAN ASIGNADOS A UNO O MAS PROYECTOS
create view maestroAsesor as (
select dp.pernom, dp.perape, dp.perdepa, dp.percve, dp.perpas 
from dperso dp, asignaseinternos ai
 where dp.percve = ai.percve);