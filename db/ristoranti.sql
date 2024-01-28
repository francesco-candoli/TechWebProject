-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 28, 2024 alle 16:28
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ristoranti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `review_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`id`, `content`, `review_id`, `publisher_id`) VALUES
(1, 'Cche sbocco di posto', 1, 1),
(2, 'condivido a pieno', 1, 1),
(3, 'Ottimo voto', 1, 1),
(4, 'mediocre', 2, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `follow`
--

CREATE TABLE `follow` (
  `following_user_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `follow`
--

INSERT INTO `follow` (`following_user_id`, `followed_user_id`) VALUES
(1, 2),
(1, 3);

--
-- Trigger `follow`
--
DELIMITER $$
CREATE TRIGGER `FollowNotification` AFTER INSERT ON `follow` FOR EACH ROW BEGIN
    declare new_notification_id int;
    SET @new_notification_id := (SELECT MAX(id) FROM notification);
    INSERT INTO notification VALUES ((@new_notification_id+1),CONCAT("L'utente ",(SELECT username FROM user WHERE id=NEW.following_user_id)," ha iniziato a seguirti"),CONCAT('profile/',(SELECT username FROM user WHERE id=NEW.following_user_id)));
    INSERT INTO has_notification (user_id, notification_id) VALUES (NEW.followed_user_id, (@new_notification_id +1));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `has_notification`
--

CREATE TABLE `has_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `has_notification`
--

INSERT INTO `has_notification` (`id`, `user_id`, `notification_id`) VALUES
(1, 3, 2),
(5, 1, 8),
(6, 1, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `like_actions`
--

CREATE TABLE `like_actions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `like_actions`
--

INSERT INTO `like_actions` (`id`, `user_id`, `review_id`) VALUES
(8, 1, 2),
(10, 1, 2),
(11, 2, 4),
(12, 3, 4);

--
-- Trigger `like_actions`
--
DELIMITER $$
CREATE TRIGGER `LikeNotification` AFTER INSERT ON `like_actions` FOR EACH ROW BEGIN
	DECLARE new_notification_id INT;
    SET @new_notification_id := (SELECT MAX(id) FROM notification);
    INSERT INTO notification (id,content,url) VALUES((@new_notification_id+1), CONCAT('L utente',(SELECT username FROM user WHERE id=NEW.user_id),'ti ha messo like alla recensione del ristorante:  ',(SELECT name FROM restaurant WHERE id=(SELECT restaurant_id FROM review WHERE id=NEW.review_id))), CONCAT('profile/',(SELECT username FROM user WHERE id=NEW.user_id)));
    INSERT INTO has_notification (user_id, notification_id) VALUES ((SELECT publisher_id FROM review WHERE id=NEW.review_id), (@new_notification_id+1));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1705659822'),
(1, '1705659880'),
(1, '1705659940'),
(1, '1705659942'),
(1, '1705659960');

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO `notification` (`id`, `content`, `url`) VALUES
(2, 'L utente1ti ha messo like alla recensione: 2', ''),
(8, 'L utentemarchito92ti ha messo like alla recensione: 4', ''),
(9, 'L utentecoolguyti ha messo like alla recensione del ristorante:  Uliassi', 'profile/coolguy');

-- --------------------------------------------------------

--
-- Struttura della tabella `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `src` varchar(250) NOT NULL,
  `alt` varchar(100) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `photo`
--

INSERT INTO `photo` (`id`, `src`, `alt`, `review_id`) VALUES
(1, 'public/images/review/persone.jpg', '.', 1),
(2, 'public/images/review/persone.jpg', '.', 2),
(3, 'public/images/review/risto.jpg', '.', 1),
(4, 'public/images/review/risto.jpg', '.', 2),
(5, 'public/images/review/grtgrthh5h.jpg', '.', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`) VALUES
(1, 'Pasha', 'Via Roma, 1'),
(2, 'La Cucina Napoletana', 'Via Garibaldi, 2'),
(3, 'Uliassi', 'Via Dante, 3'),
(4, 'Il Giardino', 'Via Mazzini, 4'),
(5, 'Asinello', 'Via Vittorio Emanuele, 5'),
(6, 'Pergola', 'Via XX Settembre, 6'),
(7, 'Piazzetta Milu', 'Via San Giovanni, 7'),
(8, 'La Bottega Gourmet', 'Via dei Mille, 8'),
(9, 'Da Vittorio', 'Via Cantalupa, 17'),
(10, 'Osteria Francescana', 'Via Stella, 22');

-- --------------------------------------------------------

--
-- Struttura della tabella `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `vote` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `review`
--

INSERT INTO `review` (`id`, `content`, `vote`, `restaurant_id`, `publisher_id`) VALUES
(1, 'content', 2, 5, 2),
(2, 'content', 3, 7, 3),
(3, 'content', 4, 9, 3),
(4, 'content', 1, 3, 1);

--
-- Trigger `review`
--
DELIMITER $$
CREATE TRIGGER `ReviewNotification` AFTER INSERT ON `review` FOR EACH ROW BEGIN
	declare done int DEFAULT false;
    declare ids int;
    declare new_notification_id int;
    declare cur cursor for SELECT following_user_id FROM follow WHERE followed_user_id= NEW.publisher_id;
    set @new_notification_id := (SELECT MAX(id) FROM notification);
            insert into notification VALUES((@new_notification_id+1),CONCAT("L'utente: ",(SELECT username FROM user WHERE id=NEW.publisher_id)," ha pubblicato una nuova recensione"),'');
            
    OPEN cur;
    	ins_loop: LOOP
        	FETCH cur INTO ids;
            if done THEN
            	LEAVE ins_loop;
            end IF;
            insert into has_notification (user_id, notification_id) VALUES (ids,(@new_notification_id)); 
        end loop;
    close cur;
            	
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(512) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` char(1) NOT NULL,
  `profile_image_src` varchar(500) NOT NULL,
  `salt` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `age`, `sex`, `profile_image_src`, `salt`) VALUES
(1, 'test_user', 'a07083acd458db60b73fb9c54a27ad9dcf894cdddea74b1a8683279d6f0f94c6771417736dba549de3a4026b62ee464b5e4bb48c8c2a3d188f9e286a3f9eb286', 807432, 'f', 'public/images/profile/1.jpg', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'),
(2, 'marchito92', '', 25, 'f', 'public/images/profile/1.jpg', ''),
(3, 'coolguy', '', 30, 'm', 'public/images/profile/1.jpg', ''),
(4, 'r_lover', '', 22, 'f', 'public/images/profile/1.jpg', '');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indici per le tabelle `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`following_user_id`,`followed_user_id`),
  ADD KEY `follow_ibfk_2` (`followed_user_id`);

--
-- Indici per le tabelle `has_notification`
--
ALTER TABLE `has_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Indici per le tabelle `like_actions`
--
ALTER TABLE `like_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indici per le tabelle `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indici per le tabelle `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `has_notification`
--
ALTER TABLE `has_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `like_actions`
--
ALTER TABLE `like_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

--
-- Limiti per la tabella `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`following_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`followed_user_id`) REFERENCES `user` (`id`);

--
-- Limiti per la tabella `has_notification`
--
ALTER TABLE `has_notification`
  ADD CONSTRAINT `has_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `has_notification_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`id`);

--
-- Limiti per la tabella `like_actions`
--
ALTER TABLE `like_actions`
  ADD CONSTRAINT `like_actions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `like_actions_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

--
-- Limiti per la tabella `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`);

--
-- Limiti per la tabella `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
