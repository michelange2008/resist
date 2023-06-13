<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class ItemsFactory extends Component
{
    use WithFileUploads;

    public $model;
    public $table;
    public $modelWithPath;
    public array $state = [];
    public $infosModel;
    public $titre;
    public $icone;
    public $iconeModel;
    public $cols;
    public $columns;
    public $show;
    public $add;
    public $search;
    public bool $change = false;
    public bool $updateMode = false;
    public bool $toShow = false;
    public $items;
    public $item;
    public $btm_list = [];

    protected array $rules = [];

    public function mount($model)
    {
        $this->model = $model;
        $this->modelWithPath = 'App\\Models\\' . $model; // chemin complet pour pouvoir faire les requêtes
        $this->table = strtolower($model) . 's';
        $this->columns = Schema::getColumnListing($this->table);
        $this->infosModel = Storage::json('public/json/' . $this->table . '.json');
        $this->titre = $this->infosModel['nom'];
        $this->iconeModel = $this->infosModel['icone']; // Icone de la ligne de titre
        $this->show = $this->infosModel['show']; // Détermine s'il faut afficher une colonne cliquable pour afficher les détails d'un item
        $this->add = $this->infosModel['add']; // Détermine s'il faut afficher le bouton pour ajouter un item
        $this->cols = $this->infosModel['cols']; // Liste des colonnes de la table correspondant au model

        $this->items = $this->getItems(); // récupère les items en tenant compte d'un éventuel champs de recherche

        foreach ($this->cols as $key => $col) {
            if ($col['type'] == "select") {
                $bt_items = DB::table($col['bt_table'])->select('id', $col['bt_col'])->get();
                foreach ($bt_items as $row) {
                    $this->cols[$key]['bt_options'][$row->id] = $row->{$col['bt_col']};
                }
            } elseif ($col['type'] == "belongsToMany") {
                $btm_items = DB::table($col['btm_table'])->select('id', $col['btm_col'])->get();

                foreach ($btm_items as $row) {

                    $this->cols[$key]['btm_options'][$row->id] = $row->{$col['btm_col']};
                }
            }
        }
        // dd('');
    }

    /**
     * Récupère le modèle tout en faisant une recherche sur l'ensemble des champs texte
     */
    function getItems()
    {
        $cols = $this->cols;
        // Permet de faire une recherche sur tous les champs texte
        $liste = $this->modelWithPath::where(function ($query) use ($cols) {
            foreach ($cols as $field)
                if ($field['search']) {
                    $query->orWhere($field['col'], 'like', '%' . $this->search . '%');
                }
        })->get();

        return $liste;
    }

    /**
     * Agrège les rules de chaque champ du model en un seul tableau 
     * avec le nom du champ comme index
     *
     * @return array
     */
    function getRules(): array
    {
        $rules = [];
        foreach ($this->infosModel['cols'] as $key => $col) {
            if ($col['rules'] != null) {
                $rules[$key] = $col['rules'];
            }
        }

        return $rules;
    }

    public function show($id)
    {
        $this->item = $this->modelWithPath::find($id);
    }

    public function store()
    {
        Validator::make($this->state, $this->getRules())->validate();
        if ($this->icone != null) {

            $this->validate([
                'icone' => 'file|mimes:png,jpg,svg|max:1024',
            ]);
            $extension = "." . $this->icone->getClientOriginalExtension();

            $this->state['icone'] = $this->icone->getFileName();
            $this->icone->storeAs('public/img', $this->icone->getFileName());
        }

        $this->modelWithPath::create($this->state);

        $this->reset('state');
        $this->change = false;
        $this->items = $this->getItems();
    }

    function edit($id)
    {
        $this->updateMode = true;
        $this->item = $this->modelWithPath::find($id);
        $etat = [];
        foreach ($this->columns as $col) {
            $etat[$col] = $this->item->{$col};
        }

        $this->state = $etat;
    }

    public function update($id)
    {
        Validator::make($this->state, $this->rules)->validate();

        $this->modelWithPath::where('id', $id)
            ->update($this->state);

        $this->cancel();
        $this->change = false;

        $this->items = $this->getItems();
    }

    function addBtm($item_id, $btm, $id)
    {
        $btm_list[] = $id;
        $item = $this->modelWithPath::find($item_id);
        $item->molecules()->attach($id);

        $this->cancel();
        $this->change = false;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset('state');
    }

    public function addModal()
    {
        $this->cancel();
        $this->change = $this->change ? false : true;
    }

    public function delete($id)
    {
        $this->modelWithPath::destroy($id);
        $this->items = $this->getItems();
    }



    public function render()
    {
        return view('livewire.items-factory');
    }
}
