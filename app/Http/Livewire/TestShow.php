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

    function create()
    {
        return redirect()->route('test-create');    
    }

    function del(Test $test)
    {
        $test->animals()->detach();
        Test::destroy($test->id);   
        $this->tests = Test::orderBy('T0', 'DESC')->get();    
    }
    public function render()
    {
        return view('livewire.tests.test-show');
    }
}
