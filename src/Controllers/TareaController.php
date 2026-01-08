<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Usuario;

class TareaController extends Controller
{
    public function index(): void
    {
        $tareas = Tarea::with(['proyecto', 'estado', 'usuario'])->get();

        $this->view('tarea/index', [
            'tareas' => $tareas
        ]);
    }

    public function create(): void
    {
        $proyectos = Proyecto::all();
        $estados = Estado::all();
        $usuarios = Usuario::all();

        $this->view('tarea/create', [
            'proyectos' => $proyectos,
            'estados' => $estados,
            'usuarios' => $usuarios
        ]);
    }

    public function store(): void
    {
        try {
            Tarea::create([
                'usuario_id'   => $_POST['usuario_id'], 
                'proyecto_id'  => $_POST['proyecto_id'],
                'estado_id'    => $_POST['estado_id'],
                'titulo'       => $_POST['titulo'],
                'descripcion'  => $_POST['descripcion'],
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Tarea creada correctamente'
            ];

            $this->redirect(BASE_URL . 'tarea');

        } catch (\Exception $e) {

            $proyectos = Proyecto::all();
            $estados = Estado::all();
            $usuarios = Usuario::all();

            $this->view('tarea/create', [
                'error' => $e->getMessage(),
                'proyectos' => $proyectos,
                'estados' => $estados,
                'usuarios' => $usuarios
            ]);
        }
    }

    public function edit(int $id): void
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            die('Tarea no encontrada');
        }

        $proyectos = Proyecto::all();
        $estados = Estado::all();
        $usuarios = Usuario::all();

        $this->view('tarea/edit', [
            'tarea' => $tarea,
            'proyectos' => $proyectos,
            'estados' => $estados,
            'usuarios' => $usuarios
        ]);
    }

    public function update(int $id): void
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            die('Tarea no encontrada');
        }

        try {
            $tarea->update([
                'usuario_id'   => $_POST['usuario_id'],
                'proyecto_id'  => $_POST['proyecto_id'],
                'estado_id'    => $_POST['estado_id'],
                'titulo'       => $_POST['titulo'],
                'descripcion'  => $_POST['descripcion'],
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Tarea actualizada correctamente'
            ];

            $this->redirect(BASE_URL . 'tarea');

        } catch (\Exception $e) {

            $proyectos = Proyecto::all();
            $estados = Estado::all();
            $usuarios = Usuario::all();

            $this->view('tarea/edit', [
                'tarea' => $tarea,
                'proyectos' => $proyectos,
                'estados' => $estados,
                'usuarios' => $usuarios,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(int $id): void
    {
        $tarea = Tarea::find($id);

        if (!$tarea) {
            die('Tarea no encontrada');
        }

        $tarea->delete();

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Tarea eliminada correctamente'
        ];

        $this->redirect(BASE_URL . 'tarea');
    }
}
