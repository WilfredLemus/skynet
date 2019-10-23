@extends('layouts.app')

@section('title', 'Usuarios')
@section('modulo_usuarios', 'active')
@section('usuarios', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Usuarios</h3>
                    @can('Crear Usuario')
                    <div class="pull-right btn-control">
                        <a href="{{ route('usuarios.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nuevo Usuario
                        </a>
                    </div>
                    @endcan
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped table-hover tableData">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Puesto</th>
                                <th>Oficina</th>
                                <th>Empresa</th>
                                <th>Roles</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->nombre}}</td>
                                <td>{{$user->apellido }}</td>
                                <td>{{$user->puesto->nombre }}</td>
                                <td>{{$user->oficina->nombre }}</td>
                                <td>{{$user->empresa->nombre }}</td>
                                <td>
                                    @foreach ($user->roles()->pluck('name') as $rol) 
                                    <span class='label label-info label-many'>{{$rol}}</span>
                                    @endforeach
                                </td>
                                <td><span class='label label-{{($user->estado=='Activo')? 'primary':'default'}}'>{{$user->estado}}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            Opciones
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" style="left: -4.5em;position: inherit;" role="menu">
                                            <li><a href="{{ route('usuarios.show', $user->id)  }}" title="Ver Usuario" data-toggle="tooltip"  data-placement='left'><i class="fa fa-eye"></i> Ver</a></li>
                                            <li><a href="{{ route('usuarios.edit', $user->id)  }}" title="Editar Usuario" data-toggle="tooltip"  data-placement='left'><i class="fa fa-edit"></i> Editar</a></li>
                                            <li>
                                                <a href="#" class="restablecer" data-id="{{$user->id}}" title="Restablecer Contraseña" data-toggle="tooltip"  data-placement='left'><i class="fa fa-refresh"></i> Restablecer</a>
                                                <form action="{{ route('usuarios.restablecer', $user->id)}}" method="POST" id="restablecer-form{{$user->id}}" hidden>@csrf</form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/jszip.min.js') }}" defer></script>
@endsection
