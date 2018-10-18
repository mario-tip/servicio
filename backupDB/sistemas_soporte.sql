-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-10-2018 a las 11:32:54
-- Versión del servidor: 5.5.60-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemas_soporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerts_configuration`
--

CREATE TABLE `alerts_configuration` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_sixty_days` tinyint(1) NOT NULL,
  `is_thirty_days` tinyint(1) NOT NULL,
  `is_fifteen_days` tinyint(1) NOT NULL,
  `is_same_day` tinyint(1) NOT NULL,
  `is_active_person` tinyint(1) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = Mantenimientos, 1 Vencimientos',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `person_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `alerts_configuration`
--

INSERT INTO `alerts_configuration` (`id`, `is_active`, `is_sixty_days`, `is_thirty_days`, `is_fifteen_days`, `is_same_day`, `is_active_person`, `type`, `created_at`, `updated_at`, `person_id`) VALUES
(8, 1, 0, 0, 0, 1, 0, 0, '2018-06-25 21:51:56', '2018-06-25 21:51:56', 26),
(9, 1, 0, 0, 1, 1, 0, 1, '2018-06-25 21:52:18', '2018-06-25 21:52:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerts_inactivity`
--

CREATE TABLE `alerts_inactivity` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `alerts_inactivity`
--

INSERT INTO `alerts_inactivity` (`id`, `year`, `month`, `is_active`, `person_id`, `created_at`, `updated_at`) VALUES
(1, 2018, 10, 0, 5, '2018-06-25 22:23:35', '2018-06-25 22:23:40'),
(2, 2018, 10, 1, 2, '2018-06-25 22:23:58', '2018-06-25 22:23:58'),
(3, 2019, 9, 1, 1, '2018-07-19 01:16:55', '2018-07-19 01:16:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerts_max_min`
--

CREATE TABLE `alerts_max_min` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `person_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `alerts_max_min`
--

INSERT INTO `alerts_max_min` (`id`, `is_active`, `created_at`, `updated_at`, `person_id`) VALUES
(1, 1, '2018-04-13 20:00:27', '2018-04-13 20:00:27', 1),
(2, 1, '2018-04-13 20:00:38', '2018-06-20 23:02:50', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assets`
--

CREATE TABLE `assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset_custom_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adquisition_date` date NOT NULL,
  `barcode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `condition` int(11) NOT NULL COMMENT '0 -> nuevo 1 -> usado',
  `status` int(11) NOT NULL COMMENT '0 - Inactivo 1- Activo',
  `person_id` int(10) UNSIGNED NOT NULL,
  `expires_date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `purchase_order` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maintenance_date` date DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `provider_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `equipment_id` int(10) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `assets`
--

INSERT INTO `assets` (`id`, `asset_custom_id`, `model`, `name`, `serial`, `brand`, `adquisition_date`, `barcode`, `cost`, `condition`, `status`, `person_id`, `expires_date`, `description`, `purchase_order`, `maintenance_date`, `notes`, `provider_id`, `created_at`, `updated_at`, `deleted_at`, `subcategory_id`, `customer_id`, `equipment_id`, `project_id`) VALUES
(1, '123', 'Modelin', 'Nombre de activo', '123456789', 'marca', '2018-01-02', 'E20031FC56 ', '20.00', 1, 1, 2, '2018-01-02', 'Description', 'rrt', '2018-01-02', 'xd', 10, '2018-01-03 01:02:09', '2018-04-05 16:27:31', NULL, 1, 1, 1, NULL),
(17, 'FirstOne', 'dasdas', 'dasdsad', 'dasd', 'TYRF', '2018-04-17', '23123', '534543.00', 1, 0, 1, '2018-04-10', 'dasdas', 'dasda', '2018-04-12', 'dasdasd', 10, '2018-04-03 22:25:12', '2018-04-03 22:25:12', NULL, 2, 1, 1, NULL),
(18, 'SecondOne', 'MDALSDK', 'SecondOne', '4324324', 'KDLF', '2018-04-13', 'dasdad', '231123.00', 1, 1, 1, '2018-04-19', 'dsadsa', 'dasdad', '2018-04-12', 'dasdad', 9, '2018-04-03 22:26:49', '2018-04-03 22:26:49', NULL, 2, 2, 2, NULL),
(19, 'idnuevo', 'otro modelo', 'activo nuevo', '132', 'teefds', '2018-04-04', '234234', '51465.00', 1, 0, 1, '2018-04-11', 'xdxd', '', '2018-04-04', 'xd', 10, '2018-04-05 16:13:24', '2018-04-05 16:13:24', NULL, 1, 1, 1, NULL),
(20, 'test', 'test', 'test', '123', 'asgsad', '2018-04-05', '123456789', '122.00', 1, 1, 2, '2018-06-19', 'test', '', '2018-06-16', 'test', 10, '2018-04-05 21:47:00', '2018-06-19 20:43:46', NULL, 3, 1, 1, NULL),
(21, '11112', 'modelo para activo ', 'activo prueba2', '45512', 'nueva', '2018-05-16', '14525636', '4554.00', 1, 1, 1, '2018-05-17', 'rdfsdgfd', 'srtsdr', '2018-05-25', 'xdxd', 9, '2018-05-02 22:33:47', '2018-06-25 16:11:52', NULL, 1, 1, 1, NULL),
(26, 'IMP000', 'C123', 'Impresora Epson C123', '123', 'Epson', '2018-06-15', '0203012030120', '100.00', 1, 1, 1, '2018-06-19', 'awdawdawd', '123', '2018-06-30', '123', 10, '2018-06-25 17:49:58', '2018-06-25 18:16:51', NULL, 2, 2, 4, NULL),
(27, NULL, '2020', 'mac', 'wwew', 'wewe', '2018-07-16', 'qe3', '12221.00', 0, 1, 1, '2018-07-16', '12', '', '2018-07-16', '', 10, '2018-07-16 20:55:28', '2018-07-16 20:55:28', NULL, 3, NULL, NULL, NULL),
(28, NULL, '2020', 'mac', 'wwew', 'wewe', '2018-07-16', 'qe3', '12221.00', 0, 0, 1, '2018-07-16', '12', '', '2018-07-16', '', 10, '2018-07-16 20:58:24', '2018-07-19 01:09:59', '2018-07-19 01:09:59', 3, NULL, NULL, NULL),
(29, NULL, 'GW2470', 'monitor', '3214565', 'BENQ', '2018-07-18', '0011223344', '4000.00', 0, 1, 5, '2018-07-18', 'monitor', '7845df', '2018-07-18', 'ninguna', 10, '2018-07-19 01:07:04', '2018-07-19 01:07:04', NULL, 2, NULL, NULL, NULL),
(30, NULL, 'Latitude', 'Laptop', '123456789', 'Dell', '2018-08-22', '1234567890', '5000.00', 0, 1, 5, '2018-08-22', 'i5, 500GB HDHD, 4RAM', '12345', '2018-08-22', '', 9, '2018-08-22 20:42:22', '2018-08-22 20:42:22', NULL, 3, NULL, NULL, NULL),
(31, NULL, 'Satellite', 'Lap Horacio', '12345', 'Toshiba', '2018-08-22', '12345', '15000.00', 0, 1, 27, '2018-08-22', 'i5, 4GB RAM', '', '2018-08-23', '', 9, '2018-08-22 21:39:30', '2018-08-22 21:53:30', NULL, 3, NULL, NULL, NULL),
(32, '123', 'ZT61046-EZ001', 'Impresora de etiquetas Zebra ZT610', '1234567890', 'Zebra', '2018-10-01', '1234567890', '5000.00', 1, 1, 5, '2018-10-24', 'Impresora etiquetas 600dpi', 'OC12657', '2018-10-31', 'Notas', 9, '2018-10-05 23:37:27', '2018-10-05 23:37:27', NULL, 3, 3, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asset_part_equipment`
--

CREATE TABLE `asset_part_equipment` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `part_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asset_part_equipment`
--

INSERT INTO `asset_part_equipment` (`id`, `serial`, `created_at`, `updated_at`, `part_id`, `asset_id`) VALUES
(1, 'on', NULL, NULL, 1, 1),
(2, '44554', NULL, NULL, 1, 20),
(3, '1000123', NULL, NULL, 6, 26),
(4, '12903102938', NULL, NULL, 7, 26),
(5, '1234567890', NULL, NULL, 6, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_offices`
--

CREATE TABLE `branch_offices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `branch_offices`
--

INSERT INTO `branch_offices` (`id`, `name`, `description`, `address`, `created_at`, `updated_at`) VALUES
(1, 'sucursal test 1', 'test ', 'test', '2018-03-23 04:43:28', '2018-03-23 04:43:28'),
(2, 'sucursal test 2', 'Test', 'test', '2018-03-23 04:43:49', '2018-03-23 04:43:49'),
(3, 'sucursal test 3', 'sucursal de prueba', 'dirección de prueba #2332', '2018-04-13 19:58:03', '2018-04-13 19:58:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Nombre', 'Descripcion', NULL, NULL),
(2, 'Empty category', 'Description of empty category\r\n', NULL, NULL),
(5, 'Prueba de categoría', 'Prueba para activos', '2018-01-17 23:45:55', '2018-01-17 23:45:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories_for_products`
--

CREATE TABLE `categories_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories_for_products`
--

INSERT INTO `categories_for_products` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'categoria test 1', 'test test 12', '2018-03-23 04:07:00', '2018-03-23 04:07:28'),
(2, 'categoria test 2', 'xd', '2018-03-23 04:08:14', '2018-03-23 04:08:22'),
(3, 'Categoria 3', 'Categoria 3', '2018-09-07 02:39:25', '2018-09-07 02:39:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `administrative_contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrative_contact_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrative_contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrative_contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `space_gb` double(10,2) NOT NULL,
  `users_capacity` int(11) NOT NULL,
  `actual_users` int(11) NOT NULL,
  `license_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `phone`, `contact_name`, `contact_address`, `contact_phone`, `contact_email`, `administrative_contact_name`, `administrative_contact_address`, `administrative_contact_email`, `administrative_contact_phone`, `space_gb`, `users_capacity`, `actual_users`, `license_status`, `created_at`, `updated_at`) VALUES
(5, 'test', 'test', '123456789', 'dsafasdf', 'sadfsdf', '142547751', 'test@test.com', '', '', '', '', 10.00, 5, 1, 1, '2018-06-18 22:33:23', '2018-06-18 22:36:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies_modules`
--

CREATE TABLE `companies_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Mexico\r\n'),
(2, 'Estados unidos\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 - Compañia, 2 - Persona, 3 - Contrato',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `idcustomer`, `name`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'cliente test', 3, NULL, '2018-03-23 04:42:47', '2018-03-23 04:43:00'),
(2, 1, 'cliente 4', 2, NULL, '2018-03-23 04:46:02', '2018-04-13 03:28:57'),
(3, 1, 'cliente compañia', 1, NULL, '2018-04-05 22:29:33', '2018-04-05 22:29:33'),
(5, 3, 'cliente contrato', 3, NULL, '2018-04-05 22:30:14', '2018-04-05 22:30:14'),
(6, 123, 'cliente personas', 2, NULL, '2018-04-13 19:53:50', '2018-04-13 19:54:10'),
(7, 122333, 'cliente para test', 1, NULL, '2018-06-18 19:57:52', '2018-06-18 19:58:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = activos, 1 = personas, 2 = ubicaciones, 3 = ubicaciones para productos, 4 = productos',
  `visible` tinyint(1) NOT NULL COMMENT 'true = visible, false = no visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `type`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Color', 1, 1, '2018-01-18 22:27:29', '2018-08-22 21:51:53'),
(2, 'Talla', 1, 1, '2018-01-18 22:27:29', '2018-08-22 21:51:53'),
(6, 'Campo 1', 2, 0, '2018-01-18 22:27:54', '2018-05-03 20:21:50'),
(7, 'Campo 2', 2, 0, '2018-01-18 22:27:54', '2018-03-22 05:00:57'),
(8, 'Campo 3', 2, 0, '2018-01-18 22:27:54', '2018-03-22 05:00:57'),
(9, 'Campo 4', 2, 0, '2018-01-18 22:27:54', '2018-03-22 05:00:57'),
(10, 'Campo 5', 2, 0, '2018-01-18 22:27:54', '2018-03-22 05:00:57'),
(11, 'Campo 1', 3, 1, '2018-01-18 22:21:36', '2018-01-18 22:28:32'),
(12, 'Campo 2', 3, 1, '2018-01-30 02:24:06', '2018-03-21 04:40:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_fields_location_for_products`
--

CREATE TABLE `custom_fields_location_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL,
  `custom_field_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_fields_products`
--

CREATE TABLE `custom_fields_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `custom_field_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_field_assets`
--

CREATE TABLE `custom_field_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `custom_field_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `custom_field_assets`
--

INSERT INTO `custom_field_assets` (`id`, `value`, `created_at`, `updated_at`, `custom_field_id`, `asset_id`) VALUES
(1, 'Consequatur tempore quo natus placeat voluptatem culpa et do suscipit quis illo officiis dolor qu', '2018-01-30 00:06:01', '2018-01-30 00:07:15', 1, 12),
(2, 'Et adipisicing dignissimos dolores explicabo Velit voluptate ut esse possimus facilis voluptas pr', '2018-01-30 00:06:01', '2018-01-30 00:07:15', 2, 12),
(3, 'test', '2018-01-30 00:06:40', NULL, 1, 11),
(4, 'test', '2018-01-30 00:06:40', NULL, 2, 11),
(5, 'test', '2018-01-30 02:20:41', NULL, 1, 13),
(6, 'test', '2018-01-30 02:20:41', NULL, 2, 13),
(7, 'test', '2018-01-30 02:21:21', '2018-03-21 06:03:39', 1, 14),
(8, 'test', '2018-01-30 02:21:21', '2018-03-21 06:03:39', 2, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_field_location`
--

CREATE TABLE `custom_field_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `custom_field_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `custom_field_location`
--

INSERT INTO `custom_field_location` (`id`, `value`, `created_at`, `updated_at`, `custom_field_id`, `location_id`) VALUES
(1, 'Prueba de campos ', '2018-01-18 22:35:34', NULL, 11, 6),
(6, 'xd', '2018-05-16 00:39:01', NULL, 11, 9),
(7, 'xd', '2018-05-16 00:39:01', NULL, 12, 9),
(8, '', '2018-08-22 20:39:35', NULL, 11, 11),
(9, '', '2018-08-22 20:39:35', NULL, 12, 11),
(10, '', '2018-08-22 21:37:51', NULL, 11, 12),
(11, '', '2018-08-22 21:37:51', NULL, 12, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `custom_field_person`
--

CREATE TABLE `custom_field_person` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `persons_id` int(10) UNSIGNED NOT NULL,
  `custom_field_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Departamento', '2018-01-03 00:10:13', '2018-01-03 00:10:13'),
(2, 'DepartamenTITO', '2018-01-03 00:28:59', '2018-01-03 00:28:59'),
(3, '1', '2018-01-03 01:00:55', '2018-01-03 01:00:55'),
(4, 'departamento prueba', '2018-01-18 03:15:47', '2018-01-18 03:15:47'),
(5, 'department 2', '2018-01-30 00:00:19', '2018-01-30 00:00:19'),
(6, 'test', '2018-01-30 00:02:41', '2018-01-30 00:02:41'),
(7, 'departamento pruebas', '2018-06-20 21:11:55', '2018-06-20 21:11:55'),
(8, 'xd', '2018-06-20 21:13:16', '2018-06-20 21:13:16'),
(9, 'Sistemas', '2018-08-22 21:37:14', '2018-08-22 21:37:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departures`
--

CREATE TABLE `departures` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departures`
--

INSERT INTO `departures` (`id`, `folio`, `date`, `time`, `comment`, `created_at`, `updated_at`, `location_id`, `person_id`) VALUES
(1, 'DEP-1', '2018-06-01', '17:10:00', 'edrftuijokl', '2018-06-20 21:27:21', '2018-06-20 21:27:22', 1, 5),
(2, 'DEP-2', '2018-08-01', '10:50:00', 'Salida a reparación', '2018-08-22 21:43:26', '2018-08-22 21:43:27', 11, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departures_details`
--

CREATE TABLE `departures_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departure_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departures_details`
--

INSERT INTO `departures_details` (`id`, `created_at`, `updated_at`, `departure_id`, `asset_id`) VALUES
(1, '2018-06-20 21:27:21', '2018-06-20 21:27:22', 1, 1),
(2, '2018-08-22 21:43:26', '2018-08-22 21:43:27', 2, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disposures`
--

CREATE TABLE `disposures` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `motive` int(11) NOT NULL COMMENT '0 = daño, 1 = pérdida, 2 = Fin de vida útil',
  `comment` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `disposures`
--

INSERT INTO `disposures` (`id`, `folio`, `date`, `time`, `motive`, `comment`, `created_at`, `updated_at`, `location_id`) VALUES
(1, 'DIS-1', '2018-05-01', '10:50:00', 0, 'prueba de transaccion', '2018-05-03 19:45:52', '2018-05-03 19:45:52', 5),
(2, 'DIS-2', '2018-06-01', '15:45:00', 0, 'dfgh', '2018-06-20 21:31:38', '2018-06-20 21:31:38', 3),
(3, 'DIS-3', '2018-08-01', '15:50:00', 2, 'Vendida', '2018-08-22 21:44:55', '2018-08-22 21:44:55', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disposures_details`
--

CREATE TABLE `disposures_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disposure_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `disposures_details`
--

INSERT INTO `disposures_details` (`id`, `created_at`, `updated_at`, `disposure_id`, `asset_id`) VALUES
(1, '2018-05-03 19:45:52', '2018-05-03 19:45:52', 1, 1),
(2, '2018-06-20 21:31:38', '2018-06-20 21:31:38', 2, 18),
(3, '2018-08-22 21:44:55', '2018-08-22 21:44:55', 3, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disposures_for_products_details`
--

CREATE TABLE `disposures_for_products_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disposure_for_products_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `disposures_for_products_details`
--

INSERT INTO `disposures_for_products_details` (`id`, `amount`, `created_at`, `updated_at`, `disposure_for_products_id`, `product_id`) VALUES
(1, 3, '2018-07-19 01:02:37', '2018-07-19 01:02:37', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disposure_for_products`
--

CREATE TABLE `disposure_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `disposure_to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL,
  `responsable_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `disposure_for_products`
--

INSERT INTO `disposure_for_products` (`id`, `date`, `time`, `notes`, `disposure_to`, `created_at`, `updated_at`, `location_for_products_id`, `responsable_id`) VALUES
(1, '2018-07-01', '11:35:00', 'asdfds', 'no se', '2018-07-19 01:02:37', '2018-07-19 01:02:37', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entries`
--

CREATE TABLE `entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `entries`
--

INSERT INTO `entries` (`id`, `folio`, `date`, `time`, `comment`, `created_at`, `updated_at`, `location_id`, `person_id`) VALUES
(1, 'ENT-1', '2018-06-01', '11:30:00', 'fdfhgfgh', '2018-06-20 21:29:43', '2018-06-20 21:29:43', 1, 5),
(2, 'ENT-2', '2018-08-01', '11:50:00', 'REgresa de reparación', '2018-08-22 21:43:56', '2018-08-22 21:43:56', 12, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entries_details`
--

CREATE TABLE `entries_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL,
  `entry_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `entries_details`
--

INSERT INTO `entries_details` (`id`, `created_at`, `updated_at`, `asset_id`, `entry_id`) VALUES
(1, '2018-06-20 21:29:43', '2018-06-20 21:29:43', 1, 1),
(2, '2018-08-22 21:43:56', '2018-08-22 21:43:56', 31, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipment`
--

CREATE TABLE `equipment` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'equipo test', '2018-03-27 17:30:53', '2018-03-27 17:30:53'),
(2, 'nuevo equipo ', '2018-03-27 17:52:37', '2018-03-27 17:52:37'),
(4, 'Impresora Inyección', '2018-06-25 17:45:39', '2018-06-25 18:09:28'),
(5, 'Impresora xxyyzz', '2018-10-05 23:24:00', '2018-10-05 23:24:00'),
(6, 'Impresora de etiquetas', '2018-10-05 23:32:21', '2018-10-05 23:32:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'App\\Person, App\\Asset, App\\Location, App\\Product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `parent_id`, `parent_type`, `created_at`, `updated_at`) VALUES
(1, '20180129053200_test_4.png', '/docs/asset/20180129053200_test_4.png', 11, 'App\\Asset', '2018-01-29 23:32:00', '2018-01-29 23:32:00'),
(2, '20180129053200_test_1.jpg', '/docs/asset/20180129053200_test_1.jpg', 11, 'App\\Asset', '2018-01-29 23:32:00', '2018-01-29 23:32:00'),
(3, '20180129060601_test_7.png', '/docs/asset/20180129060601_test_7.png', 12, 'App\\Asset', '2018-01-30 00:06:01', '2018-01-30 00:06:01'),
(5, '20180129082219_test_7.png', '/docs/asset/20180129082219_test_7.png', 14, 'App\\Asset', '2018-01-30 02:22:19', '2018-01-30 02:22:19'),
(6, '20180129083357_test_7.png', '/docs/asset/20180129083357_test_7.png', 1, 'App\\Asset', '2018-01-30 02:33:57', '2018-01-30 02:33:57'),
(7, '20180129083437_test_6.jpg', '/docs/asset/20180129083437_test_6.jpg', 7, 'App\\Asset', '2018-01-30 02:34:37', '2018-01-30 02:34:37'),
(8, '20180129083437_test_1.jpg', '/docs/asset/20180129083437_test_1.jpg', 7, 'App\\Asset', '2018-01-30 02:34:37', '2018-01-30 02:34:37'),
(9, '20180129083504_test_7.png', '/docs/asset/20180129083504_test_7.png', 8, 'App\\Asset', '2018-01-30 02:35:04', '2018-01-30 02:35:04'),
(10, '20180320094820_Create Augmented Reality Apps using Vuforia in Unity.pptx', '/docs/asset/20180320094820_Create Augmented Reality Apps using Vuforia in Unity.pptx', 15, 'App\\Asset', '2018-03-21 03:48:20', '2018-03-21 03:48:20'),
(11, '20180716045957_01.png', '/docs/asset/20180716045957_01.png', 19, 'App\\Product', '2018-07-16 21:59:57', '2018-07-16 21:59:57'),
(12, '20180822034223_fs2.txt', '/docs/asset/20180822034223_fs2.txt', 30, 'App\\Asset', '2018-08-22 20:42:23', '2018-08-22 20:42:23'),
(13, '20180822043930_fs2.txt', '/docs/asset/20180822043930_fs2.txt', 31, 'App\\Asset', '2018-08-22 21:39:30', '2018-08-22 21:39:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmwares`
--

CREATE TABLE `firmwares` (
  `id` int(10) UNSIGNED NOT NULL,
  `firmware` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `risk` int(11) NOT NULL COMMENT '0 = bajo\n1=medio\n2=alto',
  `previous_firmware` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observations` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assets_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `firmwares`
--

INSERT INTO `firmwares` (`id`, `firmware`, `date`, `risk`, `previous_firmware`, `observations`, `created_at`, `updated_at`, `assets_id`) VALUES
(1, '2.0', '2018-03-28', 1, '', 'xdxd', '2018-03-27 18:10:19', '2018-03-27 18:10:19', 1),
(2, 'nueva', '2018-06-23', 1, '', 'ninguna', '2018-06-19 16:39:53', '2018-06-19 16:39:53', 21),
(3, 'nuevo firmware', '2018-07-02', 1, 'nueva', 'prueba para dar de alta un nuevo firmware\r\n', '2018-06-19 22:23:28', '2018-06-19 22:23:28', 21),
(4, '1.1.2', '2018-06-22', 0, 'nuevo firmware', 'wdjpao d', '2018-06-25 17:42:52', '2018-06-25 17:42:52', 21),
(5, '2.0.3', '2018-06-08', 1, '1.1.2', 'awdawd', '2018-06-25 18:11:21', '2018-06-25 18:11:21', 21),
(6, '1.20', '2018-10-05', 0, '', 'Actualización para quitar errores', '2018-10-05 23:38:53', '2018-10-05 23:38:53', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL COMMENT 'App\\Person, App\\Asset, App\\Location, App\\Product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `name`, `path`, `parent_id`, `parent_type`, `created_at`, `updated_at`) VALUES
(7, '20180117090752_xx.png', '/images/person/20180117090752_xx.png', 3, 'App\\Person', '2018-01-18 03:07:52', '2018-01-18 03:07:52'),
(8, '20180117090807_xx.png', '/images/person/20180117090807_xx.png', 3, 'App\\Person', '2018-01-18 03:08:07', '2018-01-18 03:08:07'),
(9, '20180117090809_xx.png', '/images/person/20180117090809_xx.png', 3, 'App\\Person', '2018-01-18 03:08:09', '2018-01-18 03:08:09'),
(10, '20180117091325_logo_fpm.png', '/images/person/20180117091325_logo_fpm.png', 4, 'App\\Person', '2018-01-18 03:13:25', '2018-01-18 03:13:25'),
(19, '20180129051942_test_7.png', '/images/asset/20180129051942_test_7.png', 10, 'App\\Asset', '2018-01-29 23:19:42', '2018-01-29 23:19:42'),
(20, '20180129053159_test_7.png', '/images/asset/20180129053159_test_7.png', 11, 'App\\Asset', '2018-01-29 23:31:59', '2018-01-29 23:31:59'),
(21, '20180129053159_test_2.jpg', '/images/asset/20180129053159_test_2.jpg', 11, 'App\\Asset', '2018-01-29 23:31:59', '2018-01-29 23:31:59'),
(22, '20180129053159_online.png', '/images/asset/20180129053159_online.png', 11, 'App\\Asset', '2018-01-29 23:31:59', '2018-01-29 23:31:59'),
(23, '20180129060019_test_7.png', '/images/person/20180129060019_test_7.png', 6, 'App\\Person', '2018-01-30 00:00:19', '2018-01-30 00:00:19'),
(24, '20180129060056_test_4.png', '/images/person/20180129060056_test_4.png', 7, 'App\\Person', '2018-01-30 00:00:56', '2018-01-30 00:00:56'),
(25, '20180129060056_test_1.jpg', '/images/person/20180129060056_test_1.jpg', 7, 'App\\Person', '2018-01-30 00:00:56', '2018-01-30 00:00:56'),
(26, '20180129060056_online.png', '/images/person/20180129060056_online.png', 7, 'App\\Person', '2018-01-30 00:00:56', '2018-01-30 00:00:56'),
(27, '20180129060125_test_2.jpg', '/images/person/20180129060125_test_2.jpg', 8, 'App\\Person', '2018-01-30 00:01:25', '2018-01-30 00:01:25'),
(28, '20180129060241_test_7.png', '/images/person/20180129060241_test_7.png', 9, 'App\\Person', '2018-01-30 00:02:41', '2018-01-30 00:02:41'),
(29, '20180129060601_test_7.png', '/images/asset/20180129060601_test_7.png', 12, 'App\\Asset', '2018-01-30 00:06:01', '2018-01-30 00:06:01'),
(30, '20180129061135_test_3.jpg', '/images/person/20180129061135_test_3.jpg', 10, 'App\\Person', '2018-01-30 00:11:35', '2018-01-30 00:11:35'),
(31, '20180129061135_test_1.jpg', '/images/person/20180129061135_test_1.jpg', 10, 'App\\Person', '2018-01-30 00:11:35', '2018-01-30 00:11:35'),
(33, '20180129061449_test_1.jpg', '/images/person/20180129061449_test_1.jpg', 11, 'App\\Person', '2018-01-30 00:14:49', '2018-01-30 00:14:49'),
(34, '20180129061449_test_3.jpg', '/images/person/20180129061449_test_3.jpg', 11, 'App\\Person', '2018-01-30 00:14:49', '2018-01-30 00:14:49'),
(35, '20180129064536_test_7.png', '/images/person/20180129064536_test_7.png', 12, 'App\\Person', '2018-01-30 00:45:36', '2018-01-30 00:45:36'),
(36, '20180129064706_test_7.png', '/images/person/20180129064706_test_7.png', 14, 'App\\Person', '2018-01-30 00:47:06', '2018-01-30 00:47:06'),
(37, '20180129064706_test_3.jpg', '/images/person/20180129064706_test_3.jpg', 14, 'App\\Person', '2018-01-30 00:47:06', '2018-01-30 00:47:06'),
(38, '20180129064706_test_1.jpg', '/images/person/20180129064706_test_1.jpg', 14, 'App\\Person', '2018-01-30 00:47:06', '2018-01-30 00:47:06'),
(39, '20180129064824_online.png', '/images/person/20180129064824_online.png', 15, 'App\\Person', '2018-01-30 00:48:24', '2018-01-30 00:48:24'),
(40, '20180129065658_test_4.png', '/images/person/20180129065658_test_4.png', 16, 'App\\Person', '2018-01-30 00:56:58', '2018-01-30 00:56:58'),
(42, '20180129082219_test_3.jpg', '/images/asset/20180129082219_test_3.jpg', 14, 'App\\Asset', '2018-01-30 02:22:19', '2018-01-30 02:22:19'),
(43, '20180129083056_test_4.png', '/images/person/20180129083056_test_4.png', 17, 'App\\Person', '2018-01-30 02:30:56', '2018-01-30 02:30:56'),
(44, '20180129083220_test_3.jpg', '/images/person/20180129083220_test_3.jpg', 5, 'App\\Person', '2018-01-30 02:32:20', '2018-01-30 02:32:20'),
(45, '20180129083255_test_4.png', '/images/person/20180129083255_test_4.png', 1, 'App\\Person', '2018-01-30 02:32:55', '2018-01-30 02:32:55'),
(46, '20180129083255_online.png', '/images/person/20180129083255_online.png', 1, 'App\\Person', '2018-01-30 02:32:55', '2018-01-30 02:32:55'),
(47, '20180129083356_test_1.jpg', '/images/asset/20180129083356_test_1.jpg', 1, 'App\\Asset', '2018-01-30 02:33:56', '2018-01-30 02:33:56'),
(48, '20180129083357_test_2.jpg', '/images/asset/20180129083357_test_2.jpg', 1, 'App\\Asset', '2018-01-30 02:33:57', '2018-01-30 02:33:57'),
(49, '20180129083411_test_6.jpg', '/images/asset/20180129083411_test_6.jpg', 5, 'App\\Asset', '2018-01-30 02:34:11', '2018-01-30 02:34:11'),
(50, '20180129083424_test_5.png', '/images/asset/20180129083424_test_5.png', 7, 'App\\Asset', '2018-01-30 02:34:24', '2018-01-30 02:34:24'),
(51, '20180129083456_test_3.jpg', '/images/asset/20180129083456_test_3.jpg', 8, 'App\\Asset', '2018-01-30 02:34:56', '2018-01-30 02:34:56'),
(52, '20180129083456_test_4.png', '/images/asset/20180129083456_test_4.png', 8, 'App\\Asset', '2018-01-30 02:34:56', '2018-01-30 02:34:56'),
(53, '20180129084259_test_1.jpg', '/images/person/20180129084259_test_1.jpg', 19, 'App\\Person', '2018-01-30 02:42:59', '2018-01-30 02:42:59'),
(54, '20180320094820_wallhaven-567759.jpg', '/images/asset/20180320094820_wallhaven-567759.jpg', 15, 'App\\Asset', '2018-03-21 03:48:20', '2018-03-21 03:48:20'),
(55, '20180320101304_wallhaven-566655.jpg', '/images/person/20180320101304_wallhaven-566655.jpg', 20, 'App\\Person', '2018-03-21 04:13:04', '2018-03-21 04:13:04'),
(56, '20180320101304_wallhaven-567300.jpg', '/images/person/20180320101304_wallhaven-567300.jpg', 20, 'App\\Person', '2018-03-21 04:13:04', '2018-03-21 04:13:04'),
(57, '20180320101304_wallhaven-567547.jpg', '/images/person/20180320101304_wallhaven-567547.jpg', 20, 'App\\Person', '2018-03-21 04:13:04', '2018-03-21 04:13:04'),
(58, '20180322101607_wallhaven-566655.jpg', '/images/asset/20180322101607_wallhaven-566655.jpg', 3, 'App\\Product', '2018-03-23 04:16:07', '2018-03-23 04:16:07'),
(59, '20180322101756_wallhaven-567759.jpg', '/images/asset/20180322101756_wallhaven-567759.jpg', 5, 'App\\Product', '2018-03-23 04:17:56', '2018-03-23 04:17:56'),
(61, 'image', 'images/persons/0Xtv8cIz2p_1522772397_persons.jpeg', 21, 'App\\Person', '2018-04-03 21:19:58', '2018-04-03 21:19:58'),
(62, 'image', 'images/persons/7L2iygcIXQ_1522775429_persons.jpeg', 22, 'App\\Person', '2018-04-03 22:10:29', '2018-04-03 22:10:29'),
(63, 'image', 'images/persons/DgOK96VGt8_1522775793_persons.jpeg', 23, 'App\\Person', '2018-04-03 22:16:33', '2018-04-03 22:16:33'),
(64, 'image', 'images/persons/Cv2GRfsE29_1522775934_persons.jpeg', 24, 'App\\Person', '2018-04-03 22:18:54', '2018-04-03 22:18:54'),
(65, 'image', 'images/products/VISjQp9E6B_1522786906_products.jpeg', 7, 'App\\Product', '2018-04-04 01:21:46', '2018-04-04 01:21:46'),
(66, 'image', 'images/assets/mwRhCM96nt_1522946820_assets.jpeg', 20, 'App\\Asset', '2018-04-05 21:47:00', '2018-04-05 21:47:00'),
(67, '20180409101405_wallhaven-566655.jpg', '/images/asset/20180409101405_wallhaven-566655.jpg', 8, 'App\\Product', '2018-04-10 03:14:05', '2018-04-10 03:14:05'),
(68, '20180412095906_lol.jpg', '/images/asset/20180412095906_lol.jpg', 10, 'App\\Product', '2018-04-13 02:59:06', '2018-04-13 02:59:06'),
(69, '20180412100833_Telcel-Logo-600x330.jpg', '/images/asset/20180412100833_Telcel-Logo-600x330.jpg', 11, 'App\\Product', '2018-04-13 03:08:33', '2018-04-13 03:08:33'),
(70, '20180512032808_Captura de pantalla 2018-04-30 a la(s) 11.28.42.png', '/images/asset/20180512032808_Captura de pantalla 2018-04-30 a la(s) 11.28.42.png', 12, 'App\\Product', '2018-05-12 08:28:08', '2018-05-12 08:28:08'),
(71, '20180512032918_Captura de pantalla 2018-04-30 a la(s) 12.32.54.png', '/images/asset/20180512032918_Captura de pantalla 2018-04-30 a la(s) 12.32.54.png', 14, 'App\\Product', '2018-05-12 08:29:18', '2018-05-12 08:29:18'),
(72, '20180512033926_Captura de pantalla 2018-04-30 a la(s) 12.32.54.png', '/images/asset/20180512033926_Captura de pantalla 2018-04-30 a la(s) 12.32.54.png', 15, 'App\\Product', '2018-05-12 08:39:26', '2018-05-12 08:39:26'),
(73, '20180515073610_1.PNG', '/images/person/20180515073610_1.PNG', 25, 'App\\Person', '2018-05-16 00:36:10', '2018-05-16 00:36:10'),
(74, '20180517044355_wallhaven-619432.png', '/images/asset/20180517044355_wallhaven-619432.png', 16, 'App\\Product', '2018-05-17 21:43:55', '2018-05-17 21:43:55'),
(75, '20180620051805_44559419_Mysterion_2.png', '/images/asset/20180620051805_44559419_Mysterion_2.png', 18, 'App\\Product', '2018-06-20 22:18:05', '2018-06-20 22:18:05'),
(76, '20180626053122_33000513_44559419_Mysterion_2.png', '/images/person/20180626053122_33000513_44559419_Mysterion_2.png', 28, 'App\\Person', '2018-06-26 22:31:22', '2018-06-26 22:31:22'),
(77, '20180716045957_01.png', '/images/asset/20180716045957_01.png', 19, 'App\\Product', '2018-07-16 21:59:57', '2018-07-16 21:59:57'),
(78, '20180718080704_maxresdefault.jpg', '/images/asset/20180718080704_maxresdefault.jpg', 29, 'App\\Asset', '2018-07-19 01:07:04', '2018-07-19 01:07:04'),
(79, '20180822034223_frame (1).png', '/images/asset/20180822034223_frame (1).png', 30, 'App\\Asset', '2018-08-22 20:42:23', '2018-08-22 20:42:23'),
(80, '20180822043930_frame (1).png', '/images/asset/20180822043930_frame (1).png', 31, 'App\\Asset', '2018-08-22 21:39:30', '2018-08-22 21:39:30'),
(81, '20180906090307_history.png', '/images/asset/20180906090307_history.png', 21, 'App\\Product', '2018-09-07 02:03:07', '2018-09-07 02:03:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidents`
--

CREATE TABLE `incidents` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = Limpieza, 1 = Reparación',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `suggested_date` date NOT NULL,
  `suggested_time` time NOT NULL,
  `priority` int(11) NOT NULL COMMENT '0 - Baja, 1 - Media, 2 - Baja',
  `evidence_file` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `incidents`
--

INSERT INTO `incidents` (`id`, `folio`, `type`, `description`, `suggested_date`, `suggested_time`, `priority`, `evidence_file`, `notes`, `created_at`, `updated_at`, `asset_id`, `person_id`) VALUES
(4, 'EEO-1', 1, 'ya no funciona el disco', '2018-05-15', '04:06:00', 1, 'images/incidents/Wbhw9gFZOs_1525300847_incidents.jpg', 'ninguna', '2018-05-02 22:40:47', '2018-05-02 22:40:47', 1, 1),
(5, 'EEO-5', 0, 'necesita limpiafdhgfh', '2018-05-08', '07:00:00', 1, 'images/incidents/1aMPEG4ets_1525301593_incidents.png', 'jkadhfdj', '2018-05-02 22:53:13', '2018-06-18 20:04:35', 1, 5),
(6, 'EEO-6', 0, 'limpia 2', '2018-06-27', '16:18:00', 0, 'images/incidents/b0RBotA3uy_1529352242_incidents.jpg', 'ninguna', '2018-06-18 20:04:02', '2018-06-18 20:04:02', 19, 5),
(7, 'EEO-7', 1, 'reparar el disco duro sfda', '2018-06-20', '04:11:00', 0, 'images/incidents/amPikJ3bGW_1529432534_incidents.jpg', 'nada', '2018-06-19 18:22:14', '2018-06-19 18:22:48', 20, 24),
(8, 'EEO-8', 1, 'No imprime', '2018-06-22', '03:00:00', 0, 'images/incidents/zzBZSdEIay_1529949757_incidents.png', 'No imprime, urgente', '2018-06-25 18:02:37', '2018-06-25 18:02:37', 26, 5),
(9, 'EEO-9', 0, 'Cambiar rodillo y cabezal', '2018-07-27', '02:00:00', 1, 'images/incidents/sLorOuuE3Z_1532124798_incidents.png', 'awdawd', '2018-07-20 22:13:18', '2018-07-20 22:13:18', 26, 1),
(10, 'EEO-10', 1, 'Se descompuso el rodillo', '2018-10-20', '01:00:00', 1, 'images/incidents/kr6Him62HN_1538782903_incidents.doc', 'Notas', '2018-10-05 23:41:43', '2018-10-05 23:41:43', 32, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incident_part`
--

CREATE TABLE `incident_part` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `part_id` int(10) UNSIGNED NOT NULL,
  `incident_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `incident_part`
--

INSERT INTO `incident_part` (`id`, `created_at`, `updated_at`, `part_id`, `incident_id`) VALUES
(4, NULL, NULL, 1, 5),
(5, NULL, NULL, 6, 8),
(6, NULL, NULL, 6, 9),
(7, NULL, NULL, 7, 9),
(8, NULL, NULL, 6, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory`
--

CREATE TABLE `inventory` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = disponible\n0 = salida\n2 = en disposicion',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventory`
--

INSERT INTO `inventory` (`id`, `status`, `created_at`, `updated_at`, `location_id`, `asset_id`) VALUES
(1, 1, NULL, '2018-01-30 02:33:56', 5, 1),
(2, 1, '2018-01-29 22:00:32', '2018-01-30 02:35:04', 5, 8),
(3, 1, '2018-01-29 23:18:15', NULL, 1, 9),
(4, 1, '2018-01-29 23:19:42', NULL, 6, 10),
(5, 1, '2018-01-29 23:31:59', '2018-01-30 00:06:40', 6, 11),
(6, 1, NULL, '2018-01-30 00:07:15', 1, 12),
(7, 1, '2018-01-30 02:20:41', NULL, 6, 13),
(8, 1, '2018-01-30 02:21:21', '2018-03-21 06:03:39', 6, 14),
(9, 1, NULL, '2018-01-30 02:34:11', 5, 5),
(10, 1, NULL, '2018-01-30 02:34:37', 5, 7),
(11, 1, NULL, '2018-02-01 02:21:55', 7, 6),
(12, 1, '2018-03-21 06:05:32', NULL, 1, 16),
(13, 1, NULL, NULL, 3, 17),
(14, 1, NULL, NULL, 3, 18),
(15, 1, NULL, NULL, 3, 19),
(16, 1, NULL, NULL, 3, 20),
(17, 1, NULL, NULL, 6, 21),
(18, 1, NULL, NULL, 1, 22),
(19, 1, NULL, NULL, 5, 26),
(20, 1, '2018-07-19 01:07:04', NULL, 5, 29),
(21, 1, '2018-08-22 20:42:22', '2018-08-22 20:42:38', 11, 30),
(22, 1, '2018-08-22 21:39:30', '2018-08-22 21:53:30', 12, 31),
(23, 1, NULL, NULL, 5, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_for_products`
--

CREATE TABLE `inventory_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `last_delivery_date` date NOT NULL,
  `last_delivery_time` time NOT NULL,
  `last_departure_date` date DEFAULT NULL,
  `last_departure_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventory_for_products`
--

INSERT INTO `inventory_for_products` (`id`, `amount`, `unit_price`, `last_delivery_date`, `last_delivery_time`, `last_departure_date`, `last_departure_time`, `created_at`, `updated_at`, `product_id`, `location_for_products_id`) VALUES
(1, 1070, 686.00, '2018-06-21', '19:08:35', '2018-06-21', '19:08:35', NULL, '2018-06-22 00:08:35', 6, 2),
(2, 50, 1234.00, '2018-04-03', '20:21:46', NULL, NULL, NULL, NULL, 7, 3),
(3, 20, 100.00, '2018-07-18', '19:37:56', '2018-07-18', '19:37:56', '2018-07-19 00:37:56', '2018-07-19 00:37:56', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `building` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `floor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `shelf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hall` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compartment` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `description`, `address`, `building`, `floor`, `shelf`, `area`, `hall`, `room`, `compartment`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'descripcion1', 'adsf', 'sadfads', 'adsfads', 'asdf', 'adsf', 'asdf', 'asdf', 'adsf', 'asdf', NULL, NULL),
(3, 'ubicacion on the fly', 'Ecuador', '792', 'segundo', '', '', '', '', '', '', '2018-01-03 00:22:24', '2018-01-03 00:22:24'),
(5, 'Ubicación de prueba ', 'ceibas ', 'informática ', '4', '4', 'soporte', '0', '0', '0', 'prueba de notas para ubicaciones ', '2018-01-18 03:51:18', '2018-06-27 02:33:34'),
(6, 'Prueba de ubicación', 'ceibas 201', 'ALTATEC', '4', '', 'IT', '', '', '', '', '2018-01-18 22:35:34', '2018-01-18 22:35:34'),
(9, 'nueva ubicación ', 'gffjh', 'gshf', 'jshdfjh', '', 'sjfhdjs', '', '', '', 'fsdfsd', '2018-05-16 00:39:01', '2018-05-16 00:39:01'),
(10, 'ubicación final', 'dfijsadfi', '12', '1', '', '', '', '', '', '', '2018-06-18 19:55:40', '2018-06-18 19:57:07'),
(11, 'Oficina Juan', 'Rincón de las Ceibas, 76', 'Jalisco', '1', '', '', '', '', '', '', '2018-08-22 20:39:34', '2018-08-22 20:39:34'),
(12, 'Oficina de Horacio', 'awdwdd', '1', '2', '', '', '', '', '', '', '2018-08-22 21:37:51', '2018-08-22 21:37:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations_for_products`
--

CREATE TABLE `locations_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `custom_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `building` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `shelf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hall` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compartment` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_office_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `locations_for_products`
--

INSERT INTO `locations_for_products` (`id`, `custom_id`, `description`, `building`, `area`, `shelf`, `room`, `hall`, `compartment`, `notes`, `created_at`, `updated_at`, `branch_office_id`) VALUES
(1, '123', 'test', 'test', 'test', 'test', 'test', 'test', 'tes', '', '2018-03-23 04:44:18', '2018-03-23 04:44:18', 1),
(2, '2', 'nuevo de test', 'edificio de test', 'test', '', '', '', '', '', '2018-03-26 22:03:17', '2018-03-26 22:03:17', 1),
(3, '1', 'ubicación de prueba', 'test', 'test', 'test', 'test', 'test', 'test', 'ubicación desde la app de activos ', '2018-04-02 21:21:08', '2018-04-13 03:30:51', 1),
(4, 'SUC01', 'UB01', '1', '123', '', '', '', '', '', '2018-09-07 02:05:41', '2018-09-07 02:05:41', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maintenances`
--

CREATE TABLE `maintenances` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = Limpieza, 1 = Reparación',
  `is_periodical` tinyint(1) NOT NULL COMMENT 'If is false, write maintenance_date',
  `notes` text COLLATE utf8_unicode_ci,
  `maintenance_date` date DEFAULT NULL,
  `maintenance_time` time DEFAULT NULL,
  `is_annual` tinyint(1) DEFAULT '0',
  `is_monthly` tinyint(1) DEFAULT '0',
  `is_biweekly` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `maintenances`
--

INSERT INTO `maintenances` (`id`, `type`, `is_periodical`, `notes`, `maintenance_date`, `maintenance_time`, `is_annual`, `is_monthly`, `is_biweekly`, `created_at`, `updated_at`, `asset_id`) VALUES
(1, 0, 0, 'test', '2018-03-27', '00:00:00', 0, 0, 0, '2018-03-22 00:40:34', '2018-03-22 00:40:34', 5),
(2, 1, 0, 'reparar', '2018-03-20', '00:00:00', 0, 0, 0, '2018-03-22 00:41:31', '2018-03-22 00:41:31', 1),
(3, 0, 0, 'xd', '2018-03-21', '00:00:00', 0, 0, 0, '2018-03-22 00:42:31', '2018-03-22 00:42:31', 1),
(4, 0, 0, 'demasiado sucio ', '2018-05-24', NULL, 0, 0, 0, '2018-05-23 19:45:10', '2018-05-23 19:45:10', 5),
(5, 1, 0, 'afdsf', '2018-05-24', NULL, 0, 0, 0, '2018-05-23 19:53:15', '2018-05-23 19:53:15', 19),
(6, 0, 0, 'aquí va la descripción ', '2018-06-21', '15:10:00', 0, 0, 0, '2018-06-19 15:25:49', '2018-06-19 15:25:49', 1),
(7, 0, 0, 'qiweq', '1935-01-28', '08:15:00', 0, 0, 0, '2018-06-19 20:00:30', '2018-06-19 20:00:49', 20),
(8, 0, 0, 'sdygdfg', '1934-01-29', '05:15:00', 0, 0, 0, '2018-06-19 20:03:13', '2018-06-19 20:03:29', 1),
(9, 0, 0, 'esta demasiado sucio ', '1934-01-25', '19:10:00', 0, 0, 0, '2018-06-20 22:06:45', '2018-06-20 21:01:03', 1),
(10, 0, 0, 'producto en revisión ', '1932-01-27', '12:11:00', 0, 0, 0, '2018-06-20 22:16:48', '2018-06-20 22:17:01', 20),
(11, 0, 0, 'dgfgfg', '2018-07-26', '11:16:00', 0, 0, 0, '2018-06-21 17:32:41', '2018-07-20 22:26:44', 1),
(12, 0, 0, 'Limpieza general', '2018-07-26', '03:00:00', 0, 0, 0, '2018-07-20 21:50:59', '2018-07-20 22:26:32', 26),
(13, 0, 0, 'Preguntar primero', '2018-07-26', '01:00:00', 0, 0, 0, '2018-07-20 22:25:20', '2018-07-20 22:25:20', 26),
(14, 0, 0, 'awdwad', '2018-07-26', '01:01:00', 0, 0, 0, '2018-07-20 22:25:56', '2018-07-20 22:25:56', 26),
(15, 0, 0, 'awd', '2018-07-26', '01:00:00', 0, 0, 0, '2018-07-20 22:26:24', '2018-07-20 22:26:24', 26),
(16, 0, 0, 'dawd', '2018-07-26', '01:00:00', 0, 0, 0, '2018-07-20 22:27:20', '2018-07-20 22:27:20', 26),
(17, 0, 0, 'wad', '2018-07-26', '01:00:00', 0, 0, 0, '2018-07-20 22:27:46', '2018-07-20 22:27:46', 26),
(18, 0, 0, 'awd', '2018-07-26', '01:00:00', 0, 0, 0, '2018-07-20 22:28:00', '2018-07-20 22:28:00', 26),
(19, 0, 0, 'awdawd', '2018-07-26', '01:00:00', 0, 0, 0, '2018-07-20 22:28:21', '2018-07-20 22:28:21', 26),
(20, 0, 0, 'Mantenimiento a lap horacio', '2018-08-30', NULL, 0, 0, 0, '2018-08-22 21:54:50', '2018-08-22 21:54:50', 31),
(21, 0, 1, 'Limpieza mensual a lap', NULL, NULL, 0, 1, 0, '2018-08-22 21:55:43', '2018-08-22 21:55:43', 31),
(22, 0, 1, 'Lmpieza mensual', NULL, NULL, 0, 1, 0, '2018-08-22 21:56:35', '2018-08-22 21:56:35', 30),
(23, 0, 0, 'awdawd', '2018-10-09', '01:00:00', 0, 0, 0, '2018-10-05 23:55:58', '2018-10-05 23:55:58', 32),
(24, 0, 0, 'awdawd', '2018-10-06', '16:00:00', 0, 0, 0, '2018-10-05 23:56:51', '2018-10-05 23:56:51', 32),
(25, 0, 0, 'Mantenimiento programado', '2018-10-10', '06:00:00', 0, 0, 0, '2018-10-05 23:58:58', '2018-10-05 23:58:58', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `measure_units`
--

CREATE TABLE `measure_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `measure_units`
--

INSERT INTO `measure_units` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'nueva', 'metro', '2018-03-23 04:12:09', '2018-03-23 04:12:09'),
(2, 'unidad desde pro', 'test test test', '2018-03-24 00:12:57', '2018-03-24 00:12:57'),
(3, 'catalogo unidades', 'catalogo de pruebass', '2018-04-13 19:55:52', '2018-04-13 19:56:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parts`
--

CREATE TABLE `parts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `parts`
--

INSERT INTO `parts` (`id`, `name`, `number`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'parte test', '1', '2000.00', 'descri test', '2018-03-27 17:30:09', '2018-03-27 17:30:09'),
(3, 'otra parte', '12', '500.00', 'xdxd', '2018-03-27 17:32:18', '2018-03-27 17:32:18'),
(5, 'parte para prueba', '10', '550.00', 'descripción de parte para la prueba', '2018-06-19 18:17:16', '2018-06-19 18:18:06'),
(6, 'Rodillo 123XYZ', 'ROD123', '100.00', 'Rodillo de impresora', '2018-06-25 17:44:55', '2018-07-20 22:08:42'),
(7, 'Cabezal', 'CAB123', '100.00', 'Cabezal deimpresora', '2018-06-25 18:08:40', '2018-06-25 18:08:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parts_equipment`
--

CREATE TABLE `parts_equipment` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `part_id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `parts_equipment`
--

INSERT INTO `parts_equipment` (`id`, `created_at`, `updated_at`, `part_id`, `equipment_id`) VALUES
(1, NULL, NULL, 1, 1),
(3, NULL, NULL, 3, 2),
(5, NULL, NULL, 6, 4),
(6, NULL, NULL, 7, 4),
(7, NULL, NULL, 6, 5),
(8, NULL, NULL, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '9ce00869b75d4ffef72e1dddbf1be5a8213a25b65c46f91c089f783b3e9635bf', '2018-06-20 20:21:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modules_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `modules_id`) VALUES
(1, 'listar_captura_info', 'Listar captura de información', 'Permiso para listar captura de información', NULL, NULL, 3),
(2, 'crear_captura_info', 'Crear captura de información', 'Permiso para crear captura de información', NULL, NULL, 3),
(3, 'editar_captura_info', 'Editar captura de información', 'Permiso para editar captura de información', NULL, NULL, 3),
(4, 'mostrar_captura_info', 'Mostrar captura de información', 'Permiso para mostrar captura de información', NULL, NULL, 3),
(5, 'actualizar_firmware', 'Actualizar firmware', 'Permiso para actualizar firmware', NULL, NULL, 3),
(6, 'historial_firmware', 'Historial de firmware', 'Permiso para historial de firmware', NULL, NULL, 3),
(7, 'listar_catalogo_correlativos', 'Listar catálogo de correlativos', 'Permiso para listar catálogo de correlativos', NULL, NULL, 3),
(8, 'crear_catalogo_correlativos', 'Crear catálogo de correlativos', 'Permiso para crear catálogo de correlativos', NULL, NULL, 3),
(9, 'editar_catalogo_correlativos', 'Editar catálogo de correlativos', 'Permiso para editar catálogo de correlativos', NULL, NULL, 3),
(10, 'eliminar_catalogo_correlativos', 'Eliminar catálogo de correlativos', 'Permiso para eliminar catálogo de correlativos', NULL, NULL, 3),
(11, 'listar_registro_incidencias', 'Listar registro de incidencias', 'Permiso para listar registro de incidencias', NULL, NULL, 3),
(12, 'crear_registro_incidencias', 'Crear registro de incidencias', 'Permiso para crear registro de incidencias', NULL, NULL, 3),
(13, 'editar_registro_incidencias', 'Editar registro de incidencias', 'Permiso para editar registro de incidencias', NULL, NULL, 3),
(14, 'eliminar_registro_incidencias', 'Eliminar registro de incidencias', 'Permiso para eliminar registro de incidencias', NULL, NULL, 3),
(15, 'generar_orden_servicio', 'Generar orden de servicio', 'Permiso para generar orden de servicio', NULL, NULL, 3),
(16, 'listar_consulta_atencion_incidencias', 'Listar consulta y atención de incidencias', 'Permiso para listar consulta y atención de incidencias', NULL, NULL, 3),
(17, 'mostrar_consulta_atencion_incidencias', 'Mostrar consulta y atención de incidencias', 'Permiso para mostrar consulta y atención de incidencias', NULL, NULL, 3),
(18, 'listar_cotizacion_servicios', 'Listar cotización de servicios', 'Permiso para listar cotización de servicios', NULL, NULL, 3),
(19, 'crear_cotizacion_servicios', 'Crear cotización de servicios', 'Permiso para crear cotización de servicios', NULL, NULL, 3),
(20, 'editar_cotizacion_servicios', 'Editar cotización de servicios', 'Permiso para editar cotización de servicios', NULL, NULL, 3),
(21, 'mostrar_cotizacion_servicios', 'Mostrar cotización de servicios', 'Permiso para mostrar cotización de servicios', NULL, NULL, 3),
(22, 'cancelar_cotizacion_servicios', 'Cancelar cotización de servicios', 'Permiso para cancelar cotización de servicios', NULL, NULL, 3),
(23, 'cambiar_estatus_cotizacion_servicios', 'Cambiar estatus de cotización de servicios', 'Permiso para cambiar estatus de cotización de servicios', NULL, NULL, 3),
(24, 'listar_tipo_equipo', 'Listar tipos de equipo', 'Permiso para listar tipos de equipo', NULL, NULL, 3),
(25, 'crear_tipo_equipo', 'Crear tipos de equipo', 'Permiso para crear tipos de equipo', NULL, NULL, 3),
(26, 'editar_tipo_equipo', 'Editar tipos de equipo', 'Permiso para editar tipos de equipo', NULL, NULL, 3),
(27, 'eliminar_tipo_equipo', 'Eliminar tipos de equipo', 'Permiso para eliminar tipos de equipo', NULL, NULL, 3),
(28, 'generar_reporte_tickets', 'Generar reporte de tickets por usuario y status', 'Permiso para generar reporte de tickets por usuario y status', NULL, NULL, 3),
(29, 'exportar_reporte_tickets', 'Exportar reporte de tickets por usuario y status', 'Permiso para exportar reporte de tickets por usuario y status', NULL, NULL, 3),
(30, 'generar_reporte_servicio', 'Generar reporte de servicio para clientes', 'Permiso para generar reporte de servicio para clientes', NULL, NULL, 3),
(31, 'exportar_reporte_servicio', 'Exportar reporte de servicio para clientes', 'Permiso para exportar reporte de servicio para clientes', NULL, NULL, 3),
(32, 'generar_reporte_incidencias', 'Generar reporte de incidencias', 'Permiso para generar reporte de incidencias', NULL, NULL, 3),
(33, 'exportar_reporte_incidencias', 'Exportar reporte de incidencias', 'Permiso para exportar reporte de incidencias', NULL, NULL, 3),
(34, 'listar_consulta_servicio', 'Listar consulta de servicio', 'Permiso para listar consulta de servicio', NULL, NULL, 3),
(35, 'mostrar_consulta_servicio', 'Mostrar consulta de servicio', 'Permiso para mostrar consulta de servicio', NULL, NULL, 3),
(36, 'generar_consulta_bitacora', 'Generar consulta de bitácora e historial de servicios', 'Permiso para generar consulta de bitácora e historial de servicios', NULL, NULL, 3),
(37, 'descargar_consulta_bitacora', 'Descargar consulta de bitácora e historial de servicios', 'Permiso para descargar consulta de bitácora e historial de servicios', NULL, NULL, 3),
(38, 'listar_catalogo_proveedores', 'Listar catálogo de proveedores', 'Permiso para listar catálogo de proveedores', NULL, NULL, 3),
(39, 'crear_catalogo_proveedores', 'Crear catálogo de proveedores', 'Permiso para crear catálogo de proveedores', NULL, NULL, 3),
(40, 'editar_catalogo_proveedores', 'Editar catálogo de proveedores', 'Permiso para editar catálogo de proveedores', NULL, NULL, 3),
(41, 'eliminar_catalogo_proveedores', 'Eliminar catálogo de proveedores', 'Permiso para eliminar catálogo de proveedores', NULL, NULL, 3),
(42, 'listar_catalogo_personas', 'Listar catálogo de personas', 'Permiso para listar catálogo de personas', NULL, NULL, 3),
(43, 'crear_catalogo_personas', 'Crear catálogo de personas', 'Permiso para crear catálogo de personas', NULL, NULL, 3),
(44, 'editar_catalogo_personas', 'Editar catálogo de personas', 'Permiso para editar catálogo de personas', NULL, NULL, 3),
(45, 'eliminar_catalogo_personas', 'Eliminar catálogo de personas', 'Permiso para eliminar catálogo de personas', NULL, NULL, 3),
(46, 'listar_catalogo_ubicaciones', 'Listar catálogo de ubicaciones', 'Permiso para listar catálogo de ubicaciones', NULL, NULL, 3),
(47, 'crear_catalogo_ubicaciones', 'Crear catálogo de ubicaciones', 'Permiso para crear catálogo de ubicaciones', NULL, NULL, 3),
(48, 'editar_catalogo_ubicaciones', 'Editar catálogo de ubicaciones', 'Permiso para editar catálogo de ubicaciones', NULL, NULL, 3),
(49, 'eliminar_catalogo_ubicaciones', 'Eliminar catálogo de ubicaciones', 'Permiso para eliminar catálogo de ubicaciones', NULL, NULL, 3),
(50, 'listar_catalogo_clientes', 'Listar catálogo de clientes', 'Permiso para listar catálogo de clientes', NULL, NULL, 3),
(51, 'crear_catalogo_clientes', 'Crear catálogo de clientes', 'Permiso para crear catálogo de clientes', NULL, NULL, 3),
(52, 'editar_catalogo_clientes', 'Editar catálogo de clientes', 'Permiso para editar catálogo de clientes', NULL, NULL, 3),
(53, 'eliminar_catalogo_clientes', 'Eliminar catálogo de clientes', 'Permiso para eliminar catálogo de clientes', NULL, NULL, 3),
(54, 'listar_catalogo_proyectos', 'Listar catálogo de proyectos', 'Permiso para listar catálogo de proyectos', NULL, NULL, 3),
(55, 'crear_catalogo_proyectos', 'Crear catálogo de proyectos', 'Permiso para crear catálogo de proyectos', NULL, NULL, 3),
(56, 'editar_catalogo_proyectos', 'Editar catálogo de proyectos', 'Permiso para editar catálogo de proyectos', NULL, NULL, 3),
(57, 'eliminar_catalogo_proyectos', 'Eliminar catálogo de proyectos', 'Permiso para eliminar catálogo de proyectos', NULL, NULL, 3),
(58, 'acceder_app_soporte', 'Acceder a Aplicación de Soporte', 'Permiso para acceder a la aplicación de soporte', NULL, NULL, 4),
(59, 'acceder_app_activos_inventarios', 'Acceder a Aplicación de Activos/Inventarios', 'Permiso para acceder a la aplicación de activos/inventarios', NULL, NULL, 5),
(60, 'listar_activos', 'Listar activos', 'Permiso para listar activos', NULL, NULL, 2),
(61, 'agregar_activos', 'Agregar activos', 'Permiso para agregar activos', NULL, NULL, 2),
(62, 'crear_activos', 'Crear activos', 'Permiso para crear activos', NULL, NULL, 2),
(63, 'eliminar_activos', 'Eliminar activos', 'Permiso para eliminar activos', NULL, NULL, 2),
(64, 'listar_personas', 'Listar personas', 'Permiso para listar personas', NULL, NULL, 2),
(65, 'agregar_personas', 'Agregar personas', 'Permiso para agregar personas', NULL, NULL, 2),
(66, 'crear_personas', 'Crear personas', 'Permiso para crear personas', NULL, NULL, 2),
(67, 'eliminar_personas', 'Eliminar personas', 'Permiso para eliminar personas', NULL, NULL, 2),
(68, 'listar_ubicaciones_activos', 'Listar ubicaciones de activos', 'Permiso para listar ubicaciones de activos', NULL, NULL, 2),
(69, 'agregar_ubicaciones_activos', 'Agregar ubicaciones de activos', 'Permiso para agregar ubicaciones de activos', NULL, NULL, 2),
(70, 'crear_ubicaciones_activos', 'Crear ubicaciones de activos', 'Permiso para crear ubicaciones de activos', NULL, NULL, 2),
(71, 'eliminar_ubicaciones_activos', 'Eliminar ubicaciones de activos', 'Permiso para eliminar ubicaciones de activos', NULL, NULL, 2),
(72, 'listar_mover_activos', 'Listar mover de activos', 'Permiso para listar mover de activos', NULL, NULL, 2),
(73, 'agregar_mover_activos', 'Agregar mover de activos', 'Permiso para agregar mover de activos', NULL, NULL, 2),
(74, 'crear_mover_activos', 'Crear mover de activos', 'Permiso para crear mover de activos', NULL, NULL, 2),
(75, 'eliminar_mover_activos', 'Eliminar mover de activos', 'Permiso para eliminar mover de activos', NULL, NULL, 2),
(76, 'listar_salidas', 'Listar salidas', 'Permiso para listar salidas', NULL, NULL, 2),
(77, 'agregar_salidas', 'Agregar salidas', 'Permiso para agregar salidas', NULL, NULL, 2),
(78, 'crear_salidas', 'Crear salidas', 'Permiso para crear salidas', NULL, NULL, 2),
(79, 'eliminar_salidas', 'Eliminar salidas', 'Permiso para eliminar salidas', NULL, NULL, 2),
(80, 'listar_entradas', 'Listar entradas', 'Permiso para listar entradas', NULL, NULL, 2),
(81, 'agregar_entradas', 'Agregar entradas', 'Permiso para agregar entradas', NULL, NULL, 2),
(82, 'crear_entradas', 'Crear entradas', 'Permiso para crear entradas', NULL, NULL, 2),
(83, 'eliminar_entradas', 'Eliminar entradas', 'Permiso para eliminar entradas', NULL, NULL, 2),
(84, 'listar_disposicion_activos', 'Listar disposición de activos', 'Permiso para listar disposición de activos', NULL, NULL, 2),
(85, 'agregar_disposicion_activos', 'Agregar disposición de activos', 'Permiso para agregar disposición de activos', NULL, NULL, 2),
(86, 'crear_disposicion_activos', 'Crear disposición de activos', 'Permiso para crear disposición de activos', NULL, NULL, 2),
(87, 'eliminar_disposicion_activos', 'Eliminar disposición de activos', 'Permiso para eliminar disposición de activos', NULL, NULL, 2),
(88, 'listar_inventario', 'Listar inventario', 'Permiso para listar inventario', NULL, NULL, 2),
(89, 'descargar_importar', 'Descargar importar', 'Permiso para descargar importar', NULL, NULL, 2),
(90, 'importar', 'Importar', 'Permiso para importar', NULL, NULL, 2),
(91, 'exportar', 'Exportar', 'Permiso para exportar', NULL, NULL, 2),
(92, 'imprimir_codigo_barras', 'Imprimir código de barras', 'Permiso para imprimir código de barras', NULL, NULL, 2),
(93, 'mostrar_reportes_activos', 'Mostrar reportes de activos', 'Permiso para mostrar reportes de activos', NULL, NULL, 2),
(94, 'mostrar_analisis_activos', 'Mostrar análisis de activos', 'Permiso para mostrar análisis de activos', NULL, NULL, 2),
(95, 'listar_proveedores_activos', 'Listar proveedores de activos', 'Permiso para listar proveedores de activos', NULL, NULL, 2),
(96, 'mostrar_proveedores_activos', 'Mostrar proveedores de activos', 'Permiso para mostrar proveedores de activos', NULL, NULL, 2),
(97, 'crear_proveedores_activos', 'Crear proveedores de activos', 'Permiso para crear proveedores de activos', NULL, NULL, 2),
(98, 'editar_proveedores_activos', 'Editar proveedores de activos', 'Permiso para editar proveedores de activos', NULL, NULL, 2),
(99, 'eliminar_proveedores_activos', 'Eliminar proveedores de activos', 'Permiso para eliminar proveedores de activos', NULL, NULL, 2),
(100, 'listar_historial_activos', 'Listar historial de activos', 'Permiso para listar historial de activos', NULL, NULL, 2),
(101, 'mostrar_historial_activos', 'Mostrar historial de activos', 'Permiso para mostrar historial de activos', NULL, NULL, 2),
(102, 'enviar_soporte', 'Enviar soporte', 'Permiso para enviar soporte', NULL, NULL, 2),
(103, 'crear_configuracion_general_activos', 'Crear configuración general de activos', 'Permiso para crear configuración general de activos', NULL, NULL, 2),
(104, 'editar_configuracion_general_activos', 'Editar configuración general de activos', 'Permiso para editar configuración general de activos', NULL, NULL, 2),
(105, 'crear_configuracion_alertas', 'Crear configuración alertas', 'Permiso para crear configuración alertas', NULL, NULL, 2),
(106, 'crear_mantenimiento_programado', 'Crear mantenimiento programado', 'Permiso para crear mantenimiento programado', NULL, NULL, 2),
(107, 'crear_catalogo_auxiliares_activos', 'Crear catálogo auxiliares de activos', 'Permiso para crear catálogo auxiliares de activos', NULL, NULL, 2),
(108, 'editar_catalogo_auxiliares_activos', 'Editar catálogo auxiliares de activos', 'Permiso para editar catálogo auxiliares de activos', NULL, NULL, 2),
(109, 'eliminar_catalogo_auxiliares_activos', 'Eliminar catálogo auxiliares de activos', 'Permiso para eliminar catálogo auxiliares de activos', NULL, NULL, 2),
(110, 'listar_productos', 'Listar productos', 'Permiso para listar productos', NULL, NULL, 1),
(111, 'mostrar_productos', 'Mostrar productos', 'Permiso para mostrar productos', NULL, NULL, 1),
(112, 'crear_productos', 'Crear productos', 'Permiso para crear productos', NULL, NULL, 1),
(113, 'editar_productos', 'Editar productos', 'Permiso para editar productos', NULL, NULL, 1),
(114, 'eliminar_productos', 'Eliminar productos', 'Permiso para eliminar productos', NULL, NULL, 1),
(115, 'listar_categorias', 'Listar categorías', 'Permiso para listar categorías', NULL, NULL, 1),
(116, 'mostrar_categorias', 'Mostrar categorías', 'Permiso para mostrar categorías', NULL, NULL, 1),
(117, 'crear_categorias', 'Crear categorías', 'Permiso para crear categorías', NULL, NULL, 1),
(118, 'editar_categorias', 'Editar categorías', 'Permiso para editar categorías', NULL, NULL, 1),
(119, 'eliminar_categorias', 'Eliminar categorías', 'Permiso para eliminar categorías', NULL, NULL, 1),
(120, 'listar_ubicaciones_inventario', 'Listar ubicaciones de inventario', 'Permiso para listar ubicaciones de inventario', NULL, NULL, 1),
(121, 'mostrar_ubicaciones_inventario', 'Mostrar ubicaciones de inventario', 'Permiso para mostrar ubicaciones de inventario', NULL, NULL, 1),
(122, 'crear_ubicaciones_inventario', 'Crear ubicaciones de inventario', 'Permiso para crear ubicaciones de inventario', NULL, NULL, 1),
(123, 'editar_ubicaciones_inventario', 'Editar ubicaciones de inventario', 'Permiso para editar ubicaciones de inventario', NULL, NULL, 1),
(124, 'eliminar_ubicaciones_inventario', 'Eliminar ubicaciones de inventario', 'Permiso para eliminar ubicaciones de inventario', NULL, NULL, 1),
(125, 'mostrar_picklist', 'Mostrar picklist', 'Permiso para mostrar picklist', NULL, NULL, 1),
(126, 'crear_picklist', 'Crear picklist', 'Permiso para crear picklist', NULL, NULL, 1),
(127, 'editar_picklist', 'Editar picklist', 'Permiso para editar picklist', NULL, NULL, 1),
(128, 'eliminar_picklist', 'Eliminar picklist', 'Permiso para eliminar picklist', NULL, NULL, 1),
(129, 'mostrar_recibir', 'Mostrar recibir', 'Permiso para mostrar recibir', NULL, NULL, 1),
(130, 'crear_recibir', 'Crear recibir', 'Permiso para crear recibir', NULL, NULL, 1),
(131, 'editar_recibir', 'Editar recibir', 'Permiso para editar recibir', NULL, NULL, 1),
(132, 'eliminar_recibir', 'Eliminar recibir', 'Permiso para eliminar recibir', NULL, NULL, 1),
(133, 'mostrar_mover_inventario', 'Mostrar mover de inventario', 'Permiso para mostrar mover de inventario', NULL, NULL, 1),
(134, 'crear_mover_inventario', 'Crear mover de inventario', 'Permiso para crear mover de inventario', NULL, NULL, 1),
(135, 'eliminar_mover_inventario', 'Eliminar mover de inventario', 'Permiso para eliminar mover de inventario', NULL, NULL, 1),
(136, 'listar_mover_inventario', 'Listar mover de inventario', 'Permiso para listar mover de inventario', NULL, NULL, 1),
(137, 'crear_problema', 'Crear problema', 'Permiso para crear problema', NULL, NULL, 1),
(138, 'mostrar_regresar', 'Mostrar regresar', 'Permiso para mostrar regresar', NULL, NULL, 1),
(139, 'crear_regresar', 'Crear regresar', 'Permiso para crear regresar', NULL, NULL, 1),
(140, 'eliminar_regresar', 'Eliminar regresar', 'Permiso para eliminar regresar', NULL, NULL, 1),
(141, 'listar_regresar', 'Listar regresar', 'Permiso para listar regresar', NULL, NULL, 1),
(142, 'mostrar_disposicion_inventario', 'Mostrar disposición de inventario', 'Permiso para mostrar disposición de inventario', NULL, NULL, 1),
(143, 'crear_disposicion_inventario', 'Crear disposición de inventario', 'Permiso para crear disposición de inventario', NULL, NULL, 1),
(144, 'eliminar_disposicion_inventario', 'Eliminar disposición de inventario', 'Permiso para eliminar disposición de inventario', NULL, NULL, 1),
(145, 'listar_disposicion_inventario', 'Listar disposición de inventario', 'Permiso para listar disposición de inventario', NULL, NULL, 1),
(146, 'mostrar_proveedores_inventario', 'Mostrar proveedores de inventario', 'Permiso para mostrar proveedores de inventario', NULL, NULL, 1),
(147, 'descargar_proveedores_inventario', 'Descargar proveedores de inventario', 'Permiso para descargar proveedores de inventario', NULL, NULL, 1),
(148, 'mostrar_historial_inventario', 'Mostrar historial de inventario', 'Permiso para mostrar historial de inventario', NULL, NULL, 1),
(149, 'mostrar_inventario_disponible', 'Mostrar inventario disponible', 'Permiso para mostrar inventario disponible', NULL, NULL, 1),
(150, 'exportar_inventario_disponible', 'Exportar inventario disponible', 'Permiso para exportar inventario disponible', NULL, NULL, 1),
(151, 'mostrar_inventario_fisico', 'Mostrar inventario físico', 'Permiso para mostrar inventario físico', NULL, NULL, 1),
(152, 'ajustar_inventario_fisico', 'Ajustar inventario físico', 'Permiso para ajustar inventario físico', NULL, NULL, 1),
(153, 'exportar_inventario_fisico', 'Exportar inventario físico', 'Permiso para exportar inventario físico', NULL, NULL, 1),
(154, 'eliminar_inventario_fisico', 'Eliminar inventario físico', 'Permiso para eliminar inventario físico', NULL, NULL, 1),
(155, 'mostrar_reportes_inventario', 'Mostrar reportes de inventario', 'Permiso para mostrar reportes de inventario', NULL, NULL, 1),
(156, 'exportar_reportes_inventario', 'Exportar reportes de inventario', 'Permiso para exportar reportes de inventario', NULL, NULL, 1),
(157, 'mostrar_analisis_inventario', 'Mostrar análisis de inventario', 'Permiso para mostrar análisis de inventario', NULL, NULL, 1),
(158, 'crear_configuracion_general_inventario', 'Crear configuración general de inventario', 'Permiso para crear configuración general de inventario', NULL, NULL, 1),
(159, 'crear_configuracion_maximos_minimos', 'Crear configuración de máximos y mínimos', 'Permiso para crear configuración de máximos y mínimos', NULL, NULL, 1),
(160, 'eliminar_configuracion_maximos_minimos', 'Eliminar configuración de máximos y mínimos', 'Permiso para eliminar configuración de máximos y mínimos', NULL, NULL, 1),
(161, 'importar_copia_seguridad', 'Importar copia de seguridad', 'Permiso para importar copia de seguridad', NULL, NULL, 1),
(162, 'exportar_copia_seguridad', 'Exportar copia de seguridad', 'Permiso para exportar copia de seguridad', NULL, NULL, 1),
(163, 'mostrar_catalogo_auxiliares_inventario', 'Mostrar catálogo auxiliares de inventario', 'Permiso para mostrar catálogo auxiliares de inventario', NULL, NULL, 1),
(164, 'crear_catalogo_auxiliares_inventario', 'Crear catálogo auxiliares de inventario', 'Permiso para crear catálogo auxiliares de inventario', NULL, NULL, 1),
(165, 'editar_catalogo_auxiliares_inventario', 'Editar catálogo auxiliares de inventario', 'Permiso para editar catálogo auxiliares de inventario', NULL, NULL, 1),
(166, 'eliminar_catalogo_auxiliares_inventario', 'Eliminar catálogo auxiliares de inventario', 'Permiso para eliminar catálogo auxiliares de inventario', NULL, NULL, 1),
(167, 'acceder_app_escritorio', 'Acceder a Aplicación de Escritorio', 'Permiso para acceder a la aplicación de escritorio', NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL),
(12, 12, 1, NULL, NULL),
(13, 13, 1, NULL, NULL),
(14, 14, 1, NULL, NULL),
(15, 15, 1, NULL, NULL),
(16, 16, 1, NULL, NULL),
(17, 17, 1, NULL, NULL),
(18, 18, 1, NULL, NULL),
(19, 19, 1, NULL, NULL),
(20, 20, 1, NULL, NULL),
(21, 21, 1, NULL, NULL),
(22, 22, 1, NULL, NULL),
(23, 23, 1, NULL, NULL),
(24, 24, 1, NULL, NULL),
(25, 25, 1, NULL, NULL),
(26, 26, 1, NULL, NULL),
(27, 27, 1, NULL, NULL),
(28, 34, 1, NULL, NULL),
(29, 35, 1, NULL, NULL),
(30, 36, 1, NULL, NULL),
(31, 37, 1, NULL, NULL),
(32, 38, 1, NULL, NULL),
(33, 39, 1, NULL, NULL),
(34, 40, 1, NULL, NULL),
(35, 41, 1, NULL, NULL),
(36, 42, 1, NULL, NULL),
(37, 43, 1, NULL, NULL),
(38, 44, 1, NULL, NULL),
(39, 46, 1, NULL, NULL),
(40, 47, 1, NULL, NULL),
(41, 48, 1, NULL, NULL),
(42, 49, 1, NULL, NULL),
(43, 50, 1, NULL, NULL),
(44, 51, 1, NULL, NULL),
(45, 52, 1, NULL, NULL),
(46, 53, 1, NULL, NULL),
(47, 54, 1, NULL, NULL),
(48, 55, 1, NULL, NULL),
(49, 56, 1, NULL, NULL),
(50, 57, 1, NULL, NULL),
(51, 28, 1, NULL, NULL),
(52, 29, 1, NULL, NULL),
(53, 30, 1, NULL, NULL),
(54, 31, 1, NULL, NULL),
(55, 32, 1, NULL, NULL),
(56, 33, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `alt_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_position` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `persons`
--

INSERT INTO `persons` (`id`, `name`, `father_last_name`, `mother_last_name`, `email`, `address`, `alt_address`, `zip_code`, `phone`, `alt_phone`, `city`, `company_position`, `company_name`, `company_address`, `company_phone`, `notes`, `created_at`, `updated_at`, `state_id`, `department_id`) VALUES
(1, 'Saul Antonio1', 'Martinez', 'Flores', 'saul.mtzs@gmail.com', 'Direccion', '', '45520', '3317044705', '', 'Guadalajara', 'Desarrolador', 'Empresa', 'Rinconada de las ceibas 76', '3317044705', 'dede', '2018-01-03 00:10:13', '2018-01-30 02:32:55', 1, 2),
(2, 'Persona on the fly', 'Apellido', 'Flores', 'saul.mtzs@gmail.com', 'Address', '', '85000', '3317044705', '', 'Ciudad', 'Developer', 'Empresa', 'Address', '3317044705', '', '2018-01-03 01:00:55', '2018-01-03 01:00:55', 1, 3),
(5, 'Dania ', 'B', 'Bernal', 'dania@messoft.com', 'ceibas', 'ceibas', '65194', '3111020334', '3111020334', 'zapopan ', 'BA', 'nuvem', 'ceibas', '3111020334', 'prueba', '2018-01-18 03:13:40', '2018-01-18 03:23:54', 1, 1),
(24, 'persona 3', 'test1', 'test2', 'test@gmail.com', 'hsjsjs', '', '12345', '1234567890', '', 'hddjb', '', '', '', '', 'tercera persona ', '2018-04-03 22:18:54', '2018-06-19 21:21:15', 2, 2),
(26, 'pruebas', 'pruebas', 'pruebas', 'prueba@pruebas.com', 'fygsduyhfakj', '', '12345', '1234567890', '', 'SWDEFSDGF', 'Developer', 'empresa de pruebas', 'Rinconada de las ceibas 76', '3317044705', '', '2018-06-18 19:54:53', '2018-06-20 21:11:55', 1, 7),
(27, 'Horacio', 'Mejía', 'X', 'hmejia@eeo.mx', 'adwd', '', '45120', '1234567890', '', 'Guadalajara', 'Sistemas', 'EEO', 'awdawd', '1234567890', '', '2018-08-22 21:37:14', '2018-08-22 21:37:14', 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `physical_inventory`
--

CREATE TABLE `physical_inventory` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_for_product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `physical_inventory_history`
--

CREATE TABLE `physical_inventory_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `inventory_amount` int(11) NOT NULL,
  `physical_count` int(11) NOT NULL,
  `count_variation` int(11) NOT NULL,
  `amount_to_adjust` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `physical_inventory_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `physical_inventory_history`
--

INSERT INTO `physical_inventory_history` (`id`, `date`, `time`, `inventory_amount`, `physical_count`, `count_variation`, `amount_to_adjust`, `description`, `created_at`, `updated_at`, `product_id`, `physical_inventory_id`) VALUES
(1, '2018-06-20', '10:13:55', 50, 70, 30, 20, 'N/A', '2018-06-21 03:13:55', '2018-06-21 03:13:55', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pick_list`
--

CREATE TABLE `pick_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `is_closed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pick_list`
--

INSERT INTO `pick_list` (`id`, `code`, `description`, `deadline`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 'pic123', 'frghgv', '2018-07-31', 0, '2018-07-19 00:39:00', '2018-07-19 00:39:00'),
(2, '123', '123', '2018-08-29', 1, '2018-08-29 21:43:44', '2018-08-29 21:44:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pick_list_detail`
--

CREATE TABLE `pick_list_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL,
  `pick_list_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pick_list_detail`
--

INSERT INTO `pick_list_detail` (`id`, `amount`, `created_at`, `updated_at`, `product_id`, `location_for_products_id`, `pick_list_id`) VALUES
(2, 1, '2018-07-19 00:40:34', '2018-07-19 00:40:34', 3, 1, 1),
(3, 10, '2018-08-29 21:43:44', '2018-08-29 21:43:44', 3, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_number` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `barcode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `max` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `measure_unit_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `part_number`, `name`, `brand`, `cost`, `barcode`, `description`, `notes`, `max`, `min`, `created_at`, `updated_at`, `provider_id`, `measure_unit_id`) VALUES
(3, 'Producto2', 'Producto2', 'tewst', '123.00', '123456', 'xd', 'xd', 1, 123, '2018-03-23 04:16:07', '2018-04-10 03:03:14', 10, 1),
(5, 'Producto3', 'Producto3', 'test', '546.00', '25646', 'test 3', '', 100, 5, '2018-03-23 04:17:56', '2018-04-10 03:03:03', 9, 1),
(6, '123', 'producto app', 'test', '586.00', 'fhfff', '', 'producto desde la app activos ', 50, 10, '2018-04-02 20:59:04', '2018-04-10 03:16:31', 9, 1),
(7, '363', 'nuevo ', 'marca nueva', '1234.00', 'hdkdj', NULL, 'producto desde app', 50, 10, '2018-04-04 01:21:46', '2018-04-04 01:21:46', 9, 1),
(8, '123', 'producto1', 'marca 1', '54212.00', '8745314534', 'descri', 'notas 1', 100, 10, '2018-04-10 03:14:05', '2018-04-10 03:14:05', 9, 1),
(9, '123', 'producto1', 'marca 1', '54212.00', '8745314534', 'descri', 'notas 1', 100, 10, '2018-04-10 03:14:40', '2018-04-10 03:14:40', 9, 1),
(10, '12', 'prueba', 'marca test', '54.00', '45554', 'descri', 'notas test', 20, 5, '2018-04-13 02:59:06', '2018-04-13 02:59:06', 10, 1),
(11, 'prueba', 'pruebaa', 'prueba', '51221.00', '123456789', 'pruebas ', 'jeje', 100, 10, '2018-04-13 03:08:33', '2018-04-13 03:08:33', 9, 1),
(12, 'jsd', 'sdsd', 'sdsd', '132.00', 'wdwd', 'sd', 'nota', 0, 0, '2018-05-12 08:28:08', '2018-05-12 08:28:08', 9, 2),
(13, 'jsd', 'sdsd', 'sdsd', '132.00', 'wdwd', 'sd', 'nota', 0, 0, '2018-05-12 08:28:26', '2018-05-12 08:28:26', 9, 2),
(14, 'jsd', 'sdsd', 'sdsd', '132.00', 'wdwd', 'sd', 'nota', 0, 0, '2018-05-12 08:29:18', '2018-05-12 08:29:18', 12, NULL),
(15, 'jsd', 'sdsd', 'sdsd', '132.00', 'wdwd', 'sd', 'nota', 0, 0, '2018-05-12 08:39:26', '2018-05-12 08:39:26', 12, NULL),
(16, '54', 'producto', 'desco', '5684.00', '321534', 'otra descri', '', 100, 10, '2018-05-17 21:43:55', '2018-06-20 22:14:58', 10, 2),
(19, 'Producto Test', 'Produc Test', 'MAC', '100.00', 'ABCDEF12345', 'Descripción xd', 'nota xd', 1000, 10, '2018-07-16 21:59:57', '2018-07-16 21:59:57', 9, 1),
(20, 'Producto Test', 'Produc Test', 'MAC', '100.00', 'ABCDEF12345', 'Descripción xd', 'nota xd', 1000, 10, '2018-07-16 22:00:12', '2018-07-16 22:00:12', 9, 1),
(21, '12', 'Cuaderno', 'Scribe', '100.00', '123123123', 'cuaderno', '', 1, 1, '2018-09-07 02:03:07', '2018-09-07 02:03:46', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'proyecto test', 'test test xd', '2018-04-03 19:27:07', '2018-04-03 19:27:07'),
(2, 'proyecto para pruebas', 'aquí va la descripción ', '2018-06-18 19:59:00', '2018-06-18 19:59:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `state_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`id`, `name`, `email`, `address`, `city`, `zip_code`, `phone`, `contact_email`, `contact_phone`, `contact`, `website`, `notes`, `state_id`, `created_at`, `updated_at`) VALUES
(9, 'proveedor prueba ', '', '5', 'sa', '65195', '3111020334', 'prueba@nuvem.com', '3111020334', 'contacto prueba ', 'ceibas.com', '', 2, '2018-01-18 00:46:59', '2018-01-18 00:49:18'),
(10, 'dania', '', 'a', 'zopapan', '65195', '3111020334', 'a@a.com', '31102033485', 'a', '', '', 1, '2018-01-30 03:11:20', '2018-01-30 03:11:20'),
(12, 'nuevo prove', 'prove@gmail.com', 'hsussh', 'hdjd', '12345', '123457890', 'test@gmail.com', '1234546788', 'trst', 'provee', 'proveedor agregado desde la app', 2, '2018-04-03 22:21:48', '2018-04-03 22:21:48'),
(13, 'proveedor de prueba', 'prueba@proveedor.com', 'avenida nueva 1233', 'zapopan', '405234', '1234567980', 'test@test.com', '1234567890', 'test', '', 'proveedor para realizar pruebas', 1, '2018-04-13 20:19:43', '2018-04-13 20:21:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `quotation_file` text COLLATE utf8_unicode_ci NOT NULL,
  `authorization` int(11) NOT NULL COMMENT '0 = pendiente, 1 = si 2= no',
  `comments` text COLLATE utf8_unicode_ci,
  `authorization_file` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `incident_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `quotations`
--

INSERT INTO `quotations` (`id`, `name`, `description`, `quotation_file`, `authorization`, `comments`, `authorization_file`, `created_at`, `updated_at`, `incident_id`) VALUES
(5, 'cotización de prueba', 'pruebas al modulo de cotización ', '/images/quotations/2459186877.png', 1, '', NULL, '2018-06-19 16:09:51', '2018-06-19 21:52:11', 4),
(6, 'cotización de prueba 2', 'test test test ', '/images/quotations/2478693257.xls', 0, NULL, NULL, '2018-06-19 16:13:06', '2018-06-19 16:13:06', 4),
(7, 'otra cotización ', 'no se ', '/images/quotations/3876463559.PNG', 0, NULL, NULL, '2018-06-19 20:06:04', '2018-06-19 20:06:04', 5),
(8, 'Remplazo de rodillo', 'Se requiere un nuevo rodillo\r\n\r\n*Cotización en dólares', '/images/quotations/2433423787.png', 0, NULL, NULL, '2018-07-20 22:05:34', '2018-07-20 22:11:21', 8),
(9, 'Remplazo de rodillo y cabezal', 'adpoawdpo', '/images/quotations/2483107813.png', 1, 'Proceder inmediatamente', '/images/quotations/2492130174.png', '2018-07-20 22:13:51', '2018-07-20 22:15:21', 9),
(10, 'Coti rodillo para ZT610', 'Rodillo especial para zebra original zt610', '/images/quotations/8309675113.doc', 1, 'adawdaw', '/images/quotations/8311599030.doc', '2018-10-05 23:44:56', '2018-10-05 23:45:15', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quotation_part`
--

CREATE TABLE `quotation_part` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quotation_id` int(10) UNSIGNED NOT NULL,
  `part_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `quotation_part`
--

INSERT INTO `quotation_part` (`id`, `price`, `created_at`, `updated_at`, `quotation_id`, `part_id`) VALUES
(1, 500.00, NULL, NULL, 7, 1),
(2, 500.00, NULL, NULL, 8, 6),
(3, 100.00, NULL, NULL, 9, 6),
(4, 200.00, NULL, NULL, 9, 7),
(5, 500.00, NULL, NULL, 10, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranges`
--

CREATE TABLE `ranges` (
  `id` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `suffix` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ranges`
--

INSERT INTO `ranges` (`id`, `prefix`, `suffix`, `created_at`, `updated_at`) VALUES
(1, 'EEO00', 'XX', '2018-03-12 22:47:52', '2018-03-12 22:47:52'),
(2, 'NO', 'VA', '2018-03-17 01:28:50', '2018-03-17 01:28:50'),
(3, 'a', 'f', '2018-03-21 04:23:50', '2018-03-21 04:23:50'),
(4, 'x', 'd', '2018-03-21 04:24:50', '2018-03-21 04:24:50'),
(5, 'prue', 'bas', '2018-06-20 21:43:22', '2018-06-20 21:43:22'),
(6, 'EEO', '-', '2018-08-22 21:48:40', '2018-08-22 21:48:40'),
(7, 'EE', '1', '2018-08-22 21:49:13', '2018-08-22 21:49:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptions`
--

CREATE TABLE `receptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `purchase_order` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `bill` int(11) NOT NULL,
  `notes` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `responsable_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `receptions`
--

INSERT INTO `receptions` (`id`, `date`, `time`, `purchase_order`, `bill`, `notes`, `created_at`, `updated_at`, `location_for_products_id`, `provider_id`, `responsable_id`) VALUES
(1, '2018-06-01', '10:50:00', 'yjhy', 23, 'sd', '2018-06-22 00:05:33', '2018-06-22 00:05:33', 2, 9, 1),
(2, '2018-06-01', '05:25:00', 'nuas', 122, 'dsd', '2018-06-22 00:07:11', '2018-06-22 00:07:11', 3, 13, 1),
(3, '2018-06-01', '11:55:00', '23233', 32, 'asd', '2018-06-22 00:07:50', '2018-06-22 00:07:50', 2, 12, 1),
(4, '2018-06-01', '10:50:00', '23', 12, 'eee', '2018-06-22 00:08:35', '2018-06-22 00:08:35', 2, 10, 1),
(5, '2018-06-01', '15:50:00', '787985412', 789, 'edrftyg', '2018-06-25 22:09:27', '2018-06-25 22:09:27', 3, 9, 1),
(6, '2018-07-01', '11:55:00', '10012', 1212, 'sss', '2018-07-16 21:54:11', '2018-07-16 21:54:11', 2, 10, 1),
(7, '2018-07-01', '18:55:00', 'dd', 21, 'h', '2018-07-16 21:56:51', '2018-07-16 21:56:51', 1, 9, 1),
(8, '2018-12-01', '00:05:00', '1899-12-31 00:05', 3, '323', '2018-07-16 21:57:58', '2018-07-16 21:57:58', 2, 10, 1),
(9, '2018-07-01', '13:25:00', 'ABC', 123, 'NOTA', '2018-07-16 22:01:14', '2018-07-16 22:01:14', 1, 9, 1),
(10, '2018-07-01', '15:35:00', '789', 123456, 'ninguna', '2018-07-19 00:37:57', '2018-07-19 00:37:57', 1, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reception_products`
--

CREATE TABLE `reception_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reception_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reception_products`
--

INSERT INTO `reception_products` (`id`, `cost`, `amount`, `created_at`, `updated_at`, `reception_id`, `product_id`) VALUES
(1, '23.00', 23, '2018-06-22 00:05:33', '2018-06-22 00:05:33', 1, 8),
(2, '100.00', 3000, '2018-06-22 00:07:11', '2018-06-22 00:07:11', 2, 16),
(3, '23.00', 23, '2018-06-22 00:07:11', '2018-06-22 00:07:11', 2, 5),
(4, '22.00', 1000, '2018-06-22 00:07:50', '2018-06-22 00:07:50', 3, 13),
(5, '33.00', 500, '2018-06-22 00:07:50', '2018-06-22 00:07:50', 3, 11),
(6, '213.00', 32, '2018-06-22 00:08:35', '2018-06-22 00:08:35', 4, 9),
(7, '1123.00', 33, '2018-06-22 00:08:35', '2018-06-22 00:08:35', 4, 16),
(8, '100.00', 1000, '2018-06-22 00:08:35', '2018-06-22 00:08:35', 4, 6),
(9, '15.00', 10, '2018-06-25 22:09:27', '2018-06-25 22:09:27', 5, 3),
(10, '100.00', 2500, '2018-07-16 21:54:11', '2018-07-16 21:54:11', 6, 3),
(11, '123.00', 100, '2018-07-16 21:56:51', '2018-07-16 21:56:51', 7, 3),
(12, '6.00', 11, '2018-07-16 21:57:58', '2018-07-16 21:57:58', 8, 3),
(13, '100.00', 123, '2018-07-16 22:01:14', '2018-07-16 22:01:14', 9, 20),
(14, '100.00', 20, '2018-07-19 00:37:57', '2018-07-19 00:37:57', 10, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `operation` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = assets\n1 = locations\n2 = persons',
  `catalogue_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `records_service`
--

CREATE TABLE `records_service` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `asset_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `person_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `technical_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operation_type` int(11) NOT NULL COMMENT '0 = Creacion de incidencia\n1 = Atendida\n2 = En progreso \n3 = Cotización rechazada\n4 = Cotización cancelada',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `returns`
--

CREATE TABLE `returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `sale_order` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customers_id` int(10) UNSIGNED NOT NULL,
  `responsable_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `returns`
--

INSERT INTO `returns` (`id`, `date`, `time`, `sale_order`, `notes`, `created_at`, `updated_at`, `customers_id`, `responsable_id`) VALUES
(1, '2018-04-01', '18:20:00', '123', 'regresar', '2018-04-13 21:22:17', '2018-04-13 21:22:17', 6, 1),
(2, '2018-06-01', '11:55:00', '123', 'uooj', '2018-06-20 22:37:57', '2018-06-20 22:37:57', 2, 1),
(3, '2018-07-01', '11:50:00', 'zsas', 'asas', '2018-07-16 21:51:43', '2018-07-16 21:51:43', 1, 1),
(4, '2018-07-01', '09:55:00', 'sdsd', 'dsd', '2018-07-16 21:53:07', '2018-07-16 21:53:07', 3, 1),
(5, '2018-07-01', '17:55:00', '324', '23', '2018-07-16 21:54:34', '2018-07-16 21:54:34', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `return_details`
--

CREATE TABLE `return_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `return_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `return_details`
--

INSERT INTO `return_details` (`id`, `amount`, `created_at`, `updated_at`, `return_id`, `product_id`, `location_for_products_id`) VALUES
(1, 5, '2018-04-13 21:22:17', '2018-04-13 21:22:17', 1, 11, 3),
(2, 2, '2018-06-20 22:37:57', '2018-06-20 22:37:57', 2, 3, 3),
(3, 5, '2018-06-20 22:37:57', '2018-06-20 22:37:57', 2, 3, 3),
(4, 9, '2018-07-16 21:51:43', '2018-07-16 21:51:43', 3, 3, 2),
(5, 100, '2018-07-16 21:53:07', '2018-07-16 21:53:07', 4, 5, 3),
(6, 10, '2018-07-16 21:54:34', '2018-07-16 21:54:34', 5, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, NULL, NULL),
(2, 'tecnico', 'Técnico', NULL, NULL, NULL),
(3, 'cliente', 'Cliente', NULL, NULL, NULL),
(4, 'persona', 'Persona', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 6, '2018-06-19 05:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `sale_order` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `responsable_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `location_for_products_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_order`
--

CREATE TABLE `service_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `type` int(11) NOT NULL COMMENT '0 = incidencia, 1 = mantenimiento',
  `status` int(11) NOT NULL COMMENT '0 - Pendiente, 1 - Atendido',
  `signature` text COLLATE utf8_unicode_ci,
  `resolution_date` date DEFAULT NULL,
  `resolution_time` time DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'Usuario con rol tecnico',
  `person_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `service_order`
--

INSERT INTO `service_order` (`id`, `folio`, `date`, `time`, `notes`, `type`, `status`, `signature`, `resolution_date`, `resolution_time`, `comments`, `created_at`, `updated_at`, `type_id`, `user_id`, `person_id`) VALUES
(1, 'EEO-5', '2018-06-28', '06:14:00', 'orden de servicio', 0, 0, NULL, NULL, NULL, NULL, '2018-06-19 15:23:47', '2018-06-19 15:23:47', 5, 6, NULL),
(2, 'EEOM-1', '2018-06-21', '15:10:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-06-19 15:25:49', '2018-06-19 15:25:49', 6, 6, NULL),
(3, 'EEOM-3', '2018-06-29', '08:15:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-06-19 20:00:30', '2018-06-19 20:00:30', 7, 6, NULL),
(4, 'EEOM-4', '2018-06-28', '05:15:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-06-19 20:03:13', '2018-06-19 20:03:13', 4, 6, NULL),
(5, 'EEOM-5', '2018-06-28', '19:10:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-06-20 20:50:24', '2018-06-20 20:50:24', 5, 6, NULL),
(6, 'EEOM-6', '2018-06-26', '12:11:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-06-20 22:16:48', '2018-06-20 22:16:48', 10, 6, NULL),
(7, 'EEOM-7', '2018-07-26', '11:16:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-06-21 17:32:41', '2018-07-20 22:26:44', 11, 6, NULL),
(8, 'EEO-8', '2018-06-22', '01:00:00', 'Llevar un rodillo nuevo', 0, 0, NULL, NULL, NULL, NULL, '2018-06-25 18:25:21', '2018-06-25 18:25:21', 8, 6, NULL),
(9, 'EEOM-8', '2018-07-26', '03:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 21:50:59', '2018-07-20 22:26:32', 12, 6, NULL),
(10, 'EEOM-10', '2018-07-26', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:25:20', '2018-07-20 22:25:20', 13, 6, NULL),
(11, 'EEOM-11', '2018-07-26', '01:01:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:25:56', '2018-07-20 22:25:56', 14, 6, NULL),
(12, 'EEOM-12', '2018-07-26', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:26:24', '2018-07-20 22:26:24', 15, 6, NULL),
(13, 'EEOM-13', '2018-07-26', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:27:20', '2018-07-20 22:27:20', 16, 6, NULL),
(14, 'EEOM-14', '2018-07-26', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:27:46', '2018-07-20 22:27:46', 17, 6, NULL),
(15, 'EEOM-15', '2018-07-26', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:28:00', '2018-07-20 22:28:00', 18, 6, NULL),
(16, 'EEOM-16', '2018-07-26', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-07-20 22:28:21', '2018-07-20 22:28:21', 19, 6, NULL),
(17, 'EEO-10', '2018-10-19', '03:00:00', 'notas', 0, 0, NULL, NULL, NULL, NULL, '2018-10-05 23:43:05', '2018-10-05 23:43:05', 10, 6, NULL),
(18, 'EEOM-17', '2018-10-09', '01:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-10-05 23:55:58', '2018-10-05 23:55:58', 23, 6, NULL),
(19, 'EEOM-19', '2018-10-06', '16:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-10-05 23:56:51', '2018-10-05 23:56:51', 24, 6, NULL),
(20, 'EEOM-20', '2018-10-10', '06:00:00', NULL, 1, 0, NULL, NULL, NULL, NULL, '2018-10-05 23:58:58', '2018-10-05 23:58:58', 25, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Guadalajara', 1),
(2, 'Sonora', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'subcategoria3', NULL, NULL, 1),
(2, 'subcategoria 2', NULL, NULL, 1),
(3, 'sub-categoría 1', '2018-01-17 23:45:55', '2018-01-17 23:45:55', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories_for_products`
--

CREATE TABLE `subcategories_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `childs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_for_products_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories_for_products`
--

INSERT INTO `subcategories_for_products` (`id`, `name`, `parent_id`, `childs`, `created_at`, `updated_at`, `category_for_products_id`) VALUES
(2, 'subcaterogia', NULL, '.3', '2018-06-22 04:03:21', '2018-09-07 02:04:51', 1),
(3, 'subcategoria 1', 2, NULL, '2018-09-07 02:04:51', '2018-09-07 02:05:02', 1),
(4, 'subcategoria 3-1', NULL, '.5', '2018-09-07 02:39:41', '2018-09-07 02:39:54', 3),
(5, 'subcategoria 3-1-1', 4, '.6', '2018-09-07 02:39:54', '2018-09-07 02:40:52', 3),
(6, 'subcategoria 3-1-1-1', 5, '.7', '2018-09-07 02:40:52', '2018-09-07 02:41:11', 3),
(7, 'subcat 3-1-1-1-1', 6, '.8', '2018-09-07 02:41:11', '2018-09-07 02:41:28', 3),
(8, 'subcat 3-1-1-1-1-1', 7, NULL, '2018-09-07 02:41:28', '2018-09-07 02:41:28', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories_products`
--

CREATE TABLE `subcategories_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subcategory_for_products_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories_products`
--

INSERT INTO `subcategories_products` (`id`, `created_at`, `updated_at`, `subcategory_for_products_id`, `product_id`) VALUES
(1, '2018-06-22 04:03:38', '2018-06-22 04:03:38', 2, 3),
(2, '2018-07-16 21:56:10', '2018-07-16 21:56:10', 2, 3),
(3, '2018-07-16 21:59:57', '2018-07-16 21:59:57', 2, 19),
(4, '2018-07-16 22:00:12', '2018-07-16 22:00:12', 2, 20),
(5, '2018-07-16 22:54:14', '2018-07-16 22:54:14', 2, 5),
(6, '2018-07-16 23:01:51', '2018-07-16 23:01:51', 2, 9),
(7, '2018-09-07 02:03:07', '2018-09-07 02:03:07', 2, 21),
(8, '2018-09-07 02:03:46', '2018-09-07 02:03:46', 2, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers`
--

CREATE TABLE `transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_arrive_id` int(10) UNSIGNED NOT NULL,
  `location_departure_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transfers`
--

INSERT INTO `transfers` (`id`, `folio`, `date`, `time`, `comment`, `location_arrive_id`, `location_departure_id`, `created_at`, `updated_at`) VALUES
(1, 'MOV-1', '2018-03-01', '17:30:00', 'xd', 3, 1, '2018-03-21 04:02:30', '2018-03-21 04:02:30'),
(2, 'MOV-2', '2018-05-01', '19:20:00', 'prueba de mover', 8, 1, '2018-05-03 20:06:50', '2018-05-03 20:06:50'),
(3, 'MOV-3', '2018-05-01', '15:45:00', 'szc', 6, 3, '2018-05-03 20:23:12', '2018-05-03 20:23:12'),
(4, 'MOV-4', '2018-06-01', '17:30:00', 'movimiento de descripción1 a ubicación final  ', 10, 1, '2018-06-20 21:24:46', '2018-06-20 21:24:46'),
(5, 'MOV-5', '2018-08-01', '10:50:00', 'awd', 5, 3, '2018-08-22 20:43:58', '2018-08-22 20:43:58'),
(6, 'MOV-6', '2018-08-01', '11:55:00', 'prestada a juan', 11, 12, '2018-08-22 21:41:37', '2018-08-22 21:41:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers_details`
--

CREATE TABLE `transfers_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transfer_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transfers_details`
--

INSERT INTO `transfers_details` (`id`, `created_at`, `updated_at`, `transfer_id`, `asset_id`) VALUES
(1, '2018-03-21 04:02:30', '2018-03-21 04:02:30', 1, 5),
(2, '2018-05-03 20:06:50', '2018-05-03 20:06:50', 2, 1),
(3, '2018-05-03 20:23:12', '2018-05-03 20:23:12', 3, 8),
(4, '2018-06-20 21:24:46', '2018-06-20 21:24:46', 4, 21),
(5, '2018-08-22 20:43:58', '2018-08-22 20:43:58', 5, 30),
(6, '2018-08-22 21:41:37', '2018-08-22 21:41:37', 6, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers_for_products`
--

CREATE TABLE `transfers_for_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_arrive_id` int(10) UNSIGNED NOT NULL,
  `location_departure_id` int(10) UNSIGNED NOT NULL,
  `responsable_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transfers_for_products`
--

INSERT INTO `transfers_for_products` (`id`, `date`, `time`, `notes`, `created_at`, `updated_at`, `location_arrive_id`, `location_departure_id`, `responsable_id`) VALUES
(1, '2018-03-01', '21:55:00', 'es una prueba ', '2018-03-23 04:51:45', '2018-03-23 04:51:45', 1, 1, 1),
(2, '2018-04-01', '17:50:00', 'no se ', '2018-04-13 03:49:32', '2018-04-13 03:49:32', 3, 1, 1),
(3, '2018-05-01', '15:55:00', 'dsfd', '2018-05-03 21:53:52', '2018-05-03 21:53:52', 2, 1, 1),
(4, '2018-06-01', '18:50:00', 'movimiento ciudadano ', '2018-06-20 22:33:39', '2018-06-20 22:33:39', 3, 1, 1),
(5, '2018-07-01', '11:55:00', 'df', '2018-07-16 21:57:18', '2018-07-16 21:57:18', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers_for_products_details`
--

CREATE TABLE `transfers_for_products_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `transfer_for_products_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transfers_for_products_details`
--

INSERT INTO `transfers_for_products_details` (`id`, `amount`, `transfer_for_products_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 30, 1, 3, '2018-03-23 04:51:45', '2018-03-23 04:51:45'),
(2, -3, 2, 11, '2018-04-13 03:49:32', '2018-04-13 03:49:32'),
(3, -4, 3, 3, '2018-05-03 21:53:52', '2018-05-03 21:53:52'),
(4, 10, 4, 3, '2018-06-20 22:33:40', '2018-06-20 22:33:40'),
(5, 5, 4, 5, '2018-06-20 22:33:40', '2018-06-20 22:33:40'),
(6, 10, 5, 3, '2018-07-16 21:57:18', '2018-07-16 21:57:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `used_ranges`
--

CREATE TABLE `used_ranges` (
  `id` int(10) UNSIGNED NOT NULL,
  `folio` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `range_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `used_ranges`
--

INSERT INTO `used_ranges` (`id`, `folio`, `created_at`, `updated_at`, `range_id`) VALUES
(1, 'BAR-1', '2018-03-12 22:47:52', '2018-03-12 22:47:52', 1),
(2, 'BAR-2', '2018-03-17 01:28:50', '2018-03-17 01:28:50', 2),
(3, 'BAR-3', '2018-03-21 04:23:50', '2018-03-21 04:23:50', 3),
(4, 'BAR-4', '2018-03-21 04:24:50', '2018-03-21 04:24:50', 4),
(5, 'BAR-5', '2018-06-20 21:43:22', '2018-06-20 21:43:22', 5),
(6, 'BAR-6', '2018-08-22 21:48:40', '2018-08-22 21:48:40', 6),
(7, 'BAR-7', '2018-08-22 21:49:13', '2018-08-22 21:49:13', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_central` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `address`, `is_central`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 'Admin', '$2y$10$RPMG6TT.d3eHFHhyRaf9seovfu2cdZwzVTmXKQ2UeQuNj51l/AzXG', 'admin@admin.com', '', 0, 'aaNe1MaY9zlp1DARbDxRz2nOGn00afpx3kDNjGpjAF7bwM2e97jsOLF9pcKS', NULL, '2018-10-17 17:26:53'),
(2, '', 'amadrigal', '$2y$10$4AvhTWw4QOPqhzvxD60ceeP2p7FWUpmXYkPZX7Sd2AmCblcgGOC0i', 'antoniomadrigal@messoft.com', '', 0, '1CExbunXHNjIzHGHJMAm8pf7iLTStqOgTmbhI2lDMnbre2GiC9PwwO1erv1k', NULL, '2017-11-10 10:20:47'),
(3, 'test', '', '$2y$10$4z6.uElmipdsS2Z3yYyidODHnqg.WWCCbQf0jn/Z1mjRZxtBakV5i', 'test@pruebas.com', '', 0, NULL, '2018-06-18 22:33:23', '2018-06-18 22:33:23'),
(6, 'Juan Perez', 'jp', '$2y$10$RPMG6TT.d3eHFHhyRaf9seovfu2cdZwzVTmXKQ2UeQuNj51l/AzXG', 'jp@gmail.com', 'Federalismo 33', 1, NULL, '2018-06-19 05:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_customers`
--

CREATE TABLE `users_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alerts_configuration`
--
ALTER TABLE `alerts_configuration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alerts_configuration_persons1_idx` (`person_id`);

--
-- Indices de la tabla `alerts_inactivity`
--
ALTER TABLE `alerts_inactivity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alerts_inactivity_persons1_idx` (`person_id`);

--
-- Indices de la tabla `alerts_max_min`
--
ALTER TABLE `alerts_max_min`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alerts_max_min_persons1_idx` (`person_id`);

--
-- Indices de la tabla `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assets_persons1_idx` (`person_id`),
  ADD KEY `fk_assets_providers1_idx` (`provider_id`),
  ADD KEY `fk_assets_subcategories1_idx` (`subcategory_id`),
  ADD KEY `fk_assets_customers1_idx` (`customer_id`),
  ADD KEY `fk_assets_equipment1_idx` (`equipment_id`),
  ADD KEY `fk_assets_projects1_idx` (`project_id`);

--
-- Indices de la tabla `asset_part_equipment`
--
ALTER TABLE `asset_part_equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asset_part_equipment_parts1_idx` (`part_id`),
  ADD KEY `fk_asset_part_equipment_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `branch_offices`
--
ALTER TABLE `branch_offices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories_for_products`
--
ALTER TABLE `categories_for_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_name_unique` (`name`);

--
-- Indices de la tabla `companies_modules`
--
ALTER TABLE `companies_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_modules_company_id_foreign` (`company_id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `custom_fields_location_for_products`
--
ALTER TABLE `custom_fields_location_for_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_custom_fields_location_for_products_locations_for_produc_idx` (`location_for_products_id`),
  ADD KEY `fk_custom_fields_location_for_products_custom_fields1_idx` (`custom_field_id`);

--
-- Indices de la tabla `custom_fields_products`
--
ALTER TABLE `custom_fields_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_custom_fields_products_products1_idx` (`product_id`),
  ADD KEY `fk_custom_fields_products_custom_fields1_idx` (`custom_field_id`);

--
-- Indices de la tabla `custom_field_assets`
--
ALTER TABLE `custom_field_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_custom_field_assets_custom_fields1_idx` (`custom_field_id`),
  ADD KEY `fk_custom_field_assets_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `custom_field_location`
--
ALTER TABLE `custom_field_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_custom_field_location_custom_fields1_idx` (`custom_field_id`),
  ADD KEY `fk_custom_field_location_locations1_idx` (`location_id`);

--
-- Indices de la tabla `custom_field_person`
--
ALTER TABLE `custom_field_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_custom_field_person_custom_fields1_idx` (`custom_field_id`),
  ADD KEY `fk_custom_field_person_persons1_idx` (`persons_id`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departures_locations1_idx` (`location_id`),
  ADD KEY `fk_departures_persons1_idx` (`person_id`);

--
-- Indices de la tabla `departures_details`
--
ALTER TABLE `departures_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departures_details_departures1_idx` (`departure_id`),
  ADD KEY `fk_departures_details_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `disposures`
--
ALTER TABLE `disposures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disposures_locations1_idx` (`location_id`);

--
-- Indices de la tabla `disposures_details`
--
ALTER TABLE `disposures_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disposures_details_disposures1_idx` (`disposure_id`),
  ADD KEY `fk_disposures_details_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `disposures_for_products_details`
--
ALTER TABLE `disposures_for_products_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disposures_for_products_details_disposure_for_products1_idx` (`disposure_for_products_id`),
  ADD KEY `fk_disposures_for_products_details_products1_idx` (`product_id`);

--
-- Indices de la tabla `disposure_for_products`
--
ALTER TABLE `disposure_for_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disposure_for_products_locations_for_products1_idx` (`location_for_products_id`),
  ADD KEY `fk_disposure_for_products_users1_idx` (`responsable_id`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_locations1_idx` (`location_id`),
  ADD KEY `fk_entries_persons1_idx` (`person_id`);

--
-- Indices de la tabla `entries_details`
--
ALTER TABLE `entries_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entries_details_assets1_idx` (`asset_id`),
  ADD KEY `fk_entries_details_entries1_idx` (`entry_id`);

--
-- Indices de la tabla `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `firmwares`
--
ALTER TABLE `firmwares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_firmwares_assets1_idx` (`assets_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incidents_assets1_idx` (`asset_id`),
  ADD KEY `fk_incidents_persons1_idx` (`person_id`);

--
-- Indices de la tabla `incident_part`
--
ALTER TABLE `incident_part`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_incident_part_parts1_idx` (`part_id`),
  ADD KEY `fk_incident_part_incidents1_idx` (`incident_id`);

--
-- Indices de la tabla `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_locations1_idx` (`location_id`),
  ADD KEY `fk_inventory_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `inventory_for_products`
--
ALTER TABLE `inventory_for_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_for_products_products1_idx` (`product_id`),
  ADD KEY `fk_inventory_for_products_locations_for_products1_idx` (`location_for_products_id`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locations_for_products`
--
ALTER TABLE `locations_for_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_locations_for_products_branch_offices1_idx` (`branch_office_id`);

--
-- Indices de la tabla `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_maintenances_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `measure_units`
--
ALTER TABLE `measure_units`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parts_equipment`
--
ALTER TABLE `parts_equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parts_equipment_parts1_idx` (`part_id`),
  ADD KEY `fk_parts_equipment_equipment1_idx` (`equipment_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_permissions_modules1_idx` (`modules_id`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_permission_role_permissions_idx` (`permission_id`),
  ADD KEY `fk_permission_role_roles1_idx` (`role_id`);

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persons_states1_idx` (`state_id`),
  ADD KEY `fk_persons_departments1_idx` (`department_id`);

--
-- Indices de la tabla `physical_inventory`
--
ALTER TABLE `physical_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_physical_inventory_locations_for_products1_idx` (`location_for_product_id`);

--
-- Indices de la tabla `physical_inventory_history`
--
ALTER TABLE `physical_inventory_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_physical_inventory_history_products1_idx` (`product_id`),
  ADD KEY `fk_physical_inventory_history_physical_inventory1_idx` (`physical_inventory_id`);

--
-- Indices de la tabla `pick_list`
--
ALTER TABLE `pick_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pick_list_detail`
--
ALTER TABLE `pick_list_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pick_list_detail_products1_idx` (`product_id`),
  ADD KEY `fk_pick_list_detail_locations_for_products1_idx` (`location_for_products_id`),
  ADD KEY `fk_pick_list_detail_pick_list1_idx` (`pick_list_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_providers1_idx` (`provider_id`),
  ADD KEY `fk_products_measure_units1_idx` (`measure_unit_id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_providers_states1_idx` (`state_id`);

--
-- Indices de la tabla `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_quotations_incidents1_idx` (`incident_id`);

--
-- Indices de la tabla `quotation_part`
--
ALTER TABLE `quotation_part`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_quotation_part_quotations1_idx` (`quotation_id`),
  ADD KEY `fk_quotation_part_parts1_idx` (`part_id`);

--
-- Indices de la tabla `ranges`
--
ALTER TABLE `ranges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_receptions_locations_for_products1_idx` (`location_for_products_id`),
  ADD KEY `fk_receptions_providers1_idx` (`provider_id`),
  ADD KEY `fk_receptions_users1_idx` (`responsable_id`);

--
-- Indices de la tabla `reception_products`
--
ALTER TABLE `reception_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reception_products_receptions1_idx` (`reception_id`),
  ADD KEY `fk_reception_products_products1_idx` (`product_id`);

--
-- Indices de la tabla `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_records_users1_idx` (`user_id`);

--
-- Indices de la tabla `records_service`
--
ALTER TABLE `records_service`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_returns_customers1_idx` (`customers_id`),
  ADD KEY `fk_returns_users1_idx` (`responsable_id`);

--
-- Indices de la tabla `return_details`
--
ALTER TABLE `return_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_return_details_returns1_idx` (`return_id`),
  ADD KEY `fk_return_details_products1_idx` (`product_id`),
  ADD KEY `fk_return_details_locations_for_products1_idx` (`location_for_products_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_user_roles1_idx` (`role_id`),
  ADD KEY `fk_role_user_users1_idx` (`user_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sales_customers1_idx` (`customer_id`),
  ADD KEY `fk_sales_users1_idx` (`responsable_id`);

--
-- Indices de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sale_details_products1_idx` (`product_id`),
  ADD KEY `fk_sale_details_sales1_idx` (`sale_id`),
  ADD KEY `fk_sale_details_locations_for_products1_idx` (`location_for_products_id`);

--
-- Indices de la tabla `service_order`
--
ALTER TABLE `service_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service_order_users1_idx` (`user_id`),
  ADD KEY `fk_service_order_persons1_idx` (`person_id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_states_countries1_idx` (`country_id`);

--
-- Indices de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategories_categories1_idx` (`category_id`);

--
-- Indices de la tabla `subcategories_for_products`
--
ALTER TABLE `subcategories_for_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategories_for_products_categories_for_products1_idx` (`category_for_products_id`);

--
-- Indices de la tabla `subcategories_products`
--
ALTER TABLE `subcategories_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategories_products_subcategories_for_products1_idx` (`subcategory_for_products_id`),
  ADD KEY `fk_subcategories_products_products1_idx` (`product_id`);

--
-- Indices de la tabla `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transfers_locations1_idx` (`location_arrive_id`),
  ADD KEY `fk_transfers_locations2_idx` (`location_departure_id`);

--
-- Indices de la tabla `transfers_details`
--
ALTER TABLE `transfers_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transfers_details_transfers1_idx` (`transfer_id`),
  ADD KEY `fk_transfers_details_assets1_idx` (`asset_id`);

--
-- Indices de la tabla `transfers_for_products`
--
ALTER TABLE `transfers_for_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transfers_for_products_locations_for_products1_idx` (`location_arrive_id`),
  ADD KEY `fk_transfers_for_products_locations_for_products2_idx` (`location_departure_id`),
  ADD KEY `fk_transfers_for_products_users1_idx` (`responsable_id`);

--
-- Indices de la tabla `transfers_for_products_details`
--
ALTER TABLE `transfers_for_products_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transfers_for_products_details_transfers_for_products1_idx` (`transfer_for_products_id`),
  ADD KEY `fk_transfers_for_products_details_products1_idx` (`product_id`);

--
-- Indices de la tabla `used_ranges`
--
ALTER TABLE `used_ranges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_used_ranges_ranges1_idx` (`range_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `users_customers`
--
ALTER TABLE `users_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_customers_customers1_idx` (`customer_id`),
  ADD KEY `fk_users_customers_users1_idx` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alerts_configuration`
--
ALTER TABLE `alerts_configuration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `alerts_inactivity`
--
ALTER TABLE `alerts_inactivity`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `alerts_max_min`
--
ALTER TABLE `alerts_max_min`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `asset_part_equipment`
--
ALTER TABLE `asset_part_equipment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `branch_offices`
--
ALTER TABLE `branch_offices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `categories_for_products`
--
ALTER TABLE `categories_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `companies_modules`
--
ALTER TABLE `companies_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `custom_fields_location_for_products`
--
ALTER TABLE `custom_fields_location_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `custom_fields_products`
--
ALTER TABLE `custom_fields_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `custom_field_assets`
--
ALTER TABLE `custom_field_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `custom_field_location`
--
ALTER TABLE `custom_field_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `custom_field_person`
--
ALTER TABLE `custom_field_person`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `departures`
--
ALTER TABLE `departures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `departures_details`
--
ALTER TABLE `departures_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `disposures`
--
ALTER TABLE `disposures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `disposures_details`
--
ALTER TABLE `disposures_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `disposures_for_products_details`
--
ALTER TABLE `disposures_for_products_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `disposure_for_products`
--
ALTER TABLE `disposure_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `entries_details`
--
ALTER TABLE `entries_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `firmwares`
--
ALTER TABLE `firmwares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT de la tabla `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `incident_part`
--
ALTER TABLE `incident_part`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `inventory_for_products`
--
ALTER TABLE `inventory_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `locations_for_products`
--
ALTER TABLE `locations_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `measure_units`
--
ALTER TABLE `measure_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `parts_equipment`
--
ALTER TABLE `parts_equipment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `physical_inventory`
--
ALTER TABLE `physical_inventory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `physical_inventory_history`
--
ALTER TABLE `physical_inventory_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pick_list`
--
ALTER TABLE `pick_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pick_list_detail`
--
ALTER TABLE `pick_list_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `quotation_part`
--
ALTER TABLE `quotation_part`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ranges`
--
ALTER TABLE `ranges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `reception_products`
--
ALTER TABLE `reception_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `records_service`
--
ALTER TABLE `records_service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `return_details`
--
ALTER TABLE `return_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `service_order`
--
ALTER TABLE `service_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `subcategories_for_products`
--
ALTER TABLE `subcategories_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `subcategories_products`
--
ALTER TABLE `subcategories_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `transfers_details`
--
ALTER TABLE `transfers_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `transfers_for_products`
--
ALTER TABLE `transfers_for_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `transfers_for_products_details`
--
ALTER TABLE `transfers_for_products_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `used_ranges`
--
ALTER TABLE `used_ranges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `users_customers`
--
ALTER TABLE `users_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alerts_configuration`
--
ALTER TABLE `alerts_configuration`
  ADD CONSTRAINT `fk_alerts_configuration_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alerts_inactivity`
--
ALTER TABLE `alerts_inactivity`
  ADD CONSTRAINT `fk_alerts_inactivity_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alerts_max_min`
--
ALTER TABLE `alerts_max_min`
  ADD CONSTRAINT `fk_alerts_max_min_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `companies_modules`
--
ALTER TABLE `companies_modules`
  ADD CONSTRAINT `companies_modules_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
