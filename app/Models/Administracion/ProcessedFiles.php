<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class ProcessedFiles extends Model
{
    protected $fillable = ['file_name', 'file_state', 'file_comments'];
    protected $dates = ['created_at, updated_at'];
}
