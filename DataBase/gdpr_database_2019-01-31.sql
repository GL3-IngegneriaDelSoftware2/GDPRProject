-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 31, 2019 alle 17:08
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

--
-- Dump dei dati per la tabella `document_manager`
--

INSERT INTO `document_manager` (`dm_id`, `dm_link_to_file`, `dm_name`, `dm_section`, `dm_tags`, `dm_version`) VALUES
(1, 'link', 'DocumentoXXYY', 'Documenti Segreti', 'Privacy, Musica, GDPR', '0.9.75'),
(2, 'http.iuewfuewf', 'Doc345', 'Banana', 'Hardware, Musica, Robots', '98.9.75234'),
(3, 'bbb', 'a', 'ciao', 'bo, bo1, bo3', '09.87.888.292');

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE `events` (
  `e_id` int(11) NOT NULL,
  `e_typology` int(5) NOT NULL,
  `e_name` text NOT NULL,
  `e_description` text NOT NULL,
  `e_date_from` date NOT NULL,
  `e_date_to` date NOT NULL,
  `e_class` text NOT NULL,
  `e_state` text NOT NULL,
  `e_notes` text,
  `e_participants` text,
  `e_actual_start` date DEFAULT NULL,
  `e_actual_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`e_id`, `e_typology`, `e_name`, `e_description`, `e_date_from`, `e_date_to`, `e_class`, `e_state`, `e_notes`, `e_participants`, `e_actual_start`, `e_actual_end`) VALUES
(6, 1, 'corso di nuoto', 'Nuotare nuotare nuotare', '2019-01-01', '2019-01-31', 'Corso', 'Aperto', 'Nessuna nota', '', '0000-00-00', '0000-00-00'),
(7, 1, 'Corso di PHP', 'Fia tanti test', '2019-01-23', '2019-02-06', 'Corso', 'Aperto', '', 'Io e te', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `event_typologies`
--

CREATE TABLE `event_typologies` (
  `et_id` int(5) NOT NULL,
  `et_name` text NOT NULL,
  `et_priority` int(11) NOT NULL COMMENT 'Intero in range 1-5 inclusi',
  `et_early_notification` int(11) NOT NULL COMMENT 'Tempo espresso in ore',
  `et_event_repeat` varchar(20) NOT NULL COMMENT 'giornaliero, settimanale, mensile, annuale'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `event_typologies`
--

INSERT INTO `event_typologies` (`et_id`, `et_name`, `et_priority`, `et_early_notification`, `et_event_repeat`) VALUES
(1, 'Corso di formazione', 2, 48, '100');

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

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_username` varchar(100) NOT NULL COMMENT 'Univoco',
  `u_password` varchar(100) NOT NULL COMMENT 'Minimo 8 caratteri',
  `u_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_password`, `u_email`) VALUES
(1, 'el_bomber', '25f9e794323b453885f5181f1b624d0b', 'b@gmail.com');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `document_manager`
--
ALTER TABLE `document_manager`
  ADD PRIMARY KEY (`dm_id`);

--
-- Indici per le tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `e_typology` (`e_typology`);

--
-- Indici per le tabelle `event_typologies`
--
ALTER TABLE `event_typologies`
  ADD PRIMARY KEY (`et_id`);

--
-- Indici per le tabelle `potential_breach`
--
ALTER TABLE `potential_breach`
  ADD PRIMARY KEY (`pb_code`),
  ADD KEY `FOREIGN KEY` (`pb_related_document`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_username` (`u_username`(40));

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `document_manager`
--
ALTER TABLE `document_manager`
  MODIFY `dm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `event_typologies`
--
ALTER TABLE `event_typologies`
  MODIFY `et_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`e_typology`) REFERENCES `event_typologies` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `potential_breach`
--
ALTER TABLE `potential_breach`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`pb_related_document`) REFERENCES `document_manager` (`dm_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
