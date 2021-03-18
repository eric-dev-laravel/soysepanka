@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

            <div class="col-md-12">
                <div class="box box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">Avisos</h3>
                    </div>

                    <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                        </ol>
                        <div class="carousel-inner">

                            <div class="item active">
                                <img src="{{ asset('img/comunicacionInterna/banner1.jpg') }}" alt="First slide">

                                <!--<div class="carousel-caption">
                                    First Slide
                                </div>-->
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/comunicacionInterna/banner2.jpg') }}" alt="Second slide">

                                <!--<div class="carousel-caption">
                                    Second Slide
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
            <div class="col-md-12">
                <div class="box box-solid">

                    <div class="box-body">

                        <div class="col-xs-12 col-md-4" style="padding-right: 0px; padding-left: 0px">
                            <a href="#">
                                <img class="col-md-12" style="padding-right: 0px; padding-left: 0px" src="{{ asset('img/comunicacionInterna/mosaico1.png') }}">
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-4" style="padding-right: 0px; padding-left: 0px">
                            <a href="#">
                                <img class="col-md-12" style="padding-right: 0px; padding-left: 0px" src="{{ asset('img/comunicacionInterna/mosaico2.png') }}">
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-4" style="padding-right: 0px; padding-left: 0px">
                            <a href="#">
                                <img class="col-md-12" style="padding-right: 0px; padding-left: 0px" src="{{ asset('img/comunicacionInterna/mosaico3.png') }}">
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-4" style="padding-right: 0px; padding-left: 0px">
                            <a href="#">
                                <img class="col-md-12" style="padding-right: 0px; padding-left: 0px" src="{{ asset('img/comunicacionInterna/mosaico4.png') }}">
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-4" style="padding-right: 0px; padding-left: 0px">
                            <a href="#">
                                <img class="col-md-12" style="padding-right: 0px; padding-left: 0px" src="{{ asset('img/comunicacionInterna/mosaico5.png') }}">
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-4" style="padding-right: 0px; padding-left: 0px">
                            <a href="#">
                                <img class="col-md-12" style="padding-right: 0px; padding-left: 0px" src="{{ asset('img/comunicacionInterna/mosaico6.png') }}">
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

	</div>
@endsection

