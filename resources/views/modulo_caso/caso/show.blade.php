@extends('layouts.app')

@section('title', 'Caso')
@section('modulo_casos', 'active')
@section('lista_caso', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-4 form-group">
                    <a href="{{ url()->previous() }}" class="btn btn-default">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar
                    </a>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#informacion" data-toggle="tab">
                        <i class="fa fa-book" aria-hidden="true"></i> INFORNACIÓN
                        @if ($caso->etapacaso)
                        <span class="label label-default" style="font-size: 13px;" title="Etapa Actual" data-toggle="tooltip">
                            {{$caso->etapacaso->nombre}}
                        </span>
                        @endif</a>
                    </li>
                    {{-- <li><a href="#documentos" data-toggle="tab"><i class="fa fa-files-o" aria-hidden="true"></i> DOCUMENTOS</a></li> --}}
                    <li><a href="#bitacora" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> BITÁCORA</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active row" id="informacion">
                        <div class="col-md-12">
                            <div class="panel box box-default">
                                <div class="box-header with-border"
                                    data-toggle="collapse" data-parent="#accordion"
                                    href="#infornacionunidad" aria-expanded="true" style="cursor: pointer;">
                                    <h4 class="box-title">Información Caso</h4>
                                </div>
                                <div id="infornacionunidad" class="panel-collapse collapse in" aria-expanded="true">
                                    <div class="box-body">
                                        <div class="form-group col-md-6">
                                            <label>ID</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->id }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha</label>
                                            <input class="form-control" type="text" disabled value="{{ ($caso->fecha_creado)? $caso->fecha_creado->format('d/m/Y h:ia') :  $caso->fecha_creado}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nombre Caso</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->nombre_caso }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Tipo Caso</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->tipocaso->nombre }}">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Descripcion Caso</label>
                                            <textarea class="form-control" name="descripcion" rows="2" disabled>{{ $caso->descripcion }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Etapa Caso</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->etapacaso->nombre }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Creado Por</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->user->email }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Oficina</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->oficina->nombre }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Empresa</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->empresa->nombre }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Modificado</label>
                                            <input class="form-control" type="text" disabled value="{{ $caso->updated_at->format('d/m/Y h:ia') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-pane" id="documentos">
                        @if ($llamadaAtencion->pathpdf)
                        <a href="/{{ $llamadaAtencion->pathpdf }}" class="btn btn-app" target="_blank" style="font-size: 14px;">
                            <i class="fa fa-file-pdf-o text-red" aria-hidden="true"></i>
                            Llamada de Atención
                        </a>
                        @endif
                        @if ($llamadaAtencion->pathpdfsolicitud)
                        <a href="/{{ $llamadaAtencion->pathpdfsolicitud }}" class="btn btn-app" target="_blank" style="font-size: 14px;">
                            <i class="fa fa-file-pdf-o text-red" aria-hidden="true"></i>
                            Sancion Sugerida
                        </a>
                        @endif
                        @if ($llamadaAtencion->pathpdfacuerdo)
                        <a href="/{{ $llamadaAtencion->pathpdfacuerdo }}" class="btn btn-app" target="_blank" style="font-size: 14px;">
                            <i class="fa fa-file-pdf-o text-red" aria-hidden="true"></i>
                            Acuerdo
                        </a>
                        @endif
                        @if ($llamadaAtencion->pathpdfacuerdodigitalizado)
                        <a href="/{{ $llamadaAtencion->pathpdfacuerdodigitalizado }}" class="btn btn-app" target="_blank" style="font-size: 14px;">
                            <i class="fa fa-file-pdf-o text-red" aria-hidden="true"></i>
                            Acuerdo (FIRMADO)
                        </a>
                        @endif
                    </div> --}}
                    <div class="tab-pane row" id="bitacora">
                        <form class="col-md-12" role="form" action="{{ route('caso.cambiaretapa', $caso) }}" method="POST">
                            @csrf
                                <div class="form-group col-md-6 {{ ($errors->has('etapa_caso'))? 'has-error':'' }}">
                                    <select class="form-control select2" name="etapa_caso" required>
                                        <option value="">Selecciona Etapa Caso</option>
                                        @foreach ($etapacasos as $etapacaso)
                                        <option value="{{ $etapacaso->id }}">{{ $etapacaso->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('etapa_caso'))
                                        <div class="help-block">
                                        <small>{{ $errors->first('etapa_caso') }}</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-floppy-o"></i> Guardar</a></button>
                                </div>
                        </form>
                        <div class="col-md-12">
                            <ul class="timeline timeline-inverse">
                                @foreach ($caso->bitacora as $data)
                                <li>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{ $data->fecha->format('d/m/Y h:i:s a')}}</span>
                                        <h3 class="timeline-header">
                                            @if($data->user)<a data-toggle="tooltip" title="">{{ $data->user->email}} </a>@endif
                                            {{ $data->nota }}
                                        </h3>
                                    </div>
                                </li>
                                @endforeach
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection