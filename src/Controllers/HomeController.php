<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Tarea;

class HomeController extends Controller
{
    public function index(): void
    {
        // Usuario logueado
        $usuario = Usuario::find($_SESSION['user_id']);

        // Estadísticas del dashboard
        $totalProyectos = Proyecto::where('usuario_id', $_SESSION['user_id'])->count();

        $totalTareas = Tarea::where('usuario_id', $_SESSION['user_id'])->count();

        $tareasPendientes = Tarea::where('usuario_id', $_SESSION['user_id'])
                                 ->where('estado_id', 1) // Pendiente
                                 ->count();

        // Enviar datos a la vista
        $this->view('home/index', [
            'usuario' => $usuario,
            'totalProyectos' => $totalProyectos,
            'totalTareas' => $totalTareas,
            'tareasPendientes' => $tareasPendientes
        ]);
    }
}
