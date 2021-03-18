<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPositionLanguaje extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'jobpositions_languajes';

    protected $fillable = ['id_jobposition', 'name', 'read', 'write', 'conversation'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
