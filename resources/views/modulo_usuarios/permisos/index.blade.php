@extends('layouts.app')

@section('title', 'Permisos')
@section('modulo_usuarios', 'active')
@section('permisos', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Permisos</h3>
                    <div class="pull-right btn-control">
                        <a href="{{ route('permisos.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nuevo Permiso
                        </a>
                    </div>

                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped table-hover tableData">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permisos as $permiso)
                                <tr>
                                    <th scope="row">{{$permiso->id}}</th>
                                    <td>{{$permiso->name}}</td>
                                    <td>{{ $permiso->created_at->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $permiso->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- @can('permiso_editar') --}}
                                            <a href="{{ route('permisos.edit', $permiso)  }}" class="btn btn-sm btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            {{-- @endcan --}}
                                            {{-- @can('permiso_eliminar') --}}
                                            <a class="btn btn-sm btn-danger delete" href="#" data-id="{{$permiso->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('permisos.destroy', $permiso)}}" method="POST" id="delete-form{{$permiso->id}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            {{-- <a class="btn btn-sm btn-danger delete" href="{{ route('permisos.destroy', $permiso)}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a> --}}
                                            {{-- @endcan --}}
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
