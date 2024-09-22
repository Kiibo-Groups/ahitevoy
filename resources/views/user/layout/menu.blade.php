@php($page = Request::segment(1))
<style type="text/css">
.menu-item{
	border-bottom: 1px solid #222222 !important;
}
</style>
<div class="admin-sidebar-brand">
<!-- begin sidebar branding-->
<!-- <img class="admin-brand-logo" src="{{Asset('assets/img/icon.png') }}" width="40" alt="atmos Logo"> -->
<span class="admin-brand-content font-secondary">
	<a href="{{ Asset(env('user').'/home') }}" style="font-size:12px;">{{ Auth::user()->name }}</a>
</span>
<!-- end sidebar branding-->
<div class="ml-auto">
<!-- sidebar pin-->
<a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
<!-- sidebar close for mobile device-->
<a href="#" class="admin-close-sidebar"></a>
</div>
</div>
<div class="admin-sidebar-wrapper js-scrollbar">
<ul class="menu">
<li class="menu-item @if($page === 'home' || $page == 'setting') active @endif">
<a href="#" class="open-dropdown menu-link">
<span class="menu-label">
<span class="menu-name">Dashboard
<span class="menu-arrow"></span>
</span>

</span>
<span class="menu-icon">
<i class="icon-placeholder mdi mdi-shape-outline "></i>
</span>
</a>
<!--submenu-->
<ul class="sub-menu">

<li class="menu-item">
<a href="{{ Asset(env('user').'/home') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Inicio</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-home">

</i>
</span>
</a>
</li>

<li class="menu-item ">
<a href="{{ Asset(env('user').'/setting') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Configuración</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-message-settings-variant">

</i>
</span>
</a>
</li>
</ul>
</li>

<li class="menu-item @if($page === 'category' || $page == 'item' || $page == 'addon') active @endif">
<a href="#" class="open-dropdown menu-link">
<span class="menu-label">
<span class="menu-name">Elementos de catalogo
<span class="menu-arrow"></span>
</span>

</span>
<span class="menu-icon">
<i class="icon-placeholder mdi mdi-tag"></i>
</span>
</a>
<!--submenu-->

<ul class="sub-menu">

<li class="menu-item">
<a href="{{ Asset(env('user').'/category') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Categoría</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-tag">

</i>
</span>
</a>
</li>

<li class="menu-item ">
<a href="{{ Asset(env('user').'/item') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Productos</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-tag">

</i>
</span>
</a>
</li>
@if(Auth::user()->subtype == 0)
<li class="menu-item">
  <a href="{{ Asset(env('user').'/addon') }}" class=" menu-link">
    <span class="menu-label">
      <span class="menu-name">Complementos</span>
    </span>
    <span class="menu-icon">
      <i class="icon-placeholder  mdi mdi-folder-plus"></i>
    </span>
  </a>
</li>
@endif
</ul>
</li>



<li class="menu-item @if($page === 'order') active @endif">
<a href="#" class="open-dropdown menu-link">
<span class="menu-label">
<span class="menu-name">Gestionar pedidos

<?php
$cOrder = DB::table('orders')->where('store_id',Auth::user()->id)->where('status',0)->count();
$rOrder = DB::table('orders')->where('store_id',Auth::user()->id)->where('status',1)->count();
$rrOrder = DB::table('orders')->where('store_id',Auth::user()->id)->where('status',1.5)->count();
$rrsOrder = DB::table('orders')->where('store_id',Auth::user()->id)->where('status',4)->count();
if($cOrder > 0)
{
?>

<span class="icon-badge badge-success badge badge-pill">{{ $cOrder }}</span>

<?php } ?>

<span class="menu-arrow"></span>
</span>

</span>
<span class="menu-icon">
<i class="icon-placeholder mdi mdi-cart"></i>
</span>
</a>
<!--submenu-->
<ul class="sub-menu">

<li class="menu-item">
<a href="{{ Asset('order?status=0') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Nuevos pedidos

@if($cOrder > 0)

<span class="icon-badge badge-success badge badge-pill">{{ $cOrder }}</span>

@endif

</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-cart">

</i>
</span>
</a>
</li>


<li class="menu-item">
<a href="{{ Asset('order?status=1') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Ordenes en ejecución

@if($rOrder > 0)

<span class="icon-badge badge-success badge badge-pill">{{ $rOrder }}</span>

@endif

</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-camera-control">

</i>
</span>
</a>
</li>

<li class="menu-item">
<a href="{{ Asset('order?status=1.5') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">En espera de repartidor

@if($rrOrder > 0)

<span class="icon-badge badge-success badge badge-pill">{{ $rrOrder }}</span>

@endif

</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-camera-control">

</i>
</span>
</a>
</li>


<li class="menu-item">
<a href="{{ Asset('order?status=4') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Pedidos en Ruta

@if($rrsOrder > 0)

<span class="icon-badge badge-success badge badge-pill">{{ $rrsOrder }}</span>

@endif

</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-camera-control">

</i>
</span>
</a>
</li>


<li class="menu-item">
<a href="{{ Asset('order?status=2') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Órdenes canceladas</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-cancel">

</i>
</span>
</a>
</li>

<li class="menu-item">
<a href="{{ Asset('order?status=5') }}" class=" menu-link">
<span class="menu-label">
<span class="menu-name">Órdenes completadas</span>
</span>
<span class="menu-icon">
<i class="icon-placeholder  mdi mdi-check-all">

</i>
</span>
</a>
</li>
</ul>
</li>


@if(Auth::user()->d_repo == 0)
<li class="menu-item @if($page === 'report') active @endif">
<a href="{{ Asset('report') }}" class="menu-link">
<span class="menu-label"><span class="menu-name">Reportes</span></span>
<span class="menu-icon">
<i class="icon-placeholder mdi mdi-file"></i>
</span>
</a>
</li>

@else
<li class="menu-item @if($page === 'report') active @endif" hidden>
    <a href="{{ Asset('report') }}" class="menu-link">
    <span class="menu-label"><span class="menu-name">Reportes</span></span>
    <span class="menu-icon">
    <i class="icon-placeholder mdi mdi-file"></i>
    </span>
    </a>
    </li>
@endif


<li class="menu-item">
<a href="{{ Asset(env('user').'/logout') }}" class="menu-link">
<span class="menu-label"><span class="menu-name">Cerrar sesión</span></span>
<span class="menu-icon">
<i class="icon-placeholder mdi mdi-logout"></i>
</span>
</a>
</li>

</ul>
</div>
<script>
  OneSignal.push(function() {
    OneSignal.sendTags({store_id: '{{Auth::user()->id}}'});
  });
</script>