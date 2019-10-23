@extends('layouts.app')

@section('title', 'Editar Puesto')
@section('organizacion', 'active')
@section('puestos', 'active')


@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Editar Puesto</h3>
                </div>
                <form role="form" action="{{ route('puestos.update', $puesto) }}" method="POST">
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
                        <div class="form-group col-md-6 {{ ($errors->has('nombre'))? 'has-error':'' }}">
                            <label for="nombre">Nombre</label>
                            <input class="form-control" type="text" name="nombre" value="{{ old('nombre', $puesto->nombre) }}" required>
                            @if($errors->has('nombre'))
                                <div class="help-block">
                                <small>{{ $errors->first('nombre') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estado</label>
                            <select id="estado" class="form-control select2" name="estado">
                                <option value="Activo" @if ($puesto->estado=='Activo') selected="selected" @endif>Activo</option>
                                <option value="Inactivo" @if ($puesto->estado=='Inactivo') selected="selected" @endif>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('puestos.index') }}" class="btn btn-default btn-block">Cancelar</a>
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
