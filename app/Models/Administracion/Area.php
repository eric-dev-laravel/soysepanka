<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Enterprise;
use App\Models\Administracion\Direction;

class Area extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_enterprise', 'id_direction', 'name', 'description', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function enterprise(){
        return $this->belongsTo(Enterprise::class, 'id_enterprise', 'id');
    }

    public function direction(){
        return $this->belongsTo(Direction::class, 'id_direction', 'id');
    }
}
