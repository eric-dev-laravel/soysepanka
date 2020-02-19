@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.galleries') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.galleries') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.galleries') }}
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
                                <img src="{{ asset('img/comunicacionInterna/galeria_galeria_sepanka.png') }}" alt="First slide">

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

            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-body">

                        <div class="col-md-6">

                            <div class="box-header with-border">
                                <h3 class="box-title">Cena de Navidad 2019</h3>
                            </div>

                            <div id="carousel-example2-generic" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example2-generic" data-slide-to="0" class=""></li>
                                    <li data-target="#carousel-example2-generic" data-slide-to="1" class="active"></li>
                                    <li data-target="#carousel-example2-generic" data-slide-to="2" class=""></li>
                                </ol>

                                <div class="carousel-inner">

                                    <div class="item">
                                        <img src="{{ asset('img/comunicacionInterna/galeria1.jpg') }}" style="width:100%; height: 270px;" alt="First slide">
                                        <div class="carousel-caption">
                                            First Slide
                                        </div>
                                    </div>

                                    <div class="item active">
                                        <img src="{{ asset('img/comunicacionInterna/galeria2.jpg') }}" style="width:100%; height: 270px;" alt="Second slide">
                                        <div class="carousel-caption">
                                            Second Slide
                                        </div>
                                    </div>

                                    <div class="item">
                                        <img src="{{ asset('img/comunicacionInterna/galeria3.jpg') }}" style="width:100%; height: 270px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            Third Slide
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example2-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example2-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="box-header with-border">
                                <h3 class="box-title">Día de las Madres</h3>
                            </div>

                            <div id="carousel-example3-generic" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example3-generic" data-slide-to="0" class=""></li>
                                    <li data-target="#carousel-example3-generic" data-slide-to="1" class="active"></li>
                                </ol>

                                <div class="carousel-inner">

                                    <div class="item">
                                        <img src="{{ asset('img/comunicacionInterna/galeria4.jpg') }}" style="width:100%; height: 270px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            First Slide
                                        </div>
                                    </div>

                                    <div class="item active">
                                        <img src="{{ asset('img/comunicacionInterna/galeria5.jpg') }}" style="width:100%; height: 270px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            Second Slide
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example3-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example3-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="box-header with-border">
                                <h3 class="box-title">Carrera 2020</h3>
                            </div>

                            <div id="carousel-example4-generic" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example4-generic" data-slide-to="0" class=""></li>
                                    <li data-target="#carousel-example4-generic" data-slide-to="1" class="active"></li>
                                </ol>

                                <div class="carousel-inner">

                                    <div class="item">
                                        <img src="{{ asset('img/comunicacionInterna/galeria6.jpeg') }}" style="width:100%; height: 170px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            First Slide
                                        </div>
                                    </div>

                                    <div class="item active">
                                        <img src="{{ asset('img/comunicacionInterna/galeria7.jpg') }}" style="width:100%; height: 170px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            Second Slide
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example4-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example4-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="box-header with-border">
                                <h3 class="box-title">Cumpleaños del Mes</h3>
                            </div>

                            <div id="carousel-example5-generic" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example5-generic" data-slide-to="0" class=""></li>
                                    <li data-target="#carousel-example5-generic" data-slide-to="1" class="active"></li>
                                </ol>

                                <div class="carousel-inner">

                                    <div class="item">
                                        <img src="{{ asset('img/comunicacionInterna/galeria8.jpg') }}" style="width:100%; height: 170px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            First Slide
                                        </div>
                                    </div>

                                    <div class="item active">
                                        <img src="{{ asset('img/comunicacionInterna/galeria9.jpg') }}" style="width:100%; height: 170px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            Second Slide
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example5-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example5-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="box-header with-border">
                                <h3 class="box-title">Reforestación 2020</h3>
                            </div>

                            <div id="carousel-example6-generic" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example6-generic" data-slide-to="0" class=""></li>
                                    <li data-target="#carousel-example6-generic" data-slide-to="1" class="active"></li>
                                </ol>

                                <div class="carousel-inner">

                                    <div class="item">
                                        <img src="{{ asset('img/comunicacionInterna/galeria10.jpg') }}" style="width:100%; height: 170px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            First Slide
                                        </div>
                                    </div>

                                    <div class="item active">
                                        <img src="{{ asset('img/comunicacionInterna/galeria11.jpg') }}" style="width:100%; height: 170px;" alt="Third slide">
                                        <div class="carousel-caption">
                                            Second Slide
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example6-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example6-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

	</div>
@endsection


