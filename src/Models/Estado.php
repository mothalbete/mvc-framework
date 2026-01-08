<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'estado_id';
    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];

    // Relación: un estado tiene muchas tareas
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'estado_id');
    }
}
