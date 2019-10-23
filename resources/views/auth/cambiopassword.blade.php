@extends('auth.main-auth')

@section('title', 'Cambio de Contraseña')

@section('content')
<div class="login-box-body">
    <div class="login-logo">
        <img src="{{ asset('img/skynet.png') }}" height="90" alt="Logo skynet">
    </div>
    <p class="login-box-msg">Debes Cambiar tu contraseña</p>
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
    <form method="POST" action="{{ route('passwordchange.post') }}">
        @csrf
        <div class="form-group has-feedback">
            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
            <i class="fa fa-user form-control-feedback"></i>
        </div>
        <div class="form-group has-feedback password {{ ($errors->has('current_password'))? 'has-error':'' }}" id="current_password">
            <input type="password" name="current_password" class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}" placeholder="Contraseña Actual" required autofocus>
            <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback password {{ ($errors->has('password'))? 'has-error':'' }}" id="password">
            <input id="pass" type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Nueva Contraseña" required>
            <span class="glyphicon glyphicon-eye-open form-control-feedback" id="icon"></span>
        </div>
        <div class="form-group has-feedback password {{ ($errors->has('password_confirmation'))? 'has-error':'' }}" id="password_confirmation">
            <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="Confirmación Contraseña" required>
            <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Guardar</button>
            </div>
        </div>
    </form>
</div>
@endsection
