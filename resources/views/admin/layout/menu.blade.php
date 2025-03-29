@inject('admin', 'App\Admin')
@php($page = Request::segment(2))


<div class="admin-sidebar-brand">
    <!-- begin sidebar branding-->
    <a href="{{ Asset(env('admin') . '/home') }}"
        style="width: 100%;display: flex;justify-content: space-evenly;align-items: center;">
        <img src="{{ asset('public/upload/admin/' . Auth::guard('admin')->user()->logo) }}" alt="logo"
            style="width: 50px;height: 50px;border-radius: 2003px;">

        {{ Auth::guard('admin')->user()->name }}
    </a>
    <!-- end sidebar branding-->
    <div class="ml-auto">
        <!-- sidebar pin-->
        <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle">

        </a>
        <!-- sidebar close for mobile device-->
        <a href="#" class="admin-close-sidebar"></a>
    </div>
</div>

<div class="admin-sidebar-wrapper js-scrollbar">
    <ul class="menu">
        <!-- Dashboard -->
        <li class="menu-item @if ($page === 'home' || $page == 'setting' || $page == 'text' || $page == 'page') active @endif">
            <a href="#" class="open-dropdown menu-link">
                <span class="menu-label">
                    <span class="menu-name">
                        Dashboard
                        <span class="menu-arrow"></span>
                    </span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-shape-outline "></i>
                </span>
            </a>
            <!--submenu-->
            <ul class="sub-menu">
                @if ($admin->hasPerm('Dashboard - Inicio'))
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/home') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Inicio</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-home"></i>
                            </span>
                        </a>
                    </li>
                @endif

                @if ($admin->hasPerm('Dashboard - Configuraciones'))
                    <li class="menu-item ">
                        <a href="{{ Asset(env('admin') . '/setting') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Configuraciones</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-message-settings-variant"></i>
                            </span>
                        </a>
                    </li>
                @endif

                @if ($admin->hasPerm('Dashboard - Textos de la aplicacion'))
                    <li class="menu-item ">
                        <a href="{{ Asset(env('admin') . '/text/add') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Texto de la aplicación</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-message-settings-variant"></i>
                            </span>
                        </a>
                    </li>
                @endif

                @if ($admin->hasPerm('Paginas de la aplicacion'))
                    <li class="menu-item @if ($page === 'page') active @endif">
                        <a href="{{ Asset(env('admin') . '/page/add') }}" class="menu-link">
                            <span class="menu-label"><span class="menu-name">Páginas de aplicaciones</span></span>
                            <span class="menu-icon">
                                <i class="mdi mdi-file"></i>
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <!-- Dashboard -->

        <!-- SubCuentas -->
        @if ($admin->hasPerm('Subaccount'))
            <li class="menu-item @if ($page === 'adminUser') active @endif">
                <a href="{{ Asset(env('admin') . '/adminUser') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Administrar SubCuentas</span>
                    </span>
                    <span class="menu-icon">
                        <i class="mdi mdi-map-marker"></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- SubCuentas -->

        @if ($admin->hasPerm('Dashboard - Categorias'))
            <li class="menu-item  @if ($page === 'category') active @endif">
                <a href="{{ Asset(env('admin') . '/category') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Categorias</span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder  mdi mdi-message-settings-variant"></i>
                    </span>
                </a>
            </li>
        @endif


        <!-- Banners -->
        @if ($admin->hasPerm('Banners'))
            <li class="menu-item @if ($page === 'banner') active @endif">
                <a href="{{ Asset(env('admin') . '/banner') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">
                            Banners
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-image-filter "></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- Banners -->

        <!-- Ciudades -->
        @if ($admin->hasPerm('Administrar Ciudades'))
            <li class="menu-item @if ($page === 'city') active @endif">
                <a href="{{ Asset(env('admin') . '/city') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Administrar ciudades</span>
                    </span>
                    <span class="menu-icon">
                        <i class="mdi mdi-map-marker"></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- Ciudades -->

        <!-- Negocios -->
        @if ($admin->hasPerm('Adminisrtar Restaurantes'))
            <li class="menu-item @if ($page === 'user') active @endif">
                <a href="{{ Asset(env('admin') . '/user') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Administrar negocios</span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-home"></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- Negocios -->

        <!-- Ofertas de descuento -->
        @if ($admin->hasPerm('Ofertas de descuento'))
            <li class="menu-item @if ($page === 'offer') active @endif">
                <a href="{{ Asset(env('admin') . '/offer') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Ofertas de descuento</span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-calendar"></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- Ofertas de descuento -->

        <!-- Repartidores -->
        @if ($admin->hasPerm('Repartidores'))
            <li class="menu-item @if ($page === 'delivery' || $page == 'report_staff') active @endif">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Repartidores
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="mdi mdi-account-clock"></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/delivery') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Listado</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-image-filter">
                                </i>
                            </span>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="{{ Asset(env('admin') . '/report_staff') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Reportes</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-image">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- Repartidores -->

        <!-- Gestion de pedidos -->
        <?php
        $cOrder = DB::table('orders')->where('status', 0)->count();
        $ROrder = DB::table('orders')
            ->whereIn('status', [1, 1.5, 3, 4])
            ->count();
        ?>
        @if ($admin->hasPerm('Gestion de pedidos'))
            <li class="menu-item @if ($page === 'order') active @endif">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">
                            Gestionar pedidos
                            @if ($cOrder > 0)
                                <span class="icon-badge badge-success badge badge-pill">{{ $cOrder }}</span>
                            @endif
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-cart"></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">

                    <!-- Pedidos nuevos -->
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/order?status=0') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Pedidos Nuevos
                                    @if ($cOrder > 0)
                                        <span
                                            class="icon-badge badge-success badge badge-pill">{{ $cOrder }}</span>
                                    @endif
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-cart"></i>
                            </span>
                        </a>
                    </li>
                    <!-- Pedidos nuevos -->

                    <!-- Pedidos en curso -->
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/order?status=1') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Pedidos en Curso
                                    @if ($ROrder > 0)
                                        <span
                                            class="icon-badge badge-success badge badge-pill">{{ $ROrder }}</span>
                                    @endif
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-camera-control"></i>
                            </span>
                        </a>
                    </li>
                    <!-- Pedidos en curso -->

                    <!-- Pedidos cancelados -->
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/order?status=2') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Pedidos Cancelados
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-cancel"></i>
                            </span>
                        </a>
                    </li>
                    <!-- Pedidos cancelados -->

                    <!-- Pedidos completos -->
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/order?status=5') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Pedidos Completos
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-check-all"></i>
                            </span>
                        </a>
                    </li>
                    <!-- Pedidos completos -->
                </ul>
            </li>
        @endif
        <!-- Gestion de pedidos -->

        <!-- Notificaciones push -->
        @if ($admin->hasPerm('Notificaciones push'))
            <li class="menu-item @if ($page === 'push') active @endif">
                <a href="{{ Asset(env('admin') . '/push') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">
                            Notificaciones
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-send "></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- Notificaciones push -->

        <!-- Reporte de ventas -->
        @if ($admin->hasPerm('Reportes de ventas'))
            <li class="menu-item @if ($page === 'report') active @endif">
                <a href="{{ Asset(env('admin') . '/report') }}" class="menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Reporte de ventas</span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-file"></i>
                    </span>
                </a>
            </li>
        @endif
        <!-- Reporte de ventas -->

        <!-- Usuarios -->
        @if ($admin->hasPerm('Usuarios Registrados'))
            <li class="menu-item @if ($page === 'appUser' || $page == 'report_users') active @endif">
                <a href="#" class="open-dropdown menu-link">
                    <span class="menu-label">
                        <span class="menu-name">Usuarios Registrados
                            <span class="menu-arrow"></span>
                        </span>
                    </span>
                    <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-account"></i>
                    </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item">
                        <a href="{{ Asset(env('admin') . '/appUser') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Listado</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-image-filter">
                                </i>
                            </span>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="{{ Asset(env('admin') . '/report_users') }}" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Reportes</span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder  mdi mdi-image">
                                </i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- Usuarios -->

        <!-- Cerrar Sesión -->
        <li class="menu-item">
            <a href="{{ Asset(env('admin') . '/logout') }}" class="menu-link">
                <span class="menu-label">
                    <span class="menu-name">Cerrar Sesion</span>
                </span>
                <span class="menu-icon">
                    <i class="icon-placeholder mdi mdi-logout"></i>
                </span>
            </a>
        </li>
        <!-- Cerrar Sesión -->
    </ul>
</div>
