@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Registrar Médico</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.medicos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <!-- DATOS -->
                <div class="col-md-6">

                    <!-- NOMBRES -->
                    <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" name="nombres" 
                               class="form-control mb-2" 
                               value="{{ old('nombres') }}" 
                               required>
                        @error('nombres')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- APELLIDOS -->
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" 
                               class="form-control mb-2" 
                               value="{{ old('apellidos') }}" 
                               required>
                        @error('apellidos')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- ESPECIALIDAD (SELECT) -->
                    <div class="form-group">
                        <label>Especialidad</label>
                        <select name="especialidad" class="form-control mb-2" required>

                            <option value="">Seleccione especialidad</option>

                            <option value="Cardiología" {{ old('especialidad') == 'Cardiología' ? 'selected' : '' }}>
                                Cardiología
                            </option>

                            <option value="Pediatría" {{ old('especialidad') == 'Pediatría' ? 'selected' : '' }}>
                                Pediatría
                            </option>

                            <option value="General" {{ old('especialidad') == 'General' ? 'selected' : '' }}>
                                General
                            </option>

                        </select>

                        @error('especialidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- TELEFONO -->
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" 
                               class="form-control mb-2" 
                               value="{{ old('telefono') }}">
                        @error('telefono')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- FOTO -->
                <div class="col-md-4">
                    <label>Foto</label>

                    <input type="file" 
                           id="fotoInput"
                           name="foto" 
                           class="form-control" 
                           accept="image/*" required>

                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="text-center mt-3">
                        <img id="preview"
                             src="https://via.placeholder.com/150"
                             style="width:150px; height:150px; object-fit:contain; border:1px solid #ddd;">
                    </div>
                </div>

            </div>

            <button class="btn btn-primary mt-3">Guardar</button>
            <a href="{{ route('admin.medicos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>

        </form>
    </div>
</div>

@stop


@section('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
});
</script>
@stop