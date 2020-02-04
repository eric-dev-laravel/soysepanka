@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ex.record_title') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ex.record_title') }}
@endsection

@section('main-content')
    @if (! empty($data['employee_info']))
        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active"><a class="nav-link active" id="tab1" href="#tab_1" data-toggle="tab" role="tab" aria-selected="true" aria-expanded="true">{{ trans('message.ex.tab1') }}</a>                    </li>
                        <li class="nav-item"><a href="#tab_2" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab2') }}</a></li>
                        <li class="nav-item"><a href="#tab_3" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab3') }}</a></li>
                        <li class="nav-item"><a href="#tab_4" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab4') }}</a></li>
                        <li class="nav-item"><a href="#tab_5" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab5') }}</a></li>
                        <li class="nav-item"><a href="#tab_6" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab6') }}</a></li>
                        <li class="nav-item"><a href="#tab_7" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab7') }}</a></li>
                        <li class="nav-item"><a href="#tab_8" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab8') }}</a></li>
                        <li class="nav-item"><a href="#tab_9" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab9') }}</a></li>
                        <li class="nav-item"><a href="#tab_10" data-toggle="tab" aria-expanded="false">{{ trans('message.ex.tab10') }}</a></li>
                        {{--<li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                        Dropdown <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>--}}
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane active" id="tab_1" role="tabpanel" role="tabpanel" aria-labelledby="tab1">
                            @include('expediente.partials.tab1')
                        </div>

                        <div class="tab-pane fade" id="tab_2" role="tabpanel">
                            @include('expediente.partials.tab2')
                        </div>

                        <div class="tab-pane fade" id="tab_3" role="tabpanel">
                            @include('expediente.partials.tab3')
                        </div>

                        <div class="tab-pane fade" id="tab_4" role="tabpanel">
                            @include('expediente.partials.tab4')
                        </div>

                        <div class="tab-pane fade" id="tab_5" role="tabpanel">
                            @include('expediente.partials.tab5')
                        </div>

                        <div class="tab-pane fade" id="tab_6" role="tabpanel">
                            @include('expediente.partials.tab6')
                        </div>

                        <div class="tab-pane fade" id="tab_7" role="tabpanel">
                            @include('expediente.partials.tab7')
                        </div>

                        <div class="tab-pane fade" id="tab_8" role="tabpanel">
                            @include('expediente.partials.tab8')
                        </div>

                        <div class="tab-pane fade" id="tab_9" role="tabpanel">
                            @include('expediente.partials.tab9')
                        </div>

                        <div class="tab-pane fade" id="tab_10" role="tabpanel">
                            @include('expediente.partials.tab10')
                        </div>

                    </div>

                </div>
            </div>

        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">{{ trans('message.ex.alert') }}</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> {{ trans('message.ex.alert_title1') }} </h4>
                      {{ trans('message.ex.alert_msg1') }}
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
        </div>
    @endif

@endsection

@section('main-script')
    <script type="text/javascript">

    </script>
  @endsection
