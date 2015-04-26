-- create database residencias;
use residencias;
-- select * from alureg where aluctr = 1151006;
CREATE TABLE IF NOT EXISTS `dalumn` (
  `aluctr` varchar(9) NOT NULL,
  `aluapp` varchar(30) NOT NULL,
  `aluapm` varchar(30) NOT NULL,
  `alunom` varchar(30) NOT NULL,
  `alusex` int(19) NOT NULL,
  `alunac` date NOT NULL,
  `alulna` int(10) NOT NULL,
  `alurfc` varchar(10) NOT NULL,
  `alucur` varchar(10) NOT NULL,
  `aluesc` int(10) NOT NULL,
  `aluescpd` int(10) NOT NULL,
  `aluescpa` int(10) NOT NULL,
  `aluegr` int(20) NOT NULL,
  `aluare` int(20) NOT NULL,
  `aluescp` int(20) NOT NULL,
  `alucll` varchar(30) NOT NULL,
  `alunum` int(20) NOT NULL,
  `alucol` varchar(30) NOT NULL,
  `alucpo` int(20) NOT NULL,
  `alumun` int(30) NOT NULL,
  `aluciu` varchar(30) NOT NULL,
  `alute1` int(20) NOT NULL,
  `alute2` int(20) NOT NULL,
  `alumai` varchar(20) NOT NULL,
  `alusme` int(20) NOT NULL,
  `alusmei` int(20) NOT NULL,
  `alusmea` int(20) NOT NULL,
  `alutsa` int(20) NOT NULL,
  `alueci` int(20) NOT NULL,
  `alupad` int(20) NOT NULL,
  `alumad` int(20) NOT NULL,
  `alupadv` varchar(20) NOT NULL,
  `alumadv` varchar(20) NOT NULL,
  `alupadt` int(20) NOT NULL,
  `alumadt` int(20) NOT NULL,
  `alutno` varchar(30) NOT NULL,
  `alutcl` int(20) NOT NULL,
  `alutnu` int(20) NOT NULL,
  `alutco` int(20) NOT NULL,
  `alutcp` int(20) NOT NULL,
  `alutmu` int(20) NOT NULL,
  `alutci` int(20) NOT NULL,
  `alutte1` int(20) NOT NULL,
  `alutte2` int(20) NOT NULL,
  `alutmai` int(20) NOT NULL,
  `alufac` int(20) NOT NULL,
  `alutwi` int(20) NOT NULL,
  `alutce` int(20) NOT NULL,
  `alutra` int(20) NOT NULL,
  `alupas` varchar(20) NOT NULL,
  `alupasc` varchar(30) COLLATE utf8_bin NOT NULL,
  `aluseg` int(20) NOT NULL,
  `alulexp` int(20) NOT NULL,
  `alulemp` int(20) NOT NULL,
  `alulare` int(20) NOT NULL,
  `alulfde` date NOT NULL,
  `alulfha` date NOT NULL,
  `tbecve` int(20) NOT NULL,
  `aluest` int(20) NOT NULL,
  `alupes` int(20) NOT NULL,
  `gincve` int(20) NOT NULL,
  `lincve` int(20) NOT NULL,
  `aluoest` int(20) NOT NULL,
  `aluotra` int(20) NOT NULL,
  `alutinl` int(20) NOT NULL,
  `alutpot` int(20) NOT NULL,
  `alutsec` int(20) NOT NULL,
  `aluteotr` int(20) NOT NULL,
  `alutecll` int(20) NOT NULL,
  `alutenum` int(20) NOT NULL,
  `alutecol` int(20) NOT NULL,
  `aluteciu` int(20) NOT NULL,
  `alutecpo` int(20) NOT NULL,
  `alutemun` int(20) NOT NULL,
  `alutetel` int(20) NOT NULL,
  `alutepto` int(20) NOT NULL,
  `aluteanp` date NOT NULL,
  `aluteing` int(20) NOT NULL,
  `alupexani` int(20) NOT NULL,
  `alupegel` int(20) NOT NULL,
  `aluptoefl` int(20) NOT NULL,
  `discve` int(20) NOT NULL,
  PRIMARY KEY (`aluctr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `dperso` (
  `percve` varchar(10) NOT NULL,
  `perape` varchar(30) NOT NULL,
  `pernom` varchar(30) NOT NULL,
  `persig` varchar(15) NOT NULL,
  `pertar` int(10) NOT NULL,
  `perrfc` varchar(30) NOT NULL,
  `percur` varchar(30) NOT NULL,
  `pernac` varchar(30) NOT NULL,
  `perdep` int(10) NOT NULL,
  `perdepa` int(10) NOT NULL,
  `perlna` int(10) NOT NULL,
  `persex` varchar(10) NOT NULL,
  `pereci` int(10) NOT NULL,
  `perdec` int(10) NOT NULL,
  `percmi` varchar(10) NOT NULL,
  `perdcl` varchar(20) NOT NULL,
  `perdnu` int(10) NOT NULL,
  `perdcp` int(10) NOT NULL,
  `perdco` varchar(50) NOT NULL,
  `perdmu` int(10) NOT NULL,
  `perdlo` varchar(30) NOT NULL,
  `perdte1` varchar(30)  NOT NULL,
  `perdte2` varchar(30)  NOT NULL,
  `pernot` varchar(20) NOT NULL,
  `pernte1` varchar(20)  NOT NULL,
  `perdvi` varchar(3)  NOT NULL,
  `perdce` varchar(40) NOT NULL,
  `peragf` varchar(30) NOT NULL,
  `perase` varchar(30) NOT NULL,
  `perara` varchar(30) NOT NULL,
  `peroct1` varchar(10) NOT NULL,
  `peroct1h` int(10) NOT NULL,
  `peroct2` varchar(10) NOT NULL,
  `peroct2h` int(10) NOT NULL,
  `perinv` varchar(10)  NOT NULL,
  `perinvo` varchar(10) NOT NULL,
  `perinvd` varchar(10) NOT NULL,
  `perinva` varchar(10) NOT NULL,
  `percom` int(10) NOT NULL,
  `percomo` varchar(10) NOT NULL,
  `percomd` varchar(10) NOT NULL,
  `percoma` varchar(10) NOT NULL,
  `persit` int(5) NOT NULL,
  `perins` varchar(5) NOT NULL,
  `perinsp` varchar(20) NOT NULL,
  `perfun` int(5) NOT NULL,
  `perpro` int(5) NOT NULL,
  `perpme` int(5) NOT NULL,
  `peridi` int(5) NOT NULL,
  `perpas` varchar(20) NOT NULL,
  `perpasc` varchar(20) NOT NULL,
  PRIMARY KEY (`percve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dperio` (
  `pdocve` varchar(4)  NOT NULL,
  `pdoini` varchar(30) NOT NULL,
  `pdoter` varchar(30) NOT NULL,
  `pdodes` varchar(30)  NOT NULL,
  `pdonum` int(11) NOT NULL,
  `pdoiniv` varchar(30)  NOT NULL,
  `pdoterv` varchar(30)  NOT NULL,
  `pdored` varchar(10)  NOT NULL,
  `pdormato` varchar(10)  NOT NULL,
  `pdorof` varchar(10)  NOT NULL,
  `pdoroe` varchar(10)  NOT NULL,
  `pdornpt` int(11) NOT NULL,
  `pdormm` int(11) NOT NULL,
  `pdoend` varchar(10)  NOT NULL,
  `pdoentp` int(11) NOT NULL,
  `pdoept` varchar(5)  NOT NULL,
  `pdoemm` int(11) NOT NULL,
  `pdosiscobd` varchar(30) DEFAULT NULL,
  `pdocta1` varchar(30) DEFAULT NULL,
  `pdocta2` varchar(30) DEFAULT NULL,
  `pdocta` varchar(30) DEFAULT NULL,
  `pdoimp1` int(11) NOT NULL,
  `pdoimp2` int(11) NOT NULL,
  `pdofeclim` varchar(30)  NOT NULL,
  `pdodod` varchar(10) NOT NULL,
  `pdofic` varchar(10) NOT NULL,
  `pdopcpro` varchar(30) NOT NULL,
  `pdopcpa1` varchar(30) NOT NULL,
  `pdopcpa2` varchar(30) NOT NULL,
  `pdopcpa3` varchar(30) NOT NULL,
  `pdopcfin` varchar(30) NOT NULL,
  `pdopa1` varchar(30) NOT NULL,
  `pdopa2` varchar(30) NOT NULL,
  `pdopa3` varchar(30) NOT NULL,
  `pdopa4` varchar(30) NOT NULL,
  `pdopa5` varchar(30) NOT NULL,
  `pdopa6` varchar(30) NOT NULL,
  `pdopa7` varchar(30) NOT NULL,
  `pdopa8` varchar(30) NOT NULL,
  `pdopa9` varchar(30) NOT NULL,
  `pdopcspa1` int(11) NOT NULL,
  `pdopcspa2` int(11) NOT NULL,
  `pdopcspa3` int(11) NOT NULL,
  `pdopcsfin` int(11) NOT NULL,
  `pdodatp` varchar(10) NOT NULL,
  `pdosdatp` varchar(10) NOT NULL,
  PRIMARY KEY (`pdocve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dcarre` (
  `carcve` int(2) PRIMARY KEY NOT NULL,
  `extcve` int(2) NOT NULL,
  `carnom` varchar(80) NOT NULL,
  `carnco` varchar(20) NOT NULL,
  `carlet` varchar(20) NOT NULL,
  `carniv` int(11) NOT NULL,
  `carfin` varchar(20)  NOT NULL,
  `carfte` varchar(20)  NOT NULL,
  `carsit` int(11) NOT NULL,
  `carmod` int(11) NOT NULL,
  `carpmo` int(11) NOT NULL,
  `carhcr` varchar(4) NOT NULL,
  `cardem` date,
  `cardemp` varchar(4) NOT NULL,
  `depcve` varchar(6) NOT NULL,
  `cve` varchar(30) NOT NULL,
  `dgparea` varchar(30) NOT NULL,
  `dgpsuba` varchar(30) NOT NULL,
  `dgpnivel` varchar(30) NOT NULL,
  `dgpconsec` varchar(30) NOT NULL,
  `puecve` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `dplane` (
  `placve` varchar(1) PRIMARY KEY NOT NULL,
  `placof` varchar(20) NOT NULL, 
  `carcve` int(2) NOT NULL, -- clave de la carrera (foreign key)
  `plaret` int(3) NOT NULL,
  `plamod` int(3) NOT NULL,
  `placre` int(3) NOT NULL,
  `plamat` int(2) NOT NULL,
  `planpe` int(2) NOT NULL,
  `planpem` int(2) NOT NULL,
  `plafin` date NOT NULL,
  `plafte` date NOT NULL,
  `plasit` int(1) NOT NULL,
  `plaper` int(1) NOT NULL,
  `plasis` int(1) NOT NULL,
  `placma` int(2) NOT NULL,
  `plac1r` int(2) NOT NULL,
  `placm1` int(2) NOT NULL,
  `placmi` int(2) NOT NULL,
  `saccve` int(1) NOT NULL,
  `placmip` int(2) NOT NULL,
  `placmif` int(2) NOT NULL,
   FOREIGN KEY (`carcve`) REFERENCES `dcarre` (`carcve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `dcalum` (
  `aluctr`  varchar(9) NOT NULL,
  `carcve` int(2) NOT NULL, -- tambien es llave primaria???
  `placve` varchar(1) NOT NULL,
  `espcve` varchar(1) NOT NULL,
  `caling` varchar(4) NOT NULL,
  `calter` varchar(4) NOT NULL,
  `calsit` varchar(1) NOT NULL,
  `calnpe` int(2) NOT NULL,
  `calgpo` varchar(1) NOT NULL,
  `calcac` int(5) NOT NULL,
  `calnpec` int(2) NOT NULL,
  `calobs` varchar(80) NOT NULL,
  `caltcala` int(6) NOT NULL,
  `caltcalr` int(6) NOT NULL,
  `calmata` int(2) NOT NULL,
  `calmat` int(2) NOT NULL,
  `calmatac` int(2) NOT NULL,
  `calpri` varchar(1) NOT NULL,
  `calnpep` int(2) NOT NULL,
  `peerson` varchar(30) NOT NULL,
  PRIMARY KEY (`aluctr`,`carcve`),
  FOREIGN KEY(`aluctr`) REFERENCES `dalumn` (`aluctr`),
  FOREIGN KEY(`carcve`) REFERENCES `dcarre` (`carcve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `ddepto` (
  `depcve` varchar(3) NOT NULL DEFAULT '',
  `depnom` varchar(60) NOT NULL DEFAULT '',
  `depnco` varchar(20)  DEFAULT NULL,
  `depdep` varchar(3)  NOT NULL,
  `percve` varchar(10) NOT NULL,
  `cve` int(11) NOT NULL,
  `qucho` int(11) NOT NULL,
  PRIMARY KEY (`depnom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `empresas` (
  `cveempr` char(9) NOT NULL,
  `nombre` char(85) NOT NULL,
  `giro` int(1) NOT NULL,
  `rfc` char(13) NOT NULL,
  `domicil` char(30) NOT NULL,
  `domnum` char(10) NOT NULL,
  `colonia` char(20) NOT NULL,
  `ciudad` char(20) NOT NULL,
  `cp` int(5) NOT NULL,
  `telef` char(13) NOT NULL,
  `ext` char(13) NOT NULL,
  `fax` char(13) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL,
  `valores` text NOT NULL,
  `organig` text NOT NULL,
  `nomtitu` char(85) NOT NULL,
  `puetitu` char(85) NOT NULL,
  `nompmj` char(85) NOT NULL,
  `puepmj` char(85) NOT NULL,
  `nompdcp` char(85) NOT NULL,
  `puepdcp` char(85) NOT NULL,
  `logo` text NOT NULL,
  PRIMARY KEY (`cveempr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `proyectos` (
  `cveproy` char(9) PRIMARY KEY NOT NULL,
  `cveempr` char(9) NOT NULL,
  `pdocve` varchar(4) NOT NULL,
  `carcve` int(2) NOT NULL,
  `nombre` char(150) NOT NULL,
  `numresi` int(2) NOT NULL,
  `opcion` int(1) NOT NULL,
  `objetiv` text NOT NULL,
  `justifi` text NOT NULL,
  `nomresp` char(85) NOT NULL,
  `pueresp` char(85) NOT NULL,
  `nomaext` char(85) NOT NULL,
  `pueaext` char(85) NOT NULL,
  `nomaeee` char(85) NOT NULL,
  `pueaeee` char(85) NOT NULL,
  `fecrevi` date DEFAULT NULL,
  FOREIGN KEY (`cveempr`) REFERENCES `empresas` (`cveempr`),
  FOREIGN KEY (`pdocve`) REFERENCES `dperio` (`pdocve`),
  FOREIGN KEY (`carcve`) REFERENCES `dcarre` (`carcve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `asignproyectos` (
  `pdocve` varchar(4) NOT NULL,
  `aluctr` varchar(9) NOT NULL,
  `cveproy` char(9) NOT NULL,
  `cveempr` char(9) NOT NULL,
  PRIMARY KEY (`pdocve`, `aluctr`,cveproy),
  FOREIGN KEY (`pdocve`) REFERENCES `dperio` (`pdocve`),
  FOREIGN KEY (`aluctr`) REFERENCES `dalumn` (`aluctr`),
  FOREIGN KEY (`cveproy`) REFERENCES `proyectos` (`cveproy`),
  FOREIGN KEY (`cveempr`) REFERENCES `empresas` (`cveempr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `asignaseinternos` (
  `pdocve` varchar(4) NOT NULL,
  `percve` varchar(10) NOT NULL,
  `cveproy` char(9) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`pdocve` , `percve`,`cveproy`),
  FOREIGN KEY (`pdocve` ) REFERENCES `dperio` (`pdocve` ),
  FOREIGN KEY (`percve`) REFERENCES `dperso` (`percve`),
  FOREIGN KEY (`cveproy`) REFERENCES `proyectos` (`cveproy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS formatos (
	forcve INT(2) NOT NULL,
    fornom VARCHAR (100) NOT NULL,
    PRIMARY KEY (forcve)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS proyalumfor(
	pafcve INT NOT NULL,
	forcve INT (2) NOT NULL,
    aluctr VARCHAR(9) NOT NULL,
    estado INT(1) NOT NULL, -- 
    url    VARCHAR(100) NOT NULL,
    PRIMARY KEY(pafcve),
    FOREIGN KEY (forcve) REFERENCES formatos (forcve),
    FOREIGN KEY (aluctr) REFERENCES asignproyectos (aluctr)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- no se puede

CREATE TABLE IF NOT EXISTS formrev(
	revcve INT NOT NULL,
	forcve INT (2) NOT NULL,
    tipo int(1) NOT NULL,
    PRIMARY KEY (REVCVE),
    FOREIGN KEY (forcve) REFERENCES formatos(forcve)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS solicitudes(
	cvesol int PRIMARY KEY not null,
    `pdocve` varchar(4)  NOT NULL,
    aluctr varchar(9) NOT NULL,
    FOREIGN KEY (pdocve) REFERENCES dperio (pdocve),
    FOREIGN KEY (aluctr) REFERENCES dalumn (aluctr)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `anteproyectos` (
  `pdocve` varchar(4) NOT NULL,
  `aluctr` varchar(9) NOT NULL,
  `cveproy` char(9) NOT NULL,
  `nombre` char(150) NOT NULL,
  `dictame` int(1) NOT NULL,
  `fecdict` date NOT NULL,
  PRIMARY KEY (`pdocve`,`aluctr`,cveproy),
  FOREIGN KEY (`aluctr`) REFERENCES `dalumn` (`aluctr`),
  FOREIGN KEY (`pdocve`) REFERENCES `dperio` (`pdocve`),
  FOREIGN KEY (`cveproy`) REFERENCES `proyectos` (`cveproy`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS alureg(
	aluctr varchar(9) NOT NULL,
    otrocamp varchar(4) NOT NULL,
    PRIMARY KEY (aluctr),
    foreign key (aluctr) references dalumn(aluctr)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;