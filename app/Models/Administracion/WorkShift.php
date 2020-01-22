<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'workshifts';

    protected $fillable = ['name', 'start', 'end'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
