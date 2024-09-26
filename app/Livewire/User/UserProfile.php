<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Toastr;

class UserProfile extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    public $name, $email, $username, $phone, $address;
    public $current_password, $new_password, $new_password_confirmation;

    protected $queryString = ['tab'=>['keep'=>true]];

    protected $listeners = [
        'updateUserProfilePage'=>'$refresh'
    ];
    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
       $this->tab = request()->tab ? request()->tab : $this->tabname;

       //POPULATE
       $user = User::findOrFail(auth('user')->id());
       $this->name = $user->name;
       $this->email = $user->email;
       $this->username = $user->username;
       $this->phone = $user->phone;
       $this->address = $user->address;
    }

    public function updateUserPersonalDetails(){
        //Validate the form
        $this->validate([
            'name'=>'required|min:5',
            'username'=>'nullable|min:5|unique:users,username,'.auth('user')->id(),
        ]);
        $user = User::findOrFail(auth('user')->id());
        $user->name = $this->name;
        $user->username = $this->username;
        $user->address = $this->address;
        $user->phone = $this->phone;
        $update = $user->save();

        if( $update ){
            $this->dispatch('updateAdminUserHeaderInfo');
            $this->showToastr('success','Les informations ont été mises à jour avec succès.');
        }else{
            $this->showToastr('error','Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function updatePassword(){
        $user = User::findOrFail(auth('user')->id());

        //Validate the form
        $this->validate([
            'current_password'=>[
                'required',
                function($attribute, $value, $fail) use ($user){
                    if( !Hash::check($value, $user->password) ){
                        return $fail(__('Le mot de passe actuel est incorrect.'));
                    }
                }
            ],
            'new_password'=>'required|min:8|max:45|confirmed'
        ]);

        //Update password
        $update = $user->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if( $update ){
           //Send email notification to user that contains new password
           $data['user'] = $user;
           $data['new_password'] = $this->new_password;

           $mail_body = view('email-templates.user-reset-email-template',$data);

           $mailConfig = array(
              'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
              'mail_from_name'=>env('EMAIL_FROM_NAME'),
              'mail_recipient_email'=>$user->email,
              'mail_recipient_name'=>$user->name,
              'mail_subject'=>'Password changed',
              'mail_body'=>$mail_body
           );

           sendEmail($mailConfig);
           $this->current_password = null;
           $this->new_password = null;
           $this->new_password_confirmation = null;
           $this->showToastr('success','Mot de passe mis à jour avec succès.');
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
        return view('livewire.user.user-profile',[
        'user'=>User::findOrFail(auth('user')->id())
        ]);
    }
}
