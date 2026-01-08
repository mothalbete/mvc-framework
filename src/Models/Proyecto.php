<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $primaryKey = 'proyecto_id';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'usuario_id'
    ];

    // RELACIÓN NECESARIA PARA EL ACORDEÓN
    public function tareas()
    {
        return $this->hasMany(\App\Models\Tarea::class, 'proyecto_id', 'proyecto_id');
    }
}
