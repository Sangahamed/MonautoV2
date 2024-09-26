<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AbonnementPlan;




class ModelAbonnement extends Component
{
        


    protected $listeners = [
        'refreshmodeleabonnement' => '$refresh'
    ];

    public function render()
    {
        $abonnement_plans = AbonnementPlan::orderBy('created_at', 'desc')->get();
        return view('livewire.admin.model-abonnement', compact('abonnement_plans'));
    }
}
