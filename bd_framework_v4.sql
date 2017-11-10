/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.0.51b-community-nt-log : Database - bd_framework_v4
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id_banner` int(11) NOT NULL auto_increment,
  `titulo_banner` varchar(200) NOT NULL,
  `titulo_principal_banner` varchar(200) NOT NULL,
  `titulo_secundario_banner` varchar(200) NOT NULL,
  `final_titulo_banner` varchar(200) NOT NULL,
  `imagen_banner` varchar(71) NOT NULL,
  `thumb_banner` varchar(71) NOT NULL,
  `order_banner` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `banners` */

insert  into `banners`(`id_banner`,`titulo_banner`,`titulo_principal_banner`,`titulo_secundario_banner`,`final_titulo_banner`,`imagen_banner`,`thumb_banner`,`order_banner`) values (0,'xxxxxxx','SOLUCIONES INNOVADORAS EN TIxxxx','Confianos la Continuidad Operativa de tu Empresa','Seguridad TI / Networking / Virtualización / Outso','banner_1404841149slider-sin-texto-1.jpg','',0);

/*Table structure for table `configuracion` */

DROP TABLE IF EXISTS `configuracion`;

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL auto_increment,
  `nombre_configuracion` varchar(40) NOT NULL default '',
  `valor_configuracion` text NOT NULL,
  PRIMARY KEY  (`id_configuracion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `configuracion` */

insert  into `configuracion`(`id_configuracion`,`nombre_configuracion`,`valor_configuracion`) values (1,'NOMBRE_SITIO','Framework Version 4'),(2,'EMAIL_CONTACTENOS','info@develoweb.net');

/*Table structure for table `idiomas` */

DROP TABLE IF EXISTS `idiomas`;

CREATE TABLE `idiomas` (
  `id_idioma` int(11) NOT NULL auto_increment,
  `nombre_idioma` varchar(100) NOT NULL,
  `imagen_idioma` varchar(100) NOT NULL,
  `archivo_idioma` varchar(150) NOT NULL,
  `estado_idioma` int(1) NOT NULL,
  PRIMARY KEY  (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `idiomas` */

insert  into `idiomas`(`id_idioma`,`nombre_idioma`,`imagen_idioma`,`archivo_idioma`,`estado_idioma`) values (1,'Espa?ol','es.png','inc.spanish.php',1);

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL auto_increment,
  `nombre_modulo` char(31) NOT NULL,
  PRIMARY KEY  (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `modulos` */

insert  into `modulos`(`id_modulo`,`nombre_modulo`) values (1,'Inicio'),(2,'Administrar'),(3,'Pedidos'),(5,'Reportes'),(6,'Herramientas');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL auto_increment,
  `nombre_rol` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

insert  into `roles`(`id_rol`,`nombre_rol`) values (1,'Administrador'),(2,'Usuario');

/*Table structure for table `secciones` */

DROP TABLE IF EXISTS `secciones`;

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL auto_increment,
  `id_modulo` int(11) NOT NULL,
  `nombre_seccion` varchar(50) NOT NULL,
  `url_seccion` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_seccion`),
  KEY `id_modulo` (`id_modulo`),
  CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `secciones` */

insert  into `secciones`(`id_seccion`,`id_modulo`,`nombre_seccion`,`url_seccion`) values (1,1,'Inicio','index.php'),(2,1,'Configuraci&oacute;n de Sitio','configuracion.php'),(3,1,'Cuentas y Accesos','usuarios.php');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `id_rol` int(11) NOT NULL default '0',
  `nombre_usuario` varchar(50) NOT NULL default '',
  `apellidos_usuario` varchar(50) NOT NULL default '',
  `email_usuario` varchar(50) NOT NULL default '',
  `foto_usuario` varchar(71) NOT NULL,
  `login_usuario` varchar(20) NOT NULL default '',
  `password_usuario` varchar(200) NOT NULL default '',
  `fecha_ingreso_usuario` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_usuario`,`id_rol`,`nombre_usuario`,`apellidos_usuario`,`email_usuario`,`foto_usuario`,`login_usuario`,`password_usuario`,`fecha_ingreso_usuario`) values (1,1,'Walter','Meneses','admin@alojaweb.pe','','admin','e10adc3949ba59abbe56e057f20f883e','2009-02-13'),(2,1,'Bryan','Arias','darias@develoweb.net','','darias','e10adc3949ba59abbe56e057f20f883e','2014-07-31');

/*Table structure for table `usuarios_secciones` */

DROP TABLE IF EXISTS `usuarios_secciones`;

CREATE TABLE `usuarios_secciones` (
  `id_usuario` int(11) NOT NULL default '0',
  `id_seccion` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_usuario`,`id_seccion`),
  KEY `id_seccion` (`id_seccion`),
  CONSTRAINT `usuarios_secciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_secciones_ibfk_2` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `usuarios_secciones` */

insert  into `usuarios_secciones`(`id_usuario`,`id_seccion`) values (1,1),(2,1),(1,2),(2,2),(1,3),(2,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
