<?php
require_once __DIR__ . '/../model/Usuario.php';

class UsuarioController {
    public function register() {
    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = trim($_POST['usuario']);
        $nombre = trim($_POST['nombre']);
        $password = $_POST['password'];
        $confirmar = $_POST['confirmar_password'];

        if ($password !== $confirmar) {
            $error = "Las contraseñas no coinciden.";
        } else {
            $usuarioModel = new Usuario();

            if ($usuarioModel->getUserByUsername($usuario)) {
                $error = "El usuario ya existe.";
            } else {
                $usuarioModel->create($usuario, $nombre, $password);
                $success = "Usuario registrado con éxito.";
            }
        }
    }

        include __DIR__ . '/../views/Registro.php';
}

public function login() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = trim($_POST['usuario']);
        $password = $_POST['password'];

        $usuarioModel = new Usuario();
        $resultado = $usuarioModel->verifyLogin($usuario, $password);

        if ($resultado) {

                // Crear array de jugadores si no existe
                if (!isset($_SESSION['jugadores'])) {
                    $_SESSION['jugadores'] = [];
                }

                // Verificar si ya está en la partida
                if (in_array($resultado['usuario'], $_SESSION['jugadores'])) {
                    $error = "El jugador ya está en la partida.";
                } else {
                    $_SESSION['usuario_logeado'] = $resultado['usuario'];
                    $_SESSION['ultimo_jugador'] = $resultado['usuario'];
		    //Header no funciona porque index.php manda headers antes.
                    //header("Location: index.php?ruta=Jugadores");
		    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?ruta=Jugadores">';
                }
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }

    }

    include __DIR__ . '/../views/Inicio_Sesion.php';

}
}
