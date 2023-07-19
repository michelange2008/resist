<?php

namespace App\Http\Livewire\TestsUser;

use Livewire\Component;
use App\Models\Troupeau;
use App\Models\Ferme;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class TestsUser extends Component
{
    public $tests;
    public $orderBy = 'T0';
    public $sensTri = "DESC";

    function mount()
    {
        $this->getTests();
    }

    function getTests()
    {
        $troupeaux_id =
            Troupeau::whereIn('ferme_id', Ferme::where('veto_id', Auth::user()->id)->pluck('id')->toArray())
            ->orWhereIn('ferme_id', Ferme::where('eleveur_id', Auth::user()->id)->pluck('id')->toArray())
            ->pluck('id')->toArray();

        $this->tests = Test::whereIn('troupeau_id',  $troupeaux_id)
                            ->orderBy($this->orderBy, $this->sensTri)
                            ->get();
    }

    function sort($col)
    {
        $this->sensTri = ($this->sensTri == "DESC") ? "ASC" : "DESC";
        $this->orderBy = $col;
        $this->getTests();
    }
    public function render()
    {
        return view('livewire.tests-user.tests-user');
    }
}
