<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;


class SearchLocation extends Component
{
     public $search;
 
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.search-location',[
            'locations' => Location::where('modele', 'like', '%'.$this->search.'%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%')
                        ->orWhere('annee', 'like', '%' . $this->search . '%')
                        ->orWhere('Kilometrage', 'like', '%' . $this->search . '%')
                        ->orWhere('equipements', 'like', '%' . $this->search . '%')
                        ->orWhere('prix', 'like', '%' . $this->search . '%')
                        ->orWhere('dernier_prix', 'like', '%' . $this->search . '%')
                        ->get(),
        ]);
    }
}
