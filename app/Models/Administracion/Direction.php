<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Mark;

class Direction extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_mark', 'name', 'description', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function mark(){
        return $this->belongsTo(Mark::class, 'id_mark', 'id');
    }
}
