<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Tarea;
use Core\View;

class HomeController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "login");
            exit;
        }

        $userId = (int) $_SESSION['user_id'];
        $usuario = Usuario::find($userId);

        return View::render('home/index', [
            'usuario'          => $usuario,
            'totalProyectos'   => Proyecto::where('usuario_id', $userId)->count(),
            'totalTareas'      => Tarea::whereHas('proyecto', function ($q) use ($userId) {
                                        $q->where('usuario_id', $userId);
                                   })->count(),
            'tareasPendientes' => Tarea::where('estado_id', 1)
                                   ->whereHas('proyecto', function ($q) use ($userId) {
                                       $q->where('usuario_id', $userId);
                                   })->count()
        ]);
    }
}
