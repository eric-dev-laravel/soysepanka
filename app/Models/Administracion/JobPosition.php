<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Enterprise;
use App\Models\Administracion\Mark;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use App\Models\Administracion\Department;
use App\Models\Administracion\WorkShift;

class JobPosition extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_enterprise', 'id_direction', 'id_area','id_department','id_level','id_boss_position', 'id_workshifts', 'id_gender', 'id_marital_status', 'name', 'objective', 'activities', 'responsabilities', 'knowledges', 'competitions', 'tools', 'education_level', 'places', 'description', 'years_experience', 'age_max', 'age_min', 'equitment', 'benefits', 'salary_range', 'salary_max', 'salary_min', 'available', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function enterprise(){
        return $this->belongsTo(Enterprise::class, 'id_enterprise', 'id');
    }

    public function mark(){
        return $this->belongsTo(Mark::class, 'id_mark', 'id');
    }

    public function direction(){
        return $this->belongsTo(Direction::class, 'id_direction', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'id_area', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'id_department', 'id');
    }

    public function bossPosition(){
        return $this->belongsTo(JobPosition::class, 'id_boss_position', 'id');
    }

    public function workshift(){
        return $this->belongsTo(WorkShift::class, 'id_workshifts', 'id');
    }
}
