DROP DATABASE IF EXISTS draftotux;
CREATE DATABASE draftotux;
USE draftotux;

CREATE TABLE Jugador (
    id_jugador INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE Partida (
    id_partida INT PRIMARY KEY AUTO_INCREMENT,
    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('en curso', 'finalizada') DEFAULT 'en curso',
    modo ENUM('seguimiento', 'digital') DEFAULT 'seguimiento'
);

CREATE TABLE Tablero (
    id_tablero INT PRIMARY KEY AUTO_INCREMENT,
    puntos INT DEFAULT 0,
    id_jugador INT NOT NULL,
    id_partida INT NOT NULL,
    FOREIGN KEY (id_jugador) REFERENCES Jugador(id_jugador),
    FOREIGN KEY (id_partida) REFERENCES Partida(id_partida)
);

CREATE TABLE Movimiento (
    id_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    ronda INT NOT NULL CHECK (ronda IN (1, 2)),
    tipo ENUM('blanco', 'verde', 'violeta', 'naranja', 'azul', 'rojo') NOT NULL,
    lugar ENUM('Semejanza', 'Rey', 'Trio', 'Diferencia', 'Amor', 'Isla', 'Rio') NOT NULL,
    id_tablero INT NOT NULL,
    FOREIGN KEY (id_tablero) REFERENCES Tablero(id_tablero)
);

CREATE TABLE Juega(
    id_partida INT NOT NULL,
    id_jugador INT NOT NULL,
    PRIMARY KEY (id_partida, id_jugador),
    FOREIGN KEY (id_partida) REFERENCES Partida(id_partida),
    FOREIGN KEY (id_jugador) REFERENCES Jugador(id_jugador)
);

INSERT INTO Jugador (usuario, nombre, password) VALUES
('admin', 'Administrador', SHA2('admin', 256)),
('Nico', 'Nicolas Rodriguez', SHA2('1234', 256)),
('Orro', 'Geronimo Orro', SHA2('1234', 256)),
('MaxiVPI', 'Maximiliano Lopez', SHA2('1234', 256));

INSERT INTO Partida (fecha_inicio, estado, modo) VALUES
('2025-09-14 00:32:16', 'en curso', 'seguimiento'),
('2025-09-14 00:32:16', 'en curso', 'digital');

INSERT INTO Tablero (puntos, id_jugador, id_partida) VALUES
(0, 1, 1),
(10, 2, 2);

INSERT INTO Movimiento (ronda, tipo, lugar, id_tablero) VALUES
(1, 'blanco', 'Semejanza', 1),
(1, 'verde', 'Diferencia', 1),
(1, 'violeta', 'Amor', 1),
(1, 'naranja', 'Trio', 1),
(1, 'azul', 'Rey', 1),
(1, 'rojo', 'Isla', 1),
(2, 'blanco', 'Rio', 1),
(2, 'verde', 'Semejanza', 1),
(2, 'violeta', 'Diferencia', 1),
(2, 'naranja', 'Amor', 1),
(2, 'azul', 'Trio', 1),
(2, 'rojo', 'Rey', 1),
(1, 'blanco', 'Amor', 2),
(1, 'verde', 'Trio', 2),
(1, 'violeta', 'Rey', 2),
(1, 'naranja', 'Isla', 2),
(1, 'azul', 'Rio', 2),
(1, 'rojo', 'Semejanza', 2),
(2, 'blanco', 'Diferencia', 2),
(2, 'verde', 'Amor', 2),
(2, 'violeta', 'Trio', 2),
(2, 'naranja', 'Rey', 2),
(2, 'azul', 'Isla', 2),
(2, 'rojo', 'Rio', 2);