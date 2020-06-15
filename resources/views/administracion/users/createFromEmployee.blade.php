@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_users_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_users_title') }}
@endsection

@section('main-content')

    @if($errors->any())
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i> {{ trans('message.modals.alert') }}</h4>
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

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-user"></i> {{ trans('message.createuser') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row col-md-12">
                        <form role="form" method="POST" action="{{ route('admin-users.store') }}" id="create">
                            {!! method_field('POST') !!}
                            {!! csrf_field() !!}

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.info_createusers') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-4" style="display: none">
                                        <label for="nombre">{{ trans('message.datatables_headers.name') }}</label>
                                        <input type="text" class="form-control" id="type" name="type" value="2">
                                    </div>

                                    <div class="form-group col-md-4" style="display: none;">
                                        <label for="nombre">{{ trans('message.datatables_headers.name') }}</label>
                                        <input type="text" required class="form-control" id="idemployee" name="idemployee" value="{{ $info_employee[0]->id }}" placeholder="{!! trans('message.form_employee_holder.name') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.name') }}</label>
                                        <input type="text" required class="form-control" id="nombre" name="nombre" value="{{ $info_employee[0]->nombre }}" placeholder="{!! trans('message.form_employee_holder.name') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="paterno">{{ trans('message.datatables_headers.paterno') }}</label>
                                        <input type="text" required class="form-control" id="paterno" name="paterno" value="{{ $info_employee[0]->paterno }}" placeholder="{!! trans('message.form_employee_holder.paterno') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="materno">{{ trans('message.datatables_headers.materno') }}</label>
                                        <input type="text" class="form-control" id="materno" name="materno" value="{{ $info_employee[0]->materno }}" placeholder="{!! trans('message.form_employee_holder.materno') !!}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="email">{{ trans('message.datatables_headers.username') }}</label>
                                        <input type="email" required class="form-control" id="email" name="email" value="{{ $info_employee[0]->correopersonal }}" placeholder="{!! trans('message.form_employee_holder.username') !!}"
                                        class="form-control @error('email') is-invalid @enderror" autocomplete="email">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="password">{{ trans('message.datatables_headers.password') }}</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="{{ trans('message.form_employee_holder.password') }}" name="password" id="password"/>
                                            <span class="input-group-btn">
                                                <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                                    <span class="fa fa-eye-slash icon"></span> 
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="password">{{ trans('message.datatables_headers.password') }}</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="{{ trans('message.form_employee_holder.retrypassword') }}" name="password_confirmation" id="password_confirmation"/>
                                            <span class="input-group-btn">
                                                <button id="show_retrypassword" class="btn btn-primary" type="button" onclick="mostrarRePassword()">
                                                    <span class="fa fa-eye-slash reicon"></span> 
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-users') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{ trans('message.buttons.create') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-1">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-users') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
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

    </div>

@endsection

@section('main-script')
    <script type="text/javascript">
        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 5000); // <-- time in milliseconds

        function mostrarPassword(){
            var cambio = document.getElementById("password");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 
        
        $(document).ready(function () {
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });

        function mostrarRePassword(){
            var cambio = document.getElementById("password_confirmation");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.reicon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.reicon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        } 
        
        $(document).ready(function () {
            //CheckBox mostrar contraseña
            $('#ShowRePassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>
@endsection
