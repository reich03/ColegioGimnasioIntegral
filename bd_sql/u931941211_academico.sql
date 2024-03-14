-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-03-2024 a las 13:47:30
-- Versión del servidor: 10.6.15-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u931941211_academico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `codarea` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomarea` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`codarea`, `nomarea`) VALUES
('AR001', 'SECUENCIA I'),
('AR002', 'SECUENCIA II'),
('AR003', 'SECUENCIA III'),
('AR004', 'SECUENCIA IV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueocaja`
--

CREATE TABLE `arqueocaja` (
  `codarqueo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `montoinicial` float(12,2) NOT NULL,
  `ingresos` float(12,2) NOT NULL,
  `egresos` float(12,2) NOT NULL,
  `dineroefectivo` float(12,2) NOT NULL,
  `diferencia` float(12,2) NOT NULL,
  `comentarios` text NOT NULL,
  `fechaapertura` datetime NOT NULL,
  `fechacierre` datetime NOT NULL,
  `statusarqueo` int(2) NOT NULL,
  `codperiodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `arqueocaja`
--

INSERT INTO `arqueocaja` (`codarqueo`, `codcaja`, `montoinicial`, `ingresos`, `egresos`, `dineroefectivo`, `diferencia`, `comentarios`, `fechaapertura`, `fechacierre`, `statusarqueo`, `codperiodo`) VALUES
(1, 1, 0.00, 0.00, 0.00, 0.00, 0.00, '', '2019-07-20 09:31:37', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `codasignacion` int(11) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `codturno` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codnivel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codgrado` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codseccion` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codmateria` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codperiodo` int(11) NOT NULL,
  `fechaasignacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`codasignacion`, `coddoc`, `codturno`, `codnivel`, `codgrado`, `codseccion`, `codmateria`, `codperiodo`, `fechaasignacion`) VALUES
(1, 1, 'T001', 'N001', 'G001', 'S001', 'M0004', 1, '2019-07-20'),
(2, 1, 'T001', 'N001', 'G001', 'S001', 'M0005', 1, '2019-07-20'),
(3, 2, 'T001', 'N003', 'G004', 'S006', 'M0001', 1, '2019-07-20'),
(4, 1, 'T001', 'N003', 'G004', 'S006', 'M0002', 1, '2019-07-20'),
(5, 3, 'T001', 'N003', 'G004', 'S006', 'M0003', 1, '2019-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `codaula` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomaula` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcaula` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `codcaja` int(11) NOT NULL,
  `nrocaja` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombrecaja` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`codcaja`, `nrocaja`, `nombrecaja`, `codigo`) VALUES
(1, '001', 'ADMINISTRACI?N', 1),
(2, '002', 'ADMINISTRACI?N #2', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ceddirector` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `director` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tlfdirec` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `correodirec` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `codinstituto` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `nominstituto` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `direcinstituto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tlfinstituto` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `correoinstituto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `inicioinscripcion` date DEFAULT NULL,
  `fininscripcion` date DEFAULT NULL,
  `trimestreactivo` int(2) NOT NULL,
  `inicionotas` date NOT NULL,
  `finnotas` date NOT NULL,
  `diascrealapso` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ceddirector`, `director`, `tlfdirec`, `correodirec`, `codinstituto`, `nominstituto`, `direcinstituto`, `tlfinstituto`, `correoinstituto`, `inicioinscripcion`, `fininscripcion`, `trimestreactivo`, `inicionotas`, `finnotas`, `diascrealapso`) VALUES
(1, '341064', 'RAIZA BAENY CAPOBIANCO DE VELASCO', '8523035', 'COLEGIOVACADIEZ@GMAIL.COM', '341064028', 'COLEGIO DR. ANTONIO VACA DIEZ RIBERALTA S.R.L.', 'AV. ALBERTO NATUSCH S/N, ZONA CENTRAL', '852-3035', 'COLEGIOVACADIEZ@GMAIL.COM', '2019-06-01', '2019-10-31', 1, '2019-06-01', '2019-09-01', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `coddia` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomdia` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `coddoc` int(11) NOT NULL,
  `ceddoc` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `nomdoc` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tlfdoc` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `direcdoc` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `especdoc` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fecnacdoc` date DEFAULT NULL,
  `edocivildoc` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `lugarnacdoc` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `correodoc` varchar(140) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `expedido` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `horasdoc` int(5) NOT NULL,
  `codcargodoc` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clavedoc` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ingresodoc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`coddoc`, `ceddoc`, `nomdoc`, `tlfdoc`, `direcdoc`, `especdoc`, `fecnacdoc`, `edocivildoc`, `lugarnacdoc`, `correodoc`, `expedido`, `horasdoc`, `codcargodoc`, `clavedoc`, `ingresodoc`) VALUES
(1, '26541762', 'RAFAEL DE JESUS CONTRERAS', '04146542345', 'SANTA CRUZ', 'LICENCIADO EN EDUCACION', '1984-04-05', 'SOLTERO(A)', 'CABIMAS', 'JESUS@GMAIL.COM', 'LA PAZ', 32, 'A987234', 'c41c1e6c95c752c6628ca1b442492d444f4b1433', '2019-07-20'),
(2, '24876134', 'CAROLINA CONTRERAS', '04165423456', 'SANTA CRUZ', 'LICDA. FISICA', '1992-04-10', 'SOLTERO(A)', 'CABIMAS', 'CAROL@GMAIL.COM', 'COCHABAMBA', 36, 'D177623', 'e850832399e0eac98e1da097171b97fe9b7b4ae5', '2019-07-20'),
(3, '17654209', 'RICHARD JOSE CHIRINOS RODRIGUEZ', '04246541233', 'CABIMAS', 'LICDO EN EDUCACION', '1983-03-17', 'SOLTERO(A)', 'CABIMAS', 'RICHARD@GMAIL.COM', 'COCHABAMBA', 38, 'A776009912', 'dcb8afec965b1203f3d0b1c57b41d0ea2961841f', '2019-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `idest` int(11) NOT NULL,
  `codest` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cedpadre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cedest` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `pnomest` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `snomest` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `papeest` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `sapeest` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `sexoest` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direcest` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fnacest` date NOT NULL,
  `codseccion` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codturno` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codperiodo` int(11) NOT NULL,
  `becado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `observacionest` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `retiroest` date NOT NULL,
  `claveest` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `statusest` int(2) NOT NULL,
  `fechainscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`idest`, `codest`, `cedpadre`, `cedest`, `pnomest`, `snomest`, `papeest`, `sapeest`, `sexoest`, `direcest`, `fnacest`, `codseccion`, `codturno`, `codperiodo`, `becado`, `observacionest`, `retiroest`, `claveest`, `statusest`, `fechainscripcion`) VALUES
(1, 'A1', '7611111', '14741664', 'THIAGO', 'DYLAN', 'QUISPE', 'QUISBERT', 'MASCULINO', 'PASILLO PACHUVILLA S/N - B/ ROSEDAL', '2014-07-15', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', '4207e58feca327f7cf5db554224055d4c59f7b1e', 1, '2019-01-19'),
(2, 'A2', '5627792', '1936648', 'ARIANNE', 'MISHELL', 'GALVAN', 'ADRIAZOLA', 'FEMENINO', 'AV. DR. MARTINEZ N. - B/ CENTRAL', '2014-05-28', 'S005', 'T001', 1, 'NO', '0', '0000-00-00', '9428cc8f641e6019f177f7de24a415796453db6f', 1, '2019-01-19'),
(3, 'A3', '17626739', '13480170', 'ALEXANDRA', '', 'RODRIGUEZ', 'VERDUGO', 'FEMENINO', 'CALLE SANTIESTEBAN S/N - B/ SAN JOSE', '2012-08-02', 'S007', 'T001', 1, 'NO', '0', '0000-00-00', '37bd0944fbcb131f07e964b80d772d621e3180c4', 1, '2019-01-19'),
(4, 'A4', '8163358', '15137501', 'MAYTE', '', 'MORALES', 'ORELLANA', 'FEMENINO', 'AV. GABRIEL RENE MORENO N?110 - B/ LA CHONTA', '2012-04-11', 'S008', 'T001', 1, 'NO', '0', '0000-00-00', '866eb163683a4bb1a365ec13fba0cf6142b2514e', 1, '2019-01-19'),
(5, 'A5', '5710038', '13809676', 'YOMAR', 'RICARDO', 'ROCA', 'NOVOA', 'MASCULINO', 'AV. 6 DE AGOSTO S/N - B/ 25 DE MARZO', '2008-07-13', 'S014', 'T001', 1, 'NO', '0', '0000-00-00', 'a99ddaf8a715d9e0ce571cf34b15d4277dfda038', 1, '2019-01-19'),
(6, 'A6', '5710038', '13809677', 'LUIS', 'BENITO', 'ROCA', 'NOVOA', 'MASCULINO', 'AV. 6 DE AGOSTO S/N - B/ 25 DE MARZO', '2007-10-20', 'S016', 'T001', 1, 'NO', '0', '0000-00-00', 'b60fee5f08d410014132b184c4a472969dedec42', 1, '2019-01-19'),
(7, 'A7', '5710038', '0321306', 'YARA', 'NAELY', 'KIERFFER', 'ROCA', 'FEMENINO', 'AV. 6 DE AGOSTO S/N - B/ 25 DE MARZO', '2005-03-07', 'S016', 'T001', 1, 'NO', '0', '0000-00-00', 'be0b572aa85dbedaea85ced87a40e387000aa820', 1, '2019-01-19'),
(8, 'A8', '7615700', '15525987', 'VERONICA', '', 'WADA', 'DOMINGUEZ', 'FEMENINO', 'CALLE FRANCISCO BAZAN S/N - B/25 DE MARZO', '2014-10-13', 'S002', 'T001', 1, 'COMPLETA', '0', '0000-00-00', '8248b7e34337fa97c865cc5f40453eb8d2ec11f9', 1, '2019-01-19'),
(9, 'A9', '12347790', '048127', 'THIAGO', '', 'YOAMONA', 'MARUPA', 'MASCULINO', 'AV. CARLOS SONNENSCHEIN S/N - B/NUEVO HORIZONTE', '2014-11-12', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', '0703ec79ca4a26d4bf621fae8047b54f8f7918bc', 1, '2019-01-19'),
(10, 'A10', '9267120', '054580', 'CAROLAINE', '', 'ESTIVARIZ', 'RUTANI', 'FEMENINO', 'AV. 6 DE AGOSTO S/N - B/ 25 DE MARZO', '2014-08-22', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', 'e69b85eac9d856ad75735bc86e9220f6e9cc6b40', 1, '2019-01-19'),
(11, 'A11', '7646305', '2377192', 'ANGELICA', '', 'QUETE', 'SEJAS', 'FEMENINO', 'AV. ABDON AGUILERA S/N - B/LOS ALMENDROS', '2015-04-29', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', 'b87dd583c88366a22d678efb5d100b09901d24cc', 1, '2019-01-19'),
(12, 'A12', '12848663', '019550', 'MARIA', 'GUADALUPE', 'HUACAMA', 'AGUIRRE', 'FEMENINO', 'AV. GUAYACAN S/N - B/25 DE MARZO', '2014-07-17', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', '5c4d7852120bd350c47133c8cf5413191c4df08d', 1, '2019-01-19'),
(13, 'A13', '9267689', '15576830', 'ALEJANDRA', '', 'VASQUEZ', 'ESPINOZA', 'FEMENINO', 'AV. VERDOLAGO S/N - B/HORIZONTE', '2014-08-10', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', '338120123548bc414133a61e18ca13a8dab78ed9', 1, '2019-01-19'),
(14, 'A14', '4434601', '15493716', 'CARLOS', 'DAVID', 'SANCHEZ', 'OROSCO', 'MASCULINO', 'AV. HEROES DEL CHACO S/N - B/ROSEDAL', '2014-08-28', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', '6c82a4bcb9c574e1070f5fcb3a41b118dfb2b00d', 1, '2019-01-19'),
(15, 'A15', '7874640', '14334289', 'ALISON', '', 'HERRERA', 'NOVOA', 'FEMENINO', 'B/NUEVO HORIZONTE, LADO POSTA', '2015-04-10', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', 'f5becc23dfad217bea137addabc1573e489b3c17', 1, '2019-01-19'),
(16, 'A16', '10781370', '104767', 'GENESIS', 'VERONICA', 'QUETEGUARI', 'ARO', 'FEMENINO', 'CALLE PI?A S/N - B/INTEGRACION', '2015-02-14', 'S002', 'T001', 1, 'NO', '0', '0000-00-00', '01675dc66b2aaab2e60c2a6a9023d3192f885c47', 1, '2019-01-19'),
(17, 'A17', '7596870', '822200292018028', 'YOHANA', 'CARMENCITA', 'JANKO', 'MEDINA', 'FEMENINO', 'AV. VERDOLAGO S/N - B/NUEVO HORIZONTE', '2014-07-16', 'S004', 'T001', 1, 'NO', '0', '0000-00-00', '7f6b5148127d5d1c764dc5ca6381fcc92ba8a8ee', 1, '2019-01-21'),
(18, 'A18', '7645470', '0771353', 'NICK', '', 'RIBERA', 'RAMALLO', 'MASCULINO', 'CALLE LIMON S/N - B/VILLA FABIOLA', '2014-04-24', 'S004', 'T001', 1, 'NO', '0', '0000-00-00', '3253009898963a16edf9a1ba45876fecff1c98b6', 1, '2019-01-21'),
(19, 'A19', '13040546', '822200202018038', 'THIAGO', 'MATIAS', 'CORTEZ', 'GUARIBANA', 'MASCULINO', 'AV. JUAN CARLOS MENINI S/N - B/7 DE AGOSTO', '2014-01-21', 'S004', 'T001', 1, 'NO', '0', '0000-00-00', '640b93cb6436100a698b97f711e4c3eeb49623e9', 1, '2019-01-21'),
(20, 'A20', '7646615', '822202102018017', 'JESUS', 'JOAO', 'JIMENEZ', 'CORTEZ', 'MASCULINO', 'AV. JUAN CARLOS MENINI S/N - B/7 DE AGOSTO', '2014-01-07', 'S004', 'T001', 1, 'NO', '0', '0000-00-00', '189358df1c8d3ca7e8fb6cd87e7e5b4aa6aa89da', 1, '2019-01-21'),
(21, 'A21', '9267513', '078237', 'NICK', '', 'FARFAN', 'CAYALO', 'MASCULINO', 'AV. CASA DE LOS MAESTROS S/N - B/LITORAL', '2014-07-17', 'S005', 'T001', 1, 'NO', '0', '0000-00-00', '530556496209a54d75ef78efbb4d1eb77a7eca78', 1, '2019-01-21'),
(22, 'A22', '7585574', '1114141', 'DAMNA', 'NICKOL', 'FLORES', 'SASTE', 'FEMENINO', 'AV. CARAMBOLA S/N - B/LITORAL', '2013-08-23', 'S005', 'T001', 1, 'NO', '0', '0000-00-00', 'a183e7883cffa622903620dc7d75cdbd39951bdb', 1, '2019-01-21'),
(23, 'A23', '7633891', '809000142018145', 'NATALY', '', 'LIMPIAS', 'MELGAR', 'FEMENINO', 'DIAGONAL ESCUELA DE POLICIA S/N - B/VILLA FRANCIA', '2013-08-03', 'S005', 'T001', 1, 'NO', '0', '0000-00-00', '6b02075b86194b79009645404d45e7b93db92991', 1, '2019-01-21'),
(24, 'A24', '6095566', '822200112017042', 'TIRSA', '', 'FERNANDEZ', 'CONDORI', 'FEMENINO', 'AV. AMAZONICA Y PALMA REAL S/N - B/TAMARINDO', '2012-07-01', 'S006', 'T001', 1, 'NO', '0', '0000-00-00', '11caa2c42137e27173dff77d2fae43154730ca8d', 1, '2019-01-21'),
(25, 'A25', '7646923', '822200132017058', 'ODESY', 'ISABELA', 'COELHO', 'GALARZA', 'FEMENINO', 'AV. VERDOLAGO S/N - B/HORIZONTE', '2013-03-23', 'S006', 'T001', 1, 'NO', '0', '0000-00-00', '820e9ee429ea078964cc3715cde6a6eaa3413cc4', 1, '2019-01-21'),
(26, 'A26', '4173691-1F', '822201702017034', 'NATHAN', 'ANGEL', 'COSIO', 'FLORES', 'MASCULINO', 'CALLE TIPA S/N - B/LOS ALMENDROS', '2012-10-01', 'S006', 'T001', 1, 'NO', '0', '0000-00-00', 'ea728b116128d212b575dda7fbe485ff83cd6ff0', 1, '2019-01-21'),
(27, 'A27', '5592338', '822201702018028', 'XIMENA', '', 'HURTADO', 'OYOLA', 'FEMENINO', 'AV. BENI MAMORE S/N - B/SANTA ROSA DE LIMA', '2013-05-29', 'S006', 'T001', 1, 'NO', '0', '0000-00-00', 'dba73ddbba55b73f78547ff78e87ae1d01a0fc78', 1, '2019-01-21'),
(28, 'A28', '4965577', '822201702017007', 'LIZ', 'KARIN', 'CHOQUERIVE', 'LLANQUE', 'FEMENINO', 'AV. MARA S/N - B/LOS ALMENDROS', '2013-04-13', 'S007', 'T001', 1, 'NO', '0', '0000-00-00', '0892a1c7ad0723f9bc4146d5be250dbe1413ea6d', 1, '2019-01-21'),
(29, 'A29', '7594141', '822201782017019', 'ABNER', '', 'OJOPI', 'PI?HEIRO', 'MASCULINO', 'AV. 6 DE AGOSTO S/N - B/25 DE MARZO', '2012-07-19', 'S007', 'T001', 1, 'NO', '0', '0000-00-00', '42e2136d13eacdaca9691d84ceca7030a6c44629', 1, '2019-01-21'),
(30, 'A30', '6383783', '822201782017048', 'REINA', 'ESTHER', 'FLORES', 'FERNANDEZ', 'FEMENINO', 'AV.9 DE ABRIL S/N - B/VILLA CAMINOS', '2012-01-10', 'S008', 'T001', 1, 'NO', '0', '0000-00-00', '56d69275d849c987099414f2768ed518f7b61d19', 1, '2019-01-21'),
(31, 'A31', '4162264', '822200292017018', 'LUIS', 'DANIEL', 'MAMANI', 'HUANCA', 'MASCULINO', 'AV. INTEGRACION S/N - B/VERDOLAGO', '2012-06-02', 'S008', 'T001', 1, 'NO', '0', '0000-00-00', 'c68936f36e0178c3f08c4e40a18fb72743deb825', 1, '2019-01-21'),
(32, 'A32', '9220906', '82220170201720', 'NAYRA', 'ALINA', 'CANDIA', 'GUTIERREZ', 'FEMENINO', 'AV. OSCAR RIBERA Y AMARILLO S/N - B/LOS ALMENDROS', '2012-03-21', 'S008', 'T001', 1, 'NO', '0', '0000-00-00', 'aad855b74cd25717429ef3e103293c87bc075357', 1, '2019-01-21'),
(33, 'A33', '7645582', '822200422016028', 'MIGUEL', 'ANGEL', 'AJNOTA', 'GONGORA', 'MASCULINO', 'AV. ACHACHAIRU Y ACEROLA S/N - B/2 DE MAYO', '2011-04-23', 'S009', 'T001', 1, 'NO', '0', '0000-00-00', '82f9f067e9c700c034fa588d94249f10a4892e54', 1, '2019-01-21'),
(34, 'A34', '12591535', '82460025201693014', 'JANI', '', 'TAKESAKO', 'IMAPOCO', 'FEMENINO', 'AV. ABDON AGUILERA FRENTE INTERNADO BETANIA - B/25 DE MARZO', '2012-06-30', 'S009', 'T001', 1, 'NO', '0', '0000-00-00', '4dd4d631b7c2edf4d4bd9f002105cd5812253c30', 1, '2019-01-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `codgrado` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codnivel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `grado` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`codgrado`, `codnivel`, `grado`) VALUES
('G001', 'N001', 'NIDITO'),
('G002', 'N002', '1RA SECCION'),
('G003', 'N002', '2DA SECCION'),
('G004', 'N003', 'PRIMERO'),
('G005', 'N003', 'SEGUNDO'),
('G006', 'N003', 'TERCERO'),
('G007', 'N003', 'CUARTO'),
('G008', 'N003', 'QUINTO'),
('G009', 'N003', 'SEXTO'),
('G010', 'N004', 'PRIMERO'),
('G011', 'N004', 'SEGUNDO'),
('G012', 'N004', 'TERCERO'),
('G013', 'N004', 'CUARTO'),
('G014', 'N004', 'QUINTO'),
('G015', 'N004', 'SEXTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `codhorario` int(11) NOT NULL,
  `codturno` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codseccion` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codmateria` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `coddia` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codhora` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codaula` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `codhora` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nomhora` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tiempo` datetime DEFAULT NULL,
  `detalles` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `paginas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `ip`, `tiempo`, `detalles`, `paginas`, `usuario`) VALUES
(1, '127.0.0.1', '2019-01-19 14:07:42', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:64.0) Gecko/20100101 Firefox/64.0', '/academico/index.php', 'DAMITA'),
(2, '127.0.0.1', '2019-01-21 10:35:30', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:64.0) Gecko/20100101 Firefox/64.0', '/academico/index.php', 'DAMITA'),
(3, '::1', '2019-07-20 06:38:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(4, '::1', '2019-07-20 06:41:14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(5, '::1', '2019-07-20 09:24:12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(6, '::1', '2019-07-21 12:03:27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(7, '::1', '2019-07-21 08:42:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', '26541762'),
(8, '::1', '2019-07-22 01:03:33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(9, '::1', '2019-07-22 01:04:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(10, '::1', '2019-07-22 01:04:32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(11, '::1', '2019-07-22 01:05:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(12, '::1', '2019-07-22 01:06:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(13, '::1', '2019-07-22 01:12:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'SECRETARIA'),
(14, '::1', '2019-07-23 12:41:10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(15, '::1', '2019-07-23 12:44:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(16, '::1', '2019-07-23 04:11:31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(17, '::1', '2019-07-24 08:03:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy_V2/index.php', 'RUBENCHIRINOS'),
(18, '::1', '2019-08-13 05:00:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy_V2/index.php', 'RUBENCHIRINOS'),
(19, '::1', '2019-08-26 06:54:35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(20, '::1', '2019-08-26 06:56:02', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '/academy/index.php', 'RUBENCHIRINOS'),
(21, '190.143.242.217', '2024-02-07 10:51:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '/sis/academico/index.php', 'RUBENCHIRINOS'),
(22, '190.143.242.217', '2024-02-07 10:52:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '/sis/academico/index.php', 'FRANKCORNEJO'),
(23, '190.143.242.154', '2024-02-12 09:30:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '/sis/academico/index.php', 'FRANKCORNEJO'),
(24, '186.77.133.245', '2024-03-04 09:14:45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '/sis/academico/index.php', 'FRANKCORNEJO'),
(25, '179.32.53.160', '2024-03-04 11:54:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '/sis/academico/index.php', 'FRANKCORNEJO'),
(26, '190.143.242.211', '2024-03-06 09:20:05', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '/sis/academico/index.php', 'FRANKCORNEJO'),
(27, '190.143.242.211', '2024-03-06 09:25:47', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '/sis/academico/index.php', 'FRANKCORNEJO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `codmateria` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codarea` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nommateria` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codnivel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codgrado` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`codmateria`, `codarea`, `nommateria`, `codnivel`, `codgrado`) VALUES
('M0001', 'AR001', 'INGLES', 'N003', 'G004'),
('M0002', 'AR001', 'MATEMATICA', 'N003', 'G004'),
('M0003', 'AR002', 'FISICA', 'N003', 'G004'),
('M0004', 'AR001', 'CASTELLANO', 'N001', 'G001'),
('M0005', 'AR001', 'EDUCACION FISICA', 'N001', 'G001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoscajas`
--

CREATE TABLE `movimientoscajas` (
  `codmovimientocaja` int(11) NOT NULL,
  `tipomovimientocaja` varchar(10) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `nrorecibo` varchar(25) NOT NULL,
  `montomovimientocaja` float(12,2) NOT NULL,
  `descripcionmovimientocaja` text NOT NULL,
  `fechamovimientocaja` date NOT NULL,
  `codperiodo` int(11) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `codnivel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nivel` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `pagonivel` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`codnivel`, `nivel`, `pagonivel`) VALUES
('N001', 'NIDITO', 355.00),
('N002', 'INICIAL', 385.00),
('N003', 'PRIMARIO', 450.00),
('N004', 'SECUNDARIO', 500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `codnota` int(11) NOT NULL,
  `codest` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `coddoc` int(11) NOT NULL,
  `codnivel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codgrado` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codseccion` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codturno` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codperiodo` int(11) NOT NULL,
  `codmateria` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nota1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nota2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nota3` text CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `definitiva` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `literal` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`codnota`, `codest`, `coddoc`, `codnivel`, `codgrado`, `codseccion`, `codturno`, `codperiodo`, `codmateria`, `nota1`, `nota2`, `nota3`, `definitiva`, `literal`) VALUES
(1, 'A25', 2, 'N003', 'G004', 'S006', 'T001', 1, 'M0001', '80', '0', '0', '80', '0'),
(2, 'A26', 2, 'N003', 'G004', 'S006', 'T001', 1, 'M0001', '79', '0', '0', '79', '0'),
(3, 'A24', 2, 'N003', 'G004', 'S006', 'T001', 1, 'M0001', '70', '0', '0', '70', '0'),
(4, 'A27', 2, 'N003', 'G004', 'S006', 'T001', 1, 'M0001', '60', '0', '0', '60', '0'),
(5, 'A25', 1, 'N003', 'G004', 'S006', 'T001', 1, 'M0002', '90', '0', '0', '90', '0'),
(6, 'A26', 1, 'N003', 'G004', 'S006', 'T001', 1, 'M0002', '80', '0', '0', '80', '0'),
(7, 'A24', 1, 'N003', 'G004', 'S006', 'T001', 1, 'M0002', '98', '0', '0', '98', '0'),
(8, 'A27', 1, 'N003', 'G004', 'S006', 'T001', 1, 'M0002', '100', '0', '0', '100', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `codpadre` int(11) NOT NULL,
  `cedpadre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nompadre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `apepadre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tlfpadre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `statuspad` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`codpadre`, `cedpadre`, `nompadre`, `apepadre`, `tlfpadre`, `statuspad`) VALUES
(1, '7611111', 'JONNY', 'QUISPE VALENCIA', '67769513', 1),
(2, '5627792', 'JOHNNY ARIEL', 'GALVAN HEBERHARDT', '69568650', 1),
(3, '17626739', 'ALEX', 'RODRIGUEZ HUARITA', '76887597', 1),
(4, '8163358', 'ELSA PATRICIA', 'ORELLANA MOGROBE', '76126814', 1),
(5, '5710038', 'MARGIE', 'NOVOA PEREZ', '67681053', 1),
(6, '7615700', 'EDITH', 'DOMINGUEZ PORTUGAL', '67366548', 1),
(7, '12347790', 'SILVIA', 'MARUPA QUETEGUARY', '79217953', 1),
(8, '9267120', 'BIRZAVIT', 'RUTANI MAYO', '68952822', 1),
(9, '7646305', 'BLANCA', 'SEJAS SALVATIERRA', '76881665', 1),
(10, '12848663', 'MARIANA', 'MARQUEZ AGUIRRE', '77844648', 1),
(11, '9267689', 'ARIEL', 'VASQUEZ MOSQUEIRA', '70263167', 1),
(12, '4434601', 'JUAN CARLOS', 'SANCHEZ LEDEZMA', '78295499', 1),
(13, '7874640', 'ALEXANDER', 'HERRERA SANCHEZ', '74753457', 1),
(14, '10781370', 'FATIMA YEXENIA', 'ARO OLMOS', '73956448', 1),
(15, '7596870', 'YOBANA', 'MEDINA GUARY', '75890564', 1),
(16, '7645470', 'YASMINE', 'RAMALLO IDAGUA', '67366341', 1),
(17, '13040546', 'NAYELI', 'GUARIBANA TANAKA', '73901659', 1),
(18, '7646615', 'LIRIO YASMIRA', 'CORTEZ FERNANDEZ', '73901659', 1),
(19, '9267513', 'CARLOS GERSON', 'FARFAN MOSQUEIRA', '76883368', 1),
(20, '7585574', 'JANETH', 'SASTE MOYE', '74670230', 1),
(21, '7633891', 'LIDIA', 'MELGR CHAO', '76883773', 1),
(22, '6095566', 'ROSMARY', 'CONDORI DE FERNANDEZ', '73707938', 1),
(23, '7646923', 'ROSSY', 'GALARZA CAMARGO', '79239798', 1),
(24, '4173691-1F', 'MATILDE', 'FLORES SUXO', '74710768', 1),
(25, '5592338', 'XIMENA LILIAN', 'OYOLA AVILA', '73967004', 1),
(26, '4965577', 'JUAN', 'CHOQUERIVE AYAVIRI', '67170049', 1),
(27, '7594141', 'PATRICIA', 'PI?HEIRO PIMENTEL', '76869984', 1),
(28, '6383783', 'PATRICIA', 'FERNANDEZ GONZALES', '60218450', 1),
(29, '4162264', 'PEDRO', 'MAMANI CHAMBI', '78740446', 1),
(30, '9220906', 'RUBEN', 'CANDIA MAMANI', '73563652', 1),
(31, '7645582', 'LEXI', 'GONGORA SABENE', '72833072', 1),
(32, '12591535', 'JAIRO', 'TAKESAKO HURTADO', '68959919', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `codpago` int(11) NOT NULL,
  `numcomprobante` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codest` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codseccion` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codturno` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codperiodo` int(11) NOT NULL,
  `becado` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `mespago` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `montopago` float(8,2) NOT NULL,
  `fechapago` date NOT NULL,
  `statuspago` int(2) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`codpago`, `numcomprobante`, `codest`, `codseccion`, `codturno`, `codperiodo`, `becado`, `mespago`, `montopago`, `fechapago`, `statuspago`, `codigo`) VALUES
(1, 'C7VXEL1QPYTE7W17Q3V', 'A1', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 1, 2),
(2, '0', 'A1', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(3, '0', 'A1', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(4, '0', 'A1', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(5, '0', 'A1', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(6, '0', 'A1', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(7, '0', 'A1', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(8, '0', 'A1', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(9, '0', 'A1', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(10, 'C7VXEL1QPYTE7W17Q3V', 'A1', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(11, '0', 'A2', 'S005', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 2, 2),
(12, '0', 'A2', 'S005', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(13, '0', 'A2', 'S005', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(14, '0', 'A2', 'S005', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(15, '0', 'A2', 'S005', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(16, '0', 'A2', 'S005', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(17, '0', 'A2', 'S005', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(18, '0', 'A2', 'S005', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(19, '0', 'A2', 'S005', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(20, 'CTI1C9BEPP80A3UQ3MS', 'A2', 'S005', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(21, 'CZF1SXBFICSR0SD8XP4', 'A3', 'S007', 'T001', 1, 'NO', '02', 450.00, '2019-01-19', 1, 2),
(22, '0', 'A3', 'S007', 'T001', 1, 'NO', '03', 450.00, '2019-01-19', 2, 2),
(23, '0', 'A3', 'S007', 'T001', 1, 'NO', '04', 450.00, '2019-01-19', 2, 2),
(24, '0', 'A3', 'S007', 'T001', 1, 'NO', '05', 450.00, '2019-01-19', 2, 2),
(25, '0', 'A3', 'S007', 'T001', 1, 'NO', '06', 450.00, '2019-01-19', 2, 2),
(26, '0', 'A3', 'S007', 'T001', 1, 'NO', '07', 450.00, '2019-01-19', 2, 2),
(27, '0', 'A3', 'S007', 'T001', 1, 'NO', '08', 450.00, '2019-01-19', 2, 2),
(28, '0', 'A3', 'S007', 'T001', 1, 'NO', '09', 450.00, '2019-01-19', 0, 2),
(29, '0', 'A3', 'S007', 'T001', 1, 'NO', '10', 450.00, '2019-01-19', 0, 2),
(30, 'CZF1SXBFICSR0SD8XP4', 'A3', 'S007', 'T001', 1, 'NO', '11', 450.00, '2019-01-19', 1, 2),
(31, 'CTDCOV3O2A1I1BESFBB', 'A4', 'S008', 'T001', 1, 'NO', '02', 450.00, '2019-01-19', 1, 2),
(32, '0', 'A4', 'S008', 'T001', 1, 'NO', '03', 450.00, '2019-01-19', 2, 2),
(33, '0', 'A4', 'S008', 'T001', 1, 'NO', '04', 450.00, '2019-01-19', 2, 2),
(34, '0', 'A4', 'S008', 'T001', 1, 'NO', '05', 450.00, '2019-01-19', 2, 2),
(35, '0', 'A4', 'S008', 'T001', 1, 'NO', '06', 450.00, '2019-01-19', 2, 2),
(36, '0', 'A4', 'S008', 'T001', 1, 'NO', '07', 450.00, '2019-01-19', 2, 2),
(37, '0', 'A4', 'S008', 'T001', 1, 'NO', '08', 450.00, '2019-01-19', 2, 2),
(38, '0', 'A4', 'S008', 'T001', 1, 'NO', '09', 450.00, '2019-01-19', 0, 2),
(39, '0', 'A4', 'S008', 'T001', 1, 'NO', '10', 450.00, '2019-01-19', 0, 2),
(40, 'CTDCOV3O2A1I1BESFBB', 'A4', 'S008', 'T001', 1, 'NO', '11', 450.00, '2019-01-19', 1, 2),
(41, 'CMZ09M3QDKDY8SXCW9Y', 'A5', 'S014', 'T001', 1, 'NO', '02', 450.00, '2019-01-19', 1, 2),
(42, '0', 'A5', 'S014', 'T001', 1, 'NO', '03', 450.00, '2019-01-19', 2, 2),
(43, '0', 'A5', 'S014', 'T001', 1, 'NO', '04', 450.00, '2019-01-19', 2, 2),
(44, '0', 'A5', 'S014', 'T001', 1, 'NO', '05', 450.00, '2019-01-19', 2, 2),
(45, '0', 'A5', 'S014', 'T001', 1, 'NO', '06', 450.00, '2019-01-19', 2, 2),
(46, '0', 'A5', 'S014', 'T001', 1, 'NO', '07', 450.00, '2019-01-19', 2, 2),
(47, '0', 'A5', 'S014', 'T001', 1, 'NO', '08', 450.00, '2019-01-19', 2, 2),
(48, '0', 'A5', 'S014', 'T001', 1, 'NO', '09', 450.00, '2019-01-19', 0, 2),
(49, '0', 'A5', 'S014', 'T001', 1, 'NO', '10', 450.00, '2019-01-19', 0, 2),
(50, 'CMZ09M3QDKDY8SXCW9Y', 'A5', 'S014', 'T001', 1, 'NO', '11', 450.00, '2019-01-19', 1, 2),
(51, 'CUGF84G5PPDYG0OWT2J', 'A6', 'S016', 'T001', 1, 'NO', '02', 450.00, '2019-01-19', 1, 2),
(52, '0', 'A6', 'S016', 'T001', 1, 'NO', '03', 450.00, '2019-01-19', 2, 2),
(53, '0', 'A6', 'S016', 'T001', 1, 'NO', '04', 450.00, '2019-01-19', 2, 2),
(54, '0', 'A6', 'S016', 'T001', 1, 'NO', '05', 450.00, '2019-01-19', 2, 2),
(55, '0', 'A6', 'S016', 'T001', 1, 'NO', '06', 450.00, '2019-01-19', 2, 2),
(56, '0', 'A6', 'S016', 'T001', 1, 'NO', '07', 450.00, '2019-01-19', 2, 2),
(57, '0', 'A6', 'S016', 'T001', 1, 'NO', '08', 450.00, '2019-01-19', 2, 2),
(58, '0', 'A6', 'S016', 'T001', 1, 'NO', '09', 450.00, '2019-01-19', 0, 2),
(59, '0', 'A6', 'S016', 'T001', 1, 'NO', '10', 450.00, '2019-01-19', 0, 2),
(60, 'CUGF84G5PPDYG0OWT2J', 'A6', 'S016', 'T001', 1, 'NO', '11', 450.00, '2019-01-19', 1, 2),
(61, 'CQRLQU78PR6JP8LCWG8', 'A7', 'S016', 'T001', 1, 'NO', '02', 450.00, '2019-01-19', 1, 2),
(62, '0', 'A7', 'S016', 'T001', 1, 'NO', '03', 450.00, '2019-01-19', 2, 2),
(63, '0', 'A7', 'S016', 'T001', 1, 'NO', '04', 450.00, '2019-01-19', 2, 2),
(64, '0', 'A7', 'S016', 'T001', 1, 'NO', '05', 450.00, '2019-01-19', 2, 2),
(65, '0', 'A7', 'S016', 'T001', 1, 'NO', '06', 450.00, '2019-01-19', 2, 2),
(66, '0', 'A7', 'S016', 'T001', 1, 'NO', '07', 450.00, '2019-01-19', 2, 2),
(67, '0', 'A7', 'S016', 'T001', 1, 'NO', '08', 450.00, '2019-01-19', 2, 2),
(68, '0', 'A7', 'S016', 'T001', 1, 'NO', '09', 450.00, '2019-01-19', 0, 2),
(69, '0', 'A7', 'S016', 'T001', 1, 'NO', '10', 450.00, '2019-01-19', 0, 2),
(70, 'CQRLQU78PR6JP8LCWG8', 'A7', 'S016', 'T001', 1, 'NO', '11', 450.00, '2019-01-19', 1, 2),
(71, 'CHE99XAVKLS876J5967', 'A8', 'S002', 'T001', 1, 'COMPLETA', '02', 385.00, '2019-01-19', 1, 2),
(72, 'CHE99XAVKLS876J5967', 'A8', 'S002', 'T001', 1, 'COMPLETA', '11', 385.00, '2019-01-19', 1, 2),
(73, '0', 'A9', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 2, 2),
(74, '0', 'A9', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(75, '0', 'A9', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(76, '0', 'A9', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(77, '0', 'A9', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(78, '0', 'A9', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(79, '0', 'A9', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(80, '0', 'A9', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(81, '0', 'A9', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(82, 'CA0D4W8OEM54UMSBX9Y', 'A9', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(83, '0', 'A10', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 2, 2),
(84, '0', 'A10', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(85, '0', 'A10', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(86, '0', 'A10', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(87, '0', 'A10', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(88, '0', 'A10', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(89, '0', 'A10', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(90, '0', 'A10', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(91, '0', 'A10', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(92, 'C8B939VCBAOHFQJ0RHM', 'A10', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(93, '0', 'A11', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 2, 2),
(94, '0', 'A11', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(95, '0', 'A11', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(96, '0', 'A11', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(97, '0', 'A11', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(98, '0', 'A11', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(99, '0', 'A11', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(100, '0', 'A11', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(101, '0', 'A11', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(102, 'C27LH414M2806VG37UZ', 'A11', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(103, 'CZ6QIE5JUP83JV08BYO', 'A12', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 1, 2),
(104, '0', 'A12', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(105, '0', 'A12', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(106, '0', 'A12', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(107, '0', 'A12', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(108, '0', 'A12', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(109, '0', 'A12', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(110, '0', 'A12', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(111, '0', 'A12', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(112, 'CZ6QIE5JUP83JV08BYO', 'A12', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(113, 'C7JJDHROW9IPIJ59HFT', 'A13', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 1, 2),
(114, '0', 'A13', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(115, '0', 'A13', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(116, '0', 'A13', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(117, '0', 'A13', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(118, '0', 'A13', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(119, '0', 'A13', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(120, '0', 'A13', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(121, '0', 'A13', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(122, 'C7JJDHROW9IPIJ59HFT', 'A13', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(123, 'C4PJ9Y3S25595UWEZHC', 'A14', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 1, 2),
(124, '0', 'A14', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(125, '0', 'A14', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(126, '0', 'A14', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(127, '0', 'A14', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(128, '0', 'A14', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(129, '0', 'A14', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(130, '0', 'A14', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(131, '0', 'A14', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(132, 'C4PJ9Y3S25595UWEZHC', 'A14', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(133, '0', 'A15', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 2, 2),
(134, '0', 'A15', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(135, '0', 'A15', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(136, '0', 'A15', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(137, '0', 'A15', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(138, '0', 'A15', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(139, '0', 'A15', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(140, '0', 'A15', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(141, '0', 'A15', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(142, 'CK1VP7GO12HAXIRWG2M', 'A15', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(143, '0', 'A16', 'S002', 'T001', 1, 'NO', '02', 385.00, '2019-01-19', 2, 2),
(144, '0', 'A16', 'S002', 'T001', 1, 'NO', '03', 385.00, '2019-01-19', 2, 2),
(145, '0', 'A16', 'S002', 'T001', 1, 'NO', '04', 385.00, '2019-01-19', 2, 2),
(146, '0', 'A16', 'S002', 'T001', 1, 'NO', '05', 385.00, '2019-01-19', 2, 2),
(147, '0', 'A16', 'S002', 'T001', 1, 'NO', '06', 385.00, '2019-01-19', 2, 2),
(148, '0', 'A16', 'S002', 'T001', 1, 'NO', '07', 385.00, '2019-01-19', 2, 2),
(149, '0', 'A16', 'S002', 'T001', 1, 'NO', '08', 385.00, '2019-01-19', 2, 2),
(150, '0', 'A16', 'S002', 'T001', 1, 'NO', '09', 385.00, '2019-01-19', 0, 2),
(151, '0', 'A16', 'S002', 'T001', 1, 'NO', '10', 385.00, '2019-01-19', 0, 2),
(152, 'C5FX4J4YC8P4BRHAW5C', 'A16', 'S002', 'T001', 1, 'NO', '11', 385.00, '2019-01-19', 1, 2),
(153, '0', 'A17', 'S004', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 2, 2),
(154, '0', 'A17', 'S004', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(155, '0', 'A17', 'S004', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(156, '0', 'A17', 'S004', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(157, '0', 'A17', 'S004', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(158, '0', 'A17', 'S004', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(159, '0', 'A17', 'S004', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(160, '0', 'A17', 'S004', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(161, '0', 'A17', 'S004', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(162, 'CY3AV9MWLO0ZZY6VDYX', 'A17', 'S004', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(163, '0', 'A18', 'S004', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 2, 2),
(164, '0', 'A18', 'S004', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(165, '0', 'A18', 'S004', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(166, '0', 'A18', 'S004', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(167, '0', 'A18', 'S004', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(168, '0', 'A18', 'S004', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(169, '0', 'A18', 'S004', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(170, '0', 'A18', 'S004', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(171, '0', 'A18', 'S004', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(172, 'CO6UBIM8KKQOFPHP29L', 'A18', 'S004', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(173, '0', 'A19', 'S004', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 2, 2),
(174, '0', 'A19', 'S004', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(175, '0', 'A19', 'S004', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(176, '0', 'A19', 'S004', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(177, '0', 'A19', 'S004', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(178, '0', 'A19', 'S004', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(179, '0', 'A19', 'S004', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(180, '0', 'A19', 'S004', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(181, '0', 'A19', 'S004', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(182, 'CF9XYSPM5MY0VYQMO17', 'A19', 'S004', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(183, '0', 'A20', 'S004', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 2, 2),
(184, '0', 'A20', 'S004', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(185, '0', 'A20', 'S004', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(186, '0', 'A20', 'S004', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(187, '0', 'A20', 'S004', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(188, '0', 'A20', 'S004', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(189, '0', 'A20', 'S004', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(190, '0', 'A20', 'S004', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(191, '0', 'A20', 'S004', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(192, 'CZG9I6C7AC8VRCADAO7', 'A20', 'S004', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(193, '0', 'A21', 'S005', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 2, 2),
(194, '0', 'A21', 'S005', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(195, '0', 'A21', 'S005', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(196, '0', 'A21', 'S005', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(197, '0', 'A21', 'S005', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(198, '0', 'A21', 'S005', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(199, '0', 'A21', 'S005', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(200, '0', 'A21', 'S005', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(201, '0', 'A21', 'S005', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(202, 'CRTSZHDEZ6IG9REO4IK', 'A21', 'S005', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(203, '0', 'A22', 'S005', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 2, 2),
(204, '0', 'A22', 'S005', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(205, '0', 'A22', 'S005', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(206, '0', 'A22', 'S005', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(207, '0', 'A22', 'S005', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(208, '0', 'A22', 'S005', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(209, '0', 'A22', 'S005', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(210, '0', 'A22', 'S005', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(211, '0', 'A22', 'S005', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(212, 'CC0HKOO41U958D469J2', 'A22', 'S005', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(213, 'C9CYIXJC8AACEPBQEVW', 'A23', 'S005', 'T001', 1, 'NO', '02', 385.00, '2019-01-21', 1, 2),
(214, '0', 'A23', 'S005', 'T001', 1, 'NO', '03', 385.00, '2019-01-21', 2, 2),
(215, '0', 'A23', 'S005', 'T001', 1, 'NO', '04', 385.00, '2019-01-21', 2, 2),
(216, '0', 'A23', 'S005', 'T001', 1, 'NO', '05', 385.00, '2019-01-21', 2, 2),
(217, '0', 'A23', 'S005', 'T001', 1, 'NO', '06', 385.00, '2019-01-21', 2, 2),
(218, '0', 'A23', 'S005', 'T001', 1, 'NO', '07', 385.00, '2019-01-21', 2, 2),
(219, '0', 'A23', 'S005', 'T001', 1, 'NO', '08', 385.00, '2019-01-21', 2, 2),
(220, '0', 'A23', 'S005', 'T001', 1, 'NO', '09', 385.00, '2019-01-21', 0, 2),
(221, '0', 'A23', 'S005', 'T001', 1, 'NO', '10', 385.00, '2019-01-21', 0, 2),
(222, 'C9CYIXJC8AACEPBQEVW', 'A23', 'S005', 'T001', 1, 'NO', '11', 385.00, '2019-01-21', 1, 2),
(223, '0', 'A24', 'S006', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 2, 2),
(224, '0', 'A24', 'S006', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(225, '0', 'A24', 'S006', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(226, '0', 'A24', 'S006', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(227, '0', 'A24', 'S006', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(228, '0', 'A24', 'S006', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(229, '0', 'A24', 'S006', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(230, '0', 'A24', 'S006', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(231, '0', 'A24', 'S006', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(232, 'C9M4VB5MLR5E49GFOEM', 'A24', 'S006', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(233, 'CXDDSQU2S82C92F9L5A', 'A25', 'S006', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(234, '0', 'A25', 'S006', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(235, '0', 'A25', 'S006', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(236, '0', 'A25', 'S006', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(237, '0', 'A25', 'S006', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(238, '0', 'A25', 'S006', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(239, '0', 'A25', 'S006', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(240, '0', 'A25', 'S006', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(241, '0', 'A25', 'S006', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(242, 'CXDDSQU2S82C92F9L5A', 'A25', 'S006', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(243, 'CKWSJXRC82M8O4GHGMY', 'A26', 'S006', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(244, '0', 'A26', 'S006', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(245, '0', 'A26', 'S006', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(246, '0', 'A26', 'S006', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(247, '0', 'A26', 'S006', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(248, '0', 'A26', 'S006', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(249, '0', 'A26', 'S006', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(250, '0', 'A26', 'S006', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(251, '0', 'A26', 'S006', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(252, 'CKWSJXRC82M8O4GHGMY', 'A26', 'S006', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(253, '0', 'A27', 'S006', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 2, 2),
(254, '0', 'A27', 'S006', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(255, '0', 'A27', 'S006', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(256, '0', 'A27', 'S006', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(257, '0', 'A27', 'S006', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(258, '0', 'A27', 'S006', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(259, '0', 'A27', 'S006', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(260, '0', 'A27', 'S006', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(261, '0', 'A27', 'S006', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(262, 'CYHUZ3OYIKZVWUL8CFD', 'A27', 'S006', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(263, 'CICLGHTD5XXAYXCAZ4Q', 'A28', 'S007', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(264, '0', 'A28', 'S007', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(265, '0', 'A28', 'S007', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(266, '0', 'A28', 'S007', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(267, '0', 'A28', 'S007', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(268, '0', 'A28', 'S007', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(269, '0', 'A28', 'S007', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(270, '0', 'A28', 'S007', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(271, '0', 'A28', 'S007', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(272, 'CICLGHTD5XXAYXCAZ4Q', 'A28', 'S007', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(273, 'CZ419ZXQ4KG5V3IXM6Q', 'A29', 'S007', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(274, '0', 'A29', 'S007', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(275, '0', 'A29', 'S007', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(276, '0', 'A29', 'S007', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(277, '0', 'A29', 'S007', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(278, '0', 'A29', 'S007', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(279, '0', 'A29', 'S007', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(280, '0', 'A29', 'S007', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(281, '0', 'A29', 'S007', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(282, 'CZ419ZXQ4KG5V3IXM6Q', 'A29', 'S007', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(283, 'COH2AL3CVKHJT34JOU6', 'A30', 'S008', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(284, '0', 'A30', 'S008', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(285, '0', 'A30', 'S008', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(286, '0', 'A30', 'S008', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(287, '0', 'A30', 'S008', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(288, '0', 'A30', 'S008', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(289, '0', 'A30', 'S008', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(290, '0', 'A30', 'S008', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(291, '0', 'A30', 'S008', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(292, 'COH2AL3CVKHJT34JOU6', 'A30', 'S008', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(293, '0', 'A31', 'S008', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 2, 2),
(294, '0', 'A31', 'S008', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(295, '0', 'A31', 'S008', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(296, '0', 'A31', 'S008', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(297, '0', 'A31', 'S008', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(298, '0', 'A31', 'S008', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(299, '0', 'A31', 'S008', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(300, '0', 'A31', 'S008', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(301, '0', 'A31', 'S008', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(302, 'CIFQ0XP8YUS7DLWLQ48', 'A31', 'S008', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(303, 'CGESJU8FV81WBRSA5XK', 'A32', 'S008', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(304, '0', 'A32', 'S008', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(305, '0', 'A32', 'S008', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(306, '0', 'A32', 'S008', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(307, '0', 'A32', 'S008', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(308, '0', 'A32', 'S008', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(309, '0', 'A32', 'S008', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(310, '0', 'A32', 'S008', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(311, '0', 'A32', 'S008', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(312, 'CGESJU8FV81WBRSA5XK', 'A32', 'S008', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(313, 'C8BL1L5H76JUW50TV9H', 'A33', 'S009', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 1, 2),
(314, '0', 'A33', 'S009', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(315, '0', 'A33', 'S009', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(316, '0', 'A33', 'S009', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(317, '0', 'A33', 'S009', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(318, '0', 'A33', 'S009', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(319, '0', 'A33', 'S009', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(320, '0', 'A33', 'S009', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(321, '0', 'A33', 'S009', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(322, 'C8BL1L5H76JUW50TV9H', 'A33', 'S009', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2),
(323, '0', 'A34', 'S009', 'T001', 1, 'NO', '02', 450.00, '2019-01-21', 2, 2),
(324, '0', 'A34', 'S009', 'T001', 1, 'NO', '03', 450.00, '2019-01-21', 2, 2),
(325, '0', 'A34', 'S009', 'T001', 1, 'NO', '04', 450.00, '2019-01-21', 2, 2),
(326, '0', 'A34', 'S009', 'T001', 1, 'NO', '05', 450.00, '2019-01-21', 2, 2),
(327, '0', 'A34', 'S009', 'T001', 1, 'NO', '06', 450.00, '2019-01-21', 2, 2),
(328, '0', 'A34', 'S009', 'T001', 1, 'NO', '07', 450.00, '2019-01-21', 2, 2),
(329, '0', 'A34', 'S009', 'T001', 1, 'NO', '08', 450.00, '2019-01-21', 2, 2),
(330, '0', 'A34', 'S009', 'T001', 1, 'NO', '09', 450.00, '2019-01-21', 0, 2),
(331, '0', 'A34', 'S009', 'T001', 1, 'NO', '10', 450.00, '2019-01-21', 0, 2),
(332, 'CASBMZ6TCTAZRPPCBUZ', 'A34', 'S009', 'T001', 1, 'NO', '11', 450.00, '2019-01-21', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagosextras`
--

CREATE TABLE `pagosextras` (
  `codextra` int(11) NOT NULL,
  `numcomprobante` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codest` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cuotaunica` float(12,2) NOT NULL,
  `descuento` float(12,2) NOT NULL,
  `montomesextra` float(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pagosextras`
--

INSERT INTO `pagosextras` (`codextra`, `numcomprobante`, `codest`, `cuotaunica`, `descuento`, `montomesextra`) VALUES
(1, 'C7VXEL1QPYTE7W17Q3V', 'A1', 50.00, 0.00, 0.00),
(2, 'CTI1C9BEPP80A3UQ3MS', 'A2', 50.00, 0.00, 0.00),
(3, 'CZF1SXBFICSR0SD8XP4', 'A3', 50.00, 0.00, 0.00),
(4, 'CTDCOV3O2A1I1BESFBB', 'A4', 50.00, 0.00, 0.00),
(5, 'CMZ09M3QDKDY8SXCW9Y', 'A5', 50.00, 0.00, 0.00),
(6, 'CUGF84G5PPDYG0OWT2J', 'A6', 50.00, 0.00, 0.00),
(7, 'CQRLQU78PR6JP8LCWG8', 'A7', 50.00, 0.00, 0.00),
(8, 'CHE99XAVKLS876J5967', 'A8', 50.00, 0.00, 0.00),
(9, 'CA0D4W8OEM54UMSBX9Y', 'A9', 50.00, 0.00, 0.00),
(10, 'C8B939VCBAOHFQJ0RHM', 'A10', 50.00, 0.00, 0.00),
(11, 'C27LH414M2806VG37UZ', 'A11', 50.00, 0.00, 0.00),
(12, 'CZ6QIE5JUP83JV08BYO', 'A12', 50.00, 0.00, 0.00),
(13, 'C7JJDHROW9IPIJ59HFT', 'A13', 50.00, 0.00, 0.00),
(14, 'C4PJ9Y3S25595UWEZHC', 'A14', 50.00, 0.00, 0.00),
(15, 'CK1VP7GO12HAXIRWG2M', 'A15', 50.00, 0.00, 0.00),
(16, 'C5FX4J4YC8P4BRHAW5C', 'A16', 50.00, 0.00, 0.00),
(17, 'CY3AV9MWLO0ZZY6VDYX', 'A17', 50.00, 0.00, 0.00),
(18, 'CO6UBIM8KKQOFPHP29L', 'A18', 50.00, 0.00, 0.00),
(19, 'CF9XYSPM5MY0VYQMO17', 'A19', 50.00, 0.00, 0.00),
(20, 'CZG9I6C7AC8VRCADAO7', 'A20', 50.00, 0.00, 0.00),
(21, 'CRTSZHDEZ6IG9REO4IK', 'A21', 50.00, 0.00, 0.00),
(22, 'CC0HKOO41U958D469J2', 'A22', 50.00, 0.00, 0.00),
(23, 'C9CYIXJC8AACEPBQEVW', 'A23', 50.00, 0.00, 0.00),
(24, 'C9M4VB5MLR5E49GFOEM', 'A24', 50.00, 0.00, 0.00),
(25, 'CXDDSQU2S82C92F9L5A', 'A25', 50.00, 0.00, 0.00),
(26, 'CKWSJXRC82M8O4GHGMY', 'A26', 50.00, 0.00, 0.00),
(27, 'CYHUZ3OYIKZVWUL8CFD', 'A27', 50.00, 0.00, 0.00),
(28, 'CICLGHTD5XXAYXCAZ4Q', 'A28', 50.00, 0.00, 0.00),
(29, 'CZ419ZXQ4KG5V3IXM6Q', 'A29', 50.00, 0.00, 0.00),
(30, 'COH2AL3CVKHJT34JOU6', 'A30', 50.00, 0.00, 0.00),
(31, 'CIFQ0XP8YUS7DLWLQ48', 'A31', 50.00, 0.00, 0.00),
(32, 'CGESJU8FV81WBRSA5XK', 'A32', 50.00, 0.00, 0.00),
(33, 'C8BL1L5H76JUW50TV9H', 'A33', 50.00, 0.00, 0.00),
(34, 'CASBMZ6TCTAZRPPCBUZ', 'A34', 50.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagospormora`
--

CREATE TABLE `pagospormora` (
  `codmora` int(11) NOT NULL,
  `numcomprobante` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codest` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cantmora` int(2) NOT NULL,
  `codperiodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodoescolar`
--

CREATE TABLE `periodoescolar` (
  `codperiodo` int(11) NOT NULL,
  `periodo` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fechacreado` date DEFAULT NULL,
  `mesesactivos` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `interesmora` float(6,2) NOT NULL,
  `cuotaunica` float(12,2) NOT NULL,
  `diasvence` int(2) NOT NULL,
  `statusperiodo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `periodoescolar`
--

INSERT INTO `periodoescolar` (`codperiodo`, `periodo`, `descripcion`, `fechacreado`, `mesesactivos`, `interesmora`, `cuotaunica`, `diasvence`, `statusperiodo`) VALUES
(1, '2019', 'FEBRERO 2019 - NOVIEMBRE 2019', '2019-01-18', '02, 03, 04, 05, 06, 07, 08, 09, 10, 11', 0.00, 50.00, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `codseccion` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codnivel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codgrado` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `seccion` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`codseccion`, `codnivel`, `codgrado`, `seccion`) VALUES
('S001', 'N001', 'G001', 'A'),
('S002', 'N002', 'G002', 'A'),
('S003', 'N002', 'G002', 'B'),
('S004', 'N002', 'G003', 'A'),
('S005', 'N002', 'G003', 'B'),
('S006', 'N003', 'G004', 'A'),
('S007', 'N003', 'G004', 'B'),
('S008', 'N003', 'G005', 'A'),
('S009', 'N003', 'G005', 'B'),
('S010', 'N003', 'G006', 'A'),
('S011', 'N003', 'G006', 'B'),
('S012', 'N003', 'G007', 'A'),
('S013', 'N003', 'G007', 'B'),
('S014', 'N003', 'G008', 'A'),
('S015', 'N003', 'G008', 'B'),
('S016', 'N003', 'G009', 'A'),
('S017', 'N003', 'G009', 'B'),
('S018', 'N004', 'G010', 'A'),
('S019', 'N004', 'G010', 'B'),
('S020', 'N004', 'G011', 'A'),
('S021', 'N004', 'G011', 'B'),
('S022', 'N004', 'G012', 'A'),
('S023', 'N004', 'G012', 'B'),
('S024', 'N004', 'G013', 'A'),
('S025', 'N004', 'G013', 'B'),
('S026', 'N004', 'G014', 'A'),
('S027', 'N004', 'G014', 'B'),
('S028', 'N004', 'G015', 'A'),
('S029', 'N004', 'G015', 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `codturno` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `turno` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`codturno`, `turno`) VALUES
('T001', 'MA?ANA'),
('T002', 'TARDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL,
  `cedula` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombres` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `sexo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cargo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nivel` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `cedula`, `nombres`, `sexo`, `cargo`, `email`, `usuario`, `password`, `nivel`, `status`) VALUES
(1, '18633174', 'FRANK CORNEJO', 'MASCULINO', 'WEBMASTER', 'ELSAIYA@GMAIL.COM', 'FRANKCORNEJO', 'ef64cc3f5ac7a45829a8cdc644fff4bb65633e24', 'ADMINISTRADOR(A)', 'ACTIVO'),
(2, '9272200', 'MARBELLA PAREDES MARQUEZ', 'FEMENINO', 'ADMINISTRADORA', 'PAREDESMARQUEZMARBELLA@GMAIL.COM', 'MARBELLAPAREDES', '3721ad498dd15cea0235827e328a0f5814ece591', 'ADMINISTRADOR(A)', 'ACTIVO'),
(3, '7581145', 'NACIRA SUAREZ PARADA', 'FEMENINO', 'SECRETARIA GENERAL', 'PRECIOSA_SPAM@HOTMAIL.COM', 'SECRETARIA', 'a3b6f1eadc38565e99d5a3dc18a623a382469239', 'SECRETARIA', 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`codarea`);

--
-- Indices de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  ADD PRIMARY KEY (`codarqueo`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`codasignacion`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`codaula`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`codcaja`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`coddia`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`coddoc`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`idest`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`codgrado`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`codhorario`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`codhora`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`codmateria`);

--
-- Indices de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  ADD PRIMARY KEY (`codmovimientocaja`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`codnivel`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`codnota`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`codpadre`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`codpago`);

--
-- Indices de la tabla `pagosextras`
--
ALTER TABLE `pagosextras`
  ADD PRIMARY KEY (`codextra`);

--
-- Indices de la tabla `pagospormora`
--
ALTER TABLE `pagospormora`
  ADD PRIMARY KEY (`codmora`);

--
-- Indices de la tabla `periodoescolar`
--
ALTER TABLE `periodoescolar`
  ADD PRIMARY KEY (`codperiodo`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`codseccion`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`codturno`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  MODIFY `codarqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `codasignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `codcaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `coddoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `idest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `codhorario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  MODIFY `codmovimientocaja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `codnota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `codpadre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `codpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT de la tabla `pagosextras`
--
ALTER TABLE `pagosextras`
  MODIFY `codextra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `pagospormora`
--
ALTER TABLE `pagospormora`
  MODIFY `codmora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periodoescolar`
--
ALTER TABLE `periodoescolar`
  MODIFY `codperiodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
