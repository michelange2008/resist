<?php

namespace App\Http\Livewire\Fermes;

use App\Models\Animal;
use App\Models\Commune;
use App\Models\Ferme;
use App\Models\Test;
use App\Models\Troupeau;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FermeShow extends Component
{
    public Ferme $ferme;
    public $animals;
    public $tests;
    public $edit;
    public $farm = [];
    public $communes;
    public $cps;
    public $cp;

    function mount() 
    {
        $troupeau_ids = Troupeau::where('ferme_id', $this->ferme->id)->pluck('id');
        $this->tests = Test::whereIn('troupeau_id', $troupeau_ids )->get();
        $this->animals = Animal::whereIn('troupeau_id',  $troupeau_ids)->get();
        $this->edit = false;
        $this->communes = Commune::all();
        $this->cps = DB::table('communes')->select('Codepos')->groupBy('Codepos')->get();
        $this->cp = $this->ferme->commune->Codepos;
        $this->farm = $this->ferme->toArray();

        array_pop($this->farm);
    }

    function updated()
    {
        $this->cps = DB::table('communes')->select('Codepos')->groupBy('Codepos')->get();

        $this->communes = Commune::where('Codepos', $this->cp)->get();    
    }

    function edit()
    {
        
    }

    public function render()
    {
        return view('livewire.fermes.ferme-show');
    }
}
