<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPositionCatalog extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'jobpositions_catalog';

    protected $fillable = ['id_level', 'id_workshifts', 'id_gender', 'id_marital_status', 'name', 'objective', 'activities', 'responsabilities', 'knowledges', 'competitions', 'tools', 'education_level', 'places', 'description', 'years_experience', 'age_max', 'age_min', 'equitment', 'benefits', 'salary_range', 'salary_max', 'salary_min', 'available', 'origin'];
    protected $dates = ['created_at, updated_at, deleted_at'];
}
