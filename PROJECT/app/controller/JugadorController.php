<?php


class JugadorController
{

    public function mostrarJugadores()
    {

        $conn = Database::getInstancia()->getConexion();
        // Crear array si no existe
        if (!isset($_SESSION['jugadores'])) {
            $_SESSION['jugadores'] = [];
        }

        // agrega el ultimo jugador loeago al espacio vacio
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

    public function eliminarJugador($index)
    {
        if (isset($_SESSION['jugadores'][$index])) {
            unset($_SESSION['jugadores'][$index]);
            $_SESSION['jugadores'] = array_values($_SESSION['jugadores']); 
        }
        header("Location: index.php?ruta=Jugadores");
        exit;
    }
}
