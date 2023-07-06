<?php

namespace App\Http\Livewire\Tests;

use App\Models\Test;
use Carbon\Carbon;
use Livewire\Component;

class TestShow extends Component
{
    public Test $test;
    public $intervalle;

    function mount()
    {
        $this->intervalle = Carbon::parse($this->test->T1)->diffInDays($this->test->T0);
        
    }

    public function render()
    {
        return view('livewire.tests.test-show');
    }
}
