<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Toastr;

class AdminProfileTabs extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];
    public $name, $email, $username, $admin_id;
    public $current_password, $new_password, $new_password_confirmation;

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = request()->tab ? request()->tab : $this->tabname;

        if( Auth::guard('admin')->check() ){
            $admin = Admin::findOrFail(auth()->id());
            $this->admin_id = $admin->id;
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->username = $admin->username;
        }
    }

    public function updateAdminPersonalDetails(){
        $this->validate([
            'name'=>'required|min:5',
            'email'=>'required|email|unique:admins,email,'.$this->admin_id,
            'username'=>'required|min:3|unique:admins,username,'.$this->admin_id
        ]);

        Admin::find($this->admin_id)
             ->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'username'=>$this->username
             ]);

        $this->dispatch('updateAdminSellerHeaderInfo');
        $this->dispatch('updateAdminInfo',[
            'adminName'=>$this->name,
            'adminEmail'=>$this->email
        ]);
        $this->showToastr('success','Vos information ont été mises à jour avec succès.');
    }

    public function updatePassword(){
        $this->validate([
            'current_password'=>[
                'required', function($attribute, $value, $fail){
                    if(!Hash::check($value, Admin::find(auth('admin')->id())->password)){
                        return $fail(__('Le mot de passe actuel est incorrect'));
                    }
                }
            ],
            'new_password'=>'required|min:8|max:45|confirmed'
        ]);

        $query = Admin::findOrFail(auth('admin')->id())->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if($query){
            //Send notification
            $_admin = Admin::findOrFail($this->admin_id);
            $data = array(
                'admin'=>$_admin,
                'new_password'=>$this->new_password
            );
    
            $mail_body = view('email-templates.admin-reset-email-template', $data)->render();
    
            $mailConfig = array(
                'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
                'mail_from_name'=>env('EMAIL_FROM_NAME'),
                'mail_recipient_email'=>$_admin->email,
                'mail_recipient_name'=>$_admin->name,
                'mail_subject'=>'Password changed',
                'mail_body'=>$mail_body
            );
    
            sendEmail($mailConfig);

            $this->current_password = $this->new_password = $this->new_password_confirmation = null;
            $this->showToastr('success','Mot de passe modifié avec succès.');
        }else{
            $this->showToastr('error','Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function showToastr($type, $message){
        return $this->dispatch('showToastr',[
             'type'=>$type,
             'message'=>$message
        ]);
    }
    public function render()
    {
        return view('livewire.admin-profile-tabs');
    }
}
