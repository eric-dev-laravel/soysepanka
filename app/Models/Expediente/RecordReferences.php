<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordReferences extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'id_employee', 'id_user', 'id_record', 'references_name', 'references_phone', 'references_time', 'references_ocupation'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
