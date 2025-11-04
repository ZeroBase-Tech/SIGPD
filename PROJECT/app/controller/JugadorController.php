<?php


class JugadorController {

    public function mostrarJugadores() {
    // Crear array si no existe
    if (!isset($_SESSION['jugadores'])) {
        $_SESSION['jugadores'] = [];
    }

    // Si hay un último jugador logueado, lo agrega al primer slot vacío
    if (isset($_SESSION['ultimo_jugador'])) {
    for ($i = 0; $i < 5; $i++) {
        if (!isset($_SESSION['jugadores'][$i])) {
            $_SESSION['jugadores'][$i] = $_SESSION['ultimo_jugador'];
            unset($_SESSION['ultimo_jugador']); 
            break;
        }
    }
}

    $jugadores = $_SESSION['jugadores'];
    $ultimo_jugador = $_SESSION['ultimo_jugador'] ?? null;

    include __DIR__ . '/../views/cantidad.php';
}

    public function eliminarJugador($index) {
        if (isset($_SESSION['jugadores'][$index])) {
            unset($_SESSION['jugadores'][$index]);
            $_SESSION['jugadores'] = array_values($_SESSION['jugadores']); // reindexar
        }
        header("Location: index.php?ruta=Jugadores");
        exit;
    }
}
