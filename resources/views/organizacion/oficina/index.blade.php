@extends('layouts.app')

@section('title', 'Oficina')
@section('organizacion', 'active')
@section('oficina', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Oficina</h3>
                    <div class="pull-right btn-control">
                        <a href="{{ route('oficina.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nueva Oficina
                        </a>
                    </div>

                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped table-hover tableData">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Jefe</th>
                                <th>Empresa</th>
                                <th>Estado</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oficinas as $oficina)
                                <tr>
                                    <th scope="row">{{$oficina->id}}</th>
                                    <td>{{$oficina->nombre}}</td>
                                    <td>@if($oficina->jefe){{$oficina->jefe->nombre}} {{$oficina->jefe->apellido}}@endif</td>
                                    <td>@if($oficina->empresa){{$oficina->empresa->nombre}}@endif</td>
                                    <td>
                                        <span class="label label-{{$oficina->estado=="Activo"? 'primary':'default'}}">{{$oficina->estado}}</span>
                                    </td>
                                    <td>{{ $oficina->created_at->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $oficina->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('oficina.edit', $oficina)  }}" class="btn btn-sm btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger delete" href="#" data-id="{{$oficina->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('oficina.destroy', $oficina)}}" method="POST" id="delete-form{{$oficina->id}}">
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
