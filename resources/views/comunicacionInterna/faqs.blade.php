@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.faqs') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.faqs') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.faqs') }}
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
                        <div class="mx-0 my-4">
                            <ul class="list-group list-group-flush p-0">

                                <li class="list-group-item px-0">
                                    <h3 style="color: #002C49;"><strong>¿Lorem ipsum dolor sit amet, consectetur adipiscing elit?</strong></h3>
                                    <p class="title-blue"></p>
                                    <p style="text-align: justify; ">
                                        <font face="Open Sans, Arial, sans-serif">
                                            <span style="font-size: 14px;">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis elementum aliquam cursus. Suspendisse blandit dignissim tempor. Phasellus quis diam vitae nisi condimentum volutpat.
                                            </span>
                                        </font>
                                    </p>
                                </li>

                                <li class="list-group-item px-0">
                                    <h3 style="color: #002C49;"><strong>¿Lorem ipsum dolor sit amet, consectetur adipiscing elit?</strong></h3>
                                    <p class="title-blue"></p>
                                    <p style="text-align: justify; ">
                                        <font face="Open Sans, Arial, sans-serif">
                                            <span style="font-size: 14px;">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis elementum aliquam cursus. Suspendisse blandit dignissim tempor. Phasellus quis diam vitae nisi condimentum volutpat.
                                            </span>
                                        </font>
                                    </p>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

	</div>
@endsection


