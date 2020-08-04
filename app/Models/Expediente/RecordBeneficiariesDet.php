<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Expediente\RecordBeneficiaries;

class RecordBeneficiariesDet extends Model
{
    use SoftDeletes;

    protected $table = 'record_beneficiaries_det';
    protected $dates = ['created_at, updated_at, deleted_at'];
    
    protected $fillable = [
        'record_beneficiaries_id',
        'beneficiarie_name',
        'date_birth_beneficiarie',
        'file_birth_certificate_beneficiarie',
        'type_beneficiarie'
    ];

    public function getPathFileDetAttribute(){
        return \Storage::url($this->file_birth_certificate_beneficiarie);
    }
    public function getPathFileOtrAttribute(){
        return \Storage::url($this->file_birth_certificate_beneficiarie);
    }
}
