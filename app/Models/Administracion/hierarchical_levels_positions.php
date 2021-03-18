<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class hierarchical_levels_positions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['level', 'name', 'description'];
    protected $dates = ['created_at, updated_at'];
}
