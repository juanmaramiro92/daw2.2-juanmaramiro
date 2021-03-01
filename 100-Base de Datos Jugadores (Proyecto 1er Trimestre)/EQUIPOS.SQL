/* AUTOR: JUAN MANUEL RAMIRO */
/* FECHA: 21-11-20 */

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS ESTADISTICAS;
CREATE DATABASE ESTADISTICAS;
USE ESTADISTICAS;


CREATE TABLE LIGAS
 (
    ID_LIGA             INT(6) NOT NULL AUTO_INCREMENT,		/* CÓDIGO LIGA*/
    NOMBRE_LIGA         VARCHAR(20) NOT NULL,	    		/* NOMBRE LIGA */
    PAIS_LIGA		VARCHAR(20) NOT NULL,			/* PAIS LIGA */
    PRIMARY KEY ( ID_LIGA )
 );

CREATE TABLE EQUIPOS
(
    ID_EQUIPO               INT(6) NOT NULL AUTO_INCREMENT,     /* CÓDIGO DEL EQUIPO */
    LIGA                    INT(6) NOT NULL,			/* CÓDIGO LIGA (FORÁNEA) */
    NOMBRE_EQUIPO           VARCHAR(30) NOT NULL,       	/* NOMBRE DEL EQUIPO */
    CIUDAD_EQUIPO           VARCHAR(30) NOT NULL,   		/* CIUDAD DEL EQUIPO */
    ESTADIO_EQUIPO     	    VARCHAR(50) NOT NULL,    		/* DIRECCIÓN DEL PROVEEDOR */
    ENTRENADOR_EQUIPO       VARCHAR (60) NOT NULL,		/* ENTRENADOR DEL EQUIPO */
    PRIMARY KEY ( ID_EQUIPO ),
    KEY FORANEA_LIGA ( LIGA )
);

CREATE TABLE JUGADORES
(
    ID_JUGADOR              INT(6) NOT NULL AUTO_INCREMENT,	/* CÓDIGO DEL JUGADOR */
    EQUIPO                  INT(6) NOT NULL,       		/* CÓDIGO DEL EQUIPO (FORÁNEA) */
    NOMBRE_JUGADOR          VARCHAR(50) NOT NULL,       	/* NOMBRE DEL JUGADOR */
    POSICION_JUGADOR        INT(2) NOT NULL,			/* POSICIÓN DEL JUGADOR */
    NACIONALIDAD_JUGADOR    VARCHAR(50) NOT NULL,   		/* NACIONALIDAD DEL JUGADOR */
    EDAD_JUGADOR       	    CHAR(2) NOT NULL,    		/* EDAD DEL JUGADOR */
    DORSAL_JUGADOR	    INT(2) NOT NULL,			/* DORSAL DEL JUGADOR */
    ESTADO_JUGADOR	    TINYINT(1) NOT NULL DEFAULT 0, 	/* ESTADO DEL JUGADOR */
    PRIMARY KEY ( ID_JUGADOR ),
    KEY FORANEA_EQUIPO ( EQUIPO )
);


ALTER TABLE EQUIPOS ADD CONSTRAINT FORANEA_LIGA FOREIGN KEY (LIGA) REFERENCES LIGAS(ID_LIGA) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE JUGADORES ADD CONSTRAINT FORANEA_EQUIPO FOREIGN KEY (EQUIPO) REFERENCES EQUIPOS(ID_EQUIPO) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO LIGAS (ID_LIGA, NOMBRE_LIGA, PAIS_LIGA) VALUES
(1, 'LaLiga Santander', 'España'),
(2, 'Serie A', 'Italia'),
(3, 'Bundesliga', 'Alemania'),
(4, 'Premier League', 'Inglaterra'),
(5, 'Ligue 1', 'Francia');

INSERT INTO EQUIPOS (ID_EQUIPO, LIGA, NOMBRE_EQUIPO, CIUDAD_EQUIPO, ESTADIO_EQUIPO, ENTRENADOR_EQUIPO) VALUES
(1, 1, 'Real Madrid CF', 'Madrid', 'Santiago Bernabeu', 'Zinedine Zidane'),
(2, 1, 'FC Barcelona', 'Barcelona', 'Camp Nou', 'Ronald Koeman'),
(20, 4, 'Liverpool FC', 'Liverpool', 'Anfield', 'Jürgen Klopp'),
(21, 4, 'Manchester City', 'Manchester', 'City of Manchester Stadium', 'Pep Guardiola'),
(22, 2, 'Juventus', 'Turín', 'Juventus Stadium', 'Andrea Pirlo'),
(23, 2, 'Inter de Milán', 'Milán', 'Giuseppe Meazza', 'Antonio Conte'),
(24, 3, 'Bayern Munich', 'Munich', 'Allianz Arena', 'Hans-Dieter Flick'),
(25, 5, 'Paris Saint-Germain', 'París', 'Parc des Princes', 'Thomas Tuchel');

INSERT INTO JUGADORES (ID_JUGADOR, EQUIPO, NOMBRE_JUGADOR, POSICION_JUGADOR, NACIONALIDAD_JUGADOR, EDAD_JUGADOR, DORSAL_JUGADOR, ESTADO_JUGADOR) VALUES
(3, 1, 'Sergio Ramos', 2, 'España', '34', 4, 1),
(4, 1, 'Thibaut Courtois', 1, 'Belgica', '28', 1, 0),
(5, 1, 'Eder Militao', 2, 'Brasil', '22', 3, 0),
(6, 1, 'Casemiro', 5, 'Brasil', '28', 14, 1),
(7, 1, 'Andriy Lunin', 1, 'Ucrania', '21', 13, 0),
(8, 1, 'Nacho Fernández', 2, 'España', '30', 6, 1),
(9, 1, 'Ferland Mendy', 3, 'Francia', '25', 23, 0),
(10, 1, 'Marcelo', 3, 'Brasil', '32', 12, 0),
(11, 1, 'Daniel Carvajal', 4, 'España', '28', 2, 1),
(12, 1, 'Álvaro Odriozola', 4, 'España', '24', 19, 1),
(13, 1, 'Federico Valverde', 6, 'Uruguay', '22', 15, 1),
(14, 1, 'Toni Kroos', 6, 'Alemania', '30', 8, 0),
(15, 1, 'Luka Modric', 6, 'Croacia', '35', 10, 0),
(16, 1, 'Martin Ödegaard', 9, 'Noruega', '21', 21, 0),
(17, 1, 'Isco', 9, 'España', '28', 22, 0),
(18, 1, 'Eden Hazard', 10, 'Belgica', '29', 7, 1),
(19, 1, 'Vinicius Junior', 10, 'Brasil', '20', 20, 0),
(20, 1, 'Rodrygo', 11, 'Brasil', '19', 25, 0),
(21, 1, 'Marco Asensio', 11, 'España', '24', 11, 0),
(22, 1, 'Lucas Vázquez', 11, 'España', '29', 17, 0),
(23, 1, 'Karim Benzema', 12, 'Francia', '32', 9, 0),
(24, 1, 'Luka Jovic', 12, 'Serbia', '22', 18, 1),
(25, 1, 'Mariano Díaz', 12, 'España', '27', 24, 0),
(26, 2, 'Marc-André ter Stegen', 1, 'Alemania', '28', 1, 0),
(27, 2, 'Neto', 1, 'Brasil', '31', 13, 0),
(28, 2, 'Clément Lenglet', 2, 'Francia', '25', 15, 0),
(29, 2, 'Samuel Umtiti', 2, 'Francia', '27', 23, 1),
(30, 2, 'Gerard Piqué', 2, 'España', '33', 3, 0),
(31, 2, 'Ronald Araujo', 2, 'Uruguay', '21', 4, 1),
(32, 2, 'Jordi Alba', 3, 'España', '31', 18, 0),
(33, 2, 'Júnior Firpo', 3, 'España', '24', 24, 0),
(34, 2, 'Sergiño Dest', 4, 'EEUU', '20', 2, 0),
(35, 2, 'Sergi Roberto', 4, 'España', '28', 20, 0),
(36, 2, 'Miralem Pjanic', 5, 'Bosnia', '30', 8, 0),
(37, 2, 'Sergio Busquets', 5, 'España', '32', 5, 1),
(38, 2, 'Matheus Fernandes', 5, 'Brasil', '22', 19, 0),
(39, 2, 'Frenkie de Jong', 6, 'Holanda', '23', 21, 0),
(40, 2, 'Riqui Puig', 6, 'España', '21', 12, 0),
(41, 2, 'Carles Aleñá', 6, 'España', '22', 6, 0),
(42, 2, 'Philippe Coutinho', 9, 'Brasil', '28', 14, 0),
(43, 2, 'Pedri', 9, 'España', '17', 16, 0),
(44, 2, 'Ansu fati', 10, 'España', '18', 22, 0),
(45, 2, 'Lionel Messi', 11, 'Argentina', '33', 10, 0),
(46, 2, 'Ousmane Dembélé', 11, 'Francia', '23', 11, 0),
(47, 2, 'Trincão', 11, 'Portugal', '20', 17, 0),
(48, 2, 'Antoine Griezmann', 12, 'Francia', '29', 7, 0),
(49, 2, 'Martin Braithwaite', 12, 'Dinamarca', '29', 9, 0),
(50, 20, 'Alisson', 1, 'Brasil', '28', 1, 0),
(51, 20, 'Adrián', 1, 'España', '33', 13, 0),
(52, 20, 'Virgil van Dijk', 2, 'Holanda', '29', 4, 1),
(53, 20, 'Joe Gomez', 2, 'Inglaterra', '23', 12, 1),
(54, 20, 'Joel Matip', 2, 'Camerún', '29', 32, 0),
(55, 20, 'Sepp van den Berg', 2, 'Holanda', '18', 72, 0),
(56, 20, 'Nathaniel Phillips', 2, 'Inglaterra', '23', 47, 0),
(57, 20, 'Andrew Robertson', 3, 'Escocia', '26', 26, 1),
(58, 20, 'Konstantinos Tsimikas', 3, 'Grecia', '24', 21, 0),
(59, 20, 'Trent Alexander-Arnold', 4, 'Inglaterra', '22', 66, 1),
(60, 20, 'Neco Williams', 4, 'Gales', '19', 76, 0),
(61, 20, 'Fabinho', 5, 'Brasil', '27', 3, 0),
(62, 20, 'Thiago', 6, 'España', '29', 6, 0),
(63, 20, 'Georginio Wijnaldum', 6, 'Holanda', '30', 5, 0),
(64, 20, 'Naby Keïta', 6, 'Guinea', '25', 8, 0),
(65, 20, 'Jordan Henderson', 6, 'Inglaterra', '30', 14, 0),
(66, 20, 'Alex Oxlade-Chamberlain', 6, 'Inglaterra', '27', 15, 1),
(67, 20, 'James Milner', 6, 'Inglaterra', '34', 7, 0),
(68, 20, 'Curtis Jones', 6, 'Inglaterra', '19', 17, 0),
(69, 20, 'Sadio Mané', 10, 'Senegal', '28', 10, 0),
(70, 20, 'Diogo Jota', 10, 'Portugal', '23', 20, 0),
(71, 20, 'Takumi Minamino', 10, 'Japón', '25', 18, 0),
(72, 20, 'Mohamed Salah', 11, 'Egipto', '28', 11, 1),
(73, 20, 'Xherdan Shaqiri', 11, 'Suiza', '29', 23, 0),
(74, 20, 'Roberto Firmino', 12, 'Brasil', '29', 9, 0),
(75, 20, 'Divock Origi', 12, 'Belgica', '25', 27, 0),
(76, 21, 'Ederson', 1, 'Brasil', '27', 31, 0),
(77, 21, 'Zack Steffen', 1, 'EEUU', '25', 13, 0),
(78, 21, 'Aymeric Laporte', 2, 'Francia', '26', 14, 0),
(79, 21, 'Rubén Dias', 2, 'Portugal', '23', 3, 0),
(80, 21, 'Nathan Aké', 2, 'Holanda', '25', 6, 1),
(81, 21, 'John Stones', 2, 'Inglaterra', '26', 5, 0),
(82, 21, 'Eric García', 2, 'España', '19', 50, 0),
(83, 21, 'Philippe Sandler', 2, 'Holanda', '23', 34, 1),
(84, 21, 'Benjamin Mendy', 3, 'Francia', '26', 22, 0),
(85, 21, 'Oleksandr Zinchenko', 3, 'Ucrania', '23', 11, 0),
(86, 21, 'Kyle Walker', 4, 'Inglaterra', '30', 2, 0),
(87, 21, 'João Cancelo', 4, 'Portugal', '26', 26, 0),
(88, 21, 'Rodri', 5, 'España', '24', 16, 0),
(89, 21, 'Fernandinho', 5, 'Brasil', '35', 25, 0),
(90, 21, 'Ilkay Gündogan', 6, 'Alemania', '30', 8, 0),
(91, 21, 'Phil Foden', 6, 'Inglaterra', '20', 47, 0),
(92, 21, 'Tommy Doyle', 6, 'Inglaterra', '19', 69, 0),
(93, 21, 'Kevin De Bruyne', 9, 'Belgica', '29', 17, 0),
(94, 21, 'Raheem Sterling', 10, 'Inglaterra', '25', 7, 0),
(95, 21, 'Bernardo Silva', 11, 'Portugal', '26', 20, 0),
(96, 21, 'Riyad Mahrez', 11, 'Argelia', '29', 26, 0),
(97, 21, 'Ferran Torres', 11, 'España', '20', 21, 0),
(98, 21, 'Gabriel Jesús', 12, 'Brasil', '23', 9, 0),
(99, 21, 'Sergio Agüero', 12, 'Argentina', '32', 10, 0),
(100, 22, 'Wojciech Szczesny', 1, 'Polonia', '30', 1, 0),
(101, 22, 'Gianluigi Buffon', 1, 'Italia', '42', 77, 0),
(102, 22, 'Matthijs de Ligt', 2, 'Holanda', '21', 4, 0),
(103, 22, 'Merih Demiral', 2, 'Turquía', '22', 28, 0),
(104, 22, 'Leonardo Bonucci', 2, 'Italia', '33', 19, 1),
(105, 22, 'Giorgio Chiellini', 2, 'Italia', '36', 3, 1),
(106, 22, 'Alex Sandro', 3, 'Brasil', '29', 12, 0),
(107, 22, 'Gianluca Frabotta', 3, 'Italia', '21', 38, 0),
(108, 22, 'Danilo', 4, 'Brasil', '29', 13, 0),
(109, 22, 'Juan Cuadrado', 4, 'Colombia', '32', 16, 0),
(110, 22, 'Arthur', 6, 'Brasil', '24', 5, 0),
(111, 22, 'Rodrigo Bentancur', 6, 'Uruguay', '23', 30, 0),
(112, 22, 'Adrien Rabiot', 6, 'Francia', '25', 25, 0),
(113, 22, 'Aaron Ramsey', 6, 'Gales', '29', 8, 1),
(114, 22, 'Sami Khedira', 6, 'Alemania', '33', 6, 0),
(115, 22, 'Weston McKennie', 6, 'EEUU', '22', 14, 0),
(116, 22, 'Cristiano Ronaldo', 10, 'Portugal', '35', 7, 0),
(117, 22, 'Federico Chiesa', 11, 'Italia', '23', 22, 0),
(118, 22, 'Dejan Kulusevski', 11, 'Suecia', '20', 44, 0),
(119, 22, 'Federico Bernardeschi', 11, 'Italia', '26', 33, 0),
(120, 22, 'Paulo Dybala', 9, 'Argentina', '27', 10, 0),
(121, 22, 'Álvaro Morata', 12, 'España', '28', 9, 0),
(122, 23, 'Ionut Radu', 1, 'Rumania', '23', 97, 0),
(123, 23, 'Samir Handanovic', 1, 'Eslovenia', '36', 1, 0),
(124, 23, 'Stefan de Vrij', 2, 'Holanda', '28', 6, 0),
(125, 23, 'Milan Skriniar', 2, 'Eslovaquia', '25', 37, 0),
(126, 23, 'Alessandro Bastoni', 2, 'Italia', '21', 95, 0),
(127, 23, 'Andrea Ranocchia', 2, 'Italia', '32', 13, 0),
(128, 23, 'Aleksandar Kolarov', 3, 'Serbia', '35', 11, 1),
(129, 23, 'Danilo D\'Ambrosio', 4, 'Italia', '32', 33, 0),
(130, 23, 'Matteo Darmian', 4, 'Italia', '30', 36, 0),
(131, 23, 'Marcelo Brozovic', 5, 'Croacia', '28', 77, 1),
(132, 23, 'Nicolò Barella', 6, 'Italia', '23', 23, 0),
(133, 23, 'Stefano Sensi', 6, 'Italia', '25', 12, 1),
(134, 23, 'Matías Vecino', 6, 'Uruguay', '29', 8, 1),
(135, 23, 'Roberto Gagliardini', 6, 'Italia', '26', 5, 0),
(136, 23, 'Arturo Vidal', 6, 'Chile', '33', 22, 0),
(137, 23, 'Achraf hakimi', 8, 'Marruecos', '22', 2, 0),
(138, 23, 'Ashley Young', 7, 'Inglaterra', '35', 15, 0),
(139, 23, 'Christian Eriksen', 9, 'Dinamarca', '28', 24, 0),
(140, 23, 'Radja Nainggolan', 9, 'Belgica', '32', 44, 0),
(141, 23, 'Ivan Perisic', 10, 'Croacia', '31', 14, 0),
(142, 23, 'Romelu Lukaku', 12, 'Belgica', '27', 9, 0),
(143, 23, 'Lautaro Martínez', 12, 'Argentina', '23', 10, 0),
(144, 23, 'Alexis Sánchez', 12, 'Chile', '31', 7, 0),
(145, 24, 'Manuel Neuer', 1, 'Alemania', '34', 1, 0),
(146, 24, 'Alexander Nübel', 1, 'Alemania', '24', 35, 1),
(147, 24, 'David Alaba', 2, 'Austria', '28', 27, 0),
(148, 24, 'Niklas Süle', 2, 'Alemania', '25', 4, 0),
(149, 24, 'Jéröme Boateng', 2, 'Alemania', '32', 17, 0),
(150, 24, 'Tanguy Nianzou', 2, 'Francia', '18', 23, 0),
(151, 24, 'Chris Richards', 2, 'EEUU', '20', 41, 0),
(152, 24, 'Alphonso Davies', 3, 'Canadá', '20', 19, 1),
(153, 24, 'Lucas Hernández', 3, 'Francia', '24', 20, 0),
(154, 24, 'Benjamin Pavard', 4, 'Francia', '24', 5, 0),
(155, 24, 'Bouna Sarr', 4, 'Francia', '28', 20, 0),
(156, 24, 'Joshua Kimmich', 5, 'Alemania', '25', 6, 1),
(157, 24, 'Marc Roca', 5, 'España', '23', 22, 0),
(158, 24, 'Javi Martínez', 5, 'España', '32', 8, 0),
(159, 24, 'Leon Goretzka', 6, 'Alemania', '25', 18, 0),
(160, 24, 'Corentin Tolisso', 6, 'Francia', '26', 24, 1),
(161, 24, 'Leroy Sané', 10, 'Alemania', '24', 10, 0),
(162, 24, 'Kingsley Conan', 10, 'Francia', '24', 29, 0),
(163, 24, 'Serge Gnabry', 11, 'Alemania', '25', 7, 0),
(164, 24, 'Douglas Costa', 11, 'Brasil', '30', 11, 0),
(165, 24, 'Thomas Müller', 9, 'Alemania', '31', 25, 0),
(166, 24, 'Robert Lewandowski', 12, 'Polonia', '32', 9, 0),
(167, 24, 'Choupo-Moting', 12, 'Camerún', '31', 13, 0),
(168, 25, 'Keylor Navas', 1, 'Costa Rica', '33', 1, 0),
(169, 25, 'Sergio Rico', 1, 'España', '27', 16, 0),
(170, 25, 'Marquinhos', 2, 'Brasil', '26', 5, 0),
(171, 25, 'Presnel Kimperbe', 2, 'Francia', '25', 3, 0),
(172, 25, 'Thilo Kehrer', 2, 'Alemania', '24', 3, 1),
(173, 25, 'Abdou Diallo', 2, 'Francia', '24', 22, 0),
(174, 25, 'Juan Bernat', 3, 'España', '27', 14, 1),
(175, 25, 'Layvin Kurzawa', 3, 'Francia', '28', 20, 0),
(176, 25, 'Mitchel Bakker', 3, 'Holanda', '20', 25, 0),
(177, 25, 'Alessandro Florenzi', 4, 'italia', '29', 24, 0),
(178, 25, 'Colin Dagba', 4, 'Francia', '22', 31, 0),
(179, 25, 'Danilo Pereira', 5, 'Portugal', '29', 15, 0),
(180, 25, 'Idrissa Gueye', 5, 'Senegal', '31', 27, 0),
(181, 25, 'Marco Verratti', 6, 'Italia', '28', 6, 1),
(182, 25, 'Leandro Paredes', 6, 'Argentina', '26', 8, 0),
(183, 25, 'Ander Herrera', 6, 'España', '31', 21, 0),
(184, 25, 'Julian Draxler', 9, 'Alemania', '27', 23, 1),
(185, 25, 'Rafinha', 9, 'Brasil', '27', 12, 0),
(186, 25, 'Kylian Mbappé', 10, 'Francia', '21', 7, 0),
(187, 25, 'Neymar', 10, 'Brasil', '28', 10, 0),
(188, 25, 'Jesé Rodríguez', 10, 'España', '27', 35, 0),
(189, 25, 'Ángel Di María', 11, 'Argentina', '32', 11, 1),
(190, 25, 'Pablo Sarabia', 11, 'España', '28', 19, 0),
(191, 25, 'Mauro Icardi', 12, 'Argentina', '27', 9, 1),
(192, 25, 'Moise Kean', 12, 'Italia', '20', 18, 0);

SET FOREIGN_KEY_CHECKS=1;



