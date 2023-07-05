<?php

namespace App\Http\Livewire\Fermes;

use App\Models\Ferme;
use Livewire\Component;

class Fermes extends Component
{
    public $fermes;

    function mount()
    {
        $this->fermes = Ferme::orderBy('nom')->get();   
    }

    function fermeDetail(Ferme $ferme)
    {
        return redirect()->route('ferme', $ferme);    
    }
    public function render()
    {
        return view('livewire.fermes.fermes');
    }
}
