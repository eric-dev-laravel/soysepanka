<?php

namespace App\Http\Controllers\ComunicacionInterna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Administracion\Employee;

class BirthdayController extends Controller
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
        $today = date('Y-m-d');
        $next = date("Y-m-d", strtotime("+30 day", strtotime($today)));
        $date1 = substr($today, -5, 5);
        $date2 = substr($next, -5, 5);
        $employees = Employee::whereRaw('date_format(nacimiento, "%m-%d") between ? and ?', [$date1, $date2])->orderBy('nacimiento', 'ASC')->get();
        if($employees->isEmpty()){
            $today = $next;
            $next = date("Y-m-d", strtotime("+30 day", strtotime($today)));
            $date1 = substr($today, -5, 5);
            $date2 = substr($next, -5, 5);
            $employees = Employee::whereRaw('date_format(nacimiento, "%m-%d") between ? and ?', [$date1, $date2])->orderBy('nacimiento', 'ASC')->get();
        }
        //dd($employees[1]->isUser->url_path);
        $data = [
            'employee' => $employees,
        ];
        return view('comunicacionInterna.cumpleanios', compact(['data']));
    }
}
