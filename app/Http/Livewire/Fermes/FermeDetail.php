<?php

namespace App\Http\Livewire\Fermes;

use App\Models\Animal;
use App\Models\Commune;
use App\Models\Espece;
use App\Models\Ferme;
use App\Models\Production;
use App\Models\Test;
use App\Models\Troupeau;
use Livewire\Component;

class FermeDetail extends Component
{
    public Ferme $ferme;
    public $animals;
    public $tests;
    public $especes;
    public $productions;
    public $edit, $addTroupeau;
    public $farm = [];
    public $herd = [];
    public $animaux = [];
    public $animal;
    public $communes;
    public $cps;
    public $cp;

    protected $rules = [
        'farm.nom' => 'required|string|max:191',
        'farm.email' => 'required|email:rfc,dns',
        'farm.adresse' => 'string|max:191',
        'farm.ede' => 'numeric',
        'farm.isBio' => 'boolean',
        'farm.longitude' => 'nullable|decimal:2,10',
        'farm.latitude' => 'nullable|decimal:2,10',
    ];

    protected $validationAttributes = [
        'farm.nom' => "Nom",
        'farm.email' => 'Adresse électronique',
        'farm.adresse' => 'Adresse',
        'farm.commune' => 'Commune',
        'farm.ede' => 'N° EDE',
        'farm.isBio' => 'BIO',
        'farm.longitude' => 'Longitude',
        'farm.latitude' => 'Latitude',
   ];

    function mount() 
    {
        $troupeau_ids = Troupeau::where('ferme_id', $this->ferme->id)->pluck('id');
        $this->tests = Test::whereIn('troupeau_id', $troupeau_ids )->get();
        $this->animals = Animal::whereIn('troupeau_id',  $troupeau_ids)->get();
        $this->edit = false;
        $this->addTroupeau = false;
        $this->communes = Commune::all();
        $this->especes = Espece::all();
        $this->productions = Production::all();
        $this->cps = Commune::select('Codepos')->groupBy('Codepos')->get();
    
        $this->cp = $this->ferme->commune->Codepos;
        $this->farm = $this->ferme->toArray();
        array_pop($this->farm);
    }

    function updated()
    {
        $this->cps = Commune::select('Codepos')->groupBy('Codepos')->get();

        $this->communes = Commune::where('Codepos', $this->cp)->get();    
    }

    function update(Ferme $ferme)
    {
        $this->cps = Commune::select('Codepos')->groupBy('Codepos')->get();

        $this->validate();

        Ferme::where('id', $ferme->id)->update($this->farm);
        $this->ferme = Ferme::find($ferme->id);
        $this->edit = false;
    }

    function addTroupeau()
    {

    }

    function choixEspece(Espece $espece)
    {
        $this->herd['espece'] = $espece->id;
    }

    function choixProduction(Production $production)
    {
        $this->herd['production'] = $production->id;    
    }

    function addAnimal()
    {
        array_push($this->animaux, $this->animal);
        $this->animal = '';
    }

    function delAnimal($animal)
    {
        unset($this->animaux[array_search($animal, $this->animaux)]);   

    }

    public function render()
    {
        return view('livewire.fermes.ferme-detail');
    }
}
