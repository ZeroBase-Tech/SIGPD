CREATE DATABASE IF NOT EXISTS draftotux;
USE draftotux;

CREATE TABLE Jugador (
    id_jugador INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(255) NOT NULL
);

INSERT INTO Jugador (usuario, nombre, contraseña) VALUES
('admin', 'Administrador', 'admin'),
('Nico', 'Nicolas Rodriguez', '1234'),
('Orro', 'Geronimo Orro', '1234'),
('MaxiVPI', 'Maximiliano Lopez', '1234');

CREATE TABLE Partida (
    id_partida INT PRIMARY KEY AUTO_INCREMENT,
    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('en curso', 'finalizada') DEFAULT 'en curso',
    modo ENUM('seguimiento', 'digital') DEFAULT 'seguimiento'
);

INSERT INTO Tablero (puntos, id_partida) VALUES
(0, 1),
(10, 2);

CREATE TABLE Tablero (
    id_tablero INT PRIMARY KEY AUTO_INCREMENT,
    puntos INT DEFAULT 0,
    id_partida INT UNIQUE,
    FOREIGN KEY (id_partida) REFERENCES Partida(id_partida)
);

INSERT INTO Movimiento (ronda, tipo, lugar, id_tablero) VALUES
(1, 'blanco', 'bosque', 1),
(2, 'verde', 'prado', 1),
(3, 'violeta', 'amor', 1),
(4, 'naranja', 'trio', 1),
(5, 'azul', 'rey', 1),
(6, 'rojo', 'isla', 1),
(7, 'blanco', 'rio', 1),
(8, 'verde', 'bosque', 1),
(9, 'violeta', 'prado', 1),
(10, 'naranja', 'amor', 1),
(11, 'azul', 'trio', 1),
(12, 'rojo', 'rey', 1),
(13, 'blanco', 'isla', 1),
(14, 'verde', 'rio', 1),
(15, 'violeta', 'bosque', 1),
(16, 'naranja', 'prado', 1),
(17, 'azul', 'amor', 1),
(18, 'rojo', 'trio', 1),
(19, 'blanco', 'amor', 2),
(20, 'verde', 'trio', 2),
(21, 'violeta', 'rey', 2),
(22, 'naranja', 'isla', 2),
(23, 'azul', 'rio', 2),
(24, 'rojo', 'bosque', 2),
(25, 'blanco', 'prado', 2),
(26, 'verde', 'amor', 2),
(27, 'violeta', 'trio', 2),
(28, 'naranja', 'rey', 2),
(29, 'azul', 'isla', 2),
(30, 'rojo', 'rio', 2),
(31, 'blanco', 'bosque', 2),
(32, 'verde', 'prado', 2),
(33, 'violeta', 'amor', 2),
(34, 'naranja', 'trio', 2),
(35, 'azul', 'rey', 2),
(36, 'rojo', 'isla', 2);

CREATE TABLE Movimiento (
    id_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    ronda INT NOT NULL,
    tipo ENUM('blanco', 'verde', 'violeta', 'naranja', 'azul', 'rojo') NOT NULL,
    lugar ENUM('bosque', 'prado', 'amor', 'trio', 'rey', 'isla', 'rio') NOT NULL,
    id_tablero INT,
    FOREIGN KEY (id_tablero) REFERENCES Tablero(id_tablero)
);
