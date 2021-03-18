@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.aboutus') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.aboutus') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.aboutus') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">

        <div class="row">

            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-users"></i>

                        <h3 class="box-title">Sobre de Nosotros</h3>
                    </div>

                    <div class="box-body">
                        <div class="col-md-6">
                            <img class="img-responsive pad col-md-12" src="{{ asset('img/comunicacionInterna/imagen_sobre_nosotros.png') }}" alt="Photo">

                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <span class="pull-right text-muted">127 likes - 3 comments</span>
                        </div>

                        <div class="col-md-6 clearfix">
                            <blockquote class="pull-left" style="text-align: justify;">
                                <p>
                                    Somos un equipo multidisciplinario de personas experimentadas materia de Tecnologías de la Información, Desarrollo Humano, Pedagogía y Artes Audiovisuales, quienes nos hemos dedicado al desarrollo, implantación y consultoría de software para apoyar la labor de los departamentos de Recursos Humanos en diversas empresas.
                                    Estamos ubicados en Guadalajara, Jalisco desde hace más de 10 años y formamos parte de la compañía HallMg Internet Solutions.
                                    Somos profesionales en quienes puedes confiar, comprometidos y capaces.
                                    Dispuestos a colaborar contigo.
                                </p>
                                <small>By <cite title="Source Title">Sepankasuite</cite></small>
                            </blockquote>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-bullseye"></i>

                        <h3 class="box-title">Misión y Visión</h3>
                    </div>

                    <div class="box-body">

                        <div class="col-md-6 clearfix">
                            <dl class="dl-horizontal">
                                <dt>Misión</dt>
                                <dd>Integrar soluciones de tecnología de la información en las organizaciones para mejorar sus prácticas de gestión y desarrollo del talento.</dd>

                                <dt>Visión</dt>
                                <dd>Ser líder en el desarrollo de soluciones informáticas altamente productivas para la gestión y desarrollo del talento con profundo valor humano.</dd>
                              </dl>
                        </div>

                        <div class="col-md-6">
                            <img class="img-responsive pad col-md-12" src="{{ asset('img/comunicacionInterna/imagen_mision_vision.png') }}" alt="Photo">

                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <span class="pull-right text-muted">127 likes - 3 comments</span>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-balance-scale"></i>

                        <h3 class="box-title">Código de Ética</h3>
                    </div>

                    <div class="box-body">
                        <div class="col-md-6">
                            <img class="img-responsive pad col-md-12" src="{{ asset('img/comunicacionInterna/imagen_codigo_etica.png') }}" alt="Photo">

                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <span class="pull-right text-muted">127 likes - 3 comments</span>
                        </div>

                        <div class="col-md-6 clearfix">
                            <blockquote class="pull-left" style="text-align: justify;">
                                <p>
                                    En Sepanka Suite estamos comprometidos con el respeto a la ley,
                                    la responsabilidad, honradez y ética en todas nuestras operaciones;
                                    Respetamos los derechos de todas las personas y el medio ambiente;
                                    Creemos que a través del trabajo y la mejora continua se logra
                                    la innovación de nuestros productos y la superación de nuestros
                                    grupos de interés.
                                </p>
                                <small>By <cite title="Source Title">Sepankasuite</cite></small>
                            </blockquote>
                        </div>

                    </div>

                </div>
            </div>

        </div>

	</div>
@endsection


