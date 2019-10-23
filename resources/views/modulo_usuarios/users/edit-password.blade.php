@extends('layouts.app')

@section('title', 'Editar Mi Contraseña')

@section('content')
 <section class="content">
    <div class="row">
        <div class="col-md-12">
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
            <div class="box box-primary">
                <form method="POST" action="{{ route('miperfil.cambiarpassword') }}">
                    @csrf
                    <div class="box-body box-profile">
                        <div class="row">
                        <div class="col-md-4">
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="Image Perfil User">
                            <p class="text-muted text-center">{{ Auth::user()->puesto->nombre }}</p>
                        </div>
                        <div class="col-md-8">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <strong><i class="fa fa-user margin-r-5"></i>  Nombre y Apellido</strong>
                                    <p class="text-muted">
                                        <h4 class="profile-username">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h4>
                                    </p>
                                    <hr>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group has-feedback password {{ ($errors->has('current_password'))? 'has-error':'' }}" id="current_password">
                                        <input type="password" name="current_password" class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}" placeholder="Contraseña Actual" required autofocus>
                                        <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group has-feedback password {{ ($errors->has('password'))? 'has-error':'' }}" id="password">
                                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Nueva Contraseña" required>
                                        <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group has-feedback password {{ ($errors->has('password_confirmation'))? 'has-error':'' }}" id="password_confirmation">
                                        <input id="passwordfield" type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Confirmación Contraseña" required>
                                        <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-xs-6">
                            <a href="/" class="btn btn-default btn-block">Cancelar</a>
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
