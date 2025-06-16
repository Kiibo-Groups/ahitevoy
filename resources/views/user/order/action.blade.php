@include('user.order.dispatch')

@if($row->status == 0)
    <div class="btn-group" role="group">
        <button id="btnGroupDrop{{ $row->id }}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opciones </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop{{ $row->id }}" style="padding: 10px 10px">
            <a href="{{ Asset('orderStatus?id='.$row->id.'&status=1') }}" onclick="return confirm('Are you sure?')">Confirmar Orden</a><hr>
            <a href="{{ Asset('orderStatus?id='.$row->id.'&status=2') }}" onclick="return confirm('Are you sure?')">Cancelar Orden</a><hr>
        </div>
    </div>
@elseif($row->status == 1)

    @if(!$row->dboy)
    <div class="btn-group" role="group">
    <button id="btnGroupDrop{{ $row->id }}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opciones </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop{{ $row->id }}" style="padding: 10px 10px">
        <a href="javascript::void()" data-toggle="modal" data-target="#slideRightModalStaff{{ $row->id }}">Asignar Repartidor</a><hr>
        <a href="{{ Asset('order/print/'.$row->id) }}" target="_blank">Imprimir Recibo</a><hr>
        <a href="{{ Asset('orderStatus?id='.$row->id.'&status=2') }}" onclick="return confirm('Are you sure?')" style="color:red">Cancelar Orden</a>
    </div>
    </div>
    @endif

@elseif($row->status == 1.5)

<span style="font-size: 12px">Asignando Repartidor...</span><hr />
<div class="btn-group" role="group">
    <img src="https://i.pinimg.com/originals/2a/6b/65/2a6b651433f3c6ece42ba25439f76c0d.gif" alt="Buscando..." width="100%" style="border-radius:20px;">
</div>
<div>
</div>
@elseif($row->status == 2)

    <span style="font-size: 12px">Cancelado a las <br>{{ $row->status_time }}</span>

@elseif($row->status == 3)
    <span style="font-size: 12px">Repartidor en camino...</span>
    <hr>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop{{ $row->id }}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opciones </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop{{ $row->id }}" style="padding: 10px 10px">
            <a href="javascript::void()" data-toggle="modal" data-target="#slideRightModalStaff{{ $row->id }}">Reasignar Repartidor</a><hr>
            <a href="{{ Asset('order/print/'.$row->id) }}" target="_blank">Imprimir Recibo</a><hr>
            <a href="{{ Asset('orderStatus?id='.$row->id.'&status=2') }}" onclick="return confirm('Are you sure?')" style="color:red">Cancelar Orden</a>
        </div>
    </div>
    <br /><hr>
    @if($row->d_boy != 0)
    <div>
        <span style="font-size: 12px">Elegido por {{ $row->dboy }} at<br>{{ $row->status_time }}</span>
    </div>
    @endif

@elseif($row->status == 4)
    <div class="btn-group" role="group">
        <button id="btnGroupDrop{{ $row->id }}" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opciones </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop{{ $row->id }}" style="padding: 10px 10px">
            <a href="javascript::void()" data-toggle="modal" data-target="#slideRightModalStaff{{ $row->id }}">Reasignar Repartidor</a><hr>
            <a href="{{ Asset('order/print/'.$row->id) }}" target="_blank">Imprimir Recibo</a><hr>
            <a href="{{ Asset('orderStatus?id='.$row->id.'&status=2') }}" onclick="return confirm('Are you sure?')" style="color:red">Cancelar Orden</a>
        </div>
    </div>
    <hr>
    <div>
    <span style="font-size: 12px">Asignado a {{ $row->dboy }} a las:<br>{{ $row->status_time }}</span>
    </div>
@elseif($row->status == 5)
    <div>
        <span style="font-size: 12px">Entregado por {{ $row->dboy }} a las:<br>{{ $row->status_time }}</span>
    </div>
@endif
