<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;

class LocationAffiche extends Component
{
    use WithPagination;

    public $perPage = 12;
    public $search = '';

    protected $queryString = ['search'];

    public function render()
    {
        $search = strtolower(preg_replace('/\s+/', '', $this->search));
        $searchKey = 'locations-search-' . md5($search);


        $locations = Cache::remember($searchKey, now()->addMinutes(10), function () use ($search) {
            $query = Location::where('visibility', 1)
                ->with('concession')
                ->orderBy('created_at', 'desc');

            if ($search) {
                $searchNormalized = strtolower(preg_replace('/\s+/', '', $search));
                $query->where(function ($query) use ($searchNormalized) {
                    $query->whereRaw('LOWER(modele) LIKE ? OR LOWER(slug) LIKE ? OR LOWER(annee) LIKE ? OR LOWER(Kilometrage) LIKE ? OR LOWER(equipements) LIKE ? OR LOWER(accesoires) LIKE ? OR LOWER(category) LIKE ? OR LOWER(subcategory) LIKE ? OR LOWER(prix) LIKE ? OR LOWER(dernier_prix) LIKE ?', [
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                    ]);
                });

                if (is_numeric($searchNormalized)) {
                    $query->orWhereBetween('prix', [
                        $searchNormalized * 0.8,
                        $searchNormalized * 1.2
                    ]);
                }
            }

            return $query->simplePaginate($this->perPage);
        });

        return view('livewire.location-affiche', [
            'locations' => $locations,
        ]);
    }
}
