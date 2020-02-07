<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_employee', 'id_user', 'picture'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function getUrlPathAttribute(){
        return \Storage::url($this->picture);
    }
}
