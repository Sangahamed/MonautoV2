<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vendre;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;


class VenteAffiche extends Component
{

    use WithPagination;

    public $perPage = 12;
    public $search = '';

    protected $queryString = ['search'];

    protected $listeners = [
        'refreshVentesList'=>'$refresh'
    ];

    public function render()
    {

        $search = strtolower(preg_replace('/\s+/', '', $this->search));
        $searchKey = 'vendres-search-' . md5($search);

        // Utiliser la relation correcte `concession`

            $vendres = Cache::remember($searchKey, now()->addMinutes(10), function () use ($search) {
            $query = Vendre::where('visibility', 1)
                ->with('concession')
                ->orderBy('created_at', 'desc');

                 if ($search) {
                $searchNormalized = strtolower(preg_replace('/\s+/', '', $search));
                $query->where(function ($query) use ($searchNormalized) {
                    $query->whereRaw('LOWER(modele) LIKE ? OR LOWER(slug) LIKE ? OR LOWER(annee) LIKE ? OR LOWER(Kilometrage) LIKE ? OR LOWER(equipements) LIKE ? OR LOWER(accesoires) LIKE ? OR LOWER(category) LIKE ? OR LOWER(subcategory) LIKE ? OR LOWER(prix) LIKE ? OR LOWER(dernier_prix) LIKE ? OR LOWER(carburant) LIKE ? OR LOWER(transmission) LIKE ? OR LOWER(couleurint) LIKE ? OR LOWER(couleurext) LIKE ?', [
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
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                        "%$searchNormalized%",
                    ]);
                });

                if (is_numeric($searchNormalized)) {
                    $minPrice = $searchNormalized * 0.8;
                    $maxPrice = $searchNormalized * 1.2;

                    // Recherche par prix avec une plage de ±20%
                    $query->orWhereBetween('prix', [$minPrice, $maxPrice]);
                }
                
            }

            return $query->simplePaginate($this->perPage);
        });

        return view('livewire.vente-affiche', [
            'vendres' => $vendres,
        ]);
    }
}
