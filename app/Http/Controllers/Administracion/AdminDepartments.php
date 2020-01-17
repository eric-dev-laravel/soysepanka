<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Enterprise;
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
        /*$enterprises = Enterprise::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $data = [
            'enterprises' => $enterprises,
            'directions' => $directions,
        ];
        return view('administracion.areas.create', compact(['data']));*/
    }

    public function store(Request $request){
        /*$data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                Area::create($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-areas/create')->with('success','Ok');*/
    }

    public function show($id){}

    public function edit($id){
        /*$enterprises = Enterprise::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $area = Area::withTrashed()->where('id', '=', $id)->get();

        $info_direction = [
            'enterprises' => $enterprises,
            'directions' => $directions,
            'area' => $area,
        ];

        return view('administracion.areas.edit', compact(['info_direction']));*/
    }

    public function update(Request $request, $id){
        /*$data = request()->except(['_token', '_method']);

        try {
             DB::beginTransaction();
                Area::withTrashed()->whereId($id)->update($data);
             DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-areas/'.$id.'/edit')->with('success','Ok');*/
    }

    public function destroy($id){
        /*try {
            DB::beginTransaction();
                $employee = Area::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-areas/'.$id.'/edit')->with('success','Ok');*/
    }

    public function activeArea($id){
        /*try {
            DB::beginTransaction();
            Area::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-areas/'.$id.'/edit')->with('success','Ok');*/
    }

    public function listDepartments(Request $request){
        if ($request->ajax()) {
            $data = Department::withTrashed()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-areas/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-areas/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.departments.index');
    }
}
