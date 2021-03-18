<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Enterprise extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_enterprise', 'name', 'description', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
