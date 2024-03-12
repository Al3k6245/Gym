-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 11:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

--
-- Dumping data for table `allenamenti`
--

INSERT INTO `allenamenti` (`idA`, `nome`) VALUES
(0, 'Basic-A'),
(1, 'Basic-B');

--
-- Dumping data for table `comporre`
--

INSERT INTO `comporre` (`idA`, `idEs`, `peso`, `ripetizioni`) VALUES
(0, 2, 30, 12),
(0, 2, 30, 8),
(0, 2, 20, 10),
(0, 3, 12, 12),
(0, 3, 12, 8),
(0, 3, 8, 10),
(0, 4, 50, 10),
(0, 4, 40, 8),
(0, 4, 30, 12),
(0, 5, 0, 15),
(0, 5, 0, 12),
(0, 5, 0, 10),
(1, 6, 80, 12),
(1, 6, 70, 12),
(1, 6, 60, 12),
(1, 7, 12, 12),
(1, 7, 8, 12),
(1, 7, 8, 8),
(1, 8, 70, 12),
(1, 8, 50, 10),
(1, 8, 60, 12),
(1, 9, 40, 8),
(1, 9, 30, 12),
(1, 9, 30, 8);

--
-- Dumping data for table `esercizi`
--

INSERT INTO `esercizi` (`idEs`, `nome`, `musPrimario`, `musSecondari`, `tipoAttrezzatura`) VALUES
(1, 'Panca piana', 'Petto', '', 'Panca, bilanciere'),
(2, 'Affondi', 'Quadricipiti', 'Glutei', 'Corpo Libero'),
(3, 'Bicipiti Martello', 'Bicipite', NULL, 'Manubrio'),
(4, 'Leg Extension', 'Quadricipiti', NULL, 'Leg Extension'),
(5, 'Crunch', 'Addominali', NULL, 'Corpo Libero'),
(6, 'Leg Press', 'Quadricipiti', 'Glutei', 'Leg Press'),
(7, 'Tricipiti d.a.c', 'Tricipite', NULL, 'Manubrio'),
(8, 'Leg Curl', 'Femorale', 'Tendine del Ginocchio', 'Leg Curl(Macchina)'),
(9, 'Lat Pulldown', 'Dorsali', NULL, 'Lat(Macchina)'),
(10, 'Squat', 'Quadricipiti', 'Glutei, Tendine del Ginocchio', 'Bilanciere'),
(11, 'Stacco da Terra', 'Quadricipiti', 'Glutei, Low Back', 'Bilanciere');

--
-- Dumping data for table `serie`
--

INSERT INTO `serie` (`peso`, `ripetizioni`) VALUES
(0, 10),
(0, 12),
(0, 15),
(8, 8),
(8, 10),
(8, 12),
(12, 8),
(12, 12),
(15, 8),
(20, 10),
(30, 8),
(30, 12),
(40, 8),
(50, 3),
(50, 8),
(50, 10),
(60, 12),
(70, 12),
(75, 3),
(80, 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
