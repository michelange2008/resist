<?php

namespace App\Http\Livewire\Accueil;

use App\Models\Troupeau;
use App\Models\Ferme;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Accueil extends Component
{

    public function render()
    {
        return view('livewire.accueil.accueil');
    }
}
