@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ex.record_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ex.record_title') }}
@endsection

@section('main-content')
    @if($errors->any())
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-arrows"></i> {{ trans('message.modals.alert') }}</h4>
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
    @if (! empty($data['employee_info']))
        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active"><a class="nav-link active" id="tab1" href="#tab_1" data-toggle="tab" role="tab" aria-selected="true" aria-expanded="true">{{ trans('message.ex.tab1') }}</a>                    </li>
                        <li class="nav-item"><a href="#tab_2" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab2') }}</a></li>
                        <li class="nav-item"><a href="#tab_3" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab3') }}</a></li>
                        <li class="nav-item"><a href="#tab_4" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab4') }}</a></li>
                        <li class="nav-item"><a href="#tab_5" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab5') }}</a></li>
                        <li class="nav-item"><a href="#tab_6" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab6') }}</a></li>
                        <li class="nav-item"><a href="#tab_7" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab7') }}</a></li>
                        <li class="nav-item"><a href="#tab_8" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab8') }}</a></li>
                        <li class="nav-item"><a href="#tab_9" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab9') }}</a></li>
                        <li class="nav-item"><a href="#tab_10" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab10') }}</a></li>
                        {{--<li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                        Dropdown <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>--}}
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane active" id="tab_1" role="tabpanel" role="tabpanel" aria-labelledby="tab1">
                            @include('expediente.partials.tab1')
                        </div>

                        <div class="tab-pane fade" id="tab_2" role="tabpanel">
                            @include('expediente.partials.tab2')
                        </div>

                        <div class="tab-pane fade" id="tab_3" role="tabpanel">
                            @include('expediente.partials.tab3')
                        </div>

                        <div class="tab-pane fade" id="tab_4" role="tabpanel">
                            @include('expediente.partials.tab4')
                        </div>

                        <div class="tab-pane fade" id="tab_5" role="tabpanel">
                            @include('expediente.partials.tab5')
                        </div>

                        <div class="tab-pane fade" id="tab_6" role="tabpanel">
                            @include('expediente.partials.tab6')
                        </div>

                        <div class="tab-pane fade" id="tab_7" role="tabpanel">
                            @include('expediente.partials.tab7')
                        </div>

                        <div class="tab-pane fade" id="tab_8" role="tabpanel">
                            @include('expediente.partials.tab8')
                        </div>

                        <div class="tab-pane fade" id="tab_9" role="tabpanel">
                            @include('expediente.partials.tab9')
                        </div>

                        <div class="tab-pane fade" id="tab_10" role="tabpanel">
                            @include('expediente.partials.tab10')
                        </div>

                    </div>

                </div>
            </div>

        </div>
    @else
        <div class="row">

            <div class="col-md-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title">{{ trans('message.ex.alert') }}</h3>
                    </div>

                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> {{ trans('message.ex.alert_title1') }} </h4>
                            {{ trans('message.ex.alert_msg1') }}
                        </div>
                  </div>
                </div>

            </div>

        </div>
    @endif

    <div class="row">
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

        $( document ).ready(function() {

            $('.btn-image').on('click',function(){
                $('#image').click();
            });

            $('.btn-proof-education').on('click',function(){
                $('#proof_education').click();
            });

            $('.btn-proof-record').on('click',function(){
                $('#proof_record').click();
            });

            $("#image").change(function(){
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile_picture').attr('src', e.target.result);
                        //$('.btn-profile-pic').removeClass('d-none');
                        document.getElementById('btn_select_image').style.display = 'none';
                        document.getElementById('btn_update_image').style.display = 'inherit';
                        document.getElementById('btn_update_image').style.position = 'absolute';
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        /* ----------------------------------------
             * Agregar renglones a los idiomas cada que se presiona
             * el botón agregar y mostrarlos debajo
             * y también la función de eliminar el renglón
             * -------------------------------------------
            */
        var especiality = [];
        var level = [];
        var state = [];
        var education_center = [];
        var period = [];
        var proof_education = [];
        var clone;
        var con = 0;

        /*
        Validamos si ya existen datos guardados
        */
        @isset($data['record_formation_info'])
            language = {!! json_encode($data['record_formation_info']) !!};
            $.each(language, function(i, item) {
                inputEspeciality = '<div class="form-group col-md-3"><input type="text" name="especiality1[]" value="'+item.especialization_area+'" class="form-control" readonly="true"></div>';
                inputLevel = '<div class="form-group col-md-3"><input type="text" name="level1[]" value="'+item.level+'" class="form-control" readonly="true"></div>';
                inputState = '<div class="form-group col-md-2"><input type="text" name="status1[]" value="'+item.status+'" class="form-control" readonly="true"></div>';
                inputEducationCenter = '<div class="form-group col-md-4"><input type="text" name="center1[]" value="'+item.center+'" class="form-control" readonly="true"></div>';
                inputPeriod = '<div class="form-group col-md-3"><input type="text" name="period1[]" value="'+item.period_init+' a '+item.period_end+'" class="form-control" readonly="true"></div>';
                inputFile = '<div class="form-group col-md-4"><a type="button" href="/storage/'+item.proof+'" target="_blank"class="btn btn-primary"><i class="fa fa-file"></i> Ver </a> <input type="text" name="file_proof[]" value="'+item.proof+'" style="display:none"></div>';
                //inputFile = '<input type="text" name="file_studio[]" class="col-2 form-control" value="/storage/'+item.proof+'" readonly="true">';
                deleteRow = '<div class="form-group col-md-1 col-md-offset-4"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#formation_div_c').append('<div class="row">'+inputEspeciality+inputLevel+inputState+inputEducationCenter+inputPeriod+inputFile+deleteRow+'</div>');
            });
        @endisset


        $('#save_language_c').on('click',  function(e) {
            e.preventDefault();

            especiality.push($('#especiality').val());
            level.push($('#level').val());
            state.push($('#status').val());
            education_center.push($('#education_center').val());
            period.push($('#period').val());
            proof_education.push($('#proof_education').val());

            var lastEspeciality = especiality[especiality.length-1];
            var lastLevel = level[level.length-1];
            var lastState = state[state.length-1];
            var lastEducationCenter = education_center[education_center.length-1];
            var lastPeriod = period[period.length-1];

            inputEspeciality = '<div class="form-group col-md-3"><input type="text" name="especiality[]" value="'+lastEspeciality+'" class="form-control" readonly="true"></div>';
            inputLevel = '<div class="form-group col-md-3"><input type="text" name="level[]" value="'+lastLevel+'" class="form-control" readonly="true"></div>';
            inputState = '<div class="form-group col-md-2"><input type="text" name="status[]" value="'+lastState+'" class="form-control" readonly="true"></div>';
            inputEducationCenter = '<div class="form-group col-md-4"><input type="text" name="center[]" value="'+lastEducationCenter+'" class="form-control" readonly="true"></div>';
            inputPeriod = '<div class="form-group col-md-3"><input type="text" name="period[]" value="'+lastPeriod+'" class="form-control" readonly="true"></div>';
            inputFile = '<div class="form-group col-md-4"><input type="text" name="fileName'+con+'" id="fileName'+con+'" class="form-control" readonly="true"> <span id="file'+con+'"><input type="file" id="file2_'+con+' name="file2_'+con+'" style="display:none"/></div>';
            deleteRow = '<div class="form-group col-md-1 col-md-offset-4"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
            $('#formation_div_c').append('<div class="row">'+inputEspeciality+inputLevel+inputState+inputEducationCenter+inputPeriod+inputFile+deleteRow+'</div>');

            clone = $("#proof_education").clone();
            clone.attr('id', 'file2_'+con);
            $("#file"+con).html(clone);
            $("#fileName"+con).val(clone[0]['files'][0]['name']);

            $('#especiality').val('');
            $('#level').val('');
            $('#status').val('');
            $('#education_center').val('');
            $("#proof_education").val('');
            con++;
        });

        /* ----------------------------------------
         * eliminar renglón de escolaridad
         * ----------------------------------------
        */
        $("#formation_div_c").on('click', '#borrar',function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        /* ----------------------------------------
        * Agregar renglones a los idiomas cada que se presiona
        * el botón agregar y mostrarlos debajo
        * y también la función de eliminar el renglón
        * -------------------------------------------
        */
        var previousJob = [];
        var previousEnterprise = [];
        var previousPeriod = [];
        var previousSalary = [];
        var previousSeparation = [];
        var previousActivities = [];

        /*
        Validamos si ya existen datos guardados
        */
        @isset($data['record_lastJob_info'])
            language = {!! json_encode($data['record_lastJob_info']) !!};
            $.each(language, function(i, item) {
                inputPreviousJob        = '<div class="form-group col-md-6"><input type="text" name="last_jobPosition[]" value="'+item.last_jobPosition+'" class="form-control" readonly="true"></div>';
                inputPreviousEnterprise = '<div class="form-group col-md-6"><input type="text" name="last_enterprise[]" value="'+item.last_enterprise+'" class="form-control" readonly="true"></div>';
                inputPreviousPeriod     = '<div class="form-group col-md-3"><input type="text" name="last_period[]" value="'+item.period_init+' a '+item.period_end+'" class="form-control" readonly="true"></div>';
                inputPreviousSalary     = '<div class="form-group col-md-2"><input type="text" name="last_salary[]" value="'+item.salary+'" class="form-control" readonly="true"></div>';
                inputPreviousSeparation = '<div class="form-group col-md-7"><input type="text" name="last_separation[]" value="'+item.reason_separation+'" class="form-control" readonly="true"></div>';
                inputPreviousActivities = '<div class="form-group col-md-11"><textarea class="form-control" rows="4" name="last_myActivities[]" readonly="true">'+item.activities+'</textarea></div>';
                deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#other_jobs_div_c').append('<div class="row">'+inputPreviousJob+inputPreviousEnterprise+inputPreviousPeriod+inputPreviousSalary+inputPreviousSeparation+inputPreviousActivities+deleteRow+'</div>');
            });
        @endisset

        $('#save_other_jobs').on('click',  function(e) {
            e.preventDefault();

            previousJob.push($('#jobposition_c').val());
            previousEnterprise.push($('#enterprise_c').val());
            previousPeriod.push($('#jobposotionperiod_c').val());
            previousSalary.push($('#salary_c').val());
            previousSeparation.push($('#separation_c').val());
            previousActivities.push($('#myActivities_c').val());

            var lastPreviousJob         = previousJob[previousJob.length-1];
            var lastPreviousEnterprise  = previousEnterprise[previousEnterprise.length-1];
            var lastPreviousPeriod      = previousPeriod[previousPeriod.length-1];
            var lastPreviousSalary      = previousSalary[previousSalary.length-1];
            var lastPreviousSeparation  = previousSeparation[previousSeparation.length-1];
            var lastPreviousActivities  = previousActivities[previousActivities.length-1];

            inputPreviousJob        = '<div class="form-group col-md-6"><input type="text" name="last_jobPosition[]" value="'+lastPreviousJob+'" class="form-control" readonly="true"></div>';
            inputPreviousEnterprise = '<div class="form-group col-md-6"><input type="text" name="last_enterprise[]" value="'+lastPreviousEnterprise+'" class="form-control" readonly="true"></div>';
            inputPreviousPeriod     = '<div class="form-group col-md-3"><input type="text" name="last_period[]" value="'+lastPreviousPeriod+'" class="form-control" readonly="true"></div>';
            inputPreviousSalary     = '<div class="form-group col-md-2"><input type="text" name="last_salary[]" value="'+lastPreviousSalary+'" class="form-control" readonly="true"></div>';
            inputPreviousSeparation = '<div class="form-group col-md-7"><input type="text" name="last_separation[]" value="'+lastPreviousSeparation+'" class="form-control" readonly="true"></div>';
            inputPreviousActivities = '<div class="form-group col-md-11"><textarea class="form-control" rows="4" name="last_myActivities[]" readonly="true">'+lastPreviousActivities+'</textarea></div>';
            deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
            $('#other_jobs_div_c').append('<div class="row">'+inputPreviousJob+inputPreviousEnterprise+inputPreviousPeriod+inputPreviousSalary+inputPreviousSeparation+inputPreviousActivities+deleteRow+'</div>');

            $('#jobposition_c').val('');
            $('#enterprise_c').val('');
            $('#salary_c').val('');
            $('#separation_c').val('');
            $('#myActivities_c').val('');
        });

        /* ----------------------------------------
            * eliminar renglón de escolaridad
            * ----------------------------------------
        */
        $("#other_jobs_div_c").on('click', '#borrar',function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        /* ----------------------------------------
        * Agregar renglones a los idiomas cada que se presiona
        * el botón agregar y mostrarlos debajo
        * y también la función de eliminar el renglón
        * -------------------------------------------
        */
        var referenceName = [];
        var referenceTel = [];
        var referenceTime = [];
        var referenceOcupation = [];

        /*
        Validamos si ya existen datos guardados
        */
        @isset($data['record_references_info'])
            language = {!! json_encode($data['record_references_info']) !!};
            $.each(language, function(i, item) {
                inputReferenceName      = '<div class="form-group col-md-4"><input type="text" name="referenceName[]" value="'+item.references_name+'" class="form-control" readonly="true"></div>';
                inputReferenceTel       = '<div class="form-group col-md-2"><input type="text" name="referenceTel[]" value="'+item.references_phone+'" class="form-control" readonly="true"></div>';
                inputReferenceTime      = '<div class="form-group col-md-2"><input type="text" name="referenceTime[]" value="'+item.references_time+'" class="form-control" readonly="true"></div>';
                inputReferenceOcupation = '<div class="form-group col-md-3"><input type="text" name="referenceOcupation[]" value="'+item.references_ocupation+'" class="form-control" readonly="true"></div>';
                deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#references_div_c').append('<div class="row">'+inputReferenceName+inputReferenceTel+inputReferenceTime+inputReferenceOcupation+deleteRow+'</div>');
            });
        @endisset

        $('#save_references').on('click',  function(e) {
            e.preventDefault();

            referenceName.push($('#referenceName_c').val());
            referenceTel.push($('#referenceTel_c').val());
            referenceTime.push($('#referenceTime_c').val());
            referenceOcupation.push($('#referenceOcupation_c').val());

            var lastReferenceName       = referenceName[referenceName.length-1];
            var lastReferenceTel        = referenceTel[referenceTel.length-1];
            var lastReferenceTime       = referenceTime[referenceTime.length-1];
            var lastReferenceOcupation  = referenceOcupation[referenceOcupation.length-1];

            inputReferenceName      = '<div class="form-group col-md-4"><input type="text" name="referenceName[]" value="'+lastReferenceName+'" class="form-control" readonly="true"></div>';
            inputReferenceTel       = '<div class="form-group col-md-2"><input type="text" name="referenceTel[]" value="'+lastReferenceTel+'" class="form-control" readonly="true"></div>';
            inputReferenceTime      = '<div class="form-group col-md-2"><input type="text" name="referenceTime[]" value="'+lastReferenceTime+'" class="form-control" readonly="true"></div>';
            inputReferenceOcupation = '<div class="form-group col-md-3"><input type="text" name="referenceOcupation[]" value="'+lastReferenceOcupation+'" class="form-control" readonly="true"></div>';
            deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
            $('#references_div_c').append('<div class="row">'+inputReferenceName+inputReferenceTel+inputReferenceTime+inputReferenceOcupation+deleteRow+'</div>');

            $('#referenceName_c').val('');
            $('#referenceTel_c').val('');
            $('#referenceTime_c').val('');
            $('#referenceOcupation_c').val('');
        });

        /* ----------------------------------------
            * eliminar renglón de escolaridad
            * ----------------------------------------
        */
        $("#references_div_c").on('click', '#borrar',function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        /* ----------------------------------------
        * Agregar renglones a los idiomas cada que se presiona
        * el botón agregar y mostrarlos debajo
        * y también la función de eliminar el renglón
        * -------------------------------------------
        */
        var familyID = [];
        var familyName = [];
        var familyType = [];

        /*
        Validamos si ya existen datos guardados
        */
        @isset($data['data_family_enterprise'])
            language = {!! json_encode($data['data_family_enterprise']) !!};
            $.each(language, function(i, item) {
                inputFamilyName      = '<div class="form-group col-md-9"><input type="text" name="familyName[]" value="'+item.name+'" class="form-control" readonly="true"><input type="text" name="familyID[]" value="'+item.id+'" class="form-control" readonly="true" style="display:none"></div>';
                inputFamilyType      = '<div class="form-group col-md-2"><input type="text" name="familyType[]" value="'+item.family_type+'" class="form-control" readonly="true"></div>';
                deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#family_div_c').append('<div class="row">'+inputFamilyName+inputFamilyType+deleteRow+'</div>');
           });
        @endisset

        $('#save_family').on('click',  function(e) {
            e.preventDefault();

            familyID.push($('#familyName_c').val());
            familyName.push($('#familyName_c option:selected').text());
            familyType.push($('#familyType_c').val());

            var lastFamilyID     = familyID[familyID.length-1];
            var lastFamilyName   = familyName[familyName.length-1];
            var lastFamilyType   = familyType[familyType.length-1];

            inputFamilyName      = '<div class="form-group col-md-9"><input type="text" name="familyName[]" value="'+lastFamilyName+'" class="form-control" readonly="true"><input type="text" name="familyID[]" value="'+lastFamilyID+'" class="form-control" readonly="true" style="display:none"></div>';
            inputFamilyType      = '<div class="form-group col-md-2"><input type="text" name="familyType[]" value="'+lastFamilyType+'" class="form-control" readonly="true"></div>';
            deleteRow               = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
            $('#family_div_c').append('<div class="row">'+inputFamilyName+inputFamilyType+deleteRow+'</div>');

            $('#familyName_c').val('');
            $('#familyType_c').val('');
        });

        /* ----------------------------------------
            * eliminar renglón de escolaridad
            * ----------------------------------------
        */
        $("#family_div_c").on('click', '#borrar',function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        /* ----------------------------------------
        * Agregar renglones a los idiomas cada que se presiona
        * el botón agregar y mostrarlos debajo
        * y también la función de eliminar el renglón
        * -------------------------------------------
        */
        var organizationName = [];
        /*
        Validamos si ya existen datos guardados
        */
        @isset($data['record_syndicate_info'])
            language = {!! json_encode($data['record_syndicate_info']) !!};
            $.each(language, function(i, item) {
                inputOrganization  = '<div class="form-group col-md-11"><input type="text" name="organizationName[]" value="'+item.name+'" class="form-control" readonly="true"></div>';
                deleteRow          = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#organization_div_c').append('<div class="row">'+inputOrganization+deleteRow+'</div>');
           });
        @endisset

        $('#save_organization').on('click',  function(e) {
            e.preventDefault();

            organizationName.push($('#organization_c').val());

            var lastOrganizationName  = organizationName[organizationName.length-1];

            inputOrganization  = '<div class="form-group col-md-11"><input type="text" name="organizationName[]" value="'+lastOrganizationName+'" class="form-control" readonly="true"></div>';
            deleteRow          = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
            $('#organization_div_c').append('<div class="row">'+inputOrganization+deleteRow+'</div>');

            $('#organization_c').val('');
        });

        /* ----------------------------------------
            * eliminar renglón de escolaridad
            * ----------------------------------------
        */
        $("#organization_div_c").on('click', '#borrar',function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        /* ----------------------------------------
             * Agregar renglones a los idiomas cada que se presiona
             * el botón agregar y mostrarlos debajo
             * y también la función de eliminar el renglón
             * -------------------------------------------
            */
            var type_record = [];
            var text_record = [];
            var period_record = [];
            var proof_record = [];
            var clone_record;
            var con_record = 0;

            /*
            Validamos si ya existen datos guardados
            */
            @isset($data['record_files_register'])
                language = {!! json_encode($data['record_files_register']) !!};
                $.each(language, function(i, item) {
                    console.log(item);
                    inputTypeRecord   = '<div class="form-group col-md-2"><input type="text" name="type_record[]" value="'+item.type+'" class="form-control" readonly="true"></div>';
                    inputTextRecord   = '<div class="form-group col-md-5"><input type="text" name="text_record[]" value="'+item.description+'" class="form-control" readonly="true"></div>';
                    inputPeriodRecord = '<div class="form-group col-md-2"><input type="text" name="period_record[]" value="'+item.expiration_date+'" class="form-control" readonly="true"></div>';
                    inputFileRecord = '<div class="form-group col-md-2"><a type="button" href="/storage/'+item.proof+'" target="_blank"class="btn btn-primary col-md-12"><i class="fa fa-file"></i> Ver </a> <input type="text" name="file_record[]" value="'+item.proof+'" style="display:none"></div>';
                    deleteRow = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                    $('#record_div_c').append('<div class="row">'+inputTypeRecord+inputTextRecord+inputPeriodRecord+inputFileRecord+deleteRow+'</div>');
                });
            @endisset


            $('#save_record_c').on('click',  function(e) {
                e.preventDefault();

                type_record.push($('#type_file').val());
                text_record.push($('#text_file').val());
                period_record.push($('#expiration_date').val());
                proof_record.push($('#proof_record').val());

                var lastTypeRecord   = type_record[type_record.length-1];
                var lastTextRecord   = text_record[text_record.length-1];
                var lastPeriodRecord = period_record[period_record.length-1];

                inputTypeRecord   = '<div class="form-group col-md-2"><input type="text" name="type_record[]" value="'+lastTypeRecord+'" class="form-control" readonly="true"></div>';
                inputTextRecord   = '<div class="form-group col-md-5"><input type="text" name="text_record[]" value="'+lastTextRecord+'" class="form-control" readonly="true"></div>';
                inputPeriodRecord = '<div class="form-group col-md-2"><input type="text" name="period_record[]" value="'+lastPeriodRecord+'" class="form-control" readonly="true"></div>';
                inputFileRecord = '<div class="form-group col-md-2"><input type="text" name="fileName_record'+con_record+'" id="fileName_record'+con_record+'" class="form-control" readonly="true"> <span id="file_record'+con_record+'"><input type="file" id="file2_record'+con_record+' name="file2_record'+con_record+'" style="display:none"/></div>';
                deleteRow = '<div class="form-group col-md-1"><button type="button" class="btn btn-danger" id="borrar"><span class="fa fa-minus"></span></button></div>';
                $('#record_div_c').append('<div class="row">'+inputTypeRecord+inputTextRecord+inputPeriodRecord+inputFileRecord+deleteRow+'</div>');

                clone_record = $("#proof_record").clone();
                clone_record.attr('id', 'file2_record'+con_record);
                $("#file_record"+con_record).html(clone_record);
                $("#fileName_record"+con_record).val(clone_record[0]['files'][0]['name']);

                $('#type_file').val('');
                $('#text_file').val('');
                $('#expiration_date').val('');
                $("#proof_record").val('');
                con_record++;
            });

            /* ----------------------------------------
             * eliminar renglón de escolaridad
             * ----------------------------------------
            */
            $("#record_div_c").on('click', '#borrar',function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });

        /*
        Date Range
        */
        $(function() {
            $('input[name="period"]').daterangepicker({
                opens: 'right',
                drops: 'up',
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " a ",
                    "applyLabel": "Aceptar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                },
            }, function(start, end, label) {
              //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

        $(function() {
            $('input[name="jobposotionperiod"]').daterangepicker({
                opens: 'right',
                drops: 'up',
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " a ",
                    "applyLabel": "Aceptar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                },
            }, function(start, end, label) {
              //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

        $(function() {
            $('input[name="expiration_date_c"]').datepicker({
                autoclose: true,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                },
            }, function(start, end, label) {
              //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

        $(document).on('change', ':file', function() {
            var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
         });

        $(document).ready( function() {
            $(':file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' Archivos Seleccionados' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    //if( log ) alert(log);
                }

            });
        });
    </script>
  @endsection
