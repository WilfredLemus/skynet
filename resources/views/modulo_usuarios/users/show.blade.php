@extends('layouts.app')

@section('title', 'Perfil Usuario')
@section('modulo_usuarios', 'active')
@section('usuarios', 'active')

@section('content')
<section class="content-header">
    <h1>Perfil de Usuario</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="Imagen Usuario">
                    <h4 class="text-center">{{ $user->nombre }} {{ $user->apellido }}</h4>
                    <p class="text-muted text-center">{{ $user->puesto->nombre }}</p>
                    <p class="text-center">
                        <span class="label label-{{$user->estado=="Activo"? 'primary':'default'}}">{{$user->estado}}</span>
                    </p>
                    <ul class="list-group list-group-unbordered">
                    </ul>
                    <p>
                        @can('Restablecer Contraseña Usuario')
                        <a class="btn btn-block btn-success restablecer" href="#" data-id="{{$user->id}}" title="Restablecer Contraseña" data-toggle="tooltip"><i class="fa fa-refresh"></i> Restablecer Contraseña</a>
                        <form action="{{ route('usuarios.restablecer', $user)}}" method="POST" id="restablecer-form{{$user->id}}" hidden>
                            @csrf
                        </form>
                        @endcan
                    </p>
                    <p>
                        @can('Editar Usuario')
                        <a href="{{ route('usuarios.edit', $user)  }}" class="btn btn-block btn-warning" title="Editar Usuario" data-toggle="tooltip"><b><i class="fa fa-edit"></i> Editar</b></a>
                        @endcan
                    </p>
                    <p>
                        @can('Eliminar Usuario')
                        <a class="btn btn-block btn-danger delete" href="#" data-id="{{$user->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i> Eliminar</a>
                        <form action="{{ route('usuarios.destroy', $user)}}" method="POST" id="delete-form{{$user->id}}">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endcan
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab"><i class="fa fa-list-alt"></i> Información</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="info">
                        <div class="box-body">
                            <div class="col-md-12">
                                <strong><i class="fa fa-user margin-r-5"></i>  Nombre y Apellido</strong>
                                <p class="text-muted">
                                    <h4 class="profile-username">{{ $user->nombre }} {{ $user->apellido }}</h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <strong><i class="fa fa-envelope-o margin-r-5"></i> Email</strong>
                                <p class="text-muted">
                                    <h4>{{ $user->email }}</h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <strong><i class="fa fa-user-circle-o margin-r-5"></i> Rol</strong>
                                <p class="text-muted">
                                    @foreach ($user->roles()->pluck('name') as $role)
                                        <h4 class="label label-info label-many">{{ $role }}</h4>
                                    @endforeach
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fa fa-angle-double-right"></i> Puesto</strong>
                                <p class="text-muted">
                                    <h4>{{ $user->puesto->nombre }}</h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fa fa-angle-double-right"></i> Oficina</strong>
                                <p class="text-muted">
                                    <h4>{{ $user->oficina->nombre }}</h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fa fa-angle-double-right"></i> Empresa</strong>
                                <p class="text-muted">
                                    <h4>{{ $user->empresa->nombre }}</h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fa fa-check"></i> Estado</strong>
                                <p class="text-muted">
                                    <h4><span class="label label-{{$user->estado? 'primary':'default'}}">{{$user->estado}}</span></h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fa fa-clock-o margin-r-5"></i> Creado</strong>
                                <p class="text-muted">
                                    <h4>{{ $user->created_at->format('d/m/Y h:ia') }}</h4>
                                </p>
                                <hr>
                            </div>
                            <div class="col-md-4">
                                <strong><i class="fa fa-clock-o margin-r-5"></i> Editado</strong>
                                <p class="text-muted">
                                    <h4>{{ $user->updated_at->format('d/m/Y h:ia') }}</h4>
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


{{-- <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="pull-right btn-control">
                        <a href="{{ route('usuarios.edit', $user)  }}" class="btn btn-link"  title="Editar Usuario" data-toggle="tooltip">
                            <i class="fa fa-edit"></i> Editar Usuario
                        </a>
                    </div>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="Perfil Usuario">
                    <h3 class="profile-username text-center">{{ $user->nombre }}</h3>
                    <p class="text-muted text-center">walr</p>
                    <ul class="list-group list-group-unbordered col-md-6">
                        <li class="list-group-item">
                            <b>Nombre:</b> <a class="pull-right">Wilfred</a>
                        </li>
                        <li class="list-group-item">
                            <b>Usuario:</b> <a class="pull-right">walr</a>
                        </li>
                        <li class="list-group-item">
                            <b>Rol:</b> <a class="pull-right">Administrador</a>
                        </li>
                    </ul>
                    <ul class="list-group list-group-unbordered col-md-6">
                        <li class="list-group-item">
                            <b>Apellido:</b> <a class="pull-right">Lemus</a>
                        </li>
                        <li class="list-group-item">
                            <b>Numero de Empleado:</b> <a class="pull-right">123456</a>
                        </li>
                        <li class="list-group-item">
                            <b>Estado:</b> <a class="pull-right">Activo</a>
                        </li>
                    </ul>

                    <!-- <a href="/usuarios/editar?" class="col-md-6 btn btn-primary btn-block"><b>Editar</b></a> -->
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#referidos" data-toggle="tab" aria-expanded="true">Referidos</a></li>
                <li class=""><a href="#llamadasAtencion" data-toggle="tab" aria-expanded="false">Llamadas de Atención</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="referidos">
                        <p>
                        </p>


                        <b>How to use:</b>

                        <p>Exactly like the original bootstrap tabs except you should use
                        the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                        A wonderful serenity has taken possession of my entire soul,
                        like these sweet mornings of spring which I enjoy with my whole heart.
                        I am alone, and feel the charm of existence in this spot,
                        which was created for the bliss of souls like mine. I am so happy,
                        my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                        that I neglect my talents. I should be incapable of drawing a single stroke
                        at the present moment; and yet I feel that I never was a greater artist than now.
                    </div>
                    <div class="tab-pane" id="llamadasAtencion">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
