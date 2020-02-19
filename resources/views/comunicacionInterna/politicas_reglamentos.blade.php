@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.regulations') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.regulations') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.regulations') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">

        <div class="row">

            <div class="col-md-12">
                <div class="box box-solid">

                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner">

                            <div class="item active">
                                <img src="{{ asset('img/comunicacionInterna/banner_politica_reglamento.png') }}" alt="First slide">

                                <!--<div class="carousel-caption">
                                    First Slide
                                </div>-->
                            </div>

                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                        </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">

            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-gavel"></i> Políticas</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>

                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @for ($flag = 0; $flag < 3; $flag++)
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset('img/comunicacionInterna/politicas.jpg') }}" style="width:150px; height:100px;" alt="Product Image">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">Recomendaciones de seguridad informática
                                        <span class="label label-success pull-right">Total de descargas: 259</span>
                                    </a>
                                    <span class="product-description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis elementum aliquam cursus. Suspendisse blandit dignissim tempor.
                                    </span>
                                    <div class="col-md-2 pull-right">
                                        <button type="button" class="btn btn-block btn-primary"><i class="fa fa-download"></i> Descargar</button>
                                    </div>

                                </div>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>

        </div>

        <div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-gavel"></i> Reglamentos</h3>

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
                                    <th>Portada</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($flag = 0; $flag < 3; $flag++)
                                    <tr>
                                        <td><img src="{{ asset('img/comunicacionInterna/politicas.jpg') }}" style="width:150px; height:100px;" alt="Product Image" /></td>
                                        <td>Recomendaciones de seguridad informática</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis elementum aliquam cursus. Suspendisse blandit dignissim tempor. Phasellus quis diam vitae nisi condimentum volutpat.</td>
                                        <td><button type="button" class="btn btn-block btn-primary"><i class="fa fa-download"></i> Descargar</button></td>
                                    </tr>
                                @endfor
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
                serverSide: false,
                responsive: true,
                scrollX: true,
                columnDefs: [
                    { "orderable": false, "targets": [0, 3] }
                ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                }
            });
        });
    </script>
@endsection


