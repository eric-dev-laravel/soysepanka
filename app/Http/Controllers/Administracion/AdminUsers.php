<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Administracion\Employee;
use App\Models\Expediente\Record;
use Yajra\Datatables\Datatables;
use DB;
use Redirect;
use App\Exports\UsersExport;

class AdminUsers extends Controller
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
        $all_users = User::withTrashed()->count();
        $inactive_users = User::onlyTrashed()->count();
        $only_users = User::withTrashed()->where('id_employee', '=', null)->count();
        $users_employees = $all_users - $only_users;
        $all_employees = Employee::withTrashed()->count();

        $users_data = [
            'all_users' => $all_users,
            'active_users' => $all_users - $inactive_users,
            'inactive_users' => $inactive_users,
            'only_users' => $only_users,
            'users_employees' => $users_employees,
            'only_employees' => $all_employees - $users_employees,
        ];

        return view('administracion.users.index', compact(['users_data']));
    }

    public function create(){
        return view('administracion.users.create');
    }

    public function store(Request $request){
        $data = request()->except(['_token', '_method']);
        if($data['type'] == 1){
            $idemployee = null;
            if(!empty($data['id_employee'])){
                $idemployee = (int)$data['id_employee'];
            }
            $password = $data['password'];
            $retrypassword = $data['password_confirmation'];
            if($password === $retrypassword){
                try {
                    DB::beginTransaction();
                        $user = User::create(array(
                            'id_employee' => $idemployee,
                            'name'        => $data['name'],
                            'email'       => $data['email'],
                            'password'    => bcrypt($password),
                        ));
                    DB::commit();
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $errorsMessage = [
                        'fullMessage' => $e->getMessage(),
                    ];

                    return Redirect::back()->withErrors($errorsMessage);
                }
            } else {
                $errorsMessage = [
                    'fullMessage' => 'Las contraseñas no coinciden, intenta nuevamente.',
                ];

                return Redirect::back()->withErrors($errorsMessage);
            }
        } else if($data['type'] == 2){
            $idemployee = (int)$data['idemployee'];
            $name = $data['nombre'] . ' ' . $data['paterno'] . ' ' . $data['materno'];
            $email = $data['email'];
            $password = $data['password'];
            $retrypassword = $data['password_confirmation'];
            if($password === $retrypassword){
                try {
                    DB::beginTransaction();
                    $user = User::create(array(
                            'id_employee' => $idemployee,
                            'name'        => $name,
                            'email'       => $email,
                            'password'    => bcrypt($password),
                        ));

                        if(!is_null($idemployee)){
                            Record::withTrashed()->where('id_employee', $idemployee)->update(array(
                                'id_user' => $user->id,
                            ));
                        }
                    DB::commit();
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $errorsMessage = [
                        'fullMessage' => $e->getMessage(),
                    ];

                    return Redirect::back()->withErrors($errorsMessage);
                }
            } else {
                $errorsMessage = [
                    'fullMessage' => 'Las contraseñas no coinciden, intenta nuevamente.',
                ];

                return Redirect::back()->withErrors($errorsMessage);
            }
        }

        return redirect('create-user-from-employee/'.$idemployee)->with('success','Ok');
    }

    public function show($id){}

    public function edit($id){
        $info_employee = User::withTrashed()->where('id', '=', $id)->get();

        return view('administracion.users.edit', compact(['info_employee']));
    }

    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);
        $password = $data['password'];
        $retrypassword = $data['password_confirmation'];
        if(empty($password) and empty($retrypassword)) {
            try {
                DB::beginTransaction();
                    User::withTrashed()->whereId($id)->update(array(
                        'name' => $data['name'],
                        'email' => $data['email']
                    ));
                DB::commit();
            } catch (\PDOException $e) {
                DB::rollBack();
                $errorsMessage = [
                    'fullMessage' => $e->getMessage(),
                ];

                return Redirect::back()->withErrors($errorsMessage);
            }
        } else {
            if($password === $retrypassword){
                try {
                    DB::beginTransaction();
                        User::withTrashed()->whereId($id)->update(array(
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password'])
                        ));
                    DB::commit();
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $errorsMessage = [
                        'fullMessage' => $e->getMessage(),
                    ];

                    return Redirect::back()->withErrors($errorsMessage);
                }
            } else {
                $errorsMessage = [
                    'fullMessage' => 'Las contraseñas no coinciden, intenta nuevamente.',
                ];

                return Redirect::back()->withErrors($errorsMessage);
            }
        }

        return redirect('admin-users/'.$id.'/edit')->with('success','Ok');
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
                $employee = User::find($id);
                $employee->delete();
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-users/'.$id.'/edit')->with('success','Ok');
    }

    public function listUsers(Request $request){
        if ($request->ajax()) {
            $data = User::withTrashed()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if(empty($row->deleted_at))
                            $btn = '<a href="admin-users/'.$row->id.'/edit" class="edit btn btn-success btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';
                        else
                            $btn = '<a href="admin-users/'.$row->id.'/edit" class="edit btn btn-danger btn-sm"> <i class="fa fa-pencil"></i> '.trans('message.buttons.edit').'</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administracion.users.index');
    }

    public function activeUser($id){
        try {
            DB::beginTransaction();
                User::onlyTrashed()->find($id)->restore(); //Recupera el usuario borrado
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-users/'.$id.'/edit')->with('success','Ok');
    }

    public function createFromEmployee($id){
        $info_employee = Employee::where('id', '=', $id)->get();

        return view('administracion.users.createFromEmployee', compact(['info_employee']));
    }

    public function unlinkFromEmployee($id){
        try {
            DB::beginTransaction();
                User::withTrashed()->whereId($id)->update(array(
                    'id_employee' => null,
                ));
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('admin-users/'.$id.'/edit')->with('success','Ok');
    }

    public function downloadUsers($id){
        $usersExport = new UsersExport;

        return $usersExport->exportUsers($id)->download('users.xlsx');
    }
}
