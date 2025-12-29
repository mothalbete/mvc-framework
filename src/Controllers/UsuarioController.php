<?php
declare(strict_types=1);

namespace Formacom\mvc\Controllers;

use Core\Controller;

class UsuarioController extends Controller
{
    public function index(): void
    {
        
        $this->view('usuario/index', [
            'titulo' => 'Gestión de Usuarios',
            'mensaje' => 'Bienvenido a la gestión de usuarios 🚀'
        ]);
    }


}
