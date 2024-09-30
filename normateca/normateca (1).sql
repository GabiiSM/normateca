-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 02:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `normateca`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(5) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Last_name` varchar(25) NOT NULL,
  `Cuerpo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Name`, `Email`, `Password`, `Last_name`, `Cuerpo`) VALUES
(1, 'Yadiel', 'yadiel@gmail.com', '$2y$10$8kSzFGnCjMJLr.xLMLPXE.aMGC80YQJjaLLIzYpJB96Ixqt8/ylDC', 'Cruzado', 'JA'),
(3, 'gaby', 'gaby@gmail.com', '$2y$10$h5yjBj8jnpG.g31tpGlVP.h4IHbIVjVCfHmF2SVKOilJh5c19lIG.', 'gay', 'JA'),
(4, 'aaa', 'aaa@gmail.com', '$2y$10$3U85EwGc385QeNkpL05Jr.7fqvUHiEsGWVHoTOGjhZSOr03r18h/O', 'aaa', 'OPEI');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_abbr` varchar(3) NOT NULL,
  `Category_name` varchar(25) NOT NULL,
  `Cuerpo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_abbr`, `Category_name`, `Cuerpo`) VALUES
('ACT', 'Actas', 'JA'),
('ACU', 'Acuerdos', 'JA'),
('APR', 'Aprobaciones', 'JA'),
('CA', 'Calendario Academico', 'JA'),
('CC', 'Cartas Circulares', 'FI'),
('CER', 'Certificaciones', 'JA'),
('CON', 'Consideraciones', 'JA'),
('LYR', 'Leyes y Reglamentos', 'JG'),
('POL', 'Políticas', 'JA'),
('SOL', 'Solicitudes', 'JA');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `Document_id` int(5) NOT NULL,
  `Keyword_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`Document_id`, `Keyword_id`) VALUES
(24, 1),
(106, 2),
(106, 3),
(106, 5),
(106, 9),
(106, 10),
(106, 12),
(106, 13),
(107, 2),
(107, 3),
(107, 5),
(107, 9),
(107, 10),
(107, 12),
(107, 13),
(108, 12),
(108, 13),
(108, 15),
(108, 16),
(109, 3),
(109, 4),
(109, 5),
(109, 9);

-- --------------------------------------------------------

--
-- Table structure for table `cuerpos`
--

CREATE TABLE `cuerpos` (
  `Cuerpo_abbr` varchar(4) NOT NULL,
  `Cuerpo_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuerpos`
--

INSERT INTO `cuerpos` (`Cuerpo_abbr`, `Cuerpo_name`) VALUES
('FI', 'Oficina de Finanzas'),
('JA', 'Junta Administrativa'),
('JG', 'Junta de gobierno'),
('OPEI', 'Oficina de planificaciones'),
('pru', 'prueba1'),
('SA', 'Senado Académico');

-- --------------------------------------------------------

--
-- Table structure for table `derroga`
--

CREATE TABLE `derroga` (
  `Document_id` varchar(25) NOT NULL,
  `Target_id` varchar(25) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `derroga`
--

INSERT INTO `derroga` (`Document_id`, `Target_id`, `Date`) VALUES
('27', '36', '2024-04-19 22:27:13'),
('27', '34', '2024-04-24 00:14:34'),
('109', '106', '2024-05-13 19:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `Document_id` int(5) NOT NULL,
  `Document_title` varchar(100) NOT NULL,
  `Cuerpo_abbr` varchar(4) NOT NULL,
  `Category_abbr` varchar(3) NOT NULL,
  `Certification_number` varchar(3) NOT NULL,
  `Fiscal_year` varchar(20) NOT NULL,
  `Document_lenguaje` varchar(3) NOT NULL,
  `Document_path` varchar(200) NOT NULL,
  `Date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Document_state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`Document_id`, `Document_title`, `Cuerpo_abbr`, `Category_abbr`, `Certification_number`, `Fiscal_year`, `Document_lenguaje`, `Document_path`, `Date_created`, `Document_state`) VALUES
(27, 'primer test', 'JA', 'ACU', '20', '2013-2014', 'ESP', '../files/2015-2016-46 enm diagrama org 2019.pdf', '2024-05-13 19:04:19', 1),
(28, '2015-2016-46 enm diagrama org 2019', 'JA', 'CER', '46', '2015-2016', 'ESP', '../files/2015-2016-46 enm diagrama org 2019.pdf', '2024-04-23 01:16:23', 1),
(29, 'Certificacion numero_2014-2015-03 presupuesto', 'JA', 'CER', '03', '2014-2015', 'ESP', '../files/2014-2015-03 presupuesto.pdf', '2024-04-23 01:16:23', 1),
(30, 'Certificacion numero 2013-14-09', 'JA', 'CER', '09', '2013-2014', 'ESP', '../files/2013-2014-09_principios_y_componentes_analisis_de_riesgo.pdf', '2024-04-23 01:16:23', 1),
(31, '2023-2024-03 presupuesto 2023-2024', 'JA', 'CER', '03', '2023-2024', 'ESP', '../files/2023-2024-03 presupuesto 2023-2024.pdf', '2024-04-23 01:16:23', 1),
(32, 'Certificacion numero_2021-2022-03', 'JA', 'CER', '03', '2021-2022', 'ESP', '../files/2021-2022-03 ca ja ascensos permanencias y otros.pdf', '2024-04-23 01:16:23', 1),
(33, '2020-2021-02 presupuesto 2020-2021', 'JA', 'CER', '02', '2020-2021', 'ESP', '../files/2020-2021-02 presupuesto 2020-2021.pdf', '2024-04-23 01:16:23', 1),
(34, 'Certificacion numero 2009-10-06', 'JA', 'CER', '06', '2009-2010', 'ESP', '../files/cert.num.2009-10-06-ja.pdf', '2024-04-23 01:16:23', 1),
(35, '2019-2020-01 presupuesto 19-20', 'JA', 'CER', '01', '2019-2020', 'ESP', '../files/2019-2020-01 presupuesto 19-20.pdf', '2024-04-23 01:16:23', 1),
(36, '2017-2018-03 presupuesto', 'JA', 'CER', '03', '2017-2018', 'ESP', '../files/2017-2018-03 presupuesto.pdf ', '2024-04-23 01:16:23', 1),
(37, 'Certificacion numero 2022-2023-20', 'SA', 'CER', '20', '2022-2023', 'ESP', '../files/certificacin nmero 2022-2023-20-rev.pdf', '2024-04-23 01:16:23', 1),
(38, 'Certificacion numero 2016-2017-1', 'SA', 'CER', '1', '2016-2017', 'ESP', '../files/cert. nm. 2016-17-1.pdf', '2024-04-23 01:16:23', 1),
(39, 'Certificacion numero 1998-99-02-enmendada', 'SA', 'CER', '02', '1998-1999', 'ESP', '../files/cert.num.1998-99-02-enmendada.pdf', '2024-04-23 01:16:23', 1),
(40, 'Certificacion numero 2022-2023-10', 'SA', 'CER', '10', '2022-2023', 'ESP', '../files/certificacin nmero 2022-2023-10.doc.pdf', '2024-04-23 01:16:23', 1),
(41, 'certificacion numero 2021-2022-1', 'SA', 'CER', '1', '2021-2022', 'ESP', '../files/certificacin nmero 2021-2022-1.pdf', '2024-04-23 01:16:23', 1),
(42, 'Certificacion numero 2021-2022-16 propuesta', 'SA', 'CER', '16', '2021-2022', 'ESP', '../files/certificacin nmero 2021-2022-4 propuesta.pdf', '2024-04-23 01:16:23', 1),
(43, 'Certificacion numero 2016-17-2', 'SA', 'CER', '2', '2016-2017', 'ESP', '../files/cert. nm. 2016-17-2.pdf ', '2024-04-23 01:16:23', 1),
(44, 'Certificacion numero 2016-17-3', 'SA', 'CER', '3', '2016-2017', 'ESP', '../files/cert. nm. 2016-17-3.pdf', '2024-04-23 01:16:23', 1),
(45, 'Certificacion numero 2015-2016-1', 'SA', 'CER', '1', '2015-2016', 'ESP', '../files/cert.nm.15-16-1sa-upra.pdf', '2024-04-23 01:16:23', 1),
(46, 'Certificacion numero 2015-2016-2', 'SA', 'CER', '2', '2015-2016', 'ESP', '../files/cert.nm.15-16-2sa-upra.pdf', '2024-04-23 01:16:23', 1),
(47, 'Circular-Finanzas-04-30', 'FI', 'CC', '30', '2003-2004', 'ESP', '../files/Circular-Finanzas-04-30.pdf', '2024-04-23 01:16:23', 1),
(48, 'Circular-Finanzas-11-13', 'FI', 'CC', '13', '2010-2011', 'ESP', '../files/Circular-Finanzas-11-13.pdf', '2024-04-23 01:16:23', 1),
(49, 'Circular-Finanzas-01-19', 'FI', 'CC', '19', '2000-2001', 'ESP', '../files/Circular-Finanzas-01-19.pdf', '2024-04-23 01:16:23', 1),
(50, 'Circular-Finanzas-07-02', 'FI', 'CC', '02', '2000-2001', 'ESP', '../files/Circular-Finanzas-07-02.pdf', '2024-04-23 01:16:23', 1),
(51, 'Circular-Finanzas-10-05', 'FI', 'CC', '05', '2009-2010', 'ESP', '../files/Circular-Finanzas-10-05.pdf', '2024-04-23 01:16:23', 1),
(52, 'Circular-Finanzas-11-18', 'FI', 'CC', '18', '2011-2012', 'ESP', '../files/Circular-Finanzas-11-18.pdf', '2024-04-23 01:16:23', 1),
(53, 'Circular-Finanzas-12-02', 'FI', 'CC', '02', '2011-2012', 'ESP', '../files/Circular-Finanzas-12-02.pdf', '2024-04-23 01:16:23', 1),
(54, 'Circular-Finanzas-11-15', 'FI', 'CC', '15', '2011-2012', 'ESP', '../files/Circular-Finanzas-11-15.pdf', '2024-04-23 01:16:23', 1),
(55, 'Circular-Finanzas-11-16', 'FI', 'CC', '16', '2011-2012', 'ESP', '../files/Circular-Finanzas-11-16.pdf', '2024-04-23 01:16:23', 1),
(56, 'Circular-Finanzas-12-04', 'FI', 'CC', '04', '2011-2012', 'ESP', '../files/Circular-Finanzas-12-04.pdf', '2024-04-23 01:16:23', 1),
(57, '160 2014-2015 Reglamento General UPR Enm 15 septiembre 2014', 'JG', 'LYR', '160', '2014-2015', 'ESP', '../files/160 2014-2015 reglamento general upr enm 15 septiembre 2014.pdf', '2024-04-23 01:16:23', 1),
(59, 'Reglamento General de Estudiantes UPR_28_jul_2011', 'JG', 'LYR', '1', '2010-2011', 'ESP', '../files/rge_28_jul_2011.pdf', '2024-04-23 01:16:23', 1),
(60, 'Ley UPR_1-1966_upr_comp', 'JG', 'LYR', '1', '2010-2011', 'ESP', '../files/ley_1-1966_upr_comp.pdf', '2024-04-23 01:16:23', 1),
(61, '2013-2014-13 organigrama', 'JA', 'CER', '13', '2013-2014', 'ESP', '../files/2013-2014-13 organigrama.pdf', '2024-04-23 01:16:23', 1),
(62, 'cert.num.2008-09-63-ja', 'JA', 'CER', '63', '2013-2014', 'ESP', '../files/cert.num.2008-09-63-ja.pdf', '2024-04-23 01:16:23', 1),
(63, 'certificación 2013-2014-13 enmendada', 'JA', 'CER', '13', '2013-2014', 'ESP', '../files/cert. nm. 2013-2014-13 enmendada.pd f', '2024-04-23 01:16:23', 1),
(64, 'certificacion numero 2014-2015-14', 'JG', 'CER', '14', '2014-2015', 'ESP', '../files/certificacion numero 2014-2015-14.pdf', '2023-12-05 04:00:00', 1),
(65, 'certificacion numero 2006-2007-16', 'JG', 'CER', '16', '2006-2007', 'ESP', '../files/certificacion numero 2006-2007-16.pdf', '2023-12-05 04:00:00', 1),
(66, 'certificacion numero 2006-2007-15', 'JG', 'CER', '15', '2006-2007', 'ESP', '../files/certificacion numero 2006-2007-15.pdf', '2023-12-05 04:00:00', 1),
(67, 'certificacion numero 2010-2011-154', 'JG', 'CER', '154', '2010-2011', 'ESP', '../files/certificacion numero 2010-2011-154.pdf', '2023-12-05 04:00:00', 1),
(106, 'test', 'JA', 'APR', '222', '2019-2020', 'ESP', '../files/pago4 matri 2024.pdf', '2024-05-22 04:00:00', 1),
(107, 'test1', 'JA', 'APR', '222', '2019-2020', 'ESP', '../files/pago4 matri 2024.pdf', '2024-05-13 19:02:43', 1),
(108, 'test2', 'JA', 'CER', '132', '2010-2011', 'ESP', '../files/pago3 matri 2024.pdf', '2024-05-13 19:02:51', 0),
(109, 'test3', 'JA', 'CER', '787', '2019-2020', 'ESP', '../files/pago3 matri 2024.pdf', '2024-05-13 19:03:02', 1),
(110, 'gabriel es gay', 'JA', 'CER', '240', '2023-2024', 'ESP', '../files/pago4 matri 2024.pdf', '2024-05-15 00:46:00', 0),
(111, 'gabriel es gay', '', '', '240', '', '', '../files/pago2 matri 2024.pdf', '0000-00-00 00:00:00', 0),
(112, 'gabriel es gay', 'JA', '', '2', '', '', '../files/pago2 matri 2024.pdf', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enmienda`
--

CREATE TABLE `enmienda` (
  `Document_id` varchar(25) NOT NULL,
  `Target_id` varchar(25) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enmienda`
--

INSERT INTO `enmienda` (`Document_id`, `Target_id`, `Date`) VALUES
('27', '63', '2024-04-18 00:05:47'),
('27', '62', '2024-04-24 00:14:00'),
('62', '36', '2024-04-24 00:14:14'),
('106', '107', '2024-05-13 19:04:34'),
('107', '108', '2024-05-13 19:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `Keywords_id` int(5) NOT NULL,
  `Keywords_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`Keywords_id`, `Keywords_name`) VALUES
(1, 'Presupuesto'),
(2, 'Estudiantes'),
(3, 'Reglamentos'),
(4, 'Huelga'),
(5, 'Presidente'),
(6, 'Calendario'),
(7, 'Salario'),
(8, 'Actas'),
(9, 'Becas'),
(10, 'Ayudas'),
(11, 'Docentes'),
(12, 'Catedraticos'),
(13, 'Reunion');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `Tracking_id` int(11) NOT NULL,
  `Admin_id` int(5) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Acction` varchar(50) NOT NULL,
  `Target_id` int(11) NOT NULL,
  `New_Info` varchar(250) NOT NULL,
  `Old_info` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`Tracking_id`, `Admin_id`, `Date`, `Acction`, `Target_id`, `New_Info`, `Old_info`) VALUES
(16, 1, '2024-04-23 23:12:09', 'Insert', 104, '[\"pago\",\"\",\"\",null,null,null,null,null,\"Yadiel Cruzado\",\"../files/pago1 matri 2024.pdf\"]', ''),
(17, 1, '2024-04-23 23:13:14', 'Insert', 105, '{\"file_name\":\"pago\",\"file_date\":\"\",\"file_desc\":\"\",\"file_number\":\"\",\"file_state\":null,\"file_cat\":null,\"file_lang\":null,\"file_year\":null,\"file_corp\":null,\"file_signature\":\"Yadiel Cruzado\",\"file_path\":\"../files/pago1 matri 2024.pdf\"}', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_abbr`),
  ADD KEY `Category` (`Cuerpo`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD KEY `Document_id` (`Document_id`),
  ADD KEY `Keyword_id` (`Keyword_id`);

--
-- Indexes for table `cuerpos`
--
ALTER TABLE `cuerpos`
  ADD PRIMARY KEY (`Cuerpo_abbr`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`Document_id`),
  ADD KEY `Category` (`Cuerpo_abbr`),
  ADD KEY `Subcategory` (`Category_abbr`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`Keywords_id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`Tracking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `Document_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `Keywords_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `Tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
