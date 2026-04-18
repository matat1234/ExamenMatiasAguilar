<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MedicoController extends Controller
{
    // LISTAR
    public function index()
    {
        $medicos = Medico::all();
        return view('admin.medicos.index', compact('medicos'));
    }

    // CREAR
    public function create()
    {
        return view('admin.medicos.create');
    }

    // GUARDAR
   public function store(Request $request)
{
    $request->validate([
        'nombres' => 'required',
        'apellidos' => 'required',
        'especialidad' => 'required',
        'telefono' => 'nullable',
        'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $original = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME);
    $extension = $request->file('foto')->getClientOriginalExtension();

    $nombre = Str::slug($original);
    $nombreFinal = $nombre.'_'.time().'.'.$extension;

    $ruta = $request->file('foto')->storeAs('medicos', $nombreFinal, 'public');

    Medico::create([
        'nombres' => $request->nombres,
        'apellidos' => $request->apellidos,
        'especialidad' => $request->especialidad,
        'telefono' => $request->telefono,
        'foto' => $ruta,
    ]);

    return redirect()->route('admin.medicos.index');
}

    
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);
        return view('admin.medicos.edit', compact('medico'));
    }

    // ACTUALIZAR
  public function update(Request $request, $id)
{
    $medico = Medico::findOrFail($id);

    $data = $request->only(['nombres','apellidos','especialidad','telefono']);

    if ($request->hasFile('foto')) {

       
        if ($medico->foto && Storage::exists('public/'.$medico->foto)) {
            Storage::delete('public/'.$medico->foto);
        }

        $original = pathinfo($request->file('foto')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('foto')->getClientOriginalExtension();

        $nombre = Str::slug($original);
        $nombreFinal = $nombre.'_'.time().'.'.$extension;

        $data['foto'] = $request->file('foto')->storeAs('medicos', $nombreFinal, 'public');
    }

    $medico->update($data);

    return redirect()->route('admin.medicos.index');
}

    // ELIMINAR
    public function destroy($id)
{
    $medico = Medico::findOrFail($id);

    if ($medico->foto && Storage::exists('public/'.$medico->foto)) {
        Storage::delete('public/'.$medico->foto);
    }

    $medico->delete();

    return redirect()->route('admin.medicos.index');
}
}