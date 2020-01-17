<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('message.home') }}</span></a></li>
            <!--<li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('message.anotherlink') }}</span></a></li>-->

            <!-- Modulo0 Administración-->
            <li class="treeview">
                <a href="#"><i class='fa fa-cog'></i> <span>{{ trans('message.module0') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin-users') }}"><i class='fa fa-user-plus'></i> {{ trans('message.ma.users') }}</a></li>
                    <li><a href="{{ url('admin-enterprises') }}"><i class='fa fa-university'></i> {{ trans('message.ma.company') }}</a></li>
                    <li><a href="{{ url('admin-directions') }}"><i class='fa fa-arrows'></i> {{ trans('message.ma.direction') }}</a></li>
                    <li><a href="{{ url('admin-areas') }}"><i class='fa fa-pie-chart'></i> {{ trans('message.ma.area') }}</a></li>
                    <li><a href="{{ url('admin-departments') }}"><i class='fa fa-briefcase'></i> {{ trans('message.ma.department') }}</a></li>
                    <li><a href="{{ url('admin-jobpositions') }}"><i class='fa fa-grav'></i> {{ trans('message.ma.jobposition') }}</a></li>
                    <li><a href="{{ url('admin-employees') }}"><i class='fa fa-user-plus'></i> {{ trans('message.ma.employees') }}</a></li>
                </ul>
            </li>

            <!-- Modulo1 Comunicacion Interna-->
            <li class="treeview">
                <a href="#"><i class='fa fa-comments'></i> <span>{{ trans('message.module1') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('cumpleaños') }}"><i class='fa fa-birthday-cake'></i> {{ trans('message.ci.birthday') }}</a></li>
                    <li><a href="#"><i class='fa fa-users'></i> {{ trans('message.ci.newrevenue') }}</a></li>
                    <li><a href="#"><i class='fa fa-street-view'></i> {{ trans('message.ci.movementofpersonnel') }}</a></li>
                    <li><a href="#"><i class='fa fa-info'></i> {{ trans('message.ci.aboutus') }}</a></li>
                    <li><a href="#"><i class='fa fa-sitemap'></i> {{ trans('message.ci.organizationchart') }}</a></li>
                    <li><a href="#"><i class='fa fa-book'></i> {{ trans('message.ci.regulations') }}</a></li>
                    <li><a href="#"><i class='fa fa-bookmark'></i> {{ trans('message.ci.infographics') }}</a></li>
                    <li><a href="#"><i class='fa fa-camera-retro'></i> {{ trans('message.ci.galleries') }}</a></li>
                    <li><a href="#"><i class='fa fa-calendar'></i> {{ trans('message.ci.upcomingevents') }}</a></li>
                    <li><a href="#"><i class='fa fa-question'></i> {{ trans('message.ci.faqs') }}</a></li>
                </ul>
            </li>

            <!-- Modulo2 Gestión de Vacantes-->
            <li class="treeview">
                <a href="#"><i class='fa fa-handshake-o'></i> <span>{{ trans('message.module2') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>

            <!-- Modulo3 Evaluación del Desempeño-->
            <li class="treeview">
                <a href="#"><i class='fa fa-battery-2'></i> <span>{{ trans('message.module3') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>

            <!-- Modulo4 Evaluación por Resultados-->
            <li class="treeview">
                <a href="#"><i class='fa fa-area-chart'></i> <span>{{ trans('message.module4') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>

            <!-- Modulo5 Clima Laboral-->
            <li class="treeview">
                <a href="#"><i class='fa fa-thermometer'></i> <span>{{ trans('message.module5') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>

            <!-- Modulo6 Control de Incidencias "vacaciones"-->
            <li class="treeview">
                <a href="#"><i class='fa fa-suitcase'></i> <span>{{ trans('message.module6') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>

            <!-- Modulo7 Reconocimientos al Personal-->
            <li class="treeview">
                <a href="#"><i class='fa fa-star'></i> <span>{{ trans('message.module7') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>

            <!-- Modulo8 Capacitación en Línea-->
            <li class="treeview">
                <a href="#"><i class='fa fa-graduation-cap'></i> <span>{{ trans('message.module8') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('message.linklevel2') }}</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
