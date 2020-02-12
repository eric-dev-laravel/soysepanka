<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordLastJobs extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'id_employee', 'id_user', 'id_record', 'last_jobPosition', 'last_enterprise', 'period_init', 'period_end', 'salary', 'reason_separation', 'activities'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
