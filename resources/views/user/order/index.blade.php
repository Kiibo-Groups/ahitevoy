@extends('user.layout.main')

@section('title') {{ $title }} @endsection

@section('icon') mdi-cart @endsection

@section('content')

<section class="pull-up">
<div class="container">
<div class="row ">
<div class="col-md-12">
<div class="card py-3 m-b-30">



<div class="card-body">
    <table class="table table-hover ">
    <thead>
    <tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Dirección</th>
    <th>Elementos</th>
    <th style="text-align: right">Opciones</th>
    </tr>

    </thead>
    <tbody>

    @foreach($data as $row)
    @include('user.order.info_pay')
    <tr>
    <td width="6%">#{{ $row->id }}</td>
    <td width="12%">{{ $row->name }}<br>{{ $row->phone }}</td>

    @if($row->type == 1)
    <td width="15%">{{ $row->address }},{{ $row->city }}</td>
    @endif
    @if($row->type == 2 || $row->type == 7)
    <td width="15%">El usuario pasara a recoger el pedido</td>
    @endif
    <td width="40%">
        
    <div class="row">
    <div class="col-md-6"><b>Elemento</b></div>
    <div class="col-md-3"><b>Cantidad</b></div>
    <div class="col-md-3"><b>Precio</b></div>
    </div><hr>

    @foreach($item->getItem($row->id) as $i)

    <div class="row" style="font-size: 12px">
    <div class="col-md-6">{{$i['item'] }}</div>
    <div class="col-md-3">x{{ $i['qty'] }}</div>
    <div class="col-md-3">{{ $currency.$i['price'] }}</div>
    
    </div><hr>

    @if(count($item->getAddon($i['cart_no'],$row->id)) > 0)

    @foreach($item->getAddon($i['cart_no'],$row->id) as $add)
    <div class="row" style="font-size: 12px">
        <div class="col-md-6">{{ $add->addon }}</div>
        <div class="col-md-3">x{{ $add->qty }}</div>
        <div class="col-md-3">{{ $currency.$add->price }}</div>
    </div><hr>
    @endforeach

    @endif

    @endforeach

        <div class="row">
            <div class="col-md-12">Total a recibir <br />
            @if($row->payment_method == 1) <!-- La venta fue en efectivo -->
                <h3 style="color:green;">{{ $currency.$item->GetTaxes($row->id)['payment_to_receive'] }}</h3>
            @else
                <h3 style="color:green;">{{ $currency.$item->GetTaxes($row->id)['gananciasxt'] }}</h3>
            @endif

            <button href="javascript::void()" data-toggle="modal" data-target="#slideRightModalInfoPay{{ $row->id }}" class="btn btn-secondary">
                Desglose de información
            </button>
            </div>
        </div>
    @if($row->notes)
    <small style="color:blue">Notas : {{ $row->notes }}</small>
    @endif
    </td>


    <td width="20%" style="text-align: right">

    @include('user.order.action')

    </td>
    </tr>

    @endforeach

    </tbody>
    </table>

</div>
</div>

{!! $data->links() !!}

</div>
</div>
</div>
</section>

@endsection