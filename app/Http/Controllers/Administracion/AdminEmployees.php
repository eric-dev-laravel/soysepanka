<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Employee;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Storage;

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
        $this->separator = env('KEY_SEPARATOR');;
        $this->headers = array();
        $this->dataFromFile = array();
        $this->path = storage_path() . '/app/public/' . $this->pathLayout . '/';
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

        // recorremos cada archivo y lo subimos individualmente
        foreach($files as $file) {
            $filename = $file->getClientOriginalName();
            if($upload_success = $file->storeAs($destinationPath, $filename)){
                $data = $this->readFile($filename);
                $info = [
                    'employees' => $data,
                    'type' => 1
                ];
                return view('administracion.employees.showDataLayout')->with('data', $info);
            } else {
                dd('Ocurrio un error al cargar el archivo, intente de nuevo.');
        
                return redirect()->to('/admin-users');
            }
        }
    }

    private function readFile($filename) {
        $data = $this->getCSVData($filename);//llamada a metodo interno
        $checkData = $this->checkData($data);//llamada a metodo interno
        return $val = $checkData;//Aqui se declara el nombre de la tabla
    }

    private function getCSVData($filename){
        $fileData = array();
        $numero_campos = 0;

        $File = fopen($this->path . $filename, 'r');
        $i = 0;

        while ($data = fgetcsv($File, 0, $this->separator)){
            
            if($i == 0){ // Solo la primer fila
                $j = 0;
                $column = '';
                while (!empty($data[$j])){
                    $column = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data[$j]);
                    $this->headers[$j] = $column;
                    $j++;
                }
            } else {
               $j = 0;
               $columnData = '';
                while (!empty($data[$j])){
                    $columnData = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data[$j]);
                    $this->dataFromFile[$i][$this->headers[$j]] = $columnData;
                    $j++;
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
                //Checamos en la BD si esxiste
                if (! Employee::where($this->keyForEmployee, $new[$this->keyForEmployee])->exists()){
                    $numero_insertados = array_add($numero_insertados, $i, $new);
                    //$numero_insertados++;
                }

                if (Employee::where($this->keyForEmployee, $new[$this->keyForEmployee])->exists()){
                    $numero_actualizados = array_add($numero_actualizados, $i, $new);
                    //$numero_actualizados++;
                }

                $array_rfc = array_add($array_rfc, $i, $new[$this->keyForEmployee]);
                $i++;
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
