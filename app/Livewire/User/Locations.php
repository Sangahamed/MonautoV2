<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Location;
use App\Models\User;
use Livewire\WithPagination;

class Locations extends Component
{

     use WithPagination;

    public $perPage = 9;

    protected $listeners = [
        'refreshlocationList'=>'$refresh'
    ];

    public function render()
    {
        return view('livewire.user.locations',[
            'locations'=>Location::where('user_type','user')
                               ->where('user_id',auth('user')->id())
                               ->orderBy('created_at', 'desc')
                               ->paginate($this->perPage),
        ]);
    }
}
