<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Employee;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminEmployees extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
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

    public function create(){}

    public function store(){}

    public function show($id){}

    public function edit($id){
        $info_employee = Employee::where('id', '=', $id)->get();

        return view('administracion.employees.edit', compact(['info_employee']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                Employee::whereId($id)->update($data);
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

    public function destroy($id){}

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
                            $btn = '<a href="admin-employees/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-check"></i> '.trans('message.buttons.active').'</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.employees.index');
    }
}
