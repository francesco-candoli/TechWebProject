

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
(marchito92,,25,f,)
(coolguy,,30,m,)
(r_lover,,22,f,)
(martina_rossi,,28,m,)
(RistoPizzaiola,,35,f,)
(Megghiee,,20,m,)
(foodieLover,,42,f,)
(checco_cando,,29,m,)
(fashionista28,,26,f,)
(bookworm50,,50,m,)
(iiVAN,,33,f,)
(Paolinomirri,,27,m,)
(Saraaa04,,23,f,)
(Canalis_Silvia,,44,m,)
(PizzasGino,,19,m,)

INSERT INTO review (content, vote, restaurant_id, publisher_id)
VALUES
(content, 2, 5, 12),
(content, 3, 7, 6),
(content, 4, 9, 3),
(content, 1, 3, 11),
(content, 0, 10, 8),
(content, 5, 2, 16),
(content, 2, 4, 14),
(content, 3, 6, 2),
(content, 4, 8, 13),
(content, 1, 1, 5),
(content, 0, 5, 12),
(content, 5, 7, 6),
(content, 2, 9, 3),
(content, 3, 3, 11),
(content, 4, 10, 8),
(content, 1, 2, 16),
(content, 0, 4, 14),
(content, 5, 6, 2),
(content, 2, 8, 13),
(content, 3, 1, 5),
(content, 4, 5, 12),
(content, 1, 7, 6),
(content, 0, 9, 3),
(content, 5, 3, 11),
(content, 2, 10, 8),
(content, 3, 2, 16),
(content, 4, 4, 14),
(content, 1, 6, 2),
(content, 0, 8, 13),
(content, 5, 1, 5),
(content, 2, 5, 12),
(content, 3, 7, 6),
(content, 4, 9, 3),
(content, 1, 3, 11),
(content, 0, 10, 8),
(content, 5, 2, 16),
(content, 2, 4, 14),
(content, 3, 6, 2),
(content, 4, 8, 13),
(content, 1, 1, 5);


INSERT INTO comment (content, review_id, publisher_id)
VALUES
(“Cche sbocco di posto”, 23, 11)
(“condivido a pieno”, 7, 9)
(“Ottimo voto”, 15, 4)
(“mediocre”, 29, 7)
(“Io invece nn la penso così”, 12, 6)
(“Non so se crederti”, 18, 13)
(“WOW”, 5, 8)
(“allibito a dire poco”, 20, 15)
(“wooooow”, 8, 10)
(“impeccabile”, 33, 5)
(“In accordo col tuo voto xoxo”, 14, 3)
(“Davvero è così?”, 25, 12)
(“Servono piatti vegani?”, 30, 2)
(“bello”, 17, 14)
(“Stuierpendo”, 21, 16)
(“Seguitemi, ricambio il follow”, 11, 6)
(“che meraviglia”, 27, 13)
(“Ristorante da evitare”, 35, 4)
(“Migliorabile”, 9, 12)
(“Ma sapevi che potevi chiedere acua gratis???”, 19, 7)
(“Condivido”, 22, 15)
(“BLEH”, 6, 9)
(“a me invece era piaciuto”, 31, 11)
(“Io sono stato deluso ”, 26, 3)
(“che bel posto”, 10, 2)
(“Abito lì vicino sai?”, 28, 16)
(“Si dai approvo il voto”, 13, 5)
(“Il cameriere era più bello del cibo che portava”, 24, 14)
(“Sono stato male dopo esserci andato”, 16, 8)
(“prezzacci, state lontani”, 4, 10)