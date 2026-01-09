<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Usuario;
use Core\View;

class UsuarioController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

        $usuario = Usuario::find($_SESSION['user_id']);

        return View::render('usuario/index', [
            'usuario' => $usuario
        ]);
    }
}
