<?php
declare(strict_types=1);

namespace Formacom\mvc\Controllers;

use Core\Controller;

class DataController extends Controller
{
    public function index(): void
    {
        $this->view('data/index', [
            'titulo' => 'Mini Framework MVC',
            'mensaje' => 'Todo funcionando correctamente 🚀'
        ]);
    }
}
