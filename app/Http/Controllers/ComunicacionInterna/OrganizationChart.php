<?php

namespace App\Http\Controllers\ComunicacionInterna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\JobPositionChart;

use App\User;
use App\Models\Administracion\Employee;
use App\Models\Administracion\JobPosition;
use App\Models\Administracion\JobPositionAddtional;

class OrganizationChart extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');

        $this->borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $this->fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

    }

    public function index() {

        $boss_first = Employee::whereNull('jefe')->orWhere('jefe', '0')->orWhere('jefe', '')->orderBy('nombre','DESC')->get();
        $jobposition_first = JobPosition::whereNull('id_boss_position')->orWhere('id_boss_position', '0')->orWhere('id_boss_position', '')->orderBy('name','DESC')->get();

        $number_places = 0;
        $number_places_used = 0;

        $jobposition_places = JobPosition::get();
        $employee_jobposition = Employee::where('id_puesto', '>', 0)->count();
        $employee_additional_jobposition = JobPositionAddtional::count();
        //dd($employee_additional_jobposition);
        foreach($jobposition_places as $places){
            $number_places = $number_places + $places->places;
        }

        //Método para la vista de Árbol
        $list = '';

        //dd($boss_first);
        if(count($boss_first) > 0){
            $list = '<ul>';
            foreach($boss_first as $boss){
                $list .='<li><a href="#">'.$boss->nombre.' '.$boss->paterno.' '.$boss->materno.' '.'<br><strong>'.$boss->puesto.'</strong></a>';
                $list .= $this->subBoss($boss->idempleado);
                $list .= '</li>';
            }
            $list .= '</ul>';
        }
        //Fin método para la vista de Árbol

        //Método para la vista de Lista
        $list2 = '';
        //variable para definir el nivel de org, (para definir el color del items del menu)
        $nivel = 0;

        if(count($boss_first) > 0){
            $list2 = '<ul class="treeview_custom">';
            foreach($boss_first as $boss){
                $image = 'img/record/user.png';
                $user = User::where('id_employee', $boss->id)->first();
                $hobbies = 'N/A';
                if($user){
                    $image = is_null($user->picture)?'img/record/user.png':$user->url_path;
                }

                $list2 .='<li id="open" class="encont"><a tabindex="1" class="btn btn-primary" style="background:#007AAB !important;color:white; margin-bottom:10px;" data-toggle="popover" title="<div class=bg-yellow><strong>'.$boss->nombre. ' '.$boss->paterno. ' '.$boss->materno. ' '.'</strong></div>" data-trigger="focus" data-content="<img class=img-orgChart src='.asset($image).'><div>'.(isset($boss->puesto)?$boss->puesto:'N/A').'</div><div>'.$boss->sucursal.'</div><div>'.$boss->correoempresa.'</div><strong>Teléfono: </strong>'.($boss->telefono?$boss->telefono:'N/A').'<br><strong>Celular: </strong>'.($boss->celular?$boss->celular:'N/A').'<br><strong>Pasatiempos:</strong><br>">'.$boss->nombre. ' '.$boss->paterno. ' '.$boss->materno. ' '.' - '. (isset($boss->puesto)?$boss->puesto:'N/A').'</a>';
                $list2 .= $this->subBossList($boss->idempleado,$nivel);
                $list2 .= '</li>';
            }
            $list2 .= '</ul>';
        }

        //Método para la vista de Lista
        $list3 = '';
        //variable para definir el nivel de org, (para definir el color del items del menu)
        $nivel3 = 0;

        if(count($jobposition_first) > 0){
            $list3 = '<ul class="treeview_custom">';
            foreach($jobposition_first as $jobposition){
                $number_jobposition = Employee::where('id_puesto', $jobposition->id)->count();
                $number_jobposition_additional = JobPositionAddtional::where('id_jobposition', $jobposition->id)->count();
                if($number_jobposition_additional > 0) {
                    $list3 .='<li id="open" class="encont"><a tabindex="1" class="btn btn-primary" style="background:#007AAB !important;color:white; margin-bottom:10px;">'.$jobposition->name. ' | Ocupados: ' . $number_jobposition.' - Plazas: '.$jobposition->places . ' - Temporales: <span style="color: red;">' . $number_jobposition_additional.'</span></a>';
                } else {
                    $list3 .='<li id="open" class="encont"><a tabindex="1" class="btn btn-primary" style="background:#007AAB !important;color:white; margin-bottom:10px;">'.$jobposition->name. ' | Ocupados: ' . $number_jobposition.' - Plazas: '.$jobposition->places . '</a>';
                }

                $list3 .= $this->subJobPositionList($jobposition->id,$nivel);
                $list3 .= '</li>';
            }
            $list3 .= '</ul>';
        }

        $usersChart = new JobPositionChart;
        $usersChart->minimalist(true);
        $usersChart->labels(['Plazas Totales', 'Plazas Ocupadas', 'Plazas Temporales']);
        $usersChart->dataset('Empleados ', 'bar', [$number_places, $employee_jobposition, $employee_additional_jobposition])
            ->color($this->borderColors)
            ->backgroundcolor($this->fillColors);

        $data = [
            'list' => $list,
            'list2' => $list2,
            'list3' => $list3,
            'jobPositionChart' => $usersChart,
            'alls_places' => $number_places,
            'places_used' => $employee_jobposition,
            'places_additional' => $employee_additional_jobposition,
            'places_off' => $number_places - $employee_jobposition - $employee_additional_jobposition,
        ];
        return view('comunicacionInterna.organigrama', compact(['data']));
    }

    private function subBoss($boss){
        $list2 = '';

        $subBos = Employee::where('jefe', $boss)->orderBy('division')->orderBy('nombre','ASC')->get();

        if(count($subBos) > 0){

            $list2 .= '<ul>';

            foreach($subBos as $sub){
                $list2 .='<li><a href="#">'.$sub->nombre.' '.$sub->paterno.' '.$sub->materno.' '.'<br><strong>'.$sub->puesto.'</strong></a>';
                $list2 .= $this->subBoss($sub->idempleado);
                $list2 .= '</li>';
            }

            $list2 .= '</ul>';
        }

        return $list2;
    }

    private function subBossList($boss,$nivel){
        $list2 = '';

        $subBos = Employee::where('jefe', $boss)->orderBy('division')->orderBy('nombre','ASC')->get();
        $nivelcolor=['#002C49','#0064A6','#ECC100','#4FB9FF','#228ED1','#002C49','#0064A6','#ECC100','#4FB9FF','#228ED1'];
        if(count($subBos) > 0){

            $list2 .= '<ul>';

            foreach($subBos as $sub){
                $image = 'img/record/user.png';
                $user = User::where('id_employee', $sub->id)->first();
                $hobbies = 'N/A';
                if($user){
                    $image = is_null($user->picture)?'img/record/user.png':$user->url_path;
                }
                $list2 .='<li class="encont"><a tabindex="0" class="label label-default badge" style="background:'.$nivelcolor[$nivel].' !important;color:white; margin-bottom:10px;" data-toggle="popover" data-trigger="focus" title="<div class=bg-yellow><strong>'.$sub->nombre. ' '.$sub->paterno. ' '.$sub->materno. ' '.'</strong></div>" data-content="<img class=img-orgChart src='.asset($image).'><div>'.(isset($sub->puesto)?$sub->puesto:'N/A').'</div><div>'.$sub->sucursal.'</div><div>'.$sub->correoempresa.'</div><strong>Teléfono: </strong>'.($sub->telefono?$sub->telefono:'N/A').'<br><strong>Celular: </strong>'.($sub->celular?$sub->celular:'N/A').'<br><strong>Pasatiempos:</strong><br>">'.$sub->nombre. ' '.$sub->paterno. ' '.$sub->materno. ' '.' - '.    (isset($sub->puesto)?$sub->puesto:'N/A').'</a>';
                $list2 .= $this->subBossList($sub->idempleado,$nivel+1);
                $list2 .= '</li>';
            }
            $list2 .= '</ul>';
        }
        return $list2;
    }

    private function subJobPositionList($boss,$nivel){
        $list3 = '';

        $subBos = JobPosition::where('id_boss_position', $boss)->orderBy('name','ASC')->get();
        $nivelcolor=['#002C49','#0064A6','#ECC100','#4FB9FF','#228ED1','#002C49','#0064A6','#ECC100','#4FB9FF','#228ED1'];
        if(count($subBos) > 0){
            $list3 .= '<ul>';
            foreach($subBos as $sub){
                $number_jobposition = Employee::where('id_puesto', $sub->id)->count();
                $number_jobposition_additional = JobPositionAddtional::where('id_jobposition', $sub->id)->count();
                if($number_jobposition_additional > 0){
                    $list3 .='<li class="encont"><a tabindex="0" class="btn btn-primary" style="background:'.$nivelcolor[$nivel].' !important;color:white; margin-bottom:10px;">'.$sub->department->name.' - '.$sub->name.' | Ocupados: '.$number_jobposition.' - Plazas: '.$sub->places. ' - Temporales: <span style="color: red;">' . $number_jobposition_additional.'</span></a>';
                } else {
                    $list3 .='<li class="encont"><a tabindex="0" class="btn btn-primary" style="background:'.$nivelcolor[$nivel].' !important;color:white; margin-bottom:10px;">'.$sub->department->name.' - '.$sub->name.' | Ocupados: '.$number_jobposition.' - Plazas: '.$sub->places.'</a>';
                }
                $list3 .= $this->subJobPositionList($sub->id,$nivel+1);
                $list3 .= '</li>';
            }
            $list3 .= '</ul>';
        }
        return $list3;
    }
}
