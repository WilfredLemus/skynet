@extends('layouts.app')

@section('title', 'Nuevo Usuario')
@section('modulo_usuarios', 'active')
@section('usuarios', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nuevo Usuarios</h3>
                </div>
                <form role="form" action="{{ route('usuarios.index') }}" method="POST">
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
                        <h5 class="col-md-12"><i class="fa fa-angle-double-right text-primary"></i> Información Personal</h5>
                        <div class="form-group col-md-6 {{ ($errors->has('nombre'))? 'has-error':'' }}">
                            <label for="nombre">Nombre</label>
                            <input class="form-control" type="text" name="nombre" value="{{ old('nombre') }}" required>
                            @if($errors->has('nombre'))
                                <div class="help-block">
                                <small>{{ $errors->first('nombre') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('apellido'))? 'has-error':'' }}">
                            <label for="apellido">Apellido</label>
                            <input class="form-control" type="text" name="apellido" value="{{ old('apellido') }}" required>
                            @if($errors->has('apellido'))
                                <div class="help-block">
                                <small>{{ $errors->first('apellido') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('email'))? 'has-error':'' }}">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Estado</label>
                            <select class="form-control select2" name="estado">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <h5 class="col-md-12"><i class="fa fa-angle-double-right text-primary"></i> Información Laboral</h5>
                        <div class="form-group col-md-6 {{ ($errors->has('puesto'))? 'has-error':'' }}">
                            <label for="puesto">Puesto</label>
                            <select class="form-control select2" name="puesto" required>
                                <option value="">Selecciona el Puesto</option>
                                @foreach ($puestos as $puesto)
                                <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('puesto'))
                                <div class="help-block">
                                <small>{{ $errors->first('puesto') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('oficina'))? 'has-error':'' }}">
                            <label for="oficina">Oficina</label>
                            <select class="form-control select2" name="oficina" required>
                                <option value="">Selecciona Oficina</option>
                                @foreach ($oficinas as $oficina)
                                <option value="{{ $oficina->id }}">{{ $oficina->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('oficina'))
                                <div class="help-block">
                                <small>{{ $errors->first('oficina') }}</small>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{ ($errors->has('empresa'))? 'has-error':'' }}">
                            <label for="empresa">Empresa</label>
                            <select class="form-control" name="empresa" id="selectempresa" required>
                                <option value="">Selecciona Empresa</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('empresa'))
                                <div class="help-block">
                                <small>{{ $errors->first('empresa') }}</small>
                                </div>
                            @endif
                        </div>
                        <h5 class="col-md-12"><i class="fa fa-angle-double-right text-primary"></i> Roles y Permisos</h5>
                        <div>
                            <label class="col-xs-12">Roles</label>
                            <div class="col-xs-5">
                                <select name="roles_from[]" id="multiselect" class="form-control multiselect" size="8" multiple="multiple">
                                    @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-2">
                                <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>

                            <div class="col-xs-5">
                                <select name="roles_to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                            </div>
                        </div>

                        <div>
                            <label class="col-xs-12" style="margin-top:1.5em;">Permisos</label>
                            <div class="col-xs-5">
                                <select name="permisos_from[]" id="multiselect2" class="form-control multiselect" size="8" multiple="multiple">
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
                                <select name="permisos_to[]" id="multiselect2_to" class="form-control" size="8" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-default btn-block">Cancelar</a>
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
