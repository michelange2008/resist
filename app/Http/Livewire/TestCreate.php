<?php

namespace App\Http\Livewire;

use App\Models\Test;
use App\Models\Animal;
use App\Models\Anthelm;
use App\Models\Ferme;
use App\Models\Troupeau;
use Illuminate\Auth\Events\Validated;
use Livewire\Component;

class TestCreate extends Component
{
    public $fermes;
    public $ferme;
    public $anthelms;
    public $troupeaus;
    public $troupeau;
    public $animals;
    public $T0, $T1, $opg0, $opg1, $troupeau_id, $anthelm_id, $efficacite;
    public $state = [];
    public $ax = [];

    protected $rules = [
        'T0' => 'required|date',
        'opg0' => 'required|numeric|min:0',
        'T1' => 'required|date',
        'opg1' => 'required|numeric|min:0',
        'troupeau_id' => 'required',
        'anthelm_id' => 'required',
    ];

    function mount(): void {
        $this->anthelms = Anthelm::orderBy('nom')->get();
        $this->fermes = Ferme::orderBy('nom')->get();
        $this->troupeaus = Troupeau::orderBy('ferme_id')->get();

        $this->animals = Animal::orderBy('troupeau_id')->get();

    }

    function updated() {
        $this->troupeaus = Troupeau::where('ferme_id', $this->ferme)->get();
        if ( $this->troupeau_id != null )
        {
            $this->animals = Animal::where('troupeau_id', $this->troupeau_id)->get();
        }
        $this->calculEfficacite();
    }

    function save()
    {
        $this->validate();
        Test::create([
            'T0' => $this->T0,
            'opg0' => $this->opg0,
            'T1' => $this->T1,
            'opg1' => $this->opg1,
            'troupeau_id' => $this->troupeau_id,
            'anthelm_id' => $this->anthelm_id,
            'efficacite' => $this->efficacite,
        ]);
        return redirect()->to('/tests/show');
    }

    function calculEfficacite(): void
    {
        if ( $this->opg0 != null && $this->opg1 != null)
        {
            $efficacite = ( (1 - $this->opg1/$this->opg0 ) > 0 ) ? 1 - $this->opg1/$this->opg0 : 0;
            $this->efficacite = round( 100 * $efficacite );

        }
    
    }

    public function render()
    {
        return view('livewire.test-create');
    }
}
