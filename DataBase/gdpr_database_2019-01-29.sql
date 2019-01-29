-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 29, 2019 alle 14:08
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gdpr_database`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `document_manager`
--

CREATE TABLE `document_manager` (
  `dm_id` int(11) NOT NULL,
  `dm_link_to_file` text NOT NULL,
  `dm_name` text NOT NULL,
  `dm_section` text NOT NULL,
  `dm_tags` text,
  `dm_version` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `potential_breach`
--

CREATE TABLE `potential_breach` (
  `pb_code` int(11) NOT NULL,
  `pb_date` date NOT NULL,
  `pb_description` text NOT NULL,
  `pb_analysys_outcome` text NOT NULL,
  `pb_aftermath` text NOT NULL,
  `pb_measures_adopted` text,
  `pb_is_system_admin` tinyint(1) NOT NULL,
  `pb_authority_notification` tinyint(1) NOT NULL,
  `pb_authority_notification_date` date DEFAULT NULL,
  `pb_authority_notification_references` text,
  `pb_interested_parties_notification` tinyint(1) NOT NULL,
  `pb_interested_parties_notification_date` date DEFAULT NULL,
  `pb_interested_parties_notification_references` text,
  `pb_related_document` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `document_manager`
--
ALTER TABLE `document_manager`
  ADD PRIMARY KEY (`dm_id`);

--
-- Indici per le tabelle `potential_breach`
--
ALTER TABLE `potential_breach`
  ADD PRIMARY KEY (`pb_code`),
  ADD KEY `FOREIGN KEY` (`pb_related_document`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `document_manager`
--
ALTER TABLE `document_manager`
  MODIFY `dm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `potential_breach`
--
ALTER TABLE `potential_breach`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`pb_related_document`) REFERENCES `document_manager` (`dm_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
