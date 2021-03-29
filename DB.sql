-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mar 29, 2021 alle 04:37
-- Versione del server: 10.3.28-MariaDB-log-cll-lve
-- Versione PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dilaxzzk_bnpbankdb`
--
CREATE DATABASE IF NOT EXISTS `dilaxzzk_bnpbankdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dilaxzzk_bnpbankdb`;

-- --------------------------------------------------------

--
-- Struttura della tabella `bonifico`
--

CREATE TABLE `bonifico` (
  `bonifico_id` int(11) NOT NULL,
  `bonifico_data` date DEFAULT NULL,
  `bonifico_quantita` float DEFAULT NULL,
  `client_reconazition` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `bonifico`
--

INSERT INTO `bonifico` (`bonifico_id`, `bonifico_data`, `bonifico_quantita`, `client_reconazition`) VALUES
(9, '2021-04-07', 1200, 12),
(10, '2021-04-16', 10000, 12),
(11, '2021-05-21', 5000, 12),
(12, '2021-05-21', 800, 12),
(13, '2021-03-26', 100000, 13),
(14, '2021-01-10', 25, 12),
(15, '2021-01-11', 25000, 12),
(16, '2021-01-11', 25000, 12),
(17, '2021-01-11', 25000, 14),
(18, '2021-03-26', 50000, 15),
(19, '2021-03-27', 395000, 16),
(20, '2021-01-11', 5000, 17),
(21, '2021-01-11', 5000, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(150) DEFAULT NULL,
  `client_subname` varchar(150) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `client_email` varchar(150) DEFAULT NULL,
  `client_phone` varchar(150) DEFAULT NULL,
  `payemnt_due` date DEFAULT NULL,
  `date_client` date DEFAULT NULL,
  `client_adress` varchar(150) DEFAULT NULL,
  `client_tax` varchar(150) DEFAULT NULL,
  `tax_label` varchar(150) DEFAULT NULL,
  `hide_per` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_subname`, `username`, `password`, `client_email`, `client_phone`, `payemnt_due`, `date_client`, `client_adress`, `client_tax`, `tax_label`, `hide_per`) VALUES
(13, 'Davide', 'Luciano ', 'denis@gmail.com', '12345', 'denis@gmail.com', '2233333', '2021-03-26', '2021-03-26', 'via via', '10', 'Regime Dichiarativo', 0),
(14, 'Federico ', 'Boldrini ', 'fedebold68@gmail.com', 'RKG0712?', 'fedebold68@gmail.com', '+39 3332968656', '2021-04-09', '2021-01-10', 'ITALY', '13', 'Regime Amministrato', 0),
(15, ' paolo', 'berton', 'paolo12@gmail.com', 'paolo12', 'paolo12@gmail.com', '3463564326', '2021-03-27', '1970-01-01', 'via garibaldi', '15', 'Regime Dichiarativo', 0),
(16, 'Giuliano ', 'Rech', 'giuliano.rech@alice.it', 'RKG0712?', 'giuliano.rech@alice.com', '3403951163', '2021-04-09', '2021-03-27', 'Via del Piazzo 14/A', '0', 'Tax', 0),
(17, 'Susanna ', 'Vidoni', 'susannavidoni@hotmail.it', 'RKG0712?', 'susannavidoni@hotmail.it', '+39 3394799135', '2021-04-02', '2021-01-11', 'ITALY', '16', 'Regime Dichiarativo', 0),
(18, 'Mihaela', 'Filimon', 'filimonmhiaela@gmail.com ', 'RKG0712?', 'filimonmhiaela@gmail.com ', '393203867713', '2021-04-02', '2021-01-11', 'Italy', '16', 'Regime Dichiarativo', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `importo`
--

CREATE TABLE `importo` (
  `importo_id` int(11) NOT NULL,
  `importo_amount` float DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `importo`
--

INSERT INTO `importo` (`importo_id`, `importo_amount`, `cliente_id`) VALUES
(10, 9000, 12),
(11, 500, 12),
(12, 70000, 13),
(15, 24200, 14),
(16, 1000, 15),
(17, 25719, 17),
(18, 12460, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `prelievo`
--

CREATE TABLE `prelievo` (
  `prelievo_id` int(11) NOT NULL,
  `beneficario` varchar(150) DEFAULT NULL,
  `swift` varchar(250) DEFAULT NULL,
  `importo` float DEFAULT NULL,
  `iban` varchar(250) DEFAULT NULL,
  `causale` varchar(150) DEFAULT NULL,
  `citta` varchar(150) DEFAULT NULL,
  `stato` varchar(150) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prelievo`
--

INSERT INTO `prelievo` (`prelievo_id`, `beneficario`, `swift`, `importo`, `iban`, `causale`, `citta`, `stato`, `client_id`) VALUES
(4, 'Artan Aconi', 'Swift', 500, 'IBAN', 'Causale', 'Citta', 'Stato', 12),
(5, ' paolo berton', 'nhfghdf', 51000, 'dfgfdgfdgfdgdf', '12132', 'mi', 'it', 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `website_on_of` int(1) DEFAULT 0,
  `secretpass` varchar(50) DEFAULT NULL,
  `user_username` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_subname` varchar(100) DEFAULT NULL,
  `livello` int(11) DEFAULT NULL,
  `unlocks` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`user_id`, `website_on_of`, `secretpass`, `user_username`, `user_password`, `user_name`, `user_subname`, `livello`, `unlocks`) VALUES
(1, 0, 'test', 'support@paribas.com', '156@wpar7#44', 'Paribas Bank', 'Administration', 1, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bonifico`
--
ALTER TABLE `bonifico`
  ADD PRIMARY KEY (`bonifico_id`);

--
-- Indici per le tabelle `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indici per le tabelle `importo`
--
ALTER TABLE `importo`
  ADD PRIMARY KEY (`importo_id`);

--
-- Indici per le tabelle `prelievo`
--
ALTER TABLE `prelievo`
  ADD PRIMARY KEY (`prelievo_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bonifico`
--
ALTER TABLE `bonifico`
  MODIFY `bonifico_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `importo`
--
ALTER TABLE `importo`
  MODIFY `importo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `prelievo`
--
ALTER TABLE `prelievo`
  MODIFY `prelievo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
