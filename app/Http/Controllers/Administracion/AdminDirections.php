<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Direction;
use App\Models\Administracion\Mark;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminDirections extends Controller
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
        $all_directions = Direction::withTrashed()->count();
        $inactive_directions = Direction::onlyTrashed()->count();
        $active_directions = $all_directions - $inactive_directions;

        $directions_data = [
            'all_directions' => $all_directions,
            'active_directions' => $active_directions,
            'inactive_directions' => $inactive_directions,
        ];

        return view('administracion.directions.index', compact(['directions_data']));
    }

    public function create(){
        $enterprises = Mark::withTrashed()->get();
        return view('administracion.directions.create', compact(['enterprises']));
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        try {
            DB::beginTransaction();
                Direction::create($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-directions/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $enterprises = Mark::withTrashed()->get();
        $direction = Direction::withTrashed()->where('id', '=', $id)->get();

        $info_direction = [
            'enterprises' => $enterprises,
            'direction' => $direction,
        ];

        return view('administracion.directions.edit', compact(['info_direction']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

        try {
             DB::beginTransaction();
                Direction::withTrashed()->whereId($id)->update($data);
             DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-directions/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = Direction::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-directions/'.$id.'/edit')->with('success','Ok');
    }

    public function activeDirection($id){
        try {
            DB::beginTransaction();
            Direction::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-directions/'.$id.'/edit')->with('success','Ok');
    }

    public function listDirections(Request $request){
        if ($request->ajax()) {
            $data = Direction::withTrashed()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('id_mark', function($row){
                        if(!empty($row->id_mark))
                            $content = $row->mark->name;
                        else
                            $content = 'N/A';

                        return $content;
                    })
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-directions/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-directions/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.directions.index');
    }
}
