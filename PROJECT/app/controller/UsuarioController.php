<?php
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Database.php';

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

        include __DIR__ . '/../views/registro.php';
}

public function login() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = trim($_POST['usuario']);
        $password = $_POST['password'];

        $usuarioModel = new Usuario();
        $resultado = $usuarioModel->verifyLogin($usuario, $password);

        if ($resultado) {
    session_start();
    $_SESSION['usuario_logeado'] = $resultado['usuario'];
    $_SESSION['ultimo_jugador'] = $resultado['usuario']; 
    header("Location: index.php?ruta=Jugadores");
    exit;
}
    }

    include __DIR__ . '/../views/inicio_sesion.php';

}

}
