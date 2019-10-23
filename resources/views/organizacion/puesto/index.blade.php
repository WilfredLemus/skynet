@extends('layouts.app')

@section('title', 'Puestos')
@section('organizacion', 'active')
@section('puestos', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Puestos</h3>
                    <div class="pull-right btn-control">
                        <a href="{{ route('puestos.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nuevo Puesto
                        </a>
                    </div>

                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped table-hover tableData">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Puesto</th>
                                <th>Estado</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($puestos as $puesto)
                                <tr>
                                    <th scope="row">{{$puesto->id}}</th>
                                    <td>{{$puesto->nombre}}</td>
                                    <td>
                                        <span class="label label-{{$puesto->estado=="Activo"? 'primary':'default'}}">{{$puesto->estado}}</span>
                                    </td>
                                    <td>{{ $puesto->created_at->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $puesto->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('puestos.edit', $puesto)  }}" class="btn btn-sm btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger delete" href="#" data-id="{{$puesto->id}}"  title="Eliminar"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('puestos.destroy', $puesto)}}" method="POST" id="delete-form{{$puesto->id}}">
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
