<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPositionCatalog extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'jobpositions_catalog';

    protected $fillable = ['name', 'description', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
