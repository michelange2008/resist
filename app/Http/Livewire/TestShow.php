<?php

namespace App\Http\Livewire;

use App\Models\Test;
use Livewire\Component;

class TestShow extends Component
{
    public $tests;

    function mount()
    {
        $this->tests = Test::orderBy('T0', 'DESC')->get();    
    }
    public function render()
    {
        return view('livewire.test-show');
    }
}
