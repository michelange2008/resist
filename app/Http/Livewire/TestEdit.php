<?php

namespace App\Http\Livewire;

use App\Models\Animal;
use App\Models\Anthelm;
use App\Models\Ferme;
use App\Models\Test;
use App\Models\Troupeau;
use Livewire\Component;

class TestEdit extends Component
{
    public Test $test;
    public $fermes;
    public $ferme;
    public $anthelms;
    public $troupeaus;
    public $troupeau;
    public $animals;
    public $T0, $T1, $opg0, $opg1, $troupeau_id, $anthelm_id, $efficacite;
    public $state = [];
    public $ax = [];

    function mount($test)
    {
        $this->anthelms = Anthelm::orderBy('nom')->get();
        $this->fermes = Ferme::orderBy('nom')->get();
        $this->troupeaus = Troupeau::orderBy('ferme_id')->get();
        $this->animals = Animal::orderBy('troupeau_id')->get();
        $this->T0 = $this->test->T0;
        $this->T1 = $this->test->T1;
        $this->opg0 = $this->test->opg0;
        $this->opg1 = $this->test->opg1;
        $this->ferme = $this->test->troupeau->ferme;
        $selected_animals = $this->test->animals;
        foreach ($selected_animals as $animal) {
            $this->ax[] = strval($animal->id);
        }
        $this->troupeau_id = $this->test->troupeau_id;
        $this->anthelm_id = $this->test->anthelm_id;
        $this->efficacite = $this->test->efficacite;;
    }

    public function render()
    {
        return view('livewire.tests.test-edit');
    }
}
