<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class Productlist extends Component
{

    public function mount()
    {
        $this->products = Product::orderBy('created_at', 'desc')->get();
    } 
    public function render()
    {
        return view('livewire.productlist', [
        'products' => $this->products, // Pass the products collection
    ]);
    }
}
