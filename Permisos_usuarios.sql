-- CREACION DEL USUARIO "alumno"

CREATE USER 'alumno'@'localhost';GRANT SELECT, INSERT, UPDATE ON *.* TO 'alumno'@'localhost' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `residenciasitc`.* TO 'alumno'@'localhost';

-- USUARIO "alumno": Tiene permiso de solo realizar la consulta SELECT en la tabla dalumn

GRANT SELECT ON `residenciasitc`.`dalumn` TO 'alumno'@'localhost';

CREATE USER 'divestpro'@'localhost';GRANT SELECT, INSERT, UPDATE, DELETE, SHOW VIEW ON *.* TO 'divestpro'@'localhost' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `residenciasitc`.* TO 'divestpro'@'localhost';


CREATE USER 'asesor'@'localhost';GRANT SELECT, INSERT, UPDATE ON *.* TO 'asesor'@'localhost' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `residenciasitc`.* TO 'asesor'@'localhost';

-- -------------------****************************---------------------------------


