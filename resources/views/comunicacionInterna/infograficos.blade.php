@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.infographics') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.infographics') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.infographics') }}
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

                        <div class="col-md-4">

                            <img class="img-responsive pad col-md-12" src="{{ asset('img/comunicacionInterna/info1.jpg') }}" alt="Photo">
                            <h2 class="page-header text-center">Infográfico 1</h2>
                            <button type="button" class="btn btn-default btn-xs bg-blue"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <span class="pull-right text-muted">127 likes</span>

                        </div>

                        <div class="col-md-4">

                            <img class="img-responsive pad col-md-12" src="{{ asset('img/comunicacionInterna/info1.jpg') }}" alt="Photo">
                            <h2 class="page-header text-center">Infográfico 2</h2>
                            <button type="button" class="btn btn-default btn-xs bg-blue"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <span class="pull-right text-muted">127 likes</span>

                        </div>

                        <div class="col-md-4">

                            <img class="img-responsive pad col-md-12" src="{{ asset('img/comunicacionInterna/info1.jpg') }}" alt="Photo">
                            <h2 class="page-header text-center">Infográfico 3</h2>
                            <button type="button" class="btn btn-default btn-xs bg-blue"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <span class="pull-right text-muted">127 likes</span>

                        </div>

                    </div>
                </div>
            </div>

        </div>

	</div>
@endsection
