<?php

namespace App\Http\Livewire\Fermes;

use App\Models\Animal;
use App\Models\Commune;
use App\Models\Espece;
use App\Models\Ferme;
use App\Models\Production;
use App\Models\Test;
use App\Models\Troupeau;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FermeDetail extends Component
{
    public Ferme $ferme;
    public $troupeaux; // Troupeaux de la ferme
    public $especes; // Liste des especes
    public $productions; // Liste des productions
    public $editFerme, $addTroupeau; // Booléens destinés à afficher masquer les formulaires
    public $farm = []; // Données du modèle ferme pendant modifications
    public $herd = []; // Données du modèle troupeau pendant création et/ou modifications
    public $animaux = []; // Liste d'animaux (création ou modification d'un troupeau, ajout d'animaux)
    public $animal; // Utilisé comme modèle Animal lors de la création d'un troupeau
    public $newAnimal; // Utilisé comme modèle Animal lors de l'ajout d'un animal à un troupeau
    public $animalTest; // Animal qui a participé à un test de résistance
    public $communes; // Liste de communes (modèle Commune)
    public $cps; // Liste des codes postaux (modèle Commune)
    public $cp; // Code postal de la ferme

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
        // Liste des animaux ayant participé à un test pour empêcher leur suppression
        $this->animalTest = DB::table('animal_test')->select('animal_id')->get();

        $this->editFerme = false;
        $this->addTroupeau = false;

        $this->especes = Espece::all();
        $this->productions = Production::all();
        
        $this->communes = Commune::all();
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
        $this->editFerme = false;
    }

    function updateEffectif(Troupeau $troupeau)
    {
        if (array_key_exists('effectif', $this->herd)) {
            $this->validate();
            Troupeau::where('id', $troupeau->id)->update($this->herd);
            $this->ferme = Ferme::find($this->ferme->id);
            $this->herd = [];
        }
    }

    function updateEspece(Troupeau $troupeau, Espece $espece)
    {
        Troupeau::where('id', $troupeau->id)->update(['espece_id' => $espece->id]);
        $this->ferme = Ferme::find($this->ferme->id);
    }

    function updateProduction(Troupeau $troupeau, Production $production)
    {
        Troupeau::where('id', $troupeau->id)->update(['production_id' => $production->id]);
        $this->ferme = Ferme::find($this->ferme->id);
    }

    function storeTroupeau(Ferme $ferme)
    {
        $this->herd['ferme_id'] = $ferme->id;
        $troupeau = Troupeau::create($this->herd);
        $this->ferme = Ferme::find($ferme->id);
        foreach ($this->animaux as $animal) {
            Animal::create([
                'numero' => $animal,
                'troupeau_id' => $troupeau->id
            ]);
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
        $this->ferme = Ferme::find($this->ferme->id);
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
        try {
            Animal::destroy($animal->id);
        } catch (\Throwable $th) {
            
        }
        $this->ferme = Ferme::find($this->ferme->id);
    }

    public function render()
    {
        return view('livewire.fermes.ferme-detail');
    }
}
