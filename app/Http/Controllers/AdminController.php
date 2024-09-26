<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Vendre;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Carbon;
use constGuards;
use constDefaults;
use Illuminate\Support\Facades\File;
use App\Models\GeneralSetting;

class AdminController extends Controller
{
    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id'=>'required|email|exists:admins,email',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'L\'email ou le nom d\'utilisateur est requis',
                'login_id.email'=>'Adresse email invalide',
                'login_id.exists'=>'L\'email n\'existe pas dans le système',
                'password.required'=>'Le mot de passe est requis'
            ]);
        }else{
            $request->validate([
               'login_id'=>'required|exists:admins,username',
               'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'L\'email ou le nom d\'utilisateur est requis',
                'login_id.exists'=>'Le nom d\'utilisateur n\'existe pas dans le système',
                'password.required'=>'Le mot de passe est requis'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password'=>$request->password
        );

        if( Auth::guard('admin')->attempt($creds) ){
            return redirect()->route('admin.home');
        }else{
            session()->flash('fail','Identifiants incorrects');
            return redirect()->route('admin.login');
        }
    }

    public function logoutHandler(Request $request){
        Auth::guard('admin')->logout();
        session()->flash('fail','Vous êtes déconnecté !');
        return redirect()->route('admin.login');
    }

    public function sendPasswordResetLink(Request $request){

        $request->validate([
            'email'=>'required|email|exists:admins,email'
        ],[
            'email.required'=>'L\'email est requis',
            'email.email'=>'Adresse email invalide',
            'email.exists'=>'L\'email n\'existe pas dans le système'
        ]);

        //Get admin details
        $admin = Admin::where('email',$request->email)->first();

        //Generate token
        $token = base64_encode(Str::random(64));

        //Check if there is an existing reset password token
        $oldToken = DB::table('password_reset_tokens')
                      ->where(['email'=>$request->email,'guard'=>constGuards::ADMIN])
                      ->first();

        if( $oldToken ){
            //Update token
            DB::table('password_reset_tokens')
              ->where(['email'=>$request->email,'guard'=>constGuards::ADMIN])
              ->update([
                'token'=>$token,
                'created_at'=>Carbon::now()
              ]);
        }else{
            //Add new token
            DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'guard'=>constGuards::ADMIN,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
        }

        $actionLink = route('admin.reset-password',['token'=>$token,'email'=>$request->email]);

        $data = array(
            'actionLink'=>$actionLink,
            'admin'=>$admin
        );

        $mail_body = view('email-templates.admin-forgot-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('EMAIL_FROM_NAME'),
            'mail_recipient_email'=>$admin->email,
            'mail_recipient_name'=>$admin->name,
            'mail_subject'=>'Reset password',
            'mail_body'=>$mail_body
        );

        if( sendEmail($mailConfig) ){
            session()->flash('success','Nous avons envoyé un lien de réinitialisation de mot de passe par email.');
            return redirect()->route('admin.forgot-password');
        }else{
            session()->flash('fail','Une erreur est survenue !');
            return redirect()->route('admin.forgot-password');
        }
    }

    public function resetPassword(Request $request, $token = null){
        $check_token = DB::table('password_reset_tokens')
                         ->where(['token'=>$token,'guard'=>constGuards::ADMIN])
                         ->first();

        if( $check_token ){
            //Check if token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());

            if( $diffMins > constDefaults::tokenExpiredMinutes ){
               //If token expired
               session()->flash('fail','Lien expiré, demandez un autre lien de réinitialisation de mot de passe.');
               return redirect()->route('admin.forgot-password',['token'=>$token]);
            }else{
                return view('back.pages.admin.auth.reset-password')->with(['token'=>$token]);
            }
        }else{
            session()->flash('fail','Lien invalide ! Demandez un autre lien de réinitialisation de mot de passe.');
            return redirect()->route('admin.forgot-password',['token'=>$token]);
        }
    }

    public function resetPasswordHandler(Request $request){
        $request->validate([
            'new_password'=>'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation'=>'required'
        ]);

        $token = DB::table('password_reset_tokens')
                   ->where(['token'=>$request->token,'guard'=>constGuards::ADMIN])
                   ->first();

        //Get admin details
        $admin = Admin::where('email',$token->email)->first();

        //Update admin password
        Admin::where('email',$admin->email)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        //Delete token record
        DB::table('password_reset_tokens')->where([
            'email'=>$admin->email,
            'token'=>$request->token,
            'guard'=>constGuards::ADMIN
        ])->delete();

        //Send email to notify admin
        $data = array(
            'admin'=>$admin,
            'new_password'=>$request->new_password
        );

        $mail_body = view('email-templates.admin-reset-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('EMAIL_FROM_NAME'),
            'mail_recipient_email'=>$admin->email,
            'mail_recipient_name'=>$admin->name,
            'mail_subject'=>'Password changed',
            'mail_body'=>$mail_body
        );

        sendEmail($mailConfig);
        return redirect()->route('admin.login')->with('success','Fait ! Votre mot de passe a été modifié. Utilisez le nouveau mot de passe pour vous connecter au système.');
    }

    public function profileView(Request $request){
        $admin = null;
        if( Auth::guard('admin')->check() ){
            $admin = Admin::findOrFail(auth()->id());
        }
        return view('back.pages.admin.profile', compact('admin'));
    }

    public function changeProfilePicture(Request $request){
        $admin = Admin::findOrFail(auth('admin')->id());
        $path = 'images/users/admins/';
        $file = $request->file('adminProfilePictureFile');
        $old_picture = $admin->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $filename = 'ADMIN_IMG_'.rand(2,1000).$admin->id.time().uniqid().'.jpg';

        $upload = $file->move(public_path($path),$filename);

        if($upload){
            if( $old_picture != null && File::exists(public_path($path.$old_picture)) ){
                File::delete(public_path($path.$old_picture));
            }
            $admin->update(['picture'=>$filename]);
            return response()->json(['status'=>1,'msg'=>'Votre photo de profil a été mise à jour avec succès.']);
        }else{
            return response()->json(['status'=>0,'msg'=>'Une erreur est survenue , Veuillez réessayer']);
        }
    }

    public function changeLogo(Request $request){
        $path = 'images/site/';
        $file = $request->file('site_logo');
        $settings = new GeneralSetting();
        $old_logo = $settings->first()->site_logo;
        $file_path = $path.$old_logo;
        $filename = 'LOGO_'.uniqid().'.'.$file->getClientOriginalExtension();

        $upload = $file->move(public_path($path),$filename);

        if( $upload ){
            if( $old_logo != null && File::exists(public_path($path.$old_logo)) ){
                File::delete(public_path($path.$old_logo));
            }
            $settings = $settings->first();
            $settings->site_logo = $filename;
            $update = $settings->save();

            return response()->json(['status'=>1,'msg'=>'Logo du Site a été mise à jour avec succès.']);
        }else{
            return response()->json(['status'=>0,'msg'=>'Une erreur est survenue , Veuillez réessayer.']);
        }
    }

    public function changeFavicon(Request $request){
        $path = 'images/site/';
        $file = $request->file('site_favicon');
        $settings = new GeneralSetting();
        $old_favicon = $settings->first()->site_favicon;
        $filename = 'FAV_'.uniqid().'.'.$file->getClientOriginalExtension();

        $upload = $file->move(public_path($path), $filename);

        if( $upload ){
           if( $old_favicon != null && File::exists(public_path($path.$old_favicon)) ){
             File::delete(public_path($path.$old_favicon));
           }
           $settings = $settings->first();
           $settings->site_favicon = $filename;
           $update = $settings->save();

           return response()->json(['status'=>1,'msg'=>'Favicon du site a été mise à jour avec succès.']);
        }else{
            return response()->json(['status'=>0,'msg'=>'Une erreur est survenue , Veuillez réessayer.']);
        }
    }

     public function showUsers()
    {
        $data = [
             'pageTitle' => 'liste des utlisateur',     
            ];
        if( Auth::guard('admin')->check() ){
            $admin = Admin::findOrFail(auth()->id());
        }
        return view('back.pages.admin.userlist',$data);
    }

    public function showLocation()
    {
        $data = [
             'pageTitle' => 'liste des vehicule en location',
             
            ];
        if( Auth::guard('admin')->check() ){
            $admin = Admin::findOrFail(auth()->id());
        }
        return view('back.pages.admin.locationlist',$data);
    }

    public function showVendre()
    {

        $data = [
             'pageTitle' => 'liste des vehicule en vente',
             
            ];
        if( Auth::guard('admin')->check() ){
            $admin = Admin::findOrFail(auth()->id());
        }
        return view('back.pages.admin.vendrelist',$data);
    }

    public function deleteVendre(Request $request)
        {
                $vendre = Vendre::findOrFail($request->id);

                // Supprimer l'image visite
                $pathVisite = 'images/Vendre/image_viste/';
                if ($vendre->image_viste && File::exists(public_path($pathVisite . $vendre->image_viste))) {
                    File::delete(public_path($pathVisite . $vendre->image_viste));
                }

                // Supprimer les images de véhicule à vendre
                $pathVente = 'images/Vendre/';
                if ($vendre->imagevehiculevente) {
                    $imageFilenames = json_decode($vendre->imagevehiculevente);
                    foreach ($imageFilenames as $filename) {
                        if (File::exists(public_path($pathVente . $filename))) {
                            File::delete(public_path($pathVente . $filename));
                        }
                    }
                }

                // Supprimer l'enregistrement Vendre
                $delete = $vendre->delete();

                if ($delete) {
                    return response()->json(['status' => 1, 'msg' => 'La vente et ses images associées ont été supprimées avec succès.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Une erreur est survenue lors de la suppression de la vente.']);
                }
     }


     public function deleteLocation(Request $request)
            {
                $location = Location::findOrFail($request->id);

                // Supprimer l'image visite
                $pathVisite = 'images/Locations/carte_assurance/';
                if ($location->image_assurance && File::exists(public_path($pathVisite . $location->image_assurance))) {
                    File::delete(public_path($pathVisite . $location->image_assurance));
                }

                // Supprimer les images de véhicule à location
                $pathLocation = 'images/locations/';
                if ($location->location_images) {
                    $imageFilenames = json_decode($location->location_images);
                    foreach ($imageFilenames as $filename) {
                        if (File::exists(public_path($pathLocation . $filename))) {
                            File::delete(public_path($pathLocation . $filename));
                        }
                    }
                }

                // Supprimer l'enregistrement location
                $delete = $location->delete();

                if ($delete) {
                    return response()->json(['status' => 1, 'msg' => 'La location et ses images associées ont été supprimées avec succès.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Une erreur est survenue lors de la suppression de la vente.']);
                }
     }

     public function deleteUser(Request $request)
            {
                $user = User::findOrFail($request->id);

                // Supprimer l'image profile
                $pathVisite = 'images/users/';
                if ($user->picture && File::exists(public_path($pathVisite . $user->picture))) {
                    File::delete(public_path($pathVisite . $user->picture));
                }

                // Supprimer l'enregistrement location
                $delete = $user->delete();

                if ($delete) {
                    return response()->json(['status' => 1, 'msg' => 'Le client a ete supprimer et ses images associées ont été supprimées avec succès.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Une erreur est survenue lors de la suppression de la vente.']);
                }
     }
}
