<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbonnementPlan;
use App\Rules\ValidatePrice;
use Illuminate\Validation\ValidationException;

class AbonnementPlanController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'Abonnement Modele Plan',
            
        ];
        return view('back.pages.admin.plan-abonnement', $data);
    }

    public function create()
    {
        $data = [
            'pageTitle' => 'Cree Modele Abonnement',
        ];
        return view('back.pages.admin.add-abonnement', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:abonnement_plans,name',
            'description' => 'required',
            'prix' => ['required', new ValidatePrice],
        ],[
            'name.required' => 'Veuillez saisir un nom abonnement.',
            'name.unique' => 'Le Modele exist deja',
            'description.required' => 'Veuillez saisir une description.',
            'prix.required' => 'Veuillez saisir un prix.',
        ]);
        

        AbonnementPlan::create($request->all());

        return redirect()->route('admin.manage-abonnement.plan-abonnement')
        ->with('success', '<b>' . ucfirst($request->name) . '</b> a ajouter avec succes.');
    }

    public function edit(Request $request, AbonnementPlan $abonnementplan)
    {
        $abonnementplan = AbonnementPlan::findOrFail($request->id);
        $data = [
            'pageTitle' => 'Modifier Modele Abonnement',
            'abonnementplan'=>$abonnementplan,
        ];
        return view('back.pages.admin.edit-Abonnement', $data);
    }

    public function update(Request $request, AbonnementPlan $abonnementplan)
    {
        $abonnementplan = AbonnementPlan::findOrFail($request->id);

        
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'prix' => 'required',
            'type' => 'null'
        ],[
            'name.required' => 'Veuillez verifier le modele l\' abonnement.',
            'description.required' => 'Veuillez saisir une description.',
            'prix.required' => 'Veuillez saisir un prix.',
        ]);
        

         $abonnementplan->update($request->all());

        return redirect()->route('admin.manage-abonnement.plan-abonnement')
            ->with('success', '<b>' . ucfirst($request->name) . '</b> mise a jour avec succes.');
        }

    public function destroy(Request $request, AbonnementPlan $abonnementplan)
    {
        $abonnementplan = AbonnementPlan::findOrFail($request->id);

        $abonnementplan->delete();
        return redirect()->route('admin.manage-abonnement.plan-abonnement')
        ->with('success', '<b>' . ucfirst($request->name) . '</b> suppression avec succes.');

    }

   
}
