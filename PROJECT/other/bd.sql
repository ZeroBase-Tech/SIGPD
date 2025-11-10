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

