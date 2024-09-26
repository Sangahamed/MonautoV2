<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Toastr;

class AdminUserHeaderProfileInfo extends Component
{

    public $admin;
    public $user;

    public $listeners = [
        'updateAdminUserHeaderInfo'=>'$refresh'
    ];


    public function mount(){
        if( Auth::guard('admin')->check() ){
            $this->admin = Admin::findOrFail(auth()->id());
        }
        if( Auth::guard('user')->check() ){
            $this->user = User::findOrFail(auth()->id());
        }
    }

    public function render()
    {
        return view('livewire.admin-user-header-profile-info');
    }
}
