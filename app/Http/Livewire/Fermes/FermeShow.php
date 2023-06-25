<?php

namespace App\Http\Livewire\Fermes;

use App\Models\Animal;
use App\Models\Ferme;
use App\Models\Test;
use App\Models\Troupeau;
use Livewire\Component;

class FermeShow extends Component
{
    public Ferme $ferme;
    public $animals;
    public $tests;
    public $edit;

    function mount() 
    {
        $troupeau_ids = Troupeau::where('ferme_id', $this->ferme->id)->pluck('id');
        $this->tests = Test::whereIn('troupeau_id', $troupeau_ids )->get();
        $this->animals = Animal::whereIn('troupeau_id',  $troupeau_ids)->get();
        $this->edit = false;
    }

    function edit()
    {
        
    }

    public function render()
    {
        return view('livewire.fermes.ferme-show');
    }
}
