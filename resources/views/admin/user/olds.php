@else 

    @if($data->p_staff == 1)
        <div class="form-group col-md-6">
            <label for="inputEmail6">Valor mínimo del carrito</label>
            {!! Form::text('min_cart_value',null,['placeholder' => 'Después de esta cantidad, la entrega será gratuita','class' => 'form-control'])!!}
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Tipo de Cobro</label>
            @if($type_ship == 1)
                <input type="text" value="Valor Fijo" class="form-control" disabled>
            @else
                <input type="text" value="Por Kilomtetros" class="form-control" disabled>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Cobro de envio Repartidores Externos</label>
            {!! Form::number('delivery_charges_value',$costs_ship,['class' => 'form-control','disabled' => 'disabled'])!!}
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Alcance del servicio en KM <br /> 
            <small style="font-size:12px;">(a cuantos kilometros de distancia realizas entregas a domiclio)</small></label>
            {!! Form::number('distance_max',null,['class' => 'form-control'])!!}
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Alcance Minimo del servicio en KM <br /> 
            <small style="font-size:12px;">(Si la distancia es menor a esto, se cobrara una tarifa fija)</small></label>
            {!! Form::number('delivery_min_distance',$min_costs_ship,['class' => 'form-control', 'disabled' => 'disabled'])!!}
        </div>
        <div class="form-group col-md-12">
            <label for="inputEmail6">Cobro Minimo del servicio de envio <br /> 
            <small style="font-size:12px;">(Si la distancia es menor al <b>Alcance minimo del serivicio</b> se realiza el cobro de esta tarifa fija)</small></label>
            {!! Form::number('delivery_min_charges_value',$min_charges_value,['class' => 'form-control', 'disabled' => 'disabled'])!!}
        </div>

    @else
    <div class="form-group col-md-6">
            <label for="inputEmail6">Valor mínimo del carrito</label>
            {!! Form::text('min_cart_value',null,['placeholder' => 'Después de esta cantidad, la entrega será gratuita','class' => 'form-control'])!!}
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Tipo de cobro</label>
            <select name="type_charges_value" class="form-control">
                <option value="0" @if($data->type_charges_value == 0) selected @endif>Por Kilometros</option>
                <option value="1" @if($data->type_charges_value == 1) selected @endif>Valor Fijo</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Gastos de envio</label>
            {!! Form::number('delivery_charges_value',null,['class' => 'form-control'])!!}
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Alcance del servicio en KM <br /> <small style="font-size:12px;">(a cuantos kilometros de distancia realizas entregas a domiclio)</small></label>
            {!! Form::number('distance_max',null,['class' => 'form-control'])!!}
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail6">Alcance Minimo del servicio en KM <br /> 
            <small style="font-size:12px;">(Si la distancia es menor a esto, se cobrara una tarifa fija)</small></label>
            {!! Form::number('delivery_min_distance',null,['class' => 'form-control'])!!}
        </div>
        <div class="form-group col-md-12">
            <label for="inputEmail6">Cobro Minimo del servicio de envio <br /> 
            <small style="font-size:12px;">(Si la distancia es menor al <b>Alcance minimo del serivicio</b> se realiza el cobro de esta tarifa fija)</small></label>
            {!! Form::number('delivery_min_charges_value',null,['class' => 'form-control'])!!}
        </div>
    @endif