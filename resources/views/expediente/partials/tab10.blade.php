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
    <form method="post" id="updateProfileBeneficiaries" action="{{ url('records-update-beneficiaries/'.$data['employee_info'][0]->id) }}" enctype="multipart/form-data" autocomplete="off">
        {!! csrf_field() !!}

        <div class="col-md-12">
            <div class="box box-primary">
    
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-map-o" aria-hidden="true"></i> {{ trans('message.ex.beneficiaries_title') }}</h3>
                </div>

                <div class="box-body">
                    <div class="form-group col-md-12">
                        <h3 class="mt-3">{{ trans('message.ex.title_spouse_name') }}</h3>
                        <div class="form-group col-md-4">
                            <label for="spouse_name">{{ trans('message.ex.spouse_name') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->spouse_name))
                                <input type="text" name="spouse_name" id="spouse_name" class="form-control">
                            @else
                                <input type="text" name="spouse_name" id="spouse_name" value="{{ $data['record_beneficiaries'][0]->spouse_name }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="language">{{ trans('message.ex.date_marriage') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->date_marriage))
                                <input type="date" name="date_marriage" id="date_marriage" class="form-control">
                            @else
                                <input type="date" name="date_marriage" id="date_marriage" value="{{ $data['record_beneficiaries'][0]->date_marriage }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <div class="col-md-9">
                                <label for="exampleInputFile">{{ trans('message.ex.file_marriage') }}</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                        <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                                        <input type="file" name="file_marriage" id="file_marriage" style="display: none;">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if (!empty($data['record_beneficiaries'][0]->file_marriage))
                                    <label for="exampleInputFile">{{ trans('message.ex.proof_record') }}</label>
                                    <a type="button" href="{{ $data['record_beneficiaries'][0]->PathFileMarrige }}" target="_blank"class="btn btn-primary"><i class="fa fa-file"></i> Ver </a>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <h3 class="mt-3">{{ trans('message.ex.title_beneficiarie_name_son') }}</h3>
                        <div class="form-group col-md-4">
                            <label for="beneficiarie_name_son">{{ trans('message.ex.beneficiarie_name_son') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->beneficiarie_name_son))
                                <input type="text" name="beneficiarie_name_son" id="beneficiarie_name_son" class="form-control">
                            @else
                                <input type="text" name="beneficiarie_name_son" id="beneficiarie_name_son" value="{{ $data['record_beneficiaries'][0]->beneficiarie_name_son }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="language">{{ trans('message.ex.date_birth_beneficiarie_son') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->date_birth_beneficiarie_son))
                                <input type="date" name="date_birth_beneficiarie_son" id="date_birth_beneficiarie_son" class="form-control">
                            @else
                                <input type="date" name="date_birth_beneficiarie_son" id="date_birth_beneficiarie_son" value="{{ $data['record_beneficiaries'][0]->date_birth_beneficiarie_son }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-5">
                            <div class="col-md-10">
                                <label for="exampleInputFile">{{ trans('message.ex.file_birth_certificate_beneficiarie_son') }}</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                                            <input type="file" name="file_birth_certificate_beneficiarie_son[]" id="file_birth_certificate_beneficiarie_son" style="display: none;">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
    
                            <div class="col-md-2">
                                @if (!empty($data['record_beneficiaries'][0]->file_birth_certificate_beneficiarie_son))
                                    <label for="exampleInputFile">{{ trans('message.ex.file_birth_certificate_beneficiarie_son') }}</label>
                                    <a type="button" href="{{ $data['record_beneficiaries'][0]->PathFileDet }}" target="_blank"class="btn btn-primary"><i class="fa fa-file"></i> Ver </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-1">
                            <label for="add_son">Agregar:</label>
                            <button type="button" class="btn btn-success" id="add_sons">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div>

                        <div class="form-group col-md-12" id="destino_beneficiarios_hijos"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
    
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-map-o" aria-hidden="true"></i> {{ trans('message.ex.beneficiaries_title_parents') }}</h3>
                </div>

                <div class="box-body">
                    <div class="form-group col-md-12">
                        <div class="form-group col-md-4">
                            <label for="father_name">{{ trans('message.ex.father_name') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->father_name))
                                <input type="text" name="father_name" id="father_name" class="form-control">
                            @else
                                <input type="text" name="father_name" id="father_name" value="{{ $data['record_beneficiaries'][0]->father_name }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="language">{{ trans('message.ex.date_birth_father') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->date_birth_father))
                                <input type="date" name="date_birth_father" id="date_birth_father" class="form-control">
                            @else
                                <input type="date" name="date_birth_father" id="date_birth_father" value="{{ $data['record_beneficiaries'][0]->date_birth_father }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <div class="col-md-9">
                                <label for="exampleInputFile">{{ trans('message.ex.file_birth_certificate_father') }}</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                        <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                                        <input type="file" name="file_birth_certificate_father" id="file_birth_certificate_father" style="display: none;">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
    
                            <div class="col-md-3">
                                @if (!empty($data['record_beneficiaries'][0]->file_birth_certificate_father))
                                    <label for="exampleInputFile">{{ trans('message.ex.proof_record') }}</label>
                                    <a type="button" href="{{ $data['record_beneficiaries'][0]->PathFileFather }}" target="_blank"class="btn btn-primary"><i class="fa fa-file"></i> Ver </a>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <div class="form-group col-md-4">
                            <label for="mother_name">{{ trans('message.ex.mother_name') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->mother_name))
                                <input type="text" name="mother_name" id="mother_name" class="form-control">
                            @else
                                <input type="text" name="mother_name" id="mother_name" value="{{ $data['record_beneficiaries'][0]->mother_name }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="language">{{ trans('message.ex.date_birth_mother') }}</label>
                            @if (empty($data['record_beneficiaries'][0]->date_birth_mother))
                                <input type="date" name="date_birth_mother" id="date_birth_mother" class="form-control">
                            @else
                                <input type="date" name="date_birth_mother" id="date_birth_mother" value="{{ $data['record_beneficiaries'][0]->date_birth_mother }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <div class="col-md-9">
                                <label for="exampleInputFile">{{ trans('message.ex.file_birth_certificate_mother') }}</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                        <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                                        <input type="file" name="file_birth_certificate_mother" id="file_birth_certificate_mother" style="display: none;">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
    
                            <div class="col-md-3">
                                @if (!empty($data['record_beneficiaries'][0]->file_birth_certificate_mother))
                                    <label for="exampleInputFile">{{ trans('message.ex.proof_record') }}</label>
                                    <a type="button" href="{{ $data['record_beneficiaries'][0]->PathFileMother }}" target="_blank"class="btn btn-primary"><i class="fa fa-file"></i> Ver </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
    
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-map-o" aria-hidden="true"></i> {{ trans('message.ex.beneficiaries_title_other') }}</h3>
                </div>

                <div class="box-body">
                    <div class="form-group col-md-12">
                        <div class="form-group col-md-4">
                            <label for="beneficiarie_name_other">{{ trans('message.ex.beneficiarie_name_other') }}</label>
                            @if (empty($data['record_beneficiaries_otr'][0]->beneficiarie_name))
                                <input type="text" name="beneficiarie_name_other" id="beneficiarie_name_other" class="form-control">
                            @else
                                <input type="text" name="beneficiarie_name_other" id="beneficiarie_name_other" value="{{ $data['record_beneficiaries_otr'][0]->beneficiarie_name }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="language">{{ trans('message.ex.date_birth_beneficiarie_other') }}</label>
                            @if (empty($data['record_beneficiaries_otr'][0]->date_birth_beneficiarie))
                                <input type="date" name="date_birth_beneficiarie_other" id="date_birth_beneficiarie_other" class="form-control">
                            @else
                                <input type="date" name="date_birth_beneficiarie_other" id="date_birth_beneficiarie_other" value="{{ $data['record_beneficiaries_otr'][0]->date_birth_beneficiarie }}" class="form-control">
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <div class="col-md-9">
                                <label for="exampleInputFile">{{ trans('message.ex.file_birth_certificate_beneficiarie') }}</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                        <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                                        <input type="file" name="file_birth_certificate_beneficiarie" id="file_birth_certificate_beneficiarie" style="display: none;">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
    
                            <div class="col-md-3">
                                @if (!empty($data['record_beneficiaries_otr'][0]->file_birth_certificate_beneficiarie))
                                    <label for="exampleInputFile">{{ trans('message.ex.proof_record') }}</label>
                                    <a type="button" href="{{ $data['record_beneficiaries_otr'][0]->PathFileOtr }}" target="_blank"class="btn btn-primary"><i class="fa fa-file"></i> Ver </a>
                                @endif
                            </div>
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

