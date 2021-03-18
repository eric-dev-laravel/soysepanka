<div class="row">

    <div class="col-md-12">
        <div class="col-md-3">

            <div class="col-md-12">
                @if (empty($data['records_info'][0]->picture))
                    <img class="img-circle" src="{{ asset('img/record/user.png') }}" alt="User Avatar" style="max-height: 222px;">
                @else
                    <img class="img-circle" src="{{ asset($data['records_info'][0]->url_path) }}" alt="User Avatar" style="max-height: 222px;">
                @endif
            </div>

        </div>
        <div class="col-md-8">
            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.datatables_headers.name') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->nombre }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.datatables_headers.paterno') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->paterno }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.datatables_headers.materno') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->materno }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.phone_number') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->celular }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.home_number') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->telefono }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.email') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->correoempresa }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.gender') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->sexo }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.birthday') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->nacimiento }} </label>
            </div>

            <div class="form-group col-xs-6 col-md-4">
                {{ trans('message.ex.rfc') }}<br />
                <label for="nombre" style="font-size: 17px"> {{ $data['employee_info'][0]->rfc }} </label>
            </div>

        </div>
    </div>

</div>

<div class="row">
    <form method="post" id="updateProfileHealth" action="{{ url('records-update-health/'.$data['employee_info'][0]->id) }}" enctype="multipart/form-data" autocomplete="off">
        {!! csrf_field() !!}
    
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-heartbeat"></i> {{ trans('message.ex.health_data_title') }}</h3>
            </div>

            <div class="box-body">

                <div class="form-group col-md-12">

                    <div class="form-group col-md-6">
                        <label for="language">{{ trans('message.ex.nss') }}</label>
                        @if (empty($data['records_info'][0]->nss))
                            <input type="text" name="health_nss_c" id="health_nss" class="form-control">
                        @else
                            <input type="text" name="health_nss_c" id="health_nss" value="{{ $data['records_info'][0]->nss }}" class="form-control">
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="language">{{ trans('message.ex.blood') }}</label>
                        @if (empty($data['records_info'][0]->blood))
                            <input type="text" name="health_blood_c" id="health_blood" class="form-control">
                        @else
                            <input type="text" name="health_blood_c" id="health_blood" value="{{ $data['records_info'][0]->blood }}" class="form-control">
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label for="nombre">{{ trans('message.ex.diseases') }}</label>
                        @if (empty($data['records_info'][0]->diseases))
                            <textarea class="form-control" rows="4" id="health_diseases_c" name="health_diseases_c"></textarea>
                        @else
                            <textarea class="form-control" rows="4" id="health_diseases_c" name="health_diseases_c"> {{ $data['records_info'][0]->diseases }} </textarea>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label for="nombre">{{ trans('message.ex.allergy') }}</label>
                        @if (empty($data['records_info'][0]->allergy))
                            <textarea class="form-control" rows="4" id="health_allergy_c" name="health_allergy_c"></textarea>
                        @else
                            <textarea class="form-control" rows="4" id="health_allergy_c" name="health_allergy_c"> {{ $data['records_info'][0]->allergy }} </textarea>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-info-circle"></i> {{ trans('message.ex.policy_data_title') }}</h3>
            </div>

            <div class="box-body">

                <div class="form-group col-md-12">

                    <div class="form-group col-md-2">
                        <label for="language">{{ trans('message.ex.policy_type') }}</label>
                            <select class="form-control" id="policy_type" name="policy_type_c">
                                <option value="">Ninguno</option>
                                <option value="Vida">Vida</option>
                                <option value="Gastos Médicos">Gastos Médicos</option>
                            </select>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="language">{{ trans('message.ex.policy_company') }}</label>
                        <input type="text" name="policy_company_c" id="policy_company" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="language">{{ trans('message.ex.policy_number') }}</label>
                        <input type="text" name="policy_number_c" id="policy_number" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                        <label for="spoken">Agregar:</label>
                        <button type="button" class="btn btn-success" id="save_record_policy_c">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>

                    <div class="form-group col-md-12" id="record_policy_div_c"></div>

                </div>

            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-medkit"></i> {{ trans('message.ex.exam_medical_data_title') }}</h3>
            </div>

            <div class="box-body">

                <div class="form-group col-md-12">

                    <div class="form-group col-md-7">
                        <label for="language">{{ trans('message.ex.medical_exam_reason') }}</label>
                        <input type="text" name="medical_exam_reason" id="medical_exam_reason_c" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="spoken">{{ trans('message.ex.medical_exam_date') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="medical_exam_date_c" name="medical_exam_date">
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="spoken">{{ trans('message.ex.medical_exam_file') }}</label>
                        <input type="file" name="medicalExamFile[]" id="medical_exam_file" style="display: none">
                        <button type="button" id="btn_proof_medical_exam" class="btn btn-light text-white btn_proof_medical_exam btn-success form-control">
                            <i class="fa fa-file-pdf-o"></i> {{ trans('message.ex.search') }}
                        </button>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="spoken">Agregar:</label>
                        <button type="button" class="btn btn-success" id="save_record_medical_exam_c">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>

                    <div class="form-group col-md-12" id="record_medical_exam_div_c"></div>

                </div>

            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users"></i> {{ trans('message.ex.emergency_contact_data_title') }}</h3>
            </div>

            <div class="box-body">

                <div class="form-group col-md-12">

                    <div class="form-group col-md-7">
                        <label for="language">{{ trans('message.ex.emergency_contact_name') }}</label>
                        @if (empty($data['records_info'][0]->contact_name1))
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control">
                        @else
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ $data['records_info'][0]->contact_name1 }}" class="form-control">
                        @endif
                        
                    </div>

                    <div class="form-group col-md-3">
                        <label for="language">{{ trans('message.ex.emergency_contact_phone') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            @if (empty($data['records_info'][0]->contact_phone1))
                                <input type="text" class="form-control" name="emergency_contact_phone" id="emergency_contact_phone">
                            @else
                                <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ $data['records_info'][0]->contact_phone1 }}" class="form-control">
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="language">{{ trans('message.ex.emergency_contact_parent') }}</label>
                        <select class="form-control" id="emergency_contact_parent" name="emergency_contact_parent">
                            <option value="">Ninguno</option>
                            <option value="Padre" {{ ('Padre' == $data['records_info'][0]->contact_patent1) ? 'selected':'' }} >Padre</option>
                            <option value="Madre" {{ ('Madre' == $data['records_info'][0]->contact_patent1) ? 'selected':'' }} >Madre</option>
                            <option value="Esposo" {{ ('Esposo' == $data['records_info'][0]->contact_patent1) ? 'selected':'' }} >Esposo</option>
                            <option value="Esposa" {{ ('Esposa' == $data['records_info'][0]->contact_patent1) ? 'selected':'' }} >Esposa</option>
                            <option value="Hijo" {{ ('Hijo' == $data['records_info'][0]->contact_patent1) ? 'selected':'' }} >Hijo</option>
                        </select>
                    </div>

                </div>

                <div class="form-group col-md-12">

                    <div class="form-group col-md-7">
                        <label for="language">{{ trans('message.ex.emergency_contact_name') }}</label>
                        @if (empty($data['records_info'][0]->contact_name2))
                            <input type="text" name="emergency_contact_name2" id="emergency_contact_name2" class="form-control">
                        @else
                            <input type="text" name="emergency_contact_name2" id="emergency_contact_name2" value="{{ $data['records_info'][0]->contact_name2 }}" class="form-control">
                        @endif
                    </div>

                    <div class="form-group col-md-3">
                        <label for="language">{{ trans('message.ex.emergency_contact_phone') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            @if (empty($data['records_info'][0]->contact_phone2))
                                <input type="text" class="form-control" name="emergency_contact_phone2" id="emergency_contact_phone2">
                            @else
                                <input type="text" name="emergency_contact_phone2" id="emergency_contact_phone2" value="{{ $data['records_info'][0]->contact_phone2 }}" class="form-control">
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="language">{{ trans('message.ex.emergency_contact_parent') }}</label>
                        <select class="form-control" id="emergency_contact_parent2" name="emergency_contact_parent2">
                            <option value="">Ninguno</option>
                            <option value="Padre" {{ ('Padre' == $data['records_info'][0]->contact_patent2) ? 'selected':'' }} >Padre</option>
                            <option value="Madre" {{ ('Madre' == $data['records_info'][0]->contact_patent2) ? 'selected':'' }} >Madre</option>
                            <option value="Esposo" {{ ('Esposo' == $data['records_info'][0]->contact_patent2) ? 'selected':'' }} >Esposo</option>
                            <option value="Esposa" {{ ('Esposa' == $data['records_info'][0]->contact_patent2) ? 'selected':'' }} >Esposa</option>
                            <option value="Hijo" {{ ('Hijo' == $data['records_info'][0]->contact_patent2) ? 'selected':'' }} >Hijo</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="box-footer">
                <div class="row col-md-1 col-sm-12">
                    <button type="button" onclick="window.location.href = '{{ url('records') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                </div>
                <div class="row col-md-1 col-sm-12 col-md-offset-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> {{ trans('message.buttons.edit') }}</button>
                </div>
                <div class="row col-md-1 col-sm-12 col-md-offset-1">
                    <button type="button" onclick="window.location.href = '{{ url('records') }}';" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.buttons.cancel') }}</button>
                </div>
            </div>

        </div>
    </div>

    </form>
</div>
