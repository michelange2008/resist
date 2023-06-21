<?php

namespace App\Http\Livewire;

use App\Models\Test;
use Livewire\Component;

class TestsIndex extends Component
{
    public $tests;
    public $test;
    public $detail;

    function mount()
    {
        $this->detail = false;;
        $this->tests = Test::orderBy('T0', 'DESC')->get();    
    }

    function create()
    {
        return redirect()->route('test-create');    
    }

    function show(Test $test)
    {
        $this->test = $test;
        // $this->detail = true;    
    }

    function del(Test $test)
    {
        $test->animals()->detach();
        Test::destroy($test->id);   
        $this->tests = Test::orderBy('T0', 'DESC')->get();    
    }
    public function render()
    {
        return view('livewire.tests.tests-index');
    }
}
