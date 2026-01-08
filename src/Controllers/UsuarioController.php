<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Usuario;
use App\Models\Proyecto;
use App\Models\Tarea;

class UsuarioController extends Controller
{
    public function index(): void
    {
        // Usuario actual
        $usuario = Usuario::find($_SESSION['user_id']);

        if (!$usuario) {
            die('Usuario no encontrado');
        }

        // Estadísticas del usuario
        $totalProyectos = Proyecto::where('usuario_id', $usuario->usuario_id)->count();

        $totalTareas = Tarea::where('usuario_id', $usuario->usuario_id)->count();

        // IDs de estado según tu tabla:
        // 1 = Pendiente
        // 2 = En progreso
        // 3 = Completada
        $tareasCompletadas = Tarea::where('usuario_id', $usuario->usuario_id)
                                  ->where('estado_id', 3)
                                  ->count();

        $tareasPendientes = Tarea::where('usuario_id', $usuario->usuario_id)
                                 ->where('estado_id', 1)
                                 ->count();

        // Enviar datos a la vista
        $this->view('usuario/index', [
            'usuario' => $usuario,
            'totalProyectos' => $totalProyectos,
            'totalTareas' => $totalTareas,
            'tareasCompletadas' => $tareasCompletadas,
            'tareasPendientes' => $tareasPendientes
        ]);
    }
}
