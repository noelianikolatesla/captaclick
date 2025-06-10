<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Inmueble;
use Illuminate\Support\Facades\Auth;

class FavoritoToggle extends Component
{
    public $inmueble;
    public $esFavorito;

    public function mount(Inmueble $inmueble)
    {
        $this->inmueble = $inmueble;
        $this->esFavorito = Auth::user()->favoritos->contains($inmueble->id);
    }

    public function toggle()
    {
        $user = Auth::user();

        if ($user->favoritos->contains($this->inmueble->id)) {
            $user->favoritos()->detach($this->inmueble->id);
            $this->esFavorito = false;
        } else {
            $user->favoritos()->attach($this->inmueble->id);
            $this->esFavorito = true;
        }
    }

    public function render()
    {
        return view('livewire.favorito-toggle');
    }
}
