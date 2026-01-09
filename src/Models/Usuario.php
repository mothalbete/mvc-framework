<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';

    // DESACTIVAR TIMESTAMPS DE FORMA DEFINITIVA
    public $timestamps = false;
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        // si añades last_login o similar, incluirlo aquí
    ];
}
