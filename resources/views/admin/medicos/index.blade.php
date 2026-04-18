@extends('adminlte::page')

@section('content_header')
    <h1><b>Médicos</b></h1>
    <hr>
@stop

@section('content')

@if(session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.medicos.create') }}" class="btn btn-primary">
            Nuevo Médico
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicos as $m)
                <tr>
                    <td>{{ $m->id }}</td>

                    <td>
                        @if($m->foto)
                        <img src="{{ asset('storage/'.$m->foto) }}" width="60">
                        @else
                        <img src="https://via.placeholder.com/60">
                        @endif
                    </td>

                    <td>{{ $m->nombres }}</td>
                    <td>{{ $m->apellidos }}</td>
                    <td>{{ $m->especialidad }}</td>
                    <td>{{ $m->telefono }}</td>

                    <td>
                        <a href="{{ route('admin.medicos.edit', $m->id) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('admin.medicos.destroy', $m->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop