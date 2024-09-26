<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Vendre;
use Livewire\WithPagination;
use Livewire\WithEventEmitter;


class Ventes extends Component
{

    use WithPagination;

    public $perPage = 12;

    protected $listeners = [
        'refreshVentesList'=>'$refresh'
    ];

    public function toggleVisibility($idVendre)
        {
            try {
                $vendre = Vendre::findOrFail($idVendre);
                $vendre->visibility = !$vendre->visibility;
                $vendre->save();
                $this->dispatch('refreshVentesList'); 
            } catch (\Exception $e) {
               
                \Log::error('Erreur lors de la mise à jour de la visibilité de la vente: ' . $e->getMessage());
                
            }
        }
    

    public function render()
    {
        return view('livewire.admin.ventes',[
            'vendres'=>Vendre::orderBy('created_at', 'desc')->paginate($this->perPage),
        ]);
    }
}
