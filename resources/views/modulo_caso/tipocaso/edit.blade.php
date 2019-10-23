@extends('layouts.app')

@section('title', 'Tipo Caso')
@section('modulo_casos', 'active')
@section('configuracion_casos', 'active')
@section('tipo_caso', 'active')


@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Editar Tipo Caso</h3>
                </div>
                <form role="form" action="{{ route('tipocaso.update', $tipocaso) }}" method="POST">
                    @method('PUT')
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
                        <div class="form-group col-md-12 {{ ($errors->has('nombre'))? 'has-error':'' }}">
                            <label for="nombre">Nombre</label>
                            <input class="form-control" type="text" name="nombre" value="{{ old('nombre', $tipocaso->nombre) }}" required>
                            @if($errors->has('nombre'))
                                <div class="help-block">
                                <small>{{ $errors->first('nombre') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('tipocaso.index') }}" class="btn btn-default btn-block">Cancelar</a>
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
