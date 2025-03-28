<div class="tab-content" id="myTabContent1">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<div class="card py-3 m-b-30">
    @if($data->logo)
        <img src="{{ asset('public/upload/user/logo/'.$data->logo) }}" 
        style="position:absolute;
        max-height:150px;
        top:-105px;
        right:0px;
        border-radius:15px;
        z-index:1;">
    @endif

    @if($data->img)
        <img src="{{ asset('public/upload/user/'.$data->img) }}" width="100px" style="position:absolute;top:-30px;right:15px;border-radius:15px;z-index:5;">
    @endif

<div class="card-body" style="padding-top:80px;">

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail6">Nombre</label>
        {!! Form::text('name',null,['required' => 'required','placeholder' => 'Name','class' => 'form-control'])!!}
    </div>
    <div class="form-group col-md-6">
        <label for="inputEmail4">Email (<i>This will be username</i>)</label>
        {!! Form::email('email',null,['required' => 'required','placeholder' => 'Email Address','class' => 'form-control'])!!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail6">Telefono</label>
        {!! Form::text('phone',null,['required' => 'required','placeholder' => 'Contact Number','class' => 'form-control'])!!}
    </div>

    <div class="form-group col-md-6">
        <label for="inputEmail4">Tipo de comercio</label>
        <select name="store_type" class="form-control" required="required">
            @foreach($types as $type)
                <option value="{{ $type->id }}" @if($data->type == $type->id) selected @endif>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    @if(isset($admin))
    <div class="form-group col-md-6">
            <label for="inputEmail4">SubTipo de negocio</label>
            <select name="store_subtype" class="form-control">
                <option value="0" @if($data->subtype == 0) selected @endif>Restaurantes</option>
                <option value="1" @if($data->subtype == 1) selected @endif>Otro</option>
            </select>
    </div>
    @else
    <input type="hidden" name="store_subtype" value="{{$data->subtype}}">
    @endif

    <div class="form-group col-md-6">
        <label for="inputEmail4">Ciudad</label>
        <select name="city_id" class="form-control" required="required">
            <option value="">Selecciona tu ciudad</option>
            @foreach($citys as $city)
            <option value="{{ $city->id }}" @if($data->city_id == $city->id) selected @endif>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>

</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="img">Imagen de perfil (recomenada 600px * 400px)</label>
        <input type="file" name="img" id="img" class="form-control" @if(!$data->id) required="required" @endif>
    </div>

    <div class="form-group col-md-6">
        <label for="logo">Imagen de portada (recomenada 720px * 315px)</label>
        <input type="file" name="logo" id="logo" class="form-control" @if(!$data->id) required="required" @endif>
    </div>

    @if($Update)
    <div class="form-group col-md-6">
        <label for="inputEmail6">Cambia la contraseña (<small>Ingrese una nueva contraseña si desea cambiar la actual.</small>)</label>
        <input type="Password" value="{{$data->shw_password}}" name="password" class="form-control">
    </div>
    @else
    <div class="form-group col-md-6">
        <label for="inputEmail6">Contraseña</label>
        <input type="Password" name="password" class="form-control" @if(!$data->id) required="required" @endif>
    </div>
    @endif

    <div class="form-group col-md-6">
        <label for="inputEmail4">Status</label>
        <select name="status" class="form-control">
            <option value="0" @if($data->status == 0) selected @endif>Active</option>
            <option value="1" @if($data->status == 1) selected @endif>Disbaled</option>
        </select>
    </div>
</div>
</div>
</div>


@if(isset($admin))
    <input type="hidden" name="admin" value="1">

    <h1 style="font-size: 20px">Establecer cargos de comisión por servicio<br />
    <small style="font-size:12px;">(dejar en 0 si no requiere cobrar comisión)</small></h1>
    <div class="card py-3 m-b-30">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail6">Tipo  de Comision</label>
                    <select name="c_type" class="form-control">
                    <option value="0" @if($data->c_type == 0) selected @endif>Valor fijo</option>
                    <option value="1" @if($data->c_type == 1) selected @endif>Order %</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail6">Valor de la comisión</label>
                    {!! Form::text('c_value',null,['class' => 'form-control'])!!}
                </div>
            </div>
        </div>
    </div>
    
    <h1 style="font-size: 20px">Establecer cargos de comisión por Ticket<br />
    <small style="font-size:12px;">(dejar en 0 si no requiere cobrar comisión)</small></h1>
    <div class="card py-3 m-b-30">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail6">Tipo de Comision</label>
                    <select name="t_type" class="form-control">
                    <option value="0" @if($data->t_type == 0) selected @endif>Valor fijo</option>
                    <option value="1" @if($data->t_type == 1) selected @endif>Order %</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail6">Valor de la comisión</label>
                    {!! Form::text('t_value',null,['class' => 'form-control'])!!}
                </div>
            </div>
        </div>
    </div>
@else 
<input type="text" name="c_type" value="{{$data->c_type}}" hidden>
<input type="text" name="c_value" value="{{$data->c_value}}" hidden>
<input type="text" name="t_type" value="{{$data->t_type}}" hidden>
<input type="text" name="t_value" value="{{$data->t_value}}" hidden>
@endif

<h1 style="font-size: 20px">Gastos y Tiempos de entrega</h1>
<div class="card py-3 m-b-30">
<div class="card-body">

    <div class="form-row">
        @if(isset($admin))     
            
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

            <div class="form-group col-md-12">
                <label for="inputEmail6">Cobro de envio Repartidores Externos ( <small>Cambiar en Dashboard/Configuraciones</small> )</label>
                {!! Form::number('delivery_charges_value',$costs_ship,['class' => 'form-control','disabled' => 'disabled'])!!}
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
        @else
            <input type="text" name="service_del" value="{{$data->service_del}}" hidden>
            <input type="text" name="pickup" value="{{$data->pickup}}" hidden>
            <input type="text" name="min_cart_value" value="{{$data->min_cart_value}}" hidden>
            <input type="text" name="type_charges_value" value="{{$data->type_charges_value}}" hidden>
            <input type="text" name="delivery_charges_value" value="{{$data->delivery_charges_value}}" hidden>
            <input type="text" name="distance_max" value="{{$data->distance_max}}" hidden>
            <input type="text" name="delivery_min_distance" value="{{$data->delivery_min_distance}}" hidden>
            <input type="text" name="delivery_min_charges_value" value="{{$data->delivery_min_charges_value}}" hidden>
        @endif
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail6">Tiempo de entrega estimado <small>(solo en minutos)</small></label>
            {!! Form::text('delivery_time',null,['placeholder' => 'e.g 20-25','class' => 'form-control'])!!}
        </div>

        <div class="form-group col-md-6">
            <label for="inputEmail6">Costo aproximado por persona <small>(no incluya ningún signo de moneda)</small></label>
            {!! Form::text('person_cost',null,['placeholder' => 'e.g 200-250','class' => 'form-control'])!!}
        </div>

        <div class="form-group col-12">
            <input type="text" name="Cuenta_clave" value="0" hidden>
            <input type="text" name="banco_name" value="0" hidden>
        </div>

    </div>
</div>
</div>


<!--*********** Horario de Atencion *****************-->
<h1 style="font-size: 20px">
    Horarios de atención
    <br /><small style="font-size:14px;">(Si algun día de la semana marcas como cerrado, deja en blanco el horario de atención)</small>
</h1>
<div class="card py-3 m-b-30">
    <div class="card-body">
    @if($times->count() > 0)
        @foreach($times as $tm)
            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Lunes</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_mon" class="form-control">
                            @if($tm->Mon == 'closed')
                                <option value="0">Cerrado</option>
                                <option value="1">Abierto</option>
                            @else
                                <option value="1">Abierto</option>
                                <option value="0">Cerrado</option>
                            @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerLA" width="276" name="open_mon"  @if($tm->Mon != 'closed') value="{{$opening_time->ViewTimeDate($times,'Mon')['open_time']}}"  @endif >
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerLC" width="276"  name="close_mon" @if($tm->Mon != 'closed') value="{{$opening_time->ViewTimeDate($times,'Mon')['close_time']}}"  @endif >
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Martes</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_tue" class="form-control">
                            @if($tm->Tue == 'closed')
                                <option value="0">Cerrado</option>
                                <option value="1">Abierto</option>
                            @else
                                <option value="1">Abierto</option>
                                <option value="0">Cerrado</option>
                            @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerMA" width="276"  name="open_tue"  @if($tm->Tue != 'closed') value="{{$opening_time->ViewTimeDate($times,'Tue')['open_time']}}"  @endif >
                            
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerMC" width="276"  name="close_tue"  @if($tm->Tue != 'closed') value="{{$opening_time->ViewTimeDate($times,'Tue')['close_time']}}"  @endif >
                            
                    </div>
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Miércoles</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_wed" class="form-control">
                                @if($tm->Wed == 'closed')
                                    <option value="0">Cerrado</option>
                                    <option value="1">Abierto</option>
                                @else
                                    <option value="1">Abierto</option>
                                    <option value="0">Cerrado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerMierA" width="276"  name="open_wed"  @if($tm->Wed != 'closed') value="{{$opening_time->ViewTimeDate($times,'Wed')['open_time']}}"  @endif >
                            
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerMierC" width="276"  name="close_wed" class="form-control without_ampm" @if($tm->Wed != 'closed') value="{{$opening_time->ViewTimeDate($times,'Wed')['close_time']}}"  @endif >
                            
                    </div>
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Jueves</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>


                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_thu" class="form-control">
                            @if($tm->Thu == 'closed')
                                <option value="0">Cerrado</option>
                                <option value="1">Abierto</option>
                            @else
                                <option value="1">Abierto</option>
                                <option value="0">Cerrado</option>
                            @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerJA" width="276"  name="open_thu"  @if($tm->Thu != 'closed') value="{{$opening_time->ViewTimeDate($times,'Thu')['open_time']}}"  @endif >
                           
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerJC" width="276"  name="close_thu"  @if($tm->Thu != 'closed') value="{{$opening_time->ViewTimeDate($times,'Thu')['close_time']}}"  @endif >
                          
                    </div>
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Viernes</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_fri" class="form-control">
                                @if($tm->Fri == 'closed')
                                    <option value="0">Cerrado</option>
                                    <option value="1">Abierto</option>
                                @else
                                    <option value="1">Abierto</option>
                                    <option value="0">Cerrado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerVA" width="276"  name="open_fri"  @if($tm->Fri != 'closed') value="{{$opening_time->ViewTimeDate($times,'Fri')['open_time']}}"  @endif >
                            
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerVC" width="276"  name="close_fri"  @if($tm->Fri != 'closed') value="{{$opening_time->ViewTimeDate($times,'Fri')['close_time']}}"  @endif >
                           
                    </div>
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Sábado</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_sat" class="form-control">
                                @if($tm->Sat == 'closed')
                                    <option value="0">Cerrado</option>
                                    <option value="1">Abierto</option>
                                @else
                                    <option value="1">Abierto</option>
                                    <option value="0">Cerrado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerSA" width="276"  name="open_sat"  @if($tm->Sat != 'closed') value="{{$opening_time->ViewTimeDate($times,'Sat')['open_time']}}"  @endif >
                            
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerSC" width="276"  name="close_sat"  @if($tm->Sat != 'closed') value="{{$opening_time->ViewTimeDate($times,'Sat')['close_time']}}"  @endif >
                            
                    </div>
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12" style="margin:0;padding:0 5px;">
                    <h5>Domingo</h5>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Status</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <select name="status_sun" class="form-control">
                                @if($tm->Sun == 'closed')
                                    <option value="0">Cerrado</option>
                                    <option value="1">Abierto</option>
                                @else
                                    <option value="1">Abierto</option>
                                    <option value="0">Cerrado</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de apertura</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerDA" width="276"  name="open_sun"  @if($tm->Sun != 'closed') value="{{$opening_time->ViewTimeDate($times,'Sun')['open_time']}}"  @endif >
                           
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail6">Horario de cierre</label>

                    <div class="form-group col-md-12" style="padding:0;">
                        <div class='input-group'>
                            <input id="timepickerDC" width="276"  name="close_sun"  @if($tm->Sun != 'closed') value="{{$opening_time->ViewTimeDate($times,'Sun')['close_time']}}"  @endif >
                           
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
</div>
<!--*********** Horario de Atencion *****************-->


<div class="card py-3 m-b-30">
    <div class="card-body">
    @if(isset($admin))     
        @if(!$data->id)
            @include('admin.user.newgoogle')
        @else  
            <a href="{{ Asset(env('admin').'/user/viewmap/'.$data->id) }}" class="btn btn-success btn-cta">Cargar Mapa y Ubicaciones</a>
            <input name="address" value="{{$data->address}}" type="hidden">
            <input type="hidden" name="lat" id="lat" value="{{ $data->lat }}">
            <input type="hidden" name="lng" id="lng" value="{{ $data->lng }}">
        @endif
    @else 
        <a class="btn btn-success btn-cta">Mapa y Ubicaciones seran cargadas desde Administración</a>
        <input name="address" value="{{$data->address}}" type="hidden">
        <input type="hidden" name="lat" id="lat" value="{{ $data->lat }}">
        <input type="hidden" name="lng" id="lng" value="{{ $data->lng }}">
    @endif
    </div>
</div>

</div>
</div>
<button type="submit" class="btn btn-success btn-cta">Guardar Cambios</button><br><br>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
    /** Funciones del horario */
        $('#timepickerLA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerLC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerMA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerMC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerMierA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerMierC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });

        $('#timepickerJA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerJC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerVA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerVC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerSA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerSC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerDA').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        $('#timepickerDC').timepicker({
                uiLibrary: 'bootstrap4',
                format: 'HH:MM'
        });
        
    /** Funciones del horario */
</script>