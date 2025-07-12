<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Si deseas una vista index para listar todos los usuarios
    public function index()
    {
        $usuarios = User::orderBy('name')->get();
        return view('admin.usuario.index', compact('usuarios'));
    }

    /**
     * Crear estudiante por AJAX (desde el modal)
     */
    public function storeEstudiante(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'documento' => 'required|string|unique:users',
        ]);

        $data['tipo'] = 'estudiante';
        $data['password'] = Hash::make('123456'); // Contraseña por defecto o temporal

        $user = User::create($data);

        return response()->json($user);
    }

    /**
     * Crear acudiente por AJAX (desde el modal)
     */
    public function storeAcudiente(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'documento' => 'required|string|unique:users',
        ]);

        $data['tipo'] = 'acudiente';
        $data['password'] = Hash::make('123456'); // Contraseña temporal

        $user = User::create($data);

        return response()->json($user);
    }
}
