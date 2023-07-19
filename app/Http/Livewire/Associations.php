<?php

namespace App\Http\Livewire;

use App\Models\Ferme;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Associations extends Component
{
    public $eleveurs;
    public $vetos;
    public $selectedEleveur;
    public $selectedVeto;
    public $fermes;

    protected $rules = [
        'selectedEleveur' => 'string',
        'selectedVeto' => 'string',
    ];

    function mount()
    {
        $this->eleveurs = User::where('role_id', Role::where('nom', 'eleveur')->pluck('id'))->get();
        $this->vetos = User::where('role_id', Role::where('nom', 'veto')->pluck('id'))->get();
        $this->fermes = Ferme::all();
    }

    function getDatas() {
        $this->eleveurs = User::where('role_id', Role::where('nom', 'eleveur')->pluck('id'))->get();
        $this->fermes = Ferme::all();
        
    }

    function selectEleveurToAddFerme(User $eleveur)
    {
        $this->selectedEleveur = $eleveur; 
    }
    
    function selectVetoToAddFerme(User $veto)
    {
        $this->selectedVeto = $veto; 
    }
    
    function addFermeToEleveur(Ferme $ferme)
    {
        if ($this->selectedEleveur != null) {
            $ancienne_ferme = Ferme::where('eleveur_id', $this->selectedEleveur->id)->first();
            if($ancienne_ferme != null) {
                $ancienne_ferme->eleveur_id = null;
                $ancienne_ferme->save();
            }
            $ferme->eleveur_id = $this->selectedEleveur->id;
            $ferme->save();
            $this->getDatas();
        }
    }

    function addFermeToVeto(Ferme $ferme)
    {
        if ($this->selectedVeto != null) {
            if($ferme->veto_id == $this->selectedVeto->id) {
                $ferme->veto_id = null;
            }
            else {
                $ferme->veto_id = $this->selectedVeto->id;
            }
            $ferme->save();
            $this->getDatas();
        }
    }

   public function render()
    {
        return view('livewire.asso.associations');
    }
}
