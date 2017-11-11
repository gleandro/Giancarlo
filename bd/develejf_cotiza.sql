/*
SQLyog Community v8.71 
MySQL - 5.6.16 : Database - develejf_cotiza
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`develejf_cotiza` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `develejf_cotiza`;

/*Table structure for table `agencias` */

DROP TABLE IF EXISTS `agencias`;

CREATE TABLE `agencias` (
  `id_agencia` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social_empresa` varchar(250) NOT NULL,
  `ruc_empresa` int(11) NOT NULL,
  `email_empresa` varchar(250) DEFAULT NULL,
  `telefono_empresa` varchar(250) DEFAULT NULL,
  `direccion_empresa` varchar(250) DEFAULT NULL,
  `contacto_empresa` varchar(250) DEFAULT NULL,
  `comision_empresa` int(11) DEFAULT '0',
  PRIMARY KEY (`id_agencia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `agencias` */

insert  into `agencias`(`id_agencia`,`razon_social_empresa`,`ruc_empresa`,`email_empresa`,`telefono_empresa`,`direccion_empresa`,`contacto_empresa`,`comision_empresa`) values (1,'super mercadosaaabbbb',44444444,'suerp@gmail.comaaaa','55555','limaaaaaa','andres',20),(2,'asdfasdf',2147483647,'asdf@gmail.com','4235423452345','safdfa','ssdafsdf',21);

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_banner` varchar(200) NOT NULL,
  `titulo_principal_banner` varchar(200) NOT NULL,
  `titulo_secundario_banner` varchar(200) NOT NULL,
  `final_titulo_banner` varchar(200) NOT NULL,
  `imagen_banner` varchar(71) NOT NULL,
  `thumb_banner` varchar(71) NOT NULL,
  `order_banner` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `banners` */

insert  into `banners`(`id_banner`,`titulo_banner`,`titulo_principal_banner`,`titulo_secundario_banner`,`final_titulo_banner`,`imagen_banner`,`thumb_banner`,`order_banner`) values (1,'xxxxxxx','SOLUCIONES INNOVADORAS EN TIxxxx','Confianos la Continuidad Operativa de tu Empresa','Seguridad TI / Networking / Virtualización / Outso','banner_1404841149slider-sin-texto-1.jpg','',0);

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL,
  `id_fuente` int(11) DEFAULT '1',
  `id_nacionalidad` int(11) DEFAULT '1',
  `nombres_cliente` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `documento_cliente` bigint(30) DEFAULT NULL,
  `telefono_cliente` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `email_cliente` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_pais_idx` (`id_pais`),
  CONSTRAINT `id_pais` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`id_cliente`,`id_pais`,`id_fuente`,`id_nacionalidad`,`nombres_cliente`,`documento_cliente`,`telefono_cliente`,`email_cliente`) values (1,1,1,1,'jose',41123114,'987654321','jose@gmail.com'),(31,1,4,2,'sofia',41231314,'987654321','sofia@gmail.com'),(32,1,2,1,'manzaneda',41213820,'987654312','manzaneda@gmail.com'),(33,1,2,1,'manzanedaaaaa',41213820,'987654312','manzanedaaaaaa@gmail.com'),(34,1,2,1,'manzanedaaaaaaa',41213820,'987654312','manzanedaaaaaaa@gmail.com'),(35,1,2,1,'manzanedaaaaaaa',41213820,'987654312','manzanedaaaaaaa@gmail.com'),(36,1,2,1,'manzanedabbbbbbbb',41213820,'987654312','manzanedabbbbbbb@gmail.com'),(37,1,2,1,'manzanedaaaaa',41213820,'987654312','manzanedaaaaa@gmail.com'),(38,1,2,1,'manzanedaaaaaaaa',41213820,'987654312','manzanedaaaaa@gmail.com'),(39,1,2,1,'manzanedaaaaaa',41213820,'987654312','manzanedaaaaa@gmail.com'),(40,1,2,1,'manzanedaaaaaa',41213820,'987654312','manzaneda@gmail.com'),(41,1,2,1,'manzaneda',41213820,'987654312','manzaneda@gmail.com'),(42,1,2,1,'manzaneda',41213820,'987654312','manzaneda@gmail.com'),(43,1,2,1,'manzaneda',41213820,'987654312','manzaneda@gmail.com'),(44,1,2,1,'manzaneda',41213820,'987654312','manzaneda@gmail.com'),(45,1,2,1,'manzaneda',41213820,'987654312','manzaneda@gmail.com'),(46,1,2,2,'asfd',43142341234,'12341234','asfd@gmail.com');

/*Table structure for table `configuracion` */

DROP TABLE IF EXISTS `configuracion`;

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_configuracion` varchar(40) NOT NULL DEFAULT '',
  `valor_configuracion` text NOT NULL,
  PRIMARY KEY (`id_configuracion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `configuracion` */

insert  into `configuracion`(`id_configuracion`,`nombre_configuracion`,`valor_configuracion`) values (1,'NOMBRE_SITIO','Framework Version 4'),(2,'EMAIL_CONTACTENOS','info@develoweb.net');

/*Table structure for table `contactos` */

DROP TABLE IF EXISTS `contactos`;

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_contacto` int(11) DEFAULT NULL,
  `nombre_contacto` varchar(45) DEFAULT NULL,
  `apellidos_contacto` varchar(45) DEFAULT NULL,
  `telefono_contacto` varchar(45) DEFAULT NULL,
  `email_contacto` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id_contacto`),
  KEY `id_tipo_contacto_idx` (`id_tipo_contacto`),
  CONSTRAINT `id_tipo_contacto` FOREIGN KEY (`id_tipo_contacto`) REFERENCES `tipos_contactos` (`id_tipo_contacto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `contactos` */

insert  into `contactos`(`id_contacto`,`id_tipo_contacto`,`nombre_contacto`,`apellidos_contacto`,`telefono_contacto`,`email_contacto`) values (1,1,'Azucena','Gutierrez Sanchez','3233866','azucena@disfruta.com'),(2,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `cotizaciones` */

DROP TABLE IF EXISTS `cotizaciones`;

CREATE TABLE `cotizaciones` (
  `id_cotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `numero_pasajeros` int(11) NOT NULL DEFAULT '1',
  `nombre_cotizacion` varchar(250) NOT NULL,
  `descripcion_cotizacion` varchar(500) DEFAULT NULL,
  `imagen_cotizacion` varchar(71) DEFAULT NULL,
  `fecha_cotizacion` date NOT NULL,
  PRIMARY KEY (`id_cotizacion`),
  KEY `id_cliente_idx` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones` */

insert  into `cotizaciones`(`id_cotizacion`,`id_cliente`,`numero_pasajeros`,`nombre_cotizacion`,`descripcion_cotizacion`,`imagen_cotizacion`,`fecha_cotizacion`) values (30,32,3,'paquete aviacion','descripcion aviacion','17110106545722555998_10207530932270537_939792435_o.png','2017-11-01'),(43,45,3,'paquete aviacionbbbbbb','descripcion aviacion','','2017-11-01'),(44,46,4,'aafdafdsa','asdfasdf','','2017-11-01');

/*Table structure for table `cotizaciones_itinerario` */

DROP TABLE IF EXISTS `cotizaciones_itinerario`;

CREATE TABLE `cotizaciones_itinerario` (
  `id_cotizacion_itinerario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int(11) NOT NULL,
  PRIMARY KEY (`id_cotizacion_itinerario`),
  KEY `id_cotizacion_idx` (`id_cotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cotizaciones_itinerario` */

/*Table structure for table `cotizaciones_itinerario_detalle` */

DROP TABLE IF EXISTS `cotizaciones_itinerario_detalle`;

CREATE TABLE `cotizaciones_itinerario_detalle` (
  `id_itinerario_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion_itinerario` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `dia_itinerario_detalle` int(11) DEFAULT NULL,
  `precio_itinerario_detalle` float DEFAULT NULL,
  PRIMARY KEY (`id_itinerario_detalle`),
  KEY `id_cotizacion_itinerario_idx` (`id_cotizacion_itinerario`),
  KEY `id_servicio_idx` (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cotizaciones_itinerario_detalle` */

/*Table structure for table `cotizaciones_paquetes` */

DROP TABLE IF EXISTS `cotizaciones_paquetes`;

CREATE TABLE `cotizaciones_paquetes` (
  `id_cotizacion_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int(11) NOT NULL,
  `cotizacion_nombre_paquete` varchar(250) NOT NULL,
  `cotizacion_descripcion_paquete` varchar(500) NOT NULL,
  `cotizacion_imagen_paquete` varchar(71) NOT NULL,
  PRIMARY KEY (`id_cotizacion_paquete`),
  KEY `id_cotizacion` (`id_cotizacion`),
  CONSTRAINT `fk_cotizaciones_cotizaciones_paquetes` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id_cotizacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones_paquetes` */

/*Table structure for table `cotizaciones_paquetes_destinos` */

DROP TABLE IF EXISTS `cotizaciones_paquetes_destinos`;

CREATE TABLE `cotizaciones_paquetes_destinos` (
  `id_cotizacion_paquete_destino` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id_cotizacion_paquete_destino`),
  KEY `id_cotizacion` (`id_cotizacion`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `fk_cotizaciones_cotizaciones_paquetes_destinos` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id_cotizacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_departamentos_cotizaciones_paquetes_destinos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones_paquetes_destinos` */

insert  into `cotizaciones_paquetes_destinos`(`id_cotizacion_paquete_destino`,`id_cotizacion`,`id_departamento`) values (49,30,2),(50,30,3),(75,43,2),(76,43,3),(77,44,2),(78,44,3);

/*Table structure for table `cotizaciones_paquetes_itinerarios` */

DROP TABLE IF EXISTS `cotizaciones_paquetes_itinerarios`;

CREATE TABLE `cotizaciones_paquetes_itinerarios` (
  `id_cotizacion_paquete_itinerario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int(11) NOT NULL,
  `nombre_cotizacion_paquete_itinerario` varchar(250) NOT NULL,
  `descripcion_cotizacion_paquete_itinerario` text,
  PRIMARY KEY (`id_cotizacion_paquete_itinerario`),
  KEY `id_cotizacion` (`id_cotizacion`),
  CONSTRAINT `fk_cotizaciones_cotizaciones_paquetes_itinerarios` FOREIGN KEY (`id_cotizacion`) REFERENCES `cotizaciones` (`id_cotizacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones_paquetes_itinerarios` */

insert  into `cotizaciones_paquetes_itinerarios`(`id_cotizacion_paquete_itinerario`,`id_cotizacion`,`nombre_cotizacion_paquete_itinerario`,`descripcion_cotizacion_paquete_itinerario`) values (34,30,'dia unooooooo','Itinerario unoooo'),(47,43,'dia unooooooo','                                                          Itinerario unoooo                                                      '),(48,44,'asdfas','dfasdfsfd');

/*Table structure for table `cotizaciones_paquetes_itinerarios_detalles` */

DROP TABLE IF EXISTS `cotizaciones_paquetes_itinerarios_detalles`;

CREATE TABLE `cotizaciones_paquetes_itinerarios_detalles` (
  `id_cotizacion_paquete_itinerario_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion_paquete_itinerario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `precio_servicio` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_cotizacion_paquete_itinerario_detalle`),
  KEY `id_cotizacion_paquete_itinerario` (`id_cotizacion_paquete_itinerario`),
  KEY `id_servicio` (`id_servicio`),
  CONSTRAINT `fk_cot_paq_itin_cot_paq_itin_det` FOREIGN KEY (`id_cotizacion_paquete_itinerario`) REFERENCES `cotizaciones_paquetes_itinerarios` (`id_cotizacion_paquete_itinerario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_servicios_cot_paq_itin_det` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones_paquetes_itinerarios_detalles` */

insert  into `cotizaciones_paquetes_itinerarios_detalles`(`id_cotizacion_paquete_itinerario_detalle`,`id_cotizacion_paquete_itinerario`,`id_servicio`,`precio_servicio`) values (33,34,70,'18.46'),(34,34,80,'34.00'),(63,47,70,'0.00'),(64,47,80,'0.00'),(65,48,85,'19.00');

/*Table structure for table `cotizaciones_paquetes_itinerarios_hoteles` */

DROP TABLE IF EXISTS `cotizaciones_paquetes_itinerarios_hoteles`;

CREATE TABLE `cotizaciones_paquetes_itinerarios_hoteles` (
  `id_cotizacion_paquete_itinerario_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion_paquete_itinerario` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  PRIMARY KEY (`id_cotizacion_paquete_itinerario_hotel`),
  KEY `id_cotizacion_paquete_itinerario` (`id_cotizacion_paquete_itinerario`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `fk_cot_paq_it_cot_paq_it_hotel` FOREIGN KEY (`id_cotizacion_paquete_itinerario`) REFERENCES `cotizaciones_paquetes_itinerarios` (`id_cotizacion_paquete_itinerario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hotel_cot_paq_it_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones_paquetes_itinerarios_hoteles` */

insert  into `cotizaciones_paquetes_itinerarios_hoteles`(`id_cotizacion_paquete_itinerario_hotel`,`id_cotizacion_paquete_itinerario`,`id_hotel`) values (27,34,97),(50,47,97),(51,47,90),(52,48,97),(53,48,90);

/*Table structure for table `cotizaciones_paquetes_itinerarios_hoteles_detalles` */

DROP TABLE IF EXISTS `cotizaciones_paquetes_itinerarios_hoteles_detalles`;

CREATE TABLE `cotizaciones_paquetes_itinerarios_hoteles_detalles` (
  `id_cotizacion_paquete_itinerario_hotel_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion_paquete_itinerario_hotel` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `cantidad_paquete_itinerario_hotel` int(11) NOT NULL,
  `precio_paquete_itinerario_hotel` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_cotizacion_paquete_itinerario_hotel_detalle`),
  KEY `id_cotizacion_paquete_itinerario_hotel` (`id_cotizacion_paquete_itinerario_hotel`),
  KEY `id_habitacion` (`id_habitacion`),
  CONSTRAINT `fk_cotpaqitinhot_cotpaqitinhotdet` FOREIGN KEY (`id_cotizacion_paquete_itinerario_hotel`) REFERENCES `cotizaciones_paquetes_itinerarios_hoteles` (`id_cotizacion_paquete_itinerario_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_habitaciones_cotpaqitinhotdet` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `cotizaciones_paquetes_itinerarios_hoteles_detalles` */

insert  into `cotizaciones_paquetes_itinerarios_hoteles_detalles`(`id_cotizacion_paquete_itinerario_hotel_detalle`,`id_cotizacion_paquete_itinerario_hotel`,`id_habitacion`,`cantidad_paquete_itinerario_hotel`,`precio_paquete_itinerario_hotel`) values (11,27,81,11,'80.47'),(12,27,3,12,'120.71'),(55,50,81,11,'80.47'),(56,50,3,12,'120.71'),(57,51,78,13,'76.80'),(58,51,74,14,'102.40'),(59,52,81,2,'80.47'),(60,53,73,3,'76.80'),(61,53,74,4,'102.40');

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_departamento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `departamentos` */

insert  into `departamentos`(`id_departamento`,`nombre_departamento`) values (1,'Cusco'),(2,'Arequipa'),(3,'Paracas'),(4,'Chiclayo'),(5,'Cusco Ciudad'),(6,'Cajamarca'),(7,'Matrimonials'),(8,'Cusco Valle Sagrado'),(9,'Cusco Machu Picchu'),(10,'Arequipa Colca'),(11,'Iquitos Selva'),(12,'Piura'),(13,'Lima Miraflores'),(14,'Lima San Isidro'),(15,'Lima'),(16,'Ica'),(17,'Ica Huacachina Oasis'),(18,'Nazca'),(19,'Puno'),(20,'Trujillo'),(21,'Cajamarca'),(22,'Tambopata'),(23,'Chincha-Ica'),(24,'Nasca-Ica'),(25,'Talara - Piura'),(26,'Piura'),(27,'Chiclayo'),(28,'Tumbes'),(29,'Pucallpa'),(30,'Tacna'),(31,'Trujillo'),(32,'Chachapoyas');

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `id_contacto` int(11) DEFAULT NULL,
  `id_tipo_empresa` int(11) DEFAULT NULL,
  `razon_social_empresa` varchar(250) DEFAULT NULL,
  `ruc_empresa` varchar(15) DEFAULT NULL,
  `email_empresa` varchar(250) DEFAULT NULL,
  `telefono_empresa` varchar(250) DEFAULT NULL,
  `pagina_web_empresa` varchar(250) DEFAULT NULL,
  `direccion_empresa` varchar(155) DEFAULT NULL,
  `contacto_nombre_empresa` varchar(255) NOT NULL,
  `contacto_telefono_empresa` varchar(255) NOT NULL,
  PRIMARY KEY (`id_empresa`),
  KEY `id_contacto_idx` (`id_contacto`),
  KEY `id_tipo_empresa_idx` (`id_tipo_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

/*Data for the table `empresas` */

insert  into `empresas`(`id_empresa`,`id_contacto`,`id_tipo_empresa`,`razon_social_empresa`,`ruc_empresa`,`email_empresa`,`telefono_empresa`,`pagina_web_empresa`,`direccion_empresa`,`contacto_nombre_empresa`,`contacto_telefono_empresa`) values (42,1,1,'DOS A Inversiones SAC.','20557720295','reservas@abittare-hotels.com','084241739','http://abittare-hotels.com/es','Calle Recavarren 424, of. 304, Miraflores','',''),(43,1,1,'Peruvian Tours Agency SAC','20510931514','mgan@aranwahotels.com','2070440','http://www.aranwahotels.com/','El Chaco, La Puntilla lote C,','',''),(44,1,1,'El Dorado Express','20329398642','reservas3@hoteleseldorado.com','065222555','http://doradoexpress.com/','Jr. Napo 480 - Iquitos - Perú.','',''),(46,1,1,'EMANSAMO S.R.L','20311815262','reservas@corregidor.pe','054288081','http://www.corregidor.pe/','Calle San Pedro N# 139, Arequipa','',''),(47,1,1,'Consorcio Turístico Hotelero Arequipa Inn S.R.L','20133007475','reservas@arequipainn.com.pe','241711','http://arequipainn.com.pe/pag1.html','Rivero N# 412, Cercado Arequipa','',''),(48,1,1,'Hoteles del Sur SAC','20454289821','recepcion.hmiraflores@hotelesestelar.com','6307777','http://www.hotelesestelar.com/','Avenida Benavides 415 - Miraflores','',''),(49,1,1,'Amazoneco EIRL','20493295129','reservations@casamorey.com','065231913','http://www.casamorey.com/','AV. GRAU NRO. 872 (ENTRE BERMUDEZ Y GARCIA SAENZ) LORETO - MAYNAS ','',''),(51,1,1,'Hostal La Casa de Melgar S.A.C','20601185653','lacasademelgar@hotmail.com','222459','http://www.lacasademelgar.com/','Calle Melgar 108, Arequipa','',''),(54,1,1,'Antares Arequipa S.R.L.','20539578112','reservas@antaresarequipa.pe','259747','http://www.antaresarequipa.pe/','Urbanización Ibarguen  A-12 Yanahuara','',''),(55,1,1,'WINGS SAC','20450603652','reservas@andeanwingshotel.com','(084) 243356','http://andeanwingshotel.com/','225 SIETE CUARTONES CUSCO PERU','FERNANDO','977208408'),(56,1,1,'Comercial Punto Azul E.I.R.L','20278392237','reservas@hotelesmabey.com','51-84) 221017 ','http://www.hotelesmabey.com/','CARRETERA  URUBAMBA-OLLANTAYTAMBO N°802','Ruben Villegas Camero',''),(57,1,1,'Quattro Hoteles y Restaurantes','20455891702','reservas@maytaqhotel.com','(84) 224291','http://www.maytaq.com/espanol/','Santa Catalina Ancha #342 - Cusco, Perú','Andrea Velasquez','84 224291 '),(58,1,1,'Inversiones Turisticas y Hoteleria S.A.C','20600046315','reservas@hotelcarlosvinn.com','084-223091 ','http://www.hotelcarlosvinn.com/',' Calle Tecsecocha 490-A','Sharon','084-223091'),(59,1,1,'Landmark Holdings S.A.C.','20546981518','cuzgi_Res@hilton.com',' 084 58 01 24','http://www.hiltonhotels.com/es_XM/peru/hilton-garden-inn-cusco/','Santa Ana, Av. Abancay 207 Cusco','Patricia Vargas','934052588'),(60,1,1,'Forum Inversiones S,A,C','20523025521','spinglo@dazzlerlima.com','','https://www.dazzlerhoteles.com/es/hoteles/peru/hoteles-en-lima/dazzler-lima/?gclid=CMqa7dqW19YCFYkHkQod1J8DKg','Av. José Pardo 879, Miraflores, Lima, Perú ','Sandra Pinglo','634 4000 '),(61,1,1,'Inka Terra Peru S.A.C  ','20419195317','central@inkaterra.com','610-0404','http://www.inkaterra.com/es/',' CAL.ANDALUCIA NRO. 174 URB. AMERICA LIMA - LIMA - MIRAFLORES','610-0404','Gabriela Bravo'),(62,1,1,'Inmobiliaria de Turismo S.A','20136847237','daniela.soria@ghlhoteles.com','712-6050','http://www.sonestapimiraflores.com/','Av. Juan de Arona 893 - San Isidro','Daniela Soria','241-7688'),(63,1,1,'Hoteleria Peruana S.A.C','20536047906','reservas@tierravivahoteles.com','4453613','http://tierravivahoteles.com/es/','Alfredo Benavides 1579 oficina 303','Isabel Rojas','445-3613 '),(64,1,1,'Inversiones Aldana S.A.C','20512450165 ','reservas@hotelmiramarperu.com','445-3198','http://www.hotelmiramarperu.com/','Jr. Bolognesi 191 – Miraflores ','Mara Quispe','940397755'),(65,1,1,'PELAEZ MIRANDA JORGE JESUS','10458477430 ','gerencia@hotelesferre.com','4473456','http://hotelesferre.com/hotel-miraflores/',' CAL.CHICLAYO NRO. 533 URB. MIRAFLORES (ALT. CDRA. 5 AV ANGAMOS) LIMA - LIMA - MIRAFLORES','Juan Andres Garcia','4473456'),(66,1,1,'OPERACIONES HOTELERAS SAC','20600290569','grupos.peru@hotelesestelar.com','630 7777','http://www.hotelesestelar.com/','Avenida Benavides 415 - Miraflores)','Katia Juarez Uribe','989 058 361'),(67,1,1,'Peru Audio Tours S.A.C','20555511117','reservas@perusightseeing.com','652-4287','http://www.perusightseeing.com/','AV. GENERAL ALVAREZ DE ARENALES NRO. 1912 DPTO. 1003 URB. FUNDO LOBATON (OFICINA) LIMA - LIMA - LINCE','Dhanittsa Martinez','652 4287'),(68,1,1,'INVERSIONES CONTINENTE SRLTDA.','20347087620','reservas@cuscoplazahoteles.com','084 263000','http://www.cuscoplazahotels.com/',' AV. JAVIER PRADO ESTE NRO. 1580 URB. CORPAC LIMA - LIMA - SAN ISIDRO','Charmely Tintaya','084 263000'),(69,1,1,'Nessus Hoteles Peru S.A.','20505670443 ','abretoneche@casa-andina.com','2133759','http://casa-andina.com/','AV. LA PAZ NRO. 463 LIMA - LIMA - MIRAFLORES','Luis Alfonso','997566025'),(70,1,1,'HHP Hoteles Hacienda del Peru SRL','20406464181','reservas@hhp.com.pe','084 201408','http://www.hhp.com.pe/','Sector Pucará s/n Yanahuara Urubamba Cusco','Heyli Juarez','084 201408'),(71,1,1,'Los Andes de América S.A.C','20527431256','patricia@cuscoandes.com','(51) 472-4350','http://www.cuscoandes.com/','Cal. Manuel Arrisueño Nro. 563 URB. Santa Catalina.','Patricia Gamarra','(51) 472-4350'),(72,1,1,'Hermoza Muñiz Ruben Eduardo','10238336045','resevas@elpumahotelcusco.com','(84) 232595','http://www.elpumahotelcusco.com/','Av. Garcilaso Nro. 806 Cercado Cusco - Cusco','Gabriela','(84) 232595'),(73,1,1,'Servicios Gastronómicos Delicia´s S.A.C','20539987128 ','hotelmonasteriosanpedro@gmail.com','084-252131','http://www.hotelmonasteriosanpedro.com/','Calle hospital 699 – Cusco, Plaza San Pedro; Cusco – Perú','Asunta Ccoscco Visa','084 - 252 131'),(74,1,1,'Inversiones Naciones de Turismo S.A','20114803228','tcalderon@libertador.com.pe','712 7000 ','https://www.libertador.com.pe/','Calamador Merino Reyna Nro 551 - Lima San Isidro','Tania Calderon','712 7000 '),(75,1,1,'Corporacion Hotelera del Cuzco S.A','20422841653','h3254-re@accor.com','084 581033','http://www.novotel.com/es/hotel-6339-novotel-lima/index.shtml','CAL.SAN AGUSTIN NRO. 239 URB. Centro Historico de Cusco','Claudia Mar','10 3500 '),(76,1,1,'Faraona Servicios Hoteleros S.A','20330573857','reservas@faraonagrandhotel.com','446-9414  ','http://www.faraonagrandhotel.com/','Calle Manuel Bonilla – 185 Miraflores Lima ','Zenia Rubio','446-9414  '),(77,1,1,'Inversiones Tulip E.I.R.L','20514352730 ','reservas@habitathotelperu.com','2422222','http://www.habitathotelperu.com/','Av. Arequipa Nro 5000 (Esq. Calle Piura) Lima - Miraflores','Milagros Curay','2422222 '),(78,1,1,'Atton San Isidro S.A.C','20538571912 ','reservas.peru@atton.com','2081200','http://www.atton.com/es/san-isidro/rooms?s_kwcid=AL!4331!3!183658784109!e!!!!atton%20san%20isidro&ef_id=WanLowAAAah2RoJC:20171006174102:s','Av. Jorge Basadre NRO. 595 Lima San Isidro','Carlos Bustamante','2081200'),(79,1,1,'Inversiones Sen Lei EIRL',' 20492399478','reservas@limawasihotel.com.pe','979723087		','http://www.limawasihotel.com.pe/','Av. Armendariz 375 Miraflores Lima Peru		','Nilton Gordillo','2430721'),(80,1,1,'Corporación Hotelera del Pacifico S.A','20383145997','reservas@leondeoroperu.com','','http://www.leondeoroperu.com/','Av. La Paz Nº 930 Miraflores','Sally Romero','242-6200'),(81,1,1,'Hoteles Sur S.A.C.','20442053431 ','info@hotelruinas.com','(84) 260644    ','http://www.hotelruinas.com/','Calle Ruinas N°472  Cusco – Perú','Larissa Zuñiga',''),(82,1,1,'Inversiones Finos El Dorado S.R.L','20450791980 ','reservas_psfhotel@hotmail.com','084-253932 ','http://www.sanfranciscoplazacusco.com/','Calle Ceniza 147','Susan Castillo','(84)253932 '),(83,1,1,'Rumi Llaqta Machupicchu','20490163523 ','reservas@lacabanamachupicchu.com','084 263230','http://lacabanamachupicchu.com/es/','Av. Pachacuteq Nro 805 ','Jackeline Chambilla A.','(084)263230 '),(84,1,1,'Cia. Servicios Turisticos El Mirador','20141569920','reservas@elmiradorhotel.com','056 545 086','http://www.elmiradorhotel.com/','Carretera Paracas Km 20 Paracas-Pisco','056 545086','Luis Bacca'),(85,1,1,'Hostal Turístico Refugio del Pirata S.A.C','20534463457 ','reservas@refugiodelpirata.com','056 534473','http://paracassunset.com/','Av. Paracas Mz. J - Lt 1 Paracas, Pisco, Perú.','Analuz Hernandez Cassia','056-534473 '),(86,1,1,'IA Contactors SAC','20523880749','reservas@hotelgranpalma.com','989352785','http://hotelgranpalma.com/','CAL.PICASSO NRO. 164 LIMA - LIMA - SAN BORJA','Jennifer Torrres','984-352785 '),(87,1,1,'Colca Lodge S.A','20311643895','info@colca-lodge.com','(54) 282177','https://colca-lodge.com/es/','CAL.MARISCAL BENAVIDES NRO. 201 URB. SELVA ALEGRE AREQUIPA - AREQUIPA - AREQUIPA','Omar Mantilla','054 202587'),(88,1,1,'Consorcio Hotelero Camping Colca S.R.L','20272498505','reservas@hotelcolcainn.com','054 531111','http://www.hotelcolcainn.com/','Av. Salaverry N° 307 – Chivay','Yaneth Melendez','054 531111'),(89,1,1,'Servicios Turisticos Colca llaqta Hoteles S.R','20539470851','reservas@colcallaqtahotel.com','054 531280','http://www.colcallaqtahotel.com/','Calle Jose Galvez Mz A B Lote 5 - Chivay','Maria Portugal','054 531280  '),(90,1,1,'Inversiones Turisticas Pozo del Cielo SAC','20498578617 ','reservas@pozodelcielo.com.pe','054-211467','http://www.pozodelcielo.com.pe/','CAL.HUASCAR S/N MZA. E LOTE. 3-6 P.J. SOL DE SACSAYHUAMAN  AREQUIPA - CAYLLOMA - CHIVAY','Lilian Sumire','054-211467'),(91,1,1,'American Tourist Services E.I.R.L','2045426790','reservas@fundador.pe','054 284848','http://fundador.pe/','Campo Redondo 109-111 San Lázaro (Cercado)','Maria Teresa Palomino','959 378474 '),(92,1,1,'Maison Su Soleil S.R.L','20455746796','reservas@maisondusoleil.com.pe','054 242108','http://www.maisondusoleil.com.pe/index.php/es/','Pasaje Violin 100 - 102 San Lazaro Cercado','Soledad Amado de Garcia','054 242108'),(93,1,1,'CEVITUR E.I.R.L.','20498124934','cevitur_reservas@hotmail.com','054 220915','https://www.cevitur.com/','CAL. STA CATALINA NRO. 110 INT. S/N AREQUIPA ','Rosio Peña','054 220915'),(94,1,1,'Ccahua Galiano Alipio','10103384104','info@hotelantawasi.com','054 241267','http://www.hotelantawasi.com/es/contacto.html','CAL.INTICCAHUARINA NRO. 621 CUSCO','Marita Ccahua','994820682 '),(95,1,1,'Munay Wasi inn E.I.R.L','20485041240','reservaciones@munaywasi.com','084 224312','http://www.munaywasi.com/','AV. TULLUMAYO NRO. 418 URB. Centro Historico de Cusco ','Nelida Lopez','084-224312'),(96,1,1,'Koyllur Inn','20528039775','koyllur.cusco@gmail.com','084-245118','http://www.koyllurhotel.com/en/','CAL.PUMAPACCHA NRO. 243 URB. Centro Historico de Cusco','Merlly Bethyana','84 245118'),(97,1,1,'Yawata E.I.R.L','20527326622 ','midorireservas@hotmail.com','(084) 248144','http://www.midori-cusco.com/es/','CAL.ATAUD NRO. 204 CUSCO ','Maria Antonieta','84-248144'),(98,1,1,'Inversiones Aldana S.A.C','20512450165','reservas@hotelstefanos.com','446 3212','http://www.hotelstefanosperu.com/','Calle Esperanza Nro 370 - Miraflores','Jackeline Granados Romani','946049194'),(99,1,1,'Corporación Hotelera MSJ S.A.C','20601751403','reservas@riverainnhotel.com.pe','4420641','http://www.riverainnhotel.com.pe/','CAL.RIVERA NAVARRETE NRO. 2868 LIMA - LIMA - LINCE','Melisa Duran','442 0641'),(100,1,1,'Servicios e Inversiones Crisol Sociedad Anonima','20513437600','reservas@allpahotel.com','4979745','http://allpahotel.com/','Calle Atahualpa 199 Miraflores','Patricia Moreno','2068800'),(101,1,1,'Rumi Punku E.I.R.L','20527566429','info@rumipunku.com','084 221102','http://www.rumipunku.com/','Calle Choquechaca #339','Anibal Bejar','084 221102'),(102,1,1,'La Posada del Viajero S.A.C','20601841909','info@laposadadelviajeroperu.com','956333791','http://www.laposadadelviajeroperu.com/','Santa Catalina Ancha 336','Dan Ferro','956333791'),(103,1,1,'Corporacion Fisher S.A.C','20535733806','reservas@cuscoplazadearmas.com','084 225959','http://www.cuscoplazadearmas.com/','Av. Portal Mantas 114 Cusco - Perú','Madeleine Urquizo','084 431355'),(104,1,1,'Servilla S.A.C','20600685482','reservas@villaurubamba.com','084 205133','http://villaurubamba.com/','Rumichaca s/n - Urubamba','','084 205133'),(105,1,1,'Grupo Rada EIRL','20491199416 ','reservas@hanaqpachainn.com','984766453','http://www.hotelhanaqpachainn.com/','AV. LA RAZA NRO. 992 (CUADRA Y MEDIA DE LA PLAZOLETA STA ANA) CUSCO','Cinthya','084 314007'),(106,1,1,'Sia Hoteles S.R.L','20490632701 ','reservas@siahotels.com','084 211144','https://www.hostalmachupicchu.com/','AV. IMPERIO DE LOS INCAS NRO. 400 (A 150 MTS DEL PUESTO POLICIAL) CUSCO - URUBAMBA - MACHUPICCHU','Cinthya','084 211144'),(107,1,1,'Cable Andina SAC','20558639629 ','reservations@sumaqhotelperu.com','','https://www.machupicchuhotels-sumaq.com/espanol/','MZA. E LOTE. 25 COO. VIRGEN DE COCHARCAS (CRUCE AV.PASTOR SEVILLA Y 1ERO DE MAYO) LIMA -','Daniela Rojas','445 7828'),(108,1,1,'ANDEAN AMAZON EMPRESA INDIVIDUAL DE RESPONSABILIDAD LIMITADA - ANDEAN AMAZON E.I.R.L.','20450684474','eservas@wamanhotels.com','84 211234','http://www.wamanhotels.com/','AV. DIAGONAL RAMON ZAVALETA NRO. 121 (3ER PISO ARRIBA CAJA SULLANA) CUSCO - CUSCO - WANCHAQ','Waman','84 211234'),(109,1,1,'Oro Inn II SAC','20553191891','reservation@gmail.com','421 6793','http://oroinnhotel.com/','CAL.MARIANO DE LOS SANTOS NRO. 165 LIMA - LIMA - SAN ISIDRO','Geraldine Quispe','441 1533 '),(110,1,1,'Empresa de Servicios Turisticos Colon S.A.C','20462041587','ventas@miraflorescolonhotel.com','610-0900 ','https://www.miraflorescolonhotel.com/index.html','600 Colon St. w/ Juan Fanning  Miraflores, Lima- Perú ','Cinthya Pariona','610-0900 '),(111,1,1,'I & H Hispania S.A.C','20550025176','mariella.Ausejo@Hilton.com','2200 8017','http://www3.hilton.com/en/hotels/peru/hilton-lima-miraflores-LIMMFHH/index.html','Av. La Paz 1099','Mariella Ausejo','200 8017'),(112,1,1,'Turismo El Tambo  SAC','20515601164 ','reservas@eltamboperu.com','206','http://www.eltamboperu.com/','Av. La Paz 1276 Miraflores','Claudia Quiñones','219 4080'),(113,1,1,'Peru Holiday S.A.C','20508589108','info@ducado.pe','4471919','https://www.ducado.pe/en/','Juan Fanning 337 - Miraflores','Fatima Hurtado','447 1919'),(114,1,1,'Inversiones Porta Coeli S.A','20291478761 ','reservas@hotelcarmel.com.pe','241 8672','http://www.hotelcarmel.com.pe/portal/?page_id=22','CAL.SAN DIEGO NRO. 360 INT. 1 (A MEDIA CUADRA COMISARIA DE SURQUILLO)-LIMA ','Pilar Vaiz','241 8672'),(115,1,1,'Servicios e Inversiones Crisol SAC','2051343760','ventas2@allpahotel.com','4979745','http://allpahotel.com/','Calle Atahualpa 199 Miraflores','Patricia Moreno','4979745'),(116,1,1,'Inversiones Sen Lei EIRL','20492399478','reservas@limawasihotel.com.pe','243-0721','http://www.limawasihotel.com.pe/','Av. Armendariz 375 Miraflores Lima Peru','Nilton Gordillo','2430721'),(117,1,1,'Parikanpu SAC','20400875597','hotel@pakaritampu.com','084 204020','http://pakaritampu.com.pe/',' Av. Ferrocarril 852 Ollantaytambo – Cusco','Hermelinda','084 204020'),(118,1,1,'Inka Town Tower EIRL','20564331806','reservas@inkatownhotel.com','941411784','http://www.inkatownhotel.com/portada/','Alameda los artesanos 1508 (costado caja Cusco)','Patricia Anaya','941411784'),(119,1,1,'Inversiones Royal Inka SA','20101278582 ','royalinka@gmail.com','084263276','http://www.royalinkahotel.pe/','CAL.SANTA TERESA NRO. 335 CUSCO - CUSCO - CUSCO','Canto Bazan','084 263276'),(120,1,1,'Inversiones Valle Keistel SAC','20450551083','reservas@hotelprismacusco.com','084 224412','http://www.hotelprismacusco.com/','Calle Matara 394 - Cuzco','Vanesa','084 224412 '),(121,1,1,'Estaciones de Servicios Mapy','2049109280','info@intipunku.pe','084 652482','http://www.intipunku.pe/es/','Calle Kori Wakanki # 209','Pedro Chavez Mora','(84) 652 482'),(122,1,1,'Gringo Bills E.I.RL','20490904558','reservas@gringobills.com','084 211046','http://www.gringobills.com/','Jiron Colla Raymi 104 Machupicchu, Cuzco Mach 01 Perú','Elmer Huaman','084 211046'),(123,1,1,'Golden Lands SAC','20490021656 ','info@reyantareshotel.com','084225420','http://www.reyantareshotel.com/es/','Calle Cascaparo 172 Cusco, Perú','Erika','(84)  22 54 20'),(124,1,1,'Hostal La Casona de Chachapoyas SRL','20601499780 ','lacasonadechachapoyasperu@gmail.com','041 477353','http://lacasonadechachapoyasperu.com/','Jr. Chincha Alta 569, Chachapoyas 01001','Gloria','(041) 477353'),(125,1,1,'Rasgos Cusco Tour Operador E.I.R.L','20527915377','operacionescusco1@rasgosdelperu.com','084 255894','http://www.rasgosdelperu.com/','Av. Larco 345 - Miraflores','Ekaterin Chacon','084 255894'),(126,1,1,'Inversiones Casavi S.A.C','20602131808','informes@casonamonsante.com','933216097','http://www.casonamonsante.com/',' Jr. Amazonas Nro. 746 - Chachapoyas - Amazonas','933216097','Gloria'),(127,1,1,'Castaneda de Morocho Nancy Janet','10104940949 ','contactenos@hotelvilladeparis.com','041 631310','http://hotelvilladeparis.com/portal/','Jr. Dos de Mayo cdra 15','Gloria','998452865'),(128,1,1,'Chachapoyas Travel Tour Operador E.I.R.L.','20487743004','info@chachapoyas.com','941997126','http://travelchachapoyas.com/','Jr. Grau Nº 561 - Plaza de Armas - Chachapoyas','Janeth','941997126'),(129,1,1,'HYE Yabar Inversiones S.R.L','20564470679','ventas@hotelcuscosuite.com','084 226352','http://www.hotelcuscosuite.com/','Calle Loreto o Kijllu Inti. ','084 226352 ','Nelly Sotelo'),(130,1,1,'Corporacion Hotelera San Andres SAC.','20493040309','reservas@hotelwinmeier.pe','993505733','http://www.winmeier.pe/','Av. Bolognesi 756, Chiclayo, Perú','Janet Requejo','993505733');

/*Table structure for table `fuentes` */

DROP TABLE IF EXISTS `fuentes`;

CREATE TABLE `fuentes` (
  `id_fuente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_fuente` varchar(250) NOT NULL,
  `order_fuente` int(11) NOT NULL DEFAULT '1',
  `estado_fuente` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_fuente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `fuentes` */

insert  into `fuentes`(`id_fuente`,`nombre_fuente`,`order_fuente`,`estado_fuente`) values (1,'Radio',0,1),(2,'Cliente Referido',1,1),(3,'Web Rasgos',2,1),(4,'Cliente Antiguo',3,1),(5,'Paso por la Sucursal',4,1),(6,'E-mailing',5,1),(7,'Facebook Rasgos',6,1),(8,'Feria',7,1);

/*Table structure for table `habitaciones` */

DROP TABLE IF EXISTS `habitaciones`;

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_habitacion` varchar(45) DEFAULT NULL,
  `cantidad_habitacion` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

/*Data for the table `habitaciones` */

insert  into `habitaciones`(`id_habitacion`,`nombre_habitacion`,`cantidad_habitacion`) values (1,'Simples',1),(2,'Doble',1),(3,'Triple',1),(4,'Cuadruple',1),(5,'Premiun',1),(6,'Presidencial',1),(7,'Matrimonial',1),(8,'Twin o Matrimonial Superior',1),(9,'Mini Suite',1),(10,'Junior Suite',1),(11,'Cama Adicional',1),(12,'Day use',1),(13,'Master Suite',1),(14,'Deluxe Fits',1),(15,'Suite Matrimonial o Doble',1),(16,'Suite Familiar',1),(17,'Deluxe Simple o Doble',1),(19,'Clásica Simple',1),(20,'Clásica Doble',1),(21,'Deluxe Superior Simple',1),(22,'Deluxe Superior Doble',1),(23,'Junior Suite Doble',1),(24,'Suite Simple',1),(25,'Suite Doble',1),(26,'Colonial Simple o Doble',1),(28,'Junior Suite Colonial Simple o Doble',1),(30,'Suite Colonial Simple o Doble',1),(31,'Suite del Rio',1),(32,'Suite del Lago',1),(33,'Suite Presidencial',1),(34,'Chalet Doble',1),(35,'Standard Doble o Matrimonial',1),(36,'Superior Simple',1),(37,'Superior Doble',1),(38,'Suite',1),(39,'Simple o Matrimonial',1),(40,'Doble o Matrimonial',1),(41,'Triple / Doble Superior',1),(42,'Superior',1),(43,'Scenic View',1),(44,'Classic Simple / Doble',1),(45,'Classic Triple',1),(46,'Concept Simple / Doble',1),(47,'Vip Suite',1),(48,'Superior Deluxe Simple o Doble',1),(49,'Suite Simple o Doble',1),(50,'Cabaña Simple 3D/2N PROG',1),(51,'Cabaña Doble 3D/2N PROG',1),(52,'Simple 3D/2N PROG',1),(53,'Doble 3D/2N PROG',1),(54,'Superior Deluxe',1),(55,'Casita',1),(56,'Suite Patio Simple o Doble',1),(57,'Suite Balcon Simple o Doble',1),(58,'Suite Plaza Simple o Doble',1),(59,'Junior Suite Deluxe',1),(60,'Superior Deluxe Simple',1),(61,'Superior Deluxe Doble',1),(62,'Junior Suite Simple',1),(63,'Superior Simple 3D/2N PROG',1),(64,'Superior Doble 3D/2N PROG',1),(65,'Superior Rio Simple 3D/2N PROG',1),(66,'Superior Rio Doble 3D/2N PROG',1),(67,'Ejecutiva',1),(68,'Standar',1),(69,'Senior Suite',1),(70,'Estandar King',1),(71,'Estandar Queen o Twin',1),(73,'Superior King',1),(74,'Junior Suite King',1),(75,'Suite King',1),(76,'Suite Twin',1),(77,'Bungalows',1),(78,'Superior Twin',1),(79,'Junior Suite Queen  o Twin',1),(80,'Senior Suite Twin o King',1),(81,'Simple o Doble',1),(82,'Superior Simple o Doble',1),(83,'Superior Triple',1),(84,'Superior Simple-Vista al lago',1),(85,'Superior Doble-Vista al Lago',1),(86,'Junior Suite (doble o matrimonial)',1),(87,'Senior Suite (doble o matrimonial)',1),(88,'Suite Superior',1),(89,'Deluxe',1),(90,'Family Deluxe (permite 3 adultos)',1),(91,'Suite Colonial (ex Junior Suite)',1),(92,'Suite Deluxe (ex Suite)',1),(93,'Family Suite (permite 3 adultos)',1),(94,'Superior Garden View',1),(95,'Superior Ocean View',1),(96,'Balcony Suite',1),(97,'Solarium Suite',1),(98,'Westin Workout',1),(99,'Grand Deluxe',1),(100,'Westin Executive',1),(101,'Premium Garden View',1),(102,'Premium Sunset',1),(103,'Premium Sunrise',1),(104,'Colonial Simple',1),(105,'Colonial Doble',1),(106,'Familiar (dos camas matrimoniales) máximo 4 p',1),(107,'Suite Ejecutiva',1),(108,'Estándar King o Twin (02 camas Queen)',1),(109,'Executive Simple',1),(110,'Executive Doble',1),(111,'Simple Ejecutiva',1),(112,'Superior Matrimonial',1),(113,'Quintuple',1),(114,'Sextuple',1),(115,'Doble con vista al río',1),(116,'Doble Matrimonial (Jacuzzi) con vista al rio',1),(117,'Doble (Tina) ST',1),(118,'Doble (Tina) V.P',1),(119,'Sumaq Deluxe Simple',1),(120,'Sumaq Deluxe Doble',1),(121,'Junior Suite Deluxe Simple',1),(122,'Junior Suite Deluxe Doble',1),(123,'Suite Imperial Simple',1),(124,'Suite Imperial Doble',1),(125,'Superior Suite/Triple',1);

/*Table structure for table `hoteles` */

DROP TABLE IF EXISTS `hoteles`;

CREATE TABLE `hoteles` (
  `id_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre_hotel` varchar(75) DEFAULT NULL,
  `estrellas_hotel` varchar(5) DEFAULT NULL,
  `imagen_hotel` varchar(71) DEFAULT NULL,
  `nombre_contacto_hotel` varchar(255) DEFAULT NULL,
  `numero_contacto_hotel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_hotel`),
  KEY `id_departamento_idx` (`id_departamento`),
  KEY `id_empresa_idx` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

/*Data for the table `hoteles` */

insert  into `hoteles`(`id_hotel`,`id_departamento`,`id_empresa`,`nombre_hotel`,`estrellas_hotel`,`imagen_hotel`,`nombre_contacto_hotel`,`numero_contacto_hotel`) values (41,1,42,'Abittare','3','170927102259standar_gallery_front.jpg',NULL,NULL),(42,3,43,'Aranwa Paracas','5','170927103219aranwa-logo.png',NULL,NULL),(43,1,43,'Aranwa Cusco','5','170927103628aranwa-logo.png',NULL,NULL),(44,8,43,'Aranwa Valle Sagrado','5','170927103729aranwa-logo.png',NULL,NULL),(45,10,43,'Aranwa Valle del Colca','4','170927103815aranwa-logo.png',NULL,NULL),(49,12,43,'Aranwa Vichayito','3','170927111100aranwa-logo.png',NULL,NULL),(53,1,55,'Andean Wing','4','171003082122logo-andean-wings.jpg','Fernando Amprimo','(084) 243356'),(54,1,56,'Mabey','3','171003103920htl mabey.jpg','Zoraida Soncco','( 51-84) 255757'),(55,8,56,'Mabey Urubamba','3','171003104056htl mabey.jpg','Zoraida Soncco','(51-84) 255757'),(56,1,57,'Maytaq Wasin Boutique ','3','171003104535maytaq.png','Andrea Velasquez','84 224291 '),(57,1,58,'Carlos Quinto Inn','3','171003112406carlosv.png','Sharon','084-223091'),(59,1,59,'Hilton Garden Inn','4','171003114054hilton garden inn.jpg','Patricia Vargas','934052588'),(60,13,60,'Dazzler','4','171004023331dazzler.png','Sandra Pinglo ','948 058 976 '),(61,1,60,'Esplendor','4','171004024030esplendor.png','Sandra Pinglo ','948 058 976 '),(62,1,61,'El Mapi','4','171004031405el mapi.jpg','Gabriela Bravo','610 0400'),(63,22,61,'Inkaterra Hacienda Concepcion','5','171004032125hacienda concepcion.jpg','Gabriela Bravo','610 0400'),(64,8,61,'Inkaterra Hacienda Urubamba','5','171004034006hacienda urubamba.png','Gabriela Bravo','610 0400'),(65,1,61,'Inkaterra La Casona','5','171004034717la casona.jpg','Gabriela Bravo','610 0400'),(66,9,61,'Inkaterra Machu Picchu Pueblo','5','171004040326inkaterramachupicchupueblo-logo.jpg','Gabriela Bravo','610 0400'),(67,22,61,'Inkaterra Reserva Amazonica','5','171004042717reserva amazonica.gif','Gabriela Bravo','610 0400'),(68,14,62,'Sonesta El Olivar','5','171004045936hotel-sonesta.jpg','Daniela Soria','712-6050 '),(69,1,62,'Sonesta Cusco','4','171004051230hotel-sonesta.jpg','Daniela Soria','(01)712-6050'),(70,13,62,'Sonesta Posada del Inka Miraflores','3','171004051503hotel-sonesta.jpg','Daniela Soria','712-6050 '),(71,8,62,'Sonesta Posada del Inca Yucay','4','171004052311hotel-sonesta.jpg','Daniela Soria','712-6050 '),(72,19,62,'Sonesta Posada del Inka Puno','4','171004052928hotel-sonesta.jpg','Daniela Soria','712-6050 '),(73,13,63,'Tierra Viva Miraflores Larco','3','171004072301tierra viva htls.jpg','Isabel Rojas','445-3613 '),(74,1,63,'Tierra Viva Centro','3','171004073221tierra viva htls.jpg','Isabel Rojas','445-3613 '),(75,1,63,'Tierra Viva Plaza','3','171004073748tierra viva htls.jpg','Isabel Rojas','445-3613 '),(76,1,63,'Tierra Viva Shapi','3','171004074356tierra viva htls.jpg','Isabel Rojas','445-3613 '),(77,1,63,'Tierra Viva San Blas','3','171004080339tierra viva htls.jpg','Isabel Rojas','445-3613 '),(78,9,63,'Tierra Viva Machu Picchu','3','171004081035tierra viva htls.jpg','Isabel Rojas','445-3613 '),(79,8,63,'Tierra Viva Valle Sagrado','3','171004081308tierra viva htls.jpg','Isabel Rojas','445-3613 '),(80,19,63,'Tierra Viva Puno','3','171004082104tierra viva htls.jpg','Isabel Rojas','445-3613 '),(81,2,63,'Tierra Viva Arequipa','3','171004082527tierra viva htls.jpg','Isabel Rojas','445-3613 '),(82,13,64,'Miramar','3','171004095638miramar.png','Mara Quispe','208-9707 '),(83,13,65,'Ferre Miraflores','3','171004101834ferre.png','Juan Andres Garcia','447 3456'),(84,13,65,'Ferre de Ville','3','171004102641ferre.png','Juan Andres Garcia','447 3456'),(85,9,65,'Ferre Machu Picchu','3','171004103033ferre.png','Juan Andres Garcia','447 3456'),(86,1,65,'Ferre Cusco','3','171004103418ferre.png','Juan Andres Garcia','447 3456'),(87,13,66,'Estelar Miraflores','5','171004105836estelar.jpg','Katia Juarez','989 058 361'),(88,13,66,'Estelar Apartamentos Bellavista','4','171004112235estelar.jpg','Katia Juarez','989 058 361'),(89,15,66,'Estelar Vista Pacifico','5','171004113245estelar.jpg','Katia Juarez','989 058 361'),(90,2,66,'Estelar El Lago','5','171004113632estelar.jpg','Katia Juarez','989 058 361'),(91,1,68,'Cusco Plaza Shapy','3','171005032746shapy.png','Charmely Tintaya','84 263000'),(92,1,68,'Cusco plaza Nazarenas','3','171005033145nazarenas.png','Charmely Tintaya','84 263000'),(93,13,69,'Casa Andina Standar Miraflores Centro','3','171005041832casa andina.jpeg','Luis Alfonso','2133759'),(94,13,69,'Casa Andina Standar Miraflores San Antonio','3','171005042235casa andina.jpeg','Luis Alfonso','2133759'),(95,23,69,'Casa Andina Standard Chincha','3','171005043014casa andina.jpeg','Luis Alfonso','2133759'),(96,24,69,'Casa Andina Standard Nasca','3','171005043600casa andina.jpeg','Luis Alfonso','2133759'),(97,2,69,'Casa Andina Standard ','3','171005044243casa andina.jpeg','Luis Alfonso','2133759'),(98,10,69,'Casa Andina Standard','3','171005044605casa andina.jpeg','Luis Alfonso','2133759'),(99,19,69,'Casa Andina Standard ','3','171005044832casa andina.jpeg','Luis Alfonso','2133759'),(100,1,69,'Casa Andina Standard Koricancha o San Blas','3','171005045126casa andina.jpeg','Luis Alfonso','2133759'),(101,1,69,'Casa Andina Standard Plaza o Catedral','3','171005050132casa andina.jpeg','Luis Alfonso','2133759'),(102,9,69,'Casa Andina Standard ','3','171005050851casa andina.jpeg','Luis Alfonso','2133759'),(103,26,69,'Casa Andina Standard','3','171005051804casa andina.jpeg','Luis Alfonso','2133759'),(104,25,69,'Casa Andina Standard','3','171005053137casa andina.jpeg','Luis Alfonso','2133759'),(105,13,69,'Casa Andina Select ','4','171005053525casa andina.jpeg','Luis Alfonso','2133759'),(106,2,69,'Casa Andina Select','4','171005054150casa andina.jpeg','Luis Alfonso','2133759'),(107,4,69,'Casa Andina Select','4','171005055336casa andina.jpeg','Luis Alfonso','2133759'),(108,28,69,'Casa Andina Select Zorritos','4','171005060132casa andina.jpeg','Luis Alfonso','2133759'),(109,29,69,'Casa Andina Select ','4','','Luis Alfonso','2133759'),(110,30,69,'Casa Andina Select','4','171005061439casa andina.jpeg','Luis Alfonso','2133759'),(111,13,69,'Casa Andina Premium','4','171005061859casa andina.jpeg','Luis Alfonso','2133759'),(112,19,69,'Casa Andina Premium','4','171005063145casa andina.jpeg','Luis Alfonso','2133759'),(113,1,69,'Casa Andina Premium','5','171005075812casa andina.jpeg','Luis Alfonso','2133759'),(114,8,69,'Casa Andina Premium','4','171005080359casa andina.jpeg','Luis Alfonso','2133759'),(115,2,69,'Casa Andina Premium','5','171005081044casa andina.jpeg','Luis Alfonso','2133759'),(116,20,69,'Casa Andina Premium Trujillo','4','171005081555casa andina.jpeg','Luis Alfonso','2133759'),(117,26,69,'Casa Andina Premium ','4','','Luis Alfonso','2133759'),(118,8,70,'Hacienda del Valle','3','171005092740hacienda del peru.png','Heidy Juarez','084 201408'),(119,19,70,'Hoteles Hacienda del Peru','3','171005094059hacienda del peru.png','Heidy Juarez','051 356109'),(120,19,70,'Hoteles Hacienda Plaza de Armas','3','171005095439hacienda del peru.png','Heidy Juarez','051 356109'),(121,1,71,'Los Andes de America','3','171005100736los andes de america.png','Patricia Gamarra','(51) 472-4350'),(122,1,72,'El Puma ','3','171005103751el puma.jpg','Gabriela','(84) 257402 '),(123,1,73,'Monasterio San Pedro','3','171005110150monasterio san pedro.png','Asunta Ccoscco Visa','966387933'),(124,1,74,'Libertador Palacio del Inka a Luxury Collection ','5','171006025126libertador.jpg','Tania Calderon','712 7000 '),(125,8,74,'Libertador Tambo del Inka, a Luxury Collection','5','171006033122libertador.jpg','Tania Calderon','712 7000 '),(126,8,74,'Libertador Tambo del Inka, a Luxury Collection','5','171006033125libertador.jpg','Tania Calderon','712 7000 '),(127,3,74,'Libertador Paracas, a Luxury Collection Resort','5','171006033913libertador.jpg','Tania Calderon','712 7000 '),(128,13,74,'Westin Lima Hotel & Convention Center','5','171006035153libertador.jpg','Tania Calderon','712 7000 '),(129,14,74,'Libertador Lima','4','171006040900libertador.jpg','Tania Calderon','712 7000 '),(130,2,74,'Libertador Arequipa','4','171006041419libertador.jpg','Tania Calderon','712 7000 '),(131,20,74,'Libertador Trujillo','5','171006042714libertador.jpg','Tania Calderon','712 7000 '),(132,19,74,'Libertador Lago Titicaca','5','171006043726libertador.jpg','Tania Calderon','712 7000 '),(133,1,75,'Novotel ','4','171006045919novotel.png','Claudia Mar','710 3500 '),(134,13,76,'Faraona Grand Hotel','3','171006051355faraona.png','Zenia Rubio','446-9414  '),(135,13,77,'Habitat','3','171006052637habitat.jpg','Milagros Curay','2422222 '),(136,14,78,'Atton','4','171006054417atton.jpg','Carlos Bustamante','208 1200'),(137,13,79,'Lima Wasi','3','171006055307lima wasi.png','Nilton Gordillo','2430721'),(138,14,75,'Novotel','4','171006080824novotel.png','Claudia Mar','710 3500 '),(139,13,80,'Leon de Oro','3','171006105354leon de oro.png','Sally Romero','242-6200'),(140,1,81,'Ruinas','3','171006112054ruinas.jpg','Larissa Zuñiga','984923726'),(141,1,82,'San Francisco Plaza','3','171006113819san francisco plaza.png','Susan Castillo','084-253932 '),(142,9,83,'La Cabaña','3','171007120237la cabaña.png','Jackeline Chambilla','(084)263230 '),(143,3,84,'Mirador','3','171007024537mirador.jpg','Luis Bacca','056 545086'),(144,3,85,'Paracas Sunset','3','171007030405paracas sunset.jpg','Analuz Hernandez Cassia','056 534473'),(145,3,85,'Paracas Sunset','3','171007030408paracas sunset.jpg','Analuz Hernandez Cassia','056 534473'),(146,3,85,'Refugio del Pirata','2','171007030915refugio.jpg','Analuz Hernandez Cassia','056 534473'),(147,3,86,'Gran Palma','3','171007031744gran palma.png','Jennifer Torres','984-352785 '),(148,10,87,'Colca Lodge','4','171007034729colca lodge.png','Omar Mantilla','054 202587'),(149,10,88,'Colca inn','3','171007040444colca inn.png','Yaneth amaelendez','054-531111  '),(150,10,89,'Colcallaqta','3','171007042103logo_llaqta.jpg','Maria Portugal','054 531280'),(151,10,90,'Pozo del Cielo','3','171007043109pozo del cielo.png','Lilian Sumire','054 211467'),(152,2,91,'Fundador','4','171009023900fundador.png','Maria Teresa Palomino','054 284848'),(153,2,92,'Maison Du Soleil','3','171009032100maison.png','Soledad Amado ','054 242108'),(154,1,94,'Antawasi','2','171009050928antawasi.png','Marita Ccahua','084 241267'),(155,1,95,'Munay Wasi Inn','3','171009051919munay.jpg','Nelida Lopez','84-224312'),(156,1,96,'Koyllur','3','','Merlly Bethyana','084 245118'),(157,1,97,'Midori','3','171009060148midori.png','María Antonieta','84-248144'),(158,13,98,'Stefanos','3','171009103113ste.png','Jackeline Granados','446 3212'),(159,15,99,'Rivera Inn','3','171009111626rivera.jpg','Mlissa Duran','442 0641'),(160,1,101,'Rumi Punku','3','171010023446rumi.png','Anibal Bejar','084 221102'),(161,1,102,'La Posada del Viajero','2','171010025637posada.png','Dan Ferro','956333791'),(162,1,103,'Plaza de Armas','3','171010031226plaza de armas.png','Madeleine Urquizo','084 431355'),(163,8,104,'Villa Urubamba','3','171010034150villa.png','Rene Gmunder','084 205133'),(164,9,105,'Hanaqpacha Inn','1','171010040618hanaq.jpg','Cinthya','084 314007'),(165,9,106,'Sierra Andina','3','171010042255terra.gif','Cinthya','084 211102'),(166,9,106,'Presidente','2','171010043601terra.gif','Cinthya','084 211212'),(167,9,106,'Continental','1','171010044553terra.gif','Cinthya','084 211144'),(168,9,106,'Machupicchu','1','','Cinthya','084 211095'),(169,9,107,'Sumaq','5','171010050635sumaq.jpg','Daniela Rojas','445 7828'),(170,9,108,'Waman','3','171010075854waman.jpg','Waman','084 223533'),(171,14,109,'Oro Inn ','3','','Geraldine Quispe','441 1533 '),(172,13,110,'Miraflores Colon Hotel','4','171010083431colon.png','Cinthya Pariona','610-0900 '),(173,13,111,'Hilton','5','171010085059hilton.png','Mariella Ausejo','200 8017'),(174,13,112,'Tambo 1','3','171010092617tambo.png','Claudia Quiñones','219-4080 '),(175,13,112,'Tambo II','3','171010093255tambo2.png','Claudia Quiñones','219-4080 '),(176,13,112,'Tambo Dos de Mayo','3','171010100230dos de mayo.png','Claudia Quiñones','219-4080 '),(177,13,113,'Ducado','3','171010101846ducado.jpg','Fatima Hurtado','4471919'),(178,13,114,'Carmel','3','171011030056carmel.png','Pilar Vaiz','241-8672 '),(179,13,115,'Allpa Hotel & Suites','3','171011032037allpa.png','Patricia Moreno','4979745'),(180,13,116,'Lima Wasi','3','171011033415limawasi.png','Nilton Gordillo','2430721'),(181,13,111,'Inkari','3','171011035130inkari.png','Mey Lin Novoa','209 7300'),(182,8,117,'Pakaritampu','3','171011085331pakaritampu.jpg','Hermelinda','(84)204020 '),(183,9,118,'Inka Town - Tower','3','171011102218inkatown.jpg','Patricia Anaya','941411784'),(184,1,119,'Royal Inka  I ','3','171011103812royal inka.png','Deyli Canto','084 263276'),(185,1,120,'Prisma','3','171011105230prismo.png','Vanesa','084 2254412'),(186,9,121,'Inti Punku Machupicchu','3','171011111213intipunku.png','Pedro Chavez Mora','(84) 652 482'),(187,9,121,'Inti Punku El Tambo','3','171012110650intipunku.jpg','Pedro Chavez','084 652 482'),(188,9,121,'Inti Punku Alameda Inn','3','171012111249intipunku.jpg','Pedro Chavez Mora','(84) 652 482'),(189,9,122,'Gringo Bills','3','171012113824gringo.png','Elemer Huaman','084 211046'),(190,1,123,'Rey Antares','2','171012115552antares.png','Erika','084 225420'),(191,32,124,'La Casona de Chachapoyas','3','171013024640casona.png','Gloria','(041) 477353'),(192,32,126,'La Casona Monsante','3','171013034227casona monsante.png','Gloria','933216097'),(193,32,127,'Villa de Paris','3','171013040343villa de paris.png','Gloria','041 631310'),(194,1,129,'Yabar Hotel Cusco Suite','3','171013051048yabar.png','Nelly Sotelo','948 51 64 80 '),(195,4,130,'Winmeier','3','171013060102meier.png','Janet Requejo','993505733');

/*Table structure for table `hoteles_tarifas` */

DROP TABLE IF EXISTS `hoteles_tarifas`;

CREATE TABLE `hoteles_tarifas` (
  `id_hotel_tarifa` int(11) NOT NULL AUTO_INCREMENT,
  `id_hotel` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `tipo_hotel_tarifa` int(11) NOT NULL,
  `precio_hotel_tarifa` float DEFAULT NULL,
  PRIMARY KEY (`id_hotel_tarifa`),
  KEY `id_hotel_idx` (`id_hotel`),
  KEY `id_tipo_habitacion_idx` (`id_habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=1208 DEFAULT CHARSET=latin1;

/*Data for the table `hoteles_tarifas` */

insert  into `hoteles_tarifas`(`id_hotel_tarifa`,`id_hotel`,`id_habitacion`,`tipo_hotel_tarifa`,`precio_hotel_tarifa`) values (13,27,3,0,45),(17,27,1,0,1),(21,27,4,0,3),(22,28,2,0,450),(23,27,3,0,45),(24,31,6,0,35),(38,42,1,1,192),(40,42,1,2,165),(42,53,1,1,139.24),(43,53,2,1,139.24),(44,53,3,1,180.54),(50,53,1,2,118),(51,53,2,2,118),(52,53,3,2,153),(58,53,8,1,160.48),(59,53,8,2,136),(60,53,9,1,201.78),(61,53,10,1,223.02),(62,53,13,1,243.08),(63,53,11,1,47.2),(64,53,12,1,70.8),(65,53,9,2,171),(66,53,10,2,189),(67,53,13,2,206),(68,53,11,2,40),(69,53,12,2,60),(70,42,2,1,192),(71,42,2,2,165),(72,42,15,1,262.4),(73,42,15,2,225.5),(74,42,16,1,345.6),(75,42,16,2,297),(76,42,13,1,384),(77,42,13,2,330),(78,43,19,1,204.8),(79,43,20,1,204.8),(80,43,17,1,224),(81,43,18,1,224),(82,43,21,1,243.2),(83,43,22,1,243.2),(84,43,23,1,307.2),(85,43,24,1,332.8),(86,43,25,1,332.8),(87,43,19,2,176),(88,43,20,2,176),(89,43,17,2,192.5),(90,43,18,2,192.5),(91,43,21,2,209),(92,43,22,2,209),(93,43,23,2,264),(94,43,24,2,286),(95,43,25,2,286),(96,44,26,1,204.8),(97,44,27,1,204.8),(98,44,17,1,224),(99,44,18,1,224),(100,44,28,1,352),(101,44,30,1,499.2),(102,44,31,1,896),(103,44,32,1,1088),(104,44,26,2,176),(105,44,17,2,192.5),(106,44,28,2,302.5),(107,44,30,2,429),(108,44,31,2,770),(109,44,32,2,935),(110,45,17,1,166.4),(111,45,17,2,143),(112,45,24,1,243.2),(113,45,24,2,209),(114,45,34,1,275.2),(115,45,34,2,236.5),(116,41,39,1,89.6),(117,41,35,1,102.4),(118,41,36,1,96),(119,41,37,1,108.8),(120,41,10,1,126.72),(121,41,38,1,147.2),(122,41,39,2,77),(123,41,35,2,88),(124,41,36,2,82.5),(125,41,37,2,93.5),(126,41,10,2,108.9),(127,41,38,2,126.5),(128,54,1,1,51.92),(129,54,40,1,57.82),(130,54,3,1,75.52),(131,54,10,1,94.4),(132,54,38,1,118),(133,54,11,1,17.7),(134,54,1,2,44),(135,54,40,2,49),(136,54,3,2,64),(137,54,10,2,80),(138,54,38,2,100),(139,54,11,2,15),(140,55,1,1,61.36),(141,55,40,1,67.26),(142,55,3,1,79.06),(143,55,10,1,106.2),(144,55,38,1,129.8),(145,55,11,1,23.6),(146,55,1,2,52),(147,55,40,2,57),(148,55,3,2,67),(149,55,10,2,90),(150,55,38,2,110),(151,55,11,2,20),(152,56,1,1,70.8),(153,56,2,1,84.96),(154,56,41,1,123.9),(155,56,4,1,147.5),(156,56,1,2,60),(157,56,2,2,72),(158,56,41,2,105),(159,56,4,2,125),(160,57,1,1,35.4),(161,57,40,1,47.2),(162,57,3,1,59),(163,57,4,1,82.6),(164,57,1,2,30),(165,57,40,2,40),(166,57,3,2,50),(167,57,4,2,70),(168,59,42,1,128),(169,59,43,1,153.6),(170,59,38,1,230.4),(172,59,42,2,110),(173,59,43,2,132),(174,59,38,2,198),(175,60,44,1,140.8),(176,60,45,1,166.4),(177,60,38,1,179.2),(178,60,44,2,121),(179,60,45,2,143),(180,60,38,2,154),(181,61,46,1,115.2),(182,61,38,1,153.6),(183,61,47,1,179.2),(184,61,46,2,99),(185,61,38,2,132),(186,61,47,2,154),(187,62,48,1,207.68),(188,62,49,1,259.6),(189,62,11,1,51.92),(190,62,48,2,176),(191,62,49,2,220),(192,62,11,2,44),(194,63,52,1,343.2),(195,63,53,1,591.36),(196,63,52,2,343.2),(197,63,53,2,591.36),(198,63,50,1,417.12),(199,63,51,2,675.84),(200,63,51,1,675.84),(201,63,50,2,417.2),(202,64,54,1,376.32),(203,64,55,1,430.08),(204,64,10,1,627.2),(205,64,38,1,761.6),(206,64,54,2,323.4),(207,64,55,2,369.9),(208,64,10,2,539),(209,64,38,2,654.5),(210,65,56,1,413.44),(211,65,57,1,533.12),(212,65,58,1,641.92),(213,65,56,2,355.3),(214,65,57,2,458.15),(215,65,58,2,551.65),(216,66,36,1,428.67),(217,66,37,1,541.82),(218,66,60,1,480.89),(219,66,61,1,595.14),(222,66,62,1,533.12),(223,66,23,1,647.37),(224,66,11,1,167.55),(225,66,36,2,368.39),(226,66,37,2,465.63),(227,66,60,2,413.27),(228,66,61,2,511.45),(229,66,62,2,458.15),(230,66,23,2,556.33),(231,66,11,2,143.99),(232,67,63,1,572.22),(233,67,64,1,920.04),(234,67,65,1,695.64),(235,67,66,1,1095.82),(236,67,63,2,572.22),(237,67,64,2,920.04),(238,67,65,2,695.64),(239,67,66,2,1095.82),(240,68,1,1,204.8),(241,68,2,1,217.6),(242,68,67,1,284.16),(243,68,38,1,369.92),(244,68,1,2,176),(245,68,2,2,187),(246,68,67,2,244.2),(247,68,38,2,317.9),(248,70,1,1,119.04),(249,70,2,1,128),(250,70,3,1,165.12),(251,70,38,1,204.8),(252,70,1,2,102.3),(253,70,2,2,110),(254,70,3,2,141.9),(255,70,38,2,176),(256,71,1,1,126.72),(257,71,2,1,126.72),(258,71,3,1,165.12),(259,71,38,1,165.12),(260,71,1,2,108.9),(261,71,2,2,108.9),(262,71,3,2,141.9),(263,71,38,2,141.9),(264,72,1,1,119.04),(265,72,2,1,125.44),(266,72,3,1,162.56),(267,72,1,2,102.3),(268,72,2,2,107.8),(269,72,3,2,139.7),(270,73,1,1,106.2),(271,73,68,1,118),(272,73,42,1,141.6),(273,73,1,2,90),(274,73,68,2,100),(275,73,42,2,120),(276,74,1,1,82.6),(277,74,68,1,94.4),(278,74,42,1,118),(279,74,38,1,153.4),(280,74,1,2,70),(281,74,68,2,80),(282,74,42,2,100),(283,74,38,2,130),(284,75,1,1,82.6),(285,75,68,1,94.4),(286,75,42,1,118),(287,75,38,1,153.4),(288,75,1,2,70),(289,75,68,2,80),(290,75,42,2,100),(291,75,38,2,130),(292,76,1,1,82.6),(293,77,1,1,82.6),(294,77,68,1,94.4),(295,77,42,1,118),(296,77,38,1,153.4),(297,77,1,2,70),(298,77,68,2,80),(299,77,42,2,100),(300,77,38,2,130),(301,78,1,1,129.8),(302,78,68,1,129.8),(303,78,42,1,177),(304,78,38,1,295),(305,78,1,2,110),(306,78,68,2,110),(307,78,42,2,150),(308,78,38,2,250),(309,79,1,1,82.6),(310,79,68,1,82.6),(311,79,42,1,141.6),(313,79,68,2,70),(315,79,1,2,70),(316,79,42,2,120),(317,80,1,1,64.9),(318,80,68,1,76.7),(319,80,42,1,100.3),(320,80,38,1,123.9),(321,80,1,2,55),(322,80,68,2,65),(323,80,42,2,85),(324,80,38,2,105),(325,81,1,1,76.7),(326,81,68,1,88.5),(327,81,42,1,112.1),(328,81,38,1,147.5),(329,81,1,2,65),(330,81,68,2,75),(331,81,42,2,95),(332,81,38,2,125),(333,82,1,1,68.44),(334,82,40,1,70.8),(335,82,3,1,94.4),(336,82,4,1,118),(337,82,38,1,94.4),(338,82,11,1,29.5),(339,82,1,2,58),(340,82,40,2,60),(341,82,3,2,80),(342,82,4,2,100),(343,82,38,2,80),(344,82,11,2,25),(345,83,1,1,82.6),(346,83,40,1,82.6),(347,83,3,1,106.2),(348,83,69,1,141.6),(349,83,1,2,70),(350,83,40,2,70),(351,83,3,2,90),(352,83,69,2,120),(353,84,1,1,64.9),(354,84,40,1,64.9),(355,84,3,1,88.5),(356,84,1,2,55),(357,84,40,2,55),(358,84,3,2,75),(359,85,1,1,129.8),(360,85,40,1,129.8),(361,85,3,1,165.2),(362,85,69,1,236),(363,85,1,2,110),(364,85,40,2,110),(365,85,3,2,140),(366,85,69,2,200),(367,86,1,1,61.36),(368,86,40,1,61.36),(369,86,3,1,84.96),(370,86,1,2,52),(371,86,40,2,52),(372,86,3,2,72),(373,87,70,1,140.8),(374,87,71,1,140.8),(375,87,73,1,140.8),(376,87,74,1,230.4),(377,87,70,2,121),(378,87,71,2,121),(379,87,73,2,121),(380,87,74,2,198),(381,88,79,1,102.4),(382,88,80,1,102.4),(383,88,79,2,88),(384,88,80,2,88),(385,89,75,1,267.52),(386,89,76,1,267.52),(387,89,77,1,369.92),(388,89,75,2,229.9),(389,89,76,2,229.9),(390,89,77,2,317.9),(391,90,78,1,76.8),(392,90,73,1,76.8),(393,90,74,1,102.4),(394,90,78,2,66),(395,90,73,2,66),(396,90,74,2,88),(397,91,1,1,49.56),(398,91,2,1,65.54),(399,91,3,1,86.14),(400,91,1,2,42),(401,91,2,2,53),(402,91,3,2,73),(403,92,1,1,43.66),(404,92,2,1,55.46),(405,92,3,1,79.06),(406,92,1,2,37),(407,92,2,2,47),(408,92,3,2,67),(409,93,81,1,106.43),(410,93,81,2,90.2),(411,94,81,1,106.34),(412,94,81,2,90.2),(413,95,81,1,96.05),(414,95,3,1,144.07),(415,95,42,1,109.03),(416,95,10,1,141.48),(417,95,81,2,81.4),(418,95,3,2,122.1),(419,95,42,2,92.4),(420,95,38,2,119.9),(421,96,81,1,79.17),(422,96,3,1,118.76),(423,96,42,1,88.26),(424,96,81,2,67.1),(425,96,3,2,100.65),(426,96,42,2,74.8),(427,97,81,1,80.47),(428,97,3,1,120.71),(429,97,81,2,68.2),(430,97,3,2,102.3),(431,98,81,1,79.17),(432,98,3,1,118.76),(433,98,81,2,67.1),(434,98,3,2,100.65),(435,99,81,1,79.17),(436,99,3,1,118.76),(437,99,81,2,67.1),(438,99,3,2,100.65),(439,100,81,1,109.03),(440,100,3,1,163.54),(441,100,42,1,119.41),(442,100,38,1,145.37),(443,100,81,2,92.4),(444,100,3,2,138.6),(445,100,42,2,101.2),(446,100,38,2,123.2),(447,101,81,1,111.62),(448,101,3,1,167.44),(449,101,10,1,136.29),(450,101,81,2,94.6),(451,101,3,2,141.9),(452,101,10,2,115.5),(453,102,81,1,134.99),(454,102,3,1,202.48),(455,102,82,1,166.14),(456,102,10,1,198.59),(457,102,81,2,114.4),(458,102,3,2,171.6),(459,102,82,2,140.8),(460,102,10,2,168.3),(461,103,1,1,81.77),(462,103,2,1,97.35),(463,103,1,2,69.3),(464,103,2,2,82.5),(465,104,1,1,90.86),(466,104,2,1,97.35),(467,104,10,1,112.92),(468,104,1,2,77),(469,104,2,2,82.5),(470,104,10,2,95.7),(471,105,1,1,114.22),(472,105,2,1,120.71),(473,105,3,1,181.07),(474,105,10,1,140.18),(475,105,38,1,159.65),(476,105,1,2,96.8),(477,105,2,2,102.3),(478,105,3,2,153.45),(479,105,10,2,118.8),(480,105,38,2,135.3),(481,106,1,1,120.71),(482,106,2,1,127.2),(483,106,38,1,192.1),(484,106,1,2,102.3),(485,106,2,2,107.8),(486,106,38,2,162.8),(487,107,1,1,107.73),(488,107,2,1,114.22),(489,107,10,1,129.8),(490,107,38,1,149.27),(491,107,1,2,91.3),(492,107,2,2,96.8),(493,107,10,2,110),(494,107,38,2,126.5),(495,108,1,1,116.82),(496,108,2,1,123.31),(497,108,38,1,149.27),(498,108,69,1,162.25),(499,108,1,2,99),(500,108,2,2,104.5),(501,108,38,2,126.5),(502,108,69,2,137.5),(503,109,1,1,97.88),(504,109,2,1,104.07),(505,109,10,1,117.7),(506,109,1,2,82.95),(507,109,2,2,88.2),(508,109,10,2,99.75),(509,110,1,1,101.24),(510,110,2,1,107.73),(511,110,10,1,124.6),(512,110,1,2,85.8),(513,110,2,2,91.3),(514,110,10,2,105.6),(515,111,1,1,168.74),(516,111,2,1,177.82),(517,111,36,1,179.12),(518,111,37,1,188.21),(519,111,83,1,282.31),(520,111,38,1,223.25),(521,111,69,1,236.23),(522,111,1,2,143),(523,111,2,2,150.7),(524,111,36,2,151.8),(525,111,37,2,159.5),(526,111,83,2,239.25),(527,111,38,2,189.2),(528,111,69,2,200.2),(529,112,36,1,137.58),(530,112,37,1,144.07),(531,112,83,1,216.11),(532,112,84,1,150.56),(533,112,85,1,157.05),(534,112,36,2,116.6),(535,112,37,2,122.1),(536,112,83,2,183.15),(537,112,84,2,127.6),(538,112,85,2,133),(539,113,36,1,155.76),(540,113,37,1,162.25),(541,113,83,1,243.37),(542,113,38,1,208.97),(543,113,36,2,132),(544,113,37,2,137.5),(545,113,83,2,206.25),(546,113,38,2,177.1),(547,114,36,1,137.58),(548,114,37,1,144.07),(549,114,83,1,216.11),(550,114,38,1,184.31),(551,114,36,2,116.6),(552,114,37,2,122.1),(553,114,83,2,183.15),(554,114,38,2,156.2),(555,115,36,1,164.84),(556,115,37,1,171.33),(557,115,38,1,210.27),(559,115,36,2,139.7),(560,115,37,2,145.2),(561,115,38,2,178.2),(562,117,36,1,129.8),(563,117,37,1,136.29),(564,117,83,1,272.58),(565,117,10,1,162.25),(566,117,36,2,110),(567,117,37,2,115.5),(568,117,83,2,231),(569,117,10,2,137.5),(570,118,1,1,64.9),(571,118,40,1,70.8),(572,118,3,1,82.6),(573,118,10,1,141.6),(574,118,88,1,182.9),(575,118,1,2,55),(576,118,40,2,60),(577,118,3,2,70),(578,118,10,2,120),(579,118,88,2,155),(580,119,1,1,61.95),(581,119,40,1,61.95),(582,119,3,1,76.65),(583,119,10,1,94.4),(584,119,1,2,52.5),(585,119,40,2,52.5),(586,119,3,2,67.5),(587,119,10,2,80),(588,120,1,1,64.9),(589,120,40,1,64.9),(590,120,3,1,79.65),(591,120,88,1,141.6),(592,120,1,2,55),(593,120,40,2,55),(594,120,3,2,67.5),(595,120,88,2,120),(596,121,1,1,82.6),(597,121,40,1,88.5),(598,121,3,1,112.1),(599,121,10,1,147.5),(600,121,1,2,70),(601,121,40,2,75),(602,121,3,2,95),(603,121,10,2,125),(604,122,1,1,64.9),(605,122,40,1,64.9),(606,122,3,1,82.6),(607,122,42,1,94.4),(608,122,1,2,55),(609,122,40,2,55),(610,122,3,2,70),(611,122,42,2,80),(612,123,1,1,74.34),(613,123,40,1,74.34),(614,123,1,2,63),(615,123,40,2,63),(616,123,36,1,86.14),(617,123,37,1,86.14),(618,123,36,2,73),(619,123,37,2,73),(620,124,42,1,332.8),(621,124,89,1,352),(622,124,90,1,486.4),(623,124,91,1,377.6),(624,124,92,1,390.4),(625,124,93,1,524.8),(626,124,42,2,286),(627,124,89,2,302.5),(628,124,90,2,418),(629,124,91,2,324.5),(630,124,92,2,335.5),(631,124,93,2,451),(632,126,42,1,428.8),(633,126,89,1,446.72),(634,126,10,1,529.92),(635,126,69,1,651.52),(636,126,42,2,367.4),(637,126,89,2,383.9),(638,126,10,2,455.4),(639,126,69,2,559.9),(640,127,94,1,322.56),(641,127,95,1,360.96),(642,127,96,1,450.56),(643,127,97,1,527.36),(644,127,94,2,277.2),(645,127,95,2,310.2),(646,127,96,2,387.2),(647,127,97,2,453.2),(648,128,89,1,303.36),(649,128,98,1,328.96),(650,128,99,1,328.96),(651,128,100,1,367.36),(653,128,89,2,260.7),(654,128,98,2,282.7),(655,128,99,2,282.7),(656,128,100,2,315.7),(657,129,42,1,156.16),(658,129,89,1,175.36),(659,129,99,1,194.56),(660,129,42,2,134.2),(661,129,89,2,150.7),(662,129,99,2,167.2),(663,130,42,1,188.16),(664,130,5,1,200.96),(665,130,101,1,207.36),(666,130,10,1,226.56),(667,130,42,2,161.7),(668,130,5,2,172.7),(669,130,101,2,178.2),(670,130,10,2,194.7),(671,131,42,1,131.84),(672,131,10,1,195.84),(673,131,38,1,234.24),(674,131,42,2,113.3),(676,131,10,2,168.3),(677,131,38,2,201.3),(678,132,42,1,198.4),(679,132,102,1,198.4),(680,132,103,1,217.6),(681,132,10,1,236.8),(682,132,42,2,170.5),(683,132,102,2,170.5),(684,132,103,2,187),(685,132,10,2,203.5),(686,133,1,1,144.64),(687,133,2,1,153.6),(688,133,104,1,211.2),(689,133,105,1,224),(690,133,11,1,38.4),(691,133,1,2,124.3),(692,133,2,2,132),(693,133,104,2,181.5),(694,133,105,2,192.5),(695,133,11,2,33),(696,134,1,1,82.6),(697,134,40,1,86.14),(698,134,3,1,109.74),(699,134,106,1,133.34),(700,134,1,2,70),(701,134,40,2,73),(702,134,3,2,93),(703,134,106,2,113),(704,135,1,1,84.96),(705,135,40,1,96.76),(706,135,3,1,105.56),(707,135,107,1,164.02),(708,135,1,2,72),(709,135,40,2,82),(710,135,3,2,92),(711,135,107,2,139),(712,136,108,1,166.4),(713,136,108,2,143),(714,137,1,1,70.8),(715,137,2,1,118),(716,137,3,1,129.8),(717,137,1,2,60),(718,137,2,2,100),(719,137,3,2,110),(720,138,1,1,148),(721,138,2,1,155),(722,138,109,1,171.32),(723,138,110,1,179.2),(724,138,1,2,126.92),(725,138,2,2,133.69),(726,138,109,2,147.23),(727,138,110,2,154),(728,139,1,1,63.36),(729,139,40,1,64.9),(730,139,67,1,88.5),(731,139,11,1,23.6),(732,139,1,2,52),(733,139,40,2,55),(734,139,67,2,75),(735,139,11,2,20),(736,140,1,1,82.6),(737,140,2,1,106.2),(738,140,11,1,35.4),(739,140,1,2,70),(740,140,2,2,90),(741,140,11,2,30),(742,141,1,1,59),(743,141,2,1,64.9),(744,141,3,1,88.5),(745,141,1,2,50),(746,141,2,2,55),(747,141,3,2,75),(748,141,62,1,118),(749,141,62,2,100),(750,141,23,1,118),(751,141,23,2,100),(752,143,1,1,49.37),(753,143,2,1,64.99),(754,143,3,1,80.24),(755,143,1,2,41.84),(756,143,2,2,55.07),(757,143,3,2,68),(758,144,1,1,53.1),(759,144,2,1,64.9),(760,144,3,1,76.7),(761,144,4,1,88.5),(762,144,1,2,45),(763,144,2,2,55),(764,144,3,2,65),(765,144,4,2,75),(766,146,1,1,29.5),(767,146,2,1,47.2),(768,146,3,1,59),(769,146,4,1,70.8),(770,146,1,2,25),(771,146,2,2,40),(772,146,3,2,50),(773,146,4,2,60),(774,147,1,1,49.01),(775,147,40,1,61.72),(776,147,3,1,78.06),(777,147,4,1,101.66),(779,147,1,2,41.53),(780,147,40,2,52.3),(781,147,3,2,66.15),(783,147,4,2,86.15),(784,148,1,1,163.84),(785,148,2,1,163.84),(786,148,3,1,188.16),(787,148,4,1,215.04),(788,148,10,1,227.84),(789,148,1,2,140.8),(790,148,2,2,140.8),(791,148,3,2,161.7),(792,148,4,2,184.8),(793,148,10,2,195.8),(794,149,1,1,35.4),(795,149,2,1,44.84),(796,149,3,1,55.46),(797,149,11,1,17.7),(798,149,1,2,30),(799,149,2,2,38),(800,149,3,2,47),(801,149,11,2,15),(802,150,1,1,59),(803,150,40,1,64.9),(804,150,3,1,88.5),(805,150,10,1,100.3),(806,150,1,2,50),(807,150,40,2,55),(808,150,3,2,75),(809,150,10,2,85),(810,151,1,1,88.5),(811,151,2,1,88.5),(812,151,3,1,110.92),(813,151,36,1,149.27),(814,151,37,1,149.27),(815,151,1,2,75),(816,151,2,2,75),(817,151,3,2,94),(818,151,36,2,126.5),(819,151,37,2,126.5),(820,152,111,1,70.8),(821,152,40,1,70.8),(822,152,3,1,106.2),(823,152,10,1,94.4),(824,152,11,1,41.3),(825,152,111,2,60),(826,152,40,2,60),(827,152,3,2,90),(828,152,10,2,80),(829,152,11,2,35),(830,153,1,1,47.2),(831,153,40,1,54.28),(832,153,3,1,66.08),(833,153,10,1,77.88),(834,153,11,1,17.7),(835,153,1,2,40),(836,153,2,2,46),(837,153,3,2,56),(838,153,10,2,66),(839,153,11,2,15),(840,154,1,1,53.1),(841,154,2,1,64.9),(842,154,3,1,82.6),(843,154,11,1,25.96),(844,154,1,2,45),(845,154,2,2,55),(846,154,3,2,70),(847,154,11,2,22),(848,155,1,1,74.34),(849,155,40,1,76.7),(850,155,3,1,100.3),(851,155,112,1,112.1),(852,155,1,2,63),(853,155,40,2,65),(854,155,3,2,85),(855,155,112,2,95),(856,156,1,1,64.9),(857,156,2,1,70.8),(858,156,3,1,94.4),(859,156,1,2,55),(860,156,2,2,60),(861,156,3,2,80),(862,157,1,1,64.9),(863,157,2,1,76.7),(864,157,3,1,100.3),(865,157,11,1,35.4),(866,157,1,2,55),(867,157,2,2,65),(868,157,3,2,85),(869,157,11,2,30),(870,158,1,1,67.26),(871,158,40,1,79.06),(872,158,3,1,76.16),(873,158,4,1,123.9),(874,158,42,1,84.96),(875,158,38,1,141.6),(876,158,1,2,57),(877,158,2,2,67),(878,158,3,2,82),(879,158,4,2,105),(880,158,42,2,72),(881,158,38,2,120),(882,158,38,2,120),(883,159,1,1,66),(884,159,2,1,66),(885,159,42,1,69),(886,159,67,1,73),(887,159,1,2,55),(888,159,2,2,56),(889,159,42,2,59),(890,159,67,2,62),(891,160,1,1,94.4),(892,160,40,1,106.2),(893,160,3,1,123.9),(894,160,36,1,106.2),(895,160,37,1,123.9),(896,160,83,1,147.5),(897,160,38,1,177),(898,160,1,2,80),(899,160,40,2,90),(900,160,3,2,105),(901,160,36,2,90),(902,160,37,2,105),(903,160,83,2,125),(904,160,38,2,150),(906,161,1,1,46.02),(907,161,40,1,56.64),(908,161,3,1,67.26),(909,161,4,1,77.88),(910,161,113,1,88.5),(911,161,114,1,99.12),(912,161,1,2,39),(913,161,40,2,48),(914,161,3,2,57),(915,161,4,2,66),(916,161,113,2,75),(917,161,114,2,84),(918,162,1,1,118),(919,162,2,1,129.8),(920,162,37,1,153.4),(921,162,3,1,165.2),(922,162,38,1,224.2),(923,162,10,1,188.8),(924,162,1,2,100),(925,162,2,2,110),(926,162,37,2,130),(927,162,3,2,140),(928,162,38,2,190),(929,162,10,2,160),(930,163,1,1,64.9),(931,163,40,1,91.98),(932,163,11,1,34.22),(933,163,1,2,55),(934,163,40,2,61),(935,163,11,2,29),(936,164,1,1,59),(937,164,2,1,64.9),(938,164,3,1,94.4),(939,164,11,1,29.5),(940,164,1,2,50),(941,164,2,2,55),(942,164,3,2,80),(943,164,11,2,25),(944,165,2,1,83.78),(945,165,3,1,112.1),(946,165,115,1,88.5),(947,165,116,1,93.22),(948,165,2,2,71),(949,165,3,2,95),(950,165,115,2,75),(951,165,116,2,79),(952,166,1,1,56.64),(953,166,40,1,62.54),(954,166,3,1,88.5),(955,166,117,1,69.62),(956,166,118,1,71.98),(957,166,1,2,48),(958,166,40,2,53),(959,166,3,2,75),(960,166,117,2,59),(961,166,118,2,61),(962,167,1,1,48.38),(963,167,40,1,56.64),(964,167,3,1,76.7),(965,167,1,2,41),(966,167,40,2,48),(967,167,3,2,65),(968,168,1,1,42.48),(969,168,40,1,49.56),(970,168,3,1,68.44),(971,168,1,2,36),(972,168,40,2,42),(973,168,3,2,58),(975,169,119,1,417.6),(976,169,120,1,526.08),(977,169,121,1,806.4),(978,169,122,1,1036.8),(979,169,123,1,1382.4),(980,169,119,2,358.87),(981,169,120,2,452.1),(982,169,121,2,693),(983,169,122,2,891),(984,169,123,2,1188),(985,170,1,1,94.4),(986,170,40,1,106.2),(987,170,3,1,129.8),(988,170,1,2,80),(989,170,40,2,90),(990,170,3,2,110),(991,171,1,1,84.96),(992,171,7,1,106.2),(993,171,67,1,127.44),(994,171,2,1,138.06),(995,171,3,1,159.3),(996,171,1,2,72),(997,171,7,2,90),(998,171,67,2,108),(999,171,2,2,117),(1000,171,3,2,135),(1001,172,1,1,94.4),(1002,172,2,1,108.56),(1003,172,3,1,135.7),(1004,172,10,1,142.78),(1005,172,69,1,168.74),(1006,172,1,2,80),(1007,172,2,2,92),(1008,172,3,2,115),(1009,172,10,2,121),(1010,172,69,2,143),(1011,173,1,1,256),(1012,173,2,1,268.8),(1013,173,109,1,353.28),(1014,173,110,1,366.08),(1015,173,1,2,220),(1017,173,2,2,231),(1018,173,109,2,303.6),(1019,173,110,2,314.6),(1020,174,1,1,73.16),(1021,174,40,1,86.14),(1022,174,3,1,100.3),(1023,174,11,1,23.6),(1024,174,1,2,62),(1025,174,40,2,73),(1026,174,3,2,85),(1027,174,11,2,20),(1028,175,1,1,105.02),(1029,175,40,1,92.04),(1030,175,3,1,102.66),(1031,175,11,1,25.96),(1032,175,1,2,89),(1033,175,40,2,78),(1036,175,3,2,87),(1037,175,11,2,22),(1038,176,1,1,79.06),(1039,176,40,1,92.04),(1040,176,3,1,102.66),(1041,176,11,1,25.96),(1042,176,1,2,67),(1043,176,40,2,78),(1044,176,3,2,87),(1045,176,11,2,22),(1046,177,1,1,55.16),(1047,177,40,1,64.9),(1048,177,24,1,71.39),(1049,177,25,1,81.12),(1050,177,1,2,46.75),(1051,177,40,2,55),(1052,177,24,2,60.5),(1053,177,25,2,68.75),(1054,178,1,1,77.88),(1055,178,2,1,84.96),(1056,178,3,1,107.38),(1057,178,10,1,113.28),(1058,178,38,1,139.24),(1059,178,1,2,66),(1060,178,2,2,72),(1061,178,3,2,91),(1062,178,10,2,96),(1063,178,38,2,118),(1064,179,1,1,76.7),(1065,179,2,1,79.06),(1066,179,125,1,114.46),(1067,179,38,1,162.84),(1068,179,1,2,65),(1069,179,2,2,67),(1070,179,125,2,97),(1071,179,38,2,138),(1072,180,1,1,70.8),(1073,180,2,1,77.88),(1074,180,3,1,92.04),(1075,180,1,2,60),(1076,180,2,2,66),(1077,180,3,2,78),(1078,181,2,1,112.1),(1079,181,10,1,112.1),(1080,181,88,1,135.7),(1081,181,3,1,153.4),(1082,181,2,2,95),(1083,181,10,2,95),(1084,181,88,2,115),(1085,181,3,2,130),(1086,182,1,1,144.2),(1087,182,2,1,144.2),(1088,182,42,1,167.98),(1089,182,3,1,183.25),(1090,182,38,1,351.2),(1091,182,1,2,123.93),(1092,182,2,2,123.93),(1093,182,42,2,144.35),(1094,182,3,2,157.46),(1095,182,38,2,301.82),(1096,183,1,1,75.52),(1097,183,40,1,75.52),(1098,183,3,1,112.1),(1099,183,4,1,147.5),(1100,183,11,1,47.2),(1101,183,1,2,64),(1102,183,40,2,64),(1103,183,3,2,95),(1104,183,4,2,125),(1105,183,11,2,40),(1106,184,1,1,63.61),(1107,184,2,1,84.45),(1108,184,11,1,32),(1109,184,1,2,54.67),(1110,184,2,2,72.57),(1111,184,11,2,27.5),(1112,185,1,1,47.2),(1113,185,2,1,53.1),(1114,185,3,1,64.9),(1115,185,11,1,29.5),(1116,185,1,2,40),(1117,185,2,2,45),(1118,185,3,2,55),(1119,185,11,2,25),(1120,186,1,1,100.3),(1121,186,2,1,100.3),(1122,186,3,1,147.5),(1123,186,37,1,135.7),(1124,186,38,1,177),(1125,186,1,2,85),(1126,186,2,2,95),(1127,186,3,2,125),(1128,186,37,2,115),(1129,186,38,2,150),(1130,187,1,1,100.3),(1131,187,2,1,100.3),(1132,187,3,1,135.7),(1133,187,1,2,85),(1134,187,2,2,85),(1135,187,3,2,115),(1136,188,1,1,88.5),(1137,188,2,1,88.5),(1138,188,3,1,123.9),(1139,188,1,2,75),(1140,188,2,2,75),(1141,188,3,2,105),(1142,189,1,1,100.3),(1143,189,40,1,100.3),(1144,189,3,1,129.8),(1145,189,25,1,147.5),(1146,189,1,2,85),(1147,189,40,2,85),(1148,189,3,2,110),(1149,189,25,2,125),(1150,190,1,1,27.14),(1151,190,40,1,35.4),(1152,190,3,1,53.1),(1153,190,11,1,17.7),(1154,190,1,2,23),(1155,190,40,2,30),(1156,190,3,2,45),(1157,190,11,2,15),(1158,191,1,1,43.07),(1159,191,36,1,46.15),(1160,191,40,1,58.46),(1161,191,112,1,58.46),(1162,191,3,1,73.84),(1163,191,11,1,18.46),(1164,191,1,2,43.07),(1165,191,36,2,46.15),(1166,191,40,2,58.46),(1167,191,112,2,58.46),(1168,191,3,2,73.84),(1169,191,11,2,18.46),(1170,192,1,1,52.3),(1171,192,40,1,67.69),(1172,192,3,1,98.46),(1173,192,4,1,113.84),(1174,192,112,1,83.07),(1175,192,1,2,52.3),(1176,192,40,2,67.69),(1177,192,3,2,98.46),(1178,192,4,2,113.84),(1179,192,112,2,83.07),(1180,193,1,1,30.76),(1181,193,2,1,43.07),(1182,193,7,1,40),(1183,193,3,1,58.46),(1184,193,4,1,73.84),(1185,193,1,2,30.76),(1186,193,2,2,43.07),(1187,193,7,2,40),(1188,193,3,2,58.46),(1189,193,4,2,73.84),(1190,194,1,1,76.7),(1191,194,40,1,94.4),(1192,194,3,1,135.7),(1193,194,4,1,165.2),(1194,194,11,1,23.6),(1195,194,1,2,65),(1196,194,40,2,80),(1197,194,3,2,115),(1198,194,4,2,140),(1199,194,11,2,20),(1200,195,1,1,56),(1201,195,40,1,66.46),(1202,195,3,1,76.92),(1203,195,38,1,97.53),(1204,195,1,2,45.92),(1205,195,40,2,54.49),(1206,195,3,2,63.07),(1207,195,38,2,79.98);

/*Table structure for table `idiomas` */

DROP TABLE IF EXISTS `idiomas`;

CREATE TABLE `idiomas` (
  `id_idioma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_idioma` varchar(100) NOT NULL,
  `imagen_idioma` varchar(100) NOT NULL,
  `archivo_idioma` varchar(150) NOT NULL,
  `estado_idioma` int(1) NOT NULL,
  PRIMARY KEY (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `idiomas` */

insert  into `idiomas`(`id_idioma`,`nombre_idioma`,`imagen_idioma`,`archivo_idioma`,`estado_idioma`) values (1,'Espa?ol','es.png','inc.spanish.php',1);

/*Table structure for table `inclusiones` */

DROP TABLE IF EXISTS `inclusiones`;

CREATE TABLE `inclusiones` (
  `id_inclusion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_inclusion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_inclusion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inclusiones` */

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` char(31) NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `modulos` */

insert  into `modulos`(`id_modulo`,`nombre_modulo`) values (1,'Inicio'),(2,'Administrar'),(3,'Pedidos'),(5,'Reportes'),(6,'Herramientas');

/*Table structure for table `paises` */

DROP TABLE IF EXISTS `paises`;

CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `nombre_pais` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paises` */

insert  into `paises`(`id_pais`,`nombre_pais`) values (1,'Peru');

/*Table structure for table `paquetes` */

DROP TABLE IF EXISTS `paquetes`;

CREATE TABLE `paquetes` (
  `id_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_paquete` varchar(45) CHARACTER SET latin1 NOT NULL,
  `descripcion_paquete` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imagen_paquete` varchar(71) DEFAULT '',
  PRIMARY KEY (`id_paquete`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Data for the table `paquetes` */

insert  into `paquetes`(`id_paquete`,`nombre_paquete`,`descripcion_paquete`,`imagen_paquete`) values (47,'Paquete a Arequipa aaaaaa','Descripcion de paquete Arequipa bbbbb','171025103452vannesa.jpg'),(49,'Paquete Lima','Descripcion paquete lima','171027110553vannesa.jpg'),(50,'paquete sur','asdfasdf','');

/*Table structure for table `paquetes_destinos` */

DROP TABLE IF EXISTS `paquetes_destinos`;

CREATE TABLE `paquetes_destinos` (
  `id_paquete_destinos` int(11) NOT NULL AUTO_INCREMENT,
  `id_paquete` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id_paquete_destinos`),
  KEY `id_paquete` (`id_paquete`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `fk_departamentos_paquetes_destinos` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_paquetes_paquetes_destinos` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

/*Data for the table `paquetes_destinos` */

insert  into `paquetes_destinos`(`id_paquete_destinos`,`id_paquete`,`id_departamento`) values (183,47,1),(184,47,3),(193,49,2),(194,49,3),(195,50,2),(196,50,3);

/*Table structure for table `paquetes_itinerarios` */

DROP TABLE IF EXISTS `paquetes_itinerarios`;

CREATE TABLE `paquetes_itinerarios` (
  `id_paquete_itinerario` int(11) NOT NULL AUTO_INCREMENT,
  `id_paquete` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `nombre_paquete_itinerario` varchar(250) NOT NULL,
  `descripcion_paquete_itinerario` text,
  PRIMARY KEY (`id_paquete_itinerario`),
  KEY `id_paquete` (`id_paquete`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `fk_hoteles_paquetes_itinerarios` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_paquetes_paquetes_itinerarios` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

/*Data for the table `paquetes_itinerarios` */

insert  into `paquetes_itinerarios`(`id_paquete_itinerario`,`id_paquete`,`id_hotel`,`nombre_paquete_itinerario`,`descripcion_paquete_itinerario`) values (161,47,41,'dia unooo','aaaa'),(162,47,41,'dia doss','bbbb'),(173,49,41,'dia uno','itinerario dia uno'),(174,49,41,'dia dos','itinerario dia dos'),(175,50,41,'dia uno','aaaa');

/*Table structure for table `paquetes_itinerarios_detalles` */

DROP TABLE IF EXISTS `paquetes_itinerarios_detalles`;

CREATE TABLE `paquetes_itinerarios_detalles` (
  `id_paquete_itinerario_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_paquete_itinerario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id_paquete_itinerario_detalle`),
  KEY `id_paquete_itinerario` (`id_paquete_itinerario`),
  KEY `id_servicio` (`id_servicio`),
  CONSTRAINT `fk_paquetes_itinerario_paquetes_itinerarios_detalles` FOREIGN KEY (`id_paquete_itinerario`) REFERENCES `paquetes_itinerarios` (`id_paquete_itinerario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_servicios_paquetes_itinerarios_detalles` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8;

/*Data for the table `paquetes_itinerarios_detalles` */

insert  into `paquetes_itinerarios_detalles`(`id_paquete_itinerario_detalle`,`id_paquete_itinerario`,`id_servicio`) values (208,161,23),(209,162,31),(219,173,24),(220,174,70),(221,175,88),(222,175,90);

/*Table structure for table `paquetes_itinerario_hoteles` */

DROP TABLE IF EXISTS `paquetes_itinerario_hoteles`;

CREATE TABLE `paquetes_itinerario_hoteles` (
  `id_paquete_itinerario_hotel` int(11) NOT NULL AUTO_INCREMENT,
  `id_paquete_itinerario` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  PRIMARY KEY (`id_paquete_itinerario_hotel`),
  KEY `id_paquete_itinerario` (`id_paquete_itinerario`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `fk_hoteles_paquetes_itinerario_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_paquetes_itinerario_paquetes_itinerario_hotel` FOREIGN KEY (`id_paquete_itinerario`) REFERENCES `paquetes_itinerarios` (`id_paquete_itinerario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `paquetes_itinerario_hoteles` */

insert  into `paquetes_itinerario_hoteles`(`id_paquete_itinerario_hotel`,`id_paquete_itinerario`,`id_hotel`) values (1,175,97),(2,175,106);

/*Table structure for table `perfiles` */

DROP TABLE IF EXISTS `perfiles`;

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `nombre_perfil` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perfiles` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

insert  into `roles`(`id_rol`,`nombre_rol`) values (1,'Administrador'),(2,'Usuario');

/*Table structure for table `secciones` */

DROP TABLE IF EXISTS `secciones`;

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL AUTO_INCREMENT,
  `id_modulo` int(11) NOT NULL,
  `nombre_seccion` varchar(50) NOT NULL,
  `url_seccion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_seccion`),
  KEY `id_modulo` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `secciones` */

insert  into `secciones`(`id_seccion`,`id_modulo`,`nombre_seccion`,`url_seccion`) values (1,1,'Inicio','index.php'),(2,1,'Configuraci&oacute;n de Sitio','configuracion.php'),(3,1,'Cuentas y Accesos','usuarios.php');

/*Table structure for table `sedes` */

DROP TABLE IF EXISTS `sedes`;

CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sede` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_sede`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sedes` */

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_servicio` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre_servicio` varchar(150) DEFAULT NULL,
  `precio_servicio` float DEFAULT NULL,
  `alcance_servicio` int(15) DEFAULT NULL,
  `descripcion_servicio` text,
  `contacto_nombre_servicio` varchar(150) NOT NULL,
  `contacto_numero_servicio` varchar(150) NOT NULL,
  PRIMARY KEY (`id_servicio`),
  KEY `id_tipo_servicio_idx` (`id_tipo_servicio`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Data for the table `servicios` */

insert  into `servicios`(`id_servicio`,`id_tipo_servicio`,`id_empresa`,`nombre_servicio`,`precio_servicio`,`alcance_servicio`,`descripcion_servicio`,`contacto_nombre_servicio`,`contacto_numero_servicio`) values (23,6,20,'Desayuno Supremo Pareja',35.99,2,'Desayuno para 2 personas en agradable comedor decorado con flores','',''),(24,2,38,'Paseo en caballo por la playa',22.99,1,'Agradable paseo por la playa montado en un caballo con supervisor de guía calificado','',''),(26,1,12,'Transporte en camion lima-cusco',35.35,1,'Transporte en camión desde lima hacia cusco','',''),(30,8,32,'Guerra PaintBall para 6',689,66,'3 Sesiones para jugar paintball con tus mejores amigos.','',''),(31,1,33,'traslados apto - hotel Van ',100,5,'','',''),(36,1,38,'Transporte en Mini Van para 6 Personas ',365,6,'Mini Van 6 Asientos + espacio para maletas + peliculas dentro del bus','955684725','Kevin'),(37,10,67,'City Tour: Lima Colonial+Moderna+San Francisco POOL',20,1,'','652 4287','Angie'),(38,10,67,'Pachacamac: Barranco+Chorrillos+Pachacamac POOL',29,1,'','652 4287','Angie'),(39,10,67,'Circuito Mágico del Aguas+Cena Show POOL',48,1,'','652 4287','Angie'),(40,10,67,'Lima Iluminada+Barranco Cena Show POOL',48,1,'','652 4287','Angie'),(41,10,67,'Circuito Mágico del Agua+Lima Iluminada POOL',35,1,'','652 4287','Angie'),(42,10,67,'City+Museo Arqueologico POOL',38,1,'','652 4287','Angie'),(43,10,67,'City+Museo Larco POOL',43,1,'','652 4287','Angie'),(44,10,67,'City+Casa Aliaga POOL',38,1,'','652 4287','Angie'),(45,10,67,'Museos de Lima: Museo Larco+Arqueologico POOL',41,1,'','652 4287','Angie'),(46,10,67,'Tour Culinario: Mercado+Prep. de Ceviche y Pisco Sour+Almuerzo Buffet POOL',83,1,'','652 4287','Angie'),(47,10,67,'Tour Caballos de Paso POOL',80,1,'','652 4287','Angie'),(48,10,67,'Full Day Lima #1: City+Almuerzo+Pachacamac POOL',70,1,'','652 4287','Angie'),(49,10,67,'Full Day Lima #2: Tour Culinario+Almuerzo+City POOL',100,1,'','652 4287','Angie'),(50,10,67,'Full Day Lima #3: City+Almuerzo+Museos POOL',85,1,'','652 4287','Angie'),(51,10,67,'Full Day Lima #4; Pachacamac+Caballos+Almuerzo POOL',105,1,'','652 4287','Angie'),(52,1,67,'Full Day Caral',249,1,'','652 4287','Angie'),(54,10,67,'City Tour Lima (Auto) PRIVADO',67,2,'','6524287','Angie Santamaria'),(55,10,67,'City Tour + Larco (Van H1) PRIVADO',25,6,'','652 4287','Angie Santamaria'),(56,10,67,'City Tour + Larco (Sprinter) PRIVADO',18,10,'','652 4287','Angie Santamaria'),(57,10,67,'City Tour + Larco (Sprinter Larga) PRIVADO',15,16,'','6524287','Angie Santamaria'),(58,10,67,'Pachacamac+(Auto) PRIVADO',71,2,'','652 4287','Angie Santamaria'),(59,10,67,'Pachacamac+(Van H1) PRIVADO',29,6,'','652 4287','Angie Santamaria'),(60,10,67,'Pachacamac (Sprinter) PRIVADO',23,10,'','652 4287','Angie Santamaria'),(61,10,67,'Pachacamac (Sprinter Larga) PRIVADO',19,16,'','652 4287','Angie Santamaria'),(62,10,67,'Circuito Magico del Aguas (Auto) PRIVADO',65,2,'','652 4287','Angie Santamaria'),(63,10,67,'Circuito Mágico del Agua (Van H1) PRIVADO',23,6,'','652 4287','Angie Santamaria'),(64,10,67,'Circuito Magico del Aguas (Sprinter) PRIVADO',16,10,'','652 4287','Angie Santamaria'),(65,10,67,'Circuito Magico del Agua ( Sprinter Larga) PRIVADO',12,16,'','652 4287',''),(66,10,67,'Tour Culinario (Auto) PRIVADO)',124,2,'','652 4287','Angie Santamaria'),(67,10,67,'Tour Culinario (Van H1) PRIVADO',74,6,'','652 4287','Angie Santamaria'),(68,10,67,'Tour Culinario (Sprinter) PRIVADO',70,10,'','652 4287','Angie Santamaria'),(69,10,67,'Tour Culinario (Sprinter Larga) PRIVADA',65,16,'','652 4287','Angie Santamaria'),(70,10,93,'Campiña Tour',18.46,1,'Mirabus, que parte desde el centro histórico de Arequipa. Visita el Mirador de Yanahuara, donde podrá observar los majestuosos volcanes, visitaremos el mirador de Carmen Alto con su hermosa campiña. El pueblo tradicional de Sachaca. Visita Incalpaca y conoce los camélidos mas representativos del Perú, también podrá realizar compras de la mejor calidad de prendas hechas directamente en la fabrica. Ca Casona Mansión del Fundador de Arequipa nos llevara a conocer mas de nuestra historia. Molino de Sabandia y sus gigantes ruedas de piedra que muelen el grano a base del movimiento de las aguas, retornan observando la majestuosidad de las andenerias de Paucarpata, para llegar luego a nuestra bella ciudad.','054 220915','Rosio Peña'),(71,10,93,'City Tour',40,1,'Conoce la Plaza de Armas rodeada por su imponente Catedral y sus portales hechas de silla (piedra blanca volcánica). La Iglesia de la Compañía de Jesús y sus claustros, como también su visita a la Cúpula de San Ignacio totalmente decorada con pintura mural. Visita el Monasterio de Santa Catalina la única con una \"citadel\" en el mundo.','054 220915','Rosio Peña'),(72,10,93,'City Tour - Panoramico',60,1,'El city tour panorámico nos muestra la impresionante belleza de la Ciudad Blanca de Arequipa. El tour incluye sitios como el Monasterio de Santa Catalina, Claustros e iglesia de la Compañía de Jesús, los Miradores de Carmen Alto y Yanahuara. \r\nEl recorrido inicia por uno de los miradores mas atractivos de la ciudad llamado \"Carmen Alto\" en este lugar observaremos los tres volcanes tutelares que rodean a la ciudad de Arequia, terrazas pre-incas. \r\nSeguidamente nos trasladamos hacia el distrito de Yanahuara para apreciar los Portales de Yanahuara construido en Sillar y la iglesia de San Juan Bautista.\r\nConoce la Plaza de Armas rodeada por su imponente Catedral y sus portales hechas de sillar (piedra blanca volcánica). La Iglesia de la Compañía de Jesus y sus claustros, como tambien se visita la Cúpula de San Ignacio totalmente decorada con pintura mural. Visita el Monasterio de Santa Catalina la única con una \"citadel\" en el mundo.','054 220915 ','Rosio Peña'),(73,10,93,'Colca Full Day Nacional + Alm',37,1,'Visita el Cañon del Colca considerado el más profundo del mundo en solo un día. Saliendo de Arequipa en un transporte turístico hasta llegar a Chivay (capital del valle del Colca) aprox. 06:00 am. Disfruta de un desayuno especial, continuando con viaje llegaras a la Cruz de Cóndor (punto más alto y profundo del Cañón). En este mirador observaran el espectáculo del vuelo del cóndor y el paisaje impresionante del Cañón. Luego retornaremos a nuestro bus y visitaremos los miradores de Choquetico y Antahuilque. Los pueblos  tradicionales de Maca y Yanque. Visita a los baños termales para luego disfrutar de un  almuerzo en Chivay. Retornaremos por Patapampa lugar donde apreciaremos los volcanes como el  Sabancaya, el Ampato  y el Hualcahualca y la impresionante cordillera de los Andes, llegando a Arequipa a las 17.00 Hrs.','054 220915','Rosio Peña'),(74,10,93,'Colca Full Day Extranjero + Alm',53,1,'Visita el Cañon del Colca considerado el más profundo del mundo en solo un día. Saliendo de Arequipa en un transporte turístico hasta llegar a Chivay (capital del valle del Colca) aprox. 06:00 am. Disfruta de un desayuno especial, continuando con viaje llegaras a la Cruz de Cóndor (punto más alto y profundo del Cañon). En este mirador observaran el espectáculo del vuelo del cóndor y el paisaje impresionante del Cañón. Luego retornaremos a nuestro bus y visitaremos los miradores de Choquetico y Antahuilque. Los pueblos  tradicionales de Maca y Yanque. Visita a los baños termales para luego disfrutar de un  almuerzo en Chivay. Retornaremos por Patapampa lugar donde apreciaremos los volcanes como el  Sabancaya, el Ampato  y el Hualcahualca y la impresionante cordillera de los Andes, llegando a Arequipa a las 17.00 Hrs.','054 220915','Rosio Peña'),(75,10,93,'Colca 2D/1N Nacional + 2 Alm',48,1,'1º DIA  Visita el Cañon del Colca considerado el más profundo del mundo. Saliendo de Arequipa visitaremos Pampa Cañahuas para encontrarnos con las Vicuñas en vida salvaje.    Tocrapampa con sus aves migratorias durante todo el año por sus lagunillas que son alimento para diferente clase de aves dese Flamingos hasta los famosos Ivis. Continuando con el tour  haremos una parada en punto más alto del trayecto Patapampa   (4890msnm) un maravilloso mirador de los volcanes y la impresionante cordillera de los andes. Arribo a Chivay a las 13:00 hora aprox. Traslado al Lodge seleccionado. Tarde libre y/o opción de visitar los baños termales y medicinales La Calera.  \r\n\r\n2º DIA Temprano en la mañana luego de tomar el desayuno, nuestro bus nos llevara a la  Cruz del Cóndor (punto más alto y profundo del Cañon). En este mirador observaran el espectáculo del vuelo del Condor y la profundidad del Cañon. Luego retornaremos a nuestro bus y visitaremos los miradores de Choquetico y Antahuilque. Los pueblos  tradicionales de Maca y Yanque. Disfruta de un  almuerzo en Chivay y Retornaremos a Arequipa para llegar a las 17:00 Hrs.\r\n','054 220915','Rosio Peña'),(76,10,93,'Colca 2D/1N Extranjero + 2 Alm',63,1,'1º DIA  Visita el Cañon del Colca considerado el más profundo del mundo. Saliendo de Arequipa visitaremos Pampa Cañahuas para encontrarnos con las Vicuñas en vida salvaje.    Tocrapampa con sus aves migratorias durante todo el año por sus lagunillas que son alimento para diferente clase de aves dese Flamingos hasta los famosos Ivis. Continuando con el tour  haremos una parada en punto más alto del trayecto Patapampa   (4890msnm) un maravilloso mirador de los volcanes y la impresionante cordillera de los andes. Arribo a Chivay a las 13:00 hora aprox. Traslado al Lodge seleccionado. Tarde libre y/o opción de visitar los baños termales y medicinales La Calera.  \r\n\r\n2º DIA Temprano en la mañana luego de tomar el desayuno, nuestro bus nos llevara a la  Cruz del Cóndor (punto más alto y profundo del Cañon). En este mirador observaran el espectáculo del vuelo del Condor y la profundidad del Cañon. Luego retornaremos a nuestro bus y visitaremos los miradores de Choquetico y Antahuilque. Los pueblos  tradicionales de Maca y Yanque. Disfruta de un  almuerzo en Chivay y Retornaremos a Arequipa para llegar a las 17:00 Hrs.\r\n','054 220915','Rosio Peña'),(77,10,93,'Colca 2D/1N Yanque Trek - Nacional + 02 Alm',74,1,'1º DIA  Visita el Cañón del Colca considerado el más profundo del mundo. Saliendo de Arequipa visitaremos Pampa Cañahuas para encontrarnos con las Vicuñas en vida salvaje.    Tocrapampa con sus aves migratorias durante todo el año por sus lagunillas que son alimento para diferente clase de aves dese Flamingos hasta los famosos Ivis. Continuando con el tour  haremos una parada en punto más alto del trayecto Patapampa   (4890msnm) un maravilloso mirador de los volcanes y la impresionante cordillera de los andes. Arribo a Chivay a las 13:00 hora aprox. Traslado a Kontiki Lodge ubicado en la villa de Yanque, esta aldea aún conserva la tradición del colca, un lugar tranquilo con lugareños amables, perfecto para aquellos que desean descubrir más de la vida local del Colca.\r\nUna vez en el Hotel en Yanque, recibirá una calurosa bienvenida por la gente hospitalaria de este pueblo. Yanque le ofrece una perspectiva interna de las tradiciones más populares del Colca. Por la tarde su guía le llevará a una caminata de 2 horas aprox. El  camino se podrá observar casas típicas del Colca, terrazas pre-incas, también es posible ver las actividades locales en las granjas del Colca y el sitio arqueológico de Uyo Uyo. Al final de la caminata usted tendrá la opción de disfrutar y relajarse en la fuente termal rustica de 35 grados, situado junto al río Colca. Retorno al hotel.\r\n\r\n2º DIA Temprano en la mañana luego de tomar el desayuno, se podrá observar la danza típica del Wititi en la plaza de Yanque, para luego subir a nuestro bus que los llevara a la  Cruz del Cóndor (punto más alto y profundo del Cañon). En este mirador observaran el espectáculo del vuelo del Condor y la profundidad del Cañon. Luego retornara a nuestro bus y visitaremos los miradores de Choquetico y Antahuilque. Los pueblos  tradicionales de Maca y Yanque. Disfruta de un  almuerzo en Chivay y Retornaremos a Arequipa para llegar a las 17:00 Hrs.\r\n','054 220915','Rosio Peña'),(78,10,93,'Colca 2D/1N Yanque Trek - Extranjero + 02 Alm',89,1,'1º DIA  Visita el Cañón del Colca considerado el más profundo del mundo. Saliendo de Arequipa visitaremos Pampa Cañahuas para encontrarnos con las Vicuñas en vida salvaje.    Tocrapampa con sus aves migratorias durante todo el año por sus lagunillas que son alimento para diferente clase de aves dese Flamingos hasta los famosos Ivis. Continuando con el tour  haremos una parada en punto más alto del trayecto Patapampa   (4890msnm) un maravilloso mirador de los volcanes y la impresionante cordillera de los andes. Arribo a Chivay a las 13:00 hora aprox. Traslado a Kontiki Lodge ubicado en la villa de Yanque, esta aldea aún conserva la tradición del colca, un lugar tranquilo con lugareños amables, perfecto para aquellos que desean descubrir más de la vida local del Colca.\r\nUna vez en el Hotel en Yanque, recibirá una calurosa bienvenida por la gente hospitalaria de este pueblo. Yanque le ofrece una perspectiva interna de las tradiciones más populares del Colca. Por la tarde su guía le llevará a una caminata de 2 horas aprox. El  camino se podrá observar casas típicas del Colca, terrazas pre-incas, también es posible ver las actividades locales en las granjas del Colca y el sitio arqueológico de Uyo Uyo. Al final de la caminata usted tendrá la opción de disfrutar y relajarse en la fuente termal rustica de 35 grados, situado junto al río Colca. Retorno al hotel.\r\n\r\n2º DIA Temprano en la mañana luego de tomar el desayuno, se podrá observar la danza típica del Wititi en la plaza de Yanque, para luego subir a nuestro bus que los llevara a la  Cruz del Cóndor (punto más alto y profundo del Cañon). En este mirador observaran el espectáculo del vuelo del Condor y la profundidad del Cañon. Luego retornara a nuestro bus y visitaremos los miradores de Choquetico y Antahuilque. Los pueblos  tradicionales de Maca y Yanque. Disfruta de un  almuerzo en Chivay y Retornaremos a Arequipa para llegar a las 17:00 Hrs.\r\n','054 220915','Rosio Peña'),(79,10,93,'Rafting Tour',25,1,'Duración  : 4 horas \r\nSalidas     : Diarias  8.00 / 11.00  / 14.00  Hrs.\r\nIncluye     : Equipo completo (Balsa, remos, Cascos de seguridad, Chalecos, Línea guía de rescate, Abrigos impermeables). Transporte durante el viaje. Guía instructor de Rafting. \r\nSnack (Botella de agua y galletas). Guía(s) en kayak(s) para seguridad.\r\nItinerario: Recogeremos a los pasajeros desde el Hotel a la hora indicada y los trasladamos  hasta el punto de inicio; llamado “Gruta de la Virgen de Chapi”, donde se les hará entrega del equipo y las instrucciones correspondientes y el uso respectivo de los mismos. El descenso es de 6 km (1 hora y 45 minutos, en el agua) en botes con capacidad para 6 personas + 01 instructor guía, terminando la aventura en el distrito de Chilina. En medio del espectacular paisaje, veremos un cañón formado con roca volcánica, algunas andenerías pre Incas con variados cultivos, mucha vegetación en un pequeño valle / cañón y la vista a los majestuosos volcanes de Arequipa.\r\nEl total de la duración de este tour es de 4 horas desde el momento del recojo del Hotel hasta el retorno \r\n','054 220915','Rosio Peña'),(80,10,93,'Horseback Riding',34,1,'Duración: 4 hrs. \r\nSalidas     : Diarias  9.00 & 14:00 Hrs.\r\nIncluye     : Movilidad ,Guía, Caballos  \r\n\r\nItinerario: Este viaje le permite disfrutar de la mejor cabalgata en el hermoso Valle de Chilina de Arequipa, con las mejores  vistas panorámicas de los tres volcanes que rodean la ciudad de Arequipa, junto con el río Chili. Esta es una manera relajada, pero emocionante de descubrir los paisajes verdes y pintorescos de Arequipa y definitivamente vale la pena aventurase en esta excursión.\r\n','054 220915','Rosio Peña'),(81,10,93,'Arequipa By Bike',30,1,'Duración  : 4 Horas \r\nSalidas     : Diarias  9.00  / 13.00 Hrs.\r\nIncluye     : Movilidad ,Guía , Bicicletas, Equipo de  Seguridad   \r\n\r\nItinerario: Tenemos una buena combinación de la ciudad y los alrededores de la campiña arequipeña. Veremos finos ejemplos de arquitectura colonial construida usando piedra volcánica (sillar). También visitaremos el valle de Chilina perfecto para nuestros ciclistas ya que cruzaran el rio Chili y observaran los tres volcanes que rodean la ciudad.\r\n','054 220915','Rosio Peña'),(82,10,93,'Rock Climbing',30,1,'Duración  : ½ Día \r\nSalidas     : Diarias  8.00 Hrs.\r\nIncluye     : Movilidad  ,Guía Especializado, Zapatos para escalar, equipo, \r\n\r\n\r\n\r\nItinerario: Los Calambucos ubicado en uno de los cañones en las faldas del volcán Misti a 20 minutos de Arequipa o en la gruta de la Virgen de Chapi (valle de Chilina). Viaje en transporte turístico o público hasta el valle de Chilina. Iniciaremos nuestra caminata por 30 minutos hasta el punto donde se inicia la aventura con un descenso en rappel. Aquí el participante tiene varios niveles de escalada  dependiendo de la experiencia y condiciones físicas.\r\n','054 220915','Rosio Peña'),(83,10,93,'Ascenso Misti 2D/1N',82,1,'Duración   :   2 Días \r\nSalidas      :   Diarias  8.00 Hrs\r\nIncluye      :   Movilidad  4 x 4 ,Guía  Profesional, Equipo de      Montaña, Alimentación ( cena y desayuno) \r\n\r\nNo incluye :  Botas de Montaña, Agua (5L) , Bastones, almuerzos y mochilas \r\n\r\n1º Día        : Salida de Arequipa aprox. a las 8:30 am en una movilidad 4x4. Arribo a la base norte del Misti, a 3,800msm desde aquí iniciaremos la caminata caracterizada por el paisaje de puna, terreno arenoso y con restos de ceniza volcánica, breve parada para almorzar y reinicio de la caminata en dirección al campamento base (4800m.), después de una caminata de 06 horas aprox, cena y pernocte. (Campamento Mont. Blanco)\r\n\r\n2º Día       : Muy temprano alrededor de la 2:00 am, desayuno, iniciaremos el ascenso con mochilas ligeras. Haremos una caminata de 6 horas y arribo a la cumbre ( 5,825 m ), impresionante vista del enorme cráter y otro más pequeño que se caracteriza por emanar algunos gases, caminata hasta la Cruz del Misti, donde disfrutaremos de una espectacular vista de la ciudad de Arequipa y los nevados Chachani, Pichu Pichu, Coropuna y Ampato, despues de 30 min. Empezaremos a descender hasta el campamento base, ligero descanso, y luego continuaremos hasta llegar al lugar donde nos espera el transporte que nos conducirá de retorno a la ciudad de Arequipa.\r\n','054 220915','Rosio Peña'),(84,10,93,'Ascenso Chachani 2D/1N',95,1,'Duración   :  2 Días \r\nSalidas      :  8.00 Hrs.\r\nIncluye      :  Movilidad  4 x 4 ,Guía  Profesional , Equipo de Montaña, Alimentación ( cena y desayuno) \r\n\r\nNo incluye : Botas de Montaña, Agua, Bastones\r\n\r\n1º Día         : Recojo del hotel aprox. 08:30  hrs., transporte hasta el lugar de inicio del ascenso a 4,700 msnm., arribando a este aprox. a las 12:00, ascenso hasta la zona del campamento. Almuerzo. Caminata para entrenara y verificar condiciones físicas a los 5,000 msnm. Cena y pernocte.\r\n\r\n2º Día       : Este volcán es considerando uno de los mas fáciles de ascender con más de 6000 metros de altura. Muy temprano 03:00 am. Después del desayuno iniciaremos el ascenso, luego de terminar de cruzar el pico \"El Angel\", se inicia el ascenso final llegando a la cima del Chachani (6,075 msnm). Después de 1 hora iniciamos el descenso, arribando al campamento alrededor del medio día, almuerzo y viaje de retorno a Arequipa. Traslado al hotel.\r\n','054 220915','Rosio Peña'),(85,1,93,'Transfer Apto - Htl',19,1,'','054 220915','Rosio Peña'),(86,10,93,'Transfer Apto - Htl',70,2,'','054 220915','Rosio Peña'),(87,1,93,'Transfer Apto - Htl',60,3,'','054 220915','Rosio Peña'),(88,1,93,'Transfer Estación de Bus - Htl',15,1,'','054 220915','Rosio Peña'),(89,1,93,'Transfer Estación de Bus - Htl',15,2,'','054 220915','Rosio Peña'),(90,1,93,'Transfer Estación de Bus - Htl',16,3,'','054 220915','Rosio Peña'),(91,1,128,'Estacion de Bus/Hoteles en Chachapoyas',4.6,1,'','941997126','Janeth'),(92,1,128,'Estacion de Bus/Hoteles en Chachapoyas',11,3,'','941997126','Janeth'),(93,10,128,'Kuelap Pool',32.3,1,'','941715623 ','Janth'),(94,10,128,'Catarata de Gocta Pool',29.23,1,'','941715623 ','Janeth'),(95,10,128,'Sarcofagos de Karajia+Caverna de Quiocta Pool',35.3,1,'','941715623 ','Janeth'),(96,10,128,'City Tour Chachapoyas Privado',58.15,1,'','941715623 ','Janeth'),(97,10,128,'City Tour Chachapoyas',73.84,2,'','941715623 ','Janth'),(98,10,128,'City Tour Chachapoyas Privado',109.53,4,'','941715623 ','Janeth'),(99,10,129,'Kuelap Privado',124.92,1,'','941715623','Janeth'),(100,8,48,'aaa',12,2,'test','52345325','ccc');

/*Table structure for table `servicios_ubicacion` */

DROP TABLE IF EXISTS `servicios_ubicacion`;

CREATE TABLE `servicios_ubicacion` (
  `id_servicio_ubicacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio_ubicacion`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

/*Data for the table `servicios_ubicacion` */

insert  into `servicios_ubicacion`(`id_servicio_ubicacion`,`id_servicio`,`id_departamento`) values (3,23,1),(4,23,4),(5,24,2),(22,30,3),(23,31,1),(27,26,1),(36,36,1),(58,52,15),(60,38,15),(62,40,15),(63,39,15),(65,42,15),(66,43,15),(67,44,15),(68,45,15),(69,46,15),(70,47,15),(72,48,15),(73,49,15),(74,50,15),(75,51,15),(78,54,15),(83,57,15),(84,55,15),(85,56,15),(86,41,15),(87,58,15),(88,59,15),(89,60,15),(90,61,15),(91,62,15),(93,63,15),(94,64,15),(95,65,15),(97,66,15),(98,67,15),(99,68,15),(101,69,15),(102,70,2),(103,71,2),(104,72,2),(105,73,2),(106,74,2),(107,75,2),(108,76,2),(109,77,2),(110,78,2),(111,79,2),(112,80,2),(113,81,2),(114,82,2),(115,83,2),(116,84,2),(117,85,2),(118,86,2),(120,88,2),(121,89,2),(123,87,2),(124,90,2),(125,91,32),(126,92,32),(127,93,32),(129,94,32),(131,95,32),(133,96,32),(134,97,32),(135,98,32),(136,99,32),(137,100,3),(138,100,5),(139,37,1),(140,37,15);

/*Table structure for table `tipos_contactos` */

DROP TABLE IF EXISTS `tipos_contactos`;

CREATE TABLE `tipos_contactos` (
  `id_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_contacto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipos_contactos` */

insert  into `tipos_contactos`(`id_tipo_contacto`,`nombre_tipo_contacto`) values (1,'Administrador'),(3,'Gerente');

/*Table structure for table `tipos_empresas` */

DROP TABLE IF EXISTS `tipos_empresas`;

CREATE TABLE `tipos_empresas` (
  `id_tipo_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_empresa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tipos_empresas` */

insert  into `tipos_empresas`(`id_tipo_empresa`,`nombre_tipo_empresa`) values (1,'JURIDICA'),(2,'NATURAL');

/*Table structure for table `tipos_servicios` */

DROP TABLE IF EXISTS `tipos_servicios`;

CREATE TABLE `tipos_servicios` (
  `id_tipo_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_servicio` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tipo_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tipos_servicios` */

insert  into `tipos_servicios`(`id_tipo_servicio`,`nombre_tipo_servicio`) values (1,'Transportes'),(2,'Guias'),(6,'Comida'),(7,'Hospedaje'),(8,'Deporte'),(9,'Hoteles'),(10,'Tours');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL DEFAULT '0',
  `nombre_usuario` varchar(50) NOT NULL DEFAULT '',
  `apellidos_usuario` varchar(50) DEFAULT '',
  `dni_usuario` int(8) NOT NULL,
  `email_usuario` varchar(50) NOT NULL DEFAULT '',
  `foto_usuario` varchar(71) DEFAULT NULL,
  `login_usuario` varchar(20) NOT NULL DEFAULT '',
  `password_usuario` varchar(200) NOT NULL DEFAULT '',
  `fecha_ingreso_usuario` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `fk_roles_usuarios` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_usuario`,`id_rol`,`nombre_usuario`,`apellidos_usuario`,`dni_usuario`,`email_usuario`,`foto_usuario`,`login_usuario`,`password_usuario`,`fecha_ingreso_usuario`) values (1,1,'Walter','Meneses',12345678,'admin@alojaweb.pe','171027092153admin.jpg','admin','1943003713692|32$2|1$w3809245n0t9','2009-02-13'),(2,1,'Bryan','Arias',2345678,'darias@develoweb.net','','darias','e10adc3949ba59abbe56e057f20f883e','2014-07-31'),(5,2,'debian','linux',41123113,'debian@gmail.com','','debian','1943003713692|32$2|1$w3809245n0t9','2017-10-27');

/*Table structure for table `usuarios_secciones` */

DROP TABLE IF EXISTS `usuarios_secciones`;

CREATE TABLE `usuarios_secciones` (
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `id_seccion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`,`id_seccion`),
  KEY `id_seccion` (`id_seccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `usuarios_secciones` */

insert  into `usuarios_secciones`(`id_usuario`,`id_seccion`) values (1,1),(2,1),(1,2),(2,2),(1,3),(2,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
