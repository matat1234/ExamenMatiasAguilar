@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-header">Editar Médico</div>

    <div class="card-body">
        <form action="{{ route('admin.medicos.update', $medico->id) }}" 
              method="POST" 
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- NOMBRES -->
            <input type="text" name="nombres" 
                   value="{{ $medico->nombres }}" 
                   class="form-control mb-2" required>

            <!-- APELLIDOS -->
            <input type="text" name="apellidos" 
                   value="{{ $medico->apellidos }}" 
                   class="form-control mb-2" required>

            <!-- ESPECIALIDAD -->
            <select name="especialidad" class="form-control mb-2" required>
                <option value="">Seleccione especialidad</option>

                <option value="Cardiología" 
                    {{ $medico->especialidad == 'Cardiología' ? 'selected' : '' }}>
                    Cardiología
                </option>

                <option value="Pediatría" 
                    {{ $medico->especialidad == 'Pediatría' ? 'selected' : '' }}>
                    Pediatría
                </option>

                <option value="General" 
                    {{ $medico->especialidad == 'General' ? 'selected' : '' }}>
                    General
                </option>
            </select>

            <!-- TELEFONO -->
            <input type="text" name="telefono" 
                   value="{{ $medico->telefono }}" 
                   class="form-control mb-2">

            <!-- FOTO -->
            <input type="file" name="foto" class="form-control mb-2">

            <!-- FOTO ACTUAL -->
            @if($medico->foto)
            <img src="{{ asset('storage/'.$medico->foto) }}" width="120">
            @else
            <img src="https://via.placeholder.com/120">
            @endif

            <br><br><button class="btn btn-warning">Actualizar</button>
            <a href="{{ route('admin.medicos.index') }}" class="btn btn-secondary">Cancelar</a>

        </form>
    </div>
</div>

@stop