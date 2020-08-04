<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Expediente\RecordBeneficiariesDet;

class RecordBeneficiaries extends Model
{
    use SoftDeletes;

    protected $table = 'record_beneficiaries';
    protected $dates = ['created_at, updated_at, deleted_at'];

    protected $fillable = [
        'id_employee',
        'id_user',
        'id_record',
        'spouse_name',
        'date_marriage',
        'file_marriage',
        'father_name',
        'date_birth_father',
        'file_birth_certificate_father',
        'mother_name',
        'date_birth_mother',
        'file_birth_certificate_mother'
    ];

    public function BeneficiariosDet() {
        return $this->hasMany(RecordBeneficiariesDet::class);
    }

    public function BeneficiariosDetHijo() {
        return $this->hasMany(RecordBeneficiariesDet::class)->where('type_beneficiarie', 'HIJO');
    }

    public function BeneficiariosDetOtro() {
        return $this->hasOne(RecordBeneficiariesDet::class)->where('type_beneficiarie', 'OTRO')->withDefault();
    }

    public function getPathFileMarrigeAttribute(){
        return \Storage::url($this->file_marriage);
    }
    public function getPathFileFatherAttribute(){
        return \Storage::url($this->file_birth_certificate_father);
    }
    public function getPathFileMotherAttribute(){
        return \Storage::url($this->file_birth_certificate_mother);
    }
}
