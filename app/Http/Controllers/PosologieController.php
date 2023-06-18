<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePosologieRequest;
use App\Models\Anthelm;
use App\Models\Espece;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PosologieController extends Controller
{
    
    function index() : View {
        $anthelms = Anthelm::orderBy('nom')->get();

        return view('posologie.posologie-index', [
            'anthelms' => $anthelms,
        ]);
    }

    function edit(Anthelm $anthelm, Espece $espece) : View {

        $detail_anthelm = $anthelm->especes()->where('espece_id', $espece->id)->first();

        return view('posologie.posologie-edit',[
            'anthelm' => $anthelm,
            'espece' => $espece,
            'detail_anthelm' => $detail_anthelm,
        ]);
    }

    function update(UpdatePosologieRequest $request) : RedirectResponse {
        
        $validated = $request->validated();

        $anthelm = Anthelm::find($request->anthelm_id);

        $anthelm->especes()->detach($request->espece_id);
        $anthelm->especes()->attach($request->espece_id, [
            'voie' => $request->voie,
            'posologie' => $request->posologie,
            'lait' => $request->lait,
            'viande' => $request->viande,
        ]);

        return redirect()->route('posologie.index');
    }
}
