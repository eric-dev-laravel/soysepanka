<?php

namespace App\Http\Controllers\Expediente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Administracion\Employee;
use App\Models\Expediente\Record;
use DB;
use Redirect;

class RecordController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');
        $this->folderImageUser = 'users';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();
        $employee_info = "";
        $records_info = "";
        $all_employee = Employee::orderBy('Nombre', 'ASC')->get();
        if(! is_null($user->id_employee)) {
            $employee_info = Employee::withTrashed()->where('id', $user->id_employee)->get();
            $records_info = Record::withTrashed()->where('id_employee', $user->id_employee)->get();
        }

        $data = [
            'employee_info' => $employee_info,
            'records_info' => $records_info,
            'all_employee' => $all_employee,
        ];
        return view('expediente.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);
        dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record){
        //
    }

    public function updateUserProfilePicture(Request $request, int $id) {
        try {
            DB::beginTransaction();
            if($request->hasFile('image')){
                $path = $request->image->store($this->folderImageUser);
                try {
                    Record::withTrashed()->where('id_employee', $id)->update(array(
                        'picture' => $path,
                    ));
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $errorsMessage = [
                        'fullMessage' => $e->getMessage(),
                    ];
                    return Redirect::back()->withErrors($errorsMessage);
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
        return redirect('records')->with('success','Ok');
    }
}
