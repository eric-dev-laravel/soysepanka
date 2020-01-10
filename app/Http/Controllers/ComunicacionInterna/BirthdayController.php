<?php namespace App\Http\Controllers\ComunicacionInterna;

use DB;
use App\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Canadian\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Finder;
use App\Http\Controllers;
use Mail;

use App\User;
use App\Employee;
use App\Models\JobPosition;
use App\Models\Direction;
use App\Models\Department;
use App\Models\Area;
use App\Models\JobPositionLevel;
use App\Models\Enterprise;
use App\UserProfile;

use App\Models\Announcement\View;
use App\Models\Announcement\Announcement;

 use Illuminate\Support\Facades\Route;
class BirthdayController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}


	public function index(){
		setLocale(LC_TIME, 'Spanish');
		Carbon::setUtf8(true);
		//campus del usuario logeado para validar que solo cargue en la vista personas del mismo campus
		//$logUserComp = Auth::user()->company;
		$users = null;
		//Se agrega fecha de ayer, porque el curdate, retornaba 2018-10-00
		//el día lo regresaba en 00

		$date = date("Y-m-d");
		$ayer = date("Y-m-d", strtotime("-1 day", strtotime($date)));
		/*$users =  Employee::whereNull('deleted_at')
		->whereRaw("DATE(CONCAT_WS('-',YEAR(CURDATE()),MONTH(nacimiento),DAY(nacimiento))) <= DATE_ADD('$ayer', INTERVAL 30 DAY)")
		->whereRaw("DATE(CONCAT_WS('-',YEAR(CURDATE()),MONTH(nacimiento),DAY(nacimiento))) >= CURDATE()-1")
		->orderByRaw("DATE(CONCAT_WS('-',YEAR(CURDATE()),MONTH(nacimiento),DAY(nacimiento)))")
		->get();*/

		//dd($date->day);

		// if($date->month == 12) {
		// 	$tmp = Employee::whereMonth('nacimiento', '=', 1)
		// 			->whereDay('nacimiento', '<=', $date->day)
		// 			->whereNull('deleted_at')
		// 			->orderByRaw("MONTH(nacimiento),DAYOFMONTH(nacimiento)")
		// 			->get();

		// 	$users = $users->merge($tmp);
		// }

		/*foreach ($users as $key => $user) {
			if($user->user != null) {
				$profile = UserProfile::select('user_id','image','hobbies')->where('user_id',$user->user->id)->first();
				$job = JobPosition::where('id',$user->job_position_id)->first();

				if($job != null)
				{
					$user->job_position_id = $job->name;
					if(isset($job->area->department)) {
						$user->department_name = $job->area->department->name;
					}
				}

				if($profile != null)
				{
					if($profile->image != null || $profile->image != ''){
						$user->photo = 'uploads/'.$profile->image;
					}else{
						$user->photo = 'img/profile.png';
					}

				}else{
					$user->photo = 'img/profile.png';
				}
			}
        }*/

		/*$uSearch =  Employee::selectRaw("CONCAT(nombre,' ',paterno,' - ') AS uS, nacimiento")
		->whereNull('deleted_at')
		->get();*/

		//$view = View::where('name','cumpleaños')->first();
        //Traemos todos los anuncios activos y que esten vigentes en cuanto a la fecha de inicio y fin
        //$banner = Announcement::getAnnouncementsToDisplay($view->id, 'banner');
        // dd($tabla_anuncios);
		//$display_announcements = compact('banner', 'tabla_anuncios');

        return view('comunicacionInterna.cumpleanios', compact('display_announcements', 'users', 'uSearch'));
	}

}
