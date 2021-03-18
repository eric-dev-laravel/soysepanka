
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
        <form method="post" id="updateProfileFiles" action="{{ url('records-update-files/'.$data['employee_info'][0]->id) }}" enctype="multipart/form-data" autocomplete="off">
            {!! csrf_field() !!}
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-file"></i> {{ trans('message.ex.record_title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group col-md-12">

                        <div class="form-group col-md-2">
                            <label for="language">{{ trans('message.ex.type_file') }}</label>
                                <select class="form-control" id="type_file" name="type_file_c">
                                    <option value="">Ninguno</option>
                                    <option value="RFC">RFC</option>
                                    <option value="CURP">CURP</option>
                                    <option value="NSS">NSS</option>
                                    <option value="Licencia">Licencia</option>
                                </select>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="language">{{ trans('message.ex.text_file') }}</label>
                            <input type="text" name="text_file_c" id="text_file" class="form-control">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="spoken">{{ trans('message.ex.expiration_date') }}</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="expiration_date" name="expiration_date_c">
                              </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="spoken">{{ trans('message.ex.proof_record') }}</label>
                                <input type="file" name="proofRecord[]" id="proof_record"  style="display: none">
                                <button type="button" id="btn_proof_record" class="btn btn-light text-white btn-proof-record btn-success form-control"><i class="fa fa-file-pdf-o"></i> {{ trans('message.ex.search') }}</button>
                        </div>

                        <div class="form-group col-md-1">
                            <label for="spoken">Agregar:</label>
                            <button type="button" class="btn btn-success" id="save_record_c">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div>

                        <div class="form-group col-md-12" id="record_div_c"></div>

                    </div>

                </div>

            </div>
        </div>

        </form>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> {{ trans('message.ex.register_data_title') }}</h3>
                </div>

                <div class="box-body">

                    @if (count($data['record_info_jobposition']) > 0)
                        <div class="form-group col-md-12">

                            <div class="form-group col-md-5">
                                <label for="info1">{{ trans('message.ex.info1') }}</label>
                                <input type="text" name="info1" id="info1" value="{{ $data['employee_info'][0]->puesto }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="info1">{{ trans('message.ex.info2') }}</label>
                                <input type="text" name="info2" id="info2" value="{{ $data['employee_info'][0]->fechapuesto }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="info1">{{ trans('message.ex.info3') }}</label>
                                <input type="text" name="info3" id="info3" value="{{ $data['record_info_jobposition'][0]->workshift->name }} de {{ $data['record_info_jobposition'][0]->workshift->up_start  }} a {{ $data['record_info_jobposition'][0]->workshift->down_end  }} " class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="info1">{{ trans('message.ex.info4') }}</label>
                                <input type="text" name="info4" id="info4" value="{{ $data['employee_info'][0]->departamento }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="info1">{{ trans('message.ex.info5') }}</label>
                                <input type="text" name="info5" id="info5" value="{{ $data['employee_info'][0]->seccion }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="info1">{{ trans('message.ex.info6') }}</label>
                                <input type="text" name="info6" id="info6" value="{{ $data['record_info_jobposition'][0]->salary_min }} a {{ $data['record_info_jobposition'][0]->salary_max }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="info1">{{ trans('message.ex.info7') }}</label>
                                <input type="text" name="info7" id="info7" value="{{ $data['record_info_jobposition'][0]->salary_range }}" class="form-control" readonly>
                            </div>

                        </div>
                    @else
                        <div class="col-md-12">

                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="{{ asset('img/errors/error_no_datos.png') }}" style="width:100%; height: 450px;" alt="First slide">
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

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
