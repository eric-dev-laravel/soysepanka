<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordPolicy extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'id_employee', 'id_user', 'id_record', 'type', 'company', 'number'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
