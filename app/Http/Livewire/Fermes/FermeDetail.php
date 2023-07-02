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
    public $troupeaux;
    public $animals;
    public $tests;
    public $especes;
    public $productions;
    public $edit, $addTroupeau;
    public $farm = [];
    public $herd = [];
    public $animaux = [];
    public $animal;
    public $newAnimal;
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
        $this->troupeaux = Troupeau::where('ferme_id', $this->ferme->id)->get();
        if ($this->troupeaux != null) {
            foreach ($this->troupeaux as $troupeau)
            {
                $troupeau->animals = Animal::where('troupeau_id', $troupeau->id)->get();
                $troupeau->tests = Test::where('troupeau_id', $troupeau->id)->get();
            }
        }
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
        $this->troupeaux = Troupeau::where('ferme_id', $this->ferme->id)->get();

    }

    function update(Ferme $ferme)
    {
        $this->cps = Commune::select('Codepos')->groupBy('Codepos')->get();

        $this->validate();

        Ferme::where('id', $ferme->id)->update($this->farm);
        $this->ferme = Ferme::find($ferme->id);
        $this->edit = false;
    }

    function storeTroupeau(Ferme $ferme)
    {
        $this->herd['ferme_id'] = $ferme->id;
        $troupeau = Troupeau::create($this->herd);
        $this->ferme = Ferme::find($ferme->id);
        foreach ($this->animaux as $animal) {
            Animal::create([
                'numero' => $animal,
                'troupeau_id' => $troupeau->id]);
        }
        $this->addTroupeau = false;
    }

    function delTroupeau(Troupeau $troupeau)
    {
        Troupeau::destroy($troupeau->id);    
        $this->ferme = Ferme::find($this->ferme->id);
    }

    function choixEspece(Espece $espece)
    {
        $this->herd['espece_id'] = $espece->id;
    }

    function choixProduction(Production $production)
    {
        $this->herd['production_id'] = $production->id;    
    }

    function addAnimal()
    {
        if ($this->animal != null) {
            array_push($this->animaux, $this->animal);
        }
        $this->animal = '';
    }

    function delAnimal($animal)
    {
        unset($this->animaux[array_search($animal, $this->animaux)]);   

    }

    function addAnimalToTroupeau(Troupeau $troupeau)
    {
        Animal::create([
            'numero' => $this->newAnimal,
            'troupeau_id' => $troupeau->id,
        ]);
        $this->ferme = Ferme::find($this->ferme->id);
        $this->newAnimal = '';

    }

    function delAnimalFromTroupeau(Animal $animal)
    {
        Animal::destroy($animal->id);
        $this->ferme = Ferme::find($this->ferme->id);

    }

    public function render()
    {
        return view('livewire.fermes.ferme-detail');
    }
}
