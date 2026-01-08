<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\Proyecto;
use App\Models\Tarea;

class ProyectoController extends Controller
{
    public function index(): void
    {

        $proyectos = Proyecto::where('usuario_id', $_SESSION['user_id'])
                     ->with(['tareas', 'tareas.usuario', 'tareas.estado'])
                     ->get();

        $this->view('proyecto/index', [
            'proyectos' => $proyectos
        ]);
    }

    public function create(): void
    {
        $this->view('proyecto/create');
    }

    public function store(): void
    {
        try {
            Proyecto::create([
                'usuario_id' => $_SESSION['user_id'],
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'] ?: null,
                'fecha_fin' => $_POST['fecha_fin'] ?: null
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Proyecto creado correctamente'
            ];

            $this->redirect(BASE_URL . 'proyecto');

        } catch (\Exception $e) {

            $this->view('proyecto/create', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto || $proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso para editar este proyecto');
        }

        $this->view('proyecto/edit', [
            'proyecto' => $proyecto
        ]);
    }

    public function update(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto || $proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso para editar este proyecto');
        }

        try {
            $proyecto->update([
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'] ?: null,
                'fecha_fin' => $_POST['fecha_fin'] ?: null
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Proyecto actualizado correctamente'
            ];

            $this->redirect(BASE_URL . 'proyecto');

        } catch (\Exception $e) {

            $this->view('proyecto/edit', [
                'proyecto' => $proyecto,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(int $id): void
    {
        $proyecto = Proyecto::find($id);

        if (!$proyecto || $proyecto->usuario_id !== $_SESSION['user_id']) {
            die('No tienes permiso para eliminar este proyecto');
        }

        $proyecto->delete();

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Proyecto eliminado correctamente'
        ];

        $this->redirect(BASE_URL . 'proyecto');
    }
}
