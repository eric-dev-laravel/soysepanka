<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Enterprise;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use App\Models\Administracion\Department;
use App\Models\Administracion\JobPosition;
use App\Models\Administracion\hierarchical_levels_positions;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminJobPositions extends Controller
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
        $all_jobpositions = JobPosition::withTrashed()->count();
        $inactive_jobpositions = JobPosition::onlyTrashed()->count();
        $active_jobpositions = $all_jobpositions  - $inactive_jobpositions;

        $jobpositions_data = [
            'all_jobpositions' => $all_jobpositions,
            'active_jobpositions' => $active_jobpositions,
            'inactive_jobpositions' => $inactive_jobpositions,
        ];

        return view('administracion.jobpositions.index', compact(['jobpositions_data']));
    }

    public function create(){
        $enterprises = Enterprise::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $areas = Area::withTrashed()->get();
        $departments = Department::withTrashed()->get();
        $levels_positions = hierarchical_levels_positions::orderByRaw('level ASC')->get();
        $list_jobpositions = JobPosition::withTrashed()->orderByRaw('id_level DESC')->get();
        $data = [
            'enterprises' => $enterprises,
            'directions' => $directions,
            'areas' => $areas,
            'departments' => $departments,
            'levels_positions' => $levels_positions,
            'list_jobpositions' => $list_jobpositions,
        ];
        return view('administracion.jobpositions.create', compact(['data']));
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                JobPosition::create($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-jobpositions/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $enterprises = Enterprise::withTrashed()->get();
        $directions = Direction::withTrashed()->get();
        $areas = Area::withTrashed()->get();
        $departments = Department::withTrashed()->get();
        $jobposition = JobPosition::withTrashed()->where('id', '=', $id)->get();
        $levels_positions = hierarchical_levels_positions::orderByRaw('level ASC')->get();
        $list_jobpositions = JobPosition::withTrashed()->where('id', '!=', $id)->orderByRaw('id_level DESC')->get();

        $info_direction = [
            'enterprises' => $enterprises,
            'directions' => $directions,
            'areas' => $areas,
            'departments' => $departments,
            'jobposition' => $jobposition,
            'levels_positions' => $levels_positions,
            'list_jobpositions' => $list_jobpositions,
        ];

        return view('administracion.jobpositions.edit', compact(['info_direction']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

        try {
             DB::beginTransaction();
                JobPosition::withTrashed()->whereId($id)->update($data);
             DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-jobpositions/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = JobPosition::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-jobpositions/'.$id.'/edit')->with('success','Ok');
    }

    public function activeJobPosition($id){
        try {
            DB::beginTransaction();
            JobPosition::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-jobpositions/'.$id.'/edit')->with('success','Ok');
    }

    public function listJobPositions(Request $request){
        if ($request->ajax()) {
            $data = JobPosition::withTrashed()->get();
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
                    ->editColumn('id_department', function($row){
                        if(!empty($row->id_department))
                            $content = $row->department->name;
                        else
                            $content = 'N/A';

                        return $content;
                    })
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-jobpositions/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-jobpositions/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.jobpositions.index');
    }
}
