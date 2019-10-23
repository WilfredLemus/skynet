@extends('layouts.app')

@section('title', 'Casos')
@section('modulo_casos', 'active')
@section('lista_caso', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Casos</h3>
                    <div class="pull-right btn-control">
                        <a href="{{ route('caso.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Crear Caso
                        </a>
                    </div>

                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped table-hover tableData">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Tipo Caso</th>
                                <th>Etapa Caso</th>
                                <th>Creado por</th>
                                <th>Oficina</th>
                                <th>Empresa</th>
                                <th>Modificado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($casos as $caso)
                                <tr>
                                    <th scope="row">{{ $caso->id }}</th>
                                    <td>{{ ($caso->fecha_creado)? $caso->fecha_creado->format('d/m/Y h:ia') :  $caso->fecha_creado}}</td>
                                    <td>{{ $caso->nombre_caso }}</td>
                                    <td>{{ $caso->descripcion }}</td>
                                    <td>{{ $caso->tipocaso->nombre }}</td>
                                    <td>{{ $caso->etapacaso->nombre }}</td>
                                    <td>{{ $caso->user->email }}</td>
                                    <td>{{ $caso->oficina->nombre }}</td>
                                    <td>{{ $caso->empresa->nombre }}</td>
                                    <td>{{ $caso->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group btn-xs">
                                            <a href="{{ route('caso.show', $caso)  }}" class="btn btn-xs btn-primary"  title="Ver" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('caso.edit', $caso)  }}" class="btn btn-xs btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-xs btn-danger delete" href="#" data-id="{{$caso->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('caso.destroy', $caso)}}" method="POST" id="delete-form{{$caso->id}}">
                                                @method('DELETE')
                                                @csrf
                                            </form>
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
