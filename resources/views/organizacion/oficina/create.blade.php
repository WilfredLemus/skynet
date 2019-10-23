@extends('layouts.app')

@section('title', 'Nueva Oficina')
@section('organizacion', 'active')
@section('oficina', 'active')


@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nueva Oficina</h3>
                </div>
                <form role="form" action="{{ route('oficina.index') }}" method="POST">
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
                            <input class="form-control" type="text" name="nombre" value="{{ old('nombre') }}" required>
                            @if($errors->has('nombre'))
                                <div class="help-block">
                                <small>{{ $errors->first('nombre') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estado</label>
                            <select id="estado" class="form-control select2" name="estado">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('jefe'))? 'has-error':'' }}">
                            <label for="jefe">Jefe</label>
                            <select class="form-control select2" name="jefe" required>
                                <option value="">Selecciona el Jefe</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">({{ $user->email }}) - {{ $user->nombre }} {{ $user->apellido }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jefe'))
                                <div class="help-block">
                                <small>{{ $errors->first('jefe') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('empresa'))? 'has-error':'' }}">
                            <label for="empresa">Empresa</label>
                            <select class="form-control select2" name="empresa" required>
                                <option value="">Selecciona Empresa</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}" >{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('empresa'))
                                <div class="help-block">
                                <small>{{ $errors->first('empresa') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('oficina.index') }}" class="btn btn-default btn-block">Cancel</a>
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
