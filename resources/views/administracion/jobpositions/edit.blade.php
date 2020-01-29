@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_jobpositions_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_jobpositions_title') }}
@endsection

@section('main-content')
    @if($errors->any())
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-briefcase"></i> {{ trans('message.modals.alert') }}</h4>
                {{ trans('message.modals.alert_message_createuser') }}

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
                {{ trans('message.modals.success_message') }}
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

                    <div class="row col-md-3 col-sm-12 col-md-offset-1">
                        @if($data['jobposition'][0]->deleted_at)
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
                    <h3 class="box-title"><i class="fa fa-grave"></i> {{ trans('message.editjobposition') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row col-md-12">
                        <form role="form" method="POST" action="{{ route('admin-jobpositions.update',$data['jobposition'][0]->id) }}" id="update">
                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}

                            {{--<div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.info_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.enterprise') }}</label>
                                        <select class="form-control" id="id_enterprise" name="id_enterprise">
                                            <option value="">Sin empresa</option>
                                            @foreach ($info_direction['enterprises'] as $enterprises)
                                                @if($enterprises->id == $info_direction['jobposition'][0]->id_enterprise)
                                                    <option selected value="{{ $enterprises->id }}">{{  $enterprises->name   }}</option>
                                                @else
                                                    <option value="{{ $enterprises->id }}">{{  $enterprises->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.direction') }}</label>
                                        <select class="form-control" id="id_direction" name="id_direction">
                                            <option value="">Sin Dirección</option>
                                            @foreach ($info_direction['directions'] as $area)
                                                @if($area->id == $info_direction['jobposition'][0]->id_direction)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.area') }}</label>
                                        <select class="form-control" id="id_area" name="id_area">
                                            <option value="">Sin Área</option>
                                            @foreach ($info_direction['areas'] as $area)
                                                @if($area->id == $info_direction['jobposition'][0]->id_area)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.department') }}</label>
                                        <select class="form-control" id="id_department" name="id_department">
                                            <option value="">Sin Departamento</option>
                                            @foreach ($info_direction['departments'] as $area)
                                                @if($area->id == $info_direction['jobposition'][0]->id_department)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.level') }}</label>
                                        <select class="form-control" id="id_level" name="id_level">
                                            <option value="">Sin Departamento</option>
                                            @foreach ($info_direction['levels_positions'] as $area)
                                                @if($area->id == $info_direction['jobposition'][0]->id_level)
                                                    <option selected value="{{ $area->id }}">{{  'Nivel: '. $area->level. ' ' .$area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  'Nivel: '. $area->level. ' ' .$area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.boss') }}</label>
                                        <select class="form-control" id="id_boss_position" name="id_boss_position">
                                            <option value="">Sin Jefe</option>
                                            @foreach ($info_direction['list_jobpositions'] as $area)
                                                @if($area->id == $info_direction['jobposition'][0]->id_boss_position)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nombre">{{ trans('message.datatables_headers.position') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" value="{{ $info_direction['jobposition'][0]->name }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.description') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $info_direction['jobposition'][0]->description }} </textarea>
                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositions') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> {{ trans('message.buttons.edit') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-1">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositions') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
                                    </div>
                                </div>

                            </div>--}}

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.info_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.mark') }}</label>
                                        <select class="form-control" id="id_mark" name="id_mark">
                                            <option value="">Sin empresa</option>
                                            @foreach ($data['enterprises'] as $enterprises)
                                                @if($enterprises->id == $data['jobposition'][0]->id_enterprise)
                                                    <option selected value="{{ $enterprises->id }}">{{  $enterprises->name   }}</option>
                                                @else
                                                    <option value="{{ $enterprises->id }}">{{  $enterprises->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.direction') }}</label>
                                        <select class="form-control" id="id_direction" name="id_direction">
                                            <option value="">Sin Dirección</option>
                                            @foreach ($data['directions'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_direction)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.area') }}</label>
                                        <select class="form-control" id="id_area" name="id_area">
                                            <option value="">Sin Área</option>
                                            @foreach ($data['areas'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_area)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.department') }}</label>
                                        <select class="form-control" id="id_department" name="id_department">
                                            <option value="">Sin Departamento</option>
                                            @foreach ($data['departments'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_department)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.level') }}</label>
                                        <select class="form-control" id="id_level" name="id_level">
                                            <option value="">Sin Departamento</option>
                                            @foreach ($data['levels_positions'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_level)
                                                    <option selected value="{{ $area->id }}">{{  'Nivel: '. $area->level. ' ' .$area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  'Nivel: '. $area->level. ' ' .$area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.boss') }}</label>
                                        <select class="form-control" id="id_boss_position" name="id_boss_position">
                                            <option value="">Sin Jefe</option>
                                            @foreach ($data['list_jobpositions'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_boss_position)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.position') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" value="{{ $data['jobposition'][0]->name }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.position_number') }}</label>
                                        <input type="number" class="form-control" id="places" name="places" value="{{ $data['jobposition'][0]->places }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="id_direction">{{ trans('message.datatables_headers.gender') }}</label>
                                        <select class="form-control" id="id_gender" name="id_gender">
                                            @foreach ($data['genders'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_gender)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="id_direction">{{ trans('message.datatables_headers.marital_status') }}</label>
                                        <select class="form-control" id="id_marital_status" name="id_marital_status">
                                            @foreach ($data['marital_status'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_marital_status)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="id_direction">{{ trans('message.datatables_headers.working_day') }}</label>
                                        <select class="form-control" id="id_workshifts" name="id_workshifts">
                                            @foreach ($data['workshifts'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_workshifts)
                                                    <option selected value="{{ $area->id }}">{{  $area->name. ' ' . $area->up_start . ' a ' . $area->up_end. ' y ' . $area->down_start . ' a ' . $area->down_end }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name. ' ' . $area->up_start . ' a ' . $area->up_end. ' y ' . $area->down_start . ' a ' . $area->down_end }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="id_direction">{{ trans('message.datatables_headers.level') }}</label>
                                        <select class="form-control" id="id_level" name="id_level">
                                            @foreach ($data['levels_positions'] as $area)
                                                @if($area->id == $data['jobposition'][0]->id_level)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">{{ trans('message.datatables_headers.age_max') }}</label>
                                        <input type="number" class="form-control" id="age_max" name="age_max" value="{{ $data['jobposition'][0]->age_max }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">{{ trans('message.datatables_headers.age_min') }}</label>
                                        <input type="number" class="form-control" id="age_min" name="age_min" value="{{ $data['jobposition'][0]->age_min }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                </div>

                            </div>

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.infoespecify_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.general_objetive') }}</label>
                                        <textarea class="form-control" rows="4" id="objective" name="objective" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->objective }} </textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.principal_activities') }}</label>
                                        <textarea class="form-control" rows="4" id="activities" name="activities" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->activities }} </textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.responsabilities') }}</label>
                                        <textarea class="form-control" rows="4" id="responsabilities" name="responsabilities" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->responsabilities }} </textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.infoperfil_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.knowledge_required') }}</label>
                                        <textarea class="form-control" rows="4" id="knowledges" name="knowledges" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->knowledges }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.competitions_required') }}</label>
                                        <textarea class="form-control" rows="4" id="competitions" name="competitions" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->competitions }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.tools_use_required') }}</label>
                                        <textarea class="form-control" rows="4" id="tools" name="tools" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->tools }}</textarea>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="nombre">{{ trans('message.datatables_headers.education_level') }}</label>
                                        <input type="text" required class="form-control" id="education_level" name="education_level" value="{{ $data['jobposition'][0]->education_level }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.years_experience') }}</label>
                                        <input type="text" required class="form-control" id="years_experience" name="years_experience" value="{{ $data['jobposition'][0]->years_experience }}" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="language">Idioma</label>
                                        <input type="text" name="nlanguage" id="language_c" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="reading">Lectura</label>
                                        <input type="text" name="reading" id="reading_c" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="writing">Escritura</label>
                                        <input type="text" name="writing" id="writing_c" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="spoken">Conversación</label>
                                        <input type="text" name="spoken" id="spoken_c" class="form-control">
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="spoken">Agregar:</label>
                                        <button type="button" class="btn btn-success" id="save_language_c">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </div>

                                    <div id="language_div_c" class="form-group col-md-12"></div>

                                </div>

                            </div>

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.infotools_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.tools_required') }}</label>
                                        <textarea class="form-control" rows="4" id="equitment" name="equitment" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->equitment }} </textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.benefits') }}</label>
                                        <textarea class="form-control" rows="4" id="benefits" name="benefits" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->benefits }} </textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.available') }}</label>
                                        <textarea class="form-control" rows="4" id="available" name="available" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"> {{ $data['jobposition'][0]->available }} </textarea>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="language">Rango Salarial</label>
                                        <input type="text" name="salary_range" id="salary_range" value="{{ $data['jobposition'][0]->salary_range }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="reading">Máx. </label>
                                        <input type="text" name="salary_max" id="salary_max" value="{{ $data['jobposition'][0]->salary_max }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="writing">Mín. </label>
                                        <input type="text" name="salary_min" id="salary_min" value="{{ $data['jobposition'][0]->salary_min }}" class="form-control">
                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositions') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> {{ trans('message.buttons.edit') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-1">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositions') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
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
            <form class="form" action="{{ route('admin-jobpositions.destroy' , $data['jobposition'][0]->id)}}" method="POST">
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
                            <button type="button" onclick="window.location.href = '{{ url('active-jobposition/'.$data['jobposition'][0]->id.'') }}';" class="btn btn-outline">{{ trans('message.buttons.active') }}</button>
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

        /* ----------------------------------------
             * Agregar renglones a los idiomas cada que se presiona
             * el botón agregar y mostrarlos debajo
             * y también la función de eliminar el renglón
             * -------------------------------------------
            */

            var language = [];
            var reading = [];
            var writing = [];
            var spoken = [];

            /* validamos si existen el perfil y la relacion con el idioma y
             * pintamos los datos provenientes de la base de datos
             * asignamos el mismo arreglo por si se agregan/eliminan filas
             */
             @isset($data['jobpositionlanguaje'])
                language = {!! json_encode($data['jobpositionlanguaje']) !!};
                $.each(language, function(i, item) {
                    inputLanguage = '<div class="form-group col-md-5"><input type="text" name="nlanguage[]" value="'+item.name+'" class="form-control" readonly="true"></div>';
                    inputReading = '<div class="form-group col-md-2"><input type="text" name="reading[]" value="'+item.read+'" class="form-control" readonly="true"></div>';
                    inputWriting = '<div class="form-group col-md-2"><input type="text" name="writing[]" value="'+item.write+'" class="form-control" readonly="true"></div>';
                    inputSpoken = '<div class="form-group col-md-2"><input type="text" name="spoken[]" value="'+item.conversation+'" class="form-control" readonly="true"></div>';
                    deleteRow = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                    $('#language_div_c').append('<div class="row">'+inputLanguage+inputReading+inputWriting+inputSpoken+deleteRow+'</div>');
                });
            @endisset

            $('#save_language_c').on('click',  function(e) {
                e.preventDefault();

                language.push($('#language_c').val());
                reading.push($('#reading_c').val());
                writing.push($('#writing_c').val());
                spoken.push($('#spoken_c').val());

                var lastLanguage = language[language.length-1];
                var lastReading = reading[reading.length-1];
                var lastWriting = writing[writing.length-1];
                var lastSpoken = spoken[spoken.length-1];

                inputLanguage = '<div class="form-group col-md-5"><input type="text" name="nlanguage[]" value="'+lastLanguage+'" class="form-control" readonly="true"></div>';
                inputReading = '<div class="form-group col-md-2"><input type="text" name="reading[]" value="'+lastReading+'" class="form-control" readonly="true"></div>';
                inputWriting = '<div class="form-group col-md-2"><input type="text" name="writing[]" value="'+lastWriting+'" class="form-control" readonly="true"></div>';
                inputSpoken = '<div class="form-group col-md-2"><input type="text" name="spoken[]" value="'+lastSpoken+'" class="form-control" readonly="true"></div>';
                deleteRow = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#language_div_c').append('<div class="row">'+inputLanguage+inputReading+inputWriting+inputSpoken+deleteRow+'</div>');

                $('#language_c').val('');
                $('#reading_c').val('');
                $('#writing_c').val('');
                $('#spoken_c').val('');
            });

            /* ----------------------------------------
             * eliminar renglón de escolaridad
             * ----------------------------------------
            */
            $("#language_div_c").on('click', '#borrar',function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
    </script>
@endsection
