<?php

namespace App\Http\Livewire;

use App\Models\Test;
use Carbon\Carbon;
use Livewire\Component;

class TestsIndex extends Component
{
    public $tests;
    public $test;
    public $detail;
    public $opg0Long, $opg1Long;
    public $intervalle;

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
        $this->intervalle = Carbon::parse($test->T1)->diffInDays($test->T0);
        $this->detail = true;    
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
