<?php
session_start();

// Front Controller

$ruta = $_GET['ruta'] ?? 'start'; 

switch ($ruta) {
    case 'start':
        require_once __DIR__ . '/app/views/start.php';
        break;
    case 'Home':
        require_once __DIR__ . '/app/views/menu.php';
        break;
    case 'cantidad':
        require_once __DIR__ . '/app/views/Cantidad.php';
        break;
    case 'tableros':
        require_once __DIR__ . '/app/views/tableros.php';
        break;
    case 'opciones':
        require_once __DIR__ . '/app/views/opciones.html';
        break;
    case 'Resultado':
        require_once __DIR__ . '/app/views/Resultados.php';
        break;
    case 'tablero':
        require_once __DIR__ . '/app/views/tablero-personal.php';
        break;
    case 'LogIn':
        require_once __DIR__ . '/app/views/inicio_sesion.php'; 
        break;
    case 'Register':
        require_once __DIR__ . '/app/views/registro.php';
        break;
    case 'LogRequest':
        if (isset($_SESSION['usuario'])) {
            header("Location: index.php?ruta=cantidad");
        }
        else
            //require_once __DIR__ . '../app/controllers/LogIn.php';
        break;
    default:
        echo '<h1>Error 404</h1>';
        break;
};