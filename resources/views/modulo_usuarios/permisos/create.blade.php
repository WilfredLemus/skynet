@extends('layouts.app')

@section('title', 'Nuevo Permiso')
@section('modulo_usuarios', 'active')
@section('permisos', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nuevo Permiso</h3>
                </div>
                <form role="form" action="{{ route('permisos.index') }}" method="POST">
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
                            <label class="col-xs-12">Roles</label>
                            <div class="col-xs-5">
                                <select name="roles_from[]" id="multiselect" class="form-control multiselect" size="8" multiple="multiple">
                                    @forelse ($role as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @empty
                                    @endforelse
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
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="{{ route('permisos.index') }}" class="btn btn-default btn-block">Cancel</a>
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
