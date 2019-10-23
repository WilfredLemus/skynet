@extends('auth.main-auth')

@section('title', 'Login')

@section('content')
<div class="login-box-body">
    <div class="login-logo">
        <img src="{{ asset('img/skynet.png') }}" height="90" alt="Logo Skynet">
    </div>
    <p class="login-box-msg">Inicia Sesión</p>
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
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group has-feedback {{ ($errors->has('email'))? 'has-error':'' }}">
            <input type="email" class="form-control"
                name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <i class="fa fa-user form-control-feedback"></i>
        </div>
        <div class="form-group has-feedback password {{ ($errors->has('password'))? 'has-error':'' }}" id="password">
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" required>
            <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
        </div>
        <div class="form-group">
            <input class="i-checks" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Recuérdame') }}
            </label>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div>
            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Recuperar contraseña?') }}
                </a>
            @endif --}}
        </div>
    </form>
</div>
@endsection

