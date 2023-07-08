<?php

namespace App\Http\Livewire\Tests;

use App\Models\Animal;
use App\Models\Anthelm;
use App\Models\Espece;
use App\Models\Ferme;
use App\Models\Molecule;
use App\Models\Test;
use App\Models\Troupeau;
use Livewire\Component;

class Tests extends Component
{
    public $tests;
    public $test;
    public $troupeaus;
    public $anthelms;
    public $fermes;
    public $ferme;
    public $especes;
    public $animals;
    public $create;
    public $index;
    public $T0, $T1, $opg0, $opg1, $troupeau_id, $anthelm_id, $efficacite;
    public $state = [];
    public $ax = [];
    public $search = '';
    public $orderBy = 'T0';
    public $sensTri = "DESC";

    protected $rules = [
        'T0' => 'required|date',
        'opg0' => 'required|numeric|min:0',
        'T1' => 'required|date',
        'opg1' => 'required|numeric|min:0',
        'troupeau_id' => 'required',
        'anthelm_id' => 'required',
    ];

    protected $validationAttributes = [
        'T0' => 'date du traitement',
        'T1' => 'date du contrôle',
        'opg0' => 'OPG avant traitement',
        'opg1' => 'OPG de contrôle',
    ];

    function mount()
    {
        $this->anthelms = Anthelm::orderBy('nom')->get();
        $this->fermes = Ferme::orderBy('nom')->get();
        $this->troupeaus = Troupeau::orderBy('ferme_id')->get();
        $this->animals = Animal::orderBy('troupeau_id')->get();
        $this->especes = Espece::all();
        $this->index = true;
        $this->create = false;
        $this->getTests();
    }

    function getTests()
    {
        $searchAnthelms = Anthelm::where('nom', 'like', '%'.$this->search.'%' )->pluck('id');
        $this->tests = Test::whereIn('anthelm_id', $searchAnthelms)
            ->orderBy($this->orderBy, $this->sensTri)->get();
    }

    function create()
    {
        $this->index = false;
        $this->create = true;

    }

    function del(Test $test)
    {
        $test->animals()->detach();
        Test::destroy($test->id);   
        $this->getTests();
    }

    function updated() {
        $this->getTests();
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
        $test = Test::create([
            'T0' => $this->T0,
            'opg0' => $this->opg0,
            'T1' => $this->T1,
            'opg1' => $this->opg1,
            'troupeau_id' => $this->troupeau_id,
            'anthelm_id' => $this->anthelm_id,
            'efficacite' => $this->efficacite,
        ]);

        $test->animals()->attach($this->ax);

        $this->create = false;
        $this->index = true;
        
        $this->getTests();
    }

    function calculEfficacite(): void
    {
        if ( $this->opg0 != null && $this->opg1 != null)
        {
            $efficacite = ( (1 - $this->opg1/$this->opg0 ) > 0 ) ? 1 - $this->opg1/$this->opg0 : 0;
            $this->efficacite = round( 100 * $efficacite );

        }
    
    }

    function sort($col){
        $this->sensTri = ($this->sensTri == "DESC") ? "ASC" : "DESC";
        $this->orderBy = $col;
        $this->getTests();
    }

    function afficheEspece(Espece $espece)
    {
        
        $troupeaux = Troupeau::where('espece_id', $espece->id)->pluck('id');
        $this->tests = Test::whereIn('troupeau_id', $troupeaux)
            ->orderBy($this->orderBy, $this->sensTri)->get();

    }

    public function render()
    {
        return view('livewire.tests.tests');
    }
}
