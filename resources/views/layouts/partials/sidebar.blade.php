<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset($user_img_path) }}" class="img-circle" alt="{{ Auth::user()->name }}" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>            
            <li><a href="{{ route('home') }}"><i class='fa fa-link'></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('user.index') }}"><i class='fa fa-user'></i> <span>Usuários</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
