@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ma.admin_areas_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ma.admin_areas_title') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-pie-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_all_areas') }}</span>
                        <span class="info-box-number">{{ $areas_data['all_areas'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-pie-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_active_areas') }}</span>
                        <span class="info-box-number">{{ $areas_data['active_areas'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-pie-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('message.ma.admin_inactive_areas') }}</span>
                        <span class="info-box-number">{{ $areas_data['inactive_areas'] }}</span>
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
                                            <button type="button" onclick="window.location.href = '{{ url('admin-areas/create') }}';" class="btn btn-block btn-info"><i class="fa fa-pie-chart"></i> {{ trans('message.newarea') }}</button>
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
			<div class="col-md-9">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-pie-chart"></i> {{ trans('message.ma.admin_list_directions') }}</h3>

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
                                    <th>{{ trans('message.datatables_headers.enterprise') }}</th>
                                    <th>{{ trans('message.datatables_headers.direction') }}</th>
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
                ajax: "{{ route('areas.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id_enterprise', name: 'id_enterprise'},
                    {data: 'id_direction', name: 'id_direction'},
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
