create database rupae;

USE `rupae`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: rupae
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividades_economicas`
--

DROP TABLE IF EXISTS `actividades_economicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividades_economicas` (
  `id_actividad_economica` int NOT NULL AUTO_INCREMENT,
  `id_sector` int NOT NULL,
  `cod_actividad` int DEFAULT NULL,
  `desc_actividad` varchar(255) DEFAULT NULL,
  `descl_actividad` varchar(255) DEFAULT NULL,
  `agrupamiento` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_actividad_economica`),
  KEY `fk_actividades_economicas_sectores1_idx` (`id_sector`),
  CONSTRAINT `fk_actividades_economicas_sectores1` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id_sector`)
) ENGINE=InnoDB AUTO_INCREMENT=1058 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='F883\nEl sector es por Actividad, el Tamaño es por empresa (proveedor).';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `actividades_proveedores`
--

DROP TABLE IF EXISTS `actividades_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividades_proveedores` (
  `id_actividad_proveedor` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `id_actividad_economica` int NOT NULL,
  `id_tipo_actividad` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_actividad_proveedor`),
  KEY `fk_actividades_proveedores_proveedores_rupae1_idx` (`id_proveedor`),
  KEY `fk_actividades_proveedores_tipos_actividades1_idx` (`id_tipo_actividad`),
  KEY `fk_actividades_proveedores_actividades_economicas1_idx` (`id_actividad_economica`),
  CONSTRAINT `fk_actividades_proveedores_actividades_economicas1` FOREIGN KEY (`id_actividad_economica`) REFERENCES `actividades_economicas` (`id_actividad_economica`),
  CONSTRAINT `fk_actividades_proveedores_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  CONSTRAINT `fk_actividades_proveedores_tipos_actividades1` FOREIGN KEY (`id_tipo_actividad`) REFERENCES `tipos_actividades` (`id_tipo_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla ACTIVIDADES en el modelo Access original.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `certificados`
--

DROP TABLE IF EXISTS `certificados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificados` (
  `id_certificado` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int DEFAULT NULL,
  `nro_rupae_proveedor` int DEFAULT NULL COMMENT 'Número de identificación Rupae del proveedor. ',
  `fecha_inscripcion` date DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `cuit` varchar(15) DEFAULT NULL,
  `nombre_fantasia` varchar(255) DEFAULT NULL,
  `calle_real` varchar(255) DEFAULT NULL,
  `numero_real` int DEFAULT NULL,
  `nombre_localidad_real` varchar(255) DEFAULT NULL,
  `nombre_provincia_real` varchar(255) DEFAULT NULL,
  `nro_tel_real` decimal(18,0) DEFAULT NULL COMMENT 'Nro del teléfono o del fax',
  `email_real` varchar(255) DEFAULT NULL,
  `nombre_provincia_legal` varchar(255) DEFAULT NULL,
  `nombre_localidad_legal` varchar(255) DEFAULT NULL,
  `calle_legal` varchar(255) DEFAULT NULL,
  `numero_legal` int DEFAULT NULL,
  `nro_tel_legal` decimal(18,0) DEFAULT NULL COMMENT 'Nro del teléfono o del fax',
  `email_legal` varchar(255) DEFAULT NULL,
  `nombre_representante_legal` varchar(255) DEFAULT NULL,
  `dni_representante_legal` varchar(255) DEFAULT NULL,
  `tipo_de_sociedad` varchar(255) DEFAULT NULL,
  `situacion_iva` varchar(255) DEFAULT NULL,
  `retencion` tinyint DEFAULT NULL,
  `nro_ingresos_brutos` varchar(100) DEFAULT NULL,
  `jurisdiccion` varchar(255) DEFAULT NULL,
  `tipo_contribuyente` varchar(255) DEFAULT NULL,
  `nro_habilitacion_municipal` varchar(45) DEFAULT NULL,
  `nombre_localidad_habilit_municip` varchar(255) DEFAULT NULL,
  `nro_inscripcion_personas_juridicas` varchar(45) DEFAULT NULL,
  `provincia_inscrip_personas_jur` varchar(255) DEFAULT NULL,
  `registro_publico_de_comercio` varchar(255) DEFAULT NULL,
  `provincia_registro_publico` varchar(255) DEFAULT NULL,
  `inspeccion_gral_justicia` varchar(100) DEFAULT NULL,
  `provincia_inspeccion_justicia` varchar(255) DEFAULT NULL,
  `desc_actividad_economica_princ` varchar(255) DEFAULT NULL,
  `desc_actividad_economica_sec` varchar(255) DEFAULT NULL,
  `porc_mo` smallint DEFAULT NULL COMMENT 'Se obtiene de la declaracion jurada y form 931',
  `porc_facturacion` smallint DEFAULT NULL COMMENT 'Se obtiene del CM05',
  `porc_gasto` smallint DEFAULT NULL COMMENT 'Se obtiene del CM05',
  `antiguedad` smallint DEFAULT NULL,
  `dom_fiscal` tinyint DEFAULT NULL COMMENT 'Se obtiene de la constancia de cuit',
  `valor_agregado` tinyint DEFAULT NULL COMMENT 'Se obtiene de la declaracion jurada',
  `valor_indice_rupae` tinyint DEFAULT NULL COMMENT 'Valor del indice Rupae (según su valor, determina si a un proveedor se lo cataloga como local, intermedio o foráneo).',
  `desc_jerarquia_compre_local` varchar(255) DEFAULT NULL,
  `fecha_emision_certificado` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_certificado`),
  KEY `fk_proveedores_hist_proveedores10` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_hist_proveedores10` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clasificaciones_empresas`
--

DROP TABLE IF EXISTS `clasificaciones_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clasificaciones_empresas` (
  `id_clasificacion_empresa` int NOT NULL AUTO_INCREMENT,
  `id_sector` int NOT NULL,
  `id_tamanio_empresa` int NOT NULL,
  `simbolo` varchar(1) DEFAULT NULL,
  `facturacion_max` float DEFAULT NULL,
  `fact_max_2018` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_clasificacion_empresa`),
  KEY `fk_clasificaciones empresas_sectores1_idx` (`id_sector`),
  KEY `fk_clasificaciones empresas_tamanios_empresas1_idx` (`id_tamanio_empresa`),
  CONSTRAINT `fk_clasificaciones empresas_sectores1` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id_sector`),
  CONSTRAINT `fk_clasificaciones empresas_tamanios_empresas1` FOREIGN KEY (`id_tamanio_empresa`) REFERENCES `tamanios_empresas` (`id_tamanio_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jerarquia_compre_local`
--

DROP TABLE IF EXISTS `jerarquia_compre_local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jerarquia_compre_local` (
  `id_jerarquia_compre_local` int NOT NULL AUTO_INCREMENT,
  `desc_jerarquia_compre_local` varchar(255) DEFAULT NULL,
  `valor_desde` smallint DEFAULT NULL,
  `valor_hasta` smallint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_jerarquia_compre_local`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `load_ACTIVIDADES_ECONOMICAS_F883`
--

DROP TABLE IF EXISTS `load_ACTIVIDADES_ECONOMICAS_F883`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `load_ACTIVIDADES_ECONOMICAS_F883` (
  `Idactividad` int DEFAULT NULL,
  `COD_ACTIVIDAD_F883` int DEFAULT NULL,
  `DESC_ACTIVIDAD_F883` text,
  `DESCL_ACTIVIDA_F883` text,
  `AGRUPAMIENTO` text,
  `sector` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `load_localidades_censales`
--

DROP TABLE IF EXISTS `load_localidades_censales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `load_localidades_censales` (
  `categoria` text,
  `centroide_lat` double DEFAULT NULL,
  `centroide_lon` double DEFAULT NULL,
  `departamento_id` text,
  `departamento_nombre` text,
  `fuente` text,
  `funcion` text,
  `id` text,
  `municipio_id` text,
  `municipio_nombre` text,
  `nombre` text,
  `provincia_id` text,
  `provincia_nombre` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `load_provincias`
--

DROP TABLE IF EXISTS `load_provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `load_provincias` (
  `categoria` text,
  `centroide_lat` double DEFAULT NULL,
  `centroide_lon` double DEFAULT NULL,
  `fuente` text,
  `id` int DEFAULT NULL,
  `iso_id` text,
  `iso_nombre` text,
  `nombre` text,
  `nombre_completo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `localidades`
--

DROP TABLE IF EXISTS `localidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localidades` (
  `id_localidad` int NOT NULL AUTO_INCREMENT,
  `codigo_localidad` varchar(20) DEFAULT NULL,
  `nombre_localidad` varchar(255) DEFAULT NULL,
  `nombre_departamento` varchar(255) DEFAULT NULL,
  `id_provincia` int NOT NULL,
  `flg_user_generated` tinyint DEFAULT NULL COMMENT 'Este flag indica si la localidad fue generada por un usuario (una localidad que no se encontraba en la tabla de localidades al momento de completar el formulario).',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_localidad`),
  KEY `fk_localidades_provincias1_idx` (`id_provincia`),
  CONSTRAINT `fk_localidades_provincias1` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`)
) ENGINE=InnoDB AUTO_INCREMENT=4096 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id_pagos` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `importe` int DEFAULT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_pagos`),
  KEY `fk_pagos_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_pagos_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paises` (
  `id_pais` int NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas` (
  `id_persona` int NOT NULL AUTO_INCREMENT,
  `dni_persona` varchar(255) DEFAULT NULL,
  `cuil_persona` varchar(255) DEFAULT NULL,
  `nombre_persona` varchar(255) DEFAULT NULL,
  `apellido_persona` varchar(255) DEFAULT NULL,
  `genero_persona` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personas_proveedores`
--

DROP TABLE IF EXISTS `personas_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas_proveedores` (
  `id_persona_proveedor` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `rol_persona_proveedor` varchar(255) DEFAULT NULL COMMENT 'Apoderado, Representante, Presidente, Titular, etc.',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_persona_proveedor`),
  KEY `fk_personas_proveedores_proveedores_rupae1_idx` (`id_proveedor`),
  KEY `asd_idx` (`id_persona`),
  CONSTRAINT `fk_personas_proveedores__rupae` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  CONSTRAINT `fk_personas_proveedores_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ponderaciones_compre_local`
--

DROP TABLE IF EXISTS `ponderaciones_compre_local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ponderaciones_compre_local` (
  `id_ponderacion` int NOT NULL AUTO_INCREMENT,
  `desc_ponderacion` varchar(255) DEFAULT NULL,
  `valor_ponderacion` decimal(3,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_ponderacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla con valores de ponderaciones para el cálculo del valor del índice de compre local.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `presentaciones`
--

DROP TABLE IF EXISTS `presentaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presentaciones` (
  `id_presentacion` int NOT NULL AUTO_INCREMENT,
  `nombre_presentacion` varchar(255) DEFAULT NULL,
  `desc_presentacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_presentacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla descriptiva de tipos de presentaciones posibles (ej.: "Fotocopia dni", "Formulario CM05", etc).';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `presentaciones_estados`
--

DROP TABLE IF EXISTS `presentaciones_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presentaciones_estados` (
  `id_presentacion_estado` int NOT NULL,
  `cod_presentacion_estado` smallint DEFAULT NULL,
  `desc_presentacion_estado` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_presentacion_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Codificación de los distintos posibles estados de una presentación (aprobada, incompleta, rechazada, etc.).';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `producto_elaborado` varchar(255) DEFAULT NULL,
  `rnpa` varchar(255) DEFAULT NULL,
  `Producida_unidad` varchar(255) DEFAULT NULL,
  `capacidad_produccion_total` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_producto`),
  KEY `fk_productos_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_productos_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `nro_rupae_proveedor` int DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `nombre_fantasia` varchar(255) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `tipo_de_sociedad` varchar(255) DEFAULT NULL,
  `cuit` varchar(15) DEFAULT NULL,
  `situacion_iva` varchar(255) DEFAULT NULL,
  `exento_en_cod_de_actividad` varchar(255) DEFAULT NULL,
  `en_la_provincia_de` varchar(255) DEFAULT NULL,
  `retencion` tinyint DEFAULT NULL,
  `nro_ingresos_brutos` varchar(100) DEFAULT NULL,
  `jurisdiccion` varchar(255) DEFAULT NULL,
  `tipo_contribuyente` varchar(255) DEFAULT NULL,
  `nro_habilitacion_municipal` varchar(45) DEFAULT NULL,
  `localidad_habilitacion` varchar(255) DEFAULT NULL,
  `nro_inscripcion_personas_juridicas` varchar(45) DEFAULT NULL,
  `provincia_inscrip_personas_jur` varchar(255) DEFAULT NULL,
  `registro_publico_de_comercio` varchar(255) DEFAULT NULL,
  `provincia_registro_publico` varchar(255) DEFAULT NULL,
  `inspeccion_gral_justicia` varchar(100) DEFAULT NULL,
  `provincia_inspeccion_justicia` varchar(255) DEFAULT NULL,
  `facturacion_anual_alcanzada` decimal(18,0) DEFAULT NULL,
  `rne` varchar(20) DEFAULT NULL,
  `servicio_atencion_cliente` tinyint DEFAULT '0',
  `servicio_post_venta` tinyint DEFAULT '0',
  `servicio_personal_especializado` tinyint DEFAULT '0',
  `servicio_entrega_a_domicilio` tinyint DEFAULT '0',
  `servicio_capacitacion_personal` tinyint DEFAULT '0',
  `producto_transformacion_significativa` tinyint DEFAULT '0',
  `producto_compra_y_vende_unic` tinyint DEFAULT '0',
  `producto_post_venta` tinyint DEFAULT '0',
  `producto_venta_asistida` tinyint DEFAULT '0',
  `producto_garantia` tinyint DEFAULT '0',
  `empleados_nomina` mediumint DEFAULT NULL,
  `puestos_trabajo_sta_cruz` mediumint DEFAULT NULL,
  `cant_administrativos` mediumint DEFAULT NULL,
  `periodo_contr_administrativos` varchar(100) DEFAULT NULL,
  `cant_operarios` mediumint DEFAULT NULL,
  `periodo_contr_operarios` varchar(100) DEFAULT NULL,
  `cant_personal_vta` mediumint DEFAULT NULL,
  `periodo_contr_pventas` varchar(100) DEFAULT NULL,
  `cant_empleados_domicilio_sta_cruz` mediumint DEFAULT NULL,
  `masa_salarial_bruta` decimal(18,0) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `tipo_inscripcion` varchar(255) DEFAULT NULL COMMENT 'indica procedencia del registro - no sirve',
  `nro_inscripcion` int DEFAULT NULL COMMENT 'es el numero del sistema viejo - no sirve',
  `fecha_baja` date DEFAULT NULL,
  `motivo_baja` varchar(255) DEFAULT NULL,
  `porc_facturacion` smallint DEFAULT NULL COMMENT 'Se obtiene del CM05',
  `porc_gasto` smallint DEFAULT NULL COMMENT 'Se obtiene del CM05',
  `porc_mo` smallint DEFAULT NULL COMMENT 'Se obtiene de la declaracion jurada y form 931',
  `antiguedad` smallint DEFAULT NULL,
  `dom_fiscal` smallint DEFAULT NULL,
  `valor_agregado` tinyint DEFAULT NULL COMMENT 'Se obtiene de la declaracion jurada',
  `id_tamanio_empresa` int DEFAULT NULL COMMENT 'Tamanio de la empresa, correspondiente a su actividad principal.',
  `observaciones` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `dado_de_baja` tinyint NOT NULL DEFAULT '0',
  `valor_indice_rupae` varchar(255) DEFAULT NULL,
  `desc_jerarquia_compre_local` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `nro_rupae_proveedor` (`nro_rupae_proveedor`),
  KEY `fk_proveedores_rupae_tamanios_empresas1_idx` (`id_tamanio_empresa`),
  CONSTRAINT `fk_proveedores_rupae_tamanios_empresas1` FOREIGN KEY (`id_tamanio_empresa`) REFERENCES `tamanios_empresas` (`id_tamanio_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Este campo "id_localidad" se llamaba "localidad" en la tabla "Rupae" del modelo Access original.\nEl campo relativo al tamaño de la empresa, se refiere al de su actividad principal.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_domicilios`
--

DROP TABLE IF EXISTS `proveedores_domicilios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_domicilios` (
  `id_proveedor_domicilio` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int DEFAULT NULL,
  `tipo_domicilio` varchar(255) NOT NULL COMMENT 'Domicilio real, legal, fiscal, secundario, etc.',
  `nro_orden_domicilio` smallint DEFAULT NULL COMMENT '(1=principal, 2=secundario, etc.)',
  `calle` varchar(255) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `entre_calles` varchar(255) DEFAULT NULL,
  `monoblock` varchar(255) DEFAULT NULL,
  `dpto` varchar(45) DEFAULT NULL,
  `puerta` varchar(45) DEFAULT NULL,
  `oficina` varchar(45) DEFAULT NULL,
  `manzana` varchar(45) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  `id_localidad` int DEFAULT NULL,
  `codigo_postal` varchar(8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_domicilio`),
  KEY `fk_proveedores_domicilios_proveedores_rupae1_idx` (`id_proveedor`),
  KEY `fk_proveedores_domicilios_localidades1_idx` (`id_localidad`),
  CONSTRAINT `fk_proveedores_domicilios_localidades1` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_emails`
--

DROP TABLE IF EXISTS `proveedores_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_emails` (
  `id_proveedor_email` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `desc_email` varchar(255) DEFAULT NULL,
  `tipo_email` varchar(255) DEFAULT NULL,
  `nro_orden_email` smallint DEFAULT NULL COMMENT '(1=principal, 2=secundario, etc.)',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_email`),
  KEY `fk_proveedores_emails_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_emails_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_hist`
--

DROP TABLE IF EXISTS `proveedores_hist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_hist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `nro_rupae_proveedor` int DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `nombre_fantasia` varchar(255) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `tipo_de_sociedad` varchar(255) DEFAULT NULL,
  `cuit` varchar(15) DEFAULT NULL,
  `situacion_iva` varchar(255) DEFAULT NULL,
  `exento_en_cod_de_actividad` varchar(255) DEFAULT NULL,
  `en_la_provincia_de` varchar(255) DEFAULT NULL,
  `retencion` tinyint DEFAULT NULL,
  `nro_ingresos_brutos` varchar(100) DEFAULT NULL,
  `jurisdiccion` varchar(255) DEFAULT NULL,
  `tipo_contribuyente` varchar(255) DEFAULT NULL,
  `nro_habilitacion_municipal` varchar(45) DEFAULT NULL,
  `localidad_habilitacion` varchar(255) DEFAULT NULL,
  `nro_inscripcion_personas_juridicas` varchar(45) DEFAULT NULL,
  `provincia_inscrip_personas_jur` varchar(255) DEFAULT NULL,
  `registro_publico_de_comercio` varchar(255) DEFAULT NULL,
  `provincia_registro_publico` varchar(255) DEFAULT NULL,
  `inspeccion_gral_justicia` varchar(100) DEFAULT NULL,
  `provincia_inspeccion_justicia` varchar(255) DEFAULT NULL,
  `facturacion_anual_alcanzada` decimal(18,0) DEFAULT NULL,
  `rne` varchar(20) DEFAULT NULL,
  `servicio_atencion_cliente` tinyint DEFAULT '0',
  `servicio_post_venta` tinyint DEFAULT '0',
  `servicio_personal_especializado` tinyint DEFAULT '0',
  `servicio_entrega_a_domicilio` tinyint DEFAULT '0',
  `servicio_capacitacion_personal` tinyint DEFAULT '0',
  `producto_transformacion_significativa` tinyint DEFAULT '0',
  `producto_compra_y_vende_unic` tinyint DEFAULT '0',
  `producto_post_venta` tinyint DEFAULT '0',
  `producto_venta_asistida` tinyint DEFAULT '0',
  `producto_garantia` tinyint DEFAULT '0',
  `empleados_nomina` smallint DEFAULT NULL,
  `puestos_trabajo_Sta_Cruz` smallint DEFAULT NULL,
  `cant_administrativos` smallint DEFAULT NULL,
  `periodo_contr_administrativos` varchar(100) DEFAULT NULL,
  `cant_operarios` smallint DEFAULT NULL,
  `periodo_contr_operarios` varchar(100) DEFAULT NULL,
  `cant_personal_vta` smallint DEFAULT NULL,
  `periodo_contr_pventas` varchar(100) DEFAULT NULL,
  `cant_empleados_domicilio_sta_cruz` smallint DEFAULT NULL,
  `masa_salarial_bruta` decimal(18,0) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL,
  `tipo_inscripcion` varchar(255) DEFAULT NULL COMMENT 'indica procedencia del registro - no sirve',
  `nro_inscripcion` int DEFAULT NULL COMMENT 'es el numero del sistema viejo - no sirve',
  `fecha_baja` date DEFAULT NULL,
  `motivo_baja` varchar(255) DEFAULT NULL,
  `porc_facturacion` smallint DEFAULT NULL COMMENT 'Se obtiene del CM05',
  `porc_gasto` smallint DEFAULT NULL COMMENT 'Se obtiene del CM05',
  `porc_mo` smallint DEFAULT NULL COMMENT 'Se obtiene de la declaracion jurada y form 931',
  `antiguedad` smallint DEFAULT NULL,
  `dom_fiscal` tinyint DEFAULT NULL COMMENT 'Se obtiene de la constancia de cuit',
  `valor_agregado` tinyint DEFAULT NULL COMMENT 'Se obtiene de la declaracion jurada',
  `id_tamanio_empresa` int DEFAULT NULL COMMENT 'Tamanio de la empresa, correspondiente a su actividad principal.',
  `observaciones` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `dado_de_baja` tinyint NOT NULL DEFAULT '0',
  `valor_indice_rupae` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nro_rupae_proveedor` (`nro_rupae_proveedor`),
  KEY `fk_proveedores_rupae_tamanios_empresas1_idx` (`id_tamanio_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Este campo "id_localidad" se llamaba "localidad" en la tabla "Rupae" del modelo Access original.\nEl campo relativo al tamaño de la empresa, se refiere al de su actividad principal.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_palabras_claves`
--

DROP TABLE IF EXISTS `proveedores_palabras_claves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_palabras_claves` (
  `id_proveedor_palabra_clave` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `desc_palabra_clave` varchar(255) DEFAULT NULL,
  `tipo_palabra_clave` varchar(255) DEFAULT NULL,
  `nro_orden_palabra_clave` smallint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_palabra_clave`),
  KEY `fk_proveedores_emails_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_emails_proveedores_rupae10` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_patentes`
--

DROP TABLE IF EXISTS `proveedores_patentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_patentes` (
  `id_proveedor_patente` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `dominio` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `inscripto_en` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_patente`),
  KEY `fk_proveedores_patentes_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_patentes_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_presentaciones`
--

DROP TABLE IF EXISTS `proveedores_presentaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_presentaciones` (
  `id_proveedor_presentacion` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `id_presentacion` int NOT NULL,
  `fecha_presentacion` datetime DEFAULT NULL,
  `ubic_presentacion` varchar(255) DEFAULT NULL,
  `desc_proveedores_presentacion` varchar(255) DEFAULT NULL,
  `id_presentacion_estado` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_presentacion`),
  KEY `fk_proveedores_presentaciones_presentaciones1_idx` (`id_presentacion`),
  KEY `fk_proveedores_presentaciones_proveedores_rupae2_idx` (`id_proveedor`),
  KEY `fk_proveedores_presentaciones_presentaciones_estados1_idx` (`id_presentacion_estado`),
  CONSTRAINT `fk_proveedores_presentaciones_presentaciones1` FOREIGN KEY (`id_presentacion`) REFERENCES `presentaciones` (`id_presentacion`),
  CONSTRAINT `fk_proveedores_presentaciones_presentaciones_estados1` FOREIGN KEY (`id_presentacion_estado`) REFERENCES `presentaciones_estados` (`id_presentacion_estado`),
  CONSTRAINT `fk_proveedores_presentaciones_proveedores_rupae2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Presentaciones presentadas por los usuarios de Rupae (y de otros subsistemas)..';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_sedes`
--

DROP TABLE IF EXISTS `proveedores_sedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_sedes` (
  `id_proveedor_sede` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `id_localidad` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_proveedor_sede`),
  KEY `id_idx` (`id_proveedor`),
  CONSTRAINT `id` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_seguros`
--

DROP TABLE IF EXISTS `proveedores_seguros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_seguros` (
  `id_proveedor_seguro` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `poliza` varchar(255) DEFAULT NULL,
  `agencia` varchar(255) DEFAULT NULL,
  `asegurado` varchar(255) DEFAULT NULL,
  `vigencia_hasta` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_seguro`),
  KEY `fk_proveedores_patentes_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_patentes_proveedores_rupae10` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_telefonos`
--

DROP TABLE IF EXISTS `proveedores_telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_telefonos` (
  `id_proveedor_telefono` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `nro_tel` decimal(18,0) DEFAULT NULL COMMENT 'Nro del teléfono o del fax',
  `cod_area_tel` int DEFAULT NULL,
  `tipo_medio` varchar(45) DEFAULT NULL COMMENT '(Celular, tel. fijo, fax)',
  `desc_telefono` varchar(255) DEFAULT NULL,
  `tipo_telefono` varchar(45) DEFAULT NULL COMMENT '(legal, real, fiscal)',
  `nro_orden_telefono` smallint DEFAULT NULL COMMENT '(1= principal, 2 = segundo telefono, etc.)',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_telefono`),
  KEY `fk_proveedores_telefonos_proveedores_rupae1_idx` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_telefonos_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores_tipos_proveedores`
--

DROP TABLE IF EXISTS `proveedores_tipos_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_tipos_proveedores` (
  `id_proveedor_tipo_proveedor` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `id_tipo_proveedor` int NOT NULL,
  `desc_proveedor_tipo_proveedor` varchar(255) DEFAULT NULL,
  `nro_orden_tipo_proveedor` smallint DEFAULT NULL COMMENT '(1=principal, 2=secundario, etc.)',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_proveedor_tipo_proveedor`),
  KEY `fk_proveedores_emails_proveedores_rupae1_idx` (`id_proveedor`),
  KEY `fk_proveedores_tipos_proveedores_tipos_proveedores1_idx` (`id_tipo_proveedor`),
  CONSTRAINT `fk_proveedores_emails_proveedores_rupae11` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  CONSTRAINT `fk_proveedores_tipos_proveedores_tipos_proveedores1` FOREIGN KEY (`id_tipo_proveedor`) REFERENCES `tipos_proveedores` (`id_tipo_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provincias` (
  `id_provincia` int NOT NULL AUTO_INCREMENT,
  `nombre_provincia` varchar(255) DEFAULT NULL,
  `id_pais` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_provincia`),
  KEY `fk_provincias_paises1_idx` (`id_pais`),
  CONSTRAINT `fk_provincias_paises1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sectores`
--

DROP TABLE IF EXISTS `sectores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sectores` (
  `id_sector` int NOT NULL AUTO_INCREMENT,
  `desc_sector` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_sector`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Sectores: Agropecuario, Comercio, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subsistemas_presentaciones`
--

DROP TABLE IF EXISTS `subsistemas_presentaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subsistemas_presentaciones` (
  `id_subsistema_presentacion` int NOT NULL,
  `id_subsistema` int NOT NULL,
  `id_presentacion` int NOT NULL,
  `desc_subsistema_presentacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_subsistema_presentacion`),
  KEY `fk_subsistemas_presentaciones_susbistemas1_idx` (`id_subsistema`),
  KEY `fk_subsistemas_presentaciones_presentaciones1_idx` (`id_presentacion`),
  CONSTRAINT `fk_subsistemas_presentaciones_presentaciones1` FOREIGN KEY (`id_presentacion`) REFERENCES `presentaciones` (`id_presentacion`),
  CONSTRAINT `fk_subsistemas_presentaciones_susbistemas1` FOREIGN KEY (`id_subsistema`) REFERENCES `susbistemas` (`id_subsistema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Vinculación entre los distintos subsistemas y los tipos de presentaciones que les requieren a los usuarios.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sucursales` (
  `id_sucursal` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `nombre_sucursal` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `entre_calles` varchar(255) DEFAULT NULL,
  `monoblock` varchar(255) DEFAULT NULL,
  `dpto` varchar(45) DEFAULT NULL,
  `puerta` varchar(45) DEFAULT NULL,
  `oficina` varchar(45) DEFAULT NULL,
  `manzana` varchar(45) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  `id_localidad` int DEFAULT NULL,
  `codigo_postal` varchar(8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_sucursal`),
  KEY `fk_sucursales_proveedores_proveedores_rupae1_idx` (`id_proveedor`),
  KEY `fk_sucursales_localidades1_idx` (`id_localidad`),
  CONSTRAINT `fk_sucursales_localidades1` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`),
  CONSTRAINT `fk_sucursales_proveedores_proveedores_rupae1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sucursales_emails`
--

DROP TABLE IF EXISTS `sucursales_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sucursales_emails` (
  `id_sucursal_email` int NOT NULL AUTO_INCREMENT,
  `id_sucursal` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `desc_email` varchar(255) DEFAULT NULL,
  `tipo_email` varchar(255) DEFAULT NULL,
  `nro_orden_email` smallint DEFAULT NULL COMMENT '(1=principal, 2=secundario, etc.)',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_sucursal_email`),
  KEY `fk_sucursales_emails_sucursales1_idx` (`id_sucursal`),
  CONSTRAINT `fk_sucursales_emails_sucursales1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sucursales_telefonos`
--

DROP TABLE IF EXISTS `sucursales_telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sucursales_telefonos` (
  `id_sucursal_telefono` int NOT NULL AUTO_INCREMENT,
  `id_sucursal` int NOT NULL,
  `nro_tel` decimal(18,0) DEFAULT NULL COMMENT 'Nro del teléfono o del fax',
  `cod_area_tel` int DEFAULT NULL,
  `tipo_medio` varchar(45) DEFAULT NULL COMMENT '(Celular, tel. fijo, fax)',
  `desc_telefono` varchar(255) DEFAULT NULL,
  `tipo_telefono` varchar(45) DEFAULT NULL COMMENT '(legal, real, fiscal)',
  `nro_orden_telefono` smallint DEFAULT NULL COMMENT '(1= principal, 2 = segundo telefono, etc.)',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_sucursal_telefono`),
  KEY `fk_sucursales_telefonos_sucursales1_idx` (`id_sucursal`),
  CONSTRAINT `fk_sucursales_telefonos_sucursales1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `susbistemas`
--

DROP TABLE IF EXISTS `susbistemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `susbistemas` (
  `id_subsistema` int NOT NULL,
  `nombre_subsistema` varchar(255) DEFAULT NULL,
  `desc_subsistema` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_subsistema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Subsistemas que interactúan con las presentaciones (Rupae, Rup, etc.).';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tamanios_empresas`
--

DROP TABLE IF EXISTS `tamanios_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tamanios_empresas` (
  `id_tamanio_empresa` int NOT NULL AUTO_INCREMENT,
  `desc_tamanio_empresa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_tamanio_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Sectores: Agropecuario, Comercio, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipos_actividades`
--

DROP TABLE IF EXISTS `tipos_actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_actividades` (
  `id_tipo_actividad` int NOT NULL AUTO_INCREMENT,
  `desc_tipo_actividad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_tipo_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Se refiere a actividad principal, secundaria, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipos_proveedores`
--

DROP TABLE IF EXISTS `tipos_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_proveedores` (
  `id_tipo_proveedor` int NOT NULL AUTO_INCREMENT,
  `desc_tipo_proveedor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'For use by the aplication.',
  PRIMARY KEY (`id_tipo_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Proveedor del Estado, Proveedor Minero, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-08 10:12:42
