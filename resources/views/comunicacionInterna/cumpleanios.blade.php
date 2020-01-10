@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.birthday') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.birthday') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.birthday') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-xs-offset-2">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Próximos 30 días</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						{{ trans('message.ci.birthdayMessage') }}
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
        </div>


	</div>
@endsection


