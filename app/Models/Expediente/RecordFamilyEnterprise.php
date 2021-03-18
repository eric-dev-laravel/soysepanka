<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Employee;

class RecordFamilyEnterprise extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'id_employee', 'id_user', 'id_record', 'id_family', 'family_type'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function Employee(){
        return $this->belongsTo(Employee::class, 'id_family', 'id');
    }
}
