<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Mark;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminAreas extends Controller
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
        $all_areas = Area::withTrashed()->count();
        $inactive_areas = Area::onlyTrashed()->count();
        $active_areas = $all_areas - $inactive_areas;

        $areas_data = [
            'all_areas' => $all_areas,
            'active_areas' => $active_areas,
            'inactive_areas' => $inactive_areas,
        ];

        return view('administracion.areas.index', compact(['areas_data']));
    }

    public function create(){
        $enterprises = Mark::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $data = [
            'enterprises' => $enterprises,
            'directions' => $directions,
        ];
        return view('administracion.areas.create', compact(['data']));
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
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

        return redirect('admin-areas/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $enterprises = Mark::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $area = Area::withTrashed()->where('id', '=', $id)->get();

        $info_direction = [
            'enterprises' => $enterprises,
            'directions' => $directions,
            'area' => $area,
        ];

        return view('administracion.areas.edit', compact(['info_direction']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

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

        return redirect('admin-areas/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
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
        return redirect('admin-areas/'.$id.'/edit')->with('success','Ok');
    }

    public function activeArea($id){
        try {
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
        return redirect('admin-areas/'.$id.'/edit')->with('success','Ok');
    }

    public function listAreas(Request $request){
        if ($request->ajax()) {
            $data = Area::withTrashed()->get();
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

        return view('administracion.directions.index');
    }
}
