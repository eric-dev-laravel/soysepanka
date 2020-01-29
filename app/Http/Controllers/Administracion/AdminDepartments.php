<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Mark;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use App\Models\Administracion\Department;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminDepartments extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
    }

    public function index() {
        $all_departments = Department::withTrashed()->count();
        $inactive_departments = Department::onlyTrashed()->count();
        $active_departments = $all_departments  - $inactive_departments;

        $departments_data = [
            'all_departments' => $all_departments,
            'active_departments' => $active_departments,
            'inactive_departments' => $inactive_departments,
        ];

        return view('administracion.departments.index', compact(['departments_data']));
    }

    public function create(){
        $enterprises = Mark::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $areas = Area::withTrashed()->get();
        $data = [
            'enterprises' => $enterprises,
            'directions' => $directions,
            'areas' => $areas,
        ];
        return view('administracion.departments.create', compact(['data']));
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                Department::create($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-departments/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $enterprises = Mark::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $areas = Area::withTrashed()->get();
        $department = Department::withTrashed()->where('id', '=', $id)->get();

        $info_direction = [
            'enterprises' => $enterprises,
            'directions' => $directions,
            'areas' => $areas,
            'department' => $department,
        ];

        return view('administracion.departments.edit', compact(['info_direction']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

        try {
             DB::beginTransaction();
                Department::withTrashed()->whereId($id)->update($data);
             DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-departments/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = Department::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-departments/'.$id.'/edit')->with('success','Ok');
    }

    public function activeDepartment($id){
        try {
            DB::beginTransaction();
            Department::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-departments/'.$id.'/edit')->with('success','Ok');
    }

    public function listDepartments(Request $request){
        if ($request->ajax()) {
            $data = Department::withTrashed()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('id_enterprise', function($row){
                        if(!empty($row->id_enterprise))
                            $content = $row->enterprise->name;
                        else
                            $content = 'N/A';

                        return $content;
                    })
                    ->editColumn('id_direction', function($row){
                        if(!empty($row->id_direction))
                            $content = $row->direction->name;
                        else
                            $content = 'N/A';

                        return $content;
                    })
                    ->editColumn('id_area', function($row){
                        if(!empty($row->id_area))
                            $content = $row->area->name;
                        else
                            $content = 'N/A';

                        return $content;
                    })
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-departments/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-departments/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.departments.index');
    }
}
