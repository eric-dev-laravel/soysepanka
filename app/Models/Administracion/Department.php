<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Mark;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;

class Department extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_enterprise', 'id_direction', 'id_area', 'name', 'description', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function enterprise(){
        return $this->belongsTo(Mark::class, 'id_enterprise', 'id');
    }

    public function direction(){
        return $this->belongsTo(Direction::class, 'id_direction', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'id_area', 'id');
    }
}
