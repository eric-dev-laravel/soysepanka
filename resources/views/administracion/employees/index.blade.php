@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_employee_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_employee_title') }}
@endsection

@section('main-content')
    @if($errors->any())
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i> {{ trans('message.modals.alert') }}</h4>
                {{ trans('message.modals.alert_message') }}

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
                {{ trans('message.modals.successupdate_message') }}
            </div>
        </div>
    </div>
    @endif
	<div class="container-fluid spark-screen">

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_all_employee') }}</span>
                        <span class="info-box-number">{{ $users_data['all_users'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_active_employee') }}</span>
                        <span class="info-box-number">{{ $users_data['active_users'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_inactive_employee') }}</span>
                        <span class="info-box-number">{{ $users_data['inactive_users'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-wrench"></i> {{ trans('message.tools') }}</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
                    </div>

					<div class="box-body">

                        <div class="row col-md-12">
                            <div class="form-group">
                                <div class="box box-success box-solid">

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-download"></i> {{ trans('message.import') }}</h3>
                                    </div>

                                    <form role="form" method="POST" action="{{ url('employees-file-layout') }}" id="importLayout" enctype="multipart/form-data">
                                    {!! method_field('POST') !!}
                                    {!! csrf_field() !!}
                                    <div class="box-body">
                                        <div class="row col-ms-10 col-sm-10 col-md-offset-1">
                                            <label for="exampleInputFile">{{ trans('message.fromfile') }}</label>
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-success">
                                                    <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Examinar
                                                    <input type="file" name="filesImport[]" id="filesImport" style="display: none;">
                                                    </span>
                                                </label>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <p class="help-block">{{ trans('message.fromfile2') }}</p>
                                        </div>

                                        <div class="col-md-3 col-md-offset-1">
                                            <button type="submit" class="btn btn-block btn-success"><i class="fa fa-file"></i> {{ trans('message.ma.startimportation') }}</button>
                                        </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <div class="form-group">
                                <div class="box box-primary box-solid">

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-upload"></i> {{ trans('message.export') }}</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('download-employees/3') }}';" class="btn btn-block btn-primary"><i class="fa fa-file"></i> {{ trans('message.onlytemplate') }}</button>
                                        </div>
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('download-employees/1') }}';" class="btn btn-block btn-primary"><i class="fa fa-users"></i> {{ trans('message.allemployees') }}</button>
                                        </div>
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('download-employees/2') }}';" class="btn btn-block btn-primary"><i class="fa fa-user"></i> {{ trans('message.onlyactiveemployees') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <div class="form-group">
                                <div class="box box-info box-solid">

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> {{ trans('message.manual') }}</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('admin-employees/create') }}';" class="btn btn-block btn-info"><i class="fa fa-user-plus"></i> {{ trans('message.newemployee') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

        <div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-users"></i> {{ trans('message.ma.admin_list_employee') }}</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
                    </div>

					<div class="box-body">
						<table class="table data-table table-row-border order-column">
                            <thead>
                                <tr style="background-color: #7A75B5; color: white; text-align: center; font-size: 14px;">
                                    <th>{{ trans('message.datatables_headers.number') }}</th>
                                    <th>{{ trans('message.datatables_headers.idemployee') }}</th>
                                    <th>{{ trans('message.datatables_headers.name') }}</th>
                                    <th>{{ trans('message.datatables_headers.rfc') }}</th>
                                    <th>{{ trans('message.datatables_headers.origin') }}</th>
                                    <th>{{ trans('message.datatables_headers.curp') }}</th>
                                    <th>{{ trans('message.datatables_headers.nss') }}</th>
                                    <th>{{ trans('message.datatables_headers.enterprise_mail') }}</th>
                                    <th>{{ trans('message.datatables_headers.personnel_mail') }}</th>
                                    <th>{{ trans('message.datatables_headers.birth') }}</th>
                                    <th>{{ trans('message.datatables_headers.gender') }}</th>
                                    <th>{{ trans('message.datatables_headers.state') }}</th>
                                    <th>{{ trans('message.datatables_headers.phone') }}</th>
                                    <th>{{ trans('message.datatables_headers.ext') }}</th>
                                    <th>{{ trans('message.datatables_headers.movil') }}</th>
                                    <th>{{ trans('message.datatables_headers.entry') }}</th>
                                    <th>{{ trans('message.datatables_headers.date_position') }}</th>
                                    <th>{{ trans('message.datatables_headers.boss') }}</th>
                                    <th>{{ trans('message.datatables_headers.direction') }}</th>
                                    <th>{{ trans('message.datatables_headers.department') }}</th>
                                    <th>{{ trans('message.datatables_headers.section') }}</th>
                                    <th>{{ trans('message.datatables_headers.position') }}</th>
                                    <th>{{ trans('message.datatables_headers.grade') }}</th>
                                    <th>{{ trans('message.datatables_headers.region') }}</th>
                                    <th>{{ trans('message.datatables_headers.subsidiary') }}</th>
                                    <th>{{ trans('message.datatables_headers.enterprise_id') }}</th>
                                    <th>{{ trans('message.datatables_headers.enterprise') }}</th>
                                    <th>{{ trans('message.datatables_headers.division') }}</th>
                                    <th>{{ trans('message.datatables_headers.mark') }}</th>
                                    <th>{{ trans('message.datatables_headers.center') }}</th>
                                    <th>{{ trans('message.datatables_headers.timer') }}</th>
                                    <th>{{ trans('message.datatables_headers.turn') }}</th>
                                    <th>{{ trans('message.datatables_headers.payroll_type') }}</th>
                                    <th>{{ trans('message.datatables_headers.payroll_id') }}</th>
                                    <th>{{ trans('message.datatables_headers.payroll_name') }}</th>
                                    <th>{{ trans('message.datatables_headers.generalist') }}</th>
                                    <th>{{ trans('message.datatables_headers.association') }}</th>
                                    <th>{{ trans('message.datatables_headers.contract') }}</th>
                                    <th>{{ trans('message.datatables_headers.schedule') }}</th>
                                    <th>{{ trans('message.datatables_headers.working_day') }}</th>
                                    <th>{{ trans('message.datatables_headers.calculation') }}</th>
                                    <th>{{ trans('message.datatables_headers.vacations') }}</th>
                                    <th>{{ trans('message.datatables_headers.float') }}</th>
                                    <th>{{ trans('message.datatables_headers.base') }}</th>
                                    <th>{{ trans('message.datatables_headers.role') }}</th>
                                    <th>{{ trans('message.datatables_headers.extra1') }}</th>
                                    <th>{{ trans('message.datatables_headers.extra2') }}</th>
                                    <th>{{ trans('message.datatables_headers.extra3') }}</th>
                                    <th>{{ trans('message.datatables_headers.extra4') }}</th>
                                    <th>{{ trans('message.datatables_headers.extra5') }}</th>
                                    <th>{{ trans('message.datatables_headers.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                responsive: true,
                scrollX: true,
                ajax: {
					"url": "{{ route('employees.list') }}",
                    "type": "POST",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'idempleado', name: 'idempleado'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'rfc', name: 'rfc'},
                    {data: 'fuente', name: 'fuente'},
                    {data: 'curp', name: 'curp'},
                    {data: 'nss', name: 'nss'},
                    {data: 'correoempresa', name: 'correoempresa'},
                    {data: 'correopersonal', name: 'correopersonal'},
                    {data: 'nacimiento', name: 'nacimiento'},
                    {data: 'sexo', name: 'sexo'},
                    {data: 'civil', name: 'civil'},
                    {data: 'telefono', name: 'telefono'},
                    {data: 'extension', name: 'extension'},
                    {data: 'celular', name: 'celular'},
                    {data: 'ingreso', name: 'ingreso'},
                    {data: 'fechapuesto', name: 'fechapuesto'},
                    {data: 'jefe', name: 'jefe'},
                    {data: 'direccion', name: 'direccion'},
                    {data: 'departamento', name: 'departamento'},
                    {data: 'seccion', name: 'seccion'},
                    {data: 'puesto', name: 'puesto'},
                    {data: 'grado', name: 'grado'},
                    {data: 'region', name: 'region'},
                    {data: 'sucursal', name: 'sucursal'},
                    {data: 'idempresa', name: 'idempresa'},
                    {data: 'empresa', name: 'empresa'},
                    {data: 'division', name: 'division'},
                    {data: 'marca', name: 'marca'},
                    {data: 'centro', name: 'centro'},
                    {data: 'checador', name: 'checador'},
                    {data: 'turno', name: 'turno'},
                    {data: 'tiponomina', name: 'tiponomina'},
                    {data: 'clavenomina', name: 'clavenomina'},
                    {data: 'nombrenomina', name: 'nombrenomina'},
                    {data: 'generalista', name: 'generalista'},
                    {data: 'relacion', name: 'relacion'},
                    {data: 'contrato', name: 'contrato'},
                    {data: 'horario', name: 'horario'},
                    {data: 'jornada', name: 'jornada'},
                    {data: 'calculo', name: 'calculo'},
                    {data: 'vacaciones', name: 'vacaciones'},
                    {data: 'flotante', name: 'flotante'},
                    {data: 'base', name: 'base'},
                    {data: 'rol', name: 'rol'},
                    {data: 'extra1', name: 'extra1'},
                    {data: 'extra2', name: 'extra2'},
                    {data: 'extra3', name: 'extra3'},
                    {data: 'extra4', name: 'extra4'},
                    {data: 'extra5', name: 'extra5'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
                columnDefs: [
                    {
                        "width": "170px", "targets": [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49],
                    }
                ],
                fixedColumns:   {
                    leftColumns: 3,
                    rightColumns: 1
                }
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
                if( log ) alert(log);
            }

            });
        });

    </script>
  @endsection
