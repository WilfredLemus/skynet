<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Opciones
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" style="left: -4.5em;position: inherit;" role="menu">
        <li><a href="{{ route('usuarios.show', $id)  }}" title="Ver Usuario" data-toggle="tooltip"  data-placement='left'><i class="fa fa-eye"></i> Ver</a></li>
        <li><a href="{{ route('usuarios.edit', $id)  }}" title="Editar Usuario" data-toggle="tooltip"  data-placement='left'><i class="fa fa-edit"></i> Editar</a></li>
        <li>
            <a href="#" class="restablecer" data-id="{{$id}}" title="Restablecer Contraseña" data-toggle="tooltip"  data-placement='left'><i class="fa fa-refresh"></i> Restablecer</a>
            <form action="{{ route('usuarios.restablecer', $id)}}" method="POST" id="restablecer-form{{$id}}" hidden>@csrf</form>
        </li>
    </ul>
</div>
