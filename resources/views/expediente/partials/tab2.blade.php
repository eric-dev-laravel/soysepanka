
    <div class="row">

        <div class="col-md-12">

            <div class="col-md-3 text-center">
                    <form method="post" id="zone" action="{{ url('records-update-image-profile/'.$data['employee_info'][0]->id) }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 text-center">

                                @if (empty($data['records_info'][0]->picture))
                                    <img class="img-circle" src="{{ asset('img/record/user.png') }}" alt="User Avatar" style="max-height: 222px;">
                                @else
                                    <img class="img-circle" src="{{ asset($data['records_info'][0]->url_path) }}" alt="User Avatar" style="max-height: 222px;">
                                @endif

                                <div class="form-group col-md-12 text-center">
                                    <input type="file" name="image" id="image" style="display:none">
                                    <button type="button" id="btn_select_image" class="btn btn-light text-white btn-image btn-success"><i class="fa fa-image"></i> Subir fotografía</button>
                                    <button type="submit" id="btn_update_image" class="btn btn-light text-white btn-profile-pic btn-warning" style="display:none"><i class="fa fa-image"></i> Actualizar Imagen</button>
                                </div>
                            </div>
                        </div>
                    </form>

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
        <form role="form" method="POST" action="{{ route('records.update',$data['employee_info'][0]->id) }}" id="updateRecord" enctype="multipart/form-data">
            {!! method_field('PUT') !!}
            {!! csrf_field() !!}
        <div class="col-md-12">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-map"></i> {{ trans('message.ex.address_title') }}</h3>
                </div>

                <div class="form-group col-ms-6 col-md-12 bg-gray disabled color-palette"><span>{{ trans('message.ex.msg1') }}</span></div>

                <div class="box-body">

                    <div class="form-group col-xs-12 col-md-8">
                        <label for="nombre">{{ trans('message.ex.street') }}</label>
                        <input type="text" class="form-control" id="street" name="street">
                    </div>

                    <div class="form-group col-xs-6 col-md-2">
                        <label for="nombre">{{ trans('message.ex.external_number') }}</label>
                        <input type="text" class="form-control" id="external_number" name="external_number">
                    </div>

                    <div class="form-group col-xs-6 col-md-2">
                        <label for="nombre">{{ trans('message.ex.internal_number') }}</label>
                        <input type="text" class="form-control" id="internal_number" name="internal_number">
                    </div>

                    <div class="form-group col-xs-6 col-md-4">
                        <label for="nombre">{{ trans('message.ex.postal_number') }}</label>
                        <input type="text" class="form-control" id="postal_number" name="postal_number">
                    </div>

                    <div class="form-group col-xs-6 col-md-4">
                        <label for="nombre">{{ trans('message.ex.city') }}</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>

                    <div class="form-group col-xs-6 col-md-4">
                        <label for="nombre">{{ trans('message.ex.state') }}</label>
                        <input type="text" class="form-control" id="government" name="government">
                    </div>

                    <div class="form-group col-ms-6 col-md-12">
                        <label for="exampleInputFile">{{ trans('message.ex.proof_address') }}</label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-success">
                                <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                                <input type="file" name="filesImport[]" id="filesImport" style="display: none;">
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-graduation-cap"></i> {{ trans('message.ex.education_title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group col-ms-6 col-md-12 bg-gray disabled color-palette"><span>{{ trans('message.ex.msg2') }}</span></div>

                    <div class="form-group col-md-12">

                        <div class="form-group col-md-3">
                            <label for="language">{{ trans('message.ex.especiality') }}</label>
                            <input type="text" name="especiality" id="especiality" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="language">{{ trans('message.ex.level') }}</label>
                            <!--<input type="text" name="nlanguage" id="language_c" class="form-control">-->

                                <select class="form-control" id="level" name="level">
                                    <option value="">Ninguno</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                    <option value="Preparatoria">Preparatoria</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Maestría">Maestría</option>
                                    <option value="Doctorado">Doctorado</option>
                                    <option value="Diplomado">Diplomado</option>
                                    <option value="Curso">Curso</option>
                                </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="reading">{{ trans('message.ex.state') }}</label>
                            <!--<input type="text" name="reading" id="reading_c" class="form-control">-->

                            <select class="form-control" id="status" name="status">
                                <option value="">Ninguno</option>
                                <option value="Culminado">Culminado</option>
                                <option value="Inconcluso">Inconcluso</option>
                                <option value="Aplazado">Aplazado</option>
                                <option value="Cursando">Cursando</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="writing">{{ trans('message.ex.education_center') }}</label>
                            <input type="text" name="education_center" id="education_center" class="form-control">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="spoken">{{ trans('message.ex.period') }}</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="period" name="period">
                              </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="spoken">{{ trans('message.ex.proof_education') }}</label>
                                <input type="file" name="proofEducation[]" id="proof_education" style="display: none">
                                <button type="button" id="btn_proof_education" class="btn btn-light text-white btn-proof-education btn-success form-control"><i class="fa fa-file-pdf-o"></i> {{ trans('message.ex.search') }}</button>
                        </div>

                        <div class="form-group col-md-1 col-xs-offset-4">
                            <label for="spoken">Agregar:</label>
                            <button type="button" class="btn btn-success" id="save_language_c">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div>

                        <div class="form-group col-md-12" id="formation_div_c"></div>

                    </div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-puzzle-piece"></i> {{ trans('message.ex.otherKnowledge_title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group col-md-12">
                        <label for="language">{{ trans('message.ex.language') }}</label>
                        <input type="text" name="language" id="language" class="form-control">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="nombre">{{ trans('message.ex.my_tools') }}</label>
                        <textarea class="form-control" rows="4" id="myTools" name="myTools"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="nombre">{{ trans('message.ex.my_programs') }}</label>
                        <textarea class="form-control" rows="4" id="myPrograms" name="myPrograms"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="nombre">{{ trans('message.ex.my_functions') }}</label>
                        <textarea class="form-control" rows="4" id="MyFunctions" name="MyFunctions"></textarea>
                    </div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-briefcase"></i> {{ trans('message.ex.otherjobs_title') }}</h3>
                </div>

                <div class="form-group col-ms-6 col-md-12 bg-gray disabled color-palette"><span>{{ trans('message.ex.msg3') }}</span></div>

                <div class="box-body">

                    <div class="form-group col-md-6">
                        <label for="language">{{ trans('message.ex.jobposition') }}</label>
                        <input type="text" name="jobposition" id="jobposition_c" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="language">{{ trans('message.ex.enterprise') }}</label>
                        <input type="text" name="enterprise" id="enterprise_c" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="spoken">{{ trans('message.ex.period') }}</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="jobposotionperiod_c" name="jobposotionperiod">
                          </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="spoken">{{ trans('message.ex.salary') }}</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="number" id="salary_c" name="salary" class="form-control">
                        </div>
                    </div>

                    <div class="form-group col-md-7">
                        <label for="language">{{ trans('message.ex.separation') }}</label>
                        <input type="text" name="separation" id="separation_c" class="form-control">
                    </div>

                    <div class="form-group col-md-11">
                        <label for="nombre">{{ trans('message.ex.my_activities') }}</label>
                        <textarea class="form-control" rows="4" id="myActivities_c" name="myActivities"></textarea>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="spoken">Agregar:</label>
                        <button type="button" class="btn btn-success" id="save_other_jobs">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>

                    <div class="form-group col-md-12" id="other_jobs_div_c"></div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-commenting"></i> {{ trans('message.ex.references_title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group col-md-4">
                        <label for="language">{{ trans('message.ex.name') }}</label>
                        <input type="text" name="referenceName" id="referenceName_c" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="language">{{ trans('message.ex.telephone') }}</label>
                        <input type="text" name="referenceTel" id="referenceTel_c" class="form-control">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="language">{{ trans('message.ex.time') }}</label>
                        <input type="text" name="referenceTime" id="referenceTime_c" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="language">{{ trans('message.ex.ocupation') }}</label>
                        <input type="text" name="referenceOcupation" id="referenceOcupation_c" class="form-control">
                    </div>

                    <div class="form-group col-md-1">
                        <label for="spoken">Agregar:</label>
                        <button type="button" class="btn btn-success" id="save_references">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>

                    <div class="form-group col-md-12" id="references_div_c"></div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-users"></i> {{ trans('message.ex.family_title') }}</h3>
                </div>

                <div class="form-group col-ms-6 col-md-12 bg-gray disabled color-palette"><span>{{ trans('message.ex.msg4') }}</span></div>

                <div class="box-body">

                    <div class="form-group col-md-9">
                        <label for="language">{{ trans('message.ex.name') }}</label>
                        <select class="form-control" id="familyName_c" name="familyName">
                            <option value="">Ninguno</option>
                            @foreach ($data['all_employee'] as $employee)
                            <option value="{{$employee->id }}">{{ $employee->nombre . ' ' . $employee->paterno . ' ' . $employee->materno }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="language">{{ trans('message.ex.typeFamily') }}</label>
                        <select class="form-control" id="familyType_c" name="familyType">
                            <option value="">Ninguno</option>
                            <option value="Padre">Padre</option>
                            <option value="Madre">Madre</option>
                            <option value="Esposo">Esposo</option>
                            <option value="Esposa">Esposa</option>
                            <option value="Conyugue">Conyugue</option>
                            <option value="Hijo">Hijo</option>
                            <option value="Primo">Primo</option>
                            <option value="Tio">Tio</option>
                            <option value="Sobrino">Sobrino</option>
                        </select>
                    </div>

                    <div class="form-group col-md-1">
                        <label for="spoken">Agregar:</label>
                        <button type="button" class="btn btn-success" id="save_family">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>

                    <div class="form-group col-md-12" id="family_div_c"></div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-plane"></i> {{ trans('message.ex.available_title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group col-md-12">
                        <label for="nombre">{{ trans('message.datatables_headers.available') }}</label>
                        <textarea class="form-control" rows="4" id="available" name="available" placeholder="{{ trans('message.ex.available') }}"></textarea>
                    </div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-umbrella"></i> {{ trans('message.ex.syndicated_title') }}</h3>
                </div>

                <div class="form-group col-ms-6 col-md-12 bg-gray disabled color-palette"><span>{{ trans('message.ex.msg5') }}</span></div>

                <div class="box-body">

                    <div class="form-group col-xs-12 col-md-11">
                        <label for="nombre">{{ trans('message.ex.organization') }}</label>
                        <input type="text" class="form-control" id="organization_c" name="organization">
                    </div>

                    <div class="form-group col-md-1">
                        <label for="spoken">Agregar:</label>
                        <button type="button" class="btn btn-success" id="save_organization">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>

                    <div class="form-group col-md-12" id="organization_div_c"></div>

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
