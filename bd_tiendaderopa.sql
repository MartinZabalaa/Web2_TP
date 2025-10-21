-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 03:29 PM
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
-- Database: `bd_tiendaderopa`
--

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `ID_Marcas` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais_origen` varchar(150) NOT NULL,
  `importador` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`ID_Marcas`, `nombre`, `pais_origen`, `importador`) VALUES
(6, 'NIKE ', 'URUGUAY', 'FRANCIA'),
(7, 'PUMA', 'BOLIVIA', 'USA'),
(8, 'ADIDAS', 'BRASIL', 'ALEMANIA');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `ID_Productos` int(11) NOT NULL,
  `nombre_marca` varchar(150) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID_Productos`, `nombre_marca`, `modelo`, `descripcion`, `precio`, `categoria`) VALUES
(10, 'NIKE ', 'DRY FIT', 'REMERA COMODA PARA CORRER', 200000.00, 'REMERA'),
(12, 'NIKE ', 'JORDAN', 'PANTALON DE BASQUET', 200000.00, 'PANTALON'),
(13, 'NIKE ', 'DRY FIT', 'GORRA COMODA PARA HACER CUALQUIER DEPORTE', 50000.00, 'GORRA'),
(14, 'PUMA', 'NEYMAR', 'REMERA DEPORTIVA', 90000.00, 'REMERA'),
(15, 'PUMA', 'BORUSSIA', 'BOTINES QUE USABA MARADONA', 200000.00, 'ZAPATILLA'),
(16, 'PUMA', 'PUMA', 'PANTALON URBANO', 20000.00, 'PANTALON'),
(17, 'ADIDAS', 'SUPERSTAR', 'ZAPATILLAS URBANAS', 250000.00, 'ZAPATILLA'),
(18, 'ADIDAS', 'ADIDAS', 'REMERA URBANA', 50000.00, 'REMERA'),
(19, 'ADIDAS', 'BAD BUNNY', 'PANTALON CORTO URBANO', 60000.00, 'PANTALON');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `contraseña` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `nombre`, `contraseña`) VALUES
(1, 'webadmin', '$2y$10$HL9DkoPnjD6EokUx2tWyieoQEJEaDGdXrgTuziHcX7rLWkmExbra.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`ID_Marcas`),
  ADD UNIQUE KEY `UK_NombreMarca` (`nombre`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Productos`),
  ADD KEY `FK_MarcaNombre_idx` (`nombre_marca`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `ID_Marcas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_MarcaNombre` FOREIGN KEY (`nombre_marca`) REFERENCES `marcas` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
