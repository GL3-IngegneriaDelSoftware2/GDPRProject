-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 12, 2019 alle 17:01
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
  `e_name` varchar(128) NOT NULL,
  `e_description` text NOT NULL,
  `e_date_from` date NOT NULL,
  `e_date_to` date NOT NULL,
  `e_class` text NOT NULL COMMENT 'Task oppure Event',
  `e_state` text NOT NULL COMMENT 'Elenco degli id degli utenti con l''evento ancora da chiudere',
  `e_participants` text NOT NULL COMMENT 'Elenco degli id degli utenti a cui e'' rivolto l''evento',
  `e_notes` text,
  `e_actual_start` date DEFAULT NULL,
  `e_actual_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`e_id`, `e_typology`, `e_name`, `e_description`, `e_date_from`, `e_date_to`, `e_class`, `e_state`, `e_participants`, `e_notes`, `e_actual_start`, `e_actual_end`) VALUES
(1, 1, 'Corso di PHP', 'Descrizione del corso', '2019-05-07', '2019-05-12', 'Task', '5;6;7', '5;6;7', 'Portare materiale didattico', '2019-05-07', '0000-00-00'),
(2, 1, 'Corso di SQL', 'Descrizione del corso', '2019-05-08', '2019-05-29', 'Task', '5;7', '5;6;7', 'Portare pc', '2019-05-08', '0000-00-00'),
(3, 1, 'Corso di fisica', 'Descrizione del corso', '2019-02-08', '2019-02-14', 'Task', '5;6', '5;6', 'Consegnare relazione di laboratorio', '2019-02-08', '0000-00-00'),
(4, 5, 'Riunione per gita scolastica', 'Un docente parlerÃ  agli alunni', '2019-05-08', '2019-06-20', 'Task', '5;6;7', '5;6;7', 'Portare proiettore', '2019-05-08', '0000-00-00'),
(5, 2, 'Prova di evacuazione', 'Uscire dall\'aula in modo ordinato', '2019-05-20', '2019-05-20', 'Task', '5;6;7', '5;6;7', 'Veloci ma ordinati', '0000-00-00', '2019-05-20'),
(6, 4, 'Data Breach', 'Perdita dati', '2019-05-20', '2019-05-20', 'Event', '5;6;7', '5;6;7', 'Avvertire utenti', '2019-05-20', '2019-05-20'),
(7, 3, 'Riunione personale', 'Descrizione della riunione', '2019-05-20', '2019-05-26', 'Task', '5;6;7', '5;6;7', 'Non ci sono note per questo evento', '2019-05-20', '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `event_typologies`
--

CREATE TABLE `event_typologies` (
  `et_id` int(11) NOT NULL,
  `et_name` varchar(128) NOT NULL,
  `et_priority` int(11) NOT NULL COMMENT 'Intero in range 1-5 inclusi',
  `et_early_notification` int(11) NOT NULL COMMENT 'Tempo espresso in ore',
  `et_event_repeat` varchar(20) NOT NULL COMMENT 'don''t repeat, daily, weekly, monthly, yearly',
  `et_color` varchar(20) NOT NULL COMMENT 'Colore in formato HEX'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `event_typologies`
--

INSERT INTO `event_typologies` (`et_id`, `et_name`, `et_priority`, `et_early_notification`, `et_event_repeat`, `et_color`) VALUES
(1, 'Corso di formazione', 2, 48, 'weekly', '#ff0000'),
(2, 'Corso sulla sicurezza', 3, 48, 'weekly', '#00ff00'),
(3, 'Riunione personale accademico', 3, 48, 'daily', '#0000ff'),
(4, 'Segnalazione data breach', 4, 24, 'don\'t repeat', '#ff0000'),
(5, 'Riunione docenti', 2, 24, 'weekly', '#ffcc33');

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
  `u_is_admin` tinyint(1) NOT NULL,
  `u_email` varchar(100) NOT NULL COMMENT 'Univoca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_password`, `u_is_admin`, `u_email`) VALUES
(5, 'lucap', '5cd7fa01cc2c7aaa923775b1a9f011d2', 0, 'lucap@gmail.com'),
(6, 'lucab', '04703a9cdb6a13b411b351f32aad95b2', 0, 'lucab@gmail.com'),
(7, 'gianlu', '77df21256ea08f5747765c588686aa4c', 0, 'gianlu@gmail.com'),
(8, 'lucap2', 'e8e824d662899fc68ae4d114c484c119', 0, 'lucap2@gmail.com'),
(9, 'lucap3', '4c827852eb4734553eefd039d7bb9b1e', 0, 'lucap3@gmail.com');

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
  ADD UNIQUE KEY `e_name` (`e_name`),
  ADD KEY `e_typology` (`e_typology`);

--
-- Indici per le tabelle `event_typologies`
--
ALTER TABLE `event_typologies`
  ADD PRIMARY KEY (`et_id`),
  ADD UNIQUE KEY `et_name` (`et_name`);

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
  MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
