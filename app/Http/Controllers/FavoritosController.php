<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    
public function toggle($inmuebleId)
{
    $user = Auth::user();
    $inmueble = Inmueble::findOrFail($inmuebleId);

    if ($user->favoritos()->where('inmueble_id', $inmuebleId)->exists()) {
        $user->favoritos()->detach($inmuebleId);
        return back()->with('success', 'Inmueble eliminado de favoritos.');
    } else {
        $user->favoritos()->attach($inmuebleId);
        return back()->with('success', 'Inmueble añadido a favoritos.');
    }
}
}
