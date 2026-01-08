<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'tarea_id';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_limite',
        'estado_id',
        'usuario_id',
        'proyecto_id'
    ];

    public function proyecto()
    {
        return $this->belongsTo(\App\Models\Proyecto::class, 'proyecto_id', 'proyecto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'usuario_id', 'usuario_id');
    }

    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'estado_id', 'estado_id');
    }
}
