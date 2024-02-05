--
-- Dump dei dati per la tabella `restaurant`
--
INSERT INTO restaurant (name, address)
VALUES
('Pasha' , 'Via Roma, 1'),
('La Cucina Napoletana', 'Via Garibaldi, 2'),
('Uliassi', 'Via Dante, 3'),
('Il Giardino', 'Via Mazzini, 4'),
('Asinello', 'Via Vittorio Emanuele, 5'),
('Pergola', 'Via XX Settembre, 6'),
('Piazzetta Milu', 'Via San Giovanni, 7'),
('La Bottega Gourmet', 'Via dei Mille, 8'),
('Da Vittorio', 'Via Cantalupa, 17'),
('Osteria Francescana', 'Via Stella, 22');
	
--
-- Dump dei dati per la tabella `user`
--
INSERT INTO user (username, password, age, sex, profile_image_src, salt)
VALUES
('checco_candoli','c2f03e3c103c067e86ea25d9804525a4d45659b374230affd7541a193dcf4c4ccecd54747eae2ee9f8622ae4906c33b5b89db4bf7729f237d0ce5312bf8c3438',21,'M','public/images/profile/persona2.jpg','a137615ea3aa77c35595667d0401d5730965576424299051ed809a84ed93a08d999611d3b6c49cb06cecac11f0d117d6ea12415a7c0bd0aca765626bd050022c'),
('giangian','f6b7203338915d320c97958e6623dbbf4b163fe7fd6b0eccc2b90dce944ae42e56f3a31bd250420ee2e58cbdf636853ec60c3b1cfd999df81bdd9e7bd384964d',21,'M','public/images/profile/persona4.jpg','90fb1b24c37f426f453c2eae917d32bd46730339ebe85518c1ee6e35caf5350db3bb62ec70f5db0ce9756ba20032a665180d145452d7b37eb2785c205fbce364'),
('Vitto12xoxo','b53d3ab5fe7e6a2902baa2e9b09a9d869685d849d5949a637c5f2eb21273ef564a05e31057a4d224a0f57854b1986f48a31d1888cfab95c88ed3a4673dca1867',27,'F','public/images/profile/persona1.jpg','19ce4a49b8a6c517747250a57db4fc98a0d4a5a03a2287e9d5822ca7704650dd522fb62617eebb801fa9fc3ac96c5ee1920e67165be1b8e9f8d988ce4caf78db'),
('TheBestFoodReviewer','203c43aecea6f922313fc8cdf2b0a46f693755aebdcac9a7fadd52f1454c6d27f2835e5a4d9eadeb7fe717ef24b20ef006186f6be7fc8c2719732da541f723a6',17,'F','public/images/profile/persona3.jpg','c521dfa062adb9785c165ae08555da4b10c7a72676ef58704ee7497c11ab3d9b40a31350926e32f56f3962fd29a968e91dcf553df29476eb3de2b031d79bc434'),
('GInEtta45','4afaa2504e8e1ae03b1d32c6aba7fa513be34c0cb4ce40744271301a2c9b1cc3481e9302eb8caf04942cb78583f9783e4a33fc0d98b99faa0880adcf7c9bab82',30,'F','public/images/profile/persona5.jpg','0e8ea5313e794facb0c30cfff0d2ba5c2061f584f847f8fcffe63d5a73fe217aa151a05af256d66552d64b2c205186f2c5af0c7771dc6633b6bc2a25bbfd1477');

--
-- Dump dei dati per la tabella `review`
--
INSERT INTO review (content, vote, restaurant_id, publisher_id, date)
VALUES
('Esperienza culinaria straordinaria! Il ristorante ha saputo stupirci con piatti creativi e deliziosi. Il personale era attento e cordiale, creando un atmosfera accogliente che ha reso la serata indimenticabile.', 5, 2, 1,"2024-01-12"),
('Ottima scelta per una cena romantica! Atmosfera romantica e rilassata, il cibo è delizioso e il personale è attento a ogni dettaglio. Consiglio vivamente questo posto per un esperienza indimenticabile.', 4, 3, 1, "2024-01-01"),
('Abbiamo avuto un esperienza sgradevole. I piatti erano troppo salati e il servizio era scadente.', 2, 5, 2, "2024-01-09"),
('Purtroppo, esperienza deludente. Il cibo non ha soddisfatto le aspettative e sembrava poco fresco. Il servizio era lento e il personale sembrava poco interessato alle esigenze dei clienti.', 1, 1, 3, "2024-01-07"),
('Il ristorante offre un eccellente selezione di vini che si sposa perfettamente con la cucina raffinata.', 3, 4, 4, "2024-01-13"),
('Un autentica esperienza gastronomica! La cucina è un mix perfetto di sapori e tradizioni, con una varietà di piatti che soddisfano ogni palato. Il ristorante ha conquistato il mio cuore e sicuramente tornerò!', 5, 3, 5, "2024-01-30"),
('Cibo nella norma ma niente di che', 3, 2, 1, "2024-01-13"),
('Questo ristorante è diventato il mio preferito in città! La freschezza degli ingredienti si riflette nei piatti deliziosi e ben presentati. Il servizio è stato impeccabile, rendendo la serata assolutamente piacevole', 4, 6, 3, "2024-01-24"),
('Una delusione totale. Il cibo sembrava essere stato preparato in fretta, senza cura per i dettagli. Ambiente era rumoroso e caotico.', 1, 9, 1, "2024-01-27"),
('Non mi è piaciuto', 2, 1, 2, "2024-01-12");

--
-- Dump dei dati per la tabella `photo`
--
INSERT INTO photo (src, alt, review_id) VALUES
('public/images/review/revPhoto1.jpg', 'standard-alt', 1),
('public/images/review/revPhoto2.jpg', 'standard-alt', 1),
('public/images/review/revPhoto3.jpg', 'standard-alt', 1),
('public/images/review/revPhoto4.jpg', 'standard-alt', 2),
('public/images/review/revPhoto5.jpg', 'standard-alt', 2),
('public/images/review/revPhoto6.jpg', 'standard-alt', 3),
('public/images/review/revPhoto7.jpg', 'standard-alt', 3),
('public/images/review/revPhoto8.jpg', 'standard-alt', 4),
('public/images/review/revPhoto9.jpg', 'standard-alt', 4),
('public/images/review/revPhoto10.jpg', 'standard-alt', 5),
('public/images/review/revPhoto11.jpg', 'standard-alt', 6),
('public/images/review/revPhoto12.jpg', 'standard-alt', 7),
('public/images/review/revPhoto13.jpg', 'standard-alt', 8),
('public/images/review/revPhoto14.jpg', 'standard-alt', 8),
('public/images/review/revPhoto15.jpg', 'standard-alt', 9),
('public/images/review/revPhoto16.jpg', 'standard-alt', 10),
('public/images/review/revPhoto17.jpg', 'standard-alt', 10);

--
-- Dump dei dati per la tabella `comment`
--
INSERT INTO comment (content, review_id, publisher_id)
VALUES
('Sono in accordo con te', 1, 4),
('Assolutamente! Freschezza e delizia', 3, 5),
('Concordo!!!', 3, 2),
('Sì, perfetta cena romantica.', 7, 1),
('Per me brutta location', 5, 2),
('Con me il cameriere è stato sgarbato', 6, 3),
('a me ispira', 7, 4),
('Ci andrei', 8, 5),
('WOW non immaginavo', 9, 1),
('Follow 4 Follow', 10, 2),
('Like meritato', 3, 3),
('che sbocco', 1, 1),
('complimentoni al ristoratore', 8, 2),
('io ho lo sconto lì XD', 8, 4),
('che bel posto', 10, 2),
('Prova a tornarci e cambierai idea', 3, 1);

--
-- Dump dei dati per la tabella `follow`
--
INSERT INTO follow (following_user_id, followed_user_id) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 3),
(2, 1),
(3, 1),
(2, 4),
(2, 5),
(3, 2),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1);

--
-- Dump dei dati per la tabella `like_actions`
--
INSERT INTO like_actions (user_id, review_id) VALUES
(1, 2),
(1, 3),
(1, 6),
(1, 8),
(2, 1),
(2, 10),
(2, 8),
(3, 1),
(3, 2),
(3, 2),
(3, 3),
(4, 7),
(5, 2),
(5, 1),
(5, 9),
(5, 10);


--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO notification (content, url) VALUES
('L utente Vitto12xoxo ti ha messo like alla recensione del ristorante: Pasha', 'profile/Vitto12xoxo'),
('L utente giangian ha iniziato a seguirti', 'profile/giangian/'),
('L utente giangian ti ha messo like alla recensione del ristorante:  Uliassi', 'profile/giangian/');


--
-- Dump dei dati per la tabella `has_notification`
--
INSERT INTO has_notification (user_id, notification_id) VALUES
(1, 1),
(1, 2),
(1, 3);

--
-- Dump dei dati per la tabella `login_attempts`
--
INSERT INTO login_attempts (user_id, time) VALUES
(1, '1705659822'),
(1, '1705659880'),
(1, '1705659940'),
(1, '1705659942'),
(1, '1705659960');
