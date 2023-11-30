<?php

namespace App\Http\Controllers;

use App\Models\medalla;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedallasController extends Controller
{
    public function index()
    {
        $medallas = Medalla::orderby('nivel')->get();

        return response()->json(['medallas' => $medallas]);
    }

    public function asignarMedallas(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $medallas = $request->input('medallas');

        if (!is_array($medallas)) {
            return response()->json(['message' => 'Los niveles de medallas deben ser un array'], 422);
        }

        $medallas = Medalla::whereIn('nivel', $medallas)->get();

        $user->medallas()->syncWithoutDetaching($medallas);

        return response()->json(['message' => 'Medallas asignadas correctamente']);
    }

    public function obtenerMedallasUsuario()
    {
        $usuario = Auth::user();
        $medallas = $usuario->medallas()->get();

        return response()->json(['medallas' => $medallas]);
    }

    public function desasignarMedallas(Request $request, $userId)
    {
        $medallasIds = $request->input('medallas_ids');

        $usuario = User::findOrFail($userId);
        $usuario->medallas()->detach($medallasIds);

        return response()->json(['message' => 'Medallas desasignadas correctamente']);

    }

    public function crearMedalla(Request $request)
    {
        $this->validate($request, [
            'ruta' => 'required|image|mimes:jpeg,jpg,png,gif',
            'descripcion' => 'required',
        ]);

        $rutaImagen = $request->file('ruta')->store('public/img/Medallas');
        $rutaImagen = str_replace('public/', '', $rutaImagen);

        $medalla = Medalla::create([
            'ruta' => $rutaImagen,
            'descripcion' => $request->input('descripcion'),
        ]);

        return response()->json(['message' => 'Medalla creada correctamente', 'medalla' => $medalla]);
    }
}
