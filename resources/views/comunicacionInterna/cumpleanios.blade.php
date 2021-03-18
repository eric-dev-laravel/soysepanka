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

            <div class="col-md-12">
                <div class="box box-solid">

                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner">

                            <div class="item active">
                                <img src="{{ asset('img/comunicacionInterna/banner_cumpleaños.png') }}" alt="First slide">

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

            <div class="box box-danger">

                <div class="box-header with-border">
                    <h3 class="box-title">Cumpleañeros!</h3>

                    <div class="box-tools pull-right">
                        <span class="label label-danger">{{  count($data['employee']) }} Personas</span>
                    </div>
                </div>

                <div class="box-body no-padding">

                    <ul class="users-list clearfix">
                        @foreach ($data['employee'] as $employee)
                            <li>
                                @if(empty($employee->isUser))
                                    <img src="{{ asset('img/record/user.png') }}" style="width:128px;" alt="User Image">
                                @else
                                    @if(empty($employee->isUser->picture))
                                        <img src="{{ asset('img/record/user.png') }}" style="width:128px;" alt="User Image">
                                    @else
                                        <img src="{{ asset($employee->isUser->url_path) }}" style="width:128px;" alt="User Image">
                                    @endif
                                @endif
                                <a class="users-list-name" href="#">{{ $employee->nombre. ' ' . $employee->paterno. ' '. $employee->materno }}</a>
                                <span class="users-list-date">{{ $employee->nacimiento }}</span>
                                <span class="users-list-hobbies">Hobbies</span>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>

	</div>
@endsection


