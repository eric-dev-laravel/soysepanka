@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_departments_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_departments_title') }}
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
                        @if($info_direction['department'][0]->deleted_at)
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
                    <h3 class="box-title"><i class="fa fa-briefcase"></i> {{ trans('message.editdepartment') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row col-md-12">
                        <form role="form" method="POST" action="{{ route('admin-departments.update',$info_direction['department'][0]->id) }}" id="update">
                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.info_createdepartment') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.enterprise') }}</label>
                                        <select class="form-control" id="id_enterprise" name="id_enterprise">
                                            <option value="">Sin empresa</option>
                                            @foreach ($info_direction['enterprises'] as $enterprises)
                                                @if($enterprises->id == $info_direction['department'][0]->id_enterprise)
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
                                                @if($area->id == $info_direction['department'][0]->id_direction)
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
                                                @if($area->id == $info_direction['department'][0]->id_area)
                                                    <option selected value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @else
                                                    <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nombre">{{ trans('message.datatables_headers.department') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" value="{{ $info_direction['department'][0]->name }}" placeholder="{{ trans('message.form_employee_holder.department') }}">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.description') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_department') }}"> {{ $info_direction['department'][0]->description }} </textarea>
                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-departments') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> {{ trans('message.buttons.edit') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-1">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-departments') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
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
            <form class="form" action="{{ route('admin-departments.destroy' , $info_direction['department'][0]->id)}}" method="POST">
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
                            <button type="button" onclick="window.location.href = '{{ url('active-department/'.$info_direction['department'][0]->id.'') }}';" class="btn btn-outline">{{ trans('message.buttons.active') }}</button>
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
    </script>
@endsection
