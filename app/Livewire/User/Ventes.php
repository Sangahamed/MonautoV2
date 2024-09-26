<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Vendre;
use App\Models\User;
use Livewire\WithPagination;

class Ventes extends Component
{

    use WithPagination;

    public $perPage = 9;

    protected $listeners = [
        'refreshVentesList'=>'$refresh'
    ];
    

    public function render()
    {
        return view('livewire.user.ventes',[
            'vendres'=>Vendre::where('user_type','user')
                               ->where('user_id',auth('user')->id())
                               ->orderBy('created_at', 'desc')
                               ->paginate($this->perPage),
        ]);
    }
}
