<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $perPage = 9;

    protected $listeners = [
        'refreshProductsList'=>'$refresh'
    ];

    public function render()
    {
        return view('livewire.user.products',[
            'products'=>Product::where('user_type','user')
                               ->where('user_id',auth('user')->id())
                               ->paginate($this->perPage),
        ]);
    }
}
