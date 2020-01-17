<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administracion\Enterprise;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;

class AdminEnterprises extends Controller
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
        $all_enterprise = Enterprise::withTrashed()->count();
        $inactive_enterprises = Enterprise::onlyTrashed()->count();
        $active_enterprises = $all_enterprise - $inactive_enterprises;

        $enterprices_data = [
            'all_enterprises' => $all_enterprise,
            'active_enterprises' => $active_enterprises,
            'inactive_enterprises' => $inactive_enterprises,
        ];

        return view('administracion.enterprises.index', compact(['enterprices_data']));
    }

    public function create(){
        return view('administracion.enterprises.create');
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);

        try {
            DB::beginTransaction();
                Enterprise::create($data);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-enterprises/create')->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $info_enterprise = Enterprise::withTrashed()->where('id', '=', $id)->get();

        return view('administracion.enterprises.edit', compact(['info_enterprise']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);

        try {
             DB::beginTransaction();
                Enterprise::withTrashed()->whereId($id)->update($data);
             DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('admin-enterprises/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = Enterprise::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-enterprises/'.$id.'/edit')->with('success','Ok');
    }

    public function activeEnterprise($id){
        try {
            DB::beginTransaction();
            Enterprise::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-enterprises/'.$id.'/edit')->with('success','Ok');
    }

    public function listEnterprises(Request $request){
        if ($request->ajax()) {
            $data = Enterprise::withTrashed()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-enterprises/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-enterprises/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.enterprises.index');
    }
}
