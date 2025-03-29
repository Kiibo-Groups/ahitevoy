<div class="modal fade modal-slide-right" id="slideRightModalInfoPay{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="slideRightModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: auto;overflow-y: auto;">
            <div class="modal-header">
                <h5 class="modal-title" id="slideRightModalLabel">
                    Información de pagos Orden #{{ $row->id }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @if($row->payment_method == 1) <!-- La venta fue en efectivo -->
                    <div class="row">
                        <div class="form-group col-md-6">Método de pago</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">Pago en efectivo</div>

                        <div class="form-group col-md-6">Total de venta</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$row->total }}</div>

                        <div class="form-group col-md-6">Descuentos</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$row->discount }}</div>
                    
                        <div class="form-group col-md-6">Envio</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$row->d_charges }}</div>
                        
                        <div class="form-group col-md-6">Retención de impuestos</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['reteneciones'] }}</div>

                        <div class="form-group col-md-6">Comisión de plataforma</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['comisionxs'] }}</div>
                    
                        <div class="form-group col-md-6" style="color:green;">
                            Total a recibir<br />
                            <small>(Comisión de la plataforma + Retención de impuestos)</small>
                        </div>
                        <div class="form-group col-md-5" style="color:green;float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['payment_to_admin'] }}</div>
                    </div>
                @else <!-- La venta fue con tarjeta -->
                    <div class="row">
                        
                        <div class="form-group col-md-6">Método de pago</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">Medios electrónicos</div>

                        <div class="form-group col-md-6">Total de venta</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$row->total }}</div>

                        <div class="form-group col-md-6">Venta del negocio</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['total'] }}</div>

                        <div class="form-group col-md-6">Descuentos</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$row->discount }}</div>
                    
                        <div class="form-group col-md-6">Retención de impuestos</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['reteneciones'] }}</div>

                        <div class="form-group col-md-6">Comisión de plataforma</div>
                        <div class="form-group col-md-5" style="float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['comisionxs'] }}</div>
                    
                        <div class="form-group col-md-6" style="color:red;">Saldo pendiente al repartidor</div>
                        <div class="form-group col-md-5" style="color:red;float:right;text-align:right;">{{ $currency.$row->d_charges }}</div>

                        <div class="form-group col-md-6" style="color:red;">
                            Saldo pendiente al negocio<br />
                            <small>(Total de la venta - Retención de impuestos)</small>
                        </div>
                        <div class="form-group col-md-5" style="color:red;float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['gananciasxt'] }}</div>

                        <div class="form-group col-md-6" style="color:green;">
                            Ganancia por venta<br />
                            <small>(Comisión de la plataforma + Retención de impuestos)</small>
                        </div>
                        <div class="form-group col-md-5" style="color:green;float:right;text-align:right;">{{ $currency.$item->GetTaxes($row->id)['payment_to_admin'] }}</div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</div>
<!-- 

-->