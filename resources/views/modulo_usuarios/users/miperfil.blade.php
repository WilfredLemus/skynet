@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <div class="row">
                <div class="col-md-4">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="Image Perfil User">
                    <h3 class="profile-username text-center">{{ Auth::user()->nombrecompleto }}</h3>
                    <p class="text-muted text-center">{{ Auth::user()->puesto->nombre }}</p>
                    <div class="text-center">
                        {{-- <a href="/usuario/editar/" title="Editar Datos del Usuario" class="btn btn-block btn-app bg-navy btn-flat"><i class="fa fa-edit"></i> Editar Datos</a> --}}
                        <a href="{{ route('miperfil.editarpassword') }}" title="Cambiar Contraseña del Usuario" class="btn btn-primary btn-block"><i class="fa fa-lock"></i> Cambiar Contraseña</a>
                    </div>
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
                        <div class="col-md-12">
                            <strong><i class="fa fa-envelope-o margin-r-5"></i> Email</strong>
                            <p class="text-muted">
                                <h4>{{ Auth::user()->email }}</h4>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <strong><i class="fa fa-user-circle-o margin-r-5"></i> Rol</strong>
                            <p class="text-muted">
                                @foreach (Auth::user()->roles()->pluck('name') as $role)
                                    <h4 class="label label-info label-many">{{ $role }}</h4>
                                @endforeach
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-angle-double-right"></i> Puesto</strong>
                            <p class="text-muted">
                                <h5>{{ Auth::user()->puesto->nombre }}</h5>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-angle-double-right"></i> Oficina</strong>
                            <p class="text-muted">
                                <h5>{{ Auth::user()->oficina->nombre }}</h5>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fa fa-angle-double-right"></i> Empresa</strong>
                            <p class="text-muted">
                                <h5>{{ Auth::user()->empresa->nombre }}</h5>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-check"></i> Estado</strong>
                            <p class="text-muted">
                                <h5><span class="label label-{{Auth::user()->estado? 'primary':'default'}}">{{Auth::user()->estado}}</span></h5>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> Creado</strong>
                            <p class="text-muted">
                                <h4>{{ Auth::user()->created_at->format('d/m/Y h:ia') }}</h4>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <strong><i class="fa fa-clock-o margin-r-5"></i> Editado</strong>
                            <p class="text-muted">
                                <h4>{{ Auth::user()->updated_at->format('d/m/Y h:ia') }}</h4>
                            </p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
