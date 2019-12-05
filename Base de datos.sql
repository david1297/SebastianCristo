CREATE TABLE `citas` (
  `Numero` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Hora` time DEFAULT NULL,
  `Cliente` varchar(50) DEFAULT NULL,
  `Usuario` varchar(30) DEFAULT NULL,
  `Descripcion` varchar(10000) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE `ciudades` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Departamento` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `Departamento` (`Departamento`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`Departamento`) REFERENCES `departamentos` (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=1128 DEFAULT CHARSET=latin1;
CREATE TABLE `clientes` (
  `Documento` varchar(50) NOT NULL,
  `Tipo_Documento` varchar(45) DEFAULT NULL,
  `Tipo_Persona` varchar(45) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Ciudad` int(11) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `departamentos` (
  `Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;