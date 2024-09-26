<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;
use Livewire\WithEventEmitter;


class Locations extends Component
{
    use WithPagination;

    public $perPage = 12;

    protected $listeners = [
        'refreshlocationList' => '$refresh'
    ];

    public function toggleVisibility($locationId)
    {
        try {
            $location = Location::findOrFail($locationId); 
            $location->visibility = !$location->visibility; 
            $location->save(); 
            $this->dispatch('refreshlocationList');
        } catch (\Exception $e) {
           
            \Log::error('Erreur lors de la mise à jour de la visibilité de la location: ' . $e->getMessage());
           
        }
    }

    public function render()
    {
        return view('livewire.admin.locations', [
            'locations' => Location::orderBy('created_at', 'desc')->paginate($this->perPage),
        ]);
    }
}
