<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Enterprise;
use App\Models\Administracion\Mark;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Area;
use App\Models\Administracion\Department;
use App\Models\Administracion\JobPosition;
use App\Models\Administracion\JobPositionCatalog;
use App\Models\Administracion\hierarchical_levels_positions;
use App\Models\Administracion\Gender;
use App\Models\Administracion\MaritalStatus;
use App\Models\Administracion\WorkShift;
use App\Models\Administracion\JobPositionLanguaje;
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
        /*$enterprises = Mark::withTrashed()->get();
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
        ];*/
        //return view('administracion.jobpositions.create', compact(['data']));
        return view('administracion.jobpositions.create');
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        $data2 = request()->except(['_token', '_method', 'jobPositionSelected', 'jobPositionCatalog_length']);
        $idJobPositions = explode(",", $data['jobPositionSelected']);
        try {
            DB::beginTransaction();
                foreach($idJobPositions as $id){
                    $jobPositionCatalog = JobPositionCatalog::find($id)->toArray();
                    $jobPositionLanguaje = JobPositionLanguaje::where('id_jobposition', $id)->get()->toArray();
                    $jobPosition = JobPosition::create($jobPositionCatalog);
                    JobPosition::whereId($jobPosition->id)->update($data2);
                    foreach($jobPositionLanguaje as $languaje){
                        $languaje['id_jobposition'] = $jobPosition->id;
                        JobPositionLanguaje::create($languaje);
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

        return redirect('admin-jobpositions/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $enterprises = Enterprise::withTrashed()->orderBy('name', 'ASC')->get();
        $marks = Mark::withTrashed()->orderBy('name', 'ASC')->get();
        $directions = Direction::withTrashed()->orderBy('name', 'ASC')->get();
        $areas = Area::withTrashed()->orderBy('name', 'ASC')->get();
        $departments = Department::withTrashed()->orderBy('name', 'ASC')->get();
        $jobposition = JobPosition::withTrashed()->where('id', '=', $id)->get();
        $genders = Gender::orderByRaw('name ASC')->get();
        $marital_status = MaritalStatus::orderByRaw('name ASC')->get();
        $workshifts = WorkShift::orderByRaw('name ASC')->get();
        $levels_positions = hierarchical_levels_positions::orderByRaw('level ASC')->get();
        $list_jobpositions = JobPosition::withTrashed()->where('id', '!=', $id)->orderBy('name', 'DESC')->get();
        $jobpositionlanguaje = JobPositionLanguaje::where('id_jobposition', '=', $id)->get();

        $data = [
            'enterprises' => $enterprises,
            'marks' => $marks,
            'directions' => $directions,
            'areas' => $areas,
            'departments' => $departments,
            'jobposition' => $jobposition,
            'levels_positions' => $levels_positions,
            'list_jobpositions' => $list_jobpositions,
            'genders' => $genders,
            'marital_status' => $marital_status,
            'workshifts' => $workshifts,
            'jobpositionlanguaje' => $jobpositionlanguaje,
        ];

        return view('administracion.jobpositions.edit', compact(['data']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);
        $data2 = request()->except(['_token', '_method', 'nlanguage', 'reading', 'writing', 'spoken']);
        try {
             DB::beginTransaction();
                JobPosition::withTrashed()->whereId($id)->update($data2);
                $languaje = JobPositionLanguaje::whereIdJobposition($id);
                $languaje->delete();

                if($data['nlanguage'] != null){
                    for($i = 0; $i < count($data['nlanguage']); $i++){
                        JobPositionLanguaje::create(array (
                            'id_jobposition' => $id,
                            'name' => $data['nlanguage'][$i],
                            'read' => $data['reading'][$i],
                            'write' => $data['writing'][$i],
                            'conversation' => $data['spoken'][$i],
                        ));
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
                    ->editColumn('id_mark', function($row){
                        if(!empty($row->id_mark))
                            $content = $row->mark->name;
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
