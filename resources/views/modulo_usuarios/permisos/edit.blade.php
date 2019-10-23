@extends('layouts.app')

@section('title', 'Editar Permiso')
@section('modulo_usuarios', 'active')
@section('permisos', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Editar Permiso</h3>
                </div>
                <form role="form" action="{{ route('permisos.update',  $permiso) }}" method="POST">
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
                        <div class="form-group col-md-12 {{ ($errors->has('name'))? 'has-error':'' }}">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $permiso->name) }}" required>
                            @if($errors->has('name'))
                                <div class="help-block">
                                <small>{{ $errors->first('name') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('permisos.index') }}" class="btn btn-default btn-block">Cancelar</a>
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
