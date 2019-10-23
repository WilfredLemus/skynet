@extends('layouts.app')

@section('title', 'Roles de Usuario')
@section('modulo_usuarios', 'active')
@section('roles', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Roles</h3>
                    @can('Crear Rol')
                    <div class="pull-right btn-control">
                        <a href="{{ route('roles.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nuevo Rol
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
                                <th>Permisos</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th style="width: 76px;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $rol)
                                <tr>
                                    <th scope="row">{{$rol->id}}</th>
                                    <td>{{$rol->name}}</td>
                                    <td>
                                        @foreach ($rol->permissions()->pluck('name') as $permiso)
                                            <span class="label label-info">{{ $permiso }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $rol->created_at->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $rol->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            @can('Editar Rol')
                                            <a href="{{ route('roles.edit', $rol)  }}" class="btn btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('Eliminar Rol')
                                            <a class="btn btn-sm btn-danger delete" href="#" data-id="{{$rol->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('roles.destroy', $rol)}}" method="POST" id="delete-form{{$rol->id}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            @endcan
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3">No hay usuarios registrados</td></tr>
                            @endforelse

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
