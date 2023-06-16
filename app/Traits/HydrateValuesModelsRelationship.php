<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Ajoute les valeurs des models liés par des relations (belongsTo
 * ou BelongsToMany) dans le tableau permettant l'affichage des formulaires
 */
trait HydrateValuesModelsRelationship
{

    function hydrateValues(Array $cols) : Array {
        foreach ($cols as $key => $col) {
            // Relation belongsTo
            if ($col['type'] == "select") {

                $cols[$key]['bt_options'] = 
                    $this->belongsToHydrateValues(
                                $col['bt_table'], 
                                $col['bt_col'], 
                                $cols[$key]['bt_options']);

            } elseif ($col['type'] == "belongsToMany") {
                // On peuple d'abord la liste des valeurs existantes pour le modèle lié par la relation belongsToMany
                $cols[$key]['btm_options'] = $this->belongsToHydrateValues(
                                                    $col['btm_table'], 
                                                    $col['btm_col'], 
                                                    $cols[$key]['btm_options']);
            // Si la table pivot possède en plus des valeurs
                if ($col['hasValues']) {
                    // On passe en revue ces valeurs
                    foreach ($col['btm_values'] as $btm_key => $btm_value) {
                        // Si elles correspondent à une relation belongsTo, on va chercher la liste des valeurs du modèle lié
                        if ($btm_value['type'] == 'select') {

                            $cols[$key]['btm_values'][$btm_key]['bt_options'] = 
                                $this->belongsToHydrateValues(
                                    $btm_value['bt_table'], 
                                    $btm_value['bt_col'], 
                                    $cols[$key]['btm_values'][$btm_key]['bt_options']);

                        }

                    }
                }
            }
        }

        return $cols;
    }
    /**
     * Récupère la liste des valeurs d'un modèle et les mets
     * dans le tableau "options"
     *
     * @param string $table table du modèle associé
     * @param string $col champ correspondant à la valeur 
     * @param array $options tableau à peupler
     * @return array le meme tableau une fois peuplé
     */
    function belongsToHydrateValues(
                        string $table, 
                        string $col, 
                        array $options) : array
    {

        $bt_items = DB::table($table)->select('id', $col)->orderBy($col)->get();

        foreach ($bt_items as $row) {

            $options[$row->id] = $row->{$col};

        }

        return $options;
    }
    
}

