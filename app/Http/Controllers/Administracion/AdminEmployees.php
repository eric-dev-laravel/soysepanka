<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Administracion\Employee;
use App\Models\Administracion\Enterprise;
use App\Models\Administracion\Mark;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use App\Models\Administracion\Department;
use App\Models\Administracion\JobPosition;
use App\Models\Administracion\JobPositionCatalog;
use App\Models\Administracion\ProcessedFiles;
use App\Models\Expediente\Record;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\File;

class AdminEmployees extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
        $this->middleware('auth');
        $this->pathLayout = 'manual_layouts';
        $this->folderProcessedFiles = 'processed_files';
        $this->separator = env('KEY_SEPARATOR');
        $this->headers = array();
        $this->dataFromFile = array();
        $this->path = storage_path() . '/app/public/' . $this->pathLayout . '/';
        $this->pathProcessedFiles = storage_path() . '/app/public/' . $this->folderProcessedFiles . '/';

        $this->keyForEmployee = env('KEY_EMPLOYEE');
        $this->keyForCreate = env('KEYFORCREATE');

        $this->keyForIDEnterprise = env('KEYFORIDENTERPRISE');
        $this->keyIDEnterprise = env('KEYIDENTERPRISE');
        $this->keyForEnterprise = env('KEYFORENTERPRISE');
        $this->keyForMark = env('KEYFORMARK');
        $this->keyForDirection = env('KEYFORDIRECTION');
        $this->keyForArea = env('KEYFORAREA');
        $this->keyForDepartment = env('KEYFORDEPARTMENT');
        $this->keyForJobPosition = env('KEYFORJOBPOSITION');

        $this->keyForOrigin = env('KEYFORORIGIN');
        $this->keyOrigin = env('KEYORIGIN');

        $this->createRecords = true;
        $this->createEnterprise = env('KEY_ENTERPRISE');
        $this->createMark = env('KEY_MARK');
        $this->createDirection = env('KEY_DIRECTION');
        $this->createArea = env('KEY_AREA');
        $this->createDepartment = env('KEY_DEPARTMENT');
        $this->createJobPosition = env('KEY_JOBPOSITION');

    }

    public function index() {
        $all_employees = Employee::all()->count();
        $inactive_employees = Employee::onlyTrashed()->count();
        $users_data = [
            'all_users' => $all_employees + $inactive_employees,
            'active_users' => $all_employees,
            'inactive_users' => $inactive_employees,
        ];

        return view('administracion.employees.index', compact(['users_data']));
    }

    public function create(){
        //$list_employees = Employee::orderByRaw('nombre ASC')->get();
        $list_jobpositions = JobPosition::orderBy('id_level', 'asc')->get();
        $data = [
            //'list_employee' => $list_employees,
            'list_jobpositions' => $list_jobpositions,
        ];
        return view('administracion.employees.create', compact(['data']));
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        //dd($data);
        try {
            DB::beginTransaction();
            $employee = Employee::create($data);
            if (! Record::where('id_employee', $employee->id)->exists()){
                try {
                    Record::create(array(
                        'id_employee' => $employee->id,
                    ));
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $errorsMessage = [
                        'fullMessage' => $e->getMessage(),
                    ];
                    return Redirect::back()->withErrors($errorsMessage);
                }
            }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];
            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-employees/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $employee = Employee::withTrashed()->where('id', '=', $id)->get();
        $list_jobpositions = JobPosition::withTrashed()->orderBy('name', 'asc')->get();
        if(JobPosition::withTrashed()->where('name', $employee[0]->puesto)->exists()){
            if(JobPosition::withTrashed()->where('name', $employee[0]->puesto)->count() > 1){
                $id_department = $employee[0]->departamento;
                $infoPositionBoss = JobPosition::withTrashed()->where('name', $employee[0]->puesto)->whereHas('department', function($query) use($id_department){
                    $query->where('name', $id_department);
                })->get();
            } else {
                $infoPositionBoss = JobPosition::withTrashed()->where('name', $employee[0]->puesto)->get();
            }

            if(!empty($infoPositionBoss[0]->bossPosition)){
                $bosses = Employee::withTrashed()->where('puesto', $infoPositionBoss[0]->bossPosition->name)->get();
            } else {
                $bosses = [];
            }
            $data = [
                'employee' => $employee,
                'list_jobpositions' => $list_jobpositions,
                'bosses' => $bosses,
            ];
        } else {
            $bosses = [];
            $data = [
                'employee' => $employee,
                'list_jobpositions' => $list_jobpositions,
                'bosses' => $bosses,
            ];
        }
        //dd($data);
        return view('administracion.employees.edit', compact(['data']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

        if(!empty($data['puesto'])){
            $jobPositionInfo = explode(',', $data['puesto']);
            $enterprise = $jobPositionInfo[0];
            $mark = $jobPositionInfo[1];
            $direction = $jobPositionInfo[2];
            $area = $jobPositionInfo[3];
            $department = $jobPositionInfo[4];
            $jobPosition = $jobPositionInfo[5];

            $data = array_add($data, 'empresa', $enterprise);
            $data = array_add($data, 'marca', $mark);
            $data = array_add($data, 'direccion', $direction);
            $data = array_add($data, 'departamento', $department);
            $data = array_add($data, 'seccion', $area);
            $data['puesto'] = $jobPosition;
        }

        try {
            DB::beginTransaction();
                Employee::withTrashed()->whereId($id)->update($data);
                //dd($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-employees/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = Employee::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-employees/'.$id.'/edit')->with('success','Ok');
    }

    public function bosses($id, $id_department){
        if(JobPosition::where('name', $id)->count() > 1){
            $jobPosition = JobPosition::where('name', $id)->whereHas('department', function($query) use($id_department){
                $query->where('name', $id_department);
            })->get();
        } else {
            $jobPosition = JobPosition::where('name', $id)->get();
        }

        if(!empty($jobPosition[0]['id_boss_position'])){
            $jobPositionBoss = JobPosition::where('id', $jobPosition[0]['id_boss_position'])->get();
            $bosses = Employee::select('id','nombre', 'paterno', 'materno')->where('puesto', $jobPositionBoss[0]['name'])->orderBy('nombre', 'ASC')->get();
        } else {
            $bosses = [];
        }

        $id_enterprise = 'Sin IDEmpresa';
        $enterprise = 'Sin Empresa';
        $mark = 'Sin Marca';
        $direction = 'Sin dirección';
        $area = 'Sin Área';
        $department = 'Sin Departamento';

        if(!empty($jobPosition[0]->enterprise->id)){
            $id_enterprise = $jobPosition[0]->enterprise->id;
        }
        if(!empty($jobPosition[0]->enterprise->name)){
            $enterprise = $jobPosition[0]->enterprise->name;
        }
        if(!empty($jobPosition[0]->mark->name)){
            $mark = $jobPosition[0]->mark->name;
        }
        if(!empty($jobPosition[0]->direction->name)){
            $direction = $jobPosition[0]->direction->name;
        }
        if(!empty($jobPosition[0]->area->name)){
            $area = $jobPosition[0]->area->name;
        }
        if(!empty($jobPosition[0]->department->name)){
            $department = $jobPosition[0]->department->name;
        }

        $data = [
            'bosses' => $bosses,
            'id_enterprise' => $id_enterprise,
            'enterprise' => $enterprise,
            'mark' => $mark,
            'direction' => $direction,
            'area' => $area,
            'department' => $department,
        ];
        return $data;
    }

    public function listEmployees(Request $request){
        if ($request->ajax()) {
            $data = Employee::withTrashed()->orderByRaw('deleted_at ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nombre', function($row){
                        return $row->nombre ." ". $row->paterno ." ". $row->materno;
                    })
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-employees/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-employees/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.employees.index');
    }

    public function activeEmployee($id){
        try {
            DB::beginTransaction();
                Employee::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-employees/'.$id.'/edit')->with('success','Ok');
    }

    public function downloadEmployees($id){
        $usersExport = new EmployeesExport;

        return $usersExport->exportEmployees($id)->download('employees.xlsx');
    }

    public function employeesImportLayout(Request $request){
        // getting all of the post data
        $files = $request->file('filesImport');
        $fileSave = 0;

        if(empty($files)){
            $errorsMessage = [
                'fullMessage' => 'No se encontro un archivo. Intentelo nuevamente.',
            ];
            return redirect('admin-employees')->withErrors($errorsMessage);
        } else {
             // recorremos cada archivo y lo subimos individualmente
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                if($upload_success = $file->storeAs($this->pathLayout, $filename)){
                    try {
                        DB::beginTransaction();
                            $fileSave = ProcessedFiles::create([
                                'file_name' => $filename,
                            ]); //Recupera el usuario borrado
                        DB::commit();
                    } catch (\PDOException $e) {
                        DB::rollBack();
                        $errorsMessage = [
                            'fullMessage' => $e->getMessage(),
                        ];

                        return redirect('admin-employees')->withErrors($errorsMessage);
                    }
                    $data = $this->readFile($filename);
                    //dd($data);
                    $info = [
                        'employees' => $data,
                        'type' => 1,
                        'id_file' => $fileSave->id,
                    ];
                    return view('administracion.employees.showDataLayout')->with('data', $info);
                } else {
                    $errorsMessage = [
                        'fullMessage' => 'No se encontro un archivo. Intentelo nuevamente.',
                    ];
                    return redirect('admin-employees')->withErrors($errorsMessage);
                }
            }
        }
    }

    private function readFile($filename) {
        $data = $this->getCSVData($filename);//llamada a metodo interno
        $checkData = $this->checkData($data);//llamada a metodo interno
        return $checkData;
    }

    public function employeesStartImportLayout($id) {
        $employees_fail = array();
        $array_rfc = array();
        $file = ProcessedFiles::find($id);
        $data = $this->getCSVData($file->file_name);//llamada a metodo interno
        $message_file = "";
        $created = 0;
        $updated = 0;
        $deleted = 0;

        $i = 0;
        foreach ($data as $new){
            if (array_key_exists($this->keyForEmployee, $new)) {
                //Checamos en la BD si esxiste
                if (! Employee::where($this->keyForEmployee, $new[$this->keyForEmployee])->exists()){
                    try {
                        DB::beginTransaction();
                        //dd($new);
                            $employee = Employee::create($new);
                            $array_rfc = array_add($array_rfc, $i, $new[$this->keyForEmployee]);
                            $created++;
                        DB::commit();

                        //Crear Expedientes sino existen
                        if($this->createRecords) {
                            if (! Record::where('id_employee', $employee->id)->exists()){
                                try {
                                    DB::beginTransaction();
                                        Record::create(array(
                                            'id_employee' => $employee->id,
                                        ));

                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'records' => $employee->rfc,
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                        //Crear Empresas sino existen
                        if($this->createEnterprise) {
                            if (! Enterprise::where($this->keyForCreate, $new[$this->keyForEnterprise])->exists()){
                                try {
                                    DB::beginTransaction();
                                        if(empty($new[$this->keyForIDEnterprise])){
                                            Enterprise::create(array(
                                                $this->keyForCreate => $new[$this->keyForEnterprise],
                                                $this->keyOrigin => $new[$this->keyForOrigin],
                                            ));
                                        } else {
                                            Enterprise::create(array(
                                                $this->keyForCreate => $new[$this->keyForEnterprise],
                                                $this->keyIDEnterprise => $new[$this->keyForIDEnterprise],
                                                $this->keyOrigin => $new[$this->keyForOrigin],
                                            ));
                                        }
                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'enterprise' => $new[$this->keyForEnterprise],
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                        //Crear Marcas sino existen
                        if($this->createMark) {
                            if (! Mark::where($this->keyForCreate, $new[$this->keyForMark])->exists()){
                                try {
                                    DB::beginTransaction();
                                    Mark::create(array(
                                            $this->keyForCreate => $new[$this->keyForMark],
                                            $this->keyOrigin => $new[$this->keyForOrigin],
                                        ));
                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'mark' => $new[$this->keyForDirection],
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                        //Crear Direcciones sino existen
                        if($this->createDirection) {
                            if (! Direction::where($this->keyForCreate, $new[$this->keyForDirection])->exists()){
                                try {
                                    DB::beginTransaction();
                                    Direction::create(array(
                                            $this->keyForCreate => $new[$this->keyForDirection],
                                            $this->keyOrigin => $new[$this->keyForOrigin],
                                        ));
                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'direction' => $new[$this->keyForDirection],
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                        //Crear Areas sino existen
                        if($this->createArea) {
                            if (! Area::where($this->keyForCreate, $new[$this->keyForArea])->exists()){
                                try {
                                    DB::beginTransaction();
                                    Area::create(array(
                                            $this->keyForCreate => $new[$this->keyForArea],
                                            $this->keyOrigin => $new[$this->keyForOrigin],
                                        ));
                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'area' => $new[$this->keyForArea],
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                        //Crear Departamentos sino existen
                        if($this->createDepartment) {
                            if (! Department::where($this->keyForCreate, $new[$this->keyForDepartment])->exists()){
                                try {
                                    DB::beginTransaction();
                                    Department::create(array(
                                            $this->keyForCreate => $new[$this->keyForDepartment],
                                            $this->keyOrigin => $new[$this->keyForOrigin],
                                        ));
                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'department' => $new[$this->keyForDepartment],
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                        //Crear Puestos sino existen
                        if($this->createJobPosition) {
                            if (! JobPositionCatalog::where($this->keyForCreate, $new[$this->keyForJobPosition])->exists()){
                                try {
                                    DB::beginTransaction();
                                    JobPositionCatalog::create(array(
                                            $this->keyForCreate => $new[$this->keyForJobPosition],
                                            $this->keyOrigin => $new[$this->keyForOrigin],
                                        ));
                                    DB::commit();
                                } catch (\PDOException $e) {
                                    DB::rollBack();
                                    $array_fail_info = [
                                        'jobcatalog' => $new[$this->keyForJobPosition],
                                        'msg'  => $e->getMessage(),
                                    ];
                                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                                }
                            }
                        }

                    } catch (\PDOException $e) {
                        DB::rollBack();
                        $array_fail_info = [
                            'user' => $new,
                            'msg'  => $e->getMessage(),
                        ];
                        $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                    }
                }else if (Employee::where($this->keyForEmployee, $new[$this->keyForEmployee])->exists()){
                    try {
                        DB::beginTransaction();
                            Employee::withTrashed()->whereRfc($new[$this->keyForEmployee])->update($new);
                            $array_rfc = array_add($array_rfc, $i, $new[$this->keyForEmployee]);
                            $updated++;
                        DB::commit();
                    } catch (\PDOException $e) {
                        DB::rollBack();
                        $array_fail_info = [
                            'user' => $new,
                            'msg'  => $e->getMessage(),
                        ];
                        $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                    }
                }
                $i++;
            } else {
                $array_fail_info = [
                    'user' => $new,
                    'msg'  => 'El usuario no cuenta con los datos necesarios para ser creado',
                ];
                $employees_fail = array_add($employees_fail, $i, $array_fail_info);
            }
        }
        //dd($employees_fail);
        if($array_rfc > 0) {
            $empleados = Employee::whereNotIn('rfc', $array_rfc)
                                    ->get();

            foreach ($empleados as $empleado) {
                try {
                    DB::beginTransaction();
                        $employee = Employee::find($empleado->id);
                        $employee->delete();
                        if(User::where('id_employee', $empleado->id)->exists()){
                            $user = User::where('id_employee', $empleado->id);
                            $user->delete();
                        }
                        $deleted++;
                    DB::commit();
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $array_fail_info = [
                        'user' => $new,
                        'msg'  => $e->getMessage(),
                    ];
                    $employees_fail = array_add($employees_fail, $i, $array_fail_info);
                }
                $i++;
            }
        }

        $message_file = "Se crearon: " . $created . " usuarios - Se modificaron: " . $updated . " usuarios - Se borraron: " . $deleted . " usuarios ";
        $extension = explode(".", $file->file_name);
        $extension = end($extension);
        try {
            DB::beginTransaction();
                $date = date('Y_m_d H_m_s');
                $n = explode(".", $file->file_name);
                $newFileName = $n[0] . '-' . $date. '.' . $extension;

                $info_file = [
                    'file_state' => 'Procesado',
                    'file_comments' => $message_file,
                    'file_newName' => $newFileName,
                ];

                $file->update($info_file);
                File::copy($this->path . $file->file_name, $this->pathProcessedFiles . $newFileName);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
        }

        return redirect('admin-employees')->with('success', $employees_fail);
    }

    private function getCSVData($filename){
        $File = fopen($this->path . $filename, 'r');
        $i = 0;

        while ($data = fgetcsv($File, 0, $this->separator)){

            if($i == 0){ // Solo la primer fila
                $j = 0;
                $column = '';
                while (!empty($data[$j])){
                    $column = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data[$j]);
                    $this->headers[$j] = trim(strtolower($column));
                    $j++;
                }
            } else {
                for($j = 0; $j < count($data); $j++){
                    if (!empty($data[$j])){
                        $columnData = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data[$j]);
                        $columnData = utf8_encode(preg_replace('/[\x00-\x1F\x7F\xA0]/', '', $data[$j]));
                        $this->dataFromFile[$i][$this->headers[$j]] = trim($columnData);
                    } else {
                        $this->dataFromFile[$i][$this->headers[$j]] = null;
                    }
               }
            }
            $i++;
        }
        fclose($File);
        return $this->dataFromFile;
    }

    private function checkData(array $data = array()){
        $numero_duplicados = 0;
        $numero_actualizados = array();
        $numero_eliminados = array();
        $numero_insertados = array();
        $array_rfc = array();

        $i = 0;
        foreach ($data as $new){
            if (array_key_exists($this->keyForEmployee, $new)) {
                if($new[$this->keyForEmployee] != null) {
                    //Checamos en la BD si esxiste
                    if (! Employee::where($this->keyForEmployee, $new[$this->keyForEmployee])->exists()){
                        $numero_insertados = array_add($numero_insertados, $i, $new);
                        $array_rfc = array_add($array_rfc, $i, $new[$this->keyForEmployee]);
                    }

                    if (Employee::where($this->keyForEmployee, $new[$this->keyForEmployee])->exists()){
                        $numero_actualizados = array_add($numero_actualizados, $i, $new);
                        $array_rfc = array_add($array_rfc, $i, $new[$this->keyForEmployee]);
                    }
                    $i++;
                }
            } else {
                //dd('No Existe '. $this->keyForEmployee);
            }
        }

        $empleados = Employee::select('idempleado', 'nombre', 'paterno', 'materno', 'rfc', 'nss', 'correopersonal', 'fuente' )
                                    ->whereNotIn('rfc', $array_rfc)
                                    ->get();

        $a = 0;
        foreach ($empleados as $empleado) {
            $numero_eliminados = array_add($numero_eliminados, $a, $empleado);
            $a++;
        }

        $data = [
            'insertados' => $numero_insertados,
            'actualizados' => $numero_actualizados,
            'eliminados' => $numero_eliminados
        ];
        return $data;
    }
}
