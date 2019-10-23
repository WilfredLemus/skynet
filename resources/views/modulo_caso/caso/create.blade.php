@extends('layouts.app')

@section('title', 'Crear Caso')
@section('modulo_casos', 'active')
@section('crear_caso', 'active')


@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nuevo Caso</h3>
                </div>
                <form role="form" action="{{ route('caso.index') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-error">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group col-md-6 {{ ($errors->has('nombre_caso'))? 'has-error':'' }}">
                            <label for="nombre_caso">Nombre Caso</label>
                            <input class="form-control" type="text" name="nombre_caso" value="{{ old('nombre_caso') }}" required>
                            @if($errors->has('nombre_caso'))
                                <div class="help-block">
                                <small>{{ $errors->first('nombre_caso') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('tipo_caso'))? 'has-error':'' }}">
                            <label for="tipo_caso">Tipo Caso</label>
                            <select class="form-control select2" name="tipo_caso" required>
                                <option value="">Selecciona Tipo Caso</option>
                                @foreach ($tipocasos as $tipocaso)
                                <option value="{{ $tipocaso->id }}">{{ $tipocaso->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tipo_caso'))
                                <div class="help-block">
                                <small>{{ $errors->first('tipo_caso') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ ($errors->has('descripcion'))? 'has-error':'' }}">
                            <label for="descripcion">Descripción del Caso</label>
                            <textarea class="form-control" name="descripcion" rows="2" placeholder="Descripción Detallada del caso" required></textarea>
                            @if($errors->has('descripcion'))
                                <div class="help-block">
                                <small>{{ $errors->first('descripcion') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('caso.index') }}" class="btn btn-default btn-block">Cancel</a>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-floppy-o"></i> Guardar</a></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
