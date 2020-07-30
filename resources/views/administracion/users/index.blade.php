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
	<div class="container-fluid spark-screen">

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_all_users') }}</span>
                        <span class="info-box-number">{{ $users_data['all_users'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_active_users') }}</span>
                        <span class="info-box-number">{{ $users_data['active_users'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_inactive_users') }}</span>
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
                                <div class="box box-primary box-solid">

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-upload"></i> {{ trans('message.export') }}</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('download-users/1') }}';" class="btn btn-block btn-primary"><i class="fa fa-users"></i> {{ trans('message.allusers') }}</button>
                                        </div>
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('download-users/2') }}';" class="btn btn-block btn-primary"><i class="fa fa-user"></i> {{ trans('message.onlyactiveusers') }}</button>
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
                                            <button type="button" onclick="window.location.href = '{{ url('admin-users/create') }}';" class="btn btn-block btn-info"><i class="fa fa-user-plus"></i> {{ trans('message.newuser') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <div class="form-group">
                                <div class="box box-primary box-solid">

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Nómina</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('payroll') }}';" class="btn btn-block btn-primary"><i class="fa fa-user-plus"></i> Importar Nómina</button>
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
			<div class="col-md-7">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-users"></i> {{ trans('message.ma.admin_list_users') }}</h3>

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
                                    <th>{{ trans('message.datatables_headers.name') }}</th>
                                    <th>{{ trans('message.datatables_headers.username') }}</th>
                                    <th>{{ trans('message.datatables_headers.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
					</div>
				</div>
			</div>

            <div class="col-md-5">
                <!-- Info Boxes Style 2 -->
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.only_users') }}</span>
                    <span class="info-box-number">{{ $users_data['only_users'] }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                            {{ trans('message.ma.only_users_msg') }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">{{ trans('message.ma.users_employees') }}</span>
                    <span class="info-box-number">{{ $users_data['users_employees'] }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        {{ trans('message.ma.users_employees_msg') }}
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.only_employees') }}</span>
                        <span class="info-box-number">{{ $users_data['only_employees'] }}</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            {{ trans('message.ma.only_employees_msg') }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>

    </div>
@endsection

@section('main-script')
    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true,
                ajax: "{{ route('users.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
                columnDefs: [
                    {
                        "width": "210px", "targets": [1, 2],
                    }
                ],
                fixedColumns:   {
                    leftColumns: 2,
                    rightColumns: 1
                }
            });
        });
    </script>
  @endsection
