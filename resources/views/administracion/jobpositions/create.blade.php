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

                <h4><i class="icon fa fa-grav"></i> {{ trans('message.modals.alert') }}</h4>
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
                    <h3 class="box-title"><i class="fa fa-grav"></i> {{ trans('message.createjobposition') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row col-md-12">
                        <form role="form" method="POST" action="{{ route('admin-jobpositions.store') }}" id="create">
                            {!! method_field('POST') !!}
                            {!! csrf_field() !!}

                            <div class="box box-primary">

                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-pencil"></i> {{ trans('message.info_createjobposition') }}</h3>
                                </div>

                                <div class="box-body">

                                    {{--<div class="form-group col-md-6">
                                        <label for="id_enterprise">{{ trans('message.datatables_headers.mark') }}</label>
                                        <select class="form-control" id="id_mark" name="id_mark">
                                            <option value="">Sin Marca</option>
                                            @foreach ($data['enterprises'] as $enterprises)
                                                <option value="{{ $enterprises->id }}">{{  $enterprises->name   }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_direction">{{ trans('message.datatables_headers.direction') }}</label>
                                        <select class="form-control" id="id_direction" name="id_direction">
                                            <option value="">Sin dirección</option>
                                            @foreach ($data['directions'] as $direction)
                                                <option value="{{ $direction->id }}">{{  $direction->name   }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_direction">{{ trans('message.datatables_headers.area') }}</label>
                                        <select class="form-control" id="id_area" name="id_area">
                                            <option value="">Sin Área</option>
                                            @foreach ($data['areas'] as $area)
                                                <option value="{{ $area->id }}">{{  $area->name   }}</option>
                                            @endforeach
                                        </select>
                                    </div>--}}
                                    
                                    <div class="form-group col-md-12">
                                        {{ trans('message.datatables_headers.instructionsOfAddJobPositions') }}
                                    </div>

                                    <div style="display:none">
                                        <input type="text" class="form-control" id="jobPositionSelected" name="jobPositionSelected">
                                    </div>

                                    <div class="col-md-12">

                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-book"></i> {{ trans('message.ma.admin_list_jobpositions') }}</h3>
                                            </div>

                                            <div class="box-body">
                                                <table class="table data-table table-row-border" id="jobPositionCatalog" name="jobPositionCatalog">
                                                    <thead>
                                                        <tr style="background-color: #7A75B5; color: white; font-size: 14px;">
                                                            <th style="background-color: #002C49"></th>
                                                            <th>{{ trans('message.datatables_headers.number') }}</th>
                                                            <th>{{ trans('message.datatables_headers.name') }}</th>
                                                            <th>{{ trans('message.datatables_headers.objective') }}</th>
                                                            <th>{{ trans('message.datatables_headers.activities') }}</th>
                                                            <th>{{ trans('message.datatables_headers.responsabilities') }}</th>
                                                            <th>{{ trans('message.datatables_headers.competitions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer">
                                    <div class="row col-md-1 col-sm-12">
                                        <button type="button" onclick="window.location.href = '{{ url('admin-jobpositions') }}';" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ trans('message.buttons.back') }}</button>
                                    </div>
                                    <div class="row col-md-1 col-sm-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{ trans('message.buttons.create') }}</button>
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

    </div>

@endsection

@section('main-script')
    <script type="text/javascript">
        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 5000); // <-- time in milliseconds


        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('jobpositionscatalog.select.list') }}",
                columns: [
                    {data: 'selected', name: 'selected'},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'objective', name: 'objective'},
                    {data: 'activities', name: 'activities'},
                    {data: 'responsabilities', name: 'responsabilities'},
                    {data: 'competitions', name: 'competitions'},
                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0,
                    },
                    {"align-text": "center", "targets": [0]},
                    { "width": "200px", "targets": [2, 3, 4, 5, 6],},
                    {"className": "dt-justify", "targets": [2, 3, 4, 5]},
                ],
                select: {
                    style:    'multi',
                    selector: 'td:first-child',
                }
                //fixedColumns:   {
                  //  leftColumns: 2,
               // }
            });

            var selectedUsers = [];
            table.on( 'select', function ( e, dt, type, indexes ) {
                var rowData = table.rows( indexes ).data().toArray();
                selectedUsers.push(rowData[0]['id']);
                document.getElementById('jobPositionSelected').value = selectedUsers;
            }).on( 'deselect', function ( e, dt, type, indexes ) {
                var rowData = table.rows( indexes ).data().toArray();
                selectedUsers.remove(rowData[0]['id']);
                document.getElementById('jobPositionSelected').value = selectedUsers;
            });

            Array.prototype.remove = function() {
                var what, a = arguments, L = a.length, ax;
                while (L && this.length) {
                    what = a[--L];
                    while ((ax = this.indexOf(what)) !== -1) {
                        this.splice(ax, 1);
                    }
                }
                return this;
            };
        });
    </script>
@endsection
