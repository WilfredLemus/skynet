@extends('layouts.app')

@section('title', 'Nuevo Rol')
@section('modulo_usuarios', 'active')
@section('roles', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nuevo Rol</h3>
                </div>
                <form role="form" action="{{ route('roles.index') }}" method="POST">
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
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                            @if($errors->has('name'))
                                <div class="help-block">
                                <small>{{ $errors->first('name') }}</small>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="col-xs-12" style="margin-top:1.5em;">Permisos</label>
                            <div class="col-xs-5">
                                <select name="permisos_from[]" id="multiselect2" class="form-control multiselect" size="14" multiple="multiple">
                                        @foreach ($permisos as $permiso)
                                        <option value="{{ $permiso->id }}">{{ $permiso->name }}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="multiselect2_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="multiselect2_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="multiselect2_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="multiselect2_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <select name="permisos_to[]" id="multiselect2_to" class="form-control" size="14" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('roles.index') }}" class="btn btn-default btn-block">Cancelar</a>
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
