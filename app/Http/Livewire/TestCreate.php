<?php

namespace App\Http\Livewire;

use App\Models\Animal;
use App\Models\Anthelm;
use App\Models\Ferme;
use App\Models\Troupeau;
use Livewire\Component;

class TestCreate extends Component
{
    public $fermes;
    public $ferme;
    public $anthelms;
    public $troupeaus;
    public $animals;
    public $state = [];

    function mount(): void {
        $this->anthelms = Anthelm::orderBy('nom')->get();
        $this->fermes = Ferme::orderBy('nom')->get();
        $this->troupeaus = Troupeau::orderBy('ferme_id')->get();

        $this->animals = Animal::orderBy('troupeau_id')->get();
    }

    function updated() {
        $this->troupeaus = Troupeau::where('ferme_id', $this->ferme)->get();
    }

    function choixTroupeau(int $ferme_id)
    {
        dd($ferme_id);
    }
    public function render()
    {
        return view('livewire.test-create');
    }
}
