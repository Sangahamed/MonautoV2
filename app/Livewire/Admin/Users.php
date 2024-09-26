<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithEventEmitter;

class Users extends Component
{
    use WithPagination;

    public $perPage = 12;

    protected $listeners = [
        'refreshuserList' => '$refresh'
    ];

    public function toggleStatus($userId)
    {
        try {
            $user = User::findOrFail($userId); 
            $user->status = !$user->status; 
            $user->save(); 
            $this->dispatch('refreshuserList');
        } catch (\Exception $e) {
           
            \Log::error('Erreur lors de la mise à jour du statu client: ' . $e->getMessage());
           
        }
    }

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::orderBy('created_at', 'desc')->paginate($this->perPage),
        ]);
    }
}
