<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RelacionFamiliar;
use Illuminate\Http\Request;

class RelacionFamiliarController extends Controller
{
    /**
     * Actualiza la relación familiar (acudiente y parentesco).
     */
    public function update(Request $request, RelacionFamiliar $relacion)
    {
        $request->validate([
            'acudiente_id' => 'required|exists:users,id',
            'parentesco' => 'required|string|max:100',
        ]);

        $relacion->update([
            'padre_id' => $request->acudiente_id,
            'parentesco' => $request->parentesco,
        ]);

        return redirect()->back()->with('success', 'Relación familiar actualizada correctamente.');
    }
}
