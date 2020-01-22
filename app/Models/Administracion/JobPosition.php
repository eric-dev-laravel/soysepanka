<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Enterprise;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use App\Models\Administracion\Department;

class JobPosition extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_enterprise', 'id_direction', 'id_area','id_department','id_level','id_boss_position', 'name', 'description', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function enterprise(){
        return $this->belongsTo(Enterprise::class, 'id_enterprise', 'id');
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
}
