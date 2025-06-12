@extends('admin.layout.main')
@section('title') Documentos @endsection

@section('content')

<section class="pull-up">
    <div class="container">
        <div class="row ">
            <div class="col-lg-12 mx-auto  mt-2">
                <div class="card py-3 m-b-30">
                    <div class="card-body">
                       <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="Licencia">Licencia</label>
                                @if(!$data->licence)
                                <div style="background-image: url('{{ asset('assets/img/placeholder.svg') }}');position:relative;width: 250px;height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center;border: 1px solid #e1e1e1;"></div>
                                @else
                                <div style="background-image: url('{{ asset('upload/licence/'.$data->licence) }}');position:relative;width: 250px;height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center;border: 1px solid #e1e1e1;">
                                    <a href="{{ url($link.'removeDocument/licence/'.$data->id) }}" style="border: 1px solid #e1e1e1;padding: 8px 20px;position: absolute;bottom: 0;width: 100%;background: red;text-align: center;color: #Fff;">Eliminar</a>
                                </div>
                                @endif
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="Licencia">Credencial</label>
                                @if(!$data->credential)
                                <div style="background-image: url('{{ asset('assets/img/placeholder.svg') }}');position:relative;width: 250px;height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center;border: 1px solid #e1e1e1;"></div>
                                @else
                                <div style="background-image: url('{{ asset('upload/credential/'.$data->credential) }}');position:relative;width: 250px;height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center;border: 1px solid #e1e1e1;">
                                    <a href="{{ url($link.'removeDocument/credential/'.$data->id) }}" style="border: 1px solid #e1e1e1;padding: 8px 20px;position: absolute;bottom: 0;width: 100%;background: red;text-align: center;color: #Fff;">Eliminar</a>
                                </div>
                                @endif
                            </div> 
                            <div class="form-group col-md-4">
                                <label for="Licencia">Biometrico</label>
                                @if(!$data->biometric)
                                <div style="background-image: url('{{ asset('assets/img/placeholder.svg') }}');position:relative;width: 250px;height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center;border: 1px solid #e1e1e1;"></div>
                                @else
                                <div style="background-image: url('{{ asset('upload/biometric/'.$data->biometric) }}');position:relative;width: 250px;height: 250px;background-size: contain;background-repeat: no-repeat;background-position: center center;border: 1px solid #e1e1e1;">
                                    <a href="{{ url($link.'removeDocument/biometric/'.$data->id) }}" style="border: 1px solid #e1e1e1;padding: 8px 20px;position: absolute;bottom: 0;width: 100%;background: red;text-align: center;color: #Fff;">Eliminar</a>
                                </div>
                                @endif
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
