@extends('layouts.app')

@section('title', 'Empresa')
@section('organizacion', 'active')
@section('empresa', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Empresa</h3>
                    <div class="pull-right btn-control">
                        <a href="{{ route('empresa.create') }}" class="btn btn-block btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Nueva Empresa
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
                                <th>Estado</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresas as $empresa)
                                <tr>
                                    <th scope="row">{{$empresa->id}}</th>
                                    <td>{{$empresa->nombre}}</td>
                                    <td>@if($empresa->jefe){{$empresa->jefe->nombre}} {{$empresa->jefe->apellido}}@endif</td>
                                    <td>
                                        <span class="label label-{{$empresa->estado=="Activo"? 'primary':'default'}}">{{$empresa->estado}}</span>
                                    </td>
                                    <td>{{ $empresa->created_at->format('d/m/Y h:ia') }}</td>
                                    <td>{{ $empresa->updated_at->format('d/m/Y h:ia') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('empresa.edit', $empresa)  }}" class="btn btn-sm btn-warning"  title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger delete" href="#" data-id="{{$empresa->id}}"  title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('empresa.destroy', $empresa)}}" method="POST" id="delete-form{{$empresa->id}}">
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
