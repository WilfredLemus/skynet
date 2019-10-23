@extends('layouts.app')

@section('title', 'Todos los Registros')
@section('modulo_auditoria', 'active')
@section('registros_todos', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Todos los Registros</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped table-hover tableData" id="tableRegistros">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                                <th>Tipo</th>
                                <th>ID Aud.</th>
                                <th>Valor Anterior</th>
                                <th>Valor Nuevo</th>
                                <th>Por Usuario</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($auditAll as $audit)
                            <tr>
                                <td>{{$audit->id}}</td>
                                <td>{{$audit->created_at->format('d/m/Y h:i:s a')}}</td>
                                <td>@lang($audit->event)</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>{{$audit->auditable_id}}</td>
                                <td>
                                    <ul>
                                        @foreach ($audit->old_values as $campo => $valor)
                                        <li>{{ $campo }}: {{$valor}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($audit->new_values as $campo => $valor)
                                        <li>{{ $campo }}: {{$valor}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('usuarios.show', $audit->user->id)  }}" title="Ver Perfil" data-toggle="tooltip">{{$audit->user->email}}</a>
                                </td>
                                <td>{{$audit->ip_address}}</td>
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
