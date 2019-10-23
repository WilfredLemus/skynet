@extends('layouts.app')

@section('title', 'Tipo Caso')
@section('modulo_casos', 'active')
@section('configuracion_casos', 'active')
@section('tipo_caso', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tipo Caso</h3>
                    <div class="pull-right btn-control">
                        <a href="{{ route('tipocaso.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nuevo Tipo Caso
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
                            @foreach ($tipocasos as $tipocaso)
                                <tr>
                                    <th scope="row">{{$tipocaso->id}}</th>
                                    <td>{{$tipocaso->nombre}}</td>
                                    <td>{{ $tipocaso->created_at->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $tipocaso->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('tipocaso.edit', $tipocaso)  }}" class="btn btn-sm btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger delete" href="#" data-id="{{$tipocaso->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('tipocaso.destroy', $tipocaso)}}" method="POST" id="delete-form{{$tipocaso->id}}">
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
