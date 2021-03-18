<?php

namespace App\Http\Controllers\ComunicacionInterna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Administracion\Employee;

class NewEmployees extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');

        $this->birthdayNumber = env('BIRTHDAYNUMBER');
    }

    public function index() {
        $employees = Employee::limit($this->birthdayNumber)->orderBy('ingreso', 'DESC')->get();
        $data = [
            'employee' => $employees,
        ];
        return view('comunicacionInterna.newemployees', compact(['data']));
    }
}
