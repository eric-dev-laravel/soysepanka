<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordFormation extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'id_employee', 'id_user', 'id_record', 'especialization_area', 'level', 'status', 'center', 'period_init', 'period_end', 'proof'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function getUrlPathAttribute(){
        return \Storage::url($this->proof);
    }
}
