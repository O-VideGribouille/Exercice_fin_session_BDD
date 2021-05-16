/* Etape 1 : création de la basse de données*/

create database SCHOOL;


/* Etape 2 : Création d'une table*/

/*table 1 : tableble unique*/
DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `STATUT` varchar(15) COLLATE latin1_general_cs NOT NULL DEFAULT 'Indefinit',
  `NOM` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `PRENOM` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `MATIERE` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `NOTE` varchar(50) COLLATE latin1_general_cs DEFAULT NULL,
  `LOGIN` varchar(35) COLLATE latin1_general_cs NOT NULL,
  `MPASSE` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

/* Etape 3 - 1 : insertion professeur est élèves neutre */

INSERT INTO `etudiant` (`STATUT`,`NOM`, `PRENOM`, `MATIERE`, `NOTE`, `LOGIN`, `MPASSE`) VALUES
('Professeur','TORNADO', 'Red', 'ALGORITHME', ' ','rtornado', 12312312),
('Professeur','LANCE', 'Dina', 'GAME DESIGN', ' ', 'dlance', 45645645),
('Professeur','STEWART', 'Jhon', 'WEB', 'jstewart', ' ', 78978978),

('Eleve','HYDE', 'Jackson', ' ', ' ','jhyde', 11111111),
('Eleve','GRAYSON', 'Richard', ' ', ' ', 'rgrayson', 22222222),
('Eleve','WEST', 'Wally', ' ', ' ', 'wwest', 33333333),
('Eleve','KENT', 'Conner', ' ', ' ', 'ckent', 44444444),
('Eleve','MORSE', 'Megan', ' ', ' ', 'mmorse', 55555555);


/* Etape 3 - 2 : insertion notes des élèves */

/* Cours de WEB */

INSERT INTO `etudiant` (`STATUT`,`NOM`, `PRENOM`, `MATIERE`, `NOTE`, `LOGIN`, `MPASSE`) VALUES
('Eleve','HYDE', 'Jackson', 'WEB', '15','jhyde', 11111111),
('Eleve','HYDE', 'Jackson', 'WEB', '12','jhyde', 11111111),
('Eleve','HYDE', 'Jackson', 'WEB', '17','jhyde', 11111111),
('Eleve','GRAYSON', 'Richard', 'WEB', '17', 'rgrayson', 22222222),
('Eleve','GRAYSON', 'Richard', 'WEB', '17.5', 'rgrayson', 22222222),
('Eleve','GRAYSON', 'Richard', 'WEB', '18', 'rgrayson', 22222222),
('Eleve','WEST', 'Wally', 'WEB', '15', 'wwest', 33333333),
('Eleve','WEST', 'Wally', 'WEB', '11', 'wwest', 33333333),
('Eleve','WEST', 'Wally', 'WEB', '17', 'wwest', 33333333),
('Eleve','KENT', 'Conner', 'WEB', '12', 'ckent', 44444444),
('Eleve','KENT', 'Conner', 'WEB', '9', 'ckent', 44444444),
('Eleve','KENT', 'Conner', 'WEB', '10', 'ckent', 44444444),
('Eleve','MORSE', 'Megan', 'WEB', '15', 'mmorse', 55555555),
('Eleve','MORSE', 'Megan', 'WEB', '9', 'mmorse', 55555555),
('Eleve','MORSE', 'Megan', 'WEB', '10', 'mmorse', 55555555),
('Eleve','CROCK', 'Artemis', 'WEB', '15', 'acrock', 66666666),
('Eleve','CROCK', 'Artemis', 'WEB', '10', 'acrock', 66666666),
('Eleve','CROCK', 'Artemis', 'WEB', '11', 'acrock', 66666666);

/* Cours de GD */

INSERT INTO `etudiant` (`STATUT`,`NOM`, `PRENOM`, `MATIERE`, `NOTE`, `LOGIN`, `MPASSE`) VALUES
('Eleve','HYDE', 'Jackson', 'GAME DESIGN', '12','jhyde', 11111111),
('Eleve','HYDE', 'Jackson', 'GAME DESIGN', '15','jhyde', 11111111),
('Eleve','HYDE', 'Jackson', 'GAME DESIGN', '13.5','jhyde', 11111111),
('Eleve','GRAYSON', 'Richard', 'GAME DESIGN', '15', 'rgrayson', 22222222),
('Eleve','GRAYSON', 'Richard', 'GAME DESIGN', '14', 'rgrayson', 22222222),
('Eleve','GRAYSON', 'Richard', 'GAME DESIGN', '14.5', 'rgrayson', 22222222),
('Eleve','WEST', 'Wally', 'GAME DESIGN', '16', 'wwest', 33333333),
('Eleve','WEST', 'Wally', 'GAME DESIGN', '17', 'wwest', 33333333),
('Eleve','WEST', 'Wally', 'GAME DESIGN', '17.5', 'wwest', 33333333),
('Eleve','KENT', 'Conner', 'GAME DESIGN', '14', 'ckent', 44444444),
('Eleve','KENT', 'Conner', 'GAME DESIGN', '11', 'ckent', 44444444),
('Eleve','KENT', 'Conner', 'GAME DESIGN', '10', 'ckent', 44444444),
('Eleve','MORSE', 'Megan', 'GAME DESIGN', '11', 'mmorse', 55555555),
('Eleve','MORSE', 'Megan', 'GAME DESIGN', '8', 'mmorse', 55555555),
('Eleve','MORSE', 'Megan', 'GAME DESIGN', '10', 'mmorse', 55555555),
('Eleve','CROCK', 'Artemis', 'GAME DESIGN', '12', 'acrock', 66666666),
('Eleve','CROCK', 'Artemis', 'GAME DESIGN', '13', 'acrock', 66666666),
('Eleve','CROCK', 'Artemis', 'GAME DESIGN', '16', 'acrock', 66666666);

/* Cours de Algo */

INSERT INTO `etudiant` (`STATUT`,`NOM`, `PRENOM`, `MATIERE`, `NOTE`, `LOGIN`, `MPASSE`) VALUES
('Eleve','HYDE', 'Jackson', 'ALGORITHME', '17','jhyde', 11111111),
('Eleve','HYDE', 'Jackson', 'ALGORITHME', '18','jhyde', 11111111),
('Eleve','HYDE', 'Jackson', 'ALGORITHME', '17.5','jhyde', 11111111),
('Eleve','GRAYSON', 'Richard', 'ALGORITHME', '17.5', 'rgrayson', 22222222),
('Eleve','GRAYSON', 'Richard', 'ALGORITHME', '9', 'rgrayson', 22222222),
('Eleve','GRAYSON', 'Richard', 'ALGORITHME', '18', 'rgrayson', 22222222),
('Eleve','WEST', 'Wally', 'ALGORITHME', '13', 'wwest', 33333333),
('Eleve','WEST', 'Wally', 'ALGORITHME', '14', 'wwest', 33333333),
('Eleve','WEST', 'Wally', 'ALGORITHME', '13', 'wwest', 33333333),
('Eleve','KENT', 'Conner', 'ALGORITHME', '7', 'ckent', 44444444),
('Eleve','KENT', 'Conner', 'ALGORITHME', '12', 'ckent', 44444444),
('Eleve','KENT', 'Conner', 'ALGORITHME', '10', 'ckent', 44444444),
('Eleve','MORSE', 'Megan', 'ALGORITHME', '19', 'mmorse', 55555555),
('Eleve','MORSE', 'Megan', 'ALGORITHME', '20', 'mmorse', 55555555),
('Eleve','MORSE', 'Megan', 'ALGORITHME', '17', 'mmorse', 55555555),
('Eleve','CROCK', 'Artemis', 'ALGORITHME', '5', 'acrock', 66666666),
('Eleve','CROCK', 'Artemis', 'ALGORITHME', '10', 'acrock', 66666666),
('Eleve','CROCK', 'Artemis', 'ALGORITHME', '8', 'acrock', 66666666);