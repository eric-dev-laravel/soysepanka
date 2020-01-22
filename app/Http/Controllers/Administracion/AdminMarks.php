<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Mark;
use App\Models\Administracion\Enterprise;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminMarks extends Controller
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
        $all_directions = Mark::withTrashed()->count();
        $inactive_directions = Mark::onlyTrashed()->count();
        $active_directions = $all_directions - $inactive_directions;

        $directions_data = [
            'all_directions' => $all_directions,
            'active_directions' => $active_directions,
            'inactive_directions' => $inactive_directions,
        ];

        return view('administracion.marks.index', compact(['directions_data']));
    }

    public function create(){
        $enterprises = Enterprise::withTrashed()->get();
        return view('administracion.marks.create', compact(['enterprises']));
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
            Mark::create($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-marks/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $enterprises = Enterprise::withTrashed()->get();
        $direction = Mark::withTrashed()->where('id', '=', $id)->get();

        $info_direction = [
            'enterprises' => $enterprises,
            'direction' => $direction,
        ];

        return view('administracion.marks.edit', compact(['info_direction']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

        try {
             DB::beginTransaction();
             Mark::withTrashed()->whereId($id)->update($data);
             DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-marks/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = Mark::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-marks/'.$id.'/edit')->with('success','Ok');
    }

    public function activeMark($id){
        try {
            DB::beginTransaction();
            Mark::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-marks/'.$id.'/edit')->with('success','Ok');
    }

    public function listMarks(Request $request){
        if ($request->ajax()) {
            $data = Mark::withTrashed()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('id_enterprise', function($row){
                        if(!empty($row->id_enterprise))
                            $content = $row->enterprise->name;
                        else
                            $content = 'N/A';

                        return $content;
                    })
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-marks/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-marks/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.marks.index');
    }
}
