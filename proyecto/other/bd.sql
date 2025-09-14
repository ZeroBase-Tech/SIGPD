CREATE DATABASE IF NOT EXISTS draftotux;
USE draftotux;

CREATE TABLE Jugador (
    id_jugador INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(255) NOT NULL
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
    id_partida INT UNIQUE,
    FOREIGN KEY (id_partida) REFERENCES Partida(id_partida)
);

CREATE TABLE Movimiento (
    id_movimiento INT PRIMARY KEY AUTO_INCREMENT,
    ronda INT NOT NULL,
    tipo ENUM('blanco', 'verde', 'violeta', 'naranja', 'azul', 'rojo') NOT NULL,
    lugar ENUM('bosque', 'prado', 'amor', 'trio', 'rey', 'isla', 'rio') NOT NULL,
    id_tablero INT,
    FOREIGN KEY (id_tablero) REFERENCES Tablero(id_tablero)
);
