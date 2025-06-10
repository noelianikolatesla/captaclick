<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard'); // o la ruta que prefieras
        }

        return redirect()->route('inicio'); // para usuarios normales
    }
}
