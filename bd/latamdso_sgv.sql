/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - latamdso_sgv
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`latamdso_sgv` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `latamdso_sgv`;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `IdCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `IdEmpresa` int(11) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `categorias` */

insert  into `categorias`(`IdCategoria`,`IdEmpresa`,`Descripcion`) values 
(1,1,'Pagos');

/*Table structure for table `diarios` */

DROP TABLE IF EXISTS `diarios`;

CREATE TABLE `diarios` (
  `IdDiario` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) DEFAULT NULL,
  `IdEmpresa` int(11) DEFAULT NULL,
  `IdTipoDiario` int(11) DEFAULT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `IdTercero` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Detalle` varchar(1000) DEFAULT NULL,
  `Ingreso` double(12,2) DEFAULT 0.00,
  `Egreso` double(12,2) DEFAULT 0.00,
  `FechaReg` datetime DEFAULT NULL,
  `FechaAt` datetime DEFAULT NULL,
  `IdEstado` int(1) DEFAULT 1,
  PRIMARY KEY (`IdDiario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `diarios` */

insert  into `diarios`(`IdDiario`,`IdUsuario`,`IdEmpresa`,`IdTipoDiario`,`IdCategoria`,`IdTercero`,`Fecha`,`Detalle`,`Ingreso`,`Egreso`,`FechaReg`,`FechaAt`,`IdEstado`) values 
(1,1,1,1,1,1,'2021-02-21','Diario 001',50.05,0.00,'2021-02-21 10:47:11',NULL,1);

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `IdEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Ruc` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `empresas` */

insert  into `empresas`(`IdEmpresa`,`Descripcion`,`Ruc`,`Direccion`,`Telefono`,`Email`) values 
(1,'Empresa 001','9999999999999','Guayaquil','042254455','empresa001@hotmail.com');

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `IdEstado` int(1) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IdEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `estados` */

insert  into `estados`(`IdEstado`,`Estado`) values 
(0,'Inactivo'),
(1,'Activo');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`IdRol`,`Descripcion`) values 
(1,'Administrador'),
(2,'Usuario');

/*Table structure for table `terceros` */

DROP TABLE IF EXISTS `terceros`;

CREATE TABLE `terceros` (
  `IdTercero` int(11) NOT NULL AUTO_INCREMENT,
  `IdTipo` int(11) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Identificacion` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdTercero`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `terceros` */

insert  into `terceros`(`IdTercero`,`IdTipo`,`Nombres`,`Apellidos`,`Identificacion`,`Direccion`,`Telefono`,`Email`) values 
(1,4,'Proveedor 001','Ap Prov 001','10022222222','Guayaquil','11332220','prov@hotmail.com');

/*Table structure for table `tipo_diario` */

DROP TABLE IF EXISTS `tipo_diario`;

CREATE TABLE `tipo_diario` (
  `IdTipoDiario` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdTipoDiario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipo_diario` */

insert  into `tipo_diario`(`IdTipoDiario`,`Descripcion`) values 
(1,'Ingreso'),
(2,'Egreso');

/*Table structure for table `tipo_tro` */

DROP TABLE IF EXISTS `tipo_tro`;

CREATE TABLE `tipo_tro` (
  `IdTipo` int(11) NOT NULL AUTO_INCREMENT,
  `Tercero` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipo_tro` */

insert  into `tipo_tro`(`IdTipo`,`Tercero`) values 
(1,'Empleado'),
(2,'Cliente'),
(3,'Paciente'),
(4,'Proveedor');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `IdEmpresa` int(11) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Clave` varchar(100) DEFAULT NULL,
  `IdEstado` int(1) DEFAULT 1,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`IdUsuario`,`IdEmpresa`,`IdRol`,`Usuario`,`Clave`,`IdEstado`) values 
(1,1,1,'admin','admin',1);

/* Procedure structure for procedure `ACTUALIZA_CATEGORIA` */

/*!50003 DROP PROCEDURE IF EXISTS  `ACTUALIZA_CATEGORIA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZA_CATEGORIA`(
IN XIDCATEGORIA INT(11),
IN XIDEMPRESA INT(11),
IN XDESCRIPCION VARCHAR(100)
)
BEGIN
UPDATE categorias SET IdEmpresa = XIDEMPRESA,Descripcion = XDESCRIPCION
WHERE IdCategoria = XIDCATEGORIA;
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `ACTUALIZA_DIARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `ACTUALIZA_DIARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZA_DIARIO`(
IN XIDDIARIO INT(11),
IN XIDUSUARIO INT(11),
IN XIDEMPRESA INT(11),
IN XIDTIPO INT(11),
IN XIDCATEGORIA INT(11),
IN XIDTERCERO INT(11),
IN XFECHA DATE,
IN XDETALLE VARCHAR(1000),
IN XINGRESO DOUBLE(12,2),
IN XEGRESO DOUBLE(12,2)
)
BEGIN
DECLARE XFECHA_AT DATETIME;
SELECT NOW() INTO XFECHA_AT;
UPDATE diarios SET IdUsuario = XIDUSUARIO,IdEmpresa = XIDEMPRESA,IdTipoDiario = XIDTIPO,IdCategoria = XIDCATEGORIA,
IdTercero = XIDTERCERO,Fecha = XFECHA,Detalle = XDETALLE,Ingreso = XINGRESO,Egreso = XEGRESO,FechaAt = XFECHA_AT
WHERE IdDiario = XIDDIARIO;
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `ACTUALIZA_EMPRESA` */

/*!50003 DROP PROCEDURE IF EXISTS  `ACTUALIZA_EMPRESA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZA_EMPRESA`(
IN XIDEMPRESA INT(11),
IN XDESCRIPCION VARCHAR(100),
IN XRUC VARCHAR(100),
IN XDIRECCION VARCHAR(100),
IN XTELEFONO VARCHAR(100),
IN XEMAIL VARCHAR(100)
)
BEGIN
UPDATE empresas SET Descripcion = XDESCRIPCION,Ruc = XRUC,Direccion = XDIRECCION,Telefono = XTELEFONO,Email = XEMAIL 
WHERE IdEmpresa = XIDEMPRESA;
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `ACTUALIZA_TERCERO` */

/*!50003 DROP PROCEDURE IF EXISTS  `ACTUALIZA_TERCERO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZA_TERCERO`(
IN XIDTERCERO INT(11),
IN XIDTIPO INT(11),
IN XNOMBRES VARCHAR(100),
IN XAPELLIDOS VARCHAR(100),
IN XIDENTIFICACION VARCHAR(100),
IN XDIRECCION VARCHAR(100),
IN XTELEFONO VARCHAR(100),
IN XEMAIL VARCHAR(100)
)
BEGIN
UPDATE terceros SET IdTipo =  XIDTIPO,Nombres = XNOMBRES,Apellidos = XAPELLIDOS,Identificacion = XIDENTIFICACION,
Direccion = XDIRECCION,Telefono = XTELEFONO,Email = XEMAIL
WHERE IdTercero = XIDTERCERO;
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `ACTUALIZA_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `ACTUALIZA_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZA_USUARIO`(
IN XIDUSUARIO INT(11),
IN XIDEMPRESA INT(11),
IN XIDROL INT(11),
IN XUSUARIO VARCHAR(100),
IN XCLAVE VARCHAR (100),
IN XIDESTADO INT(11)
)
BEGIN
UPDATE usuarios SET IdEmpresa = XIDEMPRESA,IdRol = XIDROL,Usuario = XUSUARIO,Clave = XCLAVE,IdEstado = XIDESTADO
WHERE IdUsuario = XIDUSUARIO;
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_CATEGORIA_ADMINISTRADOR` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_CATEGORIA_ADMINISTRADOR` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_CATEGORIA_ADMINISTRADOR`()
BEGIN
SELECT C.IdCategoria,E.Descripcion AS 'Empresa',C.Descripcion
FROM categorias C
INNER JOIN empresas E ON (C.IdEmpresa=E.IdEmpresa);
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_CATEGORIA_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_CATEGORIA_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_CATEGORIA_USUARIO`(
IN XIDEMPRESA INT(11)
)
BEGIN
SELECT IdCategoria,Descripcion FROM categorias
WHERE IdEmpresa=XIDEMPRESA;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_DIARIO_ADMINISTRADOR` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_DIARIO_ADMINISTRADOR` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_DIARIO_ADMINISTRADOR`(
)
BEGIN
SELECT D.IdDiario,T.Descripcion AS 'Tipo',C.Descripcion AS 'Motivo',D.Fecha,D.Detalle,D.Ingreso,D.Egreso,E.Estado FROM diarios D
INNER JOIN tipo_diario T ON (D.IdTipoDiario=T.IdTipoDiario)
INNER JOIN categorias C ON (D.IdCategoria=C.IdCategoria)
INNER JOIN estados E ON (D.IdEstado=E.IdEstado)
WHERE D.IdEstado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_DIARIO_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_DIARIO_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_DIARIO_USUARIO`(
IN XIDEMPRESA INT(11)
)
BEGIN
SELECT D.IdDiario,T.Descripcion AS 'Tipo',C.Descripcion AS 'Motivo',D.Fecha,D.Detalle,D.Ingreso,D.Egreso,E.Estado FROM diarios D
INNER JOIN tipo_diario T ON (D.IdTipoDiario=T.IdTipoDiario)
INNER JOIN categorias C ON (D.IdCategoria=C.IdCategoria)
INNER JOIN estados E ON (D.IdEstado=E.IdEstado)
WHERE D.IdEmpresa = XIDEMPRESA AND D.IdEstado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_EMPRESAS` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_EMPRESAS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_EMPRESAS`(
)
BEGIN
SELECT IdEmpresa,Descripcion,Ruc,Direccion,Telefono,Email FROM empresas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_REPORTE_DIARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_REPORTE_DIARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_REPORTE_DIARIO`(
)
BEGIN
SELECT D.IdDiario,U.Usuario,EM.Descripcion AS 'Empresa',T.Descripcion AS 'Tipo',C.Descripcion AS 'Motivo',CONCAT(TC.Nombres,' ',TC.Apellidos)AS 'Tercero',D.Fecha,D.Detalle,D.Ingreso,D.Egreso,D.FechaReg 
FROM diarios D
INNER JOIN usuarios U ON (D.IdUsuario=U.IdUsuario)
INNER JOIN empresas EM ON (D.IdEmpresa=EM.IdEmpresa)
INNER JOIN tipo_diario T ON (D.IdTipoDiario=T.IdTipoDiario)
INNER JOIN categorias C ON (D.IdCategoria=C.IdCategoria)
INNER JOIN terceros TC ON (D.IdTercero=TC.IdTercero)
INNER JOIN estados E ON (D.IdEstado=E.IdEstado)
WHERE D.IdEstado=1 ORDER BY D.IdDiario ASC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_TERCERO` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_TERCERO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_TERCERO`()
BEGIN
SELECT T.IdTercero,TT.Tercero,T.Nombres,T.Apellidos,T.Identificacion,T.Direccion,T.Telefono,T.Email 
FROM terceros T
INNER JOIN tipo_tro TT ON (T.IdTipo=TT.IdTipo);
END */$$
DELIMITER ;

/* Procedure structure for procedure `CONSULTA_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `CONSULTA_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `CONSULTA_USUARIO`(
)
BEGIN
SELECT U.IdUsuario,EM.Descripcion AS 'Empresa',R.Descripcion AS 'Rol',U.Usuario,U.Clave,ES.Estado
FROM usuarios U
INNER JOIN empresas EM ON (U.IdEmpresa=EM.IdEmpresa)
INNER JOIN roles R ON (U.IdRol=R.IdRol)
INNER JOIN estados ES ON (U.IdEstado=ES.IdEstado);
END */$$
DELIMITER ;

/* Procedure structure for procedure `ELIMINA_DIARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `ELIMINA_DIARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ELIMINA_DIARIO`(
IN XIDDIARIO INT(11)
)
BEGIN
DECLARE XFECHA_AT DATETIME;
SELECT NOW() INTO XFECHA_AT;
UPDATE diarios SET IdEstado = 0,FechaAt = XFECHA_AT
WHERE IdDiario = XIDDIARIO;
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LLENA_COMBO_EMPRESA` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENA_COMBO_EMPRESA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENA_COMBO_EMPRESA`(
)
BEGIN
SELECT IdEmpresa,Descripcion FROM empresas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LLENA_COMBO_ESTADO` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENA_COMBO_ESTADO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENA_COMBO_ESTADO`(
)
BEGIN
SELECT IdEstado,Estado
FROM estados;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LLENA_COMBO_ROL` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENA_COMBO_ROL` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENA_COMBO_ROL`()
BEGIN
SELECT IdRol,Descripcion FROM roles;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LLENA_COMBO_TERCERO` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENA_COMBO_TERCERO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENA_COMBO_TERCERO`(
)
BEGIN
SELECT IdTercero,CONCAT(Nombres,' ',Apellidos) AS 'Tercero' FROM terceros;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LLENA_COMBO_TIPO` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENA_COMBO_TIPO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENA_COMBO_TIPO`(
)
BEGIN
SELECT IdTipoDiario,Descripcion FROM tipo_diario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LLENA_COMBO_TIPO_TERCERO` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENA_COMBO_TIPO_TERCERO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENA_COMBO_TIPO_TERCERO`(
)
BEGIN
SELECT IdTipo,Tercero FROM tipo_tro;
END */$$
DELIMITER ;

/* Procedure structure for procedure `LOGIN_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `LOGIN_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LOGIN_USUARIO`(
IN XUSUARIO VARCHAR(100),
IN XCLAVE VARCHAR(100)
)
BEGIN
SELECT U.IdUsuario,R.IdRol,R.Descripcion AS 'Rol',U.Usuario,U.Clave,EM.IdEmpresa,EM.Descripcion AS 'Empresa' FROM usuarios U
INNER JOIN roles R ON (U.IdRol=R.IdRol)
INNER JOIN empresas EM ON (U.IdEmpresa=EM.IdEmpresa)
WHERE U.Usuario = XUSUARIO AND U.Clave = XCLAVE AND U.IdEstado=1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `REGISTRO_CATEGORIA` */

/*!50003 DROP PROCEDURE IF EXISTS  `REGISTRO_CATEGORIA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRO_CATEGORIA`(
IN XIDEMPRESA INT(11),
IN XDESCRIPCION VARCHAR(100)
)
BEGIN
INSERT INTO categorias (IdEmpresa,Descripcion)
VALUES(XIDEMPRESA,XDESCRIPCION);
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `REGISTRO_DIARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `REGISTRO_DIARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRO_DIARIO`(
IN XIDUSUARIO INT(11),
IN XIDEMPRESA INT(11),
IN XIDTIPO INT(11),
IN XIDCATEGORIA INT(11),
IN XIDTERCERO INT(11),
IN XFECHA DATE,
IN XDETALLE VARCHAR(1000),
IN XINGRESO DOUBLE(12,2),
IN XEGRESO DOUBLE(12,2)
)
BEGIN
DECLARE XFECHAREG DATETIME;
SELECT NOW() INTO XFECHAREG;
INSERT INTO diarios (IdUsuario,IdEmpresa,IdTipoDiario,IdCategoria,IdTercero,Fecha,Detalle,Ingreso,Egreso,FechaReg)
VALUES(XIDUSUARIO,XIDEMPRESA,XIDTIPO,XIDCATEGORIA,XIDTERCERO,XFECHA,XDETALLE,XINGRESO,XEGRESO,XFECHAREG);
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `REGISTRO_EMPRESA` */

/*!50003 DROP PROCEDURE IF EXISTS  `REGISTRO_EMPRESA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRO_EMPRESA`(
IN XDESCRIPCION VARCHAR(100),
IN XRUC VARCHAR(100),
IN XDIRECCION VARCHAR(100),
IN XTELEFONO VARCHAR(100),
IN XEMAIL VARCHAR(100)
)
BEGIN
INSERT INTO empresas (Descripcion,Ruc,Direccion,Telefono,Email)
VALUES(XDESCRIPCION,XRUC,XDIRECCION,XTELEFONO,XEMAIL);
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `REGISTRO_TERCERO` */

/*!50003 DROP PROCEDURE IF EXISTS  `REGISTRO_TERCERO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRO_TERCERO`(
IN XIDTIPO INT(11),
IN XNOMBRES VARCHAR(100),
IN XAPELLIDOS VARCHAR(100),
IN XIDENTIFICACION VARCHAR(100),
IN XDIRECCION VARCHAR(100),
IN XTELEFONO VARCHAR(100),
IN XEMAIL VARCHAR(100)
)
BEGIN
INSERT INTO terceros (IdTipo,Nombres,Apellidos,Identificacion,Direccion,Telefono,Email)
VALUES(XIDTIPO,XNOMBRES,XAPELLIDOS,XIDENTIFICACION,XDIRECCION,XTELEFONO,XEMAIL);
COMMIT;
END */$$
DELIMITER ;

/* Procedure structure for procedure `REPORTE_DIARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `REPORTE_DIARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `REPORTE_DIARIO`(
IN XIDEMPRESA INT(11),
IN XFDESDE DATE,
IN XFHASTA DATE
)
BEGIN
SELECT D.IdDiario,U.Usuario,EM.Descripcion AS 'Empresa',T.Descripcion AS 'Tipo',C.Descripcion AS 'Motivo',CONCAT(TC.Nombres,' ',TC.Apellidos)AS 'Tercero',D.Fecha,D.Detalle,D.Ingreso,D.Egreso,D.FechaReg 
FROM diarios D
INNER JOIN usuarios U ON (D.IdUsuario=U.IdUsuario)
INNER JOIN empresas EM ON (D.IdEmpresa=EM.IdEmpresa)
INNER JOIN tipo_diario T ON (D.IdTipoDiario=T.IdTipoDiario)
INNER JOIN categorias C ON (D.IdCategoria=C.IdCategoria)
INNER JOIN terceros TC ON (D.IdTercero=TC.IdTercero)
INNER JOIN estados E ON (D.IdEstado=E.IdEstado)
WHERE EM.IdEmpresa = XIDEMPRESA AND D.Fecha BETWEEN XFDESDE AND XFHASTA AND D.IdEstado=1 ORDER BY D.IdDiario ASC;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
