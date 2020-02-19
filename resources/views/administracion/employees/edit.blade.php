@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_employee_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_employee_title') }}
@endsection

@section('main-content')
    @if($errors->any())
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i> {{ trans('message.modals.alert') }}</h4>
                {{ trans('message.modals.alert_message') }}

                <a href="#" class="small-box-footer pull-right" data-toggle="modal" data-target="#modal-danger">{{ trans('message.modals.moreinfo') }}</i></a>
            </div>

        </div>
    </div>
    @elseif(session()->has('success'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i> {{ trans('message.modals.alert') }}</h4>
                {{ trans('message.modals.successupdate_message') }}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">

                <div class="box box-primary box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-hand-o-up"></i> {{ trans('message.options') }}</h3>
                    </div>

                    <div class="box-body">

                        <div class="row col-md-3 col-sm-12 col-md-offset-2">
                            @if($data['employee'][0]->isUser)
                                <button type="button" disabled class="btn btn-block btn-primary" onclick="window.location.href = '{{ url('create-user-from-employee/'.$data['employee'][0]->id.'') }}';"><i class="fa fa-key"></i> {{ trans('message.buttons.makeaccess') }}</button>
                            @else
                                <button type="button" class="btn btn-block btn-primary" onclick="window.location.href = '{{ url('create-user-from-employee/'.$data['employee'][0]->id.'') }}';"><i class="fa fa-key"></i> {{ trans('message.buttons.makeaccess') }}</button>
                            @endif
                        </div>

                        <div class="row col-md-3 col-sm-12 col-md-offset-2">
                            @if($data['employee'][0]->deleted_at)
                                <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-active-employee"><i class="fa fa-check-square"></i> {{ trans('message.buttons.active') }}</button>
                            @else
                                <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-unactive-employee"><i class="fa fa-minus-square"></i> {{ trans('message.buttons.unactive') }}</button>
                            @endif
                        </div>

                    </div>

                </div>

        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-user"></i> {{ trans('message.editemployee') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row col-md-12">
                        <form role="form" method="POST" action="{{ route('admin-employees.update',$data['employee'][0]->id) }}" id="update">
                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.generalinfo') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.name') }}</label>
                                        <input type="text" required class="form-control" id="nombre" name="nombre" value="{{ $data['employee'][0]->nombre }}" placeholder="{!! trans('message.form_employee_holder.name') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="paterno">{{ trans('message.datatables_headers.paterno') }}</label>
                                        <input type="text" required class="form-control" id="paterno" name="paterno" value="{{ $data['employee'][0]->paterno }}" placeholder="{!! trans('message.form_employee_holder.paterno') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="materno">{{ trans('message.datatables_headers.materno') }}</label>
                                        <input type="text" class="form-control" id="materno" name="materno" value="{{ $data['employee'][0]->materno }}" placeholder="{!! trans('message.form_employee_holder.materno') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="rfc">{{ trans('message.datatables_headers.rfc') }}</label>
                                        <input type="text" required class="form-control" id="rfc" name="rfc" value="{{ $data['employee'][0]->rfc }}" placeholder="{!! trans('message.form_employee_holder.rfc') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="curp">{{ trans('message.datatables_headers.curp') }}</label>
                                        <input type="text" class="form-control" id="curp" name="curp" value="{{ $data['employee'][0]->curp }}" placeholder="{!! trans('message.form_employee_holder.curp') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nss">{{ trans('message.datatables_headers.nss') }}</label>
                                        <input type="text" class="form-control" id="nss" name="nss" value="{{ $data['employee'][0]->nss }}" placeholder="{!! trans('message.form_employee_holder.nss') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="correopersonal">{{ trans('message.datatables_headers.personnel_mail') }}</label>
                                        <input type="email" required class="form-control" id="correopersonal" name="correopersonal" value="{{ $data['employee'][0]->correopersonal }}" placeholder="{!! trans('message.form_employee_holder.personnel_mail') !!}"
                                        class="form-control @error('email') is-invalid @enderror" autocomplete="email">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nacimiento">{{ trans('message.datatables_headers.birth') }}</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control" id="nacimiento" name="nacimiento" value="{{ $data['employee'][0]->nacimiento }}" placeholder="{!! trans('message.form_employee_holder.birth') !!}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sexo">{{ trans('message.datatables_headers.gender') }}</label>
                                        <input type="text" class="form-control" id="sexo" name="sexo" value="{{ $data['employee'][0]->sexo }}" placeholder="{!! trans('message.form_employee_holder.gender') !!}">
                                    </div>

                                </div>

                            </div>

                            <div class="box box-warning">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.personnelinfo') }}</h3>
                                </div>

                                <div class="box-body">
                                    <div class="form-group col-md-12">
                                        <label for="puesto">{{ trans('message.datatables_headers.position') }}</label>
                                        {{--<input type="text" class="form-control" id="puesto" name="puesto" value="{{ $data['employee'][0]->puesto }}" placeholder="{!! trans('message.form_employee_holder.position') !!}">--}}
                                        <select class="form-control" id="puesto" name="puesto">
                                            <option value="">{{ trans('message.datatables_headers.outjobposition') }}</option>
                                            @foreach ($data['list_jobpositions'] as $position)
                                                <?php
                                                    $enterprise = "Sin Empresa";
                                                    $mark = "Sin Marca";
                                                    $direction = "Sin Dirección";
                                                    $area = "Sin Área";
                                                    $department = "Sin Departamento";
                                                    if(!empty($position->enterprise->name))
                                                        $enterprise = $position->enterprise->name;
                                                    if(!empty($position->mark->name))
                                                        $mark = $position->mark->name;
                                                    if(!empty($position->direction->name))
                                                        $direction = $position->direction->name;
                                                    if(!empty($position->area->name))
                                                        $area = $position->area->name;
                                                    if(!empty($position->department->name))
                                                        $department = $position->department->name;
                                                ?>

                                                @if($position->name == $data['employee'][0]->puesto && $position->department->name == $data['employee'][0]->departamento)
                                                    <option selected value="{{ $enterprise.','.$mark.','.$direction.','.$area.','.$department.','.$position->name }}">{{  $enterprise.' / '.$mark.' / '.$direction.' / '.$area.' / '.$department.' / '.$position->name }}</option>
                                                @else
                                                    <option value="{{ $enterprise.','.$mark.','.$direction.','.$area.','.$department.','.$position->name }}">{{  $enterprise.' / '.$mark.' / '.$direction.' / '.$area.' / '.$department.' / '.$position->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="jefe">{{ trans('message.datatables_headers.boss') }}</label>
                                        <select class="form-control" id="jefe" name="jefe">
                                            <option value="">{{ trans('message.datatables_headers.outboss') }}</option>
                                            @foreach ($data['bosses'] as $boss)
                                                @if($boss->id == $data['employee'][0]->jefe)
                                                    <option selected value="{{ $boss->id }}">{{  $boss->nombre.' '.$boss->paterno.' '.$boss->materno }}</option>
                                                @else
                                                    <option value="{{ $boss->id }}">{{  $boss->nombre.' '.$boss->paterno.' '.$boss->materno }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="idempresa">{{ trans('message.datatables_headers.enterprise_id') }}</label>
                                        <input type="text" disabled class="form-control" id="idempresa" name="idempresa" value="{{ $data['employee'][0]->idempresa }}" placeholder="{!! trans('message.form_employee_holder.enterprise_id') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="empresa">{{ trans('message.datatables_headers.enterprise') }}</label>
                                        <input type="text" disabled class="form-control" id="empresa" name="empresa" value="{{ $data['employee'][0]->empresa }}" placeholder="{!! trans('message.form_employee_holder.enterprise') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="marca">{{ trans('message.datatables_headers.mark') }}</label>
                                        <input type="text" disabled class="form-control" id="marca" name="marca" value="{{ $data['employee'][0]->marca }}" placeholder="{!! trans('message.form_employee_holder.mark') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="direccion">{{ trans('message.datatables_headers.direction') }}</label>
                                        <input type="text" disabled class="form-control" id="direccion" name="direccion" value="{{ $data['employee'][0]->direccion }}" placeholder="{!! trans('message.form_employee_holder.direction') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="seccion">{{ trans('message.datatables_headers.section').' / '.trans('message.datatables_headers.area') }}</label>
                                        <input type="text" disabled class="form-control" id="seccion" name="seccion" value="{{ $data['employee'][0]->seccion }}" placeholder="{!! trans('message.form_employee_holder.section') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="departamento">{{ trans('message.datatables_headers.department') }}</label>
                                        <input type="text" disabled class="form-control" id="departamento" name="departamento" value="{{ $data['employee'][0]->departamento }}" placeholder="{!! trans('message.form_employee_holder.department') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="division">{{ trans('message.datatables_headers.division') }}</label>
                                        <input type="text" class="form-control" id="division" name="division" value="{{ $data['employee'][0]->division }}" placeholder="{!! trans('message.form_employee_holder.division') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="region">{{ trans('message.datatables_headers.region') }}</label>
                                        <input type="text" class="form-control" id="region" name="region" value="{{ $data['employee'][0]->region }}" placeholder="{!! trans('message.form_employee_holder.region') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sucursal">{{ trans('message.datatables_headers.subsidiary') }}</label>
                                        <input type="text" class="form-control" id="sucursal" name="sucursal" value="{{ $data['employee'][0]->sucursal }}" placeholder="{!! trans('message.form_employee_holder.subsidiary') !!}">
                                    </div>

                                </div>

                            </div>

                            <div class="box box-warning">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-building"></i> {{ trans('message.additional_jobposition') }}</h3>
                                </div>

                                <div class="box-body">
                                    <div class="form-group col-md-11">
                                        <label for="puesto">{{ trans('message.datatables_headers.position') }}</label>
                                        <select class="form-control" id="puesto_adicional" name="puesto_adicional">
                                            <option value="">{{ trans('message.datatables_headers.outjobposition') }}</option>
                                            @foreach ($data['list_jobpositions'] as $position)
                                                <?php
                                                    $enterprise = "Sin Empresa";
                                                    $mark = "Sin Marca";
                                                    $direction = "Sin Dirección";
                                                    $area = "Sin Área";
                                                    $department = "Sin Departamento";
                                                    if(!empty($position->enterprise->name))
                                                        $enterprise = $position->enterprise->name;
                                                    if(!empty($position->mark->name))
                                                        $mark = $position->mark->name;
                                                    if(!empty($position->direction->name))
                                                        $direction = $position->direction->name;
                                                    if(!empty($position->area->name))
                                                        $area = $position->area->name;
                                                    if(!empty($position->department->name))
                                                        $department = $position->department->name;
                                                ?>

                                                <option value="{{ $position->id. ' , ' .$enterprise.' , '.$mark.' , '.$direction.' , '.$area.' , '.$department.' , '.$position->name }}">{{  $enterprise.' / '.$mark.' / '.$direction.' / '.$area.' / '.$department.' / '.$position->name }}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="spoken">Agregar:</label>
                                        <button type="button" class="btn btn-success" id="add_aditional_jobposition">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </div>

                                    <div class="form-group col-md-12" id="aditional_jobposition_div_c"></div>

                                </div>

                            </div>

                            <div class="box box-warning">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.personnelinfo') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-4">
                                        <label for="idempleado">{{ trans('message.datatables_headers.idemployee') }}</label>
                                        <input type="text" required class="form-control" id="idempleado" name="idempleado" value="{{ $data['employee'][0]->idempleado }}" placeholder="{!! trans('message.form_employee_holder.idemployee') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="fuente">{{ trans('message.datatables_headers.origin') }}</label>
                                        <input type="text" required class="form-control" id="fuente" name="fuente" value="{{ $data['employee'][0]->fuente }}" placeholder="{!! trans('message.form_employee_holder.origin') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="correoempresa">{{ trans('message.datatables_headers.enterprise_mail') }}</label>
                                        <input type="email" class="form-control" id="correoempresa" name="correoempresa" value="{{ $data['employee'][0]->correoempresa }}" placeholder="{!! trans('message.form_employee_holder.enterprise_mail') !!}"
                                        class="form-control @error('email') is-invalid @enderror" autocomplete="email">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="civil">{{ trans('message.datatables_headers.state') }}</label>
                                        <input type="text" class="form-control" id="civil" name="civil" value="{{ $data['employee'][0]->civil }}" placeholder="{!! trans('message.form_employee_holder.state') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="telefono">{{ trans('message.datatables_headers.phone') }}</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $data['employee'][0]->telefono }}" placeholder="{!! trans('message.form_employee_holder.phone') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="extension">{{ trans('message.datatables_headers.ext') }}</label>
                                        <input type="text" class="form-control" id="extension" name="extension" value="{{ $data['employee'][0]->extension }}" placeholder="{!! trans('message.form_employee_holder.ext') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="celular">{{ trans('message.datatables_headers.movil') }}</label>
                                        <input type="text" class="form-control" id="celular" name="celular" value="{{ $data['employee'][0]->celular }}" placeholder="{!! trans('message.form_employee_holder.movil') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="ingreso">{{ trans('message.datatables_headers.entry') }}</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control" id="ingreso" name="ingreso" value="{{ $data['employee'][0]->ingreso }}" placeholder="{!! trans('message.form_employee_holder.entry') !!}">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="fechapuesto">{{ trans('message.datatables_headers.date_position') }}</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control" id="fechapuesto" name="fechapuesto" value="{{ $data['employee'][0]->fechapuesto }}" placeholder="{!! trans('message.form_employee_holder.date_position') !!}">
                                        </div>
                                    </div>

                                    {{--<div class="form-group col-md-4">
                                        <label for="jefe">{{ trans('message.datatables_headers.boss') }}</label>
                                        <input type="text" class="form-control" id="jefe" name="jefe" value="{{ $data['employee'][0]->jefe }}" placeholder="{!! trans('message.form_employee_holder.boss') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="direccion">{{ trans('message.datatables_headers.direction') }}</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $data['employee'][0]->direccion }}" placeholder="{!! trans('message.form_employee_holder.direction') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="departamento">{{ trans('message.datatables_headers.department') }}</label>
                                        <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $data['employee'][0]->departamento }}" placeholder="{!! trans('message.form_employee_holder.department') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="seccion">{{ trans('message.datatables_headers.section') }}</label>
                                        <input type="text" class="form-control" id="seccion" name="seccion" value="{{ $data['employee'][0]->seccion }}" placeholder="{!! trans('message.form_employee_holder.section') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="puesto">{{ trans('message.datatables_headers.position') }}</label>
                                        <input type="text" class="form-control" id="puesto" name="puesto" value="{{ $data['employee'][0]->puesto }}" placeholder="{!! trans('message.form_employee_holder.position') !!}">
                                    </div>--}}

                                    <div class="form-group col-md-4">
                                        <label for="grado">{{ trans('message.datatables_headers.grade') }}</label>
                                        <input type="text" class="form-control" id="grado" name="grado" value="{{ $data['employee'][0]->grado }}" placeholder="{!! trans('message.form_employee_holder.grade') !!}">
                                    </div>

                                    {{--<div class="form-group col-md-4">
                                        <label for="region">{{ trans('message.datatables_headers.region') }}</label>
                                        <input type="text" class="form-control" id="region" name="region" value="{{ $data['employee'][0]->region }}" placeholder="{!! trans('message.form_employee_holder.region') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sucursal">{{ trans('message.datatables_headers.subsidiary') }}</label>
                                        <input type="text" class="form-control" id="sucursal" name="sucursal" value="{{ $data['employee'][0]->sucursal }}" placeholder="{!! trans('message.form_employee_holder.subsidiary') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="idempresa">{{ trans('message.datatables_headers.enterprise_id') }}</label>
                                        <input type="text" class="form-control" id="idempresa" name="idempresa" value="{{ $data['employee'][0]->idempresa }}" placeholder="{!! trans('message.form_employee_holder.enterprise_id') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="empresa">{{ trans('message.datatables_headers.enterprise') }}</label>
                                        <input type="text" class="form-control" id="empresa" name="empresa" value="{{ $data['employee'][0]->empresa }}" placeholder="{!! trans('message.form_employee_holder.enterprise') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="division">{{ trans('message.datatables_headers.division') }}</label>
                                        <input type="text" class="form-control" id="division" name="division" value="{{ $data['employee'][0]->division }}" placeholder="{!! trans('message.form_employee_holder.division') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="marca">{{ trans('message.datatables_headers.mark') }}</label>
                                        <input type="text" class="form-control" id="marca" name="marca" value="{{ $data['employee'][0]->marca }}" placeholder="{!! trans('message.form_employee_holder.mark') !!}">
                                    </div>--}}

                                    <div class="form-group col-md-4">
                                        <label for="centro">{{ trans('message.datatables_headers.center') }}</label>
                                        <input type="text" class="form-control" id="centro" name="centro" value="{{ $data['employee'][0]->centro }}" placeholder="{!! trans('message.form_employee_holder.center') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="checador">{{ trans('message.datatables_headers.timer') }}</label>
                                        <input type="text" class="form-control" id="checador" name="checador" value="{{ $data['employee'][0]->checador }}" placeholder="{!! trans('message.form_employee_holder.timer') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="turno">{{ trans('message.datatables_headers.turn') }}</label>
                                        <input type="text" class="form-control" id="turno" name="turno" value="{{ $data['employee'][0]->turno }}" placeholder="{!! trans('message.form_employee_holder.turn') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="tiponomina">{{ trans('message.datatables_headers.payroll_type') }}</label>
                                        <input type="text" class="form-control" id="tiponomina" name="tiponomina" value="{{ $data['employee'][0]->tiponomina }}" placeholder="{!! trans('message.form_employee_holder.payroll_type') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="clavenomina">{{ trans('message.datatables_headers.payroll_id') }}</label>
                                        <input type="text" class="form-control" id="clavenomina" name="clavenomina" value="{{ $data['employee'][0]->clavenomina }}" placeholder="{!! trans('message.form_employee_holder.payroll_id') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nombrenomina">{{ trans('message.datatables_headers.payroll_name') }}</label>
                                        <input type="text" class="form-control" id="nombrenomina" name="nombrenomina" value="{{ $data['employee'][0]->nombrenomina }}" placeholder="{!! trans('message.form_employee_holder.payroll_name') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="generalista">{{ trans('message.datatables_headers.generalist') }}</label>
                                        <input type="text" class="form-control" id="generalista" name="generalista" value="{{ $data['employee'][0]->generalista }}" placeholder="{!! trans('message.form_employee_holder.generalist') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="relacion">{{ trans('message.datatables_headers.association') }}</label>
                                        <input type="text" class="form-control" id="relacion" name="relacion" value="{{ $data['employee'][0]->relacion }}" placeholder="{!! trans('message.form_employee_holder.association') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="contrato">{{ trans('message.datatables_headers.contract') }}</label>
                                        <input type="text" class="form-control" id="contrato" name="contrato" value="{{ $data['employee'][0]->contrato }}" placeholder="{!! trans('message.form_employee_holder.contract') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="horario">{{ trans('message.datatables_headers.schedule') }}</label>
                                        <input type="text" class="form-control" id="horario" name="horario" value="{{ $data['employee'][0]->horario }}" placeholder="{!! trans('message.form_employee_holder.schedule') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="jornada">{{ trans('message.datatables_headers.working_day') }}</label>
                                        <input type="text" class="form-control" id="jornada" name="jornada" value="{{ $data['employee'][0]->jornada }}" placeholder="{!! trans('message.form_employee_holder.working_day') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="calculo">{{ trans('message.datatables_headers.calculation') }}</label>
                                        <input type="text" class="form-control" id="calculo" name="calculo" value="{{ $data['employee'][0]->calculo }}" placeholder="{!! trans('message.form_employee_holder.calculation') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="vacaciones">{{ trans('message.datatables_headers.vacations') }}</label>
                                        <input type="text" class="form-control" id="vacaciones" name="vacaciones" value="{{ $data['employee'][0]->vacaciones }}" placeholder="{!! trans('message.form_employee_holder.vacations') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="flotante">{{ trans('message.datatables_headers.float') }}</label>
                                        <input type="text" class="form-control" id="flotante" name="flotante" value="{{ $data['employee'][0]->flotante }}" placeholder="{!! trans('message.form_employee_holder.float') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="base">{{ trans('message.datatables_headers.base') }}</label>
                                        <input type="text" class="form-control" id="base" name="base" value="{{ $data['employee'][0]->base }}" placeholder="{!! trans('message.form_employee_holder.base') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="rol">{{ trans('message.datatables_headers.role') }}</label>
                                        <input type="text" class="form-control" id="rol" name="rol" value="{{ $data['employee'][0]->rol }}" placeholder="{!! trans('message.form_employee_holder.role') !!}">
                                    </div>

                                </div>

                            </div>

                            <div class="box box-danger">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.personnelinfo_extra') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-4">
                                        <label for="extra1">{{ trans('message.datatables_headers.extra1') }}</label>
                                        <input type="text" class="form-control" id="extra1" name="extra1" value="{{ $data['employee'][0]->extra1 }}" placeholder="{!! trans('message.form_employee_holder.extra1') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="extra2">{{ trans('message.datatables_headers.extra2') }}</label>
                                        <input type="text" class="form-control" id="extra2" name="extra2" value="{{ $data['employee'][0]->extra2 }}" placeholder="{!! trans('message.form_employee_holder.extra2') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="extra3">{{ trans('message.datatables_headers.extra3') }}</label>
                                        <input type="text" class="form-control" id="extra3" name="extra3" value="{{ $data['employee'][0]->extra3 }}" placeholder="{!! trans('message.form_employee_holder.extra3') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="extra4">{{ trans('message.datatables_headers.extra4') }}</label>
                                        <input type="text" class="form-control" id="extra4" name="extra4" value="{{ $data['employee'][0]->extra4 }}" placeholder="{!! trans('message.form_employee_holder.extra4') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="extra5">{{ trans('message.datatables_headers.extra5') }}</label>
                                        <input type="text" class="form-control" id="extra5" name="extra5" value="{{ $data['employee'][0]->extra5 }}" placeholder="{!! trans('message.form_employee_holder.extra5') !!}">
                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-employees') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> {{ trans('message.buttons.update') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-1">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-employees') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal modal-danger fade" id="modal-danger" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">{{ trans('message.modals.alert') }}</h4>
                    </div>

                    <div class="modal-body">
                        @if($errors->any())
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ trans('message.buttons.close') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-danger fade" id="modal-unactive-employee" style="display: none;">
            <form class="form" action="{{ route('admin-employees.destroy' , $data['employee'][0]->id)}}" method="POST">
                {!! method_field('DELETE') !!}
                {!! csrf_field() !!}
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">{{ trans('message.modals.alert') }}</h4>
                        </div>

                        <div class="modal-body">
                            {{ trans('message.modals.dangermessageemployee') }}
                            {{ trans('message.modals.questioncontinue') }}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ trans('message.buttons.close') }}</button>
                            <button type="submit" class="btn btn-outline">{{ trans('message.buttons.unactive') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal modal-success fade" id="modal-active-employee" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">{{ trans('message.modals.alert') }}</h4>
                        </div>

                        <div class="modal-body">
                            {{ trans('message.modals.warningmessageemployee') }}
                            {{ trans('message.modals.questioncontinue') }}
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ trans('message.buttons.close') }}</button>
                            <button type="button" onclick="window.location.href = '{{ url('active-employee/'.$data['employee'][0]->id.'') }}';" class="btn btn-outline">{{ trans('message.buttons.active') }}</button>
                        </div>
                    </div>
                </div>
        </div>

    </div>

@endsection

@section('main-script')
    <script type="text/javascript">
        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 5000); // <-- time in milliseconds

        $(document).ready(function(){
            var id = $('#puesto').val();
            var index = id.split(',');
            var jobPosition = index[5];
            var department = index[4];
            getInfoJobPosition(jobPosition, department);
        });

        $('#puesto').change(function(){
            var id = $(this).val();
            var index = id.split(',');
            var jobPosition = index[5];
            var department = index[4];
            getBoss(jobPosition, department);
        });

        function getBoss(id, id_department){
            $.ajax({
                url: "{{url('bosses')}}/"+id+"/"+id_department,
                Type:'GET',
                success: function(result){
                    console.log(id_department);
                    $('#jefe').empty();
                    document.getElementById('idempresa').value = '';
                    document.getElementById('empresa').value = '';
                    document.getElementById('marca').value = '';
                    document.getElementById('direccion').value = '';
                    document.getElementById('seccion').value = '';
                    document.getElementById('departamento').value = '';

                    $('#jefe').append($('<option>', {
                        value: '',
                        text : 'Sin Jefe'
                    }));
                    $.each(result['bosses'], function(i, item){
                        $('#jefe').append($('<option>', {
                            value: item.id,
                            text : item.nombre+' '+item.paterno+' '+item.materno
                        }));
                    });

                    document.getElementById('idempresa').value = result['id_enterprise'];
                    document.getElementById('empresa').value = result['enterprise'];
                    document.getElementById('marca').value = result['mark'];
                    document.getElementById('direccion').value = result['direction'];
                    document.getElementById('seccion').value = result['area'];
                    document.getElementById('departamento').value = result['department'];

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#jefe').empty();
                    document.getElementById('idempresa').value = '';
                    document.getElementById('empresa').value = '';
                    document.getElementById('marca').value = '';
                    document.getElementById('direccion').value = '';
                    document.getElementById('seccion').value = '';
                    document.getElementById('departamento').value = '';
                }
            });
        }

        function getInfoJobPosition(id, id_department){
            $.ajax({
                url: "{{url('bosses')}}/"+id+"/"+id_department,
                Type:'GET',
                success: function(result){
                    document.getElementById('idempresa').value = '';
                    document.getElementById('empresa').value = '';
                    document.getElementById('marca').value = '';
                    document.getElementById('direccion').value = '';
                    document.getElementById('seccion').value = '';
                    document.getElementById('departamento').value = '';

                    document.getElementById('idempresa').value = result['id_enterprise'];
                    document.getElementById('empresa').value = result['enterprise'];
                    document.getElementById('marca').value = result['mark'];
                    document.getElementById('direccion').value = result['direction'];
                    document.getElementById('seccion').value = result['area'];
                    document.getElementById('departamento').value = result['department'];

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#jefe').empty();
                    document.getElementById('idempresa').value = '';
                    document.getElementById('empresa').value = '';
                    document.getElementById('marca').value = '';
                    document.getElementById('direccion').value = '';
                    document.getElementById('seccion').value = '';
                    document.getElementById('departamento').value = '';
                }
            });
        }

        /* ----------------------------------------
        * Agregar renglones a los idiomas cada que se presiona
        * el botón agregar y mostrarlos debajo
        * y también la función de eliminar el renglón
        * -------------------------------------------
        */
        var additional_jobposition = [];

        /*
        Validamos si ya existen datos guardados
        */
        @isset($data['additional_jobposition'])
            language = {!! json_encode($data['additional_jobposition']) !!};
            $.each(language, function(i, item) {
                inputAdditionalJobPosition  = '<div class="form-group col-md-11"><input type="text" name="additional_jobpositon[]" value="'+item+'" class="form-control" readonly="true"></div>';
                deleteRow         = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#aditional_jobposition_div_c').append('<div class="row">'+inputAdditionalJobPosition+deleteRow+'</div>');
            });
        @endisset

        $('#add_aditional_jobposition').on('click',  function(e) {
            e.preventDefault();

            additional_jobposition.push($('#puesto_adicional').val());
            

            var lastAdditionalJobPosition = additional_jobposition[additional_jobposition.length-1];
            
            inputAdditionalJobPosition = '<div class="form-group col-md-11"><input type="text" name="additional_jobpositon[]" value="'+lastAdditionalJobPosition+'" class="form-control" readonly="true"></div>';
            deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
            $('#aditional_jobposition_div_c').append('<div class="row">'+inputAdditionalJobPosition+deleteRow+'</div>');

            $('#puesto_adicional').val('');
        });

        /* ----------------------------------------
            * eliminar renglón de escolaridad
            * ----------------------------------------
        */
        $("#aditional_jobposition_div_c").on('click', '#borrar',function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    </script>
@endsection
