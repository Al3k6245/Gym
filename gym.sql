-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 29, 2024 alle 22:45
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

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

-- --------------------------------------------------------

--
-- Struttura della tabella `abbonamenti`
--

CREATE TABLE `abbonamenti` (
  `nome` enum('Basic','Gold','Platinum','Premium') NOT NULL,
  `costoMensile` float NOT NULL,
  `descrizione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `abbonamenti`
--

INSERT INTO `abbonamenti` (`nome`, `costoMensile`, `descrizione`) VALUES
('Basic', 10, 'L\'abbonamento base della palestra');

-- --------------------------------------------------------

--
-- Struttura della tabella `allenamenti`
--

CREATE TABLE `allenamenti` (
  `idA` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tempo` time NOT NULL,
  `imgA` blob DEFAULT NULL,
  `volumeTot` float NOT NULL,
  `username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `allenatori`
--

CREATE TABLE `allenatori` (
  `username` varchar(40) NOT NULL,
  `codF` varchar(16) DEFAULT NULL,
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `numTel` varchar(10) NOT NULL,
  `imgProfilo` blob DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `psw` char(64) NOT NULL,
  `docIdentificativi` blob NOT NULL,
  `attCertificazione` blob NOT NULL,
  `valutazione` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `attrezzatura`
--

CREATE TABLE `attrezzatura` (
  `codSerie` varchar(30) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `marca` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `comporre`
--

CREATE TABLE `comporre` (
  `idA` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `ripetizioni` int(11) NOT NULL,
  `idEs` int(11) NOT NULL,
  `dataA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

CREATE TABLE `esercizi` (
  `idEs` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `musPrimario` varchar(30) NOT NULL,
  `musSecondari` varchar(255) DEFAULT NULL,
  `tipoAttrezzatura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritto`
--

CREATE TABLE `iscritto` (
  `codF` varchar(16) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `DataN` date NOT NULL,
  `numTel` varchar(10) NOT NULL,
  `imgProfilo` blob DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `psw` char(64) DEFAULT NULL,
  `docIdentificativi` blob DEFAULT NULL,
  `certificatoMedico` blob DEFAULT NULL,
  `tipoAbbonamento` enum('Basic','Gold','Platinum','Premium') NOT NULL,
  `username` varchar(40) NOT NULL,
  `ScadenzaAbb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `iscritto`
--

INSERT INTO `iscritto` (`codF`, `nome`, `cognome`, `DataN`, `numTel`, `imgProfilo`, `mail`, `psw`, `docIdentificativi`, `certificatoMedico`, `tipoAbbonamento`, `username`, `ScadenzaAbb`) VALUES
('SCHLSN05B840LW', 'Alessandro', 'Schievano', '2005-02-17', '+393460810', NULL, NULL, NULL, NULL, NULL, 'Basic', '', '2024-04-10'),
('KSADI132ASD', 'Leonardo', 'Serpelloni', '2005-12-26', '+398526745', NULL, NULL, NULL, NULL, NULL, 'Basic', 'Serpe05', '2024-04-10');

-- --------------------------------------------------------

--
-- Struttura della tabella `riparazioniinstallazioni`
--

CREATE TABLE `riparazioniinstallazioni` (
  `username` varchar(40) NOT NULL,
  `codAtt` varchar(30) NOT NULL,
  `dataUltimaRipInst` date DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `serie`
--

CREATE TABLE `serie` (
  `peso` int(11) NOT NULL,
  `ripetizioni` int(11) NOT NULL,
  `livAffaticamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tecnici`
--

CREATE TABLE `tecnici` (
  `username` varchar(40) NOT NULL,
  `codF` varchar(16) DEFAULT NULL,
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `numTel` varchar(10) NOT NULL,
  `imgProfilo` blob DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `psw` char(64) NOT NULL,
  `docIdentificativi` blob NOT NULL,
  `qualificheProfessionali` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `turno`
--

CREATE TABLE `turno` (
  `giornoSettimana` enum('Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica') NOT NULL,
  `username` varchar(40) NOT NULL,
  `oraInizio` time NOT NULL,
  `oraFine` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abbonamenti`
--
ALTER TABLE `abbonamenti`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `allenamenti`
--
ALTER TABLE `allenamenti`
  ADD PRIMARY KEY (`idA`),
  ADD KEY `username` (`username`);

--
-- Indici per le tabelle `allenatori`
--
ALTER TABLE `allenatori`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `attrezzatura`
--
ALTER TABLE `attrezzatura`
  ADD PRIMARY KEY (`codSerie`);

--
-- Indici per le tabelle `comporre`
--
ALTER TABLE `comporre`
  ADD PRIMARY KEY (`idA`,`peso`,`ripetizioni`,`idEs`),
  ADD KEY `peso` (`peso`,`ripetizioni`),
  ADD KEY `idEs` (`idEs`);

--
-- Indici per le tabelle `esercizi`
--
ALTER TABLE `esercizi`
  ADD PRIMARY KEY (`idEs`);

--
-- Indici per le tabelle `iscritto`
--
ALTER TABLE `iscritto`
  ADD PRIMARY KEY (`username`),
  ADD KEY `tipoAbbonamento` (`tipoAbbonamento`);

--
-- Indici per le tabelle `riparazioniinstallazioni`
--
ALTER TABLE `riparazioniinstallazioni`
  ADD PRIMARY KEY (`username`,`codAtt`),
  ADD KEY `codAtt` (`codAtt`);

--
-- Indici per le tabelle `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`peso`,`ripetizioni`);

--
-- Indici per le tabelle `tecnici`
--
ALTER TABLE `tecnici`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`giornoSettimana`,`username`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `allenamenti`
--
ALTER TABLE `allenamenti`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `idEs` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `allenamenti`
--
ALTER TABLE `allenamenti`
  ADD CONSTRAINT `allenamenti_ibfk_1` FOREIGN KEY (`username`) REFERENCES `iscritto` (`username`);

--
-- Limiti per la tabella `comporre`
--
ALTER TABLE `comporre`
  ADD CONSTRAINT `comporre_ibfk_1` FOREIGN KEY (`idA`) REFERENCES `allenamenti` (`idA`),
  ADD CONSTRAINT `comporre_ibfk_2` FOREIGN KEY (`peso`,`ripetizioni`) REFERENCES `serie` (`peso`, `ripetizioni`),
  ADD CONSTRAINT `comporre_ibfk_3` FOREIGN KEY (`idEs`) REFERENCES `esercizi` (`idEs`);

--
-- Limiti per la tabella `iscritto`
--
ALTER TABLE `iscritto`
  ADD CONSTRAINT `iscritto_ibfk_1` FOREIGN KEY (`tipoAbbonamento`) REFERENCES `abbonamenti` (`nome`);

--
-- Limiti per la tabella `riparazioniinstallazioni`
--
ALTER TABLE `riparazioniinstallazioni`
  ADD CONSTRAINT `riparazioniinstallazioni_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tecnici` (`username`),
  ADD CONSTRAINT `riparazioniinstallazioni_ibfk_2` FOREIGN KEY (`codAtt`) REFERENCES `attrezzatura` (`codSerie`);

--
-- Limiti per la tabella `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `turno_ibfk_1` FOREIGN KEY (`username`) REFERENCES `allenatori` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
