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
<div class="container-fluid spark-screen">
    <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('message.ma.newemployees') }}</span>
                    <span class="info-box-number">{{ count($data['employees']['insertados']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('message.ma.updatedemployees') }}</span>
                    <span class="info-box-number">{{ count($data['employees']['actualizados']) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ trans('message.ma.deletedemployees') }}</span>
                    <span class="info-box-number">{{ count($data['employees']['eliminados']) }}</span>
                </div>
            </div>
        </div>

    </div>

	<div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-download"></i> {{ trans('message.employee_importation') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        
                        <div class="panel panel-success">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title" align="center">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color: black">
                                    <i class="fa fa-users"></i> {{ trans('message.ma.newemployees') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <table id="tableInsertar" class="table data-table table-row-border order-column">
                                        @if (count($data['employees']['insertados']) > 0)
                                            <thead>
                                                <tr>
                                                    <?php $i = 0; ?>
                                                    @foreach ($data['employees']['insertados'] as $employee)
                                                        <?php
                                                            if($i == 0) {
                                                        ?>
                                                        @foreach (array_keys($employee) as $header)
                                                            <th>{{ $header }}</th>  
                                                        @endforeach
                                                        <?php
                                                            $i++; 
                                                            }
                                                        ?>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['employees']['insertados'] as $employee)
                                                    <tr>
                                                        @foreach (array_keys($employee) as $header)
                                                            <td>{{ $employee[$header] }}</td>  
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @endif
                                    </table> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-warning">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title" align="center">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: black">
                                        <i class="fa fa-users"></i> {{ trans('message.ma.updatedemployees') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <table id="tableActualizar" class="table data-table table-row-border order-column">
                                        @if (count($data['employees']['actualizados']) > 0)
                                            <thead>
                                                <tr>
                                                    <?php $i = 0; ?>
                                                    @foreach ($data['employees']['actualizados'] as $employee)
                                                        <?php
                                                            if($i == 0) {
                                                        ?>
                                                        @foreach (array_keys($employee) as $header)
                                                            <th>{{ $header }}</th>  
                                                        @endforeach
                                                        <?php
                                                            $i++; 
                                                            }
                                                        ?>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['employees']['actualizados'] as $employee)
                                                    <tr>
                                                        @foreach (array_keys($employee) as $header)
                                                            <td>{{ $employee[$header] }}</td>  
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-danger">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title" align="center">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color: black">
                                        <i class="fa fa-users"></i> {{ trans('message.ma.deletedemployees') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <table id="tableEliminar" class="table data-table table-row-border order-column">
                                        @if (count($data['employees']['eliminados']) > 0)
                                            <thead>
                                                <tr>
                                                    <?php $i = 0; ?>
                                                    @foreach ($data['employees']['eliminados'] as $employee)
                                                        <?php
                                                            if($i == 0) {
                                                        ?>
                                                        @foreach (array_keys($employee->getAttributes()) as $header)
                                                            <th>{{ $header }}</th>  
                                                        @endforeach

                                                        <?php
                                                            $i++; 
                                                            }
                                                        ?>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['employees']['eliminados'] as $employee)
                                                    <tr>
                                                        @foreach (array_keys($employee->getAttributes()) as $header)
                                                            <td>{{ $employee[$header] }}</td>  
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @endif
                                    </table> 
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-bottom: 30px">
                        <div class="col-md-offset-9">
                            <a class="btn btn-success" href="{{ url('importManual') }}">{{ trans('message.buttons.start') }}</a>
                            <a class="btn btn-danger" href="{{ url('admin-employees') }}">{{ trans('message.buttons.cancel') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('main-script')
    <script type="text/javascript">
        $(function () {
            var table = $('#tableInsertar').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                scrollX: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });

            var table2 = $('#tableActualizar').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                autoWidth: true,
                scrollX: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });

            var table3 = $('#tableEliminar').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                autoWidth: true,
                scrollX: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });
        });
        
    </script>
  @endsection
