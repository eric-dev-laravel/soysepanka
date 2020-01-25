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

                <h4><i class="icon fa fa-book"></i> {{ trans('message.modals.alert') }}</h4>
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
                    <h3 class="box-title"><i class="fa fa-book"></i> {{ trans('message.createjobposition') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row col-md-12">
                        <form role="form" method="POST" action="{{ route('admin-jobpositionscatalog.store') }}" id="create">
                            {!! method_field('POST') !!}
                            {!! csrf_field() !!}

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.info_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.position') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.position_number') }}</label>
                                        <input type="number" class="form-control" id="places" name="places" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="id_direction">{{ trans('message.datatables_headers.working_day') }}</label>
                                        <select class="form-control" id="id_workshifts" name="id_workshifts">
                                            @foreach ($data['workshifts'] as $level)
                                                <option value="{{ $level->id }}">{{  $level->name. ' ' . $level->start . '/' . $level->end }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="id_direction">{{ trans('message.datatables_headers.level') }}</label>
                                        <select class="form-control" id="id_level" name="id_level">
                                            @foreach ($data['levels_positions'] as $level)
                                                <option value="{{ $level->id }}">{{  'Nivel: '. $level->level. ' ' .$level->name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{--<div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.description') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>--}}

                                </div>

                            </div>

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.infoespecify_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.general_objetive') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.principal_activities') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.responsabilities') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="box box-success">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.infoperfil_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.knowledge_required') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.competitions_required') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="nombre">{{ trans('message.datatables_headers.tools_use_required') }}</label>
                                        <textarea class="form-control" rows="4" id="description" name="description" placeholder="{{ trans('message.form_employee_holder.info_jobposition') }}"></textarea>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="nombre">{{ trans('message.datatables_headers.education_level') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.years_experience') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    {{--<div class="form-group col-md-4">
                                        <label for="nombre">{{ trans('message.datatables_headers.languajes_required') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">{{ trans('message.datatables_headers.read') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">{{ trans('message.datatables_headers.write') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">{{ trans('message.datatables_headers.conversation') }}</label>
                                        <input type="text" required class="form-control" id="name" name="name" placeholder="{{ trans('message.form_employee_holder.position') }}">
                                    </div>

                                    <div class="form-group col-md-1 center">
                                        <label for="nombre">Agregar</label>
                                        <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                    </div>--}}

                                    <div class="text-right">

                                    </div>

                                    <div class="form-group col-md-12" style="padding:0px;">
                                        <div class="form-group col-md-5">
                                            <label for="language">Idioma:</label>
                                            <input type="text" name="language" id="language_c" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="reading">Lectura:</label>
                                            <input type="text" name="reading" id="reading_c" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="writing">Escritura:</label>
                                            <input type="text" name="writing" id="writing_c" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="spoken">Conversación:</label>
                                            <input type="text" name="spoken" id="spoken_c" class="form-control">
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label for="spoken">Agregar:</label>
                                            <button type="button" class="btn btn-success" id="save_language_c">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>

                                        <div class="form-group col-md-12" id="language_div_c"></div>

                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositionscatalog') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{ trans('message.buttons.create') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-1">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositionscatalog') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
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
             @isset($profile->perfilLenguaje)
                language = {!! json_encode($profile->perfilLenguaje) !!};
                $.each(language, function(i, item) {
                    inputLanguage = '<input type="text" name="language[]" class="col-2 form-control" value="'+item.language+'" readonly="true">';
                    inputReading = '<input type="text" name="reading[]" class="col-2 form-control" value="'+item.reading+'" readonly="true">';
                    inputWriting = '<input type="text" name="writing[]" class="col-2 form-control" value="'+item.writing+'" readonly="true">';
                    inputSpoken = '<input type="text" name="spoken[]" class="col-2 form-control" value="'+item.spoken+'" readonly="true">';
                    deleteRow = '<button type="button" class="col-1 btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button>';
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

                inputLanguage = '<div class="form-group col-md-5"><input type="text" name="language[]" value="'+lastLanguage+'" class="form-control" readonly="true"></div>';
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
                $(this).parent().remove();
            });
    </script>
@endsection
