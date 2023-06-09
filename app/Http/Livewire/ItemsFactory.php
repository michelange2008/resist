<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ItemsFactory extends Component
{
    public $model;
    public $table;
    public $modelWithPath;
    public $infosModel;
    public $titre;
    public $icone;
    public $cols;
    public $show;
    public $items;

    public function mount($model)
    {
        $this->model = $model;
        $this->table = strtolower($model).'s';
        $this->infosModel = Storage::json('public/json/'.$this->table.'.json');
        $this->titre = $this->infosModel['nom'];
        $this->icone = $this->infosModel['icone'];
        $this->cols = $this->infosModel['cols'];
        $this->show = $this->infosModel['show'];
        $this->modelWithPath = 'App\\Models\\'.$model;
        $this->items = $this->modelWithPath::orderBy($this->infosModel['orderBy'])->get();

    }
    public function render()
    {
        return view('livewire.items-factory');
    }
}
