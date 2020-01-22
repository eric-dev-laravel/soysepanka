<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $idempleado
 * @property string $nombre
 * @property string $paterno
 * @property string|null $materno
 * @property string|null $fuente
 * @property string $rfc
 * @property string|null $curp
 * @property string|null $nss
 * @property string|null $correoempresa
 * @property string|null $correopersonal
 * @property string|null $nacimiento
 * @property string|null $sexo
 * @property string|null $civil
 * @property string|null $telefono
 * @property string|null $extension
 * @property string|null $celular
 * @property string|null $ingreso
 * @property string|null $fechapuesto
 * @property string|null $jefe
 * @property string|null $direccion
 * @property string|null $departamento
 * @property string|null $seccion
 * @property string|null $puesto
 * @property string|null $grado
 * @property string|null $region
 * @property string|null $sucursal
 * @property int|null $idempresa
 * @property string|null $empresa
 * @property string|null $division
 * @property string|null $marca
 * @property string|null $centro
 * @property string|null $checador
 * @property string|null $turno
 * @property string|null $tiponomina
 * @property string|null $clavenomina
 * @property string|null $nombrenomina
 * @property string|null $generalista
 * @property string|null $relacion
 * @property string|null $contrato
 * @property string|null $horario
 * @property string|null $jornada
 * @property string|null $calculo
 * @property string|null $vacaciones
 * @property string|null $flotante
 * @property string|null $base
 * @property string|null $rol
 * @property string|null $password
 * @property string|null $extra1
 * @property string|null $extra2
 * @property string|null $extra3
 * @property string|null $extra4
 * @property string|null $extra5
 * @property string|null $fecha
 * @property string|null $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCalculo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCentro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereChecador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCivil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereClavenomina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCorreoempresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCorreopersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereCurp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereDepartamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereDivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereExtra1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereExtra2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereExtra3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereExtra4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereExtra5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereFechapuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereFlotante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereFuente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereGeneralista($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereGrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereHorario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereIdempleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereIdempresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereJefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereJornada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereNombrenomina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereNss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee wherePaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereRelacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereRfc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereSeccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereSexo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereSucursal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereTiponomina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereTurno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereVacaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Employee whereVersion($value)
 * @mixin \Eloquent
 */
class Employee extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idempleado', 'nombre', 'paterno', 'materno', 'fuente', 'rfc', 'curp', 'nss', 'correoempresa', 'correopersonal', 'nacimiento', 'sexo', 'civil', 'telefono', 'extension', 'celular', 'ingreso', 'fechapuesto', 'jefe', 'direccion', 'departamento', 'seccion', 'puesto', 'grado', 'region', 'sucursal', 'idempresa', 'empresa', 'division', 'marca', 'centro', 'checador', 'turno', 'tiponomina', 'clavenomina', 'nombrenomina', 'generalista', 'relacion', 'contrato', 'horario', 'jornada', 'calculo', 'vacaciones', 'flotante', 'base', 'rol', 'password', 'extra1', 'extra2', 'extra3', 'extra4', 'extra5', 'fecha', 'version'];
    protected $dates = ['created_at, updated_at, deleted_at'];

    public function isUser(){
        return $this->belongsTo(User::class, 'id', 'id_employee');
    }
}
