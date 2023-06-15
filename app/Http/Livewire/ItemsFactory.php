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
    public $orderBy;
    public $search;
    public bool $change = false;
    public bool $updateMode = false;
    public bool $toShow = false;
    public $items;
    public $item;

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
        $this->orderBy = $this->infosModel['orderBy']; // Détermine s'il faut afficher le bouton pour ajouter un item
        $this->cols = $this->infosModel['cols']; // Liste des colonnes de la table correspondant au model

        $this->items = $this->getItems(); // récupère les items en tenant compte d'un éventuel champs de recherche

        foreach ($this->cols as $key => $col) {
            if ($col['type'] == "select") {
                $bt_items = DB::table($col['bt_table'])->select('id', $col['bt_col'])->get();
                foreach ($bt_items as $row) {
                    $this->cols[$key]['bt_options'][$row->id] = $row->{$col['bt_col']};
                }
            } elseif ($col['type'] == "belongsToMany") {
                $btm_items = DB::table($col['btm_table'])->select('id', $col['btm_col'])->orderBy($col['btm_col'])->get();

                foreach ($btm_items as $row) {

                    $this->cols[$key]['btm_options'][$row->id] = $row->{$col['btm_col']};
                }
            }
        }
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
        })->orderBy($this->orderBy)->get();

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

    /**
     * Permet d'ajouter ou d'enlever un élément d'une relation BelongsToMany
     * Par exemple liste des molécules (Molecule) associées à un anthelminthique (Anthelm)
     *
     * @param [type] $btms nom de la méthode dans la relation BelongsToMany (ex. molecules) 
     * @param [type] $item_id permet de retrouver l'item concerné et donc la liste des 
     * associations dans la relation belongsToMany (ex. 3 qui l'id du SEPONVER)
     * @param [type] $btm_id (ex. 1 qui est l'id du lévamisole si on veut ajouter le lévamisole au SEPONVER)
     * @return void
     */
    function toggleBtm($btms, $item_id, $btm_id)
    {
        $btm_list = collect();

        $this->item = $this->modelWithPath::find($item_id);
        if ($this->item->{$btms} != null) {
            foreach ($this->item->{$btms} as $btm) {
                $btm_list->push($btm->id);
            }
        }
        $btm_list = $btm_list->unique();
        if ($btm_list->contains($btm_id)) {
            $btm_list->forget(array_search($btm_id, $btm_list->toArray()));
        } else {
            $btm_list->push($btm_id);
        }

        $this->item->{$btms}()->detach();
        foreach ($btm_list as $btm_id) {
            $this->item->{$btms}()->attach($btm_id);
        }

        // if ($btm->id == $btm_id) {  // Si l'id que l'on veut modifier est présent dans la table
        //     dump('detach: ' . $btm_id . ' - ' . $btm->id . ' - ' . $btm->nom);
        // } else {
        //     dump('attach: ' . $btm_id . ' - ' . $btm->id . ' - ' . $btm->nom);
        //     $this->item->{$btms}()->attach($btm_id); // Sinon on l'ajoute à la table pivot
        // }
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
