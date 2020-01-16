<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Employee;
use App\Models\Administracion\ProcessedFiles;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;
use App\Exports\EmployeesExport;

class AdminEmployees extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');
        $this->pathLayout = '/manual_layouts';
        $this->folderProcessedFiles = '/processed_files';
        $this->separator = env('KEY_SEPARATOR');
        $this->headers = array();
        $this->dataFromFile = array();
        $this->path = storage_path() . '/app/public/' . $this->pathLayout . '/';
        $this->pathProcessedFiles = storage_path() . '/app/public/' . $this->folderProcessedFiles . '/';
        $this->keyForEmployee = env('KEY_EMPLOYEE');

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
        return view('administracion.employees.create');
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                Employee::create($data);
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
        $info_employee = Employee::withTrashed()->where('id', '=', $id)->get();
        //dd($info_employee[0]->isUser);
        return view('administracion.employees.edit', compact(['info_employee']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                Employee::withTrashed()->whereId($id)->update($data);
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

    public function listEmployees(Request $request){
        if ($request->ajax()) {
            $data = Employee::withTrashed()->get();
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
        $destinationPath = $this->pathLayout;
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
                if($upload_success = $file->storeAs($destinationPath, $filename)){
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
        return $val = $checkData;//Aqui se declara el nombre de la tabla
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
                            Employee::create($new);
                            $array_rfc = array_add($array_rfc, $i, $new[$this->keyForEmployee]);
                            $created++;
                        DB::commit();
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

        if($array_rfc > 0) {
            $empleados = Employee::whereNotIn('rfc', $array_rfc)
                                    ->get();

            foreach ($empleados as $empleado) {
                try {
                    DB::beginTransaction();
                        $employee = Employee::find($empleado->id);
                        $employee->delete();
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
        try {
            DB::beginTransaction();
                $info_file = [
                    'file_state' => 'Procesado',
                    'file_comments' => $message_file
                ];
                $file->update($info_file);

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
                    $this->headers[$j] = trim($column);
                    $j++;
                }
            } else {
               for($j = 0; $j < count($data); $j++){
                    if (!empty($data[$j])){
                        $columnData = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data[$j]);
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
