<a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
<nav class="d-none d-lg-block d-md-none">
    <ul class="nav align-items-center">
        <li class="nav-item" style="margin-left: 35px;padding-top:12px;"> 
            <h4 style="color:#fff;">Panel Administrador</h4>
        </li>
    </ul>
</nav>
<nav class=" ml-auto">
    <ul class="nav align-items-center">
        <li class="dropdown text-white">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <img src="{{ asset('public/upload/admin/' . Auth::guard('admin')->user()->logo) }}" alt="user-image" style="width: 35px;height: 35px;border-radius: 2003px;">
                <span class="pro-user-name ms-1">
                    {{Auth::guard('admin')->user()->name }} 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bienvenido(a) !</h6>
                </div>

                <!-- item-->
                <a href="{{ Asset(env('admin').'/home') }}" class="dropdown-item notify-item">
                    <i class="fe-layout"></i>
                    <span>Inicio</span>
                </a>
                <!-- item-->
                <a href="{{ Asset(env('admin').'/setting') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-cog"></i>
                    <span>Configuraciones</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Cerrar sesión</span>
                </a>
                <form id="logout-form" action="{{ Asset(env('admin').'/logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>