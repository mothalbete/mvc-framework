<?php
declare(strict_types=1);

namespace Formacom\mvc\Controllers;

use Core\Controller;
use Formacom\Mvc\Models\Usuario;

class DataController extends Controller
{
    public function index(): void
    {
        $this->view('data/index', [
            'titulo' => 'Mini Framework MVC',
            'mensaje' => 'Todo funcionando correctamente 🚀'
        ]);
    }

    public function login(): void
    {
        $this->view('data/login');
    }

    public function usuarios(): void
    {
        $usuarios=Usuario::all();
        $this->view('data/usuarios', [
            'usuarios' => $usuarios
        ]);
    }
}
