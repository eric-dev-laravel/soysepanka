<?php

namespace App\Http\Controllers\ComunicacionInterna;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Administracion\Employee;

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
    }

    public function index() {

        //Método para la vista de Árbol
        $list = '';
        $boss_first = Employee::where('jefe', '')->orWhere('jefe', '0')->orderBy('nombre','DESC')->get();

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
            $list2 = '<ul class="treeview">';
            foreach($boss_first as $boss){
                $list2 .='<li id="open" class="encont"><a tabindex="1" class="btn btn-primary" style="background:#007AAB !important;color:white; margin-bottom:10px;" data-toggle="popover" data-trigger="focus" data-content="<strong><div class=bg-yellow>'.$boss->nombre. ' '.$boss->paterno. ' '.$boss->materno. ' '.'</div></strong><div>'.(isset($boss->puesto)?$boss->puesto:'N/A').'</div><div>'.$boss->sucursal.'</div><div>'.$boss->correoempresa.'</div><strong>Teléfono: </strong>'.($boss->telefono?$boss->telefono:'N/A').'<br><strong>Celular: </strong>'.($boss->celular?$boss->celular:'N/A').'<br><strong>Pasatiempos:</strong><br>">'.$boss->nombre. ' '.$boss->paterno. ' '.$boss->materno. ' '.' - '.     (isset($boss->puesto)?$boss->puesto:'N/A').'</a>';
                $list2 .= $this->subBossList($boss->idempleado,$nivel);
                $list2 .= '</li>';
            }
            $list2 .= '</ul>';
        }
        $data = [
            'list' => $list,
            'list2' => $list2,
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
                $list2 .='<li class="encont"><a tabindex="0" class="label label-default badge" style="background:'.$nivelcolor[$nivel].' !important;color:white; margin-bottom:10px;" data-toggle="popover" data-trigger="focus" data-content="<strong><div class=bg-yellow>'.$sub->nombre. ' ' .$sub->paterno. ' ' .$sub->materno. ' ' .'</div></strong><div>'.(isset($sub->puesto)?$sub->puesto:'N/A').'</div><div>'.$sub->sucursal.'</div><div>'.$sub->correoempresa.'</div><strong>Teléfono: </strong>'.($sub->telefono?$sub->telefono:'N/A').'<br><strong>Celular: </strong>'.($sub->celular?$sub->celular:'N/A').'<br><strong>Pasatiempos:</strong><br>">'.$sub->nombre. ' '.$sub->paterno. ' '.$sub->materno. ' '.' - '.    (isset($sub->puesto)?$sub->puesto:'N/A').'</a>';
                $list2 .= $this->subBossList($sub->idempleado,$nivel+1);
                $list2 .= '</li>';
            }
            $list2 .= '</ul>';
        }
        return $list2;
    }
}
