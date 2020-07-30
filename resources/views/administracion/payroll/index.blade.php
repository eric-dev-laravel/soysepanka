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
    @if(session()->has('success'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i> {{ trans('message.modals.alert') }}</h4>
                {{ trans('message.modals.success_message') }}
            </div>
        </div>
    </div>
    @elseif(session()->has('warning'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-warning alert-dismissible" id="warning-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i> {{ trans('message.modals.alert') }}</h4>
                {{ trans('message.modals.warning_payroll') }}
            </div>
        </div>
    </div>
    @endif

    <div class="panel panel-default panel-custom">
        <div class="panel-heading panel-heading-custom">
            <span class="panel-custom-first-{{config('config.theme')}} generalists-icon"><h3 class="panel-title">Importar recibos de nómina</h3></span><span class="panel-custom-second-{{config('config.theme')}}"></span>
        </div>

        <div class="panel-body panel-body-custom">
            <form action="{{ url('payroll') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-1 col-md-offset-3">
                        <label class="btn primary" for="my-file-selector">
                            <input id="my-file-selector" name="file" id="file" type="file" style="display:none" onchange="$('#upload-file-info').html(this.files[0].name)">
                            <span class="btn btn-primary">
                                <span class="fa fa-folder-open" aria-hidden="true"></span> {{ trans('message.ex.search') }}
                            </span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <textarea class="form-control col-md-4" style="resize: none; margin: 7px 0 0 19px;" id="upload-file-info" cols="60" rows="1" readonly></textarea>
                    </div>
                </div>
                    <div class="col-md-4 col-md-offset-4" style="margin-top: 25px">
                        <button type="submit" class="btn btn-success">Procesar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
