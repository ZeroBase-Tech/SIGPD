<?php
class TableroController {

    public function mostrarTableros() {

        // Inicializamos array de jugadores si no existe
        if (!isset($_SESSION['jugadores'])) {
            $_SESSION['jugadores'] = [];
        }

        // Agregamos último jugador si viene del login
        if (isset($_SESSION['ultimo_jugador'])) {
            $nombre = $_SESSION['ultimo_jugador'];
            if (!in_array($nombre, $_SESSION['jugadores'])) {
                $_SESSION['jugadores'][] = $nombre;
            }
            unset($_SESSION['ultimo_jugador']);
        }

        // Si se finaliza partida
        if (isset($_POST['finalizar_partida'])) {
            $_SESSION['jugadores'] = [];
            header("Location: index.php?ruta=Ranking");
            exit;
        }

        $jugadores = $_SESSION['jugadores'];
        include __DIR__ . '/../views/Tableros.php';
    }

    public function mostrarTablero() {
        $jugadores = $_SESSION['jugadores'] ?? [];
        $jugador_index = $_GET['jugador'] ?? 0;

        if (isset($jugadores[$jugador_index])) {
            $nombre_jugador = $jugadores[$jugador_index];
        } else {
            $nombre_jugador = "Jugador " . ($jugador_index + 1);
        }

        include __DIR__ . '/../views/Tablero-Personal.php';
    }
}
