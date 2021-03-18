<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Inicio')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @yield('contentheader_level', 'Inicio')</a></li>
        <li class="active">@yield('contentheader_level_here', 'Aquí')</li>
    </ol>
</section>
