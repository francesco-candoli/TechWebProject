

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
	

INSERT INTO user (username, password, age, sex, salt)
VALUES
('marchito92','',25,'f',''),
('coolguy','',30,'m',''),
('r_lover','',22,'f','');

INSERT INTO review (content, vote, restaurant_id, publisher_id)
VALUES
('content', 2, 5, 2),
('content', 3, 7, 3),
('content', 4, 9, 3),
('content', 1, 3, 1);


INSERT INTO comment (content, review_id, publisher_id)
VALUES
('Cche sbocco di posto', 1, 1),
('condivido a pieno', 1, 1),
('Ottimo voto', 1, 1),
('mediocre', 2, 3);