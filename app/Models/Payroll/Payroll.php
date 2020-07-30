<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'payroll';
    // user_id, type_period, period, company, year, file
    protected $fillable = [
        'user_id',
         'type_period',
         'period',
         'company',
         'year',
         'file'
    ];
}
