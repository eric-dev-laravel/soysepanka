@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_enterprises_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_enterprises_title') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-bank"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_all_enterprises') }}</span>
                        <span class="info-box-number">{{ $enterprices_data['all_enterprises'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-bank"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_active_enterprises') }}</span>
                        <span class="info-box-number">{{ $enterprices_data['active_enterprises'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-bank"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_inactive_enterprises') }}</span>
                        <span class="info-box-number">{{ $enterprices_data['inactive_enterprises'] }}</span>
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
                                <div class="box box-info box-solid">

                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> {{ trans('message.manual') }}</h3>
                                    </div>

                                    <div class="box-body">
                                        <div class="row col-md-3 col-sm-12 col-md-offset-1">
                                            <button type="button" onclick="window.location.href = '{{ url('admin-enterprises/create') }}';" class="btn btn-block btn-info"><i class="fa fa-bank"></i> {{ trans('message.newenterprise') }}</button>
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
						<h3 class="box-title"><i class="fa fa-bank"></i> {{ trans('message.ma.admin_list_enterprises') }}</h3>

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
                                    <th>{{ trans('message.datatables_headers.enterprise_id') }}</th>
                                    <th>{{ trans('message.datatables_headers.name') }}</th>
                                    <th>{{ trans('message.datatables_headers.description') }}</th>
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
                    <span class="info-box-icon"><i class="fa fa-arrows"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.number_directions') }}</span>
                    <span class="info-box-number">{{ $enterprices_data['all_directions'] }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                            {{ trans('message.ma.number_directions_msg') }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-pie-chart"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">{{ trans('message.ma.number_areas') }}</span>
                    <span class="info-box-number">{{ $enterprices_data['all_areas'] }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        {{ trans('message.ma.number_areas_msg') }}
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.number_departments') }}</span>
                        <span class="info-box-number">{{ $enterprices_data['all_departments'] }}</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            {{ trans('message.ma.number_departments_msg') }}
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
                ajax: "{{ route('enterprises.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id_enterprise', name: 'id_enterprise'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
                columnDefs: [
                    {
                        "width": "180px", "targets": [2,3],
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
