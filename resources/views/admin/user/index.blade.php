@extends('admin.layout.main')

@section('icon') mdi-home @endsection


@section('content')

<section class="pull-up">
<div class="container">
<div class="row ">
<div class="col-md-12">
<div class="card py-3 m-b-30">

<div class="row">
<div class="col-md-12" style="text-align: right;"><a href="{{ Asset($link.'add') }}" class="btn m-b-15 ml-2 mr-2 btn-rounded btn-warning">Add New</a>&nbsp;&nbsp;&nbsp;</div>

</div>


<div class="card-body">
<table class="table table-hover ">
<thead>
<tr>
<!-- <th>Imagen</th> -->
<th>Nombre</th>
<th>Ciudad</th>
<th>Status</th>
<th>Trending</th>
<th>Comentarios</th>
<th>Saldos</th>
<th style="text-align: right">Opciones</th>
</tr>

</thead>
<tbody>

@foreach($data as $row)

<tr>
<!-- <td width="5%"><img src="{{ Asset('upload/user/'.$row->img) }}" height="30px"></td> -->
<td width="20%">{{ $row->name }}<br>
    <small>
        {{ $row->Cat }}
    </small>
</td>
<td width="20%">{{ $row->city }}</td>
<td width="10%">
    @if($row->status == 0)
    <button type="button" class="btn btn-sm m-b-15 ml-2 mr-2 btn-info" onclick="confirmAlert('{{ Asset($link.'status/'.$row->id) }}')">Active</button>
    @else
    <button type="button" class="btn btn-sm m-b-15 ml-2 mr-2 btn-danger" onclick="confirmAlert('{{ Asset($link.'status/'.$row->id) }}')">Disabled</button>
    @endif
</td>
<td width="10%">
    @if($row->trending == 0)
    <button type="button" class="btn btn-sm m-b-15 ml-2 mr-2 btn-info" onclick="confirmAlert('{{ Asset($link.'status/'.$row->id.'?type=trend') }}')">Activar</button>
    @else
    <button type="button" class="btn btn-sm m-b-15 ml-2 mr-2 btn-success" onclick="confirmAlert('{{ Asset($link.'status/'.$row->id.'?type=trend') }}')">Desactivar</button>
    @endif
</td>
<td width="5%">
    <a href="{{ Asset($link.$row->id.'/rate') }}" class="btn m-b-15 ml-2 mr-2 btn-rounded-circle btn-md btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Vista de comentarios"><i class="mdi mdi-chart-line"></i></a>
</td>
<td width="15%">
    @if($row->saldo == 0)
        <!-- Saldo a favor -->
        <h5 style="color:blue;">{{$currency}}{{ number_format($row->saldo,2) }}</h5>
    @elseif($row->saldo > 0)
        <!-- Saldo a favor -->
        <h5 style="color:red;" data-toggle="tooltip" data-placement="top" data-original-title="Tiene un saldo a favor de:">{{$currency}}{{ number_format($row->saldo,2) }} <i class="mdi mdi-trending-down"></i></h5>
    @else 
        <!-- Saldo que debe -->
        <?php
            $sal = str_replace('-','',$row->saldo);
        ?>
        <h5 style="color:green;" data-toggle="tooltip" data-placement="top" data-original-title="Tiene un saldo deudor de:">{{$currency}}{{ number_format($sal,2) }} <i class="mdi mdi-trending-up"></i> </h5>
    @endif
</td>
<td width="20%" style="text-align: right">
    
    <button class="btn btn-primary dropdown-toggle" 
            type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Opciones
    </button>
    
    <ul class="dropdown-menu" style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(0px, 38px);" data-popper-placement="bottom-start">
        <!-- Close/Open -->
        <li>
            <a href="javascript::void()" class="dropdown-item " onclick="confirmAlert('{{ Asset($link.'status/'.$row->id.'?type=open') }}')">
                Abrir/Cerrar
            </a>
        </li>
        <!-- LoginUser -->
        <li>
            <a href="{{ Asset(env('admin').'/loginWithID/'.$row->id) }}" class="dropdown-item" target="_blank">
                Ingresar como
            </a>
        </li>
        <!-- Reset Saldos -->
        <li>
            <a href="{{ Asset($link.'pay/'.$row->id) }}" class="dropdown-item">
                Agregar Pago
            </a>
        </li>
        <!-- ViewInfo -->
        <li>
            <a href="javascript::void()" class="dropdown-item" onclick="showMsg('Username : {{ $row->email }}<br>Password : {{ $row->shw_password }}')">
                Ver Accesos
            </a>
        </li>
        <!-- Edit -->
        <li>
            <a href="{{ Asset($link.$row->id.'/edit') }}" class="dropdown-item">
                Editar
            </a>
        </li>
        <!-- Delete -->
        <li>
            <a href="javascript::void()" class="dropdown-item" onclick="deleteConfirm('{{ Asset($link."delete/".$row->id) }}')">
                Eliminar
            </a>
        </li>
    </ul>
</td>
</tr>

@endforeach

</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</section>

@endsection